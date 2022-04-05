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
            <!-- row -->
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-header">
                        <div class="row gutters-sm">
                            <div class="col-md-12 mb-0">
                              <div class="card">
                                <div class="card-body">
                                  <div class="d-flex flex-column align-items-center text-center">
                                    <!-- <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="150"> -->
                                    <div class="mt-1">
                                      <h3>Account Settings</h3>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              
                            </div>
                            <div class="col-md-12">
                              <div class="card mb-3">
                                <div class="card-body">
                                  <div class="row">
                                    <div class="col-sm-3">
                                      <h6 class="mb-0">Email</h6>
                                    </div>
                                    <div class="col-sm-9 text-black">
                                    <?php echo $_SESSION["SESSION_EMAIL"]?>
                                    </div>
                                  </div>
                                  <hr>
                                  <?php
                                    include('includes/db.php');
                                    $msg="";
                                    if (isset($_POST['submit'])) {
                                        $current = mysqli_real_escape_string($con, md5($_POST['current']));
                                        $password = mysqli_real_escape_string($con, md5($_POST['pass']));
                                        $cpass = mysqli_real_escape_string($con, md5($_POST['pass2']));
                                        $sql = "SELECT * FROM users WHERE email='{$_SESSION["SESSION_EMAIL"]}' AND password='{$current}'";
                                        $result = mysqli_query($con, $sql);
                                        if (mysqli_num_rows($result)==1) {
                                          $row = mysqli_fetch_assoc($result);
                                          if ($password === $cpass) {
                                              $query = mysqli_query($con, "UPDATE users SET password='{$password}' WHERE email='{$_SESSION["SESSION_EMAIL"]}'");
                                              if ($query) {
                                                $msg = "<div class='alert alert-success'>Password Changed!</div>";
                                              }
                                          }else{
                                              $msg = "<div class='alert alert-danger'>Passwords do not match</div>";
                                          }
                                        }else{
                                          $msg = "<div class='alert alert-danger'>Incorrect Password</div>";
                                        }
                                        
                                    }

                                  ?>
                                  <?php echo $msg;?>
                                  <form method="POST">
                                    <div class="form-group">
                                        <label class="mb-1"><strong>Current Password</strong></label>
                                        <input type="password" required name="current" id="pass1" class="form-control" placeholder="Enter Password">
                                    </div>
                                    <div class="form-group">
                                        <label class="mb-1"><strong>New Password</strong></label>
                                        <input type="password" required name="pass" id="pass1" class="form-control" placeholder="Enter Password">
                                    </div>
                                    <div class="form-group">
                                        <label class="mb-1"><strong>Confirm New Password</strong></label>
                                        <input type="password" required id="pass2" name="pass2" class="form-control" placeholder="Confirm Password">
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" name="submit" class="btn bg-primary text-white btn-block">Change Password</button>
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

</html>