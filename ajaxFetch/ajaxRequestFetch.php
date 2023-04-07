<?php
@session_start();
include('..\ajaxconfig.php');

if(isset($_SESSION["userid"])){
    $userid = $_SESSION["userid"];
}

$column = array(
    'req_id',
    'dor',
    'cus_id',
    'cus_name',
    'cus_name',//for branch
    'cus_name',//for group
    'cus_name',//for line
    'area',
    'sub_area',
    'loan_category',
    'sub_category',
    'loan_amt',
    'user_type',
    'user_name',
    'agent_id',
    'responsible',
    'cus_data',
    'cus_status',
    'status'
);

$query = "SELECT * FROM request_creation where status= 0 and (cus_status != 7 and cus_status != 8) and insert_login_id = $userid ";//hide if issued or revoked(after issued cus_status = 7 , revoked = 8)
if($userid == 1){
    $query = 'SELECT * FROM request_creation where status =0 and (cus_status != 7 and cus_status != 8)';
}
if($_POST['search'] != "")
{
    if (isset($_POST['search'])) {

        $query .= "
            and req_id LIKE '%".$_POST['search']."%'
            OR dor LIKE '%".$_POST['search']."%'
            OR cus_id LIKE '%".$_POST['search']."%'
            OR cus_name LIKE '%".$_POST['search']."%'
            OR area LIKE '%".$_POST['search']."%'
            OR sub_area LIKE '%".$_POST['search']."%'
            OR loan_category LIKE '%".$_POST['search']."%'
            OR sub_category LIKE '%".$_POST['search']."%'
            OR loan_amt LIKE '%".$_POST['search']."%'
            OR user_type LIKE '%".$_POST['search']."%'
            OR user_name LIKE '%".$_POST['search']."%'
            OR agent_id LIKE '%".$_POST['search']."%'
            OR responsible LIKE '%".$_POST['search']."%'
            OR cus_data LIKE '%".$_POST['search']."%'
            OR cus_status LIKE '%".$_POST['search']."%'  ";
    }
}
// print_r($query);die;
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
    
    $sub_array[] = date('d-m-Y',strtotime($row['dor']));
    
    // $cus_id = $row['cus_id'];
    // $cus_id = preg_replace('/\D/', '', $cus_id);
    // $cus_id = implode(' ', str_split($cus_id, 4));
    // $sub_array[] = $cus_id;

    $sub_array[] = $row['cus_id'];
    $sub_array[] = $row['cus_name'];
    
    //Area Name fetch
    $area_id = $row['area'];
    $qry = $mysqli->query("SELECT * FROM area_list_creation where area_id = $area_id ");
    $row1 = $qry->fetch_assoc();
    $area_name = $row1['area_name'];
    
    //Sub Area Name Fetch
    $sub_area_id = $row['sub_area'];
    $qry = $mysqli->query("SELECT * FROM sub_area_list_creation where sub_area_id = $sub_area_id ");
    $row1 = $qry->fetch_assoc();
    $sub_area_name = $row1['sub_area_name'];
    
    //Group name Fetch
    $qry = $mysqli->query("SELECT * FROM area_group_mapping where FIND_IN_SET($sub_area_id,sub_area_id)");
    $row1 = $qry->fetch_assoc();
    $group_name = $row1['group_name'];
    $branch_id = $row1['branch_id'];

    //Branch name Fetch
    $getbranchQry = "SELECT * from branch_creation where branch_id = '".$branch_id."' and status = 0 ";
    $res=$con->query($getbranchQry);
    $row1=$res->fetch_assoc();
    $branch_name = $row1["branch_name"];        

    //Line name Fetch
    $qry = $mysqli->query("SELECT * FROM area_line_mapping where FIND_IN_SET($sub_area_id,sub_area_id)");
    $row1 = $qry->fetch_assoc();
    $line_name = $row1['line_name'];

    $sub_array[] = $branch_name;
    $sub_array[] = $group_name;
    $sub_array[] = $line_name;
    $sub_array[] = $area_name;
    $sub_array[] = $sub_area_name;
    

    $loanCategoryName = $row['loan_category'];   
    $getqry = "SELECT * FROM loan_category_creation WHERE loan_category_creation_id ='".strip_tags($loanCategoryName)."' ";
    $res12 = $con->query($getqry);
    $row12 = $res12->fetch_assoc();
    $sub_array[] = $row12["loan_category_creation_name"];      

    $sub_array[] = $row['sub_category'];
    
    $sub_array[] = moneyFormatIndia($row['loan_amt']);
    $sub_array[] = $row['user_type'];
    $sub_array[] = $row['user_name'];
    
    $ag_id = $row['agent_id'];
    if($ag_id != ''){

        $qry = $mysqli->query("SELECT * FROM agent_creation where ag_id = $ag_id ");
        $row1 = $qry->fetch_assoc();
        $sub_array[] = $row1['ag_name'];
    }else{
        $sub_array[] = '';
    }

    if($row['responsible'] == '0'){$sub_array[] = 'Yes';}else{$sub_array[] = '';}

    $sub_array[] = $row['cus_data'];
    $id = $row['req_id'];
    
    $cus_status = $row['cus_status'];
    if($cus_status == '0'){$sub_array[] = "<button class='btn btn-outline-secondary sub_verification' value='$id'><span class = 'icon-arrow_forward'></span></button>";}else
    if($cus_status == '1'){$sub_array[] = 'In Verification';}else
    if($cus_status == '2'){$sub_array[] = 'In Approval';}else
    if($cus_status == '3'){$sub_array[] = 'In Issue';}else
    if($cus_status == '4'){$sub_array[] = 'Cancel - Request';}else
    if($cus_status == '5'){$sub_array[] = 'Cancel - Verification';}else
    if($cus_status == '6'){$sub_array[] = 'Cancel - Approval';}


    $id          = $row['req_id'];
    $user_type = $row['user_type'];
    $cus_id = $row['cus_id'];
    
    $action="<div class='dropdown' style='float:right;'>
    <button class='btn btn-outline-secondary'><i class='fa'>&#xf107;</i></button>
    <div class='dropdown-content'>";
    if($cus_status == '0') {
        $action .= "<a href='request&upd=$id'>Edit Request</a><a href='request&can=$id' class='cancelrequest'>Cancel Request</a>
        <a href='request&rev=$id'class='revokerequest'>Revoke Request</a>";
    }
    if($cus_status == '4' or $cus_status == '5' or $cus_status == '6'){
        $action .= "<a href='request&del=$id'class='removerequest'>Remove Request</a>";
    }
    if($user_type != 'Agent'){
        $action .= "<a href='' data-value ='".$cus_id."' data-value1 = '$id' class='customer-status' data-toggle='modal' data-target='.customerstatus'>Customer Status</a>";
    }elseif($userid == 1){
        $action .= "<a href='' data-value ='".$cus_id."' data-value1 = '$id' class='customer-status' data-toggle='modal' data-target='.customerstatus'>Customer Status</a>";
    }
    
    $action .= "</div></div>";
    
    $sub_array[] = $action;
    $data[]      = $sub_array;
    $sno = $sno+1;
}

//Format number in Indian Format
function moneyFormatIndia($num) {
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
    $query     = "SELECT * FROM request_creation";
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

?>