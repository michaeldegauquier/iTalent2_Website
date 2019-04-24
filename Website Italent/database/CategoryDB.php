<?php
$ROOT_PATH = ini_get("ROOT_PATH");

include_once($ROOT_PATH."/mnt/studentenhomes/michael.de.gauquier/public_html/iTalent2/Website Italent/objecten/Category.php");
//include_once($ROOT_PATH."/mnt/studentenhomes/tim.van.den.borre/public_html/Website Italent/objecten/Category.php");

include_once 'DatabaseFactory.php';
//include_once '../data/Category.php'; Werkt niet

class CategoryDB {

    private static function getConnection(){
        return DatabaseFactory::getDatabase();
    }

    public static function getAllCategories(){

        $results = self::getConnection()->executeQuery("SELECT Id, Category FROM Category");
        $resultsArray = array();
        for($i = 0; $i < $results->num_rows; $i++ ){

            $row = $results->fetch_array();

            $category = self::convertRowToObject($row);

            $resultsArray[$i] = $category;
        }

        return $resultsArray;

    }

    public static function getCategoryByName($catg){

        $results = self::getConnection()->executeQuery("SELECT LOWER(Category) FROM Category WHERE Category = LOWER('?')", array($catg));

        if($results->num_rows > 0) {
            return true;
        }
        else {
            return false;
        }
    }

    public static function deleteCategoryById($id){

        $results = self::getConnection()->executeQuery("DELETE FROM Category WHERE Id = ('?')", array($id));

        if($results->num_rows > 0) {
            return true;
        }
        else {
            return false;
        }
    }

    public static function insertCategory($category){
        echo 'Start insert';
        return self::getConnection()->executeQuery("INSERT INTO Category(Category) VALUES ('?')", array($category->Category));
    }

    public static function convertRowToObject($row){
        return new Category(
            $row['Id'],
            $row['Category']);
    }
}


// Cyclonecode. PHP Include/Require Relative path from WebRoot Issues
// https://stackoverflow.com/questions/14504076/php-include-require-relative-path-from-webroot-issues
// Geraadpleegd op 9 april 2019.
?>
