<?php
include('includes/db.php');
$id = $_GET['del'];

$del = mysqli_query($con, "DELETE FROM allocation WHERE id = '$id'");

if ($del) {
	mysqli_close($con);
	header("location: allocated-list.php");
	exit();
}
?>