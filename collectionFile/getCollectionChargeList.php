<?php
session_start();
include '../ajaxconfig.php';

if (isset($_SESSION["userid"])) {
    $user_id = $_SESSION["userid"];
}

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
?>
<table class="table custom-table" id='collectionChargeListTable'>
    <thead>
        <tr>
            <th> S.No </th>
            <th> Date </th>
            <th> Collection Charges </th>
            <th> Purpose </th>
            <th> Paid Date </th>
            <th> Paid Amount</th>
            <th> Balance Amount</th>
            <th> Waiver Amount</th>
        </tr>
    </thead>
    <tbody>

        <?php
        $req_id = $_POST['req_id'];
        $run = $connect->query("SELECT * FROM `collection_charges` WHERE `req_id`= '$req_id' ");
        // $run = $connect->query("SELECT cc.coll_date,cc.coll_charge,cc.coll_purpose,c.paid_amt,c.bal_amt,c.penalty_waiver FROM `collection` c LEFT JOIN `collection_charges` cc ON c.req_id = cc.req_id WHERE c.`req_id`= '$req_id' GROUP BY c.coll_id ");

        $i = 1;
        $charge = 0;
        $paid = 0;
        while ($row = $run->fetch()) {
            $charge = $charge + $row['coll_charge'] ; 
            $paid = $paid + $row['paid_amnt'] ;
            $bal_amnt = $charge - $paid;
        ?>
            <tr>
                <td width='15'><?php echo $i; ?></td>
                <td><?php echo $row['coll_date']; ?></td>
                <td><?php echo $row['coll_charge']; ?></td>
                <td><?php echo $row['coll_purpose']; ?></td>
                <td><?php echo $row['paid_date']; ?></td>
                <td><?php echo $row['paid_amnt']; ?></td>
                <td><?php echo $bal_amnt; ?></td>
                <td><?php echo $row['waiver_amnt']; ?></td>
            </tr>

        <?php $i++;
        } 
        $sumchargesAmnt = $connect->query("SELECT sum(coll_charge) as charges,sum(paid_amnt) as paidAmnt,sum(waiver_amnt) as charges_waiver FROM `collection_charges` WHERE `req_id`= '$req_id' ");
        $sumAmnt = $sumchargesAmnt->fetch();
        $charges = $sumAmnt['charges'];
        $paid_amt = $sumAmnt['paidAmnt'];
        $charges_waiver = $sumAmnt['charges_waiver'];
        ?>
    </tbody>
    <tr>
    <td></td>
    <td></td>
    <td><b><?php echo $charges; ?></b></td>
    <td></td>
    <td></td>
    <td><b><?php echo $paid_amt; ?></b></td>
    <td></td>
    <td><b><?php echo $charges_waiver; ?></b></td>
</tr>
</table>

<script type="text/javascript">
    $(function() {
        $('#collectionChargeListTable').DataTable({
            'processing': true,
            'iDisplayLength': 10,
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