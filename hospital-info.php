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
                                <h4 class="card-title text-primary">Hospitals</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example3" class="display min-w850">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Wards</th>
                                                <th>File</th>
                                                <th>Status</th>
                                                <th>Phone</th>
                                                <th>Email</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        include('includes/db.php');
                                        $sql = mysqli_query($con,"SELECT * FROM hospital "); //select * from hospital
                                        while ($row=mysqli_fetch_array($sql)) {
                                            //selecting each row in hospital table
                                            $id = $row['id'];
                                            $name = $row['name'];
                                            $email = $row['email'];
                                            $phone = $row['phone'];
                                            $state = $row['state'];
                                            $lga = $row['lga'];
                                            $address = $row['address'];
                                            $certificate = $row['certificate'];
                                            $file = $row['file'];
                                            $ward = $row['ward'];
                                            $bed = $row['bed'];
                                            $doctor = $row['doctor'];
                                            $nurse = $row['nurse'];
                                            $status = $row['status'];
                                            
                                        ?>
                                        
                                            <tr>
                                                <td><?php echo $name?></td>
                                                <td><?php echo $ward?></td>
                                                <td><img height="70" width="70" src="includes/images/<?php echo $file?>"></td>
                                                <td class="<?php if ($status == 'Approved') {
                                                    echo 'text-success';
                                                }else{ echo 'text-warning';} ?>"><?php echo $status; ?></td>
                                                <td><a href="javascript:void(0);"><strong><?php echo $phone?></strong></a></td>
                                                <td><a href="javascript:void(0);"><strong><?php echo $email?></strong></a></td>
                                                <td>
                                                  <div class="d-flex">
                                                    <a href="#" class="btn btn-primary showHospital shadow btn-xs sharp mr-1" id="<?php echo $id?>" ><i class="fa fa-eye"></i></a>
                                                    <a onclick="return confirm('Are you sure you want to delete this Hospital Info?')" href="delete-hospital.php?del=<?php echo $id;?>" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                                                    <?php
                                                      if ($status !== 'Approved') {
                                                          //if status is approved, display this
                                                        echo '<a href="approve-hospital.php?appr='.$email.'" class="btn btn-xs mr-1 shadow btn-primary">Approve Hospital</a>';
                                                      }else{
                                                          //if status isn't approved, display this
                                                        echo '<a href="disapprove-hospital.php?dis='.$email.'" class="btn btn-xs mr-1 shadow btn-warning">Disapprove Hospital</a>';
                                                      }
                                                    ?>
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
            // ajax script to view full hospital info
            $('.showHospital').click(function(){
                var showHospital = $(this).attr("id");

                $.ajax({
                    url: 'showHospital.php',
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