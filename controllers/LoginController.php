<?php

require_once('libraries/Controller.php');
require_once('libraries/Session.php');

require_once('models/LoginModel.php');

class LoginController extends Controller
{
    public $model;

    public function __construct()
    {
        parent::__construct();

        // echo 'controllers/LoginController.php<br>';

        $this->model = new LoginModel();
    }

    public function index()
    {
        Session::set('current_page', 'login');

        $this->view->render('login/index');
    }
}