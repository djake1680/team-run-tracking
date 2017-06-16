<?php include('../template/header.php'); ?>
<?php include('../includes/functions.php'); ?>
<?php
    session_start();
?>

<style><?php include '../style.css'; ?></style>

<?php
    logout_user();
?>

<p><a href="../index.php">Return to Home Page</a></p>



<? //php include('../template/footer.php'); ?>