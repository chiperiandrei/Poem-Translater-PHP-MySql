<?php

require_once('Session.php');
require_once('models/ApplicationModel.php');

class Application
{
    private $current_controller;
    private $model;

    public function __construct()
    {
        $this->model = new ApplicationModel();
        $this->model->generateRSS();

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

            $controller = new $URL[0]();
            $this->current_controller = $controller;

            $count = count($URL);

            switch ($count) {
                case 1:
                    break;

                case 2:
                    if ($URL[0] === 'LoginController') {
                        $this->useLoginController($URL);
                    } else if ($URL[0] === 'AuthorController') {
                        $this->useAuthorController($URL);
                    } else if ($URL[0] === 'ContactController') {
                        $this->useContactController($URL);
                    } else if ($URL[0] === 'SettingsController') {
                        $this->useSettingsController($URL);
                    } else if ($URL[0] === 'UserController') {
                        $this->useUserController($URL);
                    }
                    break;

                case 3:
                    if ($URL[0] === 'PoemController') {
                        $this->usePoemController($URL);
                    }
                    break;
                case 4:
                    if ($URL[0] === 'PoemController') {
                        $this->usePoemController($URL);
                    }
                    break;
                case 5:
                    if ($URL[0] === 'PoemController') {
                        $this->usePoemController($URL);
                    }
                    break;

                default:
                    header('Location: /login');
                    break;
            }

            $controller->index();

        } else {
            http_response_code(404);
            require_once('views/errors/404.php');
            exit();
        }
    }

    private function useLoginController($URL)
    {
        $controller = new $URL[0]();

        // user arrived at login page
        if ($URL[1] == 'connect') {
            // user tries to login / connect
            if ($controller->connect()) {
                Session::unset('error-login');
                header('Location: /');
            } else {
                // username or password is incorrect
                Session::set('error-login', 'Your email or password was incorrect. Please try again.');
                header('Location: /login');
            }
        } else if ($URL[1] == 'disconnect') {

            // user wants to disconnect
            $controller->disconnect();
            header('Location: /login');

        } else if ($URL[1] == 'create-account') {
            // user want to create an account
            if ($controller->sign_up()) {
                Session::unset('error-register');
                Session::unset('email-is-used');
                Session::unset('password-not-same');
                Session::unset('captcha-wrong');
                Session::set('log-register', 'Congratulations! You joined us.');
                header('Location: /login');
            } else {
                Session::unset('log-register');
                Session::set('error-register', 'Something went wrong. Please try again.');
                Session::set('email-is-used', 'Sorry! The email or the username is unavailable');
                header('Location: /login');
            }
        } else if ($URL[1] == 'forgot-password') {
            // user wants to discover his password
            if ($controller->forgot()) {
                Session::unset('error-forgot');
                header('Location: /login');
            } else {
                Session::unset('log-register');
                Session::unset('cui');
                header('Location: /login');
            }
        } else {
            // login link is corrupted
            header('Location: /login');
        }
    }

    private function usePoemController($URL)
    {
        switch (count($URL)) {
            case 3:
                $this->current_controller->loadPoemOrTranslations($URL[2], $URL[1]);
                break;

            case 4:
                if ($URL[3] == 'add-comment') {
                    $this->current_controller->addComment($URL[2], $URL[1]);
                    $poem_title = str_replace(' ', '+', $URL[2]);
                    header('Location: /poem/'. $URL[1] . '/' . $poem_title);
                } else {
                    $this->current_controller->loadTranslation($URL[2], $URL[1], $URL[3]);
                }
                break;

            case 5:
                if ($URL[3] == 'delete-comment') {
                    $this->current_controller->deleteComment($URL[2], $URL[1], $URL[4]);
                    $poem_title = str_replace(' ', '+', $URL[2]);
                    header('Location: /poem/'. $URL[1] . '/' . $poem_title);
                } else if ($URL[4] == 'wordpress') {
                    $this->current_controller->shareWordpress($URL[1], $URL[2]);
                }
                break;
        }
    }

    private function useContactController($URL)
    {
        if ($URL[1] == 'contact' && count($URL) == 2) {
            $this->current_controller->contact();
            header('Location: /contact');
        }
    }

    private function useAuthorController($URL)
    {
        $this->current_controller->loadAuthor($URL[1]);
    }

    private function useSettingsController($URL)
    {
        $this->current_controller->settings($URL);
        header('Location: /settings');
    }

    private function useUserController($URL)
    {
        $this->current_controller->userInfo($URL[1]);
    }


}