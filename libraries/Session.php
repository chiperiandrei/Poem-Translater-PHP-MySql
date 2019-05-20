<?php


class Session
{
    public static function start()
    {
        session_start();
    }

    public static function destroy()
    {
        unset($_SESSION);
        session_destroy();
    }

    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function unset($key)
    {
        unset($_SESSION[$key]);
    }

    public static function get($key)
    {
        return $_SESSION[$key];
    }

    public static function exists($key)
    {
        return isset($_SESSION[$key]) && !empty($_SESSION[$key]);
    }

    public static function print($key)
    {
        if ($key == 'current_page') {
            if ($_SESSION[$key] == 'index') {
                echo '/';

            }
        } else {
            echo $_SESSION[$key];
        }
    }
}