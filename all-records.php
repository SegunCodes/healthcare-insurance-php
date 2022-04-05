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
                                <h4 class="card-title text-primary">All Records</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example3" class="display min-w850">
                                        <thead>
                                            <tr>
                                                <th>Hospital Name</th>
                                                <th>Patient Name</th>
                                                <th>Authorization Code</th>
                                                <th>Document Name</th>
                                                <th>View Record</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                        <?php 
                                        include('includes/db.php');
                                        $sql = mysqli_query($con,"SELECT * FROM records");
                                        //   var_dump($sql);
                                        while ($row=mysqli_fetch_array($sql)) {
                                            $id = $row["id"];
                                            $auth = $row["auth_code"];
                                            $pname = $row["patient"];
                                            $hid = $row["hospital"];
                                            $document = $row["document"];
                                            $sql2 = mysqli_query($con,"SELECT * FROM patient WHERE patient_id ='{$pname}'");
                                            while ($w=mysqli_fetch_array($sql2)) {
                                                $pfname = $w["fname"];
                                                $plname = $w["lname"];
                                            }
                                            $sql1 = mysqli_query($con,"SELECT * FROM hospital WHERE hospital_id ='{$hid}'");
                                            while ($rw=mysqli_fetch_array($sql1)) {
                                                $hname = $rw["name"];
                                                $hmail = $rw["email"];
                                            }
                                        ?>
                                            <tr>
                                                <td><?php echo $hname; ?></td>
                                                <td><?php echo $pfname.' '.$plname; ?></td>
                                                <td><?php echo $auth; ?></td>
                                                <td><?php echo $document?></td>
                                                <td>
                                                    <div class="d-flex">
														<a href="#" class="btn btn-primary showRecord shadow sharp mr-1" id="<?php echo $id?>"><i class="fa fa-eye"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                       
                                        <?php
                                        } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="modal fade" id="modalGrid">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Record</h5>
                                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body" id="patient_detail">
                                                
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary"  data-dismiss="modal">Close</button>
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
        $(document).ready(function(){

        $('.showRecord').click(function(){
            var showPatient = $(this).attr("id");

            $.ajax({
                url: 'showRecord.php',
                method: 'post',
                data: {showPatient:showPatient},
                success:function(data){
                    $('#patient_detail').html(data);
                    $('#modalGrid').modal('show');
                }
            })
        
        });

        })
    </script>
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