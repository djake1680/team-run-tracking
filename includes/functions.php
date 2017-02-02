<?php
if(file_exists('../config.php')) {
    include('../config.php');
}

function createUser() {
    echo "function called";
    if(isset($_POST['submit'])) {
        global $connection;

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
        $zipcode = $_POST['zipcode'];

        $username = mysqli_real_escape_string($connection, $username);
        $password = mysqli_real_escape_string($connection, $password);
        $city = mysqli_real_escape_string($connection, $city);
        $email = mysqli_real_escape_string($connection, $email);
        $firstname = mysqli_real_escape_string($connection, $firstname);
        $lastname = mysqli_real_escape_string($connection, $lastname);
        $state = mysqli_real_escape_string($connection, $state);
        $zipcode = mysqli_real_escape_string($connection, $zipcode);


        // encrypt the password
        $options = [
            'cost' => 10,
        ];
        $password = password_hash($password, PASSWORD_BCRYPT, $options);
        echo $password;

        // build query and check if it worked
        $query = "INSERT INTO users(username, password, firstname, lastname, user_level, email, city, state, zipcode) ";
        $query .= "VALUES ('$username', '$password', '$firstname', '$lastname', '2', '$email', '$city', '$state', '$zipcode')";

        $result = mysqli_query($connection, $query);

        if(!$result) {
            //die('Query FAILED' . mysqli_error());
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

    $loginUsernameQuery = "SELECT username, password, firstname, zipcode FROM users where username='$login_username'";
    $loginUsernameResult = mysqli_query($connection, $loginUsernameQuery);
    $row = mysqli_fetch_array($loginUsernameResult);
    $count = mysqli_num_rows($loginUsernameResult);
    echo $count . "<br>";
    echo ($row['username']) . "<br>";
    //echo ($row['password']) . "<br>";

    $dbPassword = $row['password'];
    $dbUsername = $row['username'];
    $dbFirstname = $row['firstname'];
    $dbZipCode = $row['zipcode'];

    $options = [
        'cost' => 10,
    ];

    if($count == 1) {
        if (password_verify($login_password, $dbPassword)) {
//            echo "password works";
            if(password_needs_rehash($dbPassword, PASSWORD_DEFAULT, $options)) {
                //echo "password needs rehashed";
                $newPassword = password_hash($login_password, PASSWORD_BCRYPT, $options);
                echo $newPassword;
                $query = "UPDATE users SET password ='$newPassword' where username='$dbUsername'";
                $result = mysqli_query($connection, $query);

                if(!$result) {
                    //die('Query FAILED' . mysqli_error());
                }
                else {
                    echo "Password Updated";
                }
            }
            else {
                echo "password is fine";
            }
        }
        else {
            echo "issue with password";
        }
//        echo "match found!!!";
        $_SESSION['firstname'] = $dbFirstname;
        $_SESSION['zipcode'] = $dbZipCode;
        header("Location: index.php");
    }
    else {
        echo "incorrect credentials";
    }
}
