<form method="POST" enctype="multipart/form-data">
    <div class="form-row">
        <div class="form-group col-md-12">
            <label>Hospital name</label>
            <input type="text" class="form-control" required name="name" placeholder="Hospital name">
        </div>
        <div class="form-group col-md-6">
            <label>Phone number</label>
            <input type="text" name="phone" required class="form-control" placeholder="e.g 08000000">
        </div>
        <div class="form-group col-md-6">
            <label>Email</label>
            <input type="email" readonly value="<?php echo $_SESSION["SESSION_EMAIL1"]?>" name="email" class="form-control">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-4">
            <label>State</label>
            <select id="inputState" required name="state" class="state form-control default-select">
                <option selected>Choose...</option>
                <?php
                    include('includes/db.php');
        $sql = mysqli_query($con, "SELECT * FROM states ORDER BY name");
        while ($ww = mysqli_fetch_array($sql)) {
            ?>
                    <option value="<?php echo $ww["id"]?>" ><?php echo $ww["name"]; ?></option>
                    <?php
        } ?>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label>L.G.A</label>
            <select required id="inputlga" name="lga" class="city form-control default-select">
                <option selected>Choose...</option>
            </select>
        </div>
        <div class="form-group col-md-12">
            <label>Address</label>
            <textarea class="form-control" name="address" cols="50" rows="3"></textarea>
        </div>
        
    </div>
    <div class="card-header mb-0 pb-0">
        <h5 class="">Hospital Information</h5>
    </div>
    <div class="form-group mt-4">
        <label>Certificate of Registration</label>
        <div class="input-group  col-md-7 my-2 mb-5" id="file_item">
            <div class="form-group col-md-12">
                <label>File Name</label>
                <input type="text" required class="form-control" name="filename" placeholder="Certificate name">
            </div><br>
            <div class="form-group col-md-12">
                <label>Upload File</label>
                <div class="custom-file">
                    <input type="file" name="file" class="custom-file-input">
                    <label name="file"  class="custom-file-label"></label>
                </div> 
            </div>                                               
        </div> 
        <div class="form-row">
            
            <div class="form-group col-md-6 d-block">
                <label >No. of Wards</label>
                <input type="text" required name="ward" class="form-control form-control-sm">
            </div>
            <div class="form-group col-md-4 d-block">
                <label >No. of Bed spaces</label>
                <input type="text" required name="bed" class="form-control form-control-sm">
            </div>
        </div>
        <div class="form-row">
            
            <div class="form-group col-md-4 d-block">
                <label >No. of Doctors</label>
                <input type="text" required name="doctor" class="form-control form-control-sm">
            </div>
            <div class="form-group col-md-4 d-block">
                <label >No. of Nurses</label>
                <input type="text" name="nurse" class="form-control form-control-sm">
            </div>
        </div>
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Update</button>
</form>