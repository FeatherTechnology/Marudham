<?php
include '../../../ajaxconfig.php';
?>

<table class="table custom-table" id="nameDetailTable"> 
    <thead>
        <tr>
            <th width="50">S.No</th>
            <th>Name</th>
            <th>Area</th>
            <th>Identification</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $ctselect="SELECT * FROM name_detail_creation WHERE 1 AND status=0 ORDER BY name_id DESC";
        $ctresult=$con->query($ctselect);
        if($ctresult->num_rows>0){
        $i=1;
        while($ct=$ctresult->fetch_assoc()){
        ?>
        <tr>
        <td></td>
        <td><?php if(isset($ct["name"])){ echo $ct["name"]; }?></td>
        <td><?php if(isset($ct["area"])){ echo $ct["area"]; }?></td>
        <td><?php if(isset($ct["ident"])){ echo $ct["ident"]; }?></td>
        <td>
            <a id="edit_name" value="<?php if(isset($ct["name_id"])){ echo $ct["name_id"];}?>"><span class="icon-border_color"></span></a> &nbsp;
            <a id="delete_name" value="<?php if(isset($ct["name_id"])){ echo $ct["name_id"]; }?>"><span class='icon-trash-2'></span></a>
        </td>
        </tr>
        <?php }} ?>
    </tbody>
</table>

<script type="text/javascript">
$(function(){
    $('#nameDetailTable').DataTable({
    'processing': true,
        'iDisplayLength': 5,
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        "createdRow": function(row, data, dataIndex) {
            $(row).find('td:first').html(dataIndex + 1);
        },
        "drawCallback": function(settings) {
            this.api().column(0).nodes().each(function(cell, i) {
                cell.innerHTML = i + 1;
            });
        },
    });
});
</script>