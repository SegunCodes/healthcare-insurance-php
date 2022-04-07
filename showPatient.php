<?php
if (isset($_POST["showPatient"])) {
    // show full patient info
    include('includes/db.php');
    $output = '';
    $showPatient = $_POST['showPatient'];
    $sql = "SELECT * FROM patient WHERE id = '{$showPatient}'";
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
      if ($row['status'] == "Approved") {
        echo '<a href="allocate-patient.php?allocate='.$row['patient_id'].'" class="btn btn-block btn-xs btn-primary">Allocate Patient</a>';
      }
      else{
        echo "";
      }
        $output .= '
        <div class="">
        <div class="row">
            <div class="col-md-12 mb-0">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex flex-column align-items-center text-center">
                     <div class="mt-1">
                        <h4>'.$row['fname'].' '.$row['lname'].'</h4>
                      </div>
                    </div>
                  </div>
                </div>
                
              </div><br>
            <div class="col-md-12">
                <div class=""><br>
                    <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0">Full Name</h6>
                      </div>
                      <div class="col-sm-9 text-black">
                      '.$row['fname'].' '.$row['lname'].'
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0">Email</h6>
                      </div>
                      <div class="col-sm-9 text-black">
                      '.$row['email'].'
                      </div>
                    </div>
                   
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0">Mobile</h6>
                      </div>
                      <div class="col-sm-9 text-black">
                      '.$row['phone'].'
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0">Address</h6>
                      </div>
                      <div class="col-sm-9 text-black">
                      '.$row['address'].'
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="row col-6">
                            <div class="col-sm-6">
                              <h6 class="mb-0">Patient ID</h6>
                            </div>
                            <div class="col-sm-6 text-black">
                            '.$row['patient_id'].'
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
                              <h6 class="mb-0">Lga</h6>
                            </div>
                            <div class="col-sm-6 text-black">
                            '.$row['lga'].'
                            </div>
                          </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="row col-6">
                            <div class="col-sm-6">
                              <h6 class="mb-0">Pregnant</h6>
                            </div>
                            <div class="col-sm-6 text-black">
                            '.$row['pregnancy'].'
                            </div>
                          </div>
                          <div class="row col-6">
                            <div class="col-sm-6">
                              <h6 class="mb-0">Sickle cell</h6>
                            </div>
                            <div class="col-sm-6 text-black">
                            '.$row['sickle_cell'].'
                            </div>
                          </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="row col-6">
                            <div class="col-sm-6">
                              <h6 class="mb-0">Blood Group</h6>
                            </div>
                            <div class="col-sm-6 text-black">
                            '.$row['blood_group'].'
                            </div>
                        </div>
                        <div class="row col-6">
                            <div class="col-sm-6">
                              <h6 class="mb-0">Genotype</h6>
                            </div>
                            <div class="col-sm-6 text-black">
                            '.$row['genotype'].'
                            </div>
                        </div>
                     </div>
              </div>
          </div>
     </div><br>
     ';
     
    }
    echo $output;
}
?>
