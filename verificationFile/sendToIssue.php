<?php 
session_start();
if (isset($_SESSION['userid'])) {
    $userid = $_SESSION['userid'];
}

include('../ajaxconfig.php');

if (isset($_POST['req_id'])) {
    $req_id = $_POST['req_id'];
}
if (isset($_POST['cus_id'])) {
    $cus_id = preg_replace('/\D/', '',$_POST['cus_id']);
}

//Move to Issue = 13.

    $qry = $con->query("UPDATE request_creation set cus_status = 13, update_login_id = $userid WHERE  req_id = '".$req_id."' ") or die('Error on Request Table');
    $qry = $con->query("UPDATE customer_register set cus_status = 13 WHERE req_ref_id = '".$req_id."' ")or die('Error on Customer Table');
    $qry = $con->query("UPDATE in_verification set cus_status = 13, update_login_id = $userid WHERE req_id = '".$req_id."' ")or die('Error on inVerification Table');
    $qry = $con->query("UPDATE `in_approval` SET `cus_status`= 13 WHERE  req_id = '".$req_id."' ") or die('Error on in_approval Table');
    $qry = $con->query("UPDATE `in_acknowledgement` SET `cus_status`= 13 WHERE  req_id = '".$req_id."' ") or die('Error on in_acknowledgement Table');
    $qry = $con->query("INSERT INTO `in_issue`(`req_id`, `cus_id`, `cus_status`, `status`, `insert_login_id`, `created_date`)  
    SELECT req_id,cus_id,cus_status,status,update_login_id,now() from in_verification where req_id = '".$req_id."' ");

    $qry = $con->query("INSERT INTO `document_track`(`req_id`, `cus_id`, `track_status`, `insert_login_id`, `created_date`) 
        VALUES('".strip_tags($req_id)."','".strip_tags($cus_id)."','1','$userid', now()) ");

if($qry){
    $response = 'Moved to Issue';
}else{
    $response = 'Error While Moving';
}
    echo json_encode($response);
?>