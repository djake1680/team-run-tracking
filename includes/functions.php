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

        $_POST = array();
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

    $loginUsernameQuery = "SELECT user_id, username, password, firstname, zipcode FROM users where username='$login_username'";
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
    $user_id = $row['user_id'];

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
        $_SESSION['user_id'] = $user_id;
        header("Location: pages/personalpage.php");
    }
    else {
        echo "incorrect credentials";
    }
}

function add_run() {
    if(isset($_POST['add-run-submit'])) {
        global $connection;
        date_default_timezone_set("America/Los_Angeles");

        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }


        // convert date entered into timestamp
        $rundate = $_POST['run-date'];
        $rundate = DateTime::createFromFormat('m/d/Y',$rundate);
        $rundate = $rundate->getTimestamp();

        // convert hours, minutes, and seconds into total seconds
        $runhours = $_POST['add-run-hours'];
        $runminutes = $_POST['add-run-minutes'];
        $runseconds = $_POST['add-run-seconds'];

        $hours_to_seconds = (($runhours * 60) * 60);
        $minutes_to_seconds = $runminutes * 60;
        $runtime = $hours_to_seconds + $minutes_to_seconds + $runseconds;

        $runmiles = $_POST['add-run-miles'];
        $runcity = ucwords($_POST['add-run-city']);
        $runstate = $_POST['add-run-state'];

        $userid = $_SESSION['user_id'];
        $rundate = mysqli_real_escape_string($connection, $rundate);
        $runmiles = mysqli_real_escape_string($connection, $runmiles);
        $runtime = mysqli_real_escape_string($connection, $runtime);
        $runcity = mysqli_real_escape_string($connection, $runcity);
        $runstate = mysqli_real_escape_string($connection, $runstate);

        // build query and check if it worked
        $query = "INSERT INTO run_data(user_id, run_date, run_miles, run_time, run_city, run_state) ";
        $query .= "VALUES ('$userid', '$rundate', '$runmiles', '$runtime', '$runcity', '$runstate')";

        $result = mysqli_query($connection, $query);

        if(!$result) {
            //die('Query FAILED' . mysqli_error());
        }
        else {
            echo "Record Created";
        }

        $_POST = array();
    }
}

function showRunningData() {
    //echo "show running data function called";
    $userid = $_SESSION['user_id'];
    //echo $userid;
    global $connection;
    date_default_timezone_set("America/Los_Angeles");

    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    $selectRunningDataQuery = "SELECT * FROM run_data WHERE user_id = '$userid' ORDER BY run_date";
    $selectRunningData = mysqli_query($connection, $selectRunningDataQuery);

    while ($row = mysqli_fetch_array($selectRunningData)) {

        $rundate = date('m/d/Y', $row['run_date']);
        $runmiles = $row['run_miles'];

        // put together run time into hours, minutes, seconds
        $runtime = $row['run_time'];
        $leftover = $runtime % 3600;
        $hours = floor($runtime / 3600);
        $minutes = floor($leftover / 60);
        $leftoverseconds = $leftover % 60;
        if($leftoverseconds < 10) {
            $leftoverseconds = $leftoverseconds . "0";
        }
        $finaltime = $hours . ":" . $minutes . ":" . $leftoverseconds;

        // calculate average time
        $averageseconds = $runtime / $runmiles;
        $averageminutes = floor($averageseconds / 60);
        $averageleftoverseconds = round($averageseconds % 60);
        $finalaverage = $averageminutes . ":" . $averageleftoverseconds;

        //$runaverage = $runtime / $runmiles;

        $runcity = $row['run_city'];
        $runstate = $row['run_state'];

        $tablerow = "<tr><td>$rundate</td><td>$runmiles</td><td>$finaltime</td><td>$finalaverage</td><td>$runcity</td><td>$runstate</td></tr>";
        echo $tablerow;
    }

    //$count = mysqli_num_rows($selectRunningData);
    //echo $count . "<br>";
}
