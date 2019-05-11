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

    public function editphoto()
    {
        $user_id = Session::get('user_id');
        $target_dir = 'storage/users/' . Session::get('username') . '/';
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check == false) {
            Session::set('not-image', 'The file is not an image');
            return false;
        }
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {
            Session::set('not-valid', 'The file is not an image. We re accept only JPG,JPEG,PNG & GIF IMAGES');
            return false;
        }
        if ($this->model->updatePhoto($_FILES["fileToUpload"]["name"], $user_id)) {
            move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
            Session::set('upload-complete', 'Image updated');
            return true;

        } else {
            Session::set('error-upload', 'There was ann error uploading your file');
        }

    }
}