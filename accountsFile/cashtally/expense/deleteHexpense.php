<?php

include('../../../ajaxconfig.php');

$hexp_id = $_POST['hexp_id'];

$qry = $con->query("SELECT * from ct_db_hexpense where id='$hexp_id' ");
$upd = $qry->fetch_assoc()['upload'];
if($upd != ''){
    unlink('../../../uploads/expenseBill/'.$upd);
}

$qry = $con->query("DELETE  from ct_db_hexpense where id = '$hexp_id' ");
if($qry){
    $response = "Deleted Successfully";
}else{
    $response = "Error While Deleting";
}

echo $response;
?>