<?php
$ROOT_PATH = ini_get("ROOT_PATH");

include_once($ROOT_PATH."/mnt/studentenhomes/michael.de.gauquier/public_html/iTalent2/Website Italent/objecten/User.php");
//include_once($ROOT_PATH."/mnt/studentenhomes/tim.van.den.borre/public_html/Website Italent/objecten/User.php");

include_once 'DatabaseFactory.php';
//include_once '../data/User.php'; Werkt niet

class UserDB {

    private static function getConnection(){
        return DatabaseFactory::getDatabase();
    }

    // Kijken of het account bestaat
    public static function getUser($email, $password){

        $results = self::getConnection()->executeQuery("SELECT Email, Password FROM User WHERE Email = '?' AND Password = '?'", array($email, $password));

        if($results->num_rows > 0) {
            return true;
        }
        else {
            return false;
        }
    }

    // Kijken of email al bestaat
    public static function getUserByEmail($email){

        $results = self::getConnection()->executeQuery("SELECT Email FROM User WHERE Email = '?'", array($email));

        if($results->num_rows > 0) {
            return true;
        }
        else {
            return false;
        }
    }

    //Usergegevens opvragen met email
    public static function getUserDataByEmail($email){

        $results = self::getConnection()->executeQuery("SELECT Id, Email, Firstname, Lastname FROM User WHERE Email = '?'", array($email));

        $resultsArray = array();
        for($i = 0; $i < $results->num_rows; $i++ ){

            $row = $results->fetch_array();

            $user = self::convertRowToObject($row);

            $resultsArray[$i] = $user;
        }

        return $resultsArray;
    }

    // Alle emails uit de DB nemen
    public static function getUserEmail(){

        $results = self::getConnection()->executeQuery("SELECT Email FROM User");

        $resultsArray = array();
        for($i = 0; $i < $results->num_rows; $i++ ){

            $row = $results->fetch_array();

            $user = self::convertRowToObject($row);

            $resultsArray[$i] = $user;
        }

        return $resultsArray;
    }

    public static function insertUser($user){
        echo 'Start insert';
        return self::getConnection()->executeQuery("INSERT INTO User(Email, Password, Firstname, Lastname) VALUES ('?','?','?','?')", array($user->Email, $user->Password, $user->Firstname, $user->Lastname));
    }

    public static function convertRowToObject($row){
        return new User(
            $row['Id'] = 0,
            $row['Email'],
            $row['Password'] = '',
            $row['Firstname'],
            $row['Lastname']);
    }
}


// Cyclonecode. PHP Include/Require Relative path from WebRoot Issues
// https://stackoverflow.com/questions/14504076/php-include-require-relative-path-from-webroot-issues
// Geraadpleegd op 9 april 2019.
?>
