<?php include("template/header.php") ?>
<?php

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
                <div class="page-titles">
                </div>
                <!-- row -->


                <div class="row">
					<div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title text-primary">Allocate Patient</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example3" class="display min-w850">
                                        <thead>
                                            <tr>
                                                <th>Hospital</th>
                                                <th>State</th>
                                                <th>LGA</th>
                                                <th>Ward</th>
                                                <th>Bed</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        include('includes/db.php');
                                        $sql = mysqli_query($con,"SELECT * FROM hospital ");
                                        while ($row=mysqli_fetch_array($sql)) {
                                            $id = $row['id'];
                                            $hid = $row['hospital_id'];
                                            $name = $row['name'];
                                            $email = $row['email'];
                                            $phone = $row['phone'];
                                            $state = $row['state'];
                                            $lga = $row['lga'];
                                            $address = $row['address'];
                                            $certificate = $row['certificate'];
                                            $file = $row['file'];
                                            $ward = $row['ward'];
                                            $bed = $row['bed'];
                                            $doctor = $row['doctor'];
                                            $nurse = $row['nurse'];
                                            $status = $row['status'];
                                            
                                        ?>
                                        <?php
                                            include('includes/db.php');
                                            $msg = "";
                                            if (isset($_POST["submit"])) {
                                                $h = mysqli_real_escape_string($con, $_POST['hid']);
                                                $get = mysqli_real_escape_string($con, $_POST['get']);
                                                $sql = "SELECT * FROM allocation WHERE patient='{$get}'";
                                                $result = mysqli_query($con, $sql);
                                                if (mysqli_num_rows($result)>0) {
                                                    echo "<script>alert('This Patient has already been allocated to a hospital')</script>";
                                                    echo "<script>window.location='allocate-patient.php'</script>";
                                                }else{
                                                    $insert = mysqli_query($con, "INSERT INTO allocation(patient, hospital)
                                                    VALUES ('{$get}', '{$h}')");
                                                    echo "<script>window.location='allocated-list.php'</script>";
                                                }
                                                
                                            }
                                        ?>
                                        <?php echo $msg ?>
                                        
                                            <tr>
                                                <td><?php echo $name?></td>
                                                <td><?php echo $state?></td>
                                                <td><?php echo $lga?></td>
                                                <td><?php echo $ward?></td>
                                                <td><?php echo $bed?></td>
                                                <td class="<?php if ($status == 'Approved') {
                                                    echo 'text-success';
                                                }else{ echo 'text-warning';} ?>"><?php echo $status; ?></td>
                                                <td>
                                                  <div class="d-flex">
                                                    <?php
                                                      if ($status !== 'Approved') {
                                                        echo '<a href="approve-hospital.php?appr='.$email.'" class="btn btn-xs mr-1 shadow btn-primary">Approve Hospital</a>';
                                                      }else{
                                                        ?>
                                                        <form method="POST">
                                                            <input hidden name="hid" value="<?php echo $hid?>">
                                                            <input hidden name="get" required value="<?php echo @$_GET["allocate"]?>">
                                                            <button type="submit" name="submit" class="btn btn-xs mr-1 shadow btn-success">Allocate Hospital</button>
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