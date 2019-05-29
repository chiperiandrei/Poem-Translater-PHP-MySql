<?php

require_once('libraries/Controller.php');
require_once('libraries/Session.php');

require_once('models/FavoritesModel.php');

define('HOST', 'http://poem-translator.tw/');

class FavoritesController extends Controller
{
    private $model;

    public function __construct()
    {
        parent::__construct();

        $this->model = new FavoritesModel();

        if (Session::exists('user_id')) {

            $this->view->poems = $this->packPoem(
                $this->model->loadPoemsHeader(),
                $this->model->loadPoemsBody()
            );

            $this->view->count = count($this->view->poems);

            $this->manageFavorites(
                $this->view->poems,
                $this->view->favorites
            );
        }
    }

    public function index()
    {
        Session::set('current_page', 'favorites');

        $this->view->render('favorites/index');
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
}
