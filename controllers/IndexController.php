<?php

require_once('libraries/Controller.php');
require_once('libraries/Session.php');

require_once('models/IndexModel.php');

define('HOST', 'http://poem-translator.tw/');

class IndexController extends Controller
{
    private $model;

    public function __construct()
    {
        parent::__construct();

        $this->model = new IndexModel();

        if (Session::exists('user_id'))
        {
            // setting avatar
            Session::set('avatar', $this->constructAvatarPath());
        }

        $this->view->poems = $this->packPoem(
            $this->model->loadPoemsHeader(),
            $this->model->loadPoemsBody()
        );

        $this->view->count = count($this->view->poems);
    }

    public function index()
    {
        Session::set('current_page', 'index');

        $this->view->render('index/index');
    }

    private function constructAvatarPath()
    {
        $avatar_path = $this->model->loadAvatar();

        if ($avatar_path) {
            return HOST . 'storage/' . Session::get('username') . '/' . $avatar_path;
        }

        return HOST . 'storage/default/avatar.png';
    }

    private function packPoem($headers, $bodies)
    {
        $poems = [];

        $i = 0;

        foreach ($headers as $header) {
            $poems[$i]['title'] = $header['POEM_TITLE'];
            $poems[$i]['author_name'] = $header['AUTHOR_NAME'];
            $poems[$i]['language'] = ($header['LANGUAGE'] === 'en' ? 'gb' : $header['LANGUAGE']);
            $poems[$i]['link'] = 'poem/' . $header['LANGUAGE'] . '/' .
                                str_replace(' ', '-', $poems[$i]['title']);
            $poems[$i]['author_link'] = 'author/' .
                                       str_replace(' ', '-', $poems[$i]['author_name']);
            $poems[$i]['content'] = $bodies[$i];
            $i++;
        }

        return $poems;
    }
}