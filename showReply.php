
<?php
if (isset($_POST["showReply"])) {
    include('includes/db.php');
    $output = '';
    $showReply = $_POST['showReply'];
    $sql = "SELECT * FROM messages WHERE id = '{$showReply}'";
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $output .= '
            <form method="POST" action="reply.php">
                <div class="form-group col-md-12">
                    <label>To:</label>
                    <input value="'.$row["sender"].'" readonly class="form-control" name="sender" >
                </div>
                <div class="form-group col-md-12">
                    <label>Message:</label>
                    <textarea required name="message" class="form-control" cols="50" rows="3"></textarea>
                </div>
                <div class="form-group col-md-12">
                    <input type="submit" name="submit" class="btn btn-primary btn-block" value="Send" >
                </div> 
            </form>
        ';
    }
    echo $output;
}
?>
