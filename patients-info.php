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
                <div class="page-titles">
                </div>
                <!-- row -->


                <div class="row">
					<div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title text-primary">Allocated Patients/Enrollees Info</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example3" class="display min-w850">
                                        <thead>
                                            <tr>
                                                <th>Patient Name</th>
                                                <th>Occupation</th>
                                                <th>Gender</th>
                                                <th>Mobile</th>
                                                <th>Email</th>
                                                <th>Date Of Birth</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                        <?php 
                                        $alldata=[];
                                        include('includes/db.php');
                                        $sql = mysqli_query($con,"SELECT * FROM hospital WHERE email = '{$_SESSION["SESSION_EMAIL1"]}'");
                                    
                                        while ($row=mysqli_fetch_array($sql)) {
                                            $hid = $row["hospital_id"];
                                            // $p = $row['patient'];
                                            // $h = $row['hospital'//];
                                            $sql1 = mysqli_query($con,"SELECT * FROM allocation WHERE hospital = $hid ");
                                            
                                            while ($rw=mysqli_fetch_array($sql1)) {
                                                $p = $rw["patient"];
                                                $mr = $rw["medic_record"];

                                                $sql2 = mysqli_query($con,"SELECT * FROM patient WHERE patient_id = $p");
                                                while ($w=mysqli_fetch_array($sql2)) {
                                                    $id = $w["id"];
                                                    // var_dump($id);
                                                    $pfname = $w["fname"];
                                                    $plname = $w["lname"];
                                                    $email = $w['email'];
                                                    $phone = $w['phone'];
                                                    $address = $w['address'];
                                                    $dob = $w['dob'];
                                                    $occupation = $w['occupation'];
                                                    $gender = $w['gender'];
                                                    $disability = $w['disability'];
                                                    $type = $w['type'];
                                                    $sickle = $w['sickle_cell'];
                                                    $pregnancy = $w['pregnancy'];
                                                    $blood = $w['blood_group'];
                                                    $genotype = $w['genotype']; 
                                                    $alldata[] = [
                                                        $id,$pfname,$plname,$email,$phone,$address,$dob,$occupation,
                                                        $gender,$disability,$type,$sickle,$pregnancy,$blood,$genotype,$hid,$p,$mr
                                                    ];
                                                    //  var_dump($alldata);
                                                    
                                                }
                                            }  
                                        ?>
                                        <?php
                                            include('includes/db.php');
                                            if (isset($_POST["submit"])) {
                                                $h = mysqli_real_escape_string($con, $_POST['hid']);
                                                $get = mysqli_real_escape_string($con, $_POST['get']);
                                                $sql = "SELECT * FROM allocation WHERE patient='{$get}'";
                                                $result = mysqli_query($con, $sql);
                                                if ($result) {
                                                    $update = mysqli_query($con, "UPDATE allocation SET medic_record = 'open' WHERE patient = $get");
                                                    $insert = mysqli_query($con, "INSERT INTO authorization(hospital_id, patient_id)
                                                    VALUES ('{$h}', '{$get}')");
                                                    if ($insert) {
                                                        echo "<script>alert('A mail will be sent to You with an Authorization code to begin a medical investigation on the patient')</script>";
                                                        echo "<script>window.location='patients-info.php'</script>";
                                                    }
                                                }
                                                
                                            }
                                        ?>
                                            <?php
                                            foreach ($alldata as $all) {?>                   
                                            <tr>
                                                <td><?php echo $all[1] . ' '; echo $all[2] ; ?></td>
                                                <td><?php echo $all[3] ?></td>
                                                <td><?php echo $all[4] ?></td>
                                                <td><a href="javascript:void(0);"><strong><?php echo $all[5] ?></a></strong></td>
                                                <td><a href="javascript:void(0);"><strong><?php echo $all[6] ?></a></strong></td>
                                                <td><?php echo $all[7] ?></td>
                                                <td>
													<div class="d-flex">
														<a href="#" class="btn btn-primary showPatient shadow sharp mr-1" id="<?php echo $all[0] ?>"><i class="fa fa-eye"></i></a>
                                                        <?php
                                                        if ($all[17] !== 'close') {
                                                            ?>
                                                            <a href="#" class="btn btn-success showCode" id="<?php echo $all[16]?>">Continue</a>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <form method="POST">
                                                                <input hidden name="hid" value="<?php echo $all[15]?>">
                                                                <input hidden name="get" required value="<?php echo $all[16]?>">
                                                                <button type="submit" name="submit" class="btn btn-block btn-xs btn-success">Open Medical Investigation</button>
                                                            </form>
                                                            <?php
                                                        }
                                                        ?>
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
                                                <h5 class="modal-title">Patient</h5>
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

                                <div class="modal fade" id="codeGrid">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Enter Authorization Code</h5>
                                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body" id="code_detail">
                                                
                                            </div>>
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

            //auth code form
            $('.showCode').click(function(){
                var showCode = $(this).attr("id");

                $.ajax({
                    url: 'showCode.php',
                    method: 'post',
                    data: {showCode:showCode},
                    success:function(data){
                        $('#code_detail').html(data);
                        $('#codeGrid').modal('show');
                    }
                })
               
            });

            $('.showPatient').click(function(){
                var showPatient = $(this).attr("id");

                $.ajax({
                    url: 'showAllocatedPatient.php',
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