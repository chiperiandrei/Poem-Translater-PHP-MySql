<?php


class View
{

    function __construct()
    {
        // echo 'libraries/View.php<br>';
    }

    public function render($name)
    {
        require_once('views/' . $name . '.php');
    }

}