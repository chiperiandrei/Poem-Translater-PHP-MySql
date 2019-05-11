<?php

require_once('libraries/Controller.php');
require_once('libraries/Session.php');

require_once('models/PoemModel.php');

class PoemController extends Controller
{
    private $model;
    private $view_path;

    public function __construct()
    {
        parent::__construct();

        $this->model = new PoemModel();
    }

    public function index()
    {
        Session::set('current_page', 'poem');

        $this->view->render('poem/' . $this->view_path . '/index');
    }

    public function loadPoemOrTranslations($poem_title, $poem_language)
    {
        $poem_title = str_replace('-+', ' ', $poem_title);
        $poem_language = strtoupper($poem_language);

        if ($this->model->loadPoemHeader($poem_title, $poem_language)) {
            $this->view_path = 'original';

            $this->view->poem_header = $this->packHeader(
                $this->model->loadPoemHeader($poem_title, $poem_language)
            );

            $this->view->poem_body = $this->packBody(
                $this->model->loadPoemBody()
            );

            $this->view->poem_languages = $this->packAvailableTranslations(
                $this->model->loadAvailableTranslations()
            );

        } else if ($translations = $this->model->loadTranslations($poem_title, $poem_language)) {
            $this->view_path = 'translations';

            $this->view->poem_title = $poem_title;
            $this->view->translation_language = strtolower($poem_language);
            $this->view->poem_language = $this->model->loadInfos($poem_title)['LANGUAGE'];
            $this->view->poem_link = '/poem/' . $this->view->poem_language .
                                     '/' . str_replace(' ', '+', $this->view->poem_title);
            $this->view->author_name = $this->model->loadInfos($poem_title)['NAME'];
            $this->view->author_link = '/author/' . str_replace(' ', '+', $this->view->author_name);
            $this->view->translations = $this->packTranslations($translations);
            $this->view->poem_languages = $this->packAvailableTranslations(
                $this->model->loadAvailableTranslations()
            );

        } else {
            http_response_code(404);
            require_once('views/errors/404.php');
            exit();
        }
    }

    /**
     * $URL = "/$POEM_NAME/$POEM_LANGUAGE/$USERNAME
     *
     * @param $poem_title = $POEM_NAME
     * @param $poem_language = $POEM_LANGUAGE
     * @param $username = $USERNAME
     *
     * This function store all the data needed for a page with a translation
     */
    public function loadTranslation($poem_title, $poem_language, $username) {
        $this->view_path = 'translation';

        $poem_title = str_replace('-+', ' ', $poem_title);
        $poem_language = strtoupper($poem_language);

        /**
         * @var poem
         * Stores infos about the original poem
         * Can be accessed from view
         */
        $this->view->poem = $this->packPoemTranslation(
            $this->model->loadPoemForTranslationHeader($poem_title),
            $this->model->countPoemStrophes()
        );

        /**
         * @var user
         * Stores data about the person how wrote the translation
         * Can be accessed from view
         */
        $this->view->user = $this->packUserTranslation(
            $this->model->selectUser($username),
            $username
        );

        // var_dump($this->view->user);

        /**
         * @var translation
         * Stores data about the translation
         * Can be accessed from view
         */
        $this->view->translation = $this->packTranslation (
            $this->model->loadTranslationHeader($this->view->poem['id'], $this->view->user['id'], $poem_language),
            $poem_language,
            $this->view->poem['title'],
            $this->view->user['username'],
            $this->packAvailableTranslations(
                $this->model->loadAvailableTranslations()
            )
        );
        $this->view->translation = $this->packTranslationStrophes(
            $this->view->translation,
            $this->model->loadTranslationBody($this->view->translation['id']),
            $this->view->poem['size']
        );
    }

    private function packHeader($header)
    {
        $poem['title'] = $header['POEM_TITLE'];
        $poem['author_name'] = $header['AUTHOR_NAME'];
        $poem['language'] = strtolower($header['LANGUAGE'] === 'EN' ? 'gb' : $header['LANGUAGE']);
        $poem['link'] = 'poem/' . strtolower($header['LANGUAGE']) . '/' .
                         str_replace(' ', '-+', $poem['title']);
        $poem['author_link'] = 'author/' .
            str_replace(' ', '-+', $poem['author_name']);

        return $poem;
    }

    private function packBody($header)
    {
        $poem = [];

        foreach ($header as $strophe) {
            array_push($poem, $strophe[0]);
        }

        return $poem;
    }

    private function packAvailableTranslations($languages)
    {
        $translations = [];

        foreach ($languages as $language)
        {
            array_push($translations, strtolower($language['LANGUAGE'])
            );
        }

        return $translations;
    }

    private function packTranslations($translations) {
        $i = 0;
        $result = [];

        foreach ($translations as $translation) {
            $result[$i]['user_fn'] = $translation['USER_FN'];
            $result[$i]['user_ln'] = $translation['USER_LN'];
            $result[$i]['username'] = $translation['USERNAME'];
            $result[$i]['rating'] = $translation['TRANSLATION_RATING'];
            $i++;
        }

        return $result;
    }

    // #cleanCodeBelow
    private function packPoemTranslation($header, $count) {
        $poem['id'] = $header['POEM_ID'];
        $poem['title'] = $header['POEM_TITLE'];
        $poem['size'] = ($count != null ? $count : '0');

        $language = strtolower($header['LANGUAGE']);

        $poem['language']['name'] = $language;
        $poem['language']['flag'] = 'flag flag-' . ($language == 'en' ? 'gb' : $language);
        $poem['language']['link'] = '/poem/' . $language . '/' . $poem['title'];

        $poem['author']['id'] = $header['AUTHOR_ID'];
        $poem['author']['name'] = $header['AUTHOR_NAME'];
        $poem['author']['link'] = '/author/' .  str_replace(' ', '+', $poem['author']['name']);

        return $poem;
    }

    private function packUserTranslation($model, $username) {
        $user['id'] = $model['USER_ID'];
        $user['first_name'] = $model['USER_FN'];
        $user['last_name'] = $model['USER_LN'];
        $user['username'] = $username;
        $user['link'] = '/user/' . $user['username'];

        /**
         * $user['avatar_name'] == null
         * if user has no avatar uploaded
         */
        $user['avatar_name'] = $model['USER_AVATAR'];
        return $user;
    }

    private function packTranslation($header, $language, $title, $username, $available_languages) {
        $translation['id'] = $header['TRANSLATION_ID'];
        $translation['rating'] = $header['RATING'];

        $language = strtolower($language);
        $title = $poem_title = str_replace(' ', '+', $title);

        $array = [];
        $array['name'] = $language;
        $array['flag'] = 'flag flag-' . ($language == 'en' ? 'gb' : $language);
        $array['link'] = '/poem/' . $language . '/' . $title . '/' . $username;
        $translation['language'] = $array;

        $i = 0;
        $array = [];
        foreach ($available_languages as $language) {
            $array[$i]['name'] = $language;
            $array[$i]['flag'] = 'flag flag-' . ($language == 'en' ? 'gb' : $language);
            $array[$i]['link'] = '/poem/' . $language . '/' . $title;
            $i++;
        }

        $translation['translations'] = $array;

        return $translation;
    }

    private function packTranslationStrophes($header, $body, $count) {
        $translation = $header;

        for ($i = 0; $i < $count; $i++) {
            $translation['strophes'][$i] = null;
        }

        if ($body != null) {
            foreach ($body as $strophe) {
                $translation['strophes'][$strophe['NTH'] - 1] = $strophe['TEXT'];
            }
        }

        return $translation;
    }
}