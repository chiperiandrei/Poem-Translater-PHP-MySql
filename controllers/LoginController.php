<?php

require_once('libraries/Controller.php');
require_once('libraries/Session.php');

require_once('models/LoginModel.php');

class LoginController extends Controller
{
    public $model;
    // TODO: make a mothod called connect. In this way, $model won't be public.
    // $controller->model->connect() will be $controller->connect()
    // connect() will have access to the model

    public function __construct()
    {
        parent::__construct();

        // echo 'controllers/LoginController.php<br>';

        $this->model = new LoginModel();
        $this->view->poemHeader = $this->model->loadPoemHeader();
        $this->view->poemContent = $this->model->loadPoemContent();
    }

    public function index()
    {
        Session::set('current_page', 'login');

        $this->view->render('login/index');
    }
}