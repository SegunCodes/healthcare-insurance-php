<?php include("template/header.php") ?>
<?php
session_start();
//check if session has started on email
if (isset($_SESSION["SESSION_EMAIL"])) {
    header("location: patient-profile.php");
    die();
}elseif (isset($_SESSION["SESSION_EMAIL1"])) {
    header("location: hospital-profile.php");
    die();
}elseif (isset($_SESSION["SESSION_EMAIL2"])) {
    header("location: admin-dashboard.php");
    die();
}
include('includes/db.php');
$msg="";
if (isset($_GET["reset"])) {
    //check if the url link contains a reset statement and correct token
    if (mysqli_num_rows(mysqli_query($con, "SELECT * FROM users WHERE token='{$_GET['reset']}'")) > 0) {
        if (isset($_POST['submit'])) {
            $password = mysqli_real_escape_string($con, md5($_POST['pass']));
            $cpass = mysqli_real_escape_string($con, md5($_POST['pass2']));
            if ($password === $cpass) {
                $query = mysqli_query($con, "UPDATE users SET password='{$password}', token='' WHERE token='{$_GET['reset']}'");
                if ($query) {
                    header("location: index.php");
                }
            }else{
                $msg = "<div class='alert alert-danger'>Passwords do not match</div>";
            }
        }
    }else{
        // if link doesnt contain link or correct token
        $msg = "<div class='alert alert-danger'>Reset Link does not match</div>";
    }
}else{
    header("location: forgot-password.php");
}

?>
<body class="h-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
									<div class="text-center mb-3">
                                        <h3 class="text-center mb-4 text-white">Health Insurance Management System</h3>
										<a href="index.html"><img src="images/logo-full.png" alt=""></a>
									</div>
                                    <h4 class="text-center mb-4 text-white">Forgot Password</h4>
                                    <?php echo $msg;?>
                                    <form method="POST">
                                        <div class="form-group">
                                            <label class="mb-1 text-white"><strong>Password</strong></label>
                                            <input type="password" required name="pass" id="pass1" class="form-control" placeholder="Enter Password">
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1 text-white"><strong>Confirm Password</strong></label>
                                            <input type="password" required id="pass2" name="pass2" class="form-control" placeholder="Confirm Password">
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" name="submit" class="btn bg-primary text-white btn-block">Change Password</button>
                                        </div>
                                    </form>
                                    <div class="new-account mt-3">
                                        <p class="text-white">Back to <a class="text-white" href="index.php">Login</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>


<?php include("template/script.php") ?>

</html>