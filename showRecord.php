<?php
if (isset($_POST["showPatient"])) {
    include('includes/db.php');
    $output = '';
    $showPatient = $_POST['showPatient'];
    $sql = "SELECT * FROM records WHERE id = '{$showPatient}'";
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $output .= '
        <div class="row">
            <div class="col-md-12 mb-0">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex flex-column align-items-center text-center">
                      <div class="mt-1">
                        <tr>
                          <img class="img-fluid" width="200px" height="200px" src="includes/images/'.$row["file"].'">
                        </tr>
                      </div>
                    </div>
                  </div>
                </div>
                
              </div><br>
        </div><br>
     ';
     
    }
    echo $output;
}
?>
