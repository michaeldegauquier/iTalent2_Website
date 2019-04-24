<?php
session_start();

include_once '../database/CategoryDB.php';

$id = $_GET['categoryId'];

if(!isset($_GET['categoryId']) && empty($_GET['categoryId'])) {
    header('location:../pages/remove_product.php');
}
else {
    $delete = CategoryDB::deleteCategoryById($id);
}

header('location:../pages/remove_catagory.php');

?>