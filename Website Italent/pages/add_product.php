<?php if (isset($_GET['product']) && $_GET['product'] == 'added') { ?>

    <p class="alert alert-success" style="margin: auto; text-align: center; width: 82%">Product is added!</p> <br>

<?php } ?>

<form method="post" action="" enctype="multipart/form-data">
    <h2 class="form-signin-heading"><b>Add Product</b></h2>
    <hr />

    <div class="form-group">
        <label>Product Name</label>
        <input type="text" id="txtProductName" class="form-control" name="name" value="<?php echo $values['name']; ?>" placeholder="Enter Product Name" />
        <span class="errorMsg"><?php echo $errors['name']; ?></span>
    </div>

    <div class="form-group">
        <label>Product Description</label>
        <textarea rows="5" cols="80" id="txtProductDescription" class="form-control" name="description" placeholder="Enter Product Description" ><?php echo $values['description']; ?></textarea>
        <span class="errorMsg"><?php echo $errors['description']; ?></span>
    </div>

    <div class="form-group">
        <label>Product Category</label>
        <select class="form-control" id="category" name="category">
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
        <span class="errorMsg"><?php echo $errors['category']; ?></span>
    </div>

    <div class="form-group">
        <label>Product Price</label>
        <input type="number" step="0.01" id="txtProductPrice" class="form-control" name="price" value="<?php echo $values['price']; ?>" placeholder="Enter Product Price" />
        <span class="errorMsg"><?php echo $errors['price']; ?></span>
    </div>

    <div class="form-group">
        <label>Upload Image</label>
        <input type="file" id="ProductImage" class="form-control-file" name="image" accept="image/*" required>
    </div>

    <hr />

    <input type="submit" value="Add" id="btnAddProduct" class="btn btn-danger"/>
    <a href="../pages/home.php" class="btn btn-danger">Cancel</a>
    <br/>
</form>

