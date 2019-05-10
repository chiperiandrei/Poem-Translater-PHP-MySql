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
    public function contact(){
        $pentru = 'potrtw@gmail.com';
        $firstname=$_POST["first-name"];
        $lastname=$_POST["last-name"];
        $email=$_POST["email"];
        $text=$_POST["text"];
        $subject = 'Contact form @ WEBSITE';
        $mesaj = "Hello! " . $firstname . " ".$lastname." told you : \n
            \" ".$text."\"
                ";
        $headers = 'From: webmaster@example.com' . "\r\n" .
            'Reply-To: '.$email. "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        mail($pentru, $subject, $mesaj, $headers);


    }
}