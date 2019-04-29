<?php

require_once('View.php');

class Controller
{
    protected $view;

    function __construct()
    {
        $this->view = new View();
    }

}