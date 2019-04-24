<?php
session_start();

if(!isset($_SESSION['loggedIn']) && empty($_SESSION['loggedIn'])) {
    header('location:./home.php');
}

if ($_SESSION['loggedIn'] !== 'admin@gmail.com') {
    header('location:./home.php');
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
        <title>Remove product</title>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
                    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
                        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
                            <link rel="stylesheet" type="text/css" href="../layout/scss/remove_product.css">
</head>
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
                            <li class="active"><a href="remove_product.php">Remove Product</a></li>
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

<table>
    <tr>
        <th>Image</th>
        <th>Name</th>
        <th>Description</th>
        <th>Category</th>
        <th>Price</th>
        <th>Delete</th>
    </tr>
    <?php
    include_once '../database/ProductDB.php';
    $allProducts = ProductDB::getAllProducts();
    foreach ($allProducts as $allProduct) {
        ?>
        <tr>
            <td><?php echo '<img style="height: 37%; width: 37%;" class="card-img-top" src="data:Image/jpg;base64,' . base64_encode($allProduct->Image) . '" />'; ?></td>
            <td><?php echo $allProduct->Name; ?></td>
            <td><?php echo $allProduct->Description; ?></td>
            <td><?php echo $allProduct->Category; ?></td>
            <td>€ <?php echo $allProduct->Price; ?></td>
            <td>
                <a href="../pagesDB/remove_productDB.php?productId=<?php echo $allProduct->Id ?>" id="btnAddProduct" class="btn btn-danger">
                    <span class="glyphicon glyphicon-trash"></span> Remove
                </a>
            </td>
        </tr>
        <?php
    }
    ?>
</table>

</body>
</html>