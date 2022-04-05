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
					<div class="col-xl-6 col-xxl-12">
                        <div class="row mt-4 justify-content-center align-items-center">
                  
                            <div class="col-xl-10 col-lg-10">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="">Open Medical Investigation</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="basic-form"> 
                                        <?php
                                            include('includes/db.php');
                                            $msg = "";
                                            if(isset($_POST['upload']))
                                                {
                                                $patient = mysqli_real_escape_string($con, $_POST['pname']);
                                                $code = mysqli_real_escape_string($con, $_POST['code']);
                                                $document = mysqli_real_escape_string($con, $_POST['name']);
                                                $hospital = mysqli_real_escape_string($con, $_POST['hospital']);
                                                $date = date("Y/M/D h:i:a");
                                                $filecount = count($_FILES['file']['name']);
                                                for ($i=0; $i < $filecount; $i++) { 
                                                    $filename = $_FILES['file']['name'][$i];
                                                    $sql = mysqli_query($con, "INSERT INTO records(`patient`, `auth_code`, `document`, `file`, `hospital`, `date`)
                                                    VALUES ('{$patient}', '{$code}', '{$document}', '{$filename}', '{$hospital}', '{$date}')");
                                                    if ($sql) {
                                                        $msg = "<div class='alert alert-success'>Document Uploaded!</div>";
                                                    } else {
                                                        $msg = "<div class='alert alert-danger'>Error in Uploading</div>";
                                                    }
                                                }
                                                @$move = move_uploaded_file($_FILES['file']['tmp_name'][$i], 'includes/images/'.$filename);
                                                // var_dump($move);
                                            }
                                            $sql1 = mysqli_query($con,"SELECT * FROM authorization WHERE auth_code = '{$_GET["auth"]}'");
                                            // var_dump($_GET["auth"]);
                                            while($row=mysqli_fetch_array($sql1)){
                                                 $hid = $row["hospital_id"];
                                                 $pid = $row["patient_id"];                                                
                                            }
                                        ?>
                                            <?php echo $msg;?>
                                            <form method="POST" enctype="multipart/form-data">
                                                <div class="form-row" id="file-item">
                                                    <div class="form-group col-md-6">
                                                        <label class="mb-1"><strong>Document Name</strong></label>
                                                        <input type="name" name="name" required class="form-control">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="mb-1"><strong>Upload Document</strong></label>
                                                        <input type="file" multiple required name="file[]" class="form-control">
                                                    </div>
                                                </div>
                                                <!-- <div required class="form-group">
                                                    <button class="btn btn-primary btn-sm" id="add">Add File</button>
                                                    <button class="btn btn-sm btn-danger" id="remove">Remove File</button>
                                                </div> -->
                                                <div class="form-group">
                                                    <!-- <label class="mb-1"><strong>Auth Code</strong></label> -->
                                                    <input hidden type="text" name="code" value="<?php echo $_GET["auth"];?>" required class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <!-- <label class="mb-1"><strong>Patient ID</strong></label> -->
                                                    <input hidden type="text" name="pname" value="<?php echo $pid;?>" required class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <!-- <label class="mb-1"><strong>Hospital ID</strong></label> -->
                                                    <input hidden type="text" name="hospital" readonly class="form-control" value="<?php echo $hid;?>">
                                                </div>
                                                <div class="text-center form-group mt-4">
                                                    <button type="submit" name="upload" id="submit" class="btn bg-primary text-white btn-block">Upload</button>
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
        addNewRow();

        $("#add").click(function(){
            addNewRow();
        })

        function addNewRow(){
            $.ajax({
                url: "new_row.php",
                method:"POST",
                data:{getNewItem:1},
                success:function(data){
                    $("#file_item").append(data);
                    var n = 0;
                    $(".number").each(function(){
                        $(this).html(++n);
                    })
                }
            })
        }

        $("#remove").click(function(){
            $("#file_item").children("tr:last").remove();
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
          header("location:hospital-profile.php");
        exit();
      }
  ?>
  <?php
    }           
  ?>
</html>