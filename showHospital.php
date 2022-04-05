<?php
if (isset($_POST["showHospital"])) {
    include('includes/db.php');
    $output = '';
    $showHospital = $_POST['showHospital'];
    $sql = "SELECT * FROM hospital WHERE id = '{$showHospital}'";
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $output .= '
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 mb-1">
                    <div class="text-center">
                        <h3>'.$row["name"].'</h3>
                    </div>
                </div><br>
                <div class="col-md-12">
                    <div class=""><br>
                        <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Email</h6>
                        </div>
                        <div class="col-sm-9 text-black">
                        '.$row["email"].'
                        </div>
                        </div>
                        <hr>
                        <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Mobile</h6>
                        </div>
                        <div class="col-sm-9 text-black">
                        '.$row["phone"].'
                        </div>
                        </div>
                        <hr>
                        <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Certificate</h6>
                        </div>
                        <div class="col-sm-9 text-black">
                        '.$row["certificate"].'
                        </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="row col-6">
                                <div class="col-sm-6">
                                <h6 class="mb-0">Hospital ID</h6>
                                </div>
                                <div class="col-sm-6 text-black">
                                '.$row['hospital_id'].'
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="row col-6">
                                <div class="col-sm-6">
                                <h6 class="mb-0">State</h6>
                                </div>
                                <div class="col-sm-6 text-black">
                                '.$row['state'].'
                                </div>
                            </div>
                            <div class="row col-6">
                                <div class="col-sm-6">
                                <h6 class="mb-0">LGA</h6>
                                </div>
                                <div class="col-sm-6 text-black">
                                '.$row['lga'].'
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                        <div class="row col-6">
                            <div class="col-sm-8">
                                <h6 class="mb-0">Doctors</h6>
                            </div>
                            <div class="col-sm-4 text-black">
                            '.$row["doctor"].'
                            </div>
                            </div>
                            <div class="row col-6">
                            <div class="col-sm-8">
                                <h6 class="mb-0">Nurses</h6>
                            </div>
                            <div class="col-sm-4 text-black">
                            '.$row["nurse"].'
                            </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                        <div class="row col-6">
                            <div class="col-sm-8">
                                <h6 class="mb-0">Bed Spaces</h6>
                            </div>
                            <div class="col-sm-4 text-black">
                            '.$row["bed"].'
                            </div>
                            </div>
                            <div class="row col-6">
                            <div class="col-sm-8">
                                <h6 class="mb-0">Wards</h6>
                            </div>
                            <div class="col-sm-4 text-black">
                            '.$row["ward"].'
                            </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Patients Assigned</h6>
                        </div>
                        <div class="col-sm-9 text-black">
                            128
                        </div>
                    </div>
                </div>
            </div>
        </div>
    ';
    }
    echo $output;
}
?>
