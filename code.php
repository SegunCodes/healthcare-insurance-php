<?php
if (isset($_POST["submit"])) {
    include('includes/db.php');
    $hid = mysqli_real_escape_string($con, $_POST["hid"]);
    $pid = mysqli_real_escape_string($con, $_POST["pid"]);
    $auth = mysqli_real_escape_string($con, $_POST["auth"]);
    $code = mysqli_real_escape_string($con, $_POST["code"]);
    if ($auth == $code) {
        echo "<script>window.location='medical.php?auth=$auth'</script>";       
    }else{
        echo "<script>alert('Incorrect Code')</script>"; 
        echo "<script>window.location='patients-info.php'</script>";
    }    
}
?>