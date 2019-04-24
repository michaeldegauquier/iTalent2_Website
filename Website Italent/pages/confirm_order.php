
<h1 class="text-center">Confirm Order</h1>

<hr/>

<div class="container">
    <form action="" method="POST">
        <h5><b>All Products:</b></h5>

        <hr/>

        <div class="row">
            <div class="form-group col">
                <table>
                    <tr>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price</th>
                    </tr>
                    <?php
                    include_once '../database/ProductDB.php';
                    for ($i = 0; $i < count($_SESSION['productIds']); $i++) {
                        $allProducts = ProductDB::getProductDetail($_SESSION['productIds'][$i]);
                        foreach ($allProducts as $allProduct) {
                            ?>

                            <tr>
                                <td><?php echo $allProduct->Name; ?></td>
                                <td><?php echo $allProduct->Category; ?></td>
                                <td><b>€ <?php echo $allProduct->Price; ?></b></td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </table>
            </div>
        </div>

        <br/>
        <hr/>

        <div class="row">
            <div class="form-group col">
                <h5><b>Total Price:
                        <?php
                        $totalprice = 0;

                        for ($i = 0; $i < count($_SESSION['productIds']); $i++) {
                            $allProducts = ProductDB::getProductDetail($_SESSION['productIds'][$i]);
                            foreach ($allProducts as $allProduct) {
                                $totalprice = $totalprice + $allProduct->Price;
                            }
                        }
                        ?>
                    </b>
                    <h5><b>€ <?php echo $totalprice; ?></b></h5>
                </h5>



            </div>
        </div>

        <hr/>

        <p>Make sure you have checked your order!</p>

        <button type="submit" class="btn btn-primary">Confirm Order</button>
        <a type="button" class="btn btn-primary" href="shopping_cartDB.php">Back to Shopping Cart</a>
    </form>

    <br/>

</div>


