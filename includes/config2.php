<?php

//start the session before any output
session_start();


/**************
  Database Connection
**************/

$connection = mysqli_connect('localhost', 'root', '', 'teamgoals');

/**************
hash & salt config
**************/

$hashFormat = "$2y$10$";
$salt = "iusesomecrazystrings22";
$hashF_and_salt = $hashFormat . $salt;

/**************
REGEX config
6-20 characters
1 number, 1 upper case, 1 lower case, 1 special character
**************/
// ((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%!&]).{6,20})



// require the function file
require_once('functions.php');


// default the error variable to empty
$_SESSION['error'] = '';

?>