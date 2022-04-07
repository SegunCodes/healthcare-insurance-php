<?php
include('includes/db.php');
$id = $_GET['del'];

$del = mysqli_query($con, "DELETE FROM records WHERE id = '$id'");  //delete specific record with id

if ($del) {
	mysqli_close($con);
	header("location: all-records.php");
	exit();
}
?>