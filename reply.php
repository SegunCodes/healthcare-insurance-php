<?php
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
require 'vendor/autoload.php';
if (isset($_POST["submit"])) {
    include('includes/db.php');
    $sender = mysqli_real_escape_string($con, $_POST["sender"]);
    $message = mysqli_real_escape_string($con, $_POST["message"]);
    $sql = mysqli_query($con, "UPDATE messages SET `reply` = '{$message}', `status` = 'Replied'  WHERE sender = '{$sender}'");
    if ($sql) {
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
            $mail->Subject = 'Message Response';
            $mail->Body    = 'Your Message has neen replied! Login to your dashboard to view the reply';
            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
        mysqli_close($con);
        header("location: allMessages.php");
        exit();

    }
}
?>