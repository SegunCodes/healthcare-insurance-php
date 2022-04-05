<?php include("template/header.php") ?>
<?php 

session_start();
if (!isset($_SESSION["SESSION_EMAIL"])) {
    header("location: index.php");
    die();
}
include('includes/db.php');
$query = mysqli_query($con, "SELECT * FROM users WHERE email='{$_SESSION['SESSION_EMAIL']}'");
if (mysqli_num_rows($query)>0) {
    $row = mysqli_fetch_assoc($query);
}
?>
<body>

    <?php include("template/preloader.php") ?>


    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <?php include "template/patient-header.php"; ?>
        
        <?php include "template/patient-sidebar.php"; ?>

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Patient</a></li>
						
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
                                        $fname = mysqli_real_escape_string($con, $_POST['fname']);
                                        $lname = mysqli_real_escape_string($con, $_POST['lname']);
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
                                        $occupation = mysqli_real_escape_string($con, $_POST['occupation']);
                                        $address = mysqli_real_escape_string($con, $_POST['address']);
                                        $dob = mysqli_real_escape_string($con, $_POST['dob']);
                                        $gender = mysqli_real_escape_string($con, $_POST['gender']);
                                        $disability = mysqli_real_escape_string($con, $_POST['disability']);
                                        $type = mysqli_real_escape_string($con, $_POST['type']);
                                        $sickle = mysqli_real_escape_string($con, $_POST['sicklecell']);
                                        $pregnancy = mysqli_real_escape_string($con, $_POST['pregnancy']);
                                        $bloodgroup = mysqli_real_escape_string($con, $_POST['bloodgroup']);
                                        $genotype = mysqli_real_escape_string($con, $_POST['genotype']);
                                        if (mysqli_num_rows(mysqli_query($con, "SELECT * FROM patient WHERE email='{$email}'")) > 0) {
                                            $sqli = "UPDATE `patient` SET `fname`='{$fname}',`lname`='{$lname}',
                                            `phone`='{$phone}',`email`='{$email}',`state`='{$rw["name"]}',`lga`='{$w["name"]}',
                                            `occupation`='{$occupation}',`address`='{$address}',`dob`='{$dob}',`gender`='{$gender}',
                                            `disability`='{$disability}',`type`='{$type}',`sickle_cell`='{$sickle}',`pregnancy`='{$pregnancy}',
                                            `blood_group`='{$bloodgroup}',`genotype`='{$genotype}' WHERE email='{$email}'";
                                            $results = mysqli_query($con, $sqli);
                                            // var_dump($sql);
                                            if ($results) {
                                                $msg = "<div class='alert alert-success'>Profile Successfully Updated!</div>";
                                            } else {
                                                $msg = "<div class='alert alert-danger'>Unexpected Error!Please Try Again</div>";
                                            }
                                        }else{
                                            $sql = "INSERT INTO `patient`(`fname`, `lname`, `phone`, `email`, `state`, `lga`, `occupation`, `address`, 
                                            `dob`, `gender`, `disability`, `type`, `sickle_cell`, `pregnancy`, `blood_group`, `genotype`) 
                                            VALUES ('{$fname}','{$lname}','{$phone}','{$email}','{$rw["name"]}','{$w["name"]}','{$occupation}','{$address}',
                                            '{$dob}','{$gender}','{$disability}','{$type}','{$sickle}','{$pregnancy}','{$bloodgroup}','{$genotype}')";

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
                                    $sql = mysqli_query($con,"SELECT * FROM patient WHERE email = '{$_SESSION["SESSION_EMAIL"]}'");
                                    if (mysqli_num_rows($sql)<1) {
                                        include("formp.php");
                                    }else{
                                    while ($row=mysqli_fetch_array($sql)) {
                                        ?>
                                    <form method="POST">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>First name</label>
                                                <input type="text" required class="form-control" value="<?php echo $row["fname"]; ?>" name="fname"  placeholder="First name" >
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Last name</label>
                                                <input type="text" required class="form-control" name="lname" value="<?php echo $row["lname"]; ?>" placeholder="Last name">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Phone number</label>
                                                <input type="text" required class="form-control" value="<?php echo $row["phone"]; ?>"  name="phone" placeholder="e.g 08000000">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Email</label>
                                                <input type="email" required readonly name="email" value="<?php echo $_SESSION["SESSION_EMAIL"]?>" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-7">
                                                <label>State</label>
                                                <select id="inputState" required name="state" class="state form-control default-select">
                                                    <option selected="selected">Choose...</option>
                                                    <?php
                                                       include('includes/db.php');
                                                        $sql = mysqli_query($con, "SELECT * FROM states ORDER BY name");
                                                        while ($ww = mysqli_fetch_array($sql)) {
                                                            ?>
                                                        <option value="<?php echo $ww["id"]?>" <?php if($ww['name'] == $row["state"]) echo 'Selected';?> ><?php echo $ww["name"]; ?></option>
                                                        <?php
                                                          }
                                                        ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-5">
                                                <label>L.G.A</label>
                                                <select id="inputlga" name="lga" class="city form-control default-select">
                                                    <option selected>Choose...</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="">Occupation</label>
                                                <input type="text" required value="<?php echo $row["occupation"]; ?>" name="occupation" class="form-control">
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label>Address</label>
                                                <textarea class="form-control" required name="address" id="" cols="50" rows="3"><?php echo $row["address"]; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="card-header mb-0 pb-0">
                                            <h5 class="">Health Information</h5>
                                        </div>
                                        <div class="form-group mt-4">
                                          
                                            <div class="form-row">
                                                <div class="form-group col-md-6 d-block">
                                                    <label >Date of birth</label>
                                                    <input name="dob" value="<?php echo $row["dob"]; ?>" required type="date" placeholder="04/22/1999....." class="datepicker form-control form-control-sm" id="datepicker">
                                                </div>
                                                <div class="form-group col-md-6 d-block">
                                                    <label >Gender</label>
                                                    <select name="gender" required id="gender"  class="form-control form-control-sm default-select">
                                                        <option  selected value="null">Choose...</option>
                                                        <option <?php if($row["gender"] == 'male') echo 'Selected';?>  value="male">male</option>
                                                        <option <?php if($row["gender"] == 'Female') echo 'Selected';?> value="Female">female</option>
                                                   </select>
                                                </div>
                                                <div class="form-group col-md-6 d-block">
                                                    <label >Disability</label>
                                                   <select name="disability" required id="Disability" class="form-control form-control-sm default-select">
                                                        <option selected value="null">Choose...</option>
                                                        <option <?php if($row["disability"] == 'yes') echo 'Selected';?>  value="yes">yes</option>
                                                        <option <?php if($row["disability"] == 'no') echo 'Selected';?>  value="no">no</option>
                                                   </select>
                                                </div>
                                                <div class="form-group col-md-6 d-block">
                                                    <label >type</label>
                                                   <select name="type" required id="type" class="form-control form-control-sm default-select">
                                                        <option selected value="null">Choose...</option>
                                                        <option <?php if($row["type"] == 'blind') echo 'Selected';?> value="blind">blind</option>
                                                        <option <?php if($row["type"] == 'dumb') echo 'Selected';?> value="dumb">dumb</option>
                                                        <option <?php if($row["type"] == 'deaf') echo 'Selected';?> value="deaf">deaf</option>
                                                        <option <?php if($row["type"] == 'other') echo 'Selected';?> value="other">other</option>
                                                        <option <?php if($row["type"] == 'none') echo 'Selected';?>  none="none">none</option>
                                                   </select>
                                                </div>

                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6 d-block">
                                                    <label >Sickle cell</label>
                                                    <select id="sicklecell" required name="sicklecell" class="form-control form-control-sm default-select">
                                                        <option selected value="null">Choose...</option>
                                                        <option <?php if($row["sickle_cell"] == 'yes') echo 'Selected';?> value="yes">yes</option>
                                                        <option <?php if($row["sickle_cell"]== 'no') echo 'Selected';?> value="no">no</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6 d-block">
                                                    <label >Pregnancy</label>
                                                    <select id="Pregnancy" required name="pregnancy" class="form-control form-control-sm default-select">
                                                        <option selected value="null">Choose...</option>
                                                        <option <?php if($row["pregnancy"] == 'yes') echo 'Selected';?> value="yes">yes</option>
                                                        <option <?php if($row["pregnancy"] == 'no') echo 'Selected';?> value="no">no</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6 d-block">
                                                    <label >Blood group</label>
                                                    <select id="bloodgroup" required name="bloodgroup" class="form-control form-control-sm default-select">
                                                        <option selected value="null">Choose...</option>
                                                        <option <?php if($row["blood_group"] == 'A') echo 'Selected';?> value="A">A</option>
                                                        <option <?php if($row["blood_group"] == 'B') echo 'Selected';?> value="B">B</option>
                                                        <option <?php if($row["blood_group"] == 'AB') echo 'Selected';?> value="AB">AB</option>
                                                        <option <?php if($row["blood_group"] == 'O+') echo 'Selected';?> value="O+">0+</option>
                                                        <option <?php if($row["blood_group"] == 'O-') echo 'Selected';?> value="O-">0-</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6 d-block">
                                                    <label >Genotype</label>
                                                    <select id="genotype" required name="genotype" class="form-control form-control-sm default-select">
                                                        <option selected value="null">Choose...</option>
                                                        <option <?php if($row["genotype"] == 'AA') echo 'Selected';?> value="AA">AA</option>
                                                        <option <?php if($row["genotype"] == 'AS') echo 'Selected';?> value="AS">AS</option>
                                                        <option <?php if($row["genotype"] == 'SS') echo 'Selected';?> value="SS">SS</option>
                                                        <option <?php if($row["genotype"] == 'AC') echo 'Selected';?> value="AC">AC</option>
                                                    </select>
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