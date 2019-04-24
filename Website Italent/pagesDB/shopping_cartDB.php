<?php
session_start();

if (isset($_SESSION['loggedIn']) && !empty($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === 'admin@gmail.com') {
    header('location:../pages/home.php');
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
        <title>Shopping Cart</title>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
                    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
                        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
                            <script src="../JQ/removeFromCart.js" type="text/javascript"></script>
                                <link rel="stylesheet" type="text/css" href="../layout/scss/shopping_cart.css">
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
                    <li class="active">
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
                        <a href="../pagesDB/registerDB.php">
                            <span class="glyphicon glyphicon-log-in"></span> Register
                        </a>
                    </li>
                    <li>
                        <a href="../pagesDB/loginDB.php">
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
include_once '../database/ProductDB.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "<script>console.log('No POST!')</script>";
}
else {
    if(!isset($_SESSION['productIds']) && empty($_SESSION['productIds'])) {
        $_SESSION['productIds'] = array();
    }

    $productId = "";
    $productIdRemove = "";

    // check productId
    if(!isset($_POST['productId']) && empty($_POST['productId'])) {
        echo ' Geen Id! ';
    }
    else {
        $productId = $_POST['productId'];
        $bool = true;

        for($i = 0; $i < count($_SESSION['productIds']); $i++) {
            if($_SESSION['productIds'][$i] == $productId) {
                $bool = false;
            }
        }

        // Als product nog niet bestaat, wordt het toegevoegd
        if ($bool == true) {
            array_push($_SESSION['productIds'], $productId);
        }
        else {
            echo "<script>alert('Product is already in Shopping Bag!');</script>";
        }
    }

    // check productIdRemove
    if(!isset($_POST['productIdRemove']) && empty($_POST['productIdRemove'])) {
        echo ' Geen Id! ';
    }
    else {
        $productIdRemove = $_POST['productIdRemove'];
        for($i = 0; $i < count($_SESSION['productIds']); $i++) {
            if($_SESSION['productIds'][$i] == $productIdRemove) {
                array_splice($_SESSION['productIds'], $i, 1);
            }
        }
    }
}

include '../pages/shopping_cart.php';

?>

</body>
</html>


<!--
// Stackoverflow. Php delete an element from an array. Geraadpleegd via
// https://stackoverflow.com/questions/369602/php-delete-an-element-from-an-array
// Geraadpleegd op 11 april 2019

// Stackoverflow. Array as session variable php. Geraadpleegd op
// https://stackoverflow.com/questions/2306159/array-as-session-variable
// Geraadpleegd op 11 april 2019
-->