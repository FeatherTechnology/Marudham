<?php
@session_start();
include('..\ajaxconfig.php');

if (isset($_SESSION["userid"])) {
    $userid = $_SESSION["userid"];
    $sql = $con->query("SELECT ag_id FROM user where user_id = '$userid'");
    $login_user_type = $sql->fetch_assoc()['ag_id'];
    if ($login_user_type == null or $login_user_type == '') {
        $login_user_type = 0;
    }
}
if ($userid != 1) {

    $userQry = $con->query("SELECT * FROM USER WHERE user_id = $userid ");
    while ($rowuser = $userQry->fetch_assoc()) {
        $group_id = $rowuser['group_id'];
    }
    $group_id = explode(',', $group_id);
    $sub_area_list = array();
    foreach ($group_id as $group) {
        $groupQry = $con->query("SELECT * FROM area_group_mapping where map_id = $group ");
        $row_sub = $groupQry->fetch_assoc();
        $sub_area_list[] = $row_sub['sub_area_id'];
    }
    $sub_area_ids = array();
    foreach ($sub_area_list as $subarray) {
        $sub_area_ids = array_merge($sub_area_ids, explode(',', $subarray));
    }
    $sub_area_list = array();
    $sub_area_list = implode(',', $sub_area_ids);
}

$column = array(
    'v.req_id',
    'v.dor',
    'v.cus_id',
    'v.cus_name',
    'bc.branch_name',
    'ag.group_name',
    'alm.line_name',
    'a.area_name',
    'sa.sub_area_name',
    'lcc.loan_category_creation_name',
    'v.sub_category',
    'v.loan_amt',
    'v.user_type',
    'v.user_name',
    'v.agent_id',
    'v.responsible',
    'v.cus_data',
    'v.cus_status',
    'v.status'
);

if ($userid == 1) {
    $query = 'SELECT v.*,a.area_name, sa.sub_area_name, ag.group_name, bc.branch_name, alm.line_name,lcc.loan_category_creation_name
    FROM in_verification v
    JOIN area_list_creation a ON v.area = a.area_id
    JOIN sub_area_list_creation sa ON v.sub_area = sa.sub_area_id
    JOIN area_group_mapping ag ON FIND_IN_SET(sa.sub_area_id, ag.sub_area_id)
    JOIN branch_creation bc ON ag.branch_id = bc.branch_id
    JOIN area_line_mapping alm ON FIND_IN_SET(sa.sub_area_id, alm.sub_area_id)
    JOIN loan_category_creation lcc ON lcc.loan_category_creation_id = v.loan_category
    WHERE v.status = 0 and v.cus_status IN(2,3,13)'; //2-in approval, 3-in ack,6-cancel approval, 7-cancel_ack,13-in issue.
} else {
    $query = "SELECT v.*,a.area_name, sa.sub_area_name, ag.group_name, bc.branch_name, alm.line_name,lcc.loan_category_creation_name
    FROM in_verification v
    JOIN area_list_creation a ON v.area = a.area_id
    JOIN sub_area_list_creation sa ON v.sub_area = sa.sub_area_id
    JOIN area_group_mapping ag ON FIND_IN_SET(sa.sub_area_id, ag.sub_area_id)
    JOIN branch_creation bc ON ag.branch_id = bc.branch_id
    JOIN area_line_mapping alm ON FIND_IN_SET(sa.sub_area_id, alm.sub_area_id)
    JOIN loan_category_creation lcc ON lcc.loan_category_creation_id = v.loan_category
    WHERE v.status = 0 and v.cus_status IN(2,3,13) and v.sub_area IN ($sub_area_list) "; //show only moved to Approval list and Approve the verification.
}

if (isset($_POST['search']) && $_POST['search'] != "") {

    $query .= " AND (v.dor LIKE '%" . $_POST['search'] . "%'
            OR v.cus_id LIKE '%" . $_POST['search'] . "%'
            OR v.cus_name LIKE '%" . $_POST['search'] . "%'
            OR bc.branch_name LIKE '%" . $_POST['search'] . "%'
            OR ag.group_name LIKE '%" . $_POST['search'] . "%'
            OR alm.line_name LIKE '%" . $_POST['search'] . "%'
            OR a.area_name LIKE '%" . $_POST['search'] . "%'
            OR sa.sub_area_name LIKE '%" . $_POST['search'] . "%'
            OR lcc.loan_category_creation_name LIKE '%" . $_POST['search'] . "%'
            OR v.sub_category LIKE '%" . $_POST['search'] . "%'
            OR v.loan_amt LIKE '%" . $_POST['search'] . "%'
            OR v.user_type LIKE '%" . $_POST['search'] . "%'
            OR v.responsible LIKE '%" . $_POST['search'] . "%'
            OR v.cus_data LIKE '%" . $_POST['search'] . "%' ) ";
}
if (isset($_POST['order'])) {
    $query .= 'ORDER BY ' . $column[$_POST['order']['0']['column']] . ' ' . $_POST['order']['0']['dir'] . ' ';
} else {
    $query .= ' ';
}

$query1 = '';

if ($_POST['length'] != -1) {
    $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$statement = $connect->prepare($query);

$statement->execute();

$number_filter_row = $statement->rowCount();

$statement = $connect->prepare($query . $query1);

$statement->execute();

$result = $statement->fetchAll();

$data = array();
$sno = 1;
foreach ($result as $row) {
    $sub_array   = array();

    $sub_array[] = $sno;

    $sub_array[] = date('d-m-Y', strtotime($row['dor']));
    $sub_array[] = $row['cus_id'];
    $sub_array[] = $row['cus_name'];

    $sub_array[] = $row["branch_name"];
    $sub_array[] = $row['group_name'];
    $sub_array[] = $row['line_name'];
    $sub_array[] = $row['area_name'];
    $sub_array[] = $row['sub_area_name'];
    $sub_array[] = $row["loan_category_creation_name"];
    $sub_array[] = $row['sub_category'];

    $sub_array[] = moneyFormatIndia($row['loan_amt']);
    $sub_array[] = $row['user_type'];
    $sub_array[] = $row['user_name'];

    $ag_id = $row['agent_id'];
    if ($ag_id != '') {

        $qry = $mysqli->query("SELECT * FROM agent_creation where ag_id = $ag_id ");
        $row1 = $qry->fetch_assoc();
        $sub_array[] = $row1['ag_name'];
    } else {
        $sub_array[] = '';
    }

    if ($row['responsible'] == '0') {
        $sub_array[] = 'Yes';
    } else {
        $sub_array[] = '';
    }

    $sub_array[] = $row['cus_data'];
    $id = $row['req_id'];
    $cus_id = $row['cus_id'];

    $cus_status = $row['cus_status'];
    $statusLabels = [
        '2' => "<button class='btn btn-outline-secondary move_acknowledgement' value='$id' data-cusid = '$cus_id'><span class='icon-arrow_forward'></span></button>",
        '3' => 'In Acknowledgement',
        '13' => 'In Issue',
        '6' => 'Cancel - Approval',
        '7' => 'Cancel - Acknowledgement',
        '14' => 'Issued'
    ];

    $sub_array[] = $statusLabels[$cus_status] ?? 'Unknown Status';

    $id          = $row['req_id'];
    $user_type = $row['user_type'];

    $action = "<div class='dropdown'>
    <button class='btn btn-outline-secondary'><i class='fa'>&#xf107;</i></button>
    <div class='dropdown-content'>";
    if ($cus_status == '2') {
        $action .= "<a href='verification&upd=$id&pge=2' class='customer_profile' value='$id' > View Verification</a>
        <a href='#' data-reqid = '$id' class='cancelapproval'>Cancel </a>";
    }
    if ($cus_status == '6') {
        $action .= "<a href='verification&del=$id'class='removeapproval'>Remove Verification</a>";
    }
    if ($login_user_type == 0 or $userid == 1) {
        $action .= "<a href='' data-value ='" . $cus_id . "' data-value1 = '$id' class='customer-status' data-toggle='modal' data-target='.customerstatus'>Customer Status</a>";
    }


    $action .= "</div></div>";

    $sub_array[] = $action;
    $data[]      = $sub_array;
    $sno = $sno + 1;
}
//Format number in Indian Format
function moneyFormatIndia($num)
{
    $explrestunits = "";
    if (strlen($num) > 3) {
        $lastthree = substr($num, strlen($num) - 3, strlen($num));
        $restunits = substr($num, 0, strlen($num) - 3);
        $restunits = (strlen($restunits) % 2 == 1) ? "0" . $restunits : $restunits;
        $expunit = str_split($restunits, 2);
        for ($i = 0; $i < sizeof($expunit); $i++) {
            if ($i == 0) {
                $explrestunits .= (int)$expunit[$i] . ",";
            } else {
                $explrestunits .= $expunit[$i] . ",";
            }
        }
        $thecash = $explrestunits . $lastthree;
    } else {
        $thecash = $num;
    }
    return $thecash;
}

function count_all_data($connect)
{
    $query     = "SELECT * FROM in_verification";
    $statement = $connect->prepare($query);
    $statement->execute();
    return $statement->rowCount();
}

$output = array(
    'draw' => intval($_POST['draw']),
    'recordsTotal' => count_all_data($connect),
    'recordsFiltered' => $number_filter_row,
    'data' => $data
);

echo json_encode($output);
