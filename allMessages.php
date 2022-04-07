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
                                <h4 class="card-title text-primary">All Messages</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example3" class="display min-w850">
                                        <thead>
                                            <tr>
                                                <th>Sender</th>
                                                <th>Subject</th>
                                                <th>Message</th>
                                                <th>Reply</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        include('includes/db.php');
                                        $sql = mysqli_query($con,"SELECT * FROM messages"); // select all from messages table
                                        while ($row=mysqli_fetch_array($sql)) {
                                            //selecting each row in messages table
                                            $id = $row['id'];
                                            $sender = $row['sender'];
                                            $subject = $row['subject'];
                                            $message = $row['message'];
                                            $reply = $row['reply'];
                                            $status = $row['status']; 
                                        ?>
                                        
                                            <tr>
                                                <td><?php echo $sender; ?></td>
                                                <td><?php echo $subject; ?></td>
                                                <td><?php echo $message; ?></td>
                                                <td><?php echo $reply; ?></td>
                                                <td class="<?php if ($status == 'Replied') {
                                                    echo 'text-success';
                                                }else{ echo 'text-warning';} ?>"><?php echo $status; ?></td>
                                                <td>
                                                  <div class="d-flex">
                                                    <a href="#" class="btn btn-primary showMessage shadow btn-xs sharp mr-1" id="<?php echo $id?>" ><i class="fa fa-eye"></i></a>
                                                    <a onclick="return confirm('Are you sure you want to delete this message?')" href="delete-message.php?del=<?php echo $id;?>" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                                                    <a href="#" id="<?php echo $id?>" class="btn btn-warning showReply shadow btn-xs sharp"><i class="fa fa-reply"></i></a>
                                                </div>
                                                </td>
                                            </tr>
                                        
                                        <?php
                                        } ?>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="modal fade" id="modalReply">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Leave a reply</h5>
                                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body" id="modal-reply">
                                                <!-- <form>
                                                    <div>
                                                        <input></input>
                                                    <div>
                                                </form> -->
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary"  data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="modalGrid">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Messages</h5>
                                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body" id="message_detail">
                                                
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
            //ajax request to handle user request and view full message info
            $('.showMessage').click(function(){
                var showMessage = $(this).attr("id");

                $.ajax({
                    url: 'showMessage.php',
                    method: 'post',
                    data: {showMessage:showMessage},
                    success:function(data){
                        $('#message_detail').html(data);
                        $('#modalGrid').modal('show');
                    }
                })
               
            })
            //ajax request to handle user reply by displaying reply modal
            $('.showReply').click(function(){
                var showReply = $(this).attr("id");

                $.ajax({
                    url: 'showReply.php',
                    method: 'post',
                    data: {showReply:showReply},
                    success:function(data){
                        $('#modal-reply').html(data);
                        $('#modalReply').modal('show');
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