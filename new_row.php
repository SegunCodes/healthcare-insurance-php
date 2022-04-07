<?php

if (isset($_POST["getNewItem"])) {
	?>
	<tr>
        <td>
            <b class="number"></b>
        </td>
        <td>
            <!-- <div class="form-row"> -->
                <div class="form-group col-md-12">
                    <label class="mb-1"><strong>Document Name</strong></label>
                    <input type="name" name="name[]" required class="form-control">
                </div>
                <div class="form-group col-md-12">
                    <label class="mb-1"><strong>Upload Document</strong></label>
                    <input type="file" required name="image[]" class="form-control">
                </div>
            <!-- </div> -->
        </td>  <br>      
	</tr>
	<?php
	exit(); 
}
	

?>