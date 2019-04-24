<?php
session_start();
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
        <title>Login</title>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
                    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
                        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
                            <link rel="stylesheet" type="text/css" href="../layout/scss/register_login.css">
</head>
<div>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Fashion & Style</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="../pages/home.php">Home</a></li>
                <li><a href="../pages/products.php">Products</a></li>
                <?php
                if((isset($_SESSION['loggedIn']) && !empty($_SESSION['loggedIn']) && $_SESSION['loggedIn'] !== "admin@gmail.com") || (!isset($_SESSION['loggedIn']) && empty($_SESSION['loggedIn']))) {
                    ?>
                    <li><a href="./contact_usMAIL.php">Contact us</a></li>
                    <li><a href="../pages/about_me.php">About Me</a></li>
                    <?php
                }
                ?>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php
                if((isset($_SESSION['loggedIn']) && !empty($_SESSION['loggedIn']) && $_SESSION['loggedIn'] !== "admin@gmail.com") || (!isset($_SESSION['loggedIn']) && empty($_SESSION['loggedIn']))) {
                    ?>
                    <li>
                        <a href="../pages/prices.php">
                            <span class="glyphicon glyphicon-scissors"></span> Prices
                        </a>
                    </li>
                    <li>
                        <a href="./shopping_cartDB.php">
                            <span class="glyphicon glyphicon-shopping-cart"></span> Shopping Cart
                        </a>
                    </li>
                    <?php
                }
                ?>

                <?php
                if(!isset($_SESSION['loggedIn']) && empty($_SESSION['loggedIn'])) {
                    ?>
                    <li>
                        <a href="./registerDB.php">
                            <span class="glyphicon glyphicon-log-in"></span> Register
                        </a>
                    </li>
                    <li class="active">
                        <a href="./loginDB.php">
                            <span class="glyphicon glyphicon-log-in"></span> Login
                        </a>
                    </li>
                    <?php
                } else {
                    ?>
                    <li>
                        <a href="#">
                            <span class="glyphicon glyphicon-user"></span>
                            <?php
                            include_once '../database/UserDB.php';
                            $email = $_SESSION['loggedIn'];
                            $user1 = UserDB::getUserDataByEmail($email);
                            foreach ($user1 as $all) {
                                echo $all->Email;
                            }
                            ?>
                        </a>
                    </li>
                    <li>
                        <a href="./logoutDB.php">
                            <span class="glyphicon glyphicon-log-out"></span> Logout
                        </a>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </div>
    </nav>
</div>
<body>

<?php
include_once '../database/UserDB.php';

$email = "";
$password = "";
$hashEmail = "";

// Variabele voor validatie
$valid = true;

// Array waar alle errors in komen
$errors = [
    "loginEmail" => "",
    "loginPassword" => "",
    "loginIncorrect" => ""
];

// Array waar alle default waarden in komen die correct zijn
$values = [
    "loginEmail" => ""
];

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    if(isset($_SESSION['loggedIn']) && !empty($_SESSION['loggedIn'])) {
        header('location:../pages/home.php');
    }
    else {
        // Als formulier niet ingevuld is
        include '../pages/login.php';
    }
}
else {
    if (empty($_POST['loginEmail'])) {
        $errors['loginEmail'] = "This field is required!";
    } else {
        $description = $_POST['loginEmail'];
        $values['loginEmail'] = $_POST['loginEmail'];
        $email = $_POST['loginEmail'];
    }

    if (empty($_POST['loginPassword'])) {
        $errors['loginPassword'] = "This field is required!";
    } else {
        $description = $_POST['loginPassword'];
        $password = $_POST['loginPassword'];
    }

    // Als er nog errors zijn, zet de variabele $valid op false
    foreach($errors as $error) {
        if(!empty($error)) {
            $valid = false;
            break;
        }
    }

    // Als het formulier niet valid is wordt formulier terug getoond met foutboodschappen
    if(!$valid) {
        include '../pages/login.php';
    } else {
        if (UserDB::getUser($email, $password) == false) {
            $errors['loginIncorrect'] = '<p class="alert alert-danger" style="margin: auto; text-align: center; width: 26%">E-mail or password is incorrect!</p> <br>';
            include '../pages/login.php';
        }
        else {
            $_SESSION['loggedIn'] = $email;

            header('location:../pages/home.php');
        }
    }
}

?>
</body>
</html>
