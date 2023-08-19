<?php

include('../../ajaxconfig.php');

$cus_id = $_POST['cus_id'];

$sql = $con->query("SELECT cp.*,al.area_name,sl.sub_area_name,bc.branch_name from acknowlegement_customer_profile cp LEFT JOIN area_list_creation al ON cp.area_confirm_area = al.area_id 
        LEFT JOIN sub_area_list_creation sl ON cp.area_confirm_subarea = sl.sub_area_id LEFT JOIN area_group_mapping agm ON FIND_IN_SET(sl.sub_area_id,agm.sub_area_id)
        LEFT JOIN branch_creation bc ON agm.branch_id = bc.branch_id
        WHERE cp.cus_id = ".$cus_id." ORDER BY cp.id DESC LIMIT 1");
$row = $sql->fetch_assoc();

?>
    <div class="col-8" >
        <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                <label for="info_cus_id">Customer ID</label>
                <input type="text" name="info_cus_id" id="info_cus_id" class='form-control' tabindex="1"  readonly value="<?php echo $row['cus_id'];?>">
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                <label for="info_cus_name">Customer Name</label>
                <input type="text" name="info_cus_name" id="info_cus_name" class='form-control' tabindex="2" readonly value="<?php echo $row['cus_name'];?>">
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                <label for="info_cus_mob">Mobile Number</label>
                <input type="number" name="info_cus_mob" id="info_cus_mob" class='form-control' tabindex="3" readonly value="<?php echo $row['mobile1'];?>">
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                <label for="info_area">Area</label>
                <input type="text" name="info_area" id="info_area" class='form-control' tabindex="4" readonly value="<?php echo $row['area_name'];?>">
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                <label for="info_sub_area">Sub Area</label>
                <input type="text" name="info_sub_area" id="info_sub_area" class='form-control' tabindex="5" readonly value="<?php echo $row['sub_area_name'];?>">
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                <label for="info_line">Line</label>
                <input type="text" name="info_line" id="info_line" class='form-control' tabindex="4" readonly value="<?php echo $row['area_line'];?>">
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                <label for="info_branch">Branch</label>
                <input type="text" name="info_branch" id="info_branch" class='form-control' tabindex="5" readonly value="<?php echo $row['branch_name'];?>">
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
            <label for="info_photo">Photo</label>
            <img src='<?php echo 'uploads/request/customer/'.$row['cus_pic']; ?>' class='img-show' name="info_photo" id="info_photo">
        </div>
    </div>

    