<?php

require_once('libraries/Controller.php');
require_once('libraries/Session.php');

require_once('models/PoemModel.php');

class PoemController extends Controller
{
    private $model;
    private $view_path;
    private $wordpresstitle;
    private $wordpressautor;
    private $wordpresslanguage;
    private $wordpresscontent;

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
        $poem_title = str_replace('-', ' ', $poem_title);
        $poem_title = str_replace('+', ' ', $poem_title);
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

            $this->view->poem_comments = $this->packComments(
                $this->model->loadComments($this->view->poem_header['id'])
            );

            $this->wordpressautor = $this->view->poem_header['author_name'];
            $this->wordpresscontent = $this->packBody(
                $this->model->loadPoemBody()
            );
            $this->wordpresslanguage = $poem_language;
            $this->wordpresstitle = $poem_title;

            if (Session::exists('user_id')) {
                $this->view->translation = $this->packCustom(
                    $this->model->loadUserTranslation($this->view->poem_header['id'], Session::get('user_id'))
                );

                $this->view->languages = $this->packLanguages(
                    $this->model->loadLanguages(),
                    $this->view->translation
                );
            }


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
     * @return true/false;
     */
    public function loadTranslation($poem_title, $poem_language, $username)
    {
        $this->view_path = 'translation';

        $poem_title = str_replace('+', ' ', $poem_title);
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

        if ($this->view->poem['id'] == null) {
            return false;
        }

        /**
         * @var user
         * Stores data about the person how wrote the translation
         * Can be accessed from view
         */
        $this->view->user = $this->packUserTranslation(
            $this->model->selectUser($username),
            $username
        );

        /**
         * @var translation
         * Stores data about the translation
         * Can be accessed from view
         */
        $this->view->translation = $this->packTranslation(
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

        return true;
    }

    private function packHeader($header)
    {
        $poem['id'] = $header['POEM_ID'];
        $poem['title'] = $header['POEM_TITLE'];
        $poem['author_name'] = $header['AUTHOR_NAME'];
        $poem['language'] = strtolower($header['LANGUAGE'] === 'EN' ? 'gb' : $header['LANGUAGE']);
        $poem['link'] = '/poem/' . strtolower($header['LANGUAGE']) . '/' .
            str_replace(' ', '+', $poem['title']);
        $poem['author_link'] = '/author/' .
            str_replace(' ', '+', $poem['author_name']);

        return $poem;
    }

    private function packBody($header)
    {
        $poem = [];

        $i = 0;
        foreach ($header as $strophe) {
            $poem[$i]['text'] = $strophe[0];
            $poem[$i]['count'] = substr_count($strophe[0], "\n") + 1;
            $i++;
        }

        return $poem;
    }

    private function packAvailableTranslations($languages)
    {
        $translations = [];

        foreach ($languages as $language) {
            array_push($translations, strtolower($language['LANGUAGE'])
            );
        }

        return $translations;
    }

    private function packTranslations($translations)
    {
        $i = 0;
        $result = [];

        foreach ($translations as $translation) {
            $result[$i]['user_id'] = $translation['USER_ID'];
            $result[$i]['user_fn'] = $translation['USER_FN'];
            $result[$i]['user_ln'] = $translation['USER_LN'];
            $result[$i]['username'] = $translation['USERNAME'];
            $result[$i]['rating'] = $translation['TRANSLATION_RATING'];
            $result[$i]['translation_id'] = $translation['TRANSLATION_ID'];
            $i++;
        }

        return $result;
    }

    private function packComments($comments)
    {
        if ($comments) {
            $result = [];
            $i = 0;
            foreach ($comments as $comment) {
                $result[$i]['id'] = $comment['ID'];
                $result[$i]['user']['name'] = $comment['FIRST_NAME'] . ' ' . $comment['LAST_NAME'];
                $result[$i]['user']['username'] = $comment['USERNAME'];
                $result[$i]['user']['link'] = '/user/' . $comment['USERNAME'];
                if ($comment['PATH'] == null) {
                    $result[$i]['user']['avatar_path'] = 'storage/users/default/avatar.png';
                } else {
                    $result[$i]['user']['avatar_path'] = 'storage/users/' . $comment['USERNAME'] . '/' . $comment['PATH'];
                }
                $avatar_path = $result[$i]['user']['avatar_path'];
                $avatar_type = pathinfo($avatar_path, PATHINFO_EXTENSION);
                $avatar_data = file_get_contents($avatar_path);
                $avatar_image = 'data:image/' . $avatar_type . ';base64,' . base64_encode($avatar_data);
                $result[$i]['user']['avatar'] = $avatar_image;
                $result[$i]['text'] = $comment['TEXT'];
                $i++;
            }
            return $result;
        }

        return null;
    }

    public function addComment($poem_title, $poem_language)
    {
        if (isset($_POST)) {
            $poem_id = $this->model->loadPoemHeader($poem_title, $poem_language)['POEM_ID'];

            if ($poem_id && Session::exists('user_id')) {
                $comment = $_POST['add-comment'];
                $user_id = Session::get('user_id');
                $this->model->insertComment($poem_id, $user_id, $comment);
            }

            return str_replace(' ', '+', $poem_title);
        }
    }

    public function deleteComment($poem_title, $poem_language, $comment_id)
    {
        if (isset($_POST)) {
            $poem_id = $this->model->loadPoemHeader($poem_title, $poem_language)['POEM_ID'];

            if ($poem_id && Session::exists('user_id')) {
                $user_id = Session::get('user_id');
                $this->model->removeComment($poem_id, $user_id, $comment_id);
            }

            return str_replace(' ', '+', $poem_title);
        }
    }

    private function fountInTranslations($found, $translations)
    {
        foreach ($translations as $translation) {
            if ($translation == $found) {
                return true;
            }
        }
        return false;
    }

    private function packLanguages($languages, $translations)
    {
        preg_match("/^enum\(\'(.*)\'\)$/", $languages['Type'], $matches);
        $enum = explode("','", $matches[1]);

        $result = [];

        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 3);
        curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);

