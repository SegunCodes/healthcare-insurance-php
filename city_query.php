<?php
include('includes/db.php');
if(isset($_POST['state_id'])) {
    
    $state_id = $_POST['state_id'];
    //var_dump($state_id);
    $sql = mysqli_query($con, "SELECT * FROM local_governments WHERE state_id='$state_id' ORDER BY id");
    ?>
    <div class="form-group">
        <!-- <label>L.G.A</label > -->
        <select id="inputlga"  name="lga" class="form-control default-select">
            <option value="" selected="selected">Choose...</option>
            <?php              
                while ($iw = mysqli_fetch_array($sql)) {
                    ?>
                    <option value="<?php echo $iw["id"]?>"><?php echo $iw["name"];?></option>
                <?php
                } 
            ?>
        </select>
    </div>
    <?php
}
?>