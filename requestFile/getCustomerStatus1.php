<?php
include('../ajaxconfig.php');
if (isset($_POST['cus_id'])) {
    $cus_id = $_POST['cus_id'];
}
if (isset($_POST['req_id'])) {
    $req_id = $_POST['req_id'];
}

$records = array();

$result = $con->query("SELECT * FROM request_creation where cus_id = '" . strip_tags($cus_id) . "' and cus_status <= 8 ORDER BY created_date DESC ");

if ($result->num_rows > 0) {
    $i = 0;
    while ($row = $result->fetch_assoc()) {


        $cus_status = $row['cus_status'];

        if ($i > 0) {
            if ($cus_status < 4) {
                $response = 'Additional';
            } elseif ($cus_status < 7 && $cus_status > 3 && $response != 'Additional') {
                $response = 'Renewal'; //For Cancelled and not should be already additional
            } else if ($cus_status == 7) {
                $response = 'Additional'; //For Issued
            } else if ($cus_status == 8 && $response != 'Additional') {
                $response = 'Renewal'; //For Revoked and not should be already additional
            }
        } else {
            $response = 'New';
        }
        $i++;
    }
} else {
    $response = 'New';
}

echo $response;

$con->close();
$mysqli->close();
$connect = null;