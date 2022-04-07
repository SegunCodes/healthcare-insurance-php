<?php include("template/header.php") ?>
<?php

session_start();
//check if a session has already for that email, and kills the session
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
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
//Load Composer's autoloader
require 'vendor/autoload.php';
include('includes/db.php');
$msg = "";
if (isset($_POST["submit"])) {
    $email = mysqli_real_escape_string($con, $_POST["email"]);
    $token = mysqli_real_escape_string($con, md5(rand()));
    if (mysqli_num_rows(mysqli_query($con, "SELECT * FROM users WHERE email='{$email}'"))>0) {
        $query = mysqli_query($con, "UPDATE users SET token='{$token}' WHERE email = '{$email}'");

        if ($query) {
            echo "<div style='display:none;'>";
            //Create an instance; passing `true` enables exceptions
            $mail = new PHPMailer(true);
    
            try {
                //Server settings
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'youremail@mail.com';                     //SMTP username
                $mail->Password   = '*****';                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
                //Recipients
                $mail->setFrom('youremail@mail.com');
                $mail->addAddress($email);
    
    
                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'no reply';
                $mail->Body    = 'Here is the Verification link <b><a href="http://localhost/health-insurance/reset-password.php?reset='.$token.'">http://localhost/health-insurance/reset-password.php?reset='.$token.'</a></b>';
                $mail->send();
                echo 'Message has been sent';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
            echo "</div>";
            $msg = "<div class='alert alert-info'>We've sent a verification link to your email address</div>";
        }
        
    }else{
        $msg = "<div class='alert alert-danger'>$email - Invalid Email Address</div>";
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
                                    <h4 class="text-center mb-4 text-white">Forgot Password</h4>
                                    <?php echo $msg;?>
                                    <form method="POST">
                                        <div class="form-group">
                                            <label class="mb-1 text-white"><strong>Email</strong></label>
                                            <input type="email" name="email" class="form-control" placeholder="hello@example.com">
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" name="submit" class="btn bg-primary text-white btn-block">Send Reset Link</button>
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