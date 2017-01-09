<?PHP
include "template/header.php";
include_once('config.php');
include "includes/functions.php";

session_start();
?>

<?php
if(isset($_SESSION['firstname'])) {
    $sessionUser = $_SESSION['firstname'];
}
?>

<?php

    if(!isset($sessionUser)) {
        include "pages/newuser.php";
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

    