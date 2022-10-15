<?php

class Collection {
    private $conn;
    private $tableName = "collections";

    private $id;
    private $name;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        // select query
        $query = "SELECT c.id, c.name
                    FROM " . $this->tableName ." c";

        $qs = $this->conn->prepare($query);
        $qs->execute();

        return $qs;
    }
}

?>