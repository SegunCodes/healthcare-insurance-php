<?php include("template/header.php") ?>
<?php

session_start();
if (!isset($_SESSION["SESSION_EMAIL2"])) {
    header("location: index.php");
    die();
}
include('includes/db.php');
$query = mysqli_query($con, "SELECT * FROM users WHERE email='{$_SESSION['SESSION_EMAIL2']}'");
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

        <?php include "template/admin-header.php"; ?>

        <?php include "template/admin-sidebar.php"; ?>
        
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
                                                <span class="title text-black font-w600">31</span>
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
                                            <span class="activity-icon bgl-warning  mr-md-4 mr-3">
                                                <i class="fas fa-bed"></i>
                                            </span>
                                            <div class="media-body">
                                                <p class="fs-20 mb-2">Vetted Patients/Enrollees</p>
                                                <span class="title text-black font-w600">11</span>
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
                            <div class="col-sm-6">
                                <div class="card avtivity-card">
                                    <div class="card-body">
                                        <div class="media align-items-center">
                                            <span class="activity-icon bgl-secondary  mr-md-4 mr-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" version="1.0" width="43px" height="68px" viewBox="0 0 830.000000 1280.000000" preserveAspectRatio="xMidYMid meet">
                                                    <metadata>
                                                    Created by potrace 1.15, written by Peter Selinger 2001-2017
                                                    </metadata>
                                                    <g transform="translate(0.000000,1280.000000) scale(0.100000,-0.100000)" fill="#000000" stroke="none">
                                                    <path d="M6045 12787 c-345 -88 -650 -520 -724 -1022 -16 -115 -19 -189 -77 -1980 -31 -946 -57 -1722 -59 -1724 -2 -2 -446 -103 -987 -225 l-983 -222 -3 51 c-1 27 18 667 42 1420 35 1053 43 1392 36 1465 -33 320 -168 564 -365 660 -39 19 -342 103 -881 245 -886 232 -891 233 -1014 200 -350 -93 -662 -557 -719 -1070 -14 -125 -303 -8896 -304 -9250 -2 -234 0 -269 20 -351 62 -261 183 -445 346 -523 90 -43 1647 -451 1747 -458 94 -6 176 14 285 70 145 75 324 274 423 472 84 168 143 384 162 584 5 64 35 901 66 1861 31 960 58 1746 59 1748 8 9 1966 444 1972 439 4 -4 -13 -598 -37 -1320 -48 -1484 -50 -1574 -26 -1702 54 -286 187 -495 367 -574 25 -11 417 -118 870 -237 l824 -216 90 4 c98 5 170 29 272 89 79 47 229 198 292 294 135 206 229 473 255 730 6 54 288 8617 302 9160 5 181 3 251 -9 330 -45 288 -168 502 -345 598 -36 19 -296 92 -869 243 -873 230 -916 239 -1028 211z"/>
                                                    </g>
                                                    </svg>
                                            </span>
                                            <div class="media-body">
                                                <p class="fs-20 mb-2">No. of Hospitals</p>
                                                <span class="title text-black font-w600">21</span>
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
                            <div class="col-sm-6">
                                <div class="card avtivity-card">
                                    <div class="card-body">
                                        <div class="media align-items-center">
                                            <span class="activity-icon bgl-info  mr-md-4 mr-3">
                                                <i class="fas fa-bed"></i>
                                            </span>
                                            <div class="media-body">
                                                <p class="fs-20 mb-2">Approved Hospitals</p>
                                                <span class="title text-black font-w600">11</span>
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
                                            <span class="activity-icon bgl-danger  mr-md-4 mr-3">
                                                <i class="fas fa-bed"></i>
                                            </span>
                                            <div class="media-body">
                                                <p class="fs-20 mb-2">Medical Investigations</p>
                                                <span class="title text-black font-w600">11</span>
                                            </div>
                                        </div>
                                        <div class="progress" style="height:5px;">
                                            <div class="progress-bar bg-danger" style="width: 100%; height:5px;" role="progressbar">
                                                <span class="sr-only"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="effect bg-danger"></div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card avtivity-card">
                                    <div class="card-body">
                                        <div class="media align-items-center">
                                            <span class="activity-icon bgl-primary  mr-md-4 mr-3">
                                                <i class="fas fa-bed"></i>
                                            </span>
                                            <div class="media-body">
                                                <p class="fs-20 mb-2">Authorised Passcodes</p>
                                                <span class="title text-black font-w600">41</span>
                                            </div>
                                        </div>
                                        <div class="progress" style="height:5px;">
                                            <div class="progress-bar bg-primary" style="width: 100%; height:5px;" role="progressbar">
                                                <span class="sr-only"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="effect bg-primary"></div>
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