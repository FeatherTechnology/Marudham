<?php
require '../../ajaxconfig.php';

$id = $_POST['id'];

$signedDoc = array();

$signedDocInfo = $connect->query("SELECT * FROM `signed_doc_info` WHERE id='$id' ");
$sign_details = $signedDocInfo->fetch();

$signedDoc['id'] = $sign_details['id'];
$signedDoc['doc_name'] = $sign_details['doc_name'];
$signedDoc['sign_type'] = $sign_details['sign_type'];
$signedDoc['signType_relationship'] = $sign_details['signType_relationship'];
$signedDoc['doc_Count'] = $sign_details['doc_Count'];

$qry = $con->query("SELECT famname from verification_family_info where id = '" . $sign_details['signType_relationship'] . "' ");
if ($qry->num_rows > 0) {
    $signedDoc['guar_name'] = $qry->fetch_assoc()['famname'];
} else {
    $signedDoc['guar_name'] = '';
}


echo json_encode($signedDoc);

$con->close();
$mysqli->close();
$connect = null;