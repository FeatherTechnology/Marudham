<?php 
include('../ajaxconfig.php');

$loan_category_arr = array();

$result=$con->query("SELECT * FROM loan_category_creation where 1 and status=0");
while( $row = $result->fetch_assoc()){
    $loan_category_creation_id = $row['loan_category_creation_id'];
    $loan_category_creation_name = $row['loan_category_creation_name'];
    $loan_category_arr[] = array("loan_category_creation_id" => $loan_category_creation_id, "loan_category_creation_name" => $loan_category_creation_name);
}

echo json_encode($loan_category_arr);
?>