        $i = 0;

        foreach ($enum as $language) {
            $iso_code = ($language == 'EN' ? 'gb' : strtolower($language));

            if ($this->fountInTranslations(strtolower($language), $translations) == false) {
                curl_setopt($curl_handle, CURLOPT_URL, "https://restcountries.eu/rest/v2/alpha/$iso_code");

                $answer = curl_exec($curl_handle);
                $array = json_decode($answer, true);

                if (isset($array['languages'])) {
                    $array = $array['languages'][0];
                    $result[$i]['en_name'] = $array['name'];
                    $result[$i]['native_name'] = $array['nativeName'];
                } else {
                    $result[$i]['en_name'] = $iso_code;
                    $result[$i]['native_name'] = '';
                }

                $result[$i]['name'] = $iso_code;
                $result[$i]['flag'] = 'flag flag-' . $iso_code;
                $i++;
            }
        }

        curl_close($curl_handle);

        return $result;
    }

    private function packCustom($languages)
    {
        $result = [];

        if ($languages != null) {
            foreach ($languages as $language) {
                array_push($result, strtolower($language['LANGUAGE']));
            }
        }

        return $result;
    }

    public function addTranslation()
    {
        $user_id = Session::get('user_id');
        $poem = Session::get('poem_data');
        $count = Session::get('poem_strophes_count');
        $strophes = [];

        $toggle = false;
        for ($i = 0; $i < $count; $i++) {
            if (!empty($_POST["strophe-$i"])) {
                $toggle = true;
            }
        }

        if ($toggle == true) {
            for ($i = 0; $i < $count; $i++) {
                array_push($strophes, $_POST["strophe-$i"]);
            }

            $poem['translation']['count'] = $count;
            $poem['translation']['language'] = ($_POST['language'] == 'gb' ? 'EN' : strtoupper($_POST['language']));
            $poem['translation']['strophes'] = $strophes;

            $this->model->addTransition($poem, $user_id);
        }

        Session::unset('poem_data');
        Session::unset('poem_strophes_count');

        return str_replace(' ', '+', $poem['title']);
    }

    public function deleteTranslation()
    {
        $this->model->removeTranslation(Session::get('translation_id'));
        $poem_link = Session::get('poem_link');
        Session::unset('translation_id');
        Session::unset('poem_link');
        return $poem_link;
    }

    // #cleanCodeBelow
    private function packPoemTranslation($header, $count)
    {
        $poem['id'] = $header['POEM_ID'];
        $poem['title'] = $header['POEM_TITLE'];
        $poem['size'] = ($count != null ? $count : '0');

        $language = strtolower($header['LANGUAGE']);

        $poem['language']['name'] = $language;
        $poem['language']['flag'] = 'flag flag-' . ($language == 'en' ? 'gb' : $language);
        $poem['language']['link'] = '/poem/' . $language . '/' . str_replace(' ', '+', $poem['title']);

        $poem['author']['id'] = $header['AUTHOR_ID'];
        $poem['author']['name'] = $header['AUTHOR_NAME'];
        $poem['author']['link'] = '/author/' . str_replace(' ', '+', $poem['author']['name']);

        return $poem;
    }

    private function packUserTranslation($model, $username)
    {
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

    private function packTranslation($header, $language, $title, $username, $available_languages)
    {
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

    private function packTranslationStrophes($header, $body, $count)
    {
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

    /**
     * @param $poem_language
     * @param $poem_title
     * @return bool
     */
    public function shareWordpress()
    {

        $username = 'admin';
        $password = 'admin';
        $new_body = '';
        foreach ($this->wordpresscontent as $poem_strophe)
            $new_body = $new_body . " " . $poem_strophe['text'];
        $process = curl_init('http://localhost/wordpress/wp-json/wp/v2/posts');
        $data = array(
            'slug' => $this->wordpresstitle . '-' . $this->wordpressautor . '-' . $this->wordpresslanguage,
            'title' => $this->wordpresstitle . ' - ' . $this->wordpressautor,
            'content' => $new_body,
            'status' => 'publish');
        $data_string = json_encode($data);
        curl_setopt($process, CURLOPT_USERPWD, $username . ":" . $password);
        curl_setopt($process, CURLOPT_TIMEOUT, 30);
        curl_setopt($process, CURLOPT_POST, 1);
        curl_setopt($process, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($process, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($process, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string))
        );
        curl_exec($process);
        curl_close($process);


        /*
                $options = array(
                    'http' =>
                        array(
                            'ignore_errors' => true,
                            'method' => 'POST',
                            'header' =>
                                array(
                                    0 => 'authorization: Bearer uJJ0CaGiST8nrO9G3G8)NWErbv7NL#FZBNfMGvU1g1P@^mqAh3#fJQVv&74hmw$s',
                                    1 => 'Content-Type: application/x-www-form-urlencoded',
                                ),
                            'content' =>
                                http_build_query(array(
                                    'slug' => $header['title'].'-'.$header['author_name'].'-'.$header['language'],
                                    'title' => $header['title'],
                                    'content' => $new_body,
                                    'tags' => 'POTR',
                                    'categories' => 'API-WORDPRESS-POTR',
                                    'status' => 'publish'
                                )),
                        ),
                );

                $context = stream_context_create($options);
                $response = file_get_contents(
                    'https://public-api.wordpress.com/rest/v1.2/sites/162188338/posts/new/',
                    false,
                    $context
                );
                $response = json_decode($response);*/

    }
}