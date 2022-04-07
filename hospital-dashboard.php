<?php include("template/header.php") //include header file?>
<?php

session_start(); // session start
if (!isset($_SESSION["SESSION_EMAIL1"])) {
    header("location: index.php");  // if session isn't set, user is redirected to index page
    die();
}
include('includes/db.php');
$query = mysqli_query($con, "SELECT * FROM users WHERE email='{$_SESSION['SESSION_EMAIL1']}'"); //select exact user from database whose session has begun
if (mysqli_num_rows($query)>0) {
    $row = mysqli_fetch_assoc($query);
}
?>
<?php
  $sql = mysqli_query($con,"SELECT * FROM users WHERE email = '{$_SESSION["SESSION_EMAIL1"]}'");
  while ($row=mysqli_fetch_array($sql)) {
      $info = $row['info'];
      ?>
      <?php
        if ($info == "1") { // if info is 1 display the following
        ?>
<body>

    <?php include("template/preloader.php") ?>

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

    <?php include "template/hospital-header.php"; ?>

    <?php include "template/hospital-sidebar.php"; ?>
		
		<!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->
			<div class="container-fluid">
				<div class="row">
					<div class="col-xl-6 col-xxl-12">
						<div class="row">
							<div class="col-sm-6">
								<div class="card avtivity-card">
									<div class="card-body">
										<div class="media align-items-center">
											<span class="activity-icon bgl-success mr-md-4 mr-3">
												<i class="fas fa-file"></i>
											</span>
											<div class="media-body">
												<p class="fs-20 mb-2">No. of Patients/Enrollees</p>
												<span class="title text-black font-w600">3</span>
											</div>
										</div>
										<div class="progress" style="height:5px;">
											<div class="progress-bar bg-success" style="width: 100%; height:5px;" role="progressbar">
												<span class="sr-only">94% Complete</span>
											</div>
										</div>
									</div>
									<div class="effect bg-success"></div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="card avtivity-card">
									<div class="card-body">
										<div class="media align-items-center">
											<span class="activity-icon bgl-secondary  mr-md-4 mr-3">
												<i class="fas fa-bed"></i>
											</span>
											<div class="media-body">
												<p class="fs-20 mb-2">No. of Medical Investigations</p>
												<span class="title text-black font-w600">11</span>
											</div>
										</div>
										<div class="progress" style="height:5px;">
											<div class="progress-bar bg-secondary" style="width: 100%; height:5px;" role="progressbar">
												<span class="sr-only"></span>
											</div>
										</div>
									</div>
									<div class="effect bg-secondary"></div>
								</div>
							</div>
							<?php 
								include('includes/db.php');
								$sql = mysqli_query($con,"SELECT * FROM hospital WHERE email = '{$_SESSION['SESSION_EMAIL1']}'");
                                while ($row=mysqli_fetch_array($sql)) {
                                    $doctor = $row['doctor'];
                                    $nurse = $row['nurse']; ?>
                            <div class="col-sm-6">
								<div class="card avtivity-card">
									<div class="card-body">
										<div class="media align-items-center">
											<span class="activity-icon bgl-info  mr-md-4 mr-3">
												<i class="fas fa-bed"></i>
											</span>
											<div class="media-body">
												<p class="fs-20 mb-2">No. of Doctors</p>
												<span class="title text-black font-w600"><?php echo $doctor?></span>
											</div>
										</div>
										<div class="progress" style="height:5px;">
											<div class="progress-bar bg-info" style="width: 100%; height:5px;" role="progressbar">
												<span class="sr-only"></span>
											</div>
										</div>
									</div>
									<div class="effect bg-info"></div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="card avtivity-card">
									<div class="card-body">
										<div class="media align-items-center">
											<span class="activity-icon bgl-warning  mr-md-4 mr-3">
												<i class="fas fa-bed"></i>
											</span>
											<div class="media-body">
												<p class="fs-20 mb-2">No. of Nurses</p>
												<span class="title text-black font-w600"><?php echo $nurse?></span>
											</div>
										</div>
										<div class="progress" style="height:5px;">
											<div class="progress-bar bg-warning" style="width: 100%; height:5px;" role="progressbar">
												<span class="sr-only"></span>
											</div>
										</div>
									</div>
									<div class="effect bg-warning"></div>
								</div>
							</div>
							<?php
                                } ?>
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
<?php
    }else{ //if info is 0, display this
		?>
	<body>

		<?php include("template/preloader.php") ?>

		<!--**********************************
			Main wrapper start
		***********************************-->
		<div id="main-wrapper">

			<?php include "template/hospital-header.php"; ?>

			<?php include "template/hospital-sidebar.php"; ?>
			
			<!--**********************************
				Content body start
			***********************************-->
			<div class="content-body">
				<!-- row -->
				<div class="container-fluid">
					<div class="row">
						<div class="col-xl-6 col-xxl-12">
							<div class="row mt-4 justify-content-center align-items-center">
					
								<div class="col-xl-10 col-lg-10">
									<div class="card">
										<div class="card-header">
											<h5 class="">Complete Info</h5>
										</div>
										<div class="card-body">
											<div class="basic-form">
												<?php
													// script to validate hospital_id
													include('includes/db.php');
													$msg="";
													if (isset($_POST["submit"])) {
														$pid = mysqli_real_escape_string($con, $_POST["pid"]);
														$sql = "SELECT * FROM hospital WHERE hospital_id='{$pid}'";
														$result = mysqli_query($con, $sql);
													
														if (mysqli_num_rows($result)===1) {
															$row = mysqli_fetch_assoc($result);
															if ($row) { // if hospital id is correct update info == 1
																$approve = mysqli_query($con, "UPDATE users SET `info` = '1' WHERE email = '{$_SESSION['SESSION_EMAIL1']}'");
																echo "<script>window.location='hospital-dashboard.php'</script>";
															}
														}else{
															$msg = "<div class='alert alert-danger'>Incorrect Hospital ID</div>";
														}
													
													}
												?>
												<?php echo $msg;?>
												<form method="POST" id="validate_form">
													<div class="form-group">
														<label class="mb-1"><strong>Hospital ID</strong></label>
														<input type="text" required name="pid" id="pass1" class="form-control" placeholder="Enter ID">
													</div>
													<div class="text-center form-group mt-4">
														<button type="submit" name="submit" id="submit" class="btn bg-primary text-white btn-block">Enter</button>
													</div>
												</form>
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
    }
?>
<?php
    }           
?>
</html>