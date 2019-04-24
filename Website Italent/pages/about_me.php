<?php
session_start();

if (isset($_SESSION['loggedIn']) && !empty($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === 'admin@gmail.com') {
    header('location:./home.php');
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
        <title>About me</title>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
                    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
                        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
                            <link rel="stylesheet" type="text/css" href="../layout/scss/about_me.css">
</head>
<script src="../JQ/addToCart.js" type="text/javascript"></script>
<div>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Fashion & Style</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="home.php">Home</a></li>
                <li><a href="products.php">Products</a></li>
                <?php
                if((isset($_SESSION['loggedIn']) && !empty($_SESSION['loggedIn']) && $_SESSION['loggedIn'] !== "admin@gmail.com") || (!isset($_SESSION['loggedIn']) && empty($_SESSION['loggedIn']))) {
                    ?>
                    <li><a href="../pagesDB/contact_usMAIL.php">Contact us</a></li>
                    <li class="active" ><a href="about_me.php">About Me</a></li>
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
    <div class="jumbotron">
        <h1 class="display-4">Mijn naam is Annick Steen</h1>
        <p class="lead">Deze pagina verteld wat meer over mij en wat ik doe in het leven.</p>
        <hr class="my-4">
        <p>
            Al van mijn 9 jaar wist ik dat ik kapster wou worden, voor een baas werken gaf mij niet genoeg voldoening. Ik was gefocust op het beroep zelf, met haar bezig zijn en de mensen blij maken. Transformaties en hairlooks creëren is altijd mijn doel geweest. Mijn specialiteiten zijn feest- en opsteekkapsels.
            Het is leuk om met haar te werken omdat ik graag met verschillende mensen bezig van verschillende culturen, leeftijden en klassen. Ik vind het geweldig om nieuwe kapsels uit te proberen en innovatieve creaties.
            Ik mik op een zo breed mogelijk cliënteel, anderstaligen, dames en heren. Ik schrik niet voor uitdagingen.
        </p>
    </div>
    <hr />
    <div class="container">
        <div class="col-xs-6 col-md-3">
            <div class="thumbnail">
                <a href="../images/57000855_293549218222852_5030471992944361472_n.jpg" target="_blank">
                    <img src="../images/57000855_293549218222852_5030471992944361472_n.jpg">
                </a>
            </div>
        </div>
        <div class="col-xs-6 col-md-3">
            <div class="thumbnail">
                <a href="../images/57015561_2238842376340625_5447519326045208576_n.jpg" target="_blank">
                    <img src="../images/57015561_2238842376340625_5447519326045208576_n.jpg">
                </a>

            </div>
        </div>
        <div class="col-xs-6 col-md-3">
            <div class="thumbnail">
                <a href="../images/57026436_432209854253304_594684298540351488_n.jpg" target="_blank">
                    <img src="../images/57026436_432209854253304_594684298540351488_n.jpg">
                </a>
            </div>
        </div>
        <div class="col-xs-6 col-md-3">
            <div class="thumbnail">
                <a href="../images/57190363_534812857045450_8555670201905971200_n.jpg" target="_blank">
                    <img src="../images/57190363_534812857045450_8555670201905971200_n.jpg">
                </a>
            </div>
        </div>
    </div>
    <hr />
</body>
</html>

