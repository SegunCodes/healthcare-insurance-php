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
<?php
    $sql = mysqli_query($con,"SELECT * FROM users WHERE email = '{$_SESSION["SESSION_EMAIL"]}'");
    while ($row=mysqli_fetch_array($sql)) {
        $info = $row['info'];
        ?>
    <?php
        if ($info == "1") {
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
            <!-- row -->
			<div class="container-fluid">
                <div class="page-titles">
                </div>
                <!-- row -->


                <div class="row">
					<div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title text-primary">Allocated Hospital Info</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example3" class="display min-w850">
                                        <thead>
                                            <tr>
                                                <th>Hospital Name</th>
                                                <th>Address</th>
                                                <th>LGA</th>
                                                <th>State</th>
                                                <th>Mobile</th>
                                                <th>Email</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                        <?php 
                                        include('includes/db.php');
                                        $sql = mysqli_query($con,"SELECT * FROM patient WHERE email = '{$_SESSION["SESSION_EMAIL"]}'");
                                        //   var_dump($sql);
                                        while ($row=mysqli_fetch_array($sql)) {
                                            $pid = $row["patient_id"];
                                            // $p = $row['patient'];
                                            // $h = $row['hospital'];
                                            $sql1 = mysqli_query($con,"SELECT * FROM allocation WHERE patient ='{$pid}'");
                                            while ($rw=mysqli_fetch_array($sql1)) {
                                                $h = $rw["hospital"];
                                            }  
                                            @$sql2 = mysqli_query($con,"SELECT * FROM hospital WHERE hospital_id ='{$h}'");
                                            while ($w=mysqli_fetch_array($sql2)) {
                                                $id = $w["id"];
                                                $hname = $w["name"];
                                                $email = $w['email'];
                                                $phone = $w['phone'];
                                                $address = $w['address'];
                                                $lga = $w['lga'];
                                                $state = $w['state']; 
                                            }
                                        ?>
                                            <tr>
                                                <td><?php echo @$hname; ?></td>
                                                <td><?php echo @$address?></td>
                                                <td><?php echo @$lga?></td>       
                                                <td><?php echo @$state?></td>
                                                <td><a href="javascript:void(0);"><strong><?php echo @$phone?></a></strong></td>
                                                <td><a href="javascript:void(0);"><strong><?php echo @$email?></a></strong></td>
                                                <td>
													<div class="d-flex">
                                                    <a href="#" class="btn btn-primary showHospital shadow btn-xs sharp mr-1" id="<?php echo $id?>" ><i class="fa fa-eye"></i></a>
														<!-- <a onclick="return confirm('Are you sure you want to delete this Patient Info?')" href="delete-patient.php?del=" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a> -->
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
                                                <h5 class="modal-title">Hospital</h5>
                                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body" id="hospital_detail">
                                                
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
            $('.showHospital').click(function(){
                var showHospital = $(this).attr("id");

                $.ajax({
                    url: 'showAllocatedHospital.php',
                    method: 'post',
                    data: {showHospital:showHospital},
                    success:function(data){
                        $('#hospital_detail').html(data);
                        $('#modalGrid').modal('show');
                    }
                })
               
            })
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
<?php
    }else{
        header("location:patient-profile.php");
        exit();
    }
?>
<?php
    }           
?>
</html>