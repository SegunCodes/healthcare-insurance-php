<?php include("template/header.php") ?>
<?php 
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
session_start();
if (isset($_SESSION["SESSION_EMAIL"])) {
    header("location: patient-profile.php");
    die();
}elseif (isset($_SESSION["SESSION_EMAIL1"])) {
    header("location: hospital-profile.php");
    die();
}
//Load Composer's autoloader
require 'vendor/autoload.php';
include('includes/db.php');
$msg="";
if(isset($_POST['submit']))
  {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $category = mysqli_real_escape_string($con, $_POST['category']);
    $password = mysqli_real_escape_string($con, md5($_POST['pass']));
    $cpass = mysqli_real_escape_string($con, md5($_POST['pass2']));
    $token = mysqli_real_escape_string($con, md5(rand()));
    $status = "Pending";
    if (mysqli_num_rows(mysqli_query($con, "SELECT * FROM users WHERE email='{$email}'")) > 0) {
        $msg = "<div class='alert alert-danger'>{$email} - This Email address already exists</div>";
    }else{
        if ($password === $cpass) {
           $sql = "INSERT INTO users(email, category, password, token, status) VALUES ('{$email}', '{$category}', '{$password}', '{$token}', '{$status}') ";
           $result = mysqli_query($con, $sql);
           if ($result) {
            echo "<div style='display:none;'>";
            //Create an instance; passing `true` enables exceptions
            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'shegstix64@gmail.com';                     //SMTP username
                $mail->Password   = 'makanjuola';                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom('shegstix64@gmail.com');
                $mail->addAddress($email);


                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'no reply';
                $mail->Body    = 'Here is the Verification link <b><a href="http://localhost/health-insurance/index.php?verification='.$token.'">http://localhost/health-insurance/index.php?verification='.$token.'</a></b>';
                $mail->send();
                echo 'Message has been sent';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
            echo "</div>";
            // var_dump($mail);
            $msg = "<div class='alert alert-info'>We've sent a verification link to your email address</div>";
           }else{ 
            $msg = "<div class='alert alert-danger'>Something Went Wrong!</div>";
           }
        }else{
            $msg = "<div class='alert alert-danger'>Passwords do not match</div>";
        }
    }
}

 ?>


<body class="h-100">
    
    <div class="authincation ">
        <div class="container-fluid no-gutters">
            <div class="row py-3 justify-content-center align-items-center">
                <div class="col-md-6">
					
					<div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
									<div class="text-center mb-3">
                                        <h3 class="text-center mb-4 text-white">Health Insurance Management System</h3>
										<a href="index.html"><img src="images/logo-full.png" alt=""></a>
									</div>
                                    <h4 class="text-center mb-4 text-white">Sign up your account</h4>
                                        <?php
                                            echo $msg;
                                        ?>                                  
                                    <form method="POST" id="register_form">
                                        <div class="form-group">
                                            <label class="mb-1 text-white"><strong>Email</strong></label>
                                            <input type="email" id="email" name="email" required class="form-control" placeholder="Enter your email address" value="<?php if (isset($_POST['submit'])) { echo $email; } ?>">
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1 text-white">Category</label>
                                            <select class="form-control default-select" required id="category" name="category">
                                                <option>---Select Category---</option>
                                                <option value="Hospital">Hospital</option>
                                                <option value="Patient">Patient</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1 text-white"><strong>Password</strong></label>
                                            <input type="password" required name="pass" id="pass1" class="form-control" placeholder="Enter Password">
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1 text-white"><strong>Confirm Password</strong></label>
                                            <input type="password" required id="pass2" name="pass2" class="form-control" placeholder="Confirm Password">
                                        </div>
                                        <div class="text-center form-group mt-4">
                                            <button type="submit" name="submit" id="submit" class="btn bg-primary text-white btn-block">Sign Up</button>
                                        </div>
                                    </form>
                                    <div class="new-account mt-3">
                                        <p class="text-white">Already have an account? <a class="text-white" href="index.php">Sign in</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!--**********************************
	Scripts
***********************************-->
<!-- Required vendors -->


</body>

<?php include("template/script.php") ?>

</html>