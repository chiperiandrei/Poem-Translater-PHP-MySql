<?php

require_once('libraries/Controller.php');
require_once('libraries/Session.php');

require_once('models/UserModel.php');

class UserController extends Controller
{
    public function __construct() {
        parent::__construct();

        $this->model = new UserModel();
    }

    public function index() {
        Session::set('current_page', 'contact');

        $this->view->render('user/index');
    }

    public function loadUserData($username) {
        $check = $this->model->loadUserData($username);

        if ($check == null) {
            return false;
        }

        $this->view->user = $this->packUser($check);

        $this->view->poems = $this->packPoems($check);

        return true;
    }

    private function packUser($data) {
        $result = [];

        $result['id'] = $data['ID'];
        $result['username'] = $data['USERNAME'];
        $result['first_name'] = $data['FIRST_NAME'];
        $result['last_name'] = $data['LAST_NAME'];
        $result['complete_name'] = $data['FIRST_NAME'] . ' ' . $data['LAST_NAME'];
        $result['email'] = $data['EMAIL'];

        $avatar_path = $this->model->loadAvatar($result['id']);

        ($avatar_path === null
            ? $avatar_path = 'storage/users/default/avatar.png'
            : $avatar_path = 'storage/users/' . $result['username'] . '/' . $avatar_path
        );

        $avatar_type = pathinfo($avatar_path, PATHINFO_EXTENSION);
        $avatar_data = file_get_contents($avatar_path);
        $avatar_image = 'data:image/' . $avatar_type . ';base64,' . base64_encode($avatar_data);

        $result['avatar_path'] = $avatar_path;
        $result['avatar'] = $avatar_image;

        return $result;
    }

    private function packPoems($data) {
        $result = [];
        $i = 0;

        $translations = $this->model->loadUserTranslations($data['ID']);

        if ($translations != null) {
            foreach ($translations as $translation) {
                $result[$i]['title'] = $translation['TITLE'];
                $title = str_replace(' ', '+', $translation['TITLE']);
                $result[$i]['link'] = '/poem/' . strtolower($translation['LANGUAGE']) . '/' . $title . '/' . $data['USERNAME'];
                $result[$i]['language'] = ($translation['LANGUAGE'] === 'EN' ? 'gb' : strtolower($translation['LANGUAGE']));
                $i++;
            }
        } else {
            return null;
        }

        return $result;
    }
}