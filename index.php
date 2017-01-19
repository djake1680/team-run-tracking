<?PHP
include_once('config.php');
include "includes/functions.php";

session_start();
if(isset($_SESSION['firstname'])) {
    include('template/logged_in_header.php');
}
else {
    include('template/header.php');
}
?>

<style><?php include 'style.css'; ?></style>

<?php
if(isset($_SESSION['firstname'])) {
    $sessionUser = $_SESSION['firstname'];
}
if(isset($_SESSION['zipcode'])) {
    $sessionZipCode = $_SESSION['zipcode'];
}
?>

<?php

    if(!isset($sessionUser)) {
        include "pages/login.php";
    }
    else {
        include "pages/loggedinhome.php";
    }

?>


<!--<p>To register, click <a href="pages/register.php">here</a></p>-->
<!---->
<!--<p>Already a member?  Click <a href="pages/login.php">here</a> to login!</p>-->
<!---->
<!--<p>Click <a href="pages/logout-complete.php">here</a> to logout!</p>-->


   
   
<?php include("template/footer.php"); ?>

    