<?php
session_start();
$user_id = $_SESSION['userid'];

include('../../../ajaxconfig.php');

$li_user_id = $_POST['user_id'];
$username = $_POST['username'];
$usertype = $_POST['usertype'];
$amt = str_replace(',','',$_POST['amt']);
$netcash = str_replace(',','',$_POST['netcash']);

$qry = $con->query("INSERT INTO `ct_db_hissued`( `li_user_id`, `user_type`, `user_name`, `netcash`, `amt`, `insert_login_id`,`created_date`) 
VALUES ('$li_user_id','$usertype','$username','$netcash','$amt','$user_id',now())");

if($qry){
    $response = "Submitted Successfully";
}else{
    $response = "Error While Submitting";
}

echo $response;

?>