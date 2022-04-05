<?php include("template/header.php") ?>
<?php 

session_start();
if (!isset($_SESSION["SESSION_EMAIL1"])) {
    header("location: index.php");
    die();
}
include('includes/db.php');
$query = mysqli_query($con, "SELECT * FROM users WHERE email='{$_SESSION['SESSION_EMAIL1']}'");
if (mysqli_num_rows($query)>0) {
    $row = mysqli_fetch_assoc($query);
}
?>
<body>

    <?php include("template/preloader.php") ?>

    <div id="main-wrapper">

        <?php include "template/hospital-header.php"; ?>

        <?php include "template/hospital-sidebar.php"; ?>

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Hospital</a></li>
						
					</ol>
                </div>
                <!-- row -->
                <div class="row justify-content-center align-items-center">
                 	<div class="col-xl-10 col-lg-10">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="">Complete profile</h5>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">

                                <?php
                                    
                                    include('includes/db.php');
                                    use PHPMailer\PHPMailer\PHPMailer;
                                    use PHPMailer\PHPMailer\SMTP;
                                    use PHPMailer\PHPMailer\Exception;
                                    require 'vendor/autoload.php';
                                    $msg="";
                                    if (isset($_POST["submit"])) {
                                        $name = mysqli_real_escape_string($con, $_POST['name']);
                                        $phone = mysqli_real_escape_string($con, $_POST['phone']);
                                        $email = mysqli_real_escape_string($con, $_POST['email']);
                                        $stat = mysqli_real_escape_string($con, $_POST['state']);
                                        $state = mysqli_query($con,"SELECT name FROM states WHERE id = {$stat}");
                                        $rw=mysqli_fetch_array($state);
                                        $rw["name"];
                                        // var_dump($rw);
                                        $lg = mysqli_real_escape_string($con, $_POST['lga']);
                                        $lga = mysqli_query($con, "SELECT name FROM local_governments WHERE id = {$lg}");
                                        $w=mysqli_fetch_array($lga);
                                        $w["name"];
                                        // var_dump($w);
                                        $address = mysqli_real_escape_string($con, $_POST['address']);
                                        $fname = mysqli_real_escape_string($con, $_POST['filename']);
                                        $ward = mysqli_real_escape_string($con, $_POST['ward']);
                                        $bed = mysqli_real_escape_string($con, $_POST['bed']);
                                        $doctor = mysqli_real_escape_string($con, $_POST['doctor']);
                                        $nurse = mysqli_real_escape_string($con, $_POST['nurse']);
                                        $filename = $_FILES['file']['name'];
                                        $tempname = $_FILES['file']['tmp_name'];
                                        $folder = 'includes/images/'.$filename;
                                        $move = move_uploaded_file($tempname, $folder);
                                        // var_dump($move);
                                        if (mysqli_num_rows(mysqli_query($con, "SELECT * FROM hospital WHERE email='{$email}'")) > 0) {
                                            $sqli = "UPDATE `hospital` SET `name`='{$name}',`phone`='{$phone}',
                                            `email`='{$email}',`state`='{$rw["name"]}',`lga`='{$w["name"]}',
                                            `address`='{$address}',`certificate`='{$fname}',`file`='{$filename}',
                                            `ward`='{$ward}',`bed`='{$bed}',
                                            `doctor`='{$doctor}',`nurse`='{$nurse}'
                                             WHERE email='{$email}'";
                                            $results = mysqli_query($con, $sqli);
                                            // var_dump($sql);
                                            if ($results) {
                                                $msg = "<div class='alert alert-success'>Profile Successfully Updated!</div>";
                                            } else {
                                                $msg = "<div class='alert alert-danger'>Unexpected Error!Please Try Again</div>";
                                            }
                                        }else{
                                            $sql = "INSERT INTO `hospital`(`name`, `phone`, `email`, `state`, `lga`, `address`, 
                                            `certificate`, `file`, `ward`, `bed`, `doctor`, `nurse`) 
                                            VALUES ('{$name}','{$phone}','{$email}','{$rw["name"]}','{$w["name"]}','{$address}',
                                            '{$fname}','{$filename}','{$ward}','{$bed}','{$doctor}','{$nurse}')";

                                            $result = mysqli_query($con, $sql);
                                            // var_dump($sql);
                                            if ($result) {
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
                                                    $mail->Subject = 'Profile Approval Request';
                                                    $mail->Body    = 'A new profile awaits your approval';
                                                    $mail->send();
                                                    echo 'Message has been sent';
                                                } catch (Exception $e) {
                                                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                                                }
                                                $msg = "<div class='alert alert-success'>Profile successfully Updated! A mail will be sent to You once your profile has been activated</div>";
                                            } else {
                                                $msg = "<div class='alert alert-danger'>Unexpected Error!Please Try Again</div>";
                                            }
                                        }
                                        
                                    }
                                    ?>
                                    <?php echo $msg; ?>
                                    <?php 
                                    include('includes/db.php');
                                    $sql = mysqli_query($con,"SELECT * FROM hospital WHERE email = '{$_SESSION["SESSION_EMAIL1"]}'");
                                    if (mysqli_num_rows($sql)<1) {
                                       include("formh.php");
                                    }else{
                                        while ($row=mysqli_fetch_array($sql)) {
                                            ?>
                                    <form method="POST" enctype="multipart/form-data">
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label>Hospital name</label>
                                                <input type="text" class="form-control" value="<?php echo $row["name"]; ?>" required name="name" placeholder="Hospital name">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Phone number</label>
                                                <input type="text" name="phone" value="<?php echo $row["phone"]; ?>" required class="form-control" placeholder="e.g 08000000">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Email</label>
                                                <input type="email" readonly value="<?php echo $_SESSION["SESSION_EMAIL1"]?>" name="email" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label>State</label>
                                                <select id="inputState" required name="state" class="state form-control default-select">
                                                    <option selected>Choose...</option>
                                                    <?php
                                                       include('includes/db.php');
                                                        $sql = mysqli_query($con, "SELECT * FROM states ORDER BY name");
                                                        while ($ww = mysqli_fetch_array($sql)) {
                                                            ?>
                                                                    <option value="<?php echo $ww["id"]?>" <?php if ($ww['name'] == $row["state"]) {
                                                                echo 'Selected';
                                                            } ?> ><?php echo $ww["name"]; ?></option>
                                                                    <?php
                                                        } ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>L.G.A</label>
                                                <select required id="inputlga" name="lga" class="city form-control default-select">
                                                    <option selected>Choose...</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label>Address</label>
                                                <textarea class="form-control" name="address" cols="50" rows="3"><?php echo $row["address"]; ?></textarea>
                                            </div>
                                           
                                        </div>
                                        <div class="card-header mb-0 pb-0">
                                            <h5 class="">Hospital Information</h5>
                                        </div>
                                        <div class="form-group mt-4">
                                            <label>Certificate of Registration</label>
                                            <div class="input-group  col-md-7 my-2 mb-5" id="file_item">
                                                <div class="form-group col-md-12">
                                                    <label>File Name</label>
                                                    <input type="text" value="<?php echo $row["certificate"]; ?>" required class="form-control" name="filename" placeholder="Certificate name">
                                                </div><br>
                                                <div class="form-group col-md-12">
                                                    <label>Uploaded File</label>
                                                    <div class="custom-file">
                                                        <input type="file" name="file" class="custom-file-input">
                                                        <label name="file"  class="custom-file-label">Change Image</label>
                                                    </div> 
                                                    <img height="100" width="100" src="includes/images/<?php echo $row["file"];?>">
                                                </div>                                               
                                            </div> 
                                            <div class="form-row">
                                               
                                                <div class="form-group col-md-6 d-block">
                                                    <label >No. of Wards</label>
                                                    <input type="text" value="<?php echo $row["ward"]; ?>" required name="ward" class="form-control form-control-sm">
                                                </div>
                                                <div class="form-group col-md-4 d-block">
                                                    <label >No. of Bed spaces</label>
                                                    <input type="text" value="<?php echo $row["bed"]; ?>" required name="bed" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                
                                                <div class="form-group col-md-4 d-block">
                                                    <label >No. of Doctors</label>
                                                    <input type="text" required value="<?php echo $row["doctor"]; ?>" name="doctor" class="form-control form-control-sm">
                                                </div>
                                                <div class="form-group col-md-4 d-block">
                                                    <label >No. of Nurses</label>
                                                    <input type="text" value="<?php echo $row["nurse"]; ?>" name="nurse" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" name="submit" class="btn btn-primary">Update</button>
                                    </form>
                                    <?php
                                        }
                                    }
                                    ?>
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
  
    
    <?php include("template/script.php") ?>
    <script>
        $(document).ready(function(){
           $(".state").change(function() {
            var state_id = $(this).val();
            $.ajax({
                url: "city_query.php",
                method:"POST",
                data:{state_id:state_id},               
                success:function(data){
                console.log(data)
                $(".city").html(data);
                }
            });   
           });

            

        });
    </script>


</body>
</html>