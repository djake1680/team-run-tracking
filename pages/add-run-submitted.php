<?php session_start(); ?>

<?php include('../includes/functions.php'); ?>

<?php

if(isset($_POST['add-run-submit'])) {
    //print_r($_POST);
    $errCity = '';
    $errDate = '';
    $errTime = '';
    $errNumber = 0;

    global $connection;

    if($_POST['run-date'] === '') {
        $errDate = "No date set";
        $errNumber++;
    }
    if(($_POST['add-run-hours'] == 0) && ($_POST['add-run-minutes'] == 0) && ($_POST['add-run-seconds'] == 0)) {
        $errTime = "Please enter a valid time for your run";
        $errNumber++;
    }
    if(!preg_match('/^[a-zA-Z]+(?:[\s-][a-zA-Z]+)*$/', $_POST['add-run-city'])) {
        $errCity = "city is unsuccessful.  only letters, spaces, and dashes" . "<br>";
        $errNumber++;
    }

    if($errNumber === 0) {
        //echo "No errors!!!";
        add_run();
    }
    else {
//        echo $errCity . "<br />";
//        echo $errDate . "<br />";
//        echo $errTime . "<br />";
//        echo "There are " . $errNumber . " errors";
    }


}
$_SESSION['add-run'] = "Run Successfully Added";
header('Location: personalpage.php');

?>
/**
 * Created by PhpStorm.
 * User: darinjacobson1
 * Date: 6/18/17
 * Time: 7:21 PM
 */