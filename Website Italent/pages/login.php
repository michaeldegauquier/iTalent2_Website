<?php echo $errors['loginIncorrect']; ?>

<?php if (isset($_GET['register']) && $_GET['register'] == 'true') { ?>

    <p class="alert alert-success" style="margin: auto; text-align: center; width: 27%">Registration is successful!</p> <br>

<?php } ?>

<form method="post" action="">
    <h2 class="form-signin-heading"><b>Login</b></h2>
    <hr />

    <div class="form-group">
        <label for="email">E-mail</label>
        <input id="email" class="form-control" name="loginEmail" placeholder="Enter E-mail" value="<?php echo $values['loginEmail']; ?>" type="email"/>
        <span class="errorMsg"><?php echo $errors['loginEmail']; ?></span>
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" class="form-control" name="loginPassword" placeholder="Enter Password"/>
        <span class="errorMsg"><?php echo $errors['loginPassword']; ?></span>
    </div>

    <hr />

    <input type="submit" name="btnLogin" value="Login" id="btnLogin" class="btn btn-primary"/>
    <a href="../pagesDB/registerDB.php" class="btn btn-primary">Register</a>
</form>






