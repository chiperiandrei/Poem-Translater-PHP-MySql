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

    public function settings($URL)
    {
        if ($URL[1] == 'edit-photo') {
            $file = basename($_FILES["file"]["name"]);
            $target_file = 'storage/users/' . Session::get('username') . '/' . $file;

            if(isset($_POST["submit"])) {
                if (Session::get('avatar') == '/storage/users/default/avatar.png') {
                    mkdir('storage/users/' . Session::get('username'));
                } else {
                    unlink('./' . Session::get('avatar'));
                }
                move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
                Session::print('avatar');
                Session::set('avatar', $target_file);

                $this->model->updatePhoto($file, Session::get('user_id'));
            }
        } else if ($URL[1] == 'edit-info') {
            $new_username = $_POST['username'];
            $new_firstName = $_POST['first-name'];
            $new_lastName = $_POST['last-name'];
            $new_password = $_POST['password'];

            if ($this->model->verifyPassword($new_password)) {
                if (!$this->model->verifyUsername($new_username)) {
                    $this->model->updateUsername($new_username);
                } else {
                    // Username exists
                }
                $this->model->updateFirstname($new_firstName);
                $this->model->updateLastname($new_lastName);
            } else {
                // Wrong password
            }
        } else if ($URL[1] == 'edit-password') {
            $new_oldPassword = $_POST['old-password'];
            $new_password = $_POST['password'];
            $new_repeatPassword = $_POST['repeat-password'];

            if ($this->model->verifyPassword($new_oldPassword)) {
                if ($new_password == $new_repeatPassword) {
                    $this->model->updatePassword($new_password);
                }
            } else {
                // Wrong password
            }
        }
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