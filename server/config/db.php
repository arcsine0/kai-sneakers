<?php

class Database {
    private $host = "localhost:3307";
    private $dbName = "ecom_products";
    private $user = "root";
    private $pass = "";
    public $conn;

    public function getConn() {
        $this->conn = null;
        
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbName, $this->user, $this->pass);
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}

?>