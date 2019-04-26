<?php

require_once('libraries/Controller.php');
require_once('libraries/Session.php');

require_once('models/IndexModel.php');

class IndexController extends Controller
{
    private $model;
    private $poems;

    public function __construct()
    {
        parent::__construct();

        // echo 'controllers/IndexModel.php<br>';
    }

    public function index()
    {
        Session::set('current_page', 'index');

        $this->model = new IndexModel();
        $this->poems = $this->model->loadPoems();

        if (Session::exists('user_id')) {

            echo 'Welcome ' . Session::get('first_name') . ' ' . Session::get('last_name') . '<br>';
        }

        $this->view->render('index/index');
    }
}