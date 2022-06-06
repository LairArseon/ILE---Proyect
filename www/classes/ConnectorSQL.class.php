<?php

class ConnectorSQL 
{

    private $connection = NULL;
    private $publicConnection = NULL;

    public function __construct() {
        $this->connection = mysqli_connect('db', 'root', 'root', 'ILE_DB');
        $this->publicConnection = mysqli_connect('db', 'foreigner', 'test', 'ILE_DB');
    }

    public function getCon () {
        return $this->connection;
    }

    public function getPubCon () {
        return $this->publicConnection;
    }

    public function publicSubmission () {
        
    }
}