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
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                        <?php 
                                        include('includes/db.php');
                                        $sql = mysqli_query($con,"SELECT * FROM records");//select all info from records table
                                        //   var_dump($sql);
                                        while ($row=mysqli_fetch_array($sql)) {
                                            // selecting each row in records table
                                            $id = $row["id"];
                                            $auth = $row["auth_code"];
                                            $pname = $row["patient"];
                                            $hid = $row["hospital"];
                                            $document = $row["document"];
                                            $sql2 = mysqli_query($con,"SELECT * FROM patient WHERE patient_id ='{$pname}'");//selecting the patient whose patient_id is in records table from patients table
                                            while ($w=mysqli_fetch_array($sql2)) {
                                                $pfname = $w["fname"];
                                                $plname = $w["lname"];
                                            }
                                            $sql1 = mysqli_query($con,"SELECT * FROM hospital WHERE hospital_id ='{$hid}'");//selecting the hospital whose hospital_id is in records table from hospital table
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
														<a href="#" class="btn btn-primary showRecord shadow sharp mr-1" id="<?php echo $id //this will target the exact id to which full will be displayed?>"><i class="fa fa-eye"></i></a>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a onclick="return confirm('Are you sure you want to delete this user?')" href="del-record.php?del=<?php echo $id;?>" class="btn btn-danger shadow sharp"><i class="fa fa-trash"></i></a>
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
                <p>Copyright ?? Designed &amp; Developed by <a href="http://dexignzone.com/" target="_blank">DexignZone</a> 2020</p>
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

        $('.showRecord').click(function(){ //if the field with className .showRecord is clicked
            var showPatient = $(this).attr("id");

            $.ajax({
                //ajax query to show record when view button is clicked
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