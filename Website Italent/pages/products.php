<?php
session_start();
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
        <title>Products</title>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
                    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
                        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
                            <script src="../JQ/addToCart.js" type="text/javascript"></script>
                                <script src="../JQ/filterProducts.js" type="text/javascript"></script>
                                    <link rel="stylesheet" type="text/css" href="../layout/scss/products.css">
</head>
<div>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Fashion & Style</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="home.php">Home</a></li>
                <li class="active"><a href="products.php">Products</a></li>
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

<h5 style="text-align: center;">Filter on Category:</h5>

<select class="form-control" style="width: 25%; margin: auto" id="category" name="category" class="filter" required>
    <option>None</option>

    <?php
    include_once '../database/CategoryDB.php';
    $allCategories = CategoryDB::getAllCategories();
    foreach ($allCategories as $allCategory) {
        ?>
        <option><?php echo $allCategory->Category; ?></option>
        <?php
    }
    ?>

</select>

<br/>

<div class="container">
    <?php
    include_once '../database/ProductDB.php';
    $allProducts = ProductDB::getAllProducts();
    foreach ($allProducts as $allProduct) {
    ?>
        <div class="item col-xs-12 col-md-4 filter" id="<?php echo $allProduct->Category; ?>">
            <div class="thumbnail">
                <?php echo '<img class="card-img-top" alt="Card image" style="width:100%" src="data:Image/jpg;base64,' . base64_encode($allProduct->Image) . '" />'; ?>
                <div>
                    <h4 id="name"><?php echo $allProduct->Name; ?></h4>
                    <div class="row">
                        <div class="col-xs-12 col-md-12" id="category">
                            <p id="category">Category: <?php echo $allProduct->Category; ?></p>
                        </div>

                        <div class="col-xs-12 col-md-12">
                            <p id="price">Price: €<?php echo $allProduct->Price; ?></p>
                        </div>

                        <div class="col-xs-12 col-md-12 col-xl-12">
                            <p id="description"><?php echo $allProduct->Description; ?></p>
                        </div>
                        <div class="col-xs-12 col-md-12">
                            <a href="#" class="btn btn-primary shoppingCartButton" id="<?php echo $allProduct->Id; ?>">
                                <span class="glyphicon glyphicon-shopping-cart"></span> Order this product
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
    <br>
</div>
</body>
</html>

