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
                if ($file) {
                    // if chosen file exists
                    if (Session::get('avatar_path') == 'storage/users/default/avatar.png') {
                        // if old avatar file was the default one
                        mkdir('storage/users/' . Session::get('username'));
                    } else {
                        // if old avatar was custom
                        unlink(Session::get('avatar_path'));
                    }
                    move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
                    $avatar_path = $target_file;

                    $this->model->updatePhoto($file, Session::get('user_id'));
                } else {
                    unlink(Session::get('avatar_path'));
                    rmdir('storage/users/' . Session::get('username'));
                    $avatar_path = 'storage/users/default/avatar.png';
                    $this->model->deletePhoto(2);
                }

                $avatar_type = pathinfo($avatar_path, PATHINFO_EXTENSION);
                $avatar_data = file_get_contents($avatar_path);
                $avatar_image = 'data:image/' . $avatar_type . ';base64,' . base64_encode($avatar_data);

                Session::set('avatar_path', $avatar_path);
                Session::set('avatar', $avatar_image);
            }
        } else if ($URL[1] == 'edit-info') {
            $new_username  = $_POST['username'];
            $new_firstName = $_POST['first-name'];
            $new_lastName  = $_POST['last-name'];
            $new_password  = $_POST['password'];

            if ($this->model->verifyPassword($new_password)) {
                if (!$this->model->verifyUsername($new_username)) {
                    $this->model->updateUsername($new_username);
                    Session::unset('settings-error');
                } else {
                    Session::set('settings-error', 'Username already exists!');
                }
                $this->model->updateFirstName($new_firstName);
                $this->model->updateLastName($new_lastName);
            } else {
                Session::set('settings-error', 'Wrong password!');
            }
        } else if ($URL[1] == 'edit-password') {
            $new_oldPassword = $_POST['old-password'];
            $new_password = $_POST['password'];
            $new_repeatPassword = $_POST['repeat-password'];

            if ($this->model->verifyPassword($new_oldPassword)) {
                if ($new_password == $new_repeatPassword) {
                    $this->model->updatePassword($new_password);
                    Session::unset('settings-error');
                } else {
                    Session::set('settings-error', 'These two passwords do not match!');
                }
            } else {
                Session::set('settings-error', 'Wrong password!');
            }
        }
    }
}