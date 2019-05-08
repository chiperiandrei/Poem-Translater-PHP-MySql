<?php

require_once('libraries/Controller.php');
require_once('libraries/Session.php');

require_once('models/LoginModel.php');

class LoginController extends Controller
{
    private $model;
    private $poemOneId, $poemTwoId;

    public function __construct()
    {
        parent::__construct();

        $this->model = new LoginModel();

        // TODO: these will be set by the admin
        // from the administration panel
        $this->poemOneId = 4;
        $this->poemTwoId = 1;

        $this->view->poemOne = $this->packPoem(
            $this->model->loadPoemHeader($this->poemOneId),
            $this->model->loadPoemBody($this->poemOneId)
        );

        $this->view->poemTwo = $this->packPoem(
            $this->model->loadPoemHeader($this->poemTwoId),
            $this->model->loadPoemBody($this->poemTwoId)
        );
    }

    public function index()
    {
        Session::set('current_page', 'login');

        $this->view->render('login/index');
    }

    public function connect()
    {
        return $this->model->verifyUser();
    }

    public function sign_up()
    {
        $email = $_POST["email"];
        $username = $_POST["username"];
        $password1 = $_POST["password"];
        $password2 = $_POST["repeat-password"];
        if ($this->model->verifyUserReg($email, $username)) {
            if ($password2==$password1) {
                return $this->model->register();
            }
            else
            {
                Session::set('password-not-same', 'Sorry! The passwords must be equals.');
                return false;
            }
        } else {

            return false;
        }
    }

    public function forgot()
    {
        $email = $_POST["email"];
        return $this->model->emailME($email);
    }

    public function disconnect()
    {
        Session::destroy();
    }

    private function packPoem($header, $body)
    {
        $poem['title'] = $header['POEM_TITLE'];
        $poem['author_name'] = $header['AUTHOR_NAME'];
        $poem['language'] = ($header['LANGUAGE'] === 'en' ? 'gb' : $header['LANGUAGE']);
        $poem['link'] = 'poem/' . $header['LANGUAGE'] . '/' .
            str_replace(' ', '-', $poem['title']);
        $poem['author_link'] = 'author/' .
            str_replace(' ', '-', $poem['author_name']);
        $poem['content'] = $body['POEM_CONTENT'];

        return $poem;
    }


}