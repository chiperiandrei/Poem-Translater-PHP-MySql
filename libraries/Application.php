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

            // TODO: try to remove these lines from here
            $controller = new $URL[0]();
            $controller->index();

            $count = count($URL);

            switch ($count) {
                case 1:
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
            http_response_code(404);
            require_once('views/errors/404.php');
            exit();
        }

    }

    private function useLoginController($URL)
    {
        $controller = new $URL[0]();

        // user tries to login
        if ($URL[1] == 'connect') {
            if ($controller->connect()) {
                Session::unset('error');
                header('Location: /');
            } else {
                // username or password is incorrect
                Session::set('error', 'Your email or password was incorrect. Please try again.');
                header('Location: /login');
            }
        } else if ($URL[1] == 'disconnect') {
            // user wants to disconnect
            $controller->disconnect();
            header('Location: /login');
        } else if ($URL[1] == 'signup') {
            if ($controller->signup()) {
                Session::unset('error-reg');
                Session::set('reg-ok', 'Congrats! You joined us !');
                header('Location: /login');

            } else {
                // username or password is incorrect
                Session::unset('reg-ok');
                Session::set('error-reg', 'Something went wrong :(. Please try again !!');
                header('Location: /login');

            }
        } else {
            // login link is corrupted
            header('Location: /login');
        }

    }
}