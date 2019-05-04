<?php

require_once('libraries/Controller.php');
require_once('libraries/Session.php');

require_once('models/PoemModel.php');

class PoemController extends Controller
{
    private $model;

    public function __construct()
    {
        parent::__construct();

        $this->model = new PoemModel();
    }

    public function index()
    {
        Session::set('current_page', 'poem');

        $this->view->render('poem/index');
    }

    public function loadPoem($poem_title, $poem_language)
    {
        $poem_title = str_replace('-', ' ', $poem_title);
        $poem_language = strtoupper($poem_language);

        $this->view->poem_header = $this->packHeader(
            $this->model->loadPoemHeader($poem_title, $poem_language)
        );

        $this->view->poem_body = $this->packBody(
            $this->model->loadPoemBody()
        );
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

        foreach($header as $strophe) {
            array_push($poem, $strophe[0]);
        }

        return $poem;
    }
}