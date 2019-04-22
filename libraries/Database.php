<?php

require_once('config/database.php');

class Database extends PDO
{
    public function __construct(
        $username = PT_DB_USERNAME,
        $password = PT_DB_PASSWORD)
    {
        // echo 'libraries/Database.php<br>';

        $dsn = 'mysql:host=' . PT_DB_SERVER . ';dbname=' . PT_DB_NAME . ';charset=' . PT_DB_CHARSET;
        parent::__construct($dsn, $username, $password, null);
    }
}