<?php

require_once('Session.php');
require_once('models/ApplicationModel.php');

class Application
{
    private $controller;
    private $model;

    public function __construct()
    {
        ob_start();
        Session::start();

        $this->model = new ApplicationModel();
        $this->model->generateRSS();

        if (isset($_GET['URL'])) {
            $URLs = explode('/', $_GET['URL']);
        } else {
            $URLs[0] = 'index';
        }

        $CustomController = ucwords(strtolower($URLs[0])) . 'Controller';

        if (file_exists("controllers/$CustomController.php")) {
            require_once("controllers/$CustomController.php");
            $this->controller = new $CustomController();
            $count = count($URLs);

            switch ($CustomController) {
                // Public pages
                case 'LoginController':
                    if ($count >= 2) {
                        $this->useLoginController($URLs);
                        break;
                    } else if ($count == 1) {
                        break;
                    }

                case 'IndexController':
                    if ($count == 2) {
                        $this->useIndexController($URLs);
                        break;
                    }
                    break;

                case 'PoemController':
                    if ($count >= 3) {
                        $this->usePoemController($URLs);
                        break;
                    } else {
                        $this->returnError(404);
                    }

                case 'AuthorController':
                    if ($count == 2) {
                        $this->useAuthorController($URLs);
                        break;
                    } else {
                        $this->returnError(404);
                    }

                case 'UserController':
                    if ($count >= 2) {
                        $this->useUserController($URLs);
                        break;
                    } else if ($count == 1) {
                        break;
                    }

                case 'ContactController':
                    if ($count == 2) {
                        $this->useContactController($URLs);
                        break;
                    } else if ($count == 1) {
                        break;
                    } else {
                        $this->returnError(404);
                    }

                // Authorized pages
                case 'SettingsController':
                    if (Session::exists('user_id')) {
                        if ($count >= 2) {
                            $this->useSettingsController($URLs);
                            break;
                        } else if ($count == 1) {
                            break;
                        }
                    } else {
                        $this->returnError(404);
                    }

                case 'FavoritesController':
                    if (Session::exists('user_id')) {
                        break;
                    } else {
                        $this->returnError(404);
                    }
            }

            $this->controller->index();

        } else {
            $this->returnError(404);
        }
    }

    private function returnError($code) {
        http_response_code($code);
        require_once("views/errors/$code.php");
        exit();
    }

    private function useIndexController($URLs) {
        if ($URLs[1] == 'search') {
            $this->controller->search();
            exit();
        } else if ($URLs[1] == 'add-poem') {
            $this->controller->addPoem();
            header('Location: /');
        } else if ($URLs[1] == 'delete-poem') {
            $this->controller->deletePoem();
            header('Location: /');
        } else if ($URLs[1] == 'add-author') {
            $this->controller->addAuthor();
            header('Location: /');
        } else if ($URLs[1] == 'delete-author') {
            $this->controller->deleteAuthor();
            header('Location: /');
        } else if ($URLs[1] == 'add-favorites') {
            $this->controller->addFavorites();
        } else if ($URLs[1] == 'delete-favorites') {
            $this->controller->deleteFavorites();
        } else {
            $this->returnError(404);
        }
    }

    private function useLoginController($URLs) {
        // user arrived at login page
        if ($URLs[1] == 'connect') {
            // user tries to login / connect
            if ($this->controller->connect()) {
                Session::unset('error-login');
                header('Location: /');
            } else {
                // username or password is incorrect
                Session::set('error-login', 'Your email or password was incorrect. Please try again.');
                header('Location: /login');
            }
        } else if ($URLs[1] == 'disconnect') {
            // user wants to disconnect
            $this->controller->disconnect();
            header('Location: /login');

        } else if ($URLs[1] == 'create-account') {
            // user want to create an account
            if ($this->controller->sign_up()) {
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
        } else if ($URLs[1] == 'forgot-password') {
            // user wants to discover his password
            if ($this->controller->forgot()) {
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

    private function usePoemController($URLs) {
        $count = count($URLs);
        if ($count == 3) {
            $this->controller->loadPoemOrTranslations($URLs[2], $URLs[1]);
        } else if ($count == 4) {
            if ($URLs[3] == 'add-comment') {
                $URLs[2] = $this->controller->addComment($URLs[2], $URLs[1]);
                header("Location: /poem/$URLs[1]/$URLs[2]");
            } else if ($URLs[3] == 'add-translation') {
                $URLs[2] = $this->controller->addTranslation();
                header("Location: /poem/$URLs[1]/$URLs[2]");
            } else if ($this->controller->loadTranslation($URLs[2], $URLs[1], $URLs[3]) == false) {
                $this->returnError(404);
            }
        } else if ($count == 5) {
            if ($URLs[3] == 'delete-comment') {
                $URLs[2] = $this->controller->deleteComment($URLs[2], $URLs[1], $URLs[4]);
                header("Location: /poem/$URLs[1]/$URLs[2]");
                exit();

            } else if ($URLs[4] == 'delete-translation') {
                $poem_link = $this->controller->deleteTranslation();
                header("Location: $poem_link");
                exit();
            } else if ($URLs[4] == 'wordpress') {
                $this->controller->loadPoemOrTranslations($URLs[2], $URLs[1]);
                $this->controller->shareWordpress();
            } else {
                // header("Location: /poem/$URLs[1]/$URLs[2]/$URLs[3]");
            }
        } else {
            header("Location: /poem/$URLs[1]/$URLs[2]/$URLs[3]");
        }
    }

    private function useAuthorController($URLs) {
        if (!empty($URLs[1])) {
            if ($this->controller->loadAuthorData($URLs[1]) == false) {
                $this->returnError(404);
            }
        } else {
            $this->returnError(404);
        }
    }

    private function useUserController($URLs) {
        if (count($URLs) == 2) {
            if ($this->controller->loadUserData($URLs[1]) == false) {
                $this->returnError(404);
            }
        } else {
            header("Location: /$URLs[0]/$URLs[1]");
        }
    }

    private function useContactController($URLs) {
        if ($URLs[1] == 'contact') {
            $this->controller->contact();
            header('Location: /contact');
        } else {
            $this->returnError(404);
        }
    }

    private function useSettingsController($URLs) {
        if (count($URLs) == 2) {
            $this->controller->settings($URLs);
        }
        header('Location: /settings');
    }
}