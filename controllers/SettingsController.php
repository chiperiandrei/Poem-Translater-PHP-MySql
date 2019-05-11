<?php

require_once('libraries/Controller.php');
require_once('libraries/Session.php');

require_once('models/SettingsModel.php');

class SettingsController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->model = new SettingsModel();
    }

    public function index()
    {
        Session::set('current_page', 'contact');

        $this->view->render('settings/index');
    }

    public function editinfo()
    {
        $new_firstname = $_POST['first-name'];
        $new_lastname = $_POST['last-name'];
        $new_email = $_POST['email'];
        $new_username = $_POST['username'];
        $new_password1 = $_POST['password'];
        $new_password2 = $_POST['repeat-password'];
        if ($this->model->verifyEmail($new_email)) {
            if ($this->model->verifyUsername($new_username)) {
                if ($new_password1 == $new_password2) {
                    if ($this->model->updateInfo($new_firstname, $new_lastname, $new_email, $new_password1, $new_username)) {
                        Session::set('update-info-complete', 'CONGRATS !!!!!!!!!!!');
                        return true;
                    } else {
                        Session::set('something-went-wrong-try-again-later', ':((((( NOOOO');
                        return false;
                    }
                } else {
                    Session::set('password-dont-match', 'oh nonono');
                    return false;
                }
            } else return false;
        } else
            return false;

    }
}