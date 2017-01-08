<?php include('../config.php'); ?>


<?php

function createUser() {

    if(isset($_POST['submit'])) {
        global $connection;
        global $hashF_and_salt;
if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

        // extract data from $_POST superglobal
        $username = $_POST['username'];
        $password = $_POST['password'];
        $city = ucwords($_POST['city']);
        $email = $_POST['email'];
        $firstname = ucwords($_POST['firstname']);
        $lastname = ucwords($_POST['lastname']);
        $state = $_POST['state'];

        $username = mysqli_real_escape_string($connection, $username);
        $password = mysqli_real_escape_string($connection, $password);
        $city = mysqli_real_escape_string($connection, $city);
        $email = mysqli_real_escape_string($connection, $email);
        $firstname = mysqli_real_escape_string($connection, $firstname);
        $lastname = mysqli_real_escape_string($connection, $lastname);

        // regex matching to make sure only certain things are allowed for each category
        if(!preg_match("/^[a-zA-Z ]*$/",$firstname)) {
            echo "first name can only be letters and spaces" . "<br>";
        }

        if(!preg_match("/^[a-zA-Z ]*$/",$lastname)) {
            echo "last name can only be letters and spaces" . "<br>";
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "email was not valid" . "<br>";
        }

        if(!preg_match('((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$!%&]).{6,20})', $password)) {
            echo "password is not correct.  Needs 6-20 characters: At least 1 of each: Capital letter, lowercase letter, number, and special character" . "<br>";
        }

        if(!preg_match('/^(?=.{8,20}$)[a-zA-Z0-9]+$/', $username)) {
            echo "username is only letters and numbers" . "<br>";
        }

        if(!preg_match('/^[a-zA-Z]+(?:[\s-][a-zA-Z]+)*$/', $city)) {
            echo "city is unsuccessful.  only letters, spaces, and dashes" . "<br>";
        }

        // encrypt the password
        $password = crypt($password, $hashF_and_salt);

        // build query and check if it worked
        $query = "INSERT INTO users(username, password, firstname, lastname, user_level, email, city, state) ";
        $query .= "VALUES ('$username', '$password', '$firstname', '$lastname', '2', '$email', '$city', '$state')";

        $result = mysqli_query($connection, $query);

        if(!$result) {
            die('Query FAILED' . mysqli_error());
        }
        else {
            echo "Record Created";
        }

    }
}


?>