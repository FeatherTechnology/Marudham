<?php
@session_start();
include('..\ajaxconfig.php');

if (isset($_SESSION["userid"])) {
    $userid = $_SESSION["userid"];
}
if ($userid != 1) {

    $userQry = $con->query("SELECT * FROM USER WHERE user_id = $userid ");
    while ($rowuser = $userQry->fetch_assoc()) {
        $group_id = $rowuser['group_id'];
        $line_id = $rowuser['line_id'];
    }

    $line_id = explode(',', $line_id);
    $sub_area_list = array();
    foreach ($line_id as $line) {
        $lineQry = $con->query("SELECT * FROM area_line_mapping where map_id = $line ");
        $row_sub = $lineQry->fetch_assoc();
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
    'cc.id',
    'cc.com_code',
    'cc.com_date',
    'b.branch_name',
    'sc.staff_name',
    'cs.concern_subject',
    'cc.status',
    'cc.id'
);

$query = "SELECT cc.*,b.branch_name,sc.staff_name,cs.concern_subject
    FROM concern_creation cc
    JOIN branch_creation b ON cc.branch_name = b.branch_id 
    JOIN staff_creation sc ON cc.staff_assign_to = sc.staff_id
    JOIN concern_subject cs ON cc.com_sub = cs.concern_sub_id
    WHERE cc.status != 2  && cc.insert_user_id = '" . strip_tags($userid) . "'"; // 
// echo $query;

if (isset($_POST['search']) && $_POST['search'] != "") {
    $query .= " AND (cc.com_code LIKE '%" . $_POST['search'] . "%' OR
            cc.com_date LIKE '%" . $_POST['search'] . "%' OR
            b.branch_name LIKE '%" . $_POST['search'] . "%' OR
            sc.staff_name LIKE '%" . $_POST['search'] . "%' OR
            cs.concern_subject LIKE '%" . $_POST['search'] . "%') ";
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

    $sub_array[] = $row['com_code'];
    $sub_array[] = date('d-m-Y', strtotime($row['com_date']));
    $sub_array[] = $row['branch_name'];
    $sub_array[] = $row['staff_name'];
    $sub_array[] = $row['concern_subject'];

    //Status
    $con_sts = $row['status'];
    if ($con_sts == 0) {
        $sub_array[] = 'Pending';
    }
    if ($con_sts == 1) {
        $sub_array[] = 'Resolved';
    }

    $id          = $row['id'];
    if ($con_sts == 1) {
        $action = "<a href='concern_solution_view&upd=$id&pageId=1' title='View Solution' >  <span class='icon-eye' style='font-size: 12px;position: relative;top: 2px;'></span> </a>";
    } else {
        $action = '';
    }
    $sub_array[] = $action;

    $data[]      = $sub_array;
    $sno = $sno + 1;
}

function count_all_data($connect)
{
    $query     = "SELECT cc.*,b.branch_name,sc.staff_name,cs.concern_subject
    FROM concern_creation cc
    JOIN branch_creation b ON cc.branch_name = b.branch_id 
    JOIN staff_creation sc ON cc.staff_assign_to = sc.staff_id
    JOIN concern_subject cs ON cc.com_sub = cs.concern_sub_id
    WHERE cc.status != 2";
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
