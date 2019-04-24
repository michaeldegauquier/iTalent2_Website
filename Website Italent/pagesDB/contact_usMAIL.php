<?php
session_start();

if (isset($_SESSION['loggedIn']) && !empty($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === 'admin@gmail.com') {
    header('location:../pages/home.php');
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
        <title>Contact us</title>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
                    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
                        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
                            <link rel="stylesheet" type="text/css" href="../layout/scss/contact_us.css">
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
                    <li class="active"><a href="./contact_usMAIL.php">Contact us</a></li>
                    <li><a href="../pages/about_me.php">About Me</a></li>
                    <?php
                }
                ?>

                <!--Admin-->
                <?php
                if(isset($_SESSION['loggedIn']) && !empty($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === "admin@gmail.com") {
                    ?>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Admin privileges <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="add_productDB.php">Add Product</a></li>
                            <li><a href="../pages/remove_product.php">Remove Product</a></li>
                            <li><a href="add_categoryDB.php">Add Category</a></li>
                            <li><a href="../pages/remove_catagory.php">Remove Category</a></li>
                        </ul>
                    </li>
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
                if(isset($_SESSION['loggedIn']) && !empty($_SESSION['loggedIn']) && $_SESSION['loggedIn'] !== "admin@gmail.com") {
                    ?>
                    <li>
                        <a href="../pages/orders.php">
                            <span class="glyphicon glyphicon-list-alt"></span> Your Orders
                        </a>
                    </li>
                    <?php
                } else if (isset($_SESSION['loggedIn']) && !empty($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === "admin@gmail.com") {
                    ?>
                    <li>
                        <a href="../pages/view_orders.php">
                            <span class="glyphicon glyphicon-list-alt"></span> Customer Orders
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
                    <li>
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
                        <a href="../pagesDB/logoutDB.php">
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

$message = "";
$from = "";
$name1 = "";
$subject1 = "";

// Variabele voor validatie
$valid = true;

// Array waar alle errors in komen
$errors = [
    "name" => "",
    "email" => "",
    "subject" => "",
    "message" => ""
];

// Array waar alle default waarden in komen die correct zijn
$values = [
    "name" => "",
    "email" => "",
    "subject" => "",
    "message" => ""
];

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    // Als formulier niet ingevuld is
    include '../pages/contact_us.php';
}
else {
    // Valideer alle data
    if (empty($_POST['message'])) {
        $errors['message'] = "This field is required!";
    } else {
        $message = $_POST['message'];
        $values['message'] = $_POST['message'];
    }

    if (empty($_POST['email'])) {
        $errors['email'] = "This field is required!";
    } else {
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Invalid email format!";
        } else {
            $from = $_POST['email'];
            $values['email'] = $_POST['email'];
        }
    }

    if (empty($_POST['name'])) {
        $errors['name'] = "This field is required!";
    } else {
        if (!preg_match("/^[a-zA-Z ]*$/",$_POST['name'])) {
            $errors['name'] = "Name should only contain letters!";
        } else {
            $name1 = $_POST['name'];
            $values['name'] = $_POST['name'];
        }
    }

    if (empty($_POST['subject'])) {
        $errors['subject'] = "This field is required!";
    } else {
        $subject1 = $_POST['subject'];
        $values['subject'] = $_POST['subject'];
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
        include '../pages/contact_us.php';
    } else {
        $to = "michael.de.gauquier@gmail.com";
        $subject = $subject1;
        $name = $name1;
        $headers = "From: ". $from;

        mail($to,$subject,$message,$headers);

        header('location:../pagesDB/contact_usMAIL.php?message=send');
    }
}
?>

</body>
</html>

