<?php 
include('../ajaxconfig.php');
if (isset($_POST['loan_cat'])) {
    $loan_cat = $_POST['loan_cat'];
}

$loan_cat_array = array_map('intval',explode(',',$loan_cat));

$records = array();
$j=0;
foreach($loan_cat_array as $loan_cat){
    // print_r($loan_cat);
    $selectIC = $con->query("SELECT * FROM loan_category WHERE loan_category_name = '".$loan_cat."' and status =0 ");
    if($selectIC->num_rows>0)
    {   $i=0;
        while($row = $selectIC->fetch_assoc()){
            $records[$j][$i]['sub_category_name'] = $row["sub_category_name"];
            $i++;
        }

    }
    $j++;

}
echo json_encode($records);
?>