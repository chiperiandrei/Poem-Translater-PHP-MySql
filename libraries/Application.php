<?php

require_once('Session.php');

class Application
{
    public function __construct()
    {
        ob_start();

        Session::start();

        if (isset($_GET['url'])) {
            $URL = explode('/', $_GET['url']);
        } else {
            $URL[0] = 'index';
        }

        $URL[0] = ucwords(strtolower($URL[0])) . 'Controller';

        if (file_exists('controllers/' . $URL[0] . '.php')) {

            require_once('controllers/' . $URL[0] . '.php');

            // TODO: try to remove this lines from here
            $controller = new $URL[0]();
            // load view
            $controller->index();

            $count = count($URL);

            switch ($count)
            {
                case 1:
                    // TODO: check for existing files which can not be accessed
                    break;

                case 2:
                    if ($URL[0] === 'LoginController') {
                        $this->useLoginController($URL);
                    }
                    break;

                default:
                    header('Location: /login');
                    break;
            }

        } else {
            echo '404: Page not found';
        }
    }

    private function useLoginController($URL)
    {
        $controller = new $URL[0]();

        // user tries to login
        if ($URL[1] == 'connect') {
            if ($controller->model->connect()) {
                Session::unset('error');
                header('Location: /');
            } else {
                // username or password is incorrect
                Session::set('error', 'Your email or password was incorrect. Please try again.');
                header('Location: /login');
            }
        } else {
            // login link is corrupted
            header('Location: /login');
        }
    }
}

/*

// TODO: try to remove this lines from here
            $controller = new $URL[0]();
            // load view
            $controller->index();

            $count = count($URL);

            switch ($count)
            {
                case 1:
                    // TODO: check for existing files which can not be accessed
                    break;

                case 2:
                    if ($URL[0] === 'LoginController') {
                        $this->useLoginController($URL);
                    }
                    break;

                default:
                    header('Location: /login');
                    break;
            }
 */