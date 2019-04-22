<?php

require_once('libraries/Controller.php');
require_once('libraries/Session.php');

class IndexController extends Controller
{
    function __construct()
    {
        parent::__construct();

        // echo 'controllers/IndexController.php<br>';
    }

    function index()
    {
        Session::set('current_page', 'index');

        $this->view->render('index/index');

        if (Session::exists('user_id')) {

            echo 'Bun venit ' . Session::get('first_name') . ' ' . Session::get('last_name') . '<br>';
        }

    }
}