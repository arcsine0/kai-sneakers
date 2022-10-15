<?php

// headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true ");
header("Access-Control-Allow-Methods: OPTIONS, GET, POST");
header("Access-Control-Allow-Headers: Content-Type, Depth, User-Agent, X-File-Size, X-Requested-With, If-Modified-Since, X-File-Name, Cache-Control");

// db conn
include_once "../config/db.php";
include_once "../objects/product.php";

$database = new Database();
$db = $database->getConn();

$product = new Product($db);

$qs = $product->read();
$rows = $qs->rowCount();

if ($rows>0) {
    $productsArr = array();
    $productsArr["records"] = array();

    while($row = $qs->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $productItem = array(
            "id" => $id,
            "name" => $name,
            "desc" => $description,
            "price" => $price,
            "categoryId" => $categoryID,
            "categoryName" => $categoryName
        );

        array_push($productsArr["records"], $productItem);
    }
    http_response_code(200);

    echo json_encode($productsArr);
} else {
    echo "Nothing";
}
?>