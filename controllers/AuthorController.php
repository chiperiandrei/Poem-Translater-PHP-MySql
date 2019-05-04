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

    public function loadAuthor($URL)
    {
        $authorIN = str_replace('-', ' ', $URL);


        $this->view->author_info = $this->packAuthor($this->model->loadAuthorInfo($authorIN));

        $this->view->poems_by_author = $this->model->showAllPoems($authorIN);
        
    }


    private function packAuthor($header)
    {
        $autor['nume'] = $header['NUME'];
        $autor['moarte'] = $header['DATA_NASTERE'];
        $autor['dead'] = $header['DATA_DECEDARE'];

        return $autor;
    }


}