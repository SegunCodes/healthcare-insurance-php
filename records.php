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
        if ($info == "1") { //if user info == 1 display this
        ?>
<body>

    <?php include("template/preloader.php") //load preloader?>

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <?php include "template/hospital-header.php"; //load hospital header?>

        <?php include "template/hospital-sidebar.php"; //load hospital sidebar?>
		
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
                                                <th>Patient Name</th>
                                                <th>Document Name</th>
                                                <th>View Record</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                        <?php 
                                        $allData=[];
                                        include('includes/db.php');
                                        //selecting hospital whose session is set
                                        $sql = mysqli_query($con,"SELECT * FROM hospital WHERE email = '{$_SESSION["SESSION_EMAIL1"]}'");//select specific hospital whose session is set
                                        while ($row=mysqli_fetch_array($sql)) {
                                            $hid = $row["hospital_id"];
                                            //select all from records where hospital_id is same as that of hospital in session
                                            $sql1 = mysqli_query($con,"SELECT * FROM records WHERE hospital = $hid");
                                            while ($rw=mysqli_fetch_array($sql1)) {
                                                $id = $rw["id"];
                                                $auth = $rw["auth_code"];
                                                $pid = $rw["patient"];
                                                $hd = $rw["hospital"];
                                                $document = $rw["document"];
                                                //select all from patient where the patient id is
                                                // same as patient_id in record table 
                                                // on same row(s) where hospital in session is found
                                                $sql2 = mysqli_query($con,"SELECT * FROM patient WHERE patient_id = $pid ");
                                                while ($w=mysqli_fetch_array($sql2)) {
                                                    $pfname = $w["fname"];
                                                    $plname = $w["lname"];
                                                }
                                                $allData[] = [
                                                    $id, $auth, $pid, $document, $pfname, $plname
                                                ];
                                                // var_dump($allData);
                                            }
                                            
                                        ?>
                                            <?php
                                            foreach ($allData as $all) {?> 
                                            <tr>
                                                <td><?php echo $all[4].' '.$all[5]; ?></td>
                                                <td><?php echo $all[3];?></td>
                                                <td>
                                                    <div class="d-flex">
														<a href="#" class="btn btn-primary showRecord shadow sharp mr-1" id="<?php echo $all[0]?>"><i class="fa fa-eye"></i></a>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a onclick="return confirm('Are you sure you want to delete this user?')" href="delete-record.php?del=<?php echo $all[0];?>" class="btn btn-danger shadow sharp"><i class="fa fa-trash"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php } ?>
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
            // ajax to display full record
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