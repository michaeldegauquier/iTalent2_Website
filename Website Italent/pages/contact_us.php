
<?php if (isset($_GET['message']) && $_GET['message'] == 'send') { ?>

    <p class="alert alert-success" style="margin: auto; text-align: center; width: 81%">Your message is send!</p> <br>

<?php } ?>

<form method="post" action="">
    <div>
        <h2 class="form-signin-heading"><b>Contact Us</b></h2>
        <hr />

        <div class="form-group">
            <label for="txtName">Name</label>
            <input type="text" id="Name" class="form-control" name="name" value="<?php echo $values['name']; ?>" placeholder="Enter Your Name" />
            <span class="errorMsg"><?php echo $errors['name']; ?></span>
        </div>

        <div class="form-group">
            <label for="txtEmail">Email</label>
            <input type="email" id="txtEmail" class="form-control" name="email" value="<?php echo $values['email']; ?>" placeholder="Enter Your Email Address" />
            <span class="errorMsg"><?php echo $errors['email']; ?></span>
        </div>

        <div class="form-group">
            <label for="txtSubject">Subject</label>
            <input type="text" id="txtSubject" class="form-control" name="subject" value="<?php echo $values['subject']; ?>" placeholder="Enter Subject" />
            <span class="errorMsg"><?php echo $errors['subject']; ?></span>
        </div>

        <div class="form-group">
            <label for="txtMessage">Message</label>
            <textarea rows="8" cols="100" id="txtMessage" class="form-control" name="message" placeholder="Enter Message" ><?php echo $values['message']; ?></textarea>
            <span class="errorMsg"><?php echo $errors['message']; ?></span>
        </div>

        <hr />

        <input type="submit" name="btnSend" value="Send Message" id="btnSend" class="btn btn-primary"/>
    </div>
</form>
<br />
<hr />

<h2 class="form-signin-heading"><b>Openingsuren</b></h2>
<hr />

<table>
    <tr>
        <td>Maandag</td>
        <td>Gesloten</td>
    </tr>
    <tr>
        <td>Dinsdag</td>
        <td>8:00-12:00 en 13:00-17:00</td>
    </tr>
    <tr>
        <td>Woensdag</td>
        <td>8:00-12:00 en 13:00-17:00</td>
    </tr>
    <tr>
        <td>Donderdag</td>
        <td>8:00-12:00 en 13:00-17:00</td>
    </tr>
    <tr>
        <td>Vrijdag</td>
        <td>8:00-12:00 en 13:00-17:00</td>
    </tr>
    <tr>
        <td>Zaterdag</td>
        <td>8:00-16:00</td>
    </tr>
    <tr>
        <td>Zondag</td>
        <td>Gesloten</td>
    </tr>
</table><br />
<hr />
<div class="map">
    <div class="gmap_canvas">
        <iframe width="600" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=stationsplein%2010%20kortenberg&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0">
    </div><style>.mapouter{position:relative;text-align:right;height:500px;width:600px;}.gmap_canvas {overflow:hidden;background:none!important;height:500px;width:600px;}</style>
</div><br />

