<h1 class="text-center">Shopping Cart</h1>

<hr/>

<?php
if(isset($_SESSION['productIds']) && !empty($_SESSION['productIds'])) {
    ?>

    <div class="container">
        <table class="tableOrder">
            <tr>
                <th class="thOrder">Image</th>
                <th class="thOrder">Product Name</th>
                <th class="thOrder">Category</th>
                <th class="thOrder">Price</th>
                <th class="thOrder">Remove Product</th>
            </tr>

            <?php
            include_once '../database/ProductDB.php';


            for ($i = 0; $i < count($_SESSION['productIds']); $i++) {
                $allProducts = ProductDB::getProductDetail($_SESSION['productIds'][$i]);
                foreach ($allProducts as $allProduct) {
                    ?>

                    <tr>
                        <td class="tdOrder"><?php echo '<img style="width: 100px;" src="data:Image/jpg;base64,' . base64_encode($allProduct->Image) . '" />'; ?></td>
                        <td class="tdOrder"><?php echo $allProduct->Name; ?></td>
                        <td class="tdOrder"><?php echo $allProduct->Category; ?></td>
                        <td class="tdOrder">€ <?php echo $allProduct->Price; ?></td>
                        <td class="tdOrder"><button type="button" class="btn btn-lg btn-secondary btn-sm removeItem" id="<?php echo $allProduct->Id; ?>">Remove</button></td>
                    </tr>

                    <?php
                }
            }
            ?>
        </table>
    </div>

    <?php

} else {
    ?>

    <h3>No Products in Shopping Cart!</h3>

    <?php
}
?>

<?php
if(isset($_SESSION['productIds']) && !empty($_SESSION['productIds'])) {
    if (isset($_SESSION['loggedIn']) && !empty($_SESSION['loggedIn'])) {
        ?>

        <hr/>

        <div class="middle">
            <a type="button" class="btn btn-lg btn-primary btn-sm" href="../pagesDB/confirm_orderDB.php">Continue to Order</a>
            <br/>
        </div>

        <?php
    } else {
        ?>

        <hr/>

        <div class="middle">
            <p>You have to sign in to continue your order.</p>
            <a type="button" class="btn btn-lg btn-primary btn-sm" href="../pagesDB/loginDB.php">Sign in</a>
            <br/>
        </div>

        <?php
    }
}
?>