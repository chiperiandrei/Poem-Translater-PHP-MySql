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

    public function loadPoemOrTranslation($poem_title, $poem_language)
    {
        $poem_title = str_replace('-', ' ', $poem_title);
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
            $this->view_path = 'translation';

            $this->view->poem_title = $poem_title;

            $this->view->translation_language = strtolower($poem_language);

            $this->view->poem_language = $this->model->loadInfos($poem_title)['LANGUAGE'];

            $this->view->poem_author = $this->model->loadInfos($poem_title)['NAME'];

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

    private function packHeader($header)
    {
        $poem['title'] = $header['POEM_TITLE'];
        $poem['author_name'] = $header['AUTHOR_NAME'];
        $poem['language'] = strtolower($header['LANGUAGE'] === 'EN' ? 'gb' : $header['LANGUAGE']);
        $poem['link'] = 'poem/' . strtolower($header['LANGUAGE']) . '/' .
                         str_replace(' ', '-', $poem['title']);
        $poem['author_link'] = 'author/' .
            str_replace(' ', '-', $poem['author_name']);

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
}