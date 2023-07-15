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
            <th>Loan ID</th>
            <th>Loan Category</th>
            <th>Sub Category</th>
            <th>Agent</th>
            <th>Loan date</th>
            <th>Loan Amount</th>
            <th>Banlance Amount</th>
            <th>Status</th>
            <th>Sub Status</th>
            <th>Document Status</th>
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
        WHERE lc.cus_id_loan = $cus_id and (ii.cus_status >= 14 and ii.cus_status <= 21)"); //Customer status greater than or equal to 14 because, after issued data only we need  

        $i = 1;
        while ($row = $run->fetch()) {
            //Show NOC button until closed_status submit so we check the count of closed status against the request id.
            $ii_req_id = $row["req_id"];
            $closedSts = $connect->query("SELECT * FROM `closed_status` WHERE `req_id` ='".strip_tags($ii_req_id)."' ");
            $closed_cnt = $closedSts->rowCount();
            
        ?>
        <tr>
            <td><?php echo $row['loan_id']; ?></td> <!-- id -->
            <td><?php echo $row["loan_catrgory_name"]; ?></td> <!-- Loan Cat -->
            <td><?php echo $row["sub_category"]; ?></td> <!-- Loan Sub Cat -->
            <td>
                <?php 
                        if($row["agent_id"] != '' || $row["agent_id"] != NULL){
                            $run1 = $connect->query('SELECT ag_name from agent_creation where ag_id = "'.$row['agent_id'].'" ');
                            echo $run1->fetch()['ag_name'];
                        } 
                        ?>
            </td> <!-- Agent -->
            <td><?php echo date('d-m-Y',strtotime($row["updated_date"])); ?></td> <!-- Loan date -->
            <td><?php echo moneyFormatIndia($row["loan_amt_cal"]); ?></td> <!-- Loan Amount -->
            <td><?php echo moneyFormatIndia($bal_amt[$i-1]); ?></td> <!-- Balance Amount -->
            <td><?php if($row['cus_status'] < 20){echo 'Present';}else if($row['cus_status'] >= 20){ echo 'Closed';} ?>
            </td> <!-- Status -->
            <td><?php if($pending_sts[$i-1] == 'true' && $od_sts[$i-1] == 'false'){
                            if($row['cus_status'] == '15'){
                                echo 'Error';
                            }elseif($row['cus_status']== '16'){
                                echo 'Legal';
                            }else{
                                echo 'Pending';
                            }
                        }else if($od_sts[$i-1] == 'true'){
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
                                    echo "Closed";
                                }else{
                                    echo 'Current';
                                }
                            }
                        } ?></td> <!-- Sub status -->
            <td>
                <?php
                    if($closed_cnt== '0'){
                    if($row['cus_status'] == '20'){ // 20 is collection completed.
                        echo  $action="<div class='dropdown'><span class='btn btn-primary noc-window'  data-value='".$row['req_id']."'>  NOC </span></div>";
                    }
                }else{
                    
                }
                    ?>
            </td> <!-- Action -->
        </tr>

        <?php  $i++;} ?>
    </tbody>
</table>
