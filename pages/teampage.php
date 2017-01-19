<?php include('../includes/functions.php'); ?>
<?php
session_start();
if(isset($_SESSION['firstname'])) {
    include('../template/logged_in_header.php');
}
else {
    include('../template/header.php');
}
?>

    <style><?php include '../style.css'; ?></style>

    <h1><?php echo $_SESSION['firstname'] . "&#39;s Team Page";  ?></h1>



<?php include('../template/footer.php'); ?>