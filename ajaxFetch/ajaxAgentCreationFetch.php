<?php
@session_start();
include('..\ajaxconfig.php');

$column = array(
    'ag_id',
    'company_id',
    'branch_id',
    'ag_name',
    'ag_group_id',
    'place',
    'district',
    'loan_category',
    'sub_category',
    'status',
);

$query = "SELECT * FROM agent_creation ";
// if($_POST['search'] != "")
// {
//     if (isset($_POST['search'])) {

//         if($_POST['search']=="Active" or $_POST['search']=="active")
//         {
//             $query .="WHERE status=0 ";
            
//         }
//         else if($_POST['search']=="Inactive" or $_POST['search']=="inactive")
//         {
//             $query .="WHERE status=1 ";
//         }

//         else{   
//             // $branch_name = $_POST['search'];
//             // $getbranchQry = "SELECT * from branch_creation where branch_name LIKE '%".$branch_name."%' and status = 0 ";
//             // $res=$con->query($getbranchQry);
//             // if($con->affected_rows > 0){
//             //     while($row1=$res->fetch_assoc())
//             //     {
//             //         $branch_search = $row1["branch_id"];        
//             //     }
//             // }else{$branch_search = '';}

//             // OR branch_id LIKE '%".$_POST['search']."%'
//             $query .= "WHERE
//                 ag_name LIKE '%".$_POST['search']."%'
//                 OR company_id LIKE '%".$_POST['search']."%'
//                 OR ag_group_id LIKE '%".$_POST['search']."%'
//                 OR place LIKE '%".$_POST['search']."%'
//                 OR district LIKE '%".$_POST['search']."%'
//                 OR loan_category LIKE '%".$_POST['search']."%'
//                 OR sub_category LIKE '%".$_POST['search']."%'
//                 OR status LIKE '%".$_POST['search']."%' ";
//         }
//     }
//     // print_r($query);
// }
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

    //Company name Fetch
    $company_id = $row['company_id'];
    $getQry = "SELECT * from company_creation where company_id = '".$company_id."' and status = 0 ";
    $res=$con->query($getQry);
    while($row1=$res->fetch_assoc())
    {
        $sub_array[] = $row1["company_name"];        
    }

    

    $sub_array[] = $row['ag_name'];

    $ag_group_id = $row['ag_group_id'];
    $selectQry = "SELECT * From agent_group_creation where status=0 and agent_group_id = '".$ag_group_id."' ";
    $result = $con->query($selectQry) or die;
    $row1 = $result->fetch_assoc();
    $sub_array[] = $row1['agent_group_name'];
    
    $sub_array[] = $row['place'];
    $sub_array[] = $row['district'];
    
    //Loan category name Fetch
    $loan_category_id1 = explode(',',$row['loan_category']);
    $loan_category = array();
    foreach($loan_category_id1 as $loan_category_id){
        $qry = "SELECT * From loan_category_creation where loan_category_creation_id = $loan_category_id and status = 0";
        $res = $con->query($qry);
        $row1 = $res->fetch_assoc();
        $loan_category[] = $row1['loan_category_creation_name'];
    }
    $loan_category_name = implode(',',$loan_category);

    $sub_array[] = $loan_category_name;        
    
    $sub_array[] = $row["sub_category"];        

    $status      = $row['status'];

    if($status==1)
    {
    $sub_array[]="<span style='width: 144px;'><span class='kt-badge  kt-badge--danger kt-badge--inline kt-badge--pill'>Inactive</span></span>";
    }
    else
    {
    $sub_array[]="<span style='width: 144px;'><span class='kt-badge  kt-badge--success kt-badge--inline kt-badge--pill'>Active</span></span>";
    }
    $id          = $row['ag_id'];
    
    $action="<a href='agent_creation&upd=$id' title='Edit details'><span class='icon-border_color'></span></a>&nbsp;&nbsp; 
    <a href='agent_creation&del=$id' title='Edit details' class='delete_ag'><span class='icon-trash-2'></span></a>";

    $sub_array[] = $action;
    $data[]      = $sub_array;
    $sno = $sno+1;
}

function count_all_data($connect)
{
    $query     = "SELECT * FROM agent_creation";
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