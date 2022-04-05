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
                                <h4 class="card-title text-primary">Patient to Hospital Merge List</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example3" class="display min-w850">
                                        <thead>
                                            <tr>
                                                <th>Hospital Name</th>
                                                <th>Patient Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        include('includes/db.php');
                                        $sql = mysqli_query($con,"SELECT * FROM allocation");
                                        while ($row=mysqli_fetch_array($sql)) {
                                            $id = $row["id"];
                                            $p = $row['patient'];
                                            $h = $row['hospital'];  
                                            $sql2 = mysqli_query($con,"SELECT * FROM patient WHERE patient_id ='{$p}'");
                                            while ($w=mysqli_fetch_array($sql2)) {
                                                $pfname = $w["fname"];
                                                $plname = $w["lname"];
                                            }
                                            $sql1 = mysqli_query($con,"SELECT name FROM hospital WHERE hospital_id ='{$h}'");
                                            while ($rw=mysqli_fetch_array($sql1)) {
                                                $hname = $rw["name"];
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
                                                  <div class="d-flex">
                                                    <a onclick="return confirm('Are you sure you want to delete this Allocation?')" href="delete-allocation.php?del=<?php echo $id;?>" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
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