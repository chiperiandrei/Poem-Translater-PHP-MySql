<?php

require_once('libraries/Controller.php');
require_once('libraries/Session.php');

require_once('models/AuthorModel.php');

class AuthorController extends Controller
{
    private $model;

    public function __construct() {
        parent::__construct();

        $this->model = new AuthorModel();
    }

    public function index() {
        Session::set('current_page', 'author');

        $this->view->render('author/index');
    }

    public function getLink($limba, $nume)
    {
        $line = '../poem/' . strtolower($limba) . '/' .
            str_replace(' ', '+', $nume);
        return $line;
    }


    public function loadAuthorData($URL) {
        $author = str_replace('+', ' ', $URL);

        $check = $this->model->loadAuthorData($author);

        if ($check == null) {
            return false;
        }

        $this->view->author = $this->packAuthor($check);

        $this->view->poems = $this->packPoems(
            $this->model->loadPoems($check['ID'])
        );

        return true;
    }

    private function packAuthor($data) {
        $result = [];

        $result['id'] = $data['ID'];
        $result['name'] = $data['NAME'];
        $result['birth_date'] = $data['BIRTH_DATE'];
        $result['death_date'] = $data['DEATH_DATE'];
        $result['link'] = '/author/' . str_replace(' ', '+', $result['name']);

        $avatar_path = $this->model->loadAuthorPhoto($result['id']);

        if ($avatar_path != null) {
            $avatar_path = 'storage/authors/' . $avatar_path;
            $avatar_type = pathinfo($avatar_path, PATHINFO_EXTENSION);
            $avatar_data = file_get_contents($avatar_path);
            $avatar_image = 'data:image/' . $avatar_type . ';base64,' . base64_encode($avatar_data);
        } else {
            $avatar_path = null;
            $avatar_image = null;
        }

        $result['avatar_path'] = $avatar_path;
        $result['avatar'] = $avatar_image;

        return $result;
    }

    private function packPoems($data) {
        $result = [];
        $i = 0;

        if ($data != null) {
            foreach ($data as $poem) {
                $result[$i]['title'] = $poem['TITLE'];
                $title = str_replace(' ', '+', $poem['TITLE']);
                $result[$i]['link'] = '/poem/' . strtolower($poem['LANGUAGE']) . '/' . $title;
                $result[$i]['language'] = ($poem['LANGUAGE'] === 'EN' ? 'gb' : strtolower($poem['LANGUAGE']));
                $i++;
            }
        } else {
            return null;
        }

        return $result;
    }
}