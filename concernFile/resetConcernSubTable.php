<?php
include '../ajaxconfig.php';
?>

<table class="table custom-table" id="concernsubjectTable"> 
    <thead>
        <tr>
            <th width="25">S. NO</th>
            <th>LOAN CATEGORY</th>
            <th>ACTION</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $ctselect="SELECT * FROM concern_subject WHERE 1 AND status=0 ORDER BY concern_sub_id DESC";
        $ctresult=$con->query($ctselect);
        if($ctresult->num_rows>0){
        $i=1;
        while($ct=$ctresult->fetch_assoc()){
        ?>
        <tr>
        <td><?php echo $i; ?></td>
        <td><?php if(isset($ct["concern_subject"])){ echo $ct["concern_subject"]; }?></td>
        <td>
            <a id="edit_subject" value="<?php if(isset($ct["concern_sub_id"])){ echo $ct["concern_sub_id"];}?>"><span class="icon-border_color"></span></a> &nbsp;
                <a id="delete_subject" value="<?php if(isset($ct["concern_sub_id"])){ echo $ct["concern_sub_id"]; }?>"><span class='icon-trash-2'></span>
            </a>
            </td>
        </tr>
        <?php $i = $i+1; }} ?>
    </tbody>
</table>

<script type="text/javascript">
$(function(){
    $('#concernsubjectTable').DataTable({
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