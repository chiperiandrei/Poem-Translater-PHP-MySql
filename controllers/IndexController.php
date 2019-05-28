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

        if (Session::exists('user_id')) {
            $avatar_path = $this->getAvatarPath();
            $avatar_type = pathinfo($avatar_path, PATHINFO_EXTENSION);
            $avatar_data = file_get_contents($avatar_path);
            $avatar_image = 'data:image/' . $avatar_type . ';base64,' . base64_encode($avatar_data);

            Session::set('avatar_path', $avatar_path);
            Session::set('avatar', $avatar_image);
        }

        $this->view->poems = $this->packPoem(
            $this->model->loadPoemsHeader(),
            $this->model->loadPoemsBody()
        );

        $this->view->count = count($this->view->poems);

        $this->view->authors = $this->packAuthors(
            $this->model->loadAuthors()
        );

        $this->view->languages = $this->packLanguages(
            $this->model->loadLanguages()
        );
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


}