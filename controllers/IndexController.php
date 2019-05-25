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
}