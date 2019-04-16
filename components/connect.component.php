<?php

define('PT_DB_SERVER', 'poem-translater.tw');
define('PT_DB_USERNAME', 'PT_USER');
define('PT_DB_PASSWORD', 'PT1kNmTAzSVlVctM');
define('PT_DB_NAME', 'poem_translater');

$mysqli = new mysqli(PT_DB_SERVER, PT_DB_USERNAME, PT_DB_PASSWORD, PT_DB_NAME);

if ($mysqli === false) {
    exit ("ERROR: Could not connect to databese. " . $mysqli->connect_error);
}

session_start();

?>