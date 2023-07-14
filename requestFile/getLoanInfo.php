<?php 
include('../ajaxconfig.php');
if(isset($_POST['sub_cat_id'])){
    $sub_cat_id = $_POST['sub_cat_id'];
}
if(isset($_POST['cus_id'])){
    $cus_id = preg_replace('/\D/', '',$_POST['cus_id']);
}

$response = array();
$result=$con->query("SELECT lc.collection_info,lcat.loan_limit FROM loan_calculation lc JOIN loan_category lcat ON lcat.sub_category_name = lc.sub_category where lc.status=0 and lc.sub_category = '".strip_tags($sub_cat_id)."' ");
if($result->num_rows>0){
    
    $row = $result->fetch_assoc();
    $response['advance'] = $row['collection_info'];
    // $response['loan_limit'] = $row['loan_limit'];
    $loan_limit = intVal($row['loan_limit']);
    $response['message'] ="";
}else{
    $response['message'] ="No Loan Calculation Made!";
}

// to set loan imit
// take customer loan limit if customer is exist
$qry = $con->query("SELECT loan_limit from customer_register where cus_id = '$cus_id' and (cus_status >= 14 and cus_status <= 20) ");
if($qry->num_rows > 0){
    $row = $qry->fetch_assoc();
    // $response['cus_limit'] = $row['loan_limit'];
    $cus_limit = $row['loan_limit']; 

    // take customer's loan amount that he started to pay
    $qry01 = $con->query("SELECT SUM(alc.tot_amt_cal) as tot_amt_cal from in_issue ii JOIN acknowlegement_loan_calculation alc ON alc.req_id = ii.req_id where ii.cus_id = '$cus_id' and (ii.cus_status >= 14 and ii.cus_status <= 20)  ");
    // echo "SELECT SUM(alc.tot_amt_cal) as tot_amt_cal from in_issue ii JOIN acknowlegement_loan_calculation alc ON alc.req_id = ii.req_id where ii.cus_id = '$cus_id' and (ii.cus_status >= 14 and ii.cus_status <= 20)  ";
    $row01 = $qry01->fetch_assoc();
    $tot_amt_cal = $row01['tot_amt_cal'];

    // take the amount which he paid till now
    $qry02 = $con->query("SELECT SUM(c.due_amt_track) as due_amt_track from in_issue ii JOIN collection c ON c.req_id = ii.req_id where ii.cus_id = '$cus_id' and (ii.cus_status >= 14 and ii.cus_status <= 20)");
    echo "SELECT SUM(c.due_amt_track) as due_amt_track from in_issue ii JOIN collection c ON c.req_id = ii.req_id where ii.cus_id = '$cus_id' and (ii.cus_status >= 14 and ii.cus_status <= 20);";
    $row02 = $qry02->fetch_assoc();
    $due_amt_track = $row02['due_amt_track'];
    // subract amount with customer loan limit to check as of now how much he need to pay and subract it with customer loan limit to get current customer limit
    $cus_limit = (intVal($tot_amt_cal) - intVal($due_amt_track)) - intVal($cus_limit);

}else{
    $cus_limit = 0;
}

//check which limit is lower, then that is the actual limit for the customer
if($cus_limit != 0){

    if($loan_limit < $cus_limit){
        $response['loan_limit'] = $loan_limit;
    }else if($cus_limit < $loan_limit){echo $loan_limit;
        $response['loan_limit'] = $cus_limit;
    }
}else{
    $response['loan_limit'] = $loan_limit;
}

echo json_encode($response);
?>