<?php
include('../../ajaxconfig.php');

// if (isset($_GET['userid'])) {
//     $user_id = $_GET['userid'];
// }

// if ($user_id != 1) {

//     $userQry = $con->query("SELECT * FROM USER WHERE user_id = $user_id ");
//     while ($rowuser = $userQry->fetch_assoc()) {
//         $group_id = $rowuser['group_id'];
//         $line_id = $rowuser['line_id'];
//     }

//     $line_id = explode(',', $line_id);
//     $sub_area_list = array();
//     foreach ($line_id as $line) {
//         $lineQry = $con->query("SELECT * FROM area_line_mapping where map_id = $line ");
//         $row_sub = $lineQry->fetch_assoc();
//         $sub_area_list[] = $row_sub['sub_area_id'];
//     }
//     $sub_area_ids = array();
//     foreach ($sub_area_list as $subarray) {
//         $sub_area_ids = array_merge($sub_area_ids, explode(',', $subarray));
//     }
//     $sub_area_list = array();
//     $sub_area_list = implode(',', $sub_area_ids);
// }

$data = [];
$filter = '';
if (isset($_GET['cus_id']) && isset($_GET['req_id'])  && isset($_GET['payable'])) {
    $cus_id = $_GET['cus_id'];
    $req_id = $_GET['req_id'];
    $payable = $_GET['payable'];
    $follow_cus_sts = isset($_GET['follow_cus_sts']) ? $_GET['follow_cus_sts'] : '';
    $filter = " and cp.req_id IN ($req_id)";
}

if ($payable > 0) {

    $query = "SELECT cp.cus_id as cp_cus_id,cp.cus_name,cp.area_confirm_area,cp.area_confirm_subarea,cp.area_line,cp.mobile1, ii.cus_id as ii_cus_id, ii.req_id FROM 
    acknowlegement_customer_profile cp JOIN in_issue ii ON cp.cus_id = ii.cus_id
    where ii.status = 0 and (ii.cus_status >= 14 and ii.cus_status <= 17) $filter  GROUP BY ii.cus_id "; // 14 and 17 means collection entries, 17 removed from issue list
    //this will only take selected req_ids which is payable > 0
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();

    $sno = 1;
    foreach ($result as $row) {
        $cus_id = $row['cp_cus_id'];
        $cus_name = $row['cus_name'];
        $area_name = '';
        $sub_area_name = '';
        $branch_name = '';
        $comm_date = '';
        $hint = '';
        $comm_err = '';

        // Fetch area name
        $area_id = $row['area_confirm_area'];
        $qry = $mysqli->query("SELECT * FROM area_list_creation WHERE area_id = $area_id");
        if ($qry->num_rows > 0) {
            $row1 = $qry->fetch_assoc();
            $area_name = $row1['area_name'];
        }

        // Fetch sub-area name
        $sub_area_id = $row['area_confirm_subarea'];
        $qry = $mysqli->query("SELECT * FROM sub_area_list_creation WHERE sub_area_id = $sub_area_id");
        if ($qry->num_rows > 0) {
            $row1 = $qry->fetch_assoc();
            $sub_area_name = $row1['sub_area_name'];
        }

        // Fetch branch name
        $line_name = $row['area_line'];
        $qry = $mysqli->query("SELECT b.branch_name FROM branch_creation b JOIN area_line_mapping l ON l.branch_id = b.branch_id WHERE l.line_name = '$line_name'");
        if ($qry->num_rows > 0) {
            $row1 = $qry->fetch_assoc();
            $branch_name = $row1['branch_name'];
        }

        // Fetch collection date range
        $collDate = $mysqli->query("SELECT CASE WHEN DAYOFMONTH(coll_date) BETWEEN 26 AND 31 THEN '26-30'WHEN DAYOFMONTH(coll_date) BETWEEN 21 AND 25 THEN '21-25'WHEN DAYOFMONTH(coll_date) BETWEEN 16 AND 20 THEN '16-20'WHEN DAYOFMONTH(coll_date) BETWEEN 11 AND 15 THEN '11-15'ELSE ''END AS date_range FROM collection WHERE cus_id='$cus_id' ORDER BY coll_id DESC LIMIT 1");
        $coll_date_qry = $collDate->fetch_assoc();
        $date_range = isset($coll_date_qry['date_range']) ? $coll_date_qry['date_range'] : '';

        // Fetch commitment details
        $sql = $con->query("SELECT comm_date, hint, comm_err FROM commitment WHERE cus_id='$cus_id' ORDER BY id DESC LIMIT 1");
        if ($sql->num_rows > 0) {
            $row1 = $sql->fetch_assoc();
            $hint = $row1['hint'];
            $comm_err = ($row1['comm_err'] == '1') ? 'Yes' : (($row1['comm_err'] == '2') ? 'No' : 'Clear');
            $comm_date = ($row1['comm_date'] != '0000-00-00') ? date('d-m-Y', strtotime($row1['comm_date'])) : '';
        }

        $data = [
            'sno' => $sno,
            'cus_id' => $cus_id,
            'cus_name' => $cus_name,
            'area_name' => $area_name,
            'sub_area_name' => $sub_area_name,
            'branch_name' => $branch_name,
            'line' => $row['area_line'],
            'mobile' => $row['mobile1'],
            'sub_status' => isset($follow_cus_sts) ? $follow_cus_sts : '',
            'action' => "<a href='due_followup&upd={$row['req_id']}&cusidupd=$cus_id' title='Edit details'><button class='btn btn-success' style='background-color:#009688;'>View Loans</button></a>",
            'last_paid_date' => $date_range,
            'hint' => $hint,
            'comm_err' => $comm_err,
            'comm_dat' => $comm_date
        ];
        $sno++;
    }
}
echo json_encode($data);
