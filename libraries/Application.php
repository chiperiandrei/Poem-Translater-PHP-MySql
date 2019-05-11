<?php

require_once('Session.php');

class Application
{
    private $current_controller;

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
                    }
                    break;

                case 3:
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
        $this->current_controller->loadPoemOrTranslation($URL[2], $URL[1]);
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
        if ($URL[1] == 'edit-info') {
            if ($this->current_controller->editinfo()) {
                Session::unset('update-info-email-already-exists');
                Session::unset('update-info-username-already-exists');
                Session::unset('something-went-wrong-try-again-later');
                Session::unset('password-dont-match');
                header('Location: /settings');
            } else {
                Session::unset('update-info-complete');
                header('Location: /settings');
            }
        } else if ($URL[1] == 'edit-photo') {
            if ($this->current_controller->editphoto()) {
                Session::unset('error-upload');
                Session::unset('not-valid');
                Session::unset('not-image');
                header('Location: /settings');
            } else {
                Session::unset('upload-complete');
                header('Location: /settings');
            }
        }
    }
}