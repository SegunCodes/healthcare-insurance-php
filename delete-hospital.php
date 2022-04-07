<?php
include('includes/db.php');
$id = $_GET['del'];

$del = mysqli_query($con, "DELETE FROM hospital WHERE id = '$id'");  //delete specific hospital with id

if ($del) {
	mysqli_close($con);
	header("location: hospital-info.php");
	exit();
}
?>