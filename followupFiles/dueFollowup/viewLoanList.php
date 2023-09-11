<?php
session_start();
include '../../ajaxconfig.php';

if(isset($_SESSION["userid"])){
    $user_id = $_SESSION["userid"];
}
if(isset($_POST["pending_sts"])){
    $pending_sts = explode(',',$_POST["pending_sts"]);
}
if(isset($_POST["od_sts"])){
    $od_sts = explode(',',$_POST["od_sts"]);
}
if(isset($_POST["due_nil_sts"])){
    $due_nil_sts = explode(',',$_POST["due_nil_sts"]);
}
if(isset($_POST["closed_sts"])){
    $closed_sts = explode(',',$_POST["closed_sts"]);
}
if(isset($_POST["bal_amt"])){
    $bal_amt = explode(',',$_POST["bal_amt"]);
}

?>

<?php
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
?>
<table class="table custom-table" id='loanListTable'>
    <thead>
        <tr>
            <th>S.No</th>
            <th>Loan ID</th>
            <th>Loan Category</th>
            <th>Sub Category</th>
            <th>Agent</th>
            <th>Loan Amount</th>
            <th>Collection Format</th>
            <th>Status</th>
            <th>Sub Status</th>
            <th>Charts</th>
            <th>Info</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>

        <?php
        $req_id = $_POST['req_id'];
        $cus_id = $_POST['cus_id'];
        $run = $connect->query("SELECT lc.loan_category,lc.sub_category,lc.loan_amt_cal,lc.due_amt_cal,lc.net_cash_cal,lc.collection_method,ii.loan_id,ii.req_id,ii.updated_date,ii.cus_status,
        rc.agent_id,lcc.loan_category_creation_name as loan_catrgory_name, us.collection_access
        from acknowlegement_loan_calculation lc JOIN in_issue ii ON lc.req_id = ii.req_id JOIN request_creation rc ON ii.req_id = rc.req_id 
        JOIN loan_category_creation lcc ON lc.loan_category = lcc.loan_category_creation_id JOIN user us ON us.user_id = $user_id
        WHERE lc.cus_id_loan = $cus_id and (ii.cus_status >= 14 and ii.cus_status < 20)"); //Customer status greater than or equal to 14 because, after issued data only we need

        $i = 1;
        while ($row = $run->fetch()) {
        ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $row['loan_id']; ?></td>
                <td><?php echo $row["loan_catrgory_name"]; ?></td>
                <td><?php echo $row["sub_category"]; ?></td>
                <td>
                    <?php 
                        if($row["agent_id"] != '' || $row["agent_id"] != NULL){
                            $run1 = $connect->query('SELECT ag_name from agent_creation where ag_id = "'.$row['agent_id'].'" ');
                            echo $run1->fetch()['ag_name'];
                        } 
                        ?>
                </td>
                <td><?php echo moneyFormatIndia($row["loan_amt_cal"]); ?></td>
                <td><?php if($row["collection_method"] == '1'){ echo 'By Self';}else if($row["collection_method"] == '2'){ echo 'Spot Collection';}else if($row["collection_method"] == '3'){ echo 'Cheque Collection';}else if($row["collection_method"] == '4'){ echo 'ECS';} ?></td>
                <td><?php echo 'Present'; ?></td>
                <td><?php if($pending_sts[$i-1] == 'true' && $od_sts[$i-1] == 'false'){
                            if($row['cus_status'] == '15'){
                                echo 'Error';
                            }elseif($row['cus_status']== '16'){
                                echo 'Legal';
                            }else{
                                echo 'Pending';
                            }
                        }else if($od_sts[$i-1] == 'true' && $due_nil_sts[$i-1] =='false'){
                            if($row['cus_status'] == '15'){
                                echo 'Error';
                            }elseif($row['cus_status']== '16'){
                                echo 'Legal';
                            }else{
                                echo 'OD';
                            }
                        }elseif($due_nil_sts[$i-1] == 'true'){
                            if($row['cus_status'] == '15'){
                                echo 'Error';
                            }elseif($row['cus_status']== '16'){
                                echo 'Legal';
                            }else{
                                echo 'Due Nil';
                            }
                        }elseif($pending_sts[$i-1] == 'false'){
                            if($row['cus_status'] == '15'){
                                echo 'Error';
                            }elseif($row['cus_status']== '16'){
                                echo 'Legal';
                            }else{
                                if($closed_sts[$i-1] == 'true'){
                                    echo "Move To Close";
                                }else{
                                    echo 'Current';
                                }
                            }
                        } ?></td>
                <td>
                    <?php 
                        $action="<div class='dropdown' ><button class='btn btn-outline-secondary' ";
                        
                        $action .="><i class='fa'>&#xf107;</i></button><div class='dropdown-content'>";
                        $action .= "<a><span data-toggle='modal' data-target='.DueChart' class='due-chart' value='".$row['req_id']."' > Due Chart</span></a>
                        <a><span data-toggle='modal' data-target='.PenaltyChart' class='penalty-chart' value='".$row['req_id']."' > Penalty Chart</span></a>
                        <a><span data-toggle='modal' data-target='.collectionChargeChart' class='coll-charge-chart' value='".$row['req_id']."' > Fine Chart</span></a>
                        <a><span data-toggle='modal' data-target='#commitmentChart' class='commitment-chart' data-reqid='".$row['req_id']."' > Commitment Chart </span></a>";
                        $action .= "</div></div>";
                        echo $action;
                    ?>
                </td>
                <td>
                    <?php 
                        $r_id = $row['req_id'];
                        $action="<div class='dropdown' ><button class='btn btn-outline-secondary' ";
                        
                        $action .="><i class='fa'>&#xf107;</i></button><div class='dropdown-content'>";
                        $action .= "<a href='due_followup_info&upd=$r_id&pgeView=1'> Customer Profile </a>
                        <a href='due_followup_info&upd=$r_id&pgeView=2'> Documentation </a>
                        <a href='due_followup_info&upd=$r_id&pgeView=3'> Loan Calculation </a>
                        <a href='' class='loan-history-window'> Loan History </a>
                        <a href='' class='doc-history-window'> Document History </a>";
                        $action .= "</div></div>";
                        echo $action;
                    ?>
                </td>
                <td>
                    <?php 
                        $action="<div class='dropdown' ><button class='btn btn-outline-secondary' ";
                        
                        $action .="><i class='fa'>&#xf107;</i></button><div class='dropdown-content'>";
                        $action .= "<a><span data-toggle='modal' data-target='#addCommitment' class='add-commitment-chart' data-reqid='".$row['req_id']."' > New Commitment </span></a>";
                        $action .= "</div></div>";
                        echo $action;
                    ?>
                </td>
            </tr>

        <?php  $i++;} ?>
    </tbody>
</table>

<script type="text/javascript">
    $(function() {
        $('#loanListTable').DataTable({
            'processing': true,
            'iDisplayLength': 5,
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            dom: 'lBfrtip',
            buttons: [{
                    extend: 'excel',
                },
                {
                    extend: 'colvis',
                    collectionLayout: 'fixed four-column',
                }
            ],
            // "createdRow": function(row, data, dataIndex) {
            //     $(row).find('td:first').html(dataIndex + 1);
            // },
            // "drawCallback": function(settings) {
            //     this.api().column(0).nodes().each(function(cell, i) {
            //         cell.innerHTML = i + 1;
            //     });
            // },
        });
    });
    $('button').click(function(){
        event.preventDefault();
    })
    $('.dropdown').click(function(event) {
        
        $('.dropdown').not(this).removeClass('active');
        $(this).toggleClass('active');
    });

    $(document).click(function(event) {
        var target = $(event.target);
        if (!target.closest('.dropdown').length) {
            $('.dropdown').removeClass('active');
        }
    });
    $('.due-chart, .penalty-chart, .coll-charge-chart, .coll-charge, .add-commitment-chart, .commitment-chart').css('color','black');

    
</script>