<?php
session_start();

include_once '../database/ProductDB.php';

$id = $_GET['productId'];

if(!isset($_GET['productId']) && empty($_GET['productId'])) {
    header('location:../pages/remove_product.php');
}
else {
    $delete = ProductDB::deleteProductById($id);
}

header('location:../pages/remove_product.php');

?>