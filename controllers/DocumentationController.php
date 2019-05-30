<?php

require_once('libraries/Controller.php');
require_once('libraries/Session.php');

class DocumentationController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        Session::set('current_page', 'documentation');

        $this->view->render('documentation/index');
    }
}