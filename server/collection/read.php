<?php

// headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true ");
header("Access-Control-Allow-Methods: OPTIONS, GET, POST");
header("Access-Control-Allow-Headers: Content-Type, Depth, User-Agent, X-File-Size, X-Requested-With, If-Modified-Since, X-File-Name, Cache-Control");

// db conn
include_once "../config/db.php";
include_once "../objects/collection.php";

$database = new Database();
$db = $database->getConn();

$collection = new Collection($db);

$qs = $collection->read();
$rows = $qs->rowCount();

if ($rows>0) {
    $collectionsArr = array();
    $collectionsArr["records"] = array();

    while($row = $qs->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $collectionItem = array(
            "id" => $id,
            "name" => $name,
        );

        array_push($collectionsArr["records"], $collectionItem);
    }
    http_response_code(200);

    echo json_encode($collectionsArr);
} else {
    echo "Nothing";
}
?>