<?php 
include('../ajaxconfig.php');

if(isset($_POST['ag_id'])){
    $ag_id = $_POST['ag_id'];
}

$staffArr = array();

$result=$con->query("SELECT * FROM agent_creation where status=0 and ag_id = $ag_id ");
while( $row = $result->fetch_assoc()){
    $ag_code = $row['ag_code'];
    $ag_name = $row['ag_name'];
    $mail = $row['mail'];
    
    $loan_category_id = $row['loan_category'];
    $qry = "SELECT * From loan_category_creation where loan_category_creation_id = $loan_category_id and status = 0";
    $res = $con->query($qry);
    $row1 = $res->fetch_assoc();
    $loan_category = $row1['loan_category_creation_name'];

    $sub_category = $row['sub_category'];

    $scheme = explode(',',$row['scheme']);
    foreach($scheme as $sh){

        $qry = "SELECT * From loan_scheme where scheme_id = $sh and status = 0";
        $res = $con->query($qry);
        while($row1 = $res->fetch_assoc()){
            $scheme_name1[] = $row1['scheme_name'];
        }
    }
    $scheme_name = implode(',',$scheme_name1);

    if($row['loan_payment'] == 0) { $loan_pay = "Yes";}else{$loan_pay = "No";}
    $loan_payment =  $loan_pay;

    if($row['responsible'] == 0) { $respons = "Yes";}else{$respons = "No";}
    $responsible = $respons;

    if($row['collection_point'] == 0) { $coll = "Yes";}else{$coll = "No";}
    $collection_point = $coll;
    
    $company_id = $row['company_id'];
    $qry = "SELECT * From company_creation where company_id = $company_id and status = 0";
    $res = $con->query($qry);
    $row1 = $res->fetch_assoc();
    $company_name = $row1['company_name'];
    

    $staffArr[] = array("ag_code" => $ag_code, "ag_name" => $ag_name,"mail" => $mail,'loan_category'=>$loan_category,'sub_category'=>$sub_category,'scheme'=>$scheme_name,
    'loan_payment'=>$loan_payment,'responsible'=>$responsible,'collection_point'=>$collection_point,'company_id'=>$company_id,'company_name'=>$company_name);
}

echo json_encode($staffArr);
?>