<?php if (isset($_GET['category']) && $_GET['category'] == 'added') { ?>

    <p class="alert alert-success" style="margin: auto; text-align: center; width: 81%">Category is added!</p> <br>

<?php } ?>

<form method="post" action="" >
    <h2 class="form-signin-heading"><b>Add Category</b></h2>
    <hr />

    <div class="form-group">
        <label>Category Name</label>
        <input type="text" id="txtCategoryName" class="form-control" name="category" placeholder="Enter Category Name" value="<?php echo $values['category']; ?>" />
        <span class="errorMsg"><?php echo $errors['category']; ?></span>
    </div>

    <hr />

    <input type="submit" value="Add" id="btnAddCategory" class="btn btn-danger"/>
    <a href="../pages/home.php" class="btn btn-danger">Cancel</a>
    <br/>
</form>

