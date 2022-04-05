<?php include("template/header.php") ?>
<?php
session_start();
if (isset($_SESSION["SESSION_EMAIL"])) {
    header("location: patient-profile.php");
    die();
}elseif (isset($_SESSION["SESSION_EMAIL1"])) {
    header("location: hospital-profile.php");
    die();
}
include('includes/db.php');
$msg="";
if (isset($_GET['verification'])) {
    if (mysqli_num_rows(mysqli_query($con, "SELECT * FROM users WHERE token='{$_GET['verification']}'"))>0) {
        $query = mysqli_query($con, "UPDATE users set token='', status='Active' WHERE token= '{$_GET['verification']}'");
        if ($query) {
            $msg = "<div class='alert alert-success'>Account Verification is completed! Now You can login!</div>";
        }
    }else{
        header("Location: index.php");
    }
}
if (isset($_POST["submit"])) {
    $email = mysqli_real_escape_string($con, $_POST["email"]);
    $password = mysqli_real_escape_string($con, md5($_POST["password"]));

    $sql = "SELECT * FROM users WHERE email='{$email}' AND password='{$password}'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result)===1) {
        $row = mysqli_fetch_assoc($result);
        if (empty($row["token"]) && $row["category"]==="Hospital") {
            $_SESSION["SESSION_EMAIL1"] = $email;
            header("location: hospital-profile.php");
        }elseif (empty($row["token"]) && $row["category"]==="Patient") {
            $_SESSION["SESSION_EMAIL"] = $email;
            header("location: patient-profile.php");
        }elseif (empty($row["token"]) && $row["category"]==="Admin") {
            $_SESSION["SESSION_EMAIL2"] = $email;
            header("location: admin-dashboard.php");
        }
        else{
            $msg = "<div class='alert alert-info'>First Verify Your Account and try again!</div>";
        }
    }else{
        $msg = "<div class='alert alert-danger'>Email or password do not match</div>";
    }

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
                                    <h4 class="text-center mb-4 text-white">Sign in your account</h4>
                                    <?php echo $msg; ?>
                                    <form method="POST">
                                        <div class="form-group">
                                            <label class="mb-1 text-white"><strong>Email</strong></label>
                                            <input type="email" name="email" class="form-control" placeholder="hello@example.com">
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1 text-white"><strong>Password</strong></label>
                                            <input type="password" name="password" class="form-control" placeholder="Enter Password">
                                        </div>
                                        <div class="form-row d-flex justify-content-between mt-4 mb-2">
                                            <div class="form-group">
                                                <a class="text-white" href="forgot-password.php">Forgot Password?</a>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" name="submit" class="btn bg-primary text-white btn-block">Sign Me In</button>
                                        </div>
                                    </form>
                                    <div class="new-account mt-3">
                                        <p class="text-white">Don't have an account? <a class="text-white" href="register.php">Sign up</a></p>
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