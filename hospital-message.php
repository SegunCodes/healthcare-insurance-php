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
<?php
  $sql = mysqli_query($con,"SELECT * FROM users WHERE email = '{$_SESSION["SESSION_EMAIL1"]}'");
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

    <?php include "template/hospital-header.php"; ?>

    <?php include "template/hospital-sidebar.php"; ?>
		
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
                                
                                <div class=" ml-0 ml-sm-4 ml-sm-0">
                                    <div class="toolbar mb-4" role="toolbar">
                                        <div class="btn-group mb-1">
                                            <h4>Send Message</h4>
                                        </div>
                                    </div>
                                    <div class="compose-content">
                                        <?php
                                            include('includes/db.php');
                                            $msg="";
                                            if (isset($_POST["submit"])) {
                                                $email = mysqli_real_escape_string($con, $_POST['email']);
                                                $subject = mysqli_real_escape_string($con, $_POST['subject']);
                                                $message = mysqli_real_escape_string($con, $_POST['message']);
                                                $status = "Pending";
                                                $filename = $_FILES['file']['name'];
                                                $tempname = $_FILES['file']['tmp_name'];
                                                $folder = 'includes/images/'.$filename;
                                                $move = move_uploaded_file($tempname, $folder);
                                                $sql = mysqli_query($con, "INSERT INTO messages(sender, subject, message, file, status)
                                                VALUES ('{$email}', '{$subject}', '{$message}', '{$filename}', '{$status}')");
                                                if ($sql) {
                                                    $to = "shegstix64@gmail.com";
                                                    $subject = "New Message Request";
                                                    $message =  "A new message awaits your response";
                                                    $headers =  'MIME-Version: 1.0' . "\r\n"; 
                                                    $headers .= "$email" . "\r\n";
                                                    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 
                                                    if(mail($to, $subject,$message,$headers)){ 
                                                        $msg = "<div class='alert alert-success'>Message Sent!</div>";
                                                    }
                                                    $msg = "<div class='alert alert-success'>Message Sent!</div>";
                                                } else {
                                                    $msg = "<div class='alert alert-danger'>Error</div>";
                                                }
                                                // var_dump($sql);
                                                
                                            }
                                        ?>
                                        <?php echo $msg; ?>
                                        <form method="POST" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <input hidden type="email" name="email" class="form-control bg-transparent" readonly value="<?php echo $_SESSION['SESSION_EMAIL1'];?>">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" required name="subject" class="form-control bg-transparent" placeholder=" Subject:">
                                            </div>
                                            <div class="form-group">
                                                <textarea required id="email-compose-editor" name="message" class="textarea_editor form-control bg-transparent" rows="15" placeholder="Enter text ..."></textarea>
                                            </div>
                                            <h5 class="mb-4"><i class="fa fa-paperclip"></i> Attachment</h5>
                                            <div class="form-group dropzone fallback">
                                                <input name="file" type="file">
                                            </div>
                                            <div class="text-left mt-4 mb-2">
                                                <button class="btn btn-primary btn-sl-sm mr-2" type="submit" name="submit"><span class="mr-2"><i class="fa fa-paper-plane"></i></span>Send</button>
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
    }else{
          header("location:hospital-profile.php");
        exit();
      }
  ?>
  <?php
    }           
  ?>
</html>