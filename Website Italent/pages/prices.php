<?php
session_start();

if (isset($_SESSION['loggedIn']) && !empty($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === 'admin@gmail.com') {
    header('location:./home.php');
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
        <title>Prices</title>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
                    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
                        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
                            <link rel="stylesheet" type="text/css" href="../layout/scss/prices.css">
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
                    <li class="active">
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

<h2>Prijzen</h2>

<hr />
<table>
    <tr>
        <th>SNIT & Brushing</th>
        <th>Price</th>
    </tr>
    <tr>
        <td>Brushing Kort</td>
        <td>€25</td>
    </tr>
    <tr>
        <td>Brushing Half Lang</td>
        <td>€27</td>
    </tr>
    <tr>
        <td>Brushing Lang</td>
        <td>€29</td>
    </tr>
    <tr>
        <td colspan="2"> </td>
    </tr>
    <tr>
        <td>Snit</td>
        <td>€30</td>
    </tr>
    <tr>
        <td>Snit & Handdrogen</td>
        <td>€35</td>
    </tr>
    <tr>
        <td>Snit & Brushing Kort</td>
        <td>€40</td>
    </tr>
    <tr>
        <td>Snit & Brushing Half Lang</td>
        <td>€45</td>
    </tr>
    <tr>
        <td>Snit & Brushing Lang</td>
        <td>€47</td>
    </tr>
    <tr>
        <td colspan="2"> </td>
    </tr>
    <tr>
        <td>Vlechtwerk</td>
        <td>€20</td>
    </tr>
    <tr>
        <td>Opsteekwerk</td>
        <td>€30</td>
    </tr>
</table>
<hr />
<table>
    <tr>
        <th colspan="2">Kleur & Permanent & Minivaag</th>
    </tr>
    <tr>
        <td>Kleurspoeling</td>
        <td>€25</td>
    </tr>
    <tr>
        <td>Kleur</td>
        <td>€30</td>
    </tr>
    <tr>
        <td>Balayage</td>
        <td>€20</td>
    </tr>
    <tr>
        <td>Mechen Kort</td>
        <td>€34</td>
    </tr>
    <tr>
        <td>Mechen Lang</td>
        <td>€40</td>
    </tr>
    <tr>
        <td colspan="2"> </td>
    </tr>
    <tr>
        <td>Minivaag</td>
        <td>€35</td>
    </tr>
    <tr>
        <td>Half permanent</td>
        <td>€37</td>
    </tr>
    <tr>
        <td>Permanent</td>
        <td>€40</td>
    </tr>
    <tr>
        <td>Speciale Krultechniek</td>
        <td>€44</td>
    </tr>
</table>
<hr />
<table>
    <tr>
        <th colspan="2">Jeugdservice</th>
    </tr>
    <tr>
        <td>Kleuters - 3 jaar</td>
        <td>€14</td>
    </tr>
    <tr>
        <td>Kindersnit - 6 jaar</td>
        <td>€16</td>
    </tr>
    <tr>
        <td>Jongens - 13 jaar</td>
        <td>€18</td>
    </tr>
</table>
<hr />
<table>
    <tr>
        <th colspan="2">Meisjes</th>
    </tr>
    <tr>
        <td>Meisjes - 12 jaar</td>
        <td>€25</td>
    </tr>
    <tr>
        <td>Meisjes - 18 jaar</td>
        <td>€35</td>
    </tr>
</table>
<hr />
<table>
    <tr>
        <th colspan="2">Herensnit</th>
    </tr>
    <tr>
        <td>Halve herensnit</td>
        <td>€17</td>
    </tr>
    <tr>
        <td>Herensnit</td>
        <td>€19</td>
    </tr>
</table>
<hr />
</body>
</html>