<?php
include '../ajaxconfig.php';

if(isset($_POST["staff_type_id"])){
	$staff_type_id  = $_POST["staff_type_id"];
}

$getct = "SELECT * FROM staff_type_creation WHERE staff_type_id = '".$staff_type_id."' AND status=0";
$result = $con->query($getct);
while($row=$result->fetch_assoc())
{
    $staff_type_name = $row['staff_type_name'];
}

echo $staff_type_name;
?>