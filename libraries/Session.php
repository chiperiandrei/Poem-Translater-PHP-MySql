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
        return isset($_SESSION[$key]);
    }

    public static function print($key)
    {
        echo $_SESSION[$key];
    }
}