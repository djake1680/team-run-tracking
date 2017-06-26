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

//showRunningData();
?>


    <?php include '../template/edit-run-form.php'; ?>

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

    <div class="container running-data">
        <h3>Run History <button class="btn btn-primary add-run-button">Add Run</button></h3>
        <div class="container add-run-form-container">
            <!-- ADD RUN FORM -->
            <?php include('../template/addrunform.php'); ?>
            <?php
            if(isset($_SESSION['add-run'])) {
                echo $_SESSION['add-run'];
                unset($_SESSION['add-run']);
            }
            ?>
        </div>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Date</th>
                <th>Miles</th>
                <th>Time</th>
                <th>Per Mile</th>
                <th>City</th>
                <th>State</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php showRunningData() ?>
            </tbody>
        </table>
    </div>




<?php include('../template/footer.php'); ?>