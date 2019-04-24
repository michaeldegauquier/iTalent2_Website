<?php
session_start();
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
        <title>Home</title>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
                    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
                        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
                            <link rel="stylesheet" type="text/css" href="../layout/scss/home.css">
</head>
<div>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Fashion & Style</a>
            </div>
            <ul class="nav navbar-nav">
                <li class="active"><a href="home.php">Home</a></li>
                <li><a href="products.php">Products</a></li>
                <?php
                if((isset($_SESSION['loggedIn']) && !empty($_SESSION['loggedIn']) && $_SESSION['loggedIn'] !== "admin@gmail.com") || (!isset($_SESSION['loggedIn']) && empty($_SESSION['loggedIn']))) {
                    ?>
                    <li><a href="../pagesDB/contact_usMAIL.php">Contact us</a></li>
                    <li><a href="about_me.php">About Me</a></li>
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
                            <li><a href="../pagesDB/add_productDB.php">Add Product</a></li>
                            <li><a href="remove_product.php">Remove Product</a></li>
                            <li><a href="../pagesDB/add_categoryDB.php">Add Category</a></li>
                            <li><a href="remove_catagory.php">Remove Category</a></li>
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
                        <a href="./prices.php">
                            <span class="glyphicon glyphicon-scissors"></span> Prices
                        </a>
                    </li>
                    <li>
                        <a href="../pagesDB/shopping_cartDB.php">
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
                        <a href="orders.php">
                            <span class="glyphicon glyphicon-list-alt"></span> Your Orders
                        </a>
                    </li>
                    <?php
                } else if (isset($_SESSION['loggedIn']) && !empty($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === "admin@gmail.com") {
                    ?>
                    <li>
                        <a href="view_orders.php">
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
    <?php if (isset($_GET['order']) && $_GET['order'] == 'true') { ?>

        <p class="alert alert-success" style="margin: auto; text-align: center; width: 27%">Your order is successfully placed!</p> <br>

    <?php } ?>

    <?php
    if(isset($_SESSION['loggedIn']) && !empty($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === 'admin@gmail.com') {
        ?>
        <div class="jumbotron">
            <h1 class="display-4">Welcome Admin!</h1>
            <p class="lead">Please start with checking the Customer Orders!</p>
        </div>
        <?php
    }
    else
    {
        ?>
        <div class="jumbotron">
            <h1 class="display-4">OUR NEW STYLES</h1>
            <hr />
            <p>We offer a veriety of hair extension lengts, styles, colors & origins to satisfy your hair goals!</p>
        </div>
        <br>
    <div class="container">
        <div class="col-xs-6 col-md-6">
            <div class="thumbnail">
                <a href="../images/Blonde-Hair-Background-Wallpapers-20717.jpg" target="_blank">
                    <img src="../images/Blonde-Hair-Background-Wallpapers-20717.jpg">
                </a>
            </div>
        </div>
        <div class="col-xs-6 col-md-6">
            <div class="thumbnail">
                <a href="../images/Ombre-Long-Curly-Hairstyle.jpg" target="_blank">
                    <img src="../images/Ombre-Long-Curly-Hairstyle.jpg">
                </a>
            </div>
        </div>
        <div class="col-xs-6 col-md-6">
            <div class="thumbnail">
                <a href="../images/celeb-wallpaper-hd_3830401.jpg" target="_blank">
                    <img src="../images/celeb-wallpaper-hd_3830401.jpg">
                </a>
            </div>
        </div>
        <div class="col-xs-6 col-md-6">
            <div class="thumbnail">
                <a href="../images/949848.jpg" target="_blank">
                    <img src="../images/949848.jpg">
                </a>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
</body>
</html>





