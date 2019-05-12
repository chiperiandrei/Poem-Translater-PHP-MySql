<?php

require_once('libraries/Controller.php');
require_once('libraries/Session.php');

require_once('models/UserModel.php');

class UserController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->model = new UserModel();
    }

    public function index()
    {
        Session::set('current_page', 'contact');

        $this->view->render('user/index');
    }

    /**
     * @param $user
     */
    public function userInfo($user)
    {
        $this->view->avatar=[];
        $this->view->userInformation=[];
        if ($this->model->verifyUsername($user)) {
            var_dump(
            $this->view->userInformation = $this->model->selectAllUserInfo($user));

            $this->view->avatar = $this->model->getAvatar();
        } else {
            http_response_code(404);
            require_once('views/errors/404.php');
            exit();
        }

    }

}