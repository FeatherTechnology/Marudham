<?php
require '../ajaxconfig.php';

$req_id       = $_POST['reqId'];
$cus_id       = $_POST['cus_id'];
$proofof       = $_POST['proofof'];
$proof_type    = $_POST['proof_type'];
$proof_number  = $_POST['proof_number'];
$upload        = $_FILES['upload']['name'];
$kycID         = $_POST['kycID'];



$path = "kycUploads/";
$path = $path . basename( $_FILES['upload']['name']);

if(move_uploaded_file($_FILES['upload']['tmp_name'], $path)) {
  echo "The file ".  basename( $_FILES['upload']['name']). 
  " has been uploaded";
} else{
    echo "There was an error uploading the file, please try again!";
}



if($kycID == ''){

$insert_qry = $connect ->query("INSERT INTO `verification_kyc_info`(`cus_id`, `req_id`, `proofOf`, `proof_type`, `proof_no`, `upload`) VALUES ('$cus_id','$req_id','$proofof','$proof_type','$proof_number','$upload')");

}
else{

    if($upload){
        $kyc_upload = $upload;

    }else{
        $kyc_upload = $_POST['kyc_upload'];
    }
    
$update = $connect->query("UPDATE `verification_kyc_info` SET `cus_id`='$cus_id',`req_id`='$req_id',`proofOf`='$proofof',`proof_type`='$proof_type',`proof_no`='$proof_number',`upload`='$kyc_upload' WHERE `id`='$kycID'");

}

if($insert_qry){
    $result = "KYC Info Inserted Successfully.";
}
elseif($update){
    $result = "KYC Info Updated Successfully.";
}

echo json_encode($result);
?>