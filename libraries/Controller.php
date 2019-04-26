<?php

require_once('View.php');

class Controller
{
    protected $view;

    function __construct()
    {
        // echo 'libraries/Controller.php<br>';

        $this->view = new View();
    }

}