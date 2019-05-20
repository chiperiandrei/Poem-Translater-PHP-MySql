<?php


require_once('libraries/Controller.php');
require_once('libraries/Session.php');

require_once('models/AuthorModel.php');

class AuthorController extends Controller
{
    private $model;

    public function __construct()
    {
        parent::__construct();

        $this->model = new AuthorModel();
    }

    public function index()
    {
        Session::set('current_page', 'author');

        $this->view->render('author/index');
    }

    public function getLink($limba, $nume)
    {
        $line = '../poem/' . strtolower($limba) . '/' .
            str_replace(' ', '+', $nume);
        return $line;
    }


    public function loadAuthor($URL)
    {


        $authorIN = str_replace('-', ' ', $URL);

        $this->view->author_info = $this->model->loadAuthorInfo($authorIN);

        $this->view->poems_by_author = $this->model->showAllPoems($authorIN);

        $this->view->photo = $this->model->loadAuthorPhoto($authorIN);

        foreach ($this->view->poems_by_author as $rK => $rV) {
            $this->view->poems_by_author[$rK]["link"] = $this->getLink($rV['LIMBA'], $rV['title']);;
        }
    }


}