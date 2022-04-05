<?php
include('includes/db.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
$email = $_GET['appr'];
$random_id = mt_rand(1000,9999);

$appr = mysqli_query($con, "UPDATE patient SET `status` = 'Approved', `patient_id` = '$random_id' WHERE email = '$email'");
require 'vendor/autoload.php';
if ($appr) {  
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'shegstix64@gmail.com';                     //SMTP username
        $mail->Password   = '*****';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('shegstix64@gmail.com');
        $mail->addAddress($email);


        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Profile Approval';
        $mail->Body    = 'Your Profile has been approved. '.$random_id.' is your Patient ID. Login to your account  to access your complete dashboard';
        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

	mysqli_close($con);
	header("location: patient-info.php");
	exit();
}
?>