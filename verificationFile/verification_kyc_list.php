<?php
include '../ajaxconfig.php';
?>

<table class="table custom-table" id="kyc_dataTable">
    <thead>
        <tr>
            <th width="20%"> S.No </th>
            <th> Proof of </th>
            <th> Proof type </th>
            <th> Proof Number </th>
            <th> Upload </th>
        </tr>
    </thead>
    <tbody>

        <?php
        $cus_id = $_POST['cus_id'];
        $KYCInfo = $connect->query("SELECT * FROM `verification_kyc_info` where cus_id = '$cus_id' order by id desc");

        $i = 1;
        while ($kyc = $KYCInfo->fetch()) {
            if($kyc['proofOf'] == '0'){$proof_Of = "Applicant";}else
            if($kyc['proofOf'] == '1'){$proof_Of = "Guarantor";}else
            if($kyc['proofOf'] == '2'){$proof_Of = "Family Members";}else
            if($kyc['proofOf'] == '3'){$proof_Of = "Group Members";}
            
            if($kyc['proof_type'] == '1'){$proof_type = "Adhar";}else
            if($kyc['proof_type'] == '2'){$proof_type = "Smart Card";}else
            if($kyc['proof_type'] == '3'){$proof_type = "Voter ID";}else
            if($kyc['proof_type'] == '4'){$proof_type = "Driving License";}else
            if($kyc['proof_type'] == '5'){$proof_type = "PAN Card";}else
            if($kyc['proof_type'] == '6'){$proof_type = "Passport";}else
            if($kyc['proof_type'] == '7'){$proof_type = "Occupation ID";}else
            if($kyc['proof_type'] == '8'){$proof_type = "Salary Slip";}else
            if($kyc['proof_type'] == '9'){$proof_type = "Bank statement";}else
            if($kyc['proof_type'] == '10'){$proof_type = "EB Bill";}else
            if($kyc['proof_type'] == '11'){$proof_type = "Business Proof";}
            ?>
            <tr>
                <td> <?php echo $i++; ?></td>
                <td> <?php echo $proof_Of; ?></td>
                <td> <?php echo $proof_type; ?></td>
                <td> <?php echo $kyc['proof_no']; ?></td>
                <td> <a href="verificationFile/kycUploads/<?php echo $kyc['upload']; ?>" target="_blank" style="color: #4ba39b;"> <?php echo $kyc['upload']; ?> </a></td>
            </tr>

        <?php  } ?>
    </tbody>
</table>



<script type="text/javascript">
    $(function() {
        $('#kyc_dataTable').DataTable({
            'processing': true,
            'iDisplayLength': 5,
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            "createdRow": function(row, data, dataIndex) {
                $(row).find('td:first').html(dataIndex + 1);
            },
            "drawCallback": function(settings) {
                this.api().column(0).nodes().each(function(cell, i) {
                    cell.innerHTML = i + 1;
                });
            },
        });
    });
</script>