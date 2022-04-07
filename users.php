<?php include("template/header.php") //require header file ?>
<?php

session_start(); //session start
if (!isset($_SESSION["SESSION_EMAIL2"])) {
    header("location: index.php"); // if session isn't set, user will be redirected to index page
    die();
}
include('includes/db.php');
$query = mysqli_query($con, "SELECT * FROM users WHERE email='{$_SESSION['SESSION_EMAIL2']}'"); //selecting exact user whose session has started
if (mysqli_num_rows($query)>0) {
    $row = mysqli_fetch_assoc($query);
}
?>
<body>

    <?php include("template/preloader.php") //load preloader ?>

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
                                <h4 class="card-title text-primary">All Users</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example3" class="display min-w850">
                                        <thead>
                                            <tr>
                                                <th>Email</th>
                                                <th>Category</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        include('includes/db.php');
                                        // get all users
                                        $sql = mysqli_query($con,"SELECT * FROM users");
                                        while ($row=mysqli_fetch_array($sql)) {
                                            $id = $row['id'];
                                            $email = $row['email'];
                                            $category = $row['category'];
                                            $status = $row['status']; 
                                        ?>
                                        <tr>
                                            <td><?php echo $email; ?></td>
                                            <td><?php echo $category; ?></td>
                                            <td class="<?php if ($status == 'Active') {
                                                echo 'text-success';
                                            }else{ echo 'text-warning';} ?>"><?php echo $status; ?></td>
                                            <td>
                                                <div class="d-flex">
                                                <a onclick="return confirm('Are you sure you want to delete this user?')" href="delete-user.php?del=<?php echo $id;?>" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                                            </div>
                                            </td>
                                        </tr>
                                        <?php
                                        } ?>
                                        </tbody>
                                    </table>
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