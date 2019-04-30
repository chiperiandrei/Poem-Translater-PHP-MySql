<?php

require_once('libraries/Controller.php');
require_once('libraries/Session.php');

class ContactController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        Session::set('current_page', 'contact');

        $this->view->render('contact/index');
    }
}