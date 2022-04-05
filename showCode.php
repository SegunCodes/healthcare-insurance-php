<?php
if (isset($_POST["showCode"])) {
    include('includes/db.php');
    $output = '';
    $showCode = $_POST['showCode'];
    $sql = "SELECT * FROM authorization WHERE patient_id = '{$showCode}' AND status = '1'";
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $output .= '
            <form method="POST" action="code.php">
                <div class="form-group col-md-12">
                    <input hidden value="'.$row["hospital_id"].'" readonly class="form-control" name="hid" >
                </div>
                <div class="form-group col-md-12">
                    <input hidden value="'.$row["patient_id"].'" readonly class="form-control" name="pid" >
                </div>
                <div class="form-group col-md-12">
                    <input hidden value="'.$row["auth_code"].'" readonly class="form-control" name="auth" >
                </div>
                <div class="form-group col-md-12">
                    <label>Authorization Code</label>
                    <input required class="form-control" name="code" >
                </div>
                <div class="form-group col-md-12">
                    <input type="submit" name="submit" class="btn btn-primary btn-block" value="Enter" >
                </div> 
            </form>
        ';
    }
    echo $output;
}
?>
