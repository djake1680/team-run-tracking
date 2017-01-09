<?php
include('../template/header.php');
include('../includes/functions.php');
session_start();
?>

<style><?php include '../style.css'; ?></style>

<?

$login_password = '';

if(isset($_POST['login-submit'])) {
    //print_r($_POST);

    // make sure username and password have been entered
    if(empty($_POST['login-username']) || empty($_POST['login-password'])) {
        echo "need username and password" . "<br>";
    }
    else {
        global $connection;
        $login_username = $_POST['login-username'];
        //$login_username = mysqli_real_escape_string($connection, $login_username);
        //$login_password = mysqli_real_escape_string($connection, $login_password);
        $login_password = $_POST['login-password'];
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
            header("Location: ../index.php");
        }
        else {
            echo "incorrect credentials";
        }
    }

}

?>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <h1 class="login-header">Log In</h1>
                <form class="login-body" action="login.php" method="post">
                    <div class="form-group row">
                        <label for="login-username" class="login-label col-form-label col-sm-4">Username</label>
                        <div class="col-sm-8">
                            <input type="text" name="login-username" class="form-control" id="login-username" placeholder="username">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="login-password" class="login-label col-form-label col-sm-4">Password</label>
                        <div class="col-sm-8">
                            <input type="password" name="login-password" class="form-control" id="login-password" placeholder="password">
                        </div>
                    </div>
                    <button type="submit" name="login-submit" class="btn btn-primary login-submit center-block">Submit</button>
                </form>
            </div>
        </div>
    </div>



<?php include('../template/footer.php'); ?>