<?php
require '../ajaxconfig.php';

$id = $_POST['id'];

$feedback = array();

$feedbackDetail = $connect -> query("SELECT * FROM `verification_cus_feedback` WHERE id='$id' ");
$cus_feedback = $feedbackDetail->fetch();

$feedback['id'] = $cus_feedback['id'];
$feedback['feedback_label'] = $cus_feedback['feedback_label'];
$feedback['cus_feedback'] = $cus_feedback['cus_feedback'];

echo json_encode($feedback);
?>