<script>
    addNewRow();

    $("#add").click(function(){
        addNewRow();
    })

    function addNewRow(){
        $.ajax({
            url: "new_row.php",
            method:"POST",
            data:{getNewOrderItem:1},
            success:function(data){
                $("#file_item").append(data);
                var n = 0;
                $(".number").each(function(){
                    $(this).html(++n);
                })
            }
        })
    }

    $("#remove").click(function(){
        $("#file_item").children("tr:last").remove();
    })
</script>
<div required class="form-group" style="margin-left:50px;margin-top:-30px;">
    <button class="btn btn-primary btn-sm" id="add">Add File</button>
    <button class="btn btn-sm btn-danger" id="remove">Remove File</button>
</div>