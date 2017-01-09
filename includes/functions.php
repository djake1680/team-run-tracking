<?php
if(file_exists('../config.php')) {
    include('../config.php');
}

?>


<?php

function createUser() {
    echo "function called";
    if(isset($_POST['submit'])) {
        global $connection;
        global $hashF_and_salt;
        if (mysqli_connect_errno()) {
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

function logout_user() {
    echo "logging out " . $_SESSION['firstname'] . "<br>";
    unset($_SESSION['firstname']);
    session_destroy();
    echo "logged out";
}

function login_user($login_username, $login_password) {
    global $connection;
    global $hashF_and_salt;
    echo "login function called";
    $login_password = crypt($login_password, $hashF_and_salt);
    echo $login_password . " from login" . "<br>";

    $loginUsernameQuery = "SELECT username, password, firstname FROM users where username='$login_username'";
    $loginUsernameResult = mysqli_query($connection, $loginUsernameQuery);
    $row = mysqli_fetch_array($loginUsernameResult);
    $count = mysqli_num_rows($loginUsernameResult);
    echo $count . "<br>";
    echo ($row['username']) . "<br>";
    //echo ($row['password']) . "<br>";

    $dbPassword = $row['password'];
    $dbUsername = $row['username'];
    $dbFirstname = $row['firstname'];
    echo $dbPassword . "<br>";
    echo $dbUsername . "<br>";

    if($count == 1 && $login_password == $dbPassword) {
        echo "match found!!!";
        $_SESSION['firstname'] = $dbFirstname;
        header("Location: index.php");
    }
    else {
        echo "incorrect credentials";
    }
}


?>