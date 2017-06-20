<?php
$login_password = '';

if(isset($_POST['login-submit'])) {

    // make sure username and password have been entered
    if(empty($_POST['login-username']) || empty($_POST['login-password'])) {
        echo "need username and password" . "<br>";
    }
    else {
        global $connection;
        $login_username = $_POST['login-username'];
        $login_password = $_POST['login-password'];
        $_POST = array();
        login_user($login_username, $login_password);
    }

}

?>
<!-- login form -->
    <div class="container login-container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <h1 class="login-header">Log In</h1>
                <form class="login-body" action="index.php" method="post">
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
               <p class="register-button">Not a member?  Click <a href="pages/register.php">HERE</a> to register</p>
            </div>
        </div>
    </div>
