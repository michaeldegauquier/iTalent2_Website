<?php
$ROOT_PATH = ini_get("ROOT_PATH");

include_once($ROOT_PATH."/mnt/studentenhomes/michael.de.gauquier/public_html/iTalent2/Website Italent/objecten/Product.php");
//include_once($ROOT_PATH."/mnt/studentenhomes/tim.van.den.borre/public_html/Website Italent/objecten/Product.php");

include_once 'DatabaseFactory.php';
//include_once '../data/Product.php'; Werkt niet

class ProductDB {

    private static function getConnection(){
        return DatabaseFactory::getDatabase();
    }

    public static function getAllProducts(){

        $results = self::getConnection()->executeQuery("SELECT * FROM Product");
        $resultsArray = array();
        for($i = 0; $i < $results->num_rows; $i++ ){
            //Retrieves the current selected row
            $row = $results->fetch_array();
            //Make a Product
            $product = self::convertRowToObject($row);
            //add product to result array
            $resultsArray[$i] = $product;
        }

        return $resultsArray;

    }

    public static function getAllProductsByName($name){

        $results = self::getConnection()->executeQuery("SELECT * FROM Product WHERE Name = '?'", array($name));
        $resultsArray = array();
        for($i = 0; $i < $results->num_rows; $i++ ){
            //Retrieves the current selected row
            $row = $results->fetch_array();
            //Make a Product
            $product = self::convertRowToObject($row);
            //add product to result array
            $resultsArray[$i] = $product;
        }

        return $resultsArray;

    }

    public static function getLatestProducts(){

        $results = self::getConnection()->executeQuery("SELECT * FROM Product ORDER BY Id DESC LIMIT 4");

        $resultsArray = array();
        for($i = 0; $i < $results->num_rows; $i++ ){
            //Retrieves the current selected row
            $row = $results->fetch_array();
            //Make a Product
            $product = self::convertRowToObject($row);
            //add product to result array
            $resultsArray[$i] = $product;
        }

        return $resultsArray;

    }

    public static function deleteProductById($id){

        $results = self::getConnection()->executeQuery("DELETE FROM Product WHERE Id = ('?')", array($id));

        if($results->num_rows > 0) {
            return true;
        }
        else {
            return false;
        }
    }

    public static function getProductDetail($productId){
        $results = self::getConnection()->executeQuery("SELECT * FROM Product WHERE Id = '?'", array($productId));

        $resultsArray = array();
        for($i = 0; $i < $results->num_rows; $i++ ){

            $row = $results->fetch_array();

            $product = self::convertRowToObject($row);

            $resultsArray[$i] = $product;
        }

        return $resultsArray;

    }

    public static function getProductinSameCatg($productId){
        $results = self::getConnection()->executeQuery("SELECT * FROM Product WHERE Id != '?' AND Category =
                                                              (SELECT Category FROM Product WHERE Id = '?') 
                                                                ORDER BY rand() limit 4", array($productId, $productId));

        $resultsArray = array();
        for($i = 0; $i < $results->num_rows; $i++ ){

            $row = $results->fetch_array();

            $product = self::convertRowToObject($row);

            $resultsArray[$i] = $product;
        }

        return $resultsArray;

    }

    public static function getProductByName($prod){
        $results = self::getConnection()->executeQuery("SELECT LOWER(Name) FROM Product WHERE Name = LOWER('?')", array($prod));

        if($results->num_rows > 0) {
            return true;
        }
        else {
            return false;
        }
    }

    public static function insertProduct($product){
        echo 'Start insert';
        return self::getConnection()->executeQuery("INSERT INTO Product(Name, Price, Category, Description, Image) VALUES ('?','?','?','?','?')", array($product->Name, $product->Price, $product->Category, $product->Description, $product->Image));
    }

    public static function convertRowToObject($row){
        return new Product(
            $row['Id'],
            $row['Name'],
            $row['Price'],
            $row['Category'],
            $row['Description'],
            $row['Image']);
    }
}


// Cyclonecode. PHP Include/Require Relative path from WebRoot Issues
// https://stackoverflow.com/questions/14504076/php-include-require-relative-path-from-webroot-issues
// Geraadpleegd op 9 april 2019.
?>
