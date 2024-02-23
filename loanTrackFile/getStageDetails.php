<?php
// session_start();
include '../ajaxconfig.php';
// include './getTrackDetails.php';

$req_id = $_POST['req_id'] ?? '';
$stage = $_POST['stage'] ?? '';
$detail_arr = array();

if ($stage == 'lc') { //Loan Calculation, So show verification info

    $qry = $con->query("SELECT cus_id_loan as cus_id,communication,com_audio,verification_person,verification_location from verification_loan_calculation where req_id = '" . strip_tags($req_id) . "' ");
    if ($qry->num_rows > 0) {
        $row = $qry->fetch_assoc();

        $detail_arr['communication'] = $row['communication'] == '0' ? 'Phone' : 'Direct';
        $detail_arr['com_audio'] = "<a href='uploads/verification/verifyInfo_audio/" . $row['com_audio'] . "' target='_blank'>Audio File</a>";

        if ($row['verification_person'] == $row['cus_id']) {
            $cusname_qry = $con->query("SELECT customer_name from customer_register where cus_id = '" . strip_tags($row['cus_id']) . "' ");
            $verification_person = $row['customer_name'];
        } else {
            $famname_qry = $con->query("SELECT famname from verification_family_info where id = '" . strip_tags($row['verification_person']) . "' ");
            $famname_row = $famname_qry->fetch_assoc();
            $verification_person = $famname_row['famname'];
        }

        $detail_arr['verification_location'] = $row['verification_location'] == '0' ? 'On Spot' : 'Customer Spot';
        $heading_arr = ['Communication', 'Audio', 'Verification Person', 'Verification Location'];
    }
} elseif ($stage == 'li') { //Loan Issue, So show Cash Acknowledgement info

    $qry = $con->query("SELECT cus_id,issued_to,cash_guarentor_name,cash_guarentor_name,agent_id from loan_issue where req_id = '" . strip_tags($req_id) . "' ");
    if ($qry->num_rows > 0) {

        $row = $qry->fetch_assoc();

        if (empty($row['agent_id']) && $row['cus_id'] != $row['cash_guarentor_name']) {
            //if agent id is empty and cash gurarantor is not the customer, then we need to search in family table

            $fam_qry = $con->query("SELECT famname,relationship from verification_family_info where relation_aadhar = '" . strip_tags($row['cash_guarentor_name']) . "' ");
            $fam_row = $fam_qry->fetch_assoc();
            $detail_arr['issued_to'] = $fam_row['famname'];
            $detail_arr['relationship'] = $fam_row['relationship'];
        } elseif (!empty($row['agent_id'])) { //if issued to an agent, take agent name

            $ag_qry = $con->query("SELECT ag_name from agent_creation where ag_id = '" . strip_tags($row['agent_id']) . "' ");
            $ag_row = $ag_qry->fetch_assoc();
            $detail_arr['issued_to'] = $ag_row['ag_name'];
            $detail_arr['relationship'] = 'Agent';
        } else if ($row['cus_id'] == $row['cash_guarentor_name']) { //if issued and customer are same then direclty take values from issue table

            $detail_arr['issued_to'] = $row['issued_to'];
            $detail_arr['relationship'] = 'Customer';
        }

        $heading_arr = ['Issued To', 'Relationship'];
    }
} elseif ($stage == 'noc') { // NOC, So show NOC info
    // $obj = new getTrackTableDetails;
    // $nocDetails = $obj->getLatestNOCDetails($con, $req_id);
    $detail_arr['headings'] = ['Date of NOC', 'Member', 'Relationship'];
}
?>

<table class="table table-bordered">
    <thead>
        <th width="10%">S.No</th>
        <?php
        foreach ($heading_arr as $heading) {
            echo '<th>' . $heading . '</th>';
        }
        ?>
    </thead>
    <tbody>
        <tr>
            <td><?php echo 1; ?></td>
            <?php
            foreach ($detail_arr as $item) {
            ?>
                <td><?php echo $item; ?></td>
            <?php
            }
            ?>
        </tr>
    </tbody>
</table>