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
        $this->view->avatar = [];
        $this->view->userInformation = [];
        if ($this->model->verifyUsername($user)) {

            $this->view->userInformation = $this->model->selectAllUserInfo($user);

            $this->view->avatar = $this->model->getAvatar();

            $this->view->poems = $this->packPoems(
                $this->model->loadPoems(),
                $this->view->userInformation['USERNAME']
            );

        } else {
            http_response_code(404);
            require_once('views/errors/404.php');
            exit();
        }
    }

    private function packPoems($header, $username)
    {
        $result = [];
        $i = 0;

        if ($header != null) {
            foreach ($header as $poem) {
                $result[$i]['title'] = $poem['TITLE'];
                $title = str_replace(' ', '+', $poem['TITLE']);
                $result[$i]['link'] = '/poem/' . strtolower($poem['LANGUAGE']) . '/' . $title . '/' . $username;
                $result[$i]['language'] = ($poem['LANGUAGE'] === 'EN' ? 'gb' : strtolower($poem['LANGUAGE']));
                $i++;
            }
        } else {
            return null;
        }

        return $result;
    }
}