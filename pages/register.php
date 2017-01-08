<?php include('../template/header.php'); ?>
<?php include('../includes/functions.php'); ?>
<?php include('../config.php'); ?>
    <style><?php include '../style.css'; ?></style>

<?php


$errNumber = 0;
$errEmail = '';
$errFirstname = '';
$errLastname = '';
$errUsername = '';
$errUsernameExists = '';
$errPass = '';
$errCity = '';


if(isset($_POST['submit'])) {
    global $connection;
    $username = $_POST['username'];

    // connection to see if username already exists
    $usernameQuery = "SELECT * FROM users where username='$username'";
    $usernameResult = mysqli_query($connection, $usernameQuery);
    $get_rows = mysqli_affected_rows($connection);


    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) || $_POST['email'] === '') {
        $errEmail = "email was not valid" . "<br>";
        $errNumber++;
    }
    if(!preg_match("/^[a-zA-Z ]*$/",$_POST['firstname']) || strlen($_POST['firstname']) < 2) {
        $errFirstname = "first name can only be letters and spaces" . "<br>";
        $errNumber++;
    }
    if(!preg_match("/^[a-zA-Z ]*$/",$_POST['lastname']) || strlen($_POST['lastname']) < 2) {
        $errLastname = "last name can only be letters and spaces" . "<br>";
        $errNumber++;
    }
    if(!preg_match('/^(?=.{8,20}$)[a-zA-Z0-9]+$/', $username)) {
        $errUsername = "username is only letters and numbers" . "<br>";
        $errNumber++;
    }
    else if($get_rows >= 1) {
        $errUsernameExists = "username already exists.  please choose another" . "<br>";
    }
    if(!preg_match('((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$!%&]).{6,20})', $_POST['password'])) {
        $errPass = "password is not correct.  Needs 6-20 characters: At least 1 of each: Capital letter, lowercase letter, number, and special character" . "<br>";
        $errNumber++;
    }
    if(!preg_match('/^[a-zA-Z]+(?:[\s-][a-zA-Z]+)*$/', $_POST['city'])) {
        $errCity = "city is unsuccessful.  only letters, spaces, and dashes" . "<br>";
        $errNumber++;
    }

    if($errNumber === 0) {
        createUser();
        header("Location: login.php");
    }
    else {
        echo $errEmail;
        echo $errFirstname;
        echo $errLastname;
        echo $errUsername;
        echo $errUsernameExists;
        echo $errPass;
        echo $errCity;
        echo "The number of errors is " . $errNumber;
    }
}
?>

<div class="container">
    <div class="row">
    <div class="col-md-4 col-md-offset-4">
        <h1 class="register-header">Register for Team Run Tracking!</h1>
<form class="awesome" action="register.php" method="post">
    <div class="form-group row">
        <label for="input_email" class="register-label col-form-label col-sm-4">Email address</label>
        <div class="col-sm-8">
        <input type="email" name="email" class="form-control" id="email" placeholder="email">
        </div>
    </div>
    <div class="form-group row">
        <label for="first_name" class="register-label col-form-label col-sm-4">First Name</label>
        <div class="col-sm-8">
        <input type="text" name="firstname" class="form-control" id="fname" placeholder="first name">
        </div>
    </div>
    <div class="form-group row">
        <label for="last_name" class="register-label col-form-label col-sm-4">Last Name</label>
        <div class="col-sm-8">
        <input type="text" name="lastname" class="form-control" id="lname" placeholder="last name">
        </div>
    </div>
    <div class="form-group row">
        <label for="username" class="register-label col-form-label col-sm-4">Username</label>
        <div class="col-sm-8">
        <input type="text" name="username" class="form-control" id="username" placeholder="username">
        </div>
    </div>
    <div class="form-group row">
        <label for="password" class="register-label col-form-label col-sm-4">Password</label>
        <div class="col-sm-8">
        <input type="password" name="password" class="form-control" id="password" placeholder="password">
        </div>
    </div>
    <div class="form-group row">
        <label for="city" class="register-label col-form-label col-sm-4">City</label>
        <div class="col-sm-8">
        <input type="text" name="city" class="form-control" id="city" placeholder="city">
        </div>
    </div>
    <div class="form-group row">
        <label for="state" class="register-label col-form-label col-sm-4">State</label>
        <div class="col-sm-8">
        <select class="form-control" name="state" id="state_select">
            <option value="AL">Alabama</option>
            <option value="AK">Alaska</option>
            <option value="AZ">Arizona</option>
            <option value="AR">Arkansas</option>
            <option value="CA">California</option>
            <option value="CO">Colorado</option>
            <option value="CT">Connecticut</option>
            <option value="DE">Delaware</option>
            <option value="DC">District Of Columbia</option>
            <option value="FL">Florida</option>
            <option value="GA">Georgia</option>
            <option value="HI">Hawaii</option>
            <option value="ID">Idaho</option>
            <option value="IL">Illinois</option>
            <option value="IN">Indiana</option>
            <option value="IA">Iowa</option>
            <option value="KS">Kansas</option>
            <option value="KY">Kentucky</option>
            <option value="LA">Louisiana</option>
            <option value="ME">Maine</option>
            <option value="MD">Maryland</option>
            <option value="MA">Massachusetts</option>
            <option value="MI">Michigan</option>
            <option value="MN">Minnesota</option>
            <option value="MS">Mississippi</option>
            <option value="MO">Missouri</option>
            <option value="MT">Montana</option>
            <option value="NE">Nebraska</option>
            <option value="NV">Nevada</option>
            <option value="NH">New Hampshire</option>
            <option value="NJ">New Jersey</option>
            <option value="NM">New Mexico</option>
            <option value="NY">New York</option>
            <option value="NC">North Carolina</option>
            <option value="ND">North Dakota</option>
            <option value="OH">Ohio</option>
            <option value="OK">Oklahoma</option>
            <option value="OR">Oregon</option>
            <option value="PA">Pennsylvania</option>
            <option value="RI">Rhode Island</option>
            <option value="SC">South Carolina</option>
            <option value="SD">South Dakota</option>
            <option value="TN">Tennessee</option>
            <option value="TX">Texas</option>
            <option value="UT">Utah</option>
            <option value="VT">Vermont</option>
            <option value="VA">Virginia</option>
            <option value="WA">Washington</option>
            <option value="WV">West Virginia</option>
            <option value="WI">Wisconsin</option>
            <option value="WY">Wyoming</option>
        </select>
        </div>
    </div>
    <button type="submit" name="submit" class="btn btn-primary register-submit center-block">Submit</button>
</form>
</div>
</div>
</div>




<?php include('../template/footer.php'); ?>