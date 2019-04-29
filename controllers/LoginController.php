<?php

require_once('libraries/Controller.php');
require_once('libraries/Session.php');

require_once('models/LoginModel.php');

class LoginController extends Controller
{
    private $model;
    private $poemOneId, $poemTwoId;

    public function __construct()
    {
        parent::__construct();

        $this->model = new LoginModel();

        // TODO: these will be set by the admin
        // from the administration panel
        $this->poemOneId = 4;
        $this->poemTwoId = 1;

        $this->view->poemOne = $this->packPoem(
            $this->model->loadPoemHeader($this->poemOneId),
            $this->model->loadPoemBody($this->poemOneId)
        );

        $this->view->poemTwo = $this->packPoem(
            $this->model->loadPoemHeader($this->poemTwoId),
            $this->model->loadPoemBody($this->poemTwoId)
        );
    }

    public function index()
    {
        Session::set('current_page', 'login');

        $this->view->render('login/index');
    }

    public function connect()
    {
        return $this->model->verifyUser();
    }

    public function disconnect()
    {
        Session::destroy();
    }

    private function packPoem($header, $body)
    {
        $poem['title'] = $header['POEM_TITLE'];
        $poem['author_name'] = $header['AUTHOR_NAME'];
        $poem['language'] = ($header['LANGUAGE'] === 'en' ? 'gb' : $header['LANGUAGE']);
        $poem['link'] = 'poems/' . $header['LANGUAGE'] . '/' .
                        str_replace(' ', '-', $poem['title']);
        $poem['author_link'] = 'authors/' .
                                str_replace(' ', '-', $poem['author_name']);
        $poem['content'] = $body['POEM_CONTENT'];

        return $poem;
    }


}