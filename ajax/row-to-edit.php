<?php
include('../includes/functions.php');

$row_to_edit = $_POST['edit_id'];

$row_to_edit = json_decode($row_to_edit);

$result = find_row_to_edit($row_to_edit);

date_default_timezone_set("America/Los_Angeles");
$result['run_date'] = date("m/d/Y", $result['run_date']);

$result = json_encode($result);


echo $result;




?>