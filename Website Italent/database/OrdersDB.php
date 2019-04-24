<?php
$ROOT_PATH = ini_get("ROOT_PATH");

include_once($ROOT_PATH."/mnt/studentenhomes/michael.de.gauquier/public_html/iTalent2/Website Italent/objecten/Orders.php");
//include_once($ROOT_PATH."/mnt/studentenhomes/tim.van.den.borre/public_html/Website Italent/objecten/Orders.php");

include_once 'DatabaseFactory.php';
//include_once '../data/Order.php'; Werkt niet

class OrdersDB {

    private static function getConnection(){
        return DatabaseFactory::getDatabase();
    }

    public static function getAllOrders(){

        $results = self::getConnection()->executeQuery("SELECT o.Id, o.UserEmail, p.Name, o.OrderDate
                                                            FROM `Orders` o JOIN Product p ON(o.ProductId = p.Id)");
        $resultsArray = array();
        for($i = 0; $i < $results->num_rows; $i++ ){
            //Retrieves the current selected row
            $row = $results->fetch_array();
            //Make an Order
            $order = self::convertRowToObject($row);
            //add order to result array
            $resultsArray[$i] = $order;
        }

        return $resultsArray;

    }

    public static function getAllOrdersByEmail($email){

        $results = self::getConnection()->executeQuery("SELECT o.Id, o.UserEmail, p.Name, o.OrderDate
                                                            FROM `Orders` o JOIN Product p ON(o.ProductId = p.Id)
                                                            WHERE o.UserEmail = '?'", array($email));
        $resultsArray = array();
        for($i = 0; $i < $results->num_rows; $i++ ){
            //Retrieves the current selected row
            $row = $results->fetch_array();
            //Make an Order
            $order = self::convertRowToObject($row);
            //add order to result array
            $resultsArray[$i] = $order;
        }

        return $resultsArray;

    }

    public static function insertOrder($order){
        echo 'Start insert';
        return self::getConnection()->executeQuery("INSERT INTO `Orders`(UserEmail, ProductId) VALUES ('?','?')", array($order->UserEmail, $order->ProductName));
    }

    public static function convertRowToObject($row){
        return new Orders(
            $row['Id'],
            $row['UserEmail'],
            $row['Name'],
            $row['OrderDate']);
    }
}


// Cyclonecode. PHP Include/Require Relative path from WebRoot Issues
// https://stackoverflow.com/questions/14504076/php-include-require-relative-path-from-webroot-issues
// Geraadpleegd op 11 april 2019.
?>
