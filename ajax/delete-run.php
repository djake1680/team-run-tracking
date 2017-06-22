<?php
include('../includes/functions.php');

$run_to_delete = $_POST['delete_id'];

$run_to_delete = json_decode($run_to_delete);

$result = delete_run($run_to_delete);

echo $result;




?>