<?php 
include('../ajaxconfig.php');
if(isset($_POST['dir_type'])){
    $dir_type = $_POST['dir_type'];
}

$directorArr = array();

$result=$con->query("SELECT * FROM director_creation where status=0 and dir_type = '".$dir_type."' ");
while( $row = $result->fetch_assoc()){
    $dir_id = $row['dir_id'];
    $dir_name = $row['dir_name'];
    $directorArr[] = array("dir_id" => $dir_id, "dir_name" => $dir_name);
}

echo json_encode($directorArr);
?>