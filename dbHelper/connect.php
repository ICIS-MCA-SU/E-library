<?php

class connect
{
    private $dbHost = "localhost";
    private $dbUser="root";
    private $dbPass="";
    private $dbName="sulibrary";


//$conn = mysqli_connect($dbHost,$dbUser,$dbPass,$dbName);
    protected function __connect()
    {
        try {
            $dsn = 'mysql:host' . $this->dbHost . ';dbname=' . $this->dbName;
            $conn = new PDO($dsn, $this->dbUser, $this->dbPass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $conn;
        } catch (Exception $e) {
            echo "Not connected" . $e->getMessage();
        }
    }

}