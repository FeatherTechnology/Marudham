<?php 
include('../ajaxconfig.php');
$map='group';
if (isset($_POST['map'])) {
    $map = $_POST['map'];
}

$selectQry = "SELECT * FROM area_list_creation WHERE status= 0  ";
$res = $con->query($selectQry) or die("Error in Get All Records");
$detailrecords = array();$j=0;
$area_id = array();

if ($res->num_rows>0)
{
    while($row = $res->fetch_object()){
        $area_id      = $row->area_id;
        $detailrecords[$j]['area_id']      = $row->area_id;
        $detailrecords[$j]['area_name']    = $row->area_name;
        // print_r($area_id.'-');
        if($map == 'line'){
            
            $runQry = $con->query("SELECT * From area_line_mapping where FIND_IN_SET($area_id,area_id) ");
            $area_ids = array();
            $sub_area_ids = array();
            if($runQry->num_rows>0){
                while($ress = $runQry->fetch_assoc()){
                    $area_ids[] = $ress['area_id'];
                    $sub_area_ids[] = $ress['sub_area_id'];
                    
                }
                $runQry1 = $con->query("SELECT * FROM sub_area_list_creation where area_id_ref = $area_id and status=0");
                if($runQry1->num_rows<=0){
                    $detailrecords[$j]['disabled'] = true;
                }
                $runQry = $con->query("SELECT * FROM sub_area_list_creation where area_id_ref = $area_id and status=0");
                $sub_area_all = array();
                if($runQry->num_rows>0){
                    while($ress = $runQry->fetch_assoc()){
                        $sub_area_all[] = $ress['sub_area_id'];
                    }
                    // print_r($sub_area_all);
    
                    //For removing values which are repeated inside array
                    $mergedArray = [];
                    foreach ($sub_area_ids as $element) {
                        $mergedArray = array_merge($mergedArray, explode(",", $element));
                    }
                    $uniqueSubArray = array_unique($mergedArray);
    
                    // print_r($uniqueSubArray);
                    //For all values are present in both or not
                    $finalizeSub = array_diff($sub_area_all,$uniqueSubArray);
                    if(empty($finalizeSub)){
                        $detailrecords[$j]['disabled'] = true;
                    }else{
                        $detailrecords[$j]['disabled'] = false;
                    }
                }
            }else{
                $detailrecords[$j]['disabled'] = false;
            }

        }else if($map == 'group'){
            $runQry = $con->query("SELECT * From area_group_mapping where FIND_IN_SET($area_id,area_id) ");
            $area_ids = array();
            $sub_area_ids = array();
            if($runQry->num_rows>0){
                while($ress = $runQry->fetch_assoc()){
                    $area_ids[] = $ress['area_id'];
                    $sub_area_ids[] = $ress['sub_area_id'];
                }
                $runQry1 = $con->query("SELECT * FROM sub_area_list_creation where area_id_ref = $area_id and status=0");
                if($runQry1->num_rows<=0){
                    $detailrecords[$j]['disabled'] = true;
                }
                $runQry = $con->query("SELECT * FROM sub_area_list_creation where area_id_ref = $area_id and status=0");
                $sub_area_all = array();
                if($runQry->num_rows>0){
                    while($ress = $runQry->fetch_assoc()){
                        $sub_area_all[] = $ress['sub_area_id'];
                    }
                    // print_r($sub_area_all);
    
                    //For removing values which are repeated inside array
                    $mergedArray = [];
                    foreach ($sub_area_ids as $element) {
                        $mergedArray = array_merge($mergedArray, explode(",", $element));
                    }
                    $uniqueSubArray = array_unique($mergedArray);
    
                    // print_r($uniqueSubArray);
                    //For all values are present in both or not
                    $finalizeSub = array_diff($sub_area_all,$uniqueSubArray);
                    if(empty($finalizeSub)){
                        $detailrecords[$j]['disabled'] = true;
                    }else{
                        $detailrecords[$j]['disabled'] = false;
                    }
                }
            }else{
                $detailrecords[$j]['disabled'] = false;
            }
        }
        

        // $mergedArray = [];
        // foreach ($area_ids as $element) {
        //     $mergedArray = array_merge($mergedArray, explode(",", $element));
        // }
        // $uniqueArray = array_unique($mergedArray);

        // print_r($uniqueArray);
        
        
        $j++;
    }
    
}

echo json_encode($detailrecords);
?>