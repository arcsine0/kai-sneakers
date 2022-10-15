<?php

class Product {
    private $conn;
    private $tableName = "products";

    private $id;
    private $name;
    private $description;
    private $price;
    private $categoryID;
    private $categoryName;
    private $created;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        // select query
        $query = "SELECT p.id, p.name, p.description, p.price, p.categoryID, p.created, c.name AS categoryName
                    FROM " . $this->tableName ." p
                    LEFT JOIN collections c
                    ON p.categoryID = c.id
                    ORDER BY p.created DESC";

        $qs = $this->conn->prepare($query);
        $qs->execute();

        return $qs;
    }
}

?>