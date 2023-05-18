<?php 
include('../ajaxconfig.php');

if(isset($_POST['cus_id'])){
    $cus_id = $_POST['cus_id'];
}

$records = array();

$result = $connect->query("SELECT * FROM `in_issue` where cus_id='$cus_id' and cus_status >= 14 ");
$records['loan_count'] =  $result->rowCount();
while($res = $result->fetch()){
    if($res['cus_status'] >= 14 && $res['cus_status'] < 20){
        $records['existing_type'] = 'Additional';
    }else{
        $records['existing_type'] = 'Renewal';
    }

}
$result = $connect->query("SELECT created_date FROM `loan_issue` where cus_id='".strip_tags($cus_id)."' and balance_amount = 0 GROUP BY created_date ");
$res = $result->fetch();
$first_loan_date = date('d-m-Y',strtotime($res['created_date']));

$records['first_loan'] =  $first_loan_date;

$now = new DateTime(); // current datetime object
$custom = new DateTime($res['created_date']); // custom datetime object

$diff = $custom->diff($now); // difference between two dates

$years = $diff->y; // number of years in difference
$months = $diff->m; // number of months in difference

$records['travel'] = $months .' Months,'. $years .' Years.';

echo json_encode($records);
?>