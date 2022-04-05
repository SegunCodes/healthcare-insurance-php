<form method="POST">
    <div class="form-row">
        <div class="form-group col-md-6">
            <label>First name</label>
            <input type="text" required class="form-control" name="fname"  placeholder="First name" >
        </div>
        <div class="form-group col-md-6">
            <label>Last name</label>
            <input type="text" required class="form-control" name="lname" placeholder="Last name">
        </div>
        <div class="form-group col-md-6">
            <label>Phone number</label>
            <input type="text" required class="form-control"  name="phone" placeholder="e.g 08000000">
        </div>
        <div class="form-group col-md-6">
            <label>Email</label>
            <input type="email" required readonly name="email" value="<?php echo $_SESSION["SESSION_EMAIL"]?>" class="form-control">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-7">
            <label>State</label>
            <select id="inputState" required name="state" class="state form-control default-select">
                <option selected="selected">Choose...</option>
                <?php
                    include('includes/db.php');
                    $sql = mysqli_query($con, "SELECT * FROM states ORDER BY name");
                    while ($ww = mysqli_fetch_array($sql)) {
                        ?>
                    <option value="<?php echo $ww["id"]?>" ><?php echo $ww["name"]; ?></option>
                    <?php
                        }
                    ?>
            </select>
        </div>
        <div class="form-group col-md-5">
            <label>L.G.A</label>
            <select id="inputlga" name="lga" class="city form-control default-select">
                <option selected>Choose...</option>
            </select>
        </div>
        <div class="form-group col-md-12">
            <label for="">Occupation</label>
            <input type="text" required  name="occupation" class="form-control">
        </div>
        <div class="form-group col-md-12">
            <label>Address</label>
            <textarea class="form-control" required name="address" id="" cols="50" rows="3"></textarea>
        </div>
    </div>
    <div class="card-header mb-0 pb-0">
        <h5 class="">Health Information</h5>
    </div>
    <div class="form-group mt-4">
        
        <div class="form-row">
            <div class="form-group col-md-6 d-block">
                <label >Date of birth</label>
                <input name="dob" required type="date" placeholder="04/22/1999....." class="datepicker form-control form-control-sm" id="datepicker">
            </div>
            <div class="form-group col-md-6 d-block">
                <label >Gender</label>
                <select name="gender" required id="gender"  class="form-control form-control-sm default-select">
                    <option  selected value="null">Choose...</option>
                    <option  value="male">male</option>
                    <option value="Female">female</option>
                </select>
            </div>
            <div class="form-group col-md-6 d-block">
                <label >Disability</label>
                <select name="disability" required id="Disability" class="form-control form-control-sm default-select">
                    <option selected value="null">Choose...</option>
                    <option value="yes">yes</option>
                    <option value="no">no</option>
                </select>
            </div>
            <div class="form-group col-md-6 d-block">
                <label >type</label>
                <select name="type" required id="type" class="form-control form-control-sm default-select">
                    <option selected value="null">Choose...</option>
                    <option value="blind">blind</option>
                    <option value="dumb">dumb</option>
                    <option value="deaf">deaf</option>
                    <option value="other">other</option>
                    <option none="none">none</option>
                </select>
            </div>

        </div>
        <div class="form-row">
            <div class="form-group col-md-6 d-block">
                <label >Sickle cell</label>
                <select id="sicklecell" required name="sicklecell" class="form-control form-control-sm default-select">
                    <option selected value="null">Choose...</option>
                    <option value="yes">yes</option>
                    <option value="no">no</option>
                </select>
            </div>
            <div class="form-group col-md-6 d-block">
                <label >Pregnancy</label>
                <select id="Pregnancy" required name="pregnancy" class="form-control form-control-sm default-select">
                    <option selected value="null">Choose...</option>
                    <option value="yes">yes</option>
                    <option value="no">no</option>
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6 d-block">
                <label >Blood group</label>
                <select id="bloodgroup" required name="bloodgroup" class="form-control form-control-sm default-select">
                    <option selected value="null">Choose...</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="AB">AB</option>
                    <option value="O+">0+</option>
                    <option value="O-">0-</option>
                </select>
            </div>
            <div class="form-group col-md-6 d-block">
                <label >Genotype</label>
                <select id="genotype" required name="genotype" class="form-control form-control-sm default-select">
                    <option selected value="null">Choose...</option>
                    <option value="AA">AA</option>
                    <option value="AS">AS</option>
                    <option value="SS">SS</option>
                    <option value="AC">AC</option>
                </select>
            </div>
        </div>
    </div>
                                            
    <button type="submit" name="submit" class="btn btn-primary">Update</button>                                       
</form>