<?php

//Database connection
$con=mysqli_connect("localhost", "root", "", "insurance");
if(!$con){
echo "Connection Fail".mysqli_connect_error();
}

?>