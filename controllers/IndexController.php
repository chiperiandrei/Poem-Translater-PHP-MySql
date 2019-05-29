<?php

require_once('libraries/Controller.php');
require_once('libraries/Session.php');

require_once('models/IndexModel.php');

class IndexController extends Controller
{
    private $model;

    public function __construct()
    {
        parent::__construct();

        $this->model = new IndexModel();

        $this->view->poems = $this->packPoem(
            $this->model->loadPoemsHeader(),
            $this->model->loadPoemsBody()
        );

        $this->view->count = count($this->view->poems);

        $this->view->authors = $this->packAuthors(
            $this->model->loadAuthors()
        );

        $this->view->sort = 'asc';

        if (Session::exists('user_id')) {
            $avatar_path = $this->getAvatarPath();
            $avatar_type = pathinfo($avatar_path, PATHINFO_EXTENSION);
            $avatar_data = file_get_contents($avatar_path);
            $avatar_image = 'data:image/' . $avatar_type . ';base64,' . base64_encode($avatar_data);

            Session::set('avatar_path', $avatar_path);
            Session::set('avatar', $avatar_image);

            $this->manageFavorites(
                $this->view->poems,
                $this->view->favorites
            );

            /*
            * this stuff is used in add-poem
            */
            $this->view->languages = $this->packLanguages(
                $this->model->loadLanguages()
            );

            /*
             * this stuff is used in delete-poem
             */
            $this->view->poemAndAuthor = [];
            $this->view->poemLanguages = [];

            $this->packPoemAndAuthor(
                $this->model->loadPoemAndAuthor(),
                $this->view->poemAndAuthor,
                $this->view->poemLanguages
            );
        }
    }

    public function index() {
        Session::set('current_page', 'index');

        $this->view->render('index/index');
    }

    private function getAvatarPath() {
        $avatar_path = $this->model->loadAvatar();

        if ($avatar_path != null) {
            return 'storage/users/' . Session::get('username') . '/' . $avatar_path;
        }

        return 'storage/users/default/avatar.png';
    }

    private function packPoem($headers, $bodies) {
        $poems = [];

        $i = 0;

        foreach ($headers as $header) {
            $poems[$i]['id'] = $header['POEM_ID'];
            $poems[$i]['title'] = $header['POEM_TITLE'];
            $poems[$i]['language'] = ($header['LANGUAGE'] === 'en' ? 'gb' : $header['LANGUAGE']);
            $poems[$i]['link'] = 'poem/' . $header['LANGUAGE'] . '/' .
                                 str_replace(' ', '+', $poems[$i]['title']);
            $poems[$i]['author_name'] = $header['AUTHOR_NAME'];
            $poems[$i]['author_link'] = 'author/' .
                                        str_replace(' ', '+', $poems[$i]['author_name']);
            $poems[$i]['content'] = $bodies[$i];
            $i++;
        }

        return $poems;
    }

    private function packAuthors($authors) {
        $result = [];

        $i = 0;

        foreach ($authors as $author) {
            $result[$i]['id'] = $author['ID'];
            $result[$i]['name'] = $author['NAME'];
            $result[$i]['birth_date'] = $author['BIRTH_DATE'];
            $result[$i]['death_date'] = $author['DEATH_DATE'];
            $result[$i]['full_info'] = $author['NAME'] . ' (' . $author['BIRTH_DATE'] . ' - ' . $author['DEATH_DATE'] . ')';
            $i++;
        }

        return $result;
    }

    private function packLanguages($languages)
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

            $result[$i]['name'] = ($iso_code == 'gb' ? 'EN' : strtoupper($iso_code));
            $result[$i]['flag'] = 'flag flag-' . $iso_code;
            $i++;
        }

        curl_close($curl_handle);

        return $result;
    }

    public function addPoem() {
        $title = $_POST['name'];
        $author_id = $_POST['author'];
        $language = $_POST['language'];
        $staff_id = Session::get('user_id');
        $count = $_POST['count'];

        $strophes = [];

        for ($i = 0; $i < $count; $i++) {
            $index = $i + 1;
            $strophes[$i] = $_POST['strophe-' . $index];
        }

        $this->model->insertPoem($title, $author_id, $language, $staff_id, $strophes);
    }

    private function packPoemAndAuthor($headers, &$poems, &$index) {
        $i = 0;

        foreach ($headers as $header) {
            $language = strtoupper($header['LANGUAGE']);

            if (isset($poems[$language])) {
                $index[$language]++;
            } else {
                $index[$language] = 0;
            }

            $poems[$language][$index[$language]]['id'] = $header['POEM_ID'];
            $poems[$language][$index[$language]]['full_info'] = $header['POEM_TITLE'] .' ('. $header['AUTHOR_NAME'] .')';

            $i++;
        }

        $index = array_keys($index);

        return $poems;
    }

    public function deletePoem() {
        $this->model->deletePoem($_POST['poem']);
    }

    public function addAuthor() {
        $author = $_POST['author-name'];
        $b_date = (!empty($_POST['birth']) ? $_POST['birth'] : 'NULL');
        $d_date = (!empty($_POST['death']) ? $_POST['death'] : 'NULL');

        $this->model->insertAuthor($author, $b_date, $d_date);
    }

    public function deleteAuthor() {
        $this->model->deleteAuthor($_POST['selected-author']);
    }

    public function addFavorites() {
        $poem_id = $_POST['poem_id'];
        $user_id = Session::get('user_id');

        $this->model->insertFavorites($user_id, $poem_id);
    }

    private function manageFavorites(&$poems, &$favorites) {
        $user_id = Session::get('user_id');

        $favorites = $this->model->loadFavorites($user_id);

        foreach ($poems as &$poem) {
            if (in_array($poem['id'], $favorites)) {
                $poem['favorite'] = true;
            } else {
                $poem['favorite'] = false;
            }
        }
    }

    public function deleteFavorites() {
        $poem_id = $_POST['poem_id'];
        $user_id = Session::get('user_id');

        $this->model->deleteFavorites($user_id, $poem_id);
    }

    public function search() {
        $search_keyword = $_REQUEST['keyword'];
        $search_preg = preg_replace('#[^0-9A-Za-z ]#', '', $search_keyword);

        $result = json_encode($this->model->search($search_preg));
        header('Content-Type: application/json');

        echo $result;
    }

    public function sort() {
        if (isset($_REQUEST['sort'])) {
            usort($this->view->poems, function($a, $b) {
                return strcmp($a['title'], $b['title']);
            });
            $this->view->sort = 'desc';

            if ($_REQUEST['sort'] == 'desc') {
                $this->view->poems = array_reverse($this->view->poems);
                $this->view->sort = 'asc';
            }
        }
    }
}