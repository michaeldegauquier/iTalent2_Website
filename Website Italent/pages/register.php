<form method="post" action="">
    <h2 class="form-signin-heading"><b>Registration</b></h2>
    <hr />

    <div class="form-group">
        <label>First Name</label>
        <input type="text" id="txtFirstname" name="firstname" class="form-control" value="<?php echo $values['firstname']; ?>" placeholder="Enter First Name" />
        <span class="errorMsg"><?php echo $errors['firstname']; ?></span>
    </div>

    <div class="form-group">
        <label>Last Name</label>
        <input type="text" id="txtLastname" name="lastname" class="form-control" value="<?php echo $values['lastname']; ?>" placeholder="Enter Last Name" />
        <span class="errorMsg"><?php echo $errors['lastname']; ?></span>
    </div>

    <div class="form-group">
        <label>E-mail</label>
        <input type="email" id="txtEmail" name="email" class="form-control" value="<?php echo $values['email']; ?>" placeholder="Enter E-mail" />
        <span class="errorMsg"><?php echo $errors['email']; ?></span>
        <span class="errorMsg"><?php echo $errors['emailexists']; ?></span>
    </div>

    <div class="form-group">
        <label>Password</label>
        <input type="password" id="txtPassword" name="password" class="form-control" value="<?php echo $values['password']; ?>" placeholder="Password" />
        <span class="errorMsg"><?php echo $errors['password']; ?></span>
    </div>

    <div class="form-group">
        <label>Confirm Password</label>
        <input type="password" id="txtConfirmPassword" name="confirmpassword" class="form-control" value="<?php echo $values['confirmpassword']; ?>" placeholder="Confirm Password" />
        <span class="errorMsg"><?php echo $errors['confirmpassword']; ?></span>
    </div>

    <div class="form-group">
        <p>You automatically accept the <a href="../pages/terms.html" target="_blank">terms & conditions</a> and the <a href="../pages/gdpr.html" target="_blank">GDPR Privacy Policy</a> by clicking 'Confirm Registration'</p>
    </div>

    <hr />

    <input type="submit" name="btnSignup" value="Confirm Registration" id="btnSignup" class="btn btn-primary"/>
    <a href="../pagesDB/loginDB.php" class="btn btn-primary">Cancel</a>
    <br/>
</form>
