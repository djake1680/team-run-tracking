<?php
session_start();
if(isset($_SESSION['firstname'])) {
    include('../template/logged_in_header.php');
}
else {
    include('../template/header.php');
}
?>
<?php include('../includes/functions.php'); ?>
<?php

$sessionZipCode = $_SESSION['zipcode'];
?>

    <script src="../main.js"></script>
    <style><?php include '../style.css'; ?></style>

    <script type="text/javascript"> userWeather(<?php echo $sessionZipCode ?>); </script>

    <div class="container">
        <div class="sidemenu">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <h1 class="page_header"><?php echo $_SESSION['firstname'] . "&#39;s Home Page";  ?></h1>
                </div>
                <div class="col-md-4 weather_box">
                    <div class="row">
                        <div class="col-md-12 weather-info">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php include('../template/footer.php'); ?>