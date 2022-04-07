<?php include("template/header.php") ?>
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
session_start();
if (!isset($_SESSION["SESSION_EMAIL2"])) {
    header("location: index.php");
    die();
}
include('includes/db.php');
$query = mysqli_query($con, "SELECT * FROM users WHERE email='{$_SESSION['SESSION_EMAIL2']}'");
if (mysqli_num_rows($query)>0) {
    $row = mysqli_fetch_assoc($query);
}
//Load Composer's autoloader
require 'vendor/autoload.php';
include('includes/db.php');
$msg="";
if(isset($_POST['submit']))
//if the create user button is submitted
  {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $category = mysqli_real_escape_string($con, $_POST['category']);
    $password = mysqli_real_escape_string($con, md5($_POST['pass']));
    $cpass = mysqli_real_escape_string($con, md5($_POST['pass2'])); // encrypt password
    $token = mysqli_real_escape_string($con, md5(rand())); // encrypt password
    $status = "Pending";
    //check if the user already exists
    if (mysqli_num_rows(mysqli_query($con, "SELECT * FROM users WHERE email='{$email}'")) > 0) {
        $msg = "<div class='alert alert-danger'>{$email} - This Email address already exists</div>";
    }else{
        //if user doesn't exist and both passwords match
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
                $mail->Username   = 'youremail@mail.com';                     //SMTP username
                $mail->Password   = '******';                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom('youremail@mail.com');
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
            $msg = "<div class='alert alert-info'>We've sent a verification link to the email address</div>";
           }else{ 
            $msg = "<div class='alert alert-danger'>Something Went Wrong!</div>";
           }
        }else{
            // if user doesn't exist but passwords don't match
            $msg = "<div class='alert alert-danger'>Passwords do not match</div>";
        }
    }
}
?>
<body>

    <?php include("template/preloader.php") ?>

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <?php include "template/admin-header.php"; ?>

        <?php include "template/admin-sidebar.php"; ?>
        
        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->
            <div class="container-fluid">
				<div class="row">
					<div class="col-xl-6 col-xxl-12">
                        <div class="row mt-4 justify-content-center align-items-center">
                  
                            <div class="col-xl-10 col-lg-10">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="">Create User</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="basic-form">
                                        <?php
                                            echo $msg;
                                        ?> 
                                            <form method="POST" id="register_form">
                                                <div class="form-group">
                                                    <label class="mb-1"><strong>Email</strong></label>
                                                    <input type="email" id="email" name="email" required class="form-control" placeholder="Enter your email address" value="<?php if (isset($_POST['submit'])) { echo $email; } ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label class="mb-1"><strong>UserType</strong></label>
                                                    <select class="form-control default-select" required id="category" name="category">
                                                        <option>---Select Usertype---</option>
                                                        <option value="Hospital">Hospital</option>
                                                        <option value="Patient">Patient</option>
                                                        <option value="Admin">Admin</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="mb-1"><strong>Password</strong></label>
                                                    <input type="password" required name="pass" id="pass1" class="form-control" placeholder="Enter Password">
                                                </div>
                                                <div class="form-group">
                                                    <label class="mb-1"><strong>Confirm Password</strong></label>
                                                    <input type="password" required id="pass2" name="pass2" class="form-control" placeholder="Confirm Password">
                                                </div>
                                                <div class="text-center form-group mt-4">
                                                    <button type="submit" name="submit" id="submit" class="btn bg-primary text-white btn-block">Create User</button>
                                                </div>
                                            </form>
                                        </div>
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
            Content body end
        ***********************************-->

        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright © Designed &amp; Developed by <a href="http://dexignzone.com/" target="_blank">DexignZone</a> 2020</p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->

        <!--**********************************
        Support ticket button start
        ***********************************-->

        <!--**********************************
        Support ticket button end
        ***********************************-->


    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <?php include("template/script.php") ?>
    <script>
        function carouselReview(){
            /*  testimonial one function by = owl.carousel.js */
            jQuery('.testimonial-one').owlCarousel({
                loop:true,
                autoplay:true,
                margin:30,
                nav:false,
                dots: false,
                left:true,
                navText: ['<i class="fa fa-chevron-left" aria-hidden="true"></i>', '<i class="fa fa-chevron-right" aria-hidden="true"></i>'],
                responsive:{
                    0:{
                        items:1
                    },
                    484:{
                        items:2
                    },
                    882:{
                        items:3
                    },	
                    1200:{
                        items:2
                    },			
                    
                    1540:{
                        items:3
                    },
                    1740:{
                        items:4
                    }
                }
            })			
        }
        jQuery(window).on('load',function(){
            setTimeout(function(){
                carouselReview();
            }, 1000); 
        });
    </script>
</body>