<?php
include('../ajaxconfig.php');
if (isset($_POST['ag_id'])) {
    $ag_id = $_POST['ag_id'];
}
$detailrecords = array();
$i = 0;

if ($ag_id != '') {
    $result = $con->query("SELECT * FROM agent_creation where status=0 and ag_id = $ag_id ");
    while ($row = $result->fetch_assoc()) {
        $loan_category = $row['loan_category'];
    }

    $loan_category_id = explode(',', $loan_category);

    foreach ($loan_category_id as $cat) {
        $qry = $con->query("SELECT * From loan_category_creation where loan_category_creation_id = '" . $cat . "' ");
        $row = $qry->fetch_assoc();
        $detailrecords[$i]['loan_category_id'] = $row['loan_category_creation_id'];
        $detailrecords[$i]['loan_category_name'] = $row['loan_category_creation_name'];
        $i++;
    }
} else if ($ag_id == '') {
    $qry = $con->query("SELECT * From loan_category_creation ");
    while ($row = $qry->fetch_assoc()) {
        $detailrecords[$i]['loan_category_id'] = $row['loan_category_creation_id'];
        $detailrecords[$i]['loan_category_name'] = $row['loan_category_creation_name'];
        $i++;
    }
}
echo json_encode($detailrecords);

$con->close();
$mysqli->close();
$connect = null;