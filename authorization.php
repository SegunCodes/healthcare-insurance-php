<?php include("template/header.php") ?>
<?php include("template/header.php") //include header file?>
<?php

session_start(); // session start
if (!isset($_SESSION["SESSION_EMAIL2"])) {
    header("location: index.php"); // if session isn't set, user is redirected to index page
    die();
}
include('includes/db.php');
$query = mysqli_query($con, "SELECT * FROM users WHERE email='{$_SESSION['SESSION_EMAIL2']}'");//select exact user from database whose session has begun
if (mysqli_num_rows($query)>0) {
    $row = mysqli_fetch_assoc($query);
}
?>
<body>

    <?php include("template/preloader.php") //load preloader?>

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <?php include "template/admin-header.php"; //load admin header?>

        <?php include "template/admin-sidebar.php"; // load admin sidebar?>
        
        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->
            <div class="container-fluid">
                <div class="page-titles">
                </div>
                <!-- row -->


                <div class="row">
					<div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title text-primary">Authorization</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example3" class="display min-w850">
                                        <thead>
                                            <tr>
                                                <th>Hospital Name</th>
                                                <th>Patient Name</th>
                                                <th>Authorization Code</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        include('includes/db.php');
                                        $sql = mysqli_query($con,"SELECT * FROM authorization"); //select all from authorization table
                                        while ($row=mysqli_fetch_array($sql)) {
                                            $id = $row["id"];
                                            $hid = $row['hospital_id'];
                                            $pid = $row['patient_id'];
                                            $status = $row['status'];
                                            $auth = $row['auth_code'];
                                            $sql2 = mysqli_query($con,"SELECT * FROM patient WHERE patient_id ='{$pid}'"); // selecting full name of patient whose patient-id is located in authorization table from patient table 
                                            while ($w=mysqli_fetch_array($sql2)) {
                                                $pfname = $w["fname"];
                                                $plname = $w["lname"];
                                            }
                                            $sql1 = mysqli_query($con,"SELECT * FROM hospital WHERE hospital_id ='{$hid}'"); //selecting hospital name of hospital whose h.id is in authorization table
                                            while ($rw=mysqli_fetch_array($sql1)) {
                                                $hname = $rw["name"];
                                                $hmail = $rw["email"];
                                            }

                                        ?>
                                        <?php
                                            include('includes/db.php');
                                            //script to handle authorization code generation
                                            if (isset($_POST["submit"])) {
                                                $id = mysqli_real_escape_string($con, $_POST['id']);
                                                $sql = "SELECT * FROM authorization WHERE id='{$id}'"; //select all from authorization
                                                $result = mysqli_query($con, $sql);
                                                if ($result) {
                                                    $random_id = mt_rand(10000,99999); // generate unique authorization code
                                                    $insert = mysqli_query($con, "UPDATE authorization SET auth_code = '$random_id' WHERE id = '$id'");
                                                    if ($insert) {
                                                        $to = $hmail;
                                                        $subject = "Authorization Code";
                                                        $message =  "The Authorization Code for Patient with name: $pfname $plname is $random_id"; //php mailer to handle mail sending
                                                        $headers =  'MIME-Version: 1.0' . "\r\n"; 
                                                        $headers .= "$hmail" . "\r\n";
                                                        if(mail($to, $subject,$message,$headers)){ 
                                                            echo "<script>alert('Authorization Code Sent')</script>";
                                                            echo "<script>window.location='authorization.php'</script>";
                                                        }
                                                        echo "<script>alert('Authorization Code Generated and sent')</script>";
                                                        echo "<script>window.location='authorization.php'</script>";
                                                    }
                                                }
                                                
                                            }elseif(isset($_POST["close"])){
                                                //if an authorization button is closed
                                                $id2 = mysqli_real_escape_string($con, $_POST['id']);
                                                $sql2 = "SELECT * FROM authorization WHERE id='{$id}'";
                                                $result2 = mysqli_query($con, $sql2);
                                                if ($result2) {
                                                    $update = mysqli_query($con, "UPDATE allocation SET medic_record = 'close' WHERE patient = $pid"); //close the medical record
                                                    $update2 = mysqli_query($con, "UPDATE authorization SET status = '0' WHERE id = '$id'");
                                                    if ($update2) {
                                                        echo "<script>alert('This Record is Closed')</script>";
                                                        echo "<script>window.location='authorization.php'</script>";
                                                    }
                                                }
                                            }
                                        ?>
                                        
                                            <tr>
                                                <td>
                                                <?php 
                                                echo $hname;?>
                                                </td>
                                                <td>
                                                   <?php echo $pfname.' '.$plname;?>
                                                </td>
                                                <td>
                                                   <?php echo $auth;?>
                                                </td>
                                                <td>
                                                   <?php
                                                    if ($status == 1) {
                                                        echo "Opened";
                                                    }else{
                                                        echo "Closed";
                                                    }
                                                   ?>
                                                </td>
                                                <td>
                                                  <div class="d-flex">
                                                  <?php
                                                    if ($auth == '') {
                                                        ?>
                                                        <form method="POST">
                                                            <input hidden name="id" required value="<?php echo $id?>">
                                                            <button type="submit" name="submit" class="btn btn-success">Authorize</button>
                                                        </form>
                                                        <?php
                                                    }else{
                                                        ?>
                                                        <form method="POST">
                                                            <input hidden name="id" required value="<?php echo $id?>">
                                                            <button type="submit" name="close" class="btn btn-danger <?php if ($status == 0) {
                                                                echo 'btn btn-danger disabled';
                                                            } ?>">Close</button>
                                                        </form>
                                                        <?php
                                                    }
                                                    ?>
                                                  </div>												
                                                </td>												
                                            </tr>
                                        
                                        <?php
                                        } ?>
                                        </tbody>
                                    </table>
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