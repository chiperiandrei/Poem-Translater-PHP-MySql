<?php

require_once('libraries/Model.php');

class IndexModel extends Model
{
    public function __construct()
    {
        parent::__construct();

        // echo 'models/IndexModel.php<br>';
    }

    public function loadPoems()
    {
        $SQL = 'SELECT ID, ID_AUTHOR, TITLE, LANGUAGE FROM poems';

        $result = [];

        foreach ($this->db->query($SQL) as $row) {
            array_push($result, $row);
        }

        return $result;
    }
}