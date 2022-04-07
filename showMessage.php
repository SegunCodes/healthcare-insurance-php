<?php
if (isset($_POST["showMessage"])) {
    // show full message status
    include('includes/db.php');
    $output = '';
    $showMessage = $_POST['showMessage'];
    $sql = "SELECT * FROM messages WHERE id = '{$showMessage}'";
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $output .= '
    <div class="">
        <div class="row">
            <div class="col-md-12 mb-0">
                <div class="card">
                    <div class="card-body">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="includes/images/'.$row["file"].'" alt="No File was uploaded" class="rounded-circle" width="150">
                        <div class="mt-1">
                        <h4>Uploaded Image</h4>
                        </div>
                    </div>
                    </div>
                </div>
                
            </div>
            <div class="col-md-12">
            <div class="card">
                <div class="">
                    <div class="row">
                        <div class="col-sm-3">
                        <h6 class="mb-0">Subject</h6>
                        </div>
                        <div class="col-sm-9 text-black">
                        '.$row["subject"].'
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                        <h6 class="mb-0">Message</h6>
                        </div>
                        <div class="col-sm-9 text-black">
                        '.$row["message"].'
                        </div>
                    </div>
                    <hr> 
                    <div class="row">
                        <div class="col-sm-3">
                        <h6 class="mb-0">Status</h6>
                        </div>
                        <div class="col-sm-9 text-black">
                         '.$row["status"].'
                        </div>
                    </div>    
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                        <h6 class="mb-0">Reply</h6>
                        </div>
                        <div class="col-sm-9 text-black">
                         '.$row["reply"].'
                        </div>
                    </div>    
                    <hr>
                </div>
            </div>
        </div>
    </div>';
    }
    echo $output;
}
?>