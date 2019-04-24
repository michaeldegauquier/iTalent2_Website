<?php

session_start();

unset($_SESSION['loggedIn']);

session_destroy();

header('location:../pages/home.php');



// Stackoverflow. Delete all cookies of my website. Geraadpleegd via
// https://stackoverflow.com/questions/2310558/how-to-delete-all-cookies-of-my-website-in-php
// Geraadpleegd op 9 april 2019
?>