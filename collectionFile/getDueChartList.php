<?php
include '../ajaxconfig.php';
include 'getLoanDetailsClass.php';


function moneyFormatIndia($num)
{
    $isNegative = false;
    if ($num < 0) {
        $isNegative = true;
        $num = abs($num);
    }

    $explrestunits = "";
    if (strlen((string)$num) > 3) {
        $lastthree = substr((string)$num, -3);
        $restunits = substr((string)$num, 0, -3);
        $restunits = (strlen($restunits) % 2 == 1) ? "0" . $restunits : $restunits;
        $expunit = str_split($restunits, 2);
        foreach ($expunit as $index => $value) {
            if ($index == 0) {
                $explrestunits .= (int)$value . ",";
            } else {
                $explrestunits .= $value . ",";
            }
        }
        $thecash = $explrestunits . $lastthree;
    } else {
        $thecash = $num;
    }

    return $isNegative ? "-" . $thecash : $thecash;
}
?>
<table class="table custom-table table-responsive" id='dueChartListTable'>


    <?php
    $req_id = $_POST['req_id'];
    $cus_id = $_POST['cus_id'];
    $curDateChecker = true;
    if (isset($_POST['closed'])) {
        $closed = $_POST['closed'];
    } else {
        $closed = 'false';
    }
    $loanStart = $connect->query("SELECT alc.due_start_from,alc.maturity_month,alc.due_method_calc,alc.due_method_scheme FROM acknowlegement_loan_calculation alc WHERE alc.`req_id`= '$req_id' ");
    $loanFrom = $loanStart->fetch();
    //If Due method is Monthly, Calculate penalty by checking the month has ended or not
    $due_start_from = $loanFrom['due_start_from'];
    $maturity_month = $loanFrom['maturity_month'];


    if ($loanFrom['due_method_calc'] == 'Monthly' || $loanFrom['due_method_scheme'] == '1') {
        //If Due method is Monthly, Calculate penalty by checking the month has ended or not

        // Create a DateTime object from the given date
        $maturity_month_obj = new DateTime($maturity_month);
        // Subtract one month from the date
        // $maturity_month->modify('-1 month');
        // Format the date as a string
        $maturity_month = $maturity_month_obj->format('Y-m-d');

        $due_start_from = date('Y-m-d', strtotime($due_start_from));
        $maturity_month = date('Y-m-d', strtotime($maturity_month));
        $current_date = date('Y-m-d');

        $start_date_obj = DateTime::createFromFormat('Y-m-d', $due_start_from);
        $end_date_obj = DateTime::createFromFormat('Y-m-d', $maturity_month);
        $current_date_obj = DateTime::createFromFormat('Y-m-d', $current_date);
        $interval = new DateInterval('P1M'); // Create a one month interval
        //$count = 0;
        $i = 1;
        $dueMonth[] = $due_start_from;
        while ($start_date_obj < $end_date_obj) {
            $start_date_obj->add($interval);
            $dueMonth[] = $start_date_obj->format('Y-m-d');
        }
    } else
        if ($loanFrom['due_method_scheme'] == '2') {
        //If Due method is Weekly, Calculate penalty by checking the month has ended or not
        $current_date = date('Y-m-d');

        // Create a DateTime object from the given date
        $maturity_month_obj = new DateTime($maturity_month);
        // Subtract one month from the date
        // $maturity_month->modify('-7 days');
        // Format the date as a string
        $maturity_month = $maturity_month_obj->format('Y-m-d');

        $start_date_obj = DateTime::createFromFormat('Y-m-d', $due_start_from);
        $end_date_obj = DateTime::createFromFormat('Y-m-d', $maturity_month);
        $current_date_obj = DateTime::createFromFormat('Y-m-d', $current_date);

        $interval = new DateInterval('P1W'); // Create a one Week interval

        //$count = 0;
        $i = 1;
        $dueMonth[] = $due_start_from;
        while ($start_date_obj < $end_date_obj) {
            $start_date_obj->add($interval);
            $dueMonth[] = $start_date_obj->format('Y-m-d');
        }
    } else
        if ($loanFrom['due_method_scheme'] == '3') {
        //If Due method is Daily, Calculate penalty by checking the month has ended or not
        $current_date = date('Y-m-d');

        // Create a DateTime object from the given date
        $maturity_month_obj = new DateTime($maturity_month);
        // Subtract one month from the date
        // $maturity_month->modify('-1 days');
        // Format the date as a string
        $maturity_month = $maturity_month_obj->format('Y-m-d');

        $start_date_obj = DateTime::createFromFormat('Y-m-d', $due_start_from);
        $end_date_obj = DateTime::createFromFormat('Y-m-d', $maturity_month);
        $current_date_obj = DateTime::createFromFormat('Y-m-d', $current_date);

        $interval = new DateInterval('P1D'); // Create a one Week interval

        //$count = 0;
        $i = 1;
        $dueMonth[] = $due_start_from;
        while ($start_date_obj < $end_date_obj) {
            $start_date_obj->add($interval);
            $dueMonth[] = $start_date_obj->format('Y-m-d');
        }
    }
    // if($closed == 'true'){
    //     // $issueDate = $connect->query("SELECT li.loan_amt,ii.updated_date FROM in_issue ii JOIN loan_issue li ON li.req_id = ii.req_id  WHERE ii.req_id = '$req_id' and ii.cus_status = 20 order by li.id desc limit 1 ");
    //     $issueDate = $connect->query("SELECT alc.due_amt_cal,alc.int_amt_cal,alc.tot_amt_cal,alc.principal_amt_cal,ii.updated_date FROM in_issue ii JOIN acknowlegement_loan_calculation alc ON ii.req_id = alc.req_id  WHERE ii.req_id = '$req_id' and ii.cus_status = 20 order by alc.loan_cal_id desc limit 1 ");

    // }else{
    // $issueDate = $connect->query("SELECT li.loan_amt,ii.updated_date FROM in_issue ii JOIN loan_issue li ON li.req_id = ii.req_id  WHERE ii.req_id = '$req_id' and ii.cus_status = 14 order by li.id desc limit 1 ");
    $issueDate = $connect->query("SELECT alc.due_amt_cal,alc.int_amt_cal,alc.tot_amt_cal,alc.principal_amt_cal,ii.updated_date FROM in_issue ii JOIN acknowlegement_loan_calculation alc ON ii.req_id = alc.req_id  WHERE ii.req_id = '$req_id' and (ii.cus_status >= 14 ) order by alc.loan_cal_id desc limit 1 ");
    // }
    $loanIssue = $issueDate->fetch();
    //If Due method is Monthly, Calculate penalty by checking the month has ended or not
    if ($loanIssue['tot_amt_cal'] == '' || $loanIssue['tot_amt_cal'] == null) {
        //(For monthly interest total amount will not be there, so take principals)
        $loan_amt = intVal($loanIssue['principal_amt_cal']);
        $loan_type = 'interest';
    } else {
        $loan_amt = intVal($loanIssue['tot_amt_cal']);
        $loan_type = 'emi';
    }

    $due_amt_1 = $loanIssue['due_amt_cal'];

    if ($loan_type == 'interest') {
        $princ_amt_1 = $loanIssue['principal_amt_cal'];
        $due_amt_1 = $loanIssue['int_amt_cal'];
    }

    $issue_date = $loanIssue['updated_date'];
    ?>

    <thead>
        <tr>
            <th width="15"> Due No </th>
            <th width="8%"> Due Month </th>
            <th> Month </th>
            <?php if ($loan_type == 'emi') { ?>
                <th> Due Amount </th>
            <?php } ?>
            <?php if ($loan_type == 'interest') { ?>
                <th> Principal </th>
                <th> Interest </th>
            <?php } ?>
            <th> Pending </th>
            <th> Payable </th>
            <th> Collection Date </th>
            <?php if ($loan_type == 'emi') { ?>
                <th> Collection Amount </th>
            <?php } ?>
            <?php if ($loan_type == 'interest') { ?>
                <th> Principal Amount </th>
                <th> Interest Amount </th>
            <?php } ?>
            <th> Balance Amount </th>
            <th> Pre Closure </th>
            <th> Role </th>
            <th width="8%"> User ID </th>
            <th> Collection Method </th>
            <th> ACTION </th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td> </td>
            <td><?php
                if ($loanFrom['due_method_calc'] == 'Monthly' || $loanFrom['due_method_scheme'] == '1') {
                    //For Monthly.
                    echo date('m-Y', strtotime($issue_date));
                } else {
                    //For Weekly && Day.
                    echo date('d-m-Y', strtotime($issue_date));
                } ?></td>
            <td><?php echo date('M', strtotime($issue_date)); ?></td>
            <?php if ($loan_type == 'emi') { ?>
                <td> </td>
            <?php } ?>
            <?php if ($loan_type == 'interest') { ?>
                <td> </td>
                <td> </td>
            <?php } ?>
            <td></td>
            <td></td>
            <td></td>

            <!-- for collected amt -->
            <?php if ($loan_type == 'emi') { ?>
                <td> </td>
            <?php } ?>
            <?php if ($loan_type == 'interest') { ?>
                <td> </td>
                <td> </td>
            <?php } ?>

            <td><?php echo $loan_amt; ?></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <?php
        $issued = date('Y-m-d', strtotime($issue_date));
        if ($loanFrom['due_method_calc'] == 'Monthly' || $loanFrom['due_method_scheme'] == '1') {
            //Query for Monthly.
            $run = $connect->query("SELECT c.coll_code, c.due_amt,c.tot_amt, c.pending_amt, c.payable_amt, c.coll_date, c.trans_date, c.due_amt_track,c.princ_amt_track,c.int_amt_track, c.bal_amt, c.coll_charge_track, c.coll_location, c.pre_close_waiver, alc.due_start_from, alc.maturity_month, alc.due_method_calc, u.fullname, u.role
            FROM `collection` c
            LEFT JOIN acknowlegement_loan_calculation alc ON c.req_id = alc.req_id
            LEFT JOIN user u ON c.insert_login_id = u.user_id
            WHERE c.`req_id` = '$req_id' AND (c.due_amt_track != '' or c.pre_close_waiver!='' OR c.princ_amt_track != '' OR c.int_amt_track != '')
            AND(
                (
                    ( MONTH(c.coll_date) >= MONTH('$issued') AND YEAR(c.coll_date) = YEAR('$issued') )
                    AND 
                    ( 
                        (
                            YEAR(c.coll_date) = YEAR('$due_start_from') AND MONTH(c.coll_date) < MONTH('$due_start_from')
                        ) OR (
                            YEAR(c.coll_date) < YEAR('$due_start_from')
                        )
                    )
                ) 
                OR
                (
                    ( MONTH(c.trans_date) >= MONTH('$issued') AND YEAR(c.trans_date) = YEAR('$issued') )
                    AND 
                    ( 
                        (
                            YEAR(c.trans_date) = YEAR('$due_start_from') AND MONTH(c.trans_date) < MONTH('$due_start_from')
                        ) OR (
                            YEAR(c.trans_date) < YEAR('$due_start_from')
                        )
                            AND c.trans_date != '0000-00-00'
                    )
                )
            )");
        } else
        if ($loanFrom['due_method_scheme'] == '2') {
            //Query For Weekly.
            $run = $connect->query("SELECT c.coll_code, c.due_amt, c.pending_amt, c.payable_amt, c.coll_date, c.trans_date, c.due_amt_track, c.bal_amt, c.coll_charge_track, c.coll_location, c.pre_close_waiver, alc.due_start_from, alc.maturity_month, alc.due_method_calc, u.fullname, u.role
            FROM `collection` c
            LEFT JOIN acknowlegement_loan_calculation alc ON c.req_id = alc.req_id
            LEFT JOIN user u ON c.insert_login_id = u.user_id
            WHERE c.`req_id` = '$req_id' AND (c.due_amt_track != '' or c.pre_close_waiver!='' OR c.princ_amt_track != '')
            AND (
                    (
                        (WEEK(c.coll_date) >= WEEK('$issued') AND YEAR(c.coll_date) = YEAR('$issued'))
                        AND 
                        (
                            (
                                YEAR(c.coll_date) = YEAR('$due_start_from') AND WEEK(c.coll_date) < WEEK('$due_start_from')
                            ) OR (
                                YEAR(c.coll_date) < YEAR('$due_start_from')
                            )
                        )
                    ) 
                    OR
                    (
                        (WEEK(c.trans_date) >= WEEK('$issued') AND YEAR(c.trans_date) = YEAR('$issued'))
                        AND 
                        (
                            (
                                YEAR(c.trans_date) = YEAR('$due_start_from') AND WEEK(c.trans_date) < WEEK('$due_start_from')
                            ) OR (
                                YEAR(c.trans_date) < YEAR('$due_start_from')
                            )
                            AND c.trans_date != '0000-00-00'

                        )
                    )
                )
            ");
        } else
        if ($loanFrom['due_method_scheme'] == '3') {
            //Query For Day.
            $run = $connect->query("SELECT c.coll_code, c.due_amt, c.pending_amt, c.payable_amt, c.coll_date, c.trans_date, c.due_amt_track, c.bal_amt, c.coll_charge_track, c.coll_location, c.pre_close_waiver, alc.due_start_from, alc.maturity_month, alc.due_method_calc, u.fullname, u.role
            FROM `collection` c
            LEFT JOIN acknowlegement_loan_calculation alc ON c.req_id = alc.req_id
            LEFT JOIN user u ON c.insert_login_id = u.user_id
            WHERE c.`req_id` = '$req_id' AND (c.due_amt_track != '' or c.pre_close_waiver!='')
            AND (
                (DATE(c.coll_date) >= DATE('$issued') AND DATE(c.coll_date) < DATE('$due_start_from') AND DATE(c.coll_date) != '0000-00-00' ) OR
                (DATE(c.trans_date) >= DATE('$issued') AND DATE(c.trans_date) < DATE('$due_start_from') AND DATE(c.trans_date) != '0000-00-00' )
            ) ");
        }

        //For showing data before due start date
        $due_amt_track = 0;
        $waiver = 0;
        $last_bal_amt = 0;
        $bal_amt = $loan_amt;
        if ($run->rowCount() > 0) {
            while ($row = $run->fetch()) {
                $role = $row['role'];
                $collectionAmnt = intVal($row['due_amt_track']);
                $due_amt_track = $due_amt_track + intVal($row['due_amt_track']);
                $waiver = $waiver + intVal($row['pre_close_waiver']);
                if ($loan_type == 'interest') {
                    $PcollectionAmnt = intVal($row['princ_amt_track']);
                    $IcollectionAmnt = intVal($row['int_amt_track']);
                    if ($last_bal_amt != 0) {
                        $bal_amt = $last_bal_amt - $PcollectionAmnt - $waiver;
                    } else {
                        $bal_amt = $loan_amt - $PcollectionAmnt - $waiver;
                    }
                } else {
                    $bal_amt = $loan_amt - $due_amt_track - $waiver;
                }
        ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>

                    <?php if ($loan_type == 'emi') { ?>
                        <td></td>
                    <?php } ?>
                    <?php if ($loan_type == 'interest') { ?>
                        <td></td>
                        <td></td>
                    <?php } ?>

                    <td><?php $pendingMinusCollection = (intVal($row['pending_amt']));
                        // if ($pendingMinusCollection != '') {
                        //     echo $pendingMinusCollection;
                        // } else {
                        //     echo 0;
                        // } 
                        ?></td>
                    <td><?php $payableMinusCollection = (intVal($row['payable_amt']));
                        // if ($payableMinusCollection != '') {
                        //     echo $payableMinusCollection;
                        // } else {
                        //     echo 0;
                        // } 
                        ?></td>
                    <td><?php echo date('d-m-Y', strtotime($row['trans_date'] != '0000-00-00' ? $row['trans_date'] : $row['coll_date'])); ?></td>

                    <!-- for collected amt -->
                    <?php if ($loan_type == 'emi') { ?>
                        <td>
                            <?php if ($row['due_amt_track'] > 0) {
                                echo $row['due_amt_track'];
                            } elseif ($row['pre_close_waiver'] > 0) {
                                echo $row['pre_close_waiver'];
                            } ?>
                        </td>
                    <?php } ?>

                    <?php if ($loan_type == 'interest') { ?>
                        <td>
                            <?php if ($PcollectionAmnt > 0) {
                                echo $PcollectionAmnt;
                            } elseif ($row['pre_close_waiver'] > 0) {
                                echo $row['pre_close_waiver'];
                            } ?>
                        </td>
                        <td>
                            <?php if ($IcollectionAmnt > 0) {
                                echo $IcollectionAmnt;
                            } ?>
                        </td>
                    <?php } ?>

                    <td><?php echo $bal_amt; ?></td>
                    <td><?php if ($row['pre_close_waiver'] > 0) {
                            echo $row['pre_close_waiver'];
                        } else {
                            echo '0';
                        } ?></td>
                    <td><?php if (isset($role) && $role == '1') {
                            echo 'Director';
                        } else if (isset($role) && $role == '2') {
                            echo 'Agent';
                        } else if (isset($role) && $role == '3') {
                            echo 'Staff';
                        } ?>
                    </td>
                    <td><?php echo $row['fullname']; ?></td>
                    <td><?php if ($row['coll_location'] == '1') {
                            echo 'By Self';
                        } elseif ($row['coll_location'] == '2') {
                            echo 'On Spot';
                        } elseif ($row['coll_location'] == '3') {
                            echo 'Bank Transfer';
                        } ?></td>
                    <td> <a class='print_due_coll' id="" value="<?php echo $row['coll_code']; ?>"> <i class="fa fa-print" aria-hidden="true"></i> </a> </td>
                </tr>

                <?php
                if ($loan_type == 'interest') {
                    $last_bal_amt = $bal_amt;
                } else {
                }
            }
        } else {
            if ($loan_type == 'interest') {
                $last_bal_amt = $loan_amt;
            }
        }

        //For showing collection after due start date
        $due_amt_track = 0;
        $waiver = 0;
        $jj = 0;
        $last_int_amt = $due_amt_1;
        if ($loan_type == 'interest') {
            $last_princ_amt = $last_bal_amt;
        }
        $lastCusdueMonth = '1970-00-00';
        foreach ($dueMonth as $cusDueMonth) {
            if ($loanFrom['due_method_calc'] == 'Monthly' || $loanFrom['due_method_scheme'] == '1') {
                //Query for Monthly.
                $run = $connect->query("SELECT c.coll_code,c.due_amt,c.tot_amt,c.pending_amt,c.payable_amt,c.coll_date, c.trans_date,c.due_amt_track,c.princ_amt_track,c.int_amt_track,c.bal_amt,c.coll_charge_track,c.coll_location,c.pre_close_waiver,alc.due_start_from,alc.maturity_month,alc.due_method_calc,u.fullname,u.role FROM `collection` c LEFT JOIN acknowlegement_loan_calculation alc on c.req_id = alc.req_id LEFT JOIN user u on c.insert_login_id = u.user_id WHERE (c.`req_id`= $req_id) and (c.due_amt_track != '' or c.princ_amt_track!='' or c.int_amt_track!='' or c.pre_close_waiver!='') && ((MONTH(coll_date)= MONTH('$cusDueMonth') || MONTH(trans_date)= MONTH('$cusDueMonth')) && (YEAR(coll_date)= YEAR('$cusDueMonth') || YEAR(trans_date)= YEAR('$cusDueMonth')) )");
            } elseif ($loanFrom['due_method_scheme'] == '2') {
                //Query For Weekly.
                $run = $connect->query("SELECT c.coll_code,c.due_amt,c.pending_amt,c.payable_amt,c.coll_date, c.trans_date,c.due_amt_track,c.bal_amt,c.coll_charge_track,c.coll_location,c.pre_close_waiver,alc.due_start_from,alc.maturity_month,alc.due_method_calc,u.fullname,u.role FROM `collection` c LEFT JOIN acknowlegement_loan_calculation alc on c.req_id = alc.req_id LEFT JOIN user u on c.insert_login_id = u.user_id WHERE (c.`req_id`= $req_id) and (c.due_amt_track != '' or c.pre_close_waiver!='') && ((WEEK(coll_date)= WEEK('$cusDueMonth') || WEEK(trans_date)= WEEK('$cusDueMonth')) && (YEAR(coll_date)= YEAR('$cusDueMonth') || YEAR(trans_date)= YEAR('$cusDueMonth')) )");
            } elseif ($loanFrom['due_method_scheme'] == '3') {
                //Query For Day.
                $run = $connect->query("SELECT c.coll_code,c.due_amt,c.pending_amt,c.payable_amt,c.coll_date, c.trans_date,c.due_amt_track,c.bal_amt,c.coll_charge_track,c.coll_location,c.pre_close_waiver,alc.due_start_from,alc.maturity_month,alc.due_method_calc,u.fullname,u.role FROM `collection` c LEFT JOIN acknowlegement_loan_calculation alc on c.req_id = alc.req_id LEFT JOIN user u on c.insert_login_id = u.user_id WHERE (c.`req_id`= $req_id) and (c.due_amt_track != '' or c.pre_close_waiver!='') && 
                ( 
                    ( DAY(coll_date)= DAY('$cusDueMonth') || DAY(trans_date)= DAY('$cusDueMonth') ) && 
                    ( MONTH(coll_date)= MONTH('$cusDueMonth') || MONTH(trans_date)= MONTH('$cusDueMonth') ) && 
                    ( YEAR(coll_date)= YEAR('$cusDueMonth') || YEAR(trans_date)= YEAR('$cusDueMonth') )
                )
                ");
            }

            if ($run->rowCount() > 0) {

                while ($row = $run->fetch()) { //if($jj == 0){$lastCusdueMonth = '00';$jj++;}else{$lastCusdueMonth =date('m',strtotime($lastCusdueMonth));}echo $lastCusdueMonth.',';
                    $role = $row['role'];
                    $due_amt_track = intVal($row['due_amt_track']);
                    if ($loanFrom['due_method_calc'] == 'Monthly' || $loanFrom['due_method_scheme'] == '1') {
                        $princ_amt_track = intVal($row['princ_amt_track']);
                        $int_amt_track = intVal($row['int_amt_track']);
                    }
                    // $waiver = $waiver + intVal($row['pre_close_waiver']);
                    $waiver = intVal($row['pre_close_waiver']);
                    if ($loan_type == 'emi') {
                        $bal_amt = intVal($row['bal_amt']) - $due_amt_track - $waiver;
                    } else {
                        $bal_amt = intVal($last_princ_amt) - $princ_amt_track - $waiver;
                    }

                ?>
                    <tr>
                        <?php
                        if ($loanFrom['due_method_calc'] == 'Monthly' || $loanFrom['due_method_scheme'] == '1') { //this is for monthly loan to check lastcusduemonth comparision
                            if (date('Y-m', strtotime($lastCusdueMonth)) != date('Y-m', strtotime($row['coll_date']))) {
                                // this condition is to check whether the same month has collection again. if yes the no need to show month name and due amount and serial number
                        ?>
                                <td><?php echo $i;
                                    $i++; ?></td>
                                <td><?php
                                    if ($loanFrom['due_method_calc'] == 'Monthly' || $loanFrom['due_method_scheme'] == '1') {
                                        //For Monthly.
                                        echo date('m-Y', strtotime($cusDueMonth));
                                    } else {
                                        //For Weekly && Day.
                                        echo date('d-m-Y', strtotime($cusDueMonth));
                                    }
                                    ?></td>
                                <td>
                                    <?php
                                    echo date('M', strtotime($cusDueMonth));
                                    ?>
                                </td>

                                <?php if ($loan_type == 'emi') { ?>
                                    <td><?php echo $row['due_amt']; ?></td>
                                <?php } ?>
                                <?php if ($loan_type == 'interest') { ?>
                                    <td><?php echo $last_princ_amt; ?></td>
                                    <td><?php echo $row['due_amt'];
                                        $last_int_amt = $row['due_amt']; ?></td>
                                <?php } ?>


                            <?php } else { ?>
                                <td></td>
                                <td></td>
                                <?php if ($loan_type == 'interest') { ?>
                                    <td></td>
                                <?php } ?>
                                <td></td>
                                <td></td>
                            <?php }
                        } else { //this is for weekly and daily loan to check lastcusduemonth comparision
                            if (date('Y-m-d', strtotime($lastCusdueMonth)) != date('Y-m-d', strtotime($row['coll_date']))) {
                                // this condition is to check whether the same month has collection again. if yes the no need to show month name and due amount and serial number
                            ?>
                                <td><?php echo $i;
                                    $i++; ?></td>
                                <td><?php
                                    if ($loanFrom['due_method_calc'] == 'Monthly' || $loanFrom['due_method_scheme'] == '1') {
                                        //For Monthly.
                                        echo date('m-Y', strtotime($cusDueMonth));
                                    } else {
                                        //For Weekly && Day.
                                        echo date('d-m-Y', strtotime($cusDueMonth));
                                    }
                                    ?></td>
                                <td>
                                    <?php
                                    echo date('M', strtotime($cusDueMonth));
                                    ?>
                                </td>

                                <?php if ($loan_type == 'emi') { ?>
                                    <td><?php echo $row['due_amt']; ?></td>
                                <?php } ?>
                                <?php if ($loan_type == 'interest') { ?>
                                    <td><?php echo $last_princ_amt; ?></td>
                                    <td><?php echo $row['due_amt'];
                                        $last_int_amt = $row['due_amt']; ?></td>
                                <?php } ?>


                            <?php } else { ?>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                        <?php }
                        } ?>

                        <td><?php $pendingMinusCollection = (intVal($row['pending_amt']));
                            if ($pendingMinusCollection != '') {
                                echo $pendingMinusCollection;
                            } else {
                                echo 0;
                            } ?></td>
                        <td><?php $payableMinusCollection = (intVal($row['payable_amt']));
                            if ($payableMinusCollection != '') {
                                echo $payableMinusCollection;
                            } else {
                                echo 0;
                            } ?></td>
                        <td><?php echo date('d-m-Y', strtotime($row['trans_date'] != '0000-00-00' ? $row['trans_date'] : $row['coll_date'])); ?></td>

                        <!-- for collected amt -->
                        <?php if ($loan_type == 'emi') { ?>
                            <td>
                                <?php if ($row['due_amt_track'] > 0) {
                                    echo $row['due_amt_track'];
                                } elseif ($row['pre_close_waiver'] > 0) {
                                    echo $row['pre_close_waiver'];
                                } ?>
                            </td>
                        <?php } ?>

                        <?php if ($loan_type == 'interest') { ?>
                            <td>
                                <?php if ($princ_amt_track > 0) {
                                    echo $princ_amt_track;
                                } elseif ($row['pre_close_waiver'] > 0) {
                                    echo $row['pre_close_waiver'];
                                } ?>
                            </td>
                            <td>
                                <?php if ($int_amt_track > 0) {
                                    echo $int_amt_track;
                                } ?>
                            </td>
                        <?php } ?>


                        <td><?php echo $bal_amt;
                            if ($loan_type == 'interest') {
                                $last_princ_amt = $bal_amt;
                            } ?></td>
                        <td><?php if ($row['pre_close_waiver'] > 0) {
                                echo $row['pre_close_waiver'];
                            } else {
                                echo '0';
                            } ?></td>
                        <td><?php if (isset($role) && $role == '1') {
                                echo 'Director';
                            } else if (isset($role) && $role == '2') {
                                echo 'Agent';
                            } else if (isset($role) && $role == '3') {
                                echo 'Staff';
                            } ?>
                        </td>
                        <td><?php echo $row['fullname']; ?></td>
                        <td><?php if ($row['coll_location'] == '1') {
                                echo 'By Self';
                            } elseif ($row['coll_location'] == '2') {
                                echo 'On Spot';
                            } elseif ($row['coll_location'] == '3') {
                                echo 'Bank Transfer';
                            } ?></td>
                        <td> <a class='print_due_coll' id="" value="<?php echo $row['coll_code']; ?>"> <i class="fa fa-print" aria-hidden="true"></i> </a> </td>
                    </tr>

                <?php $lastCusdueMonth = date('d-m-Y', strtotime($cusDueMonth)); //assign this cusDueMonth to check if coll date is already showed before
                }
            } else {
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php
                        if ($loanFrom['due_method_calc'] == 'Monthly' || $loanFrom['due_method_scheme'] == '1') {
                            //For Monthly.
                            // if($i == '1' and $loan_type == 'interest'){
                            //     echo date('m-Y', strtotime($cusDueMonth));
                            // }elseif($loan_type == 'interest'){
                            //     echo date('m-Y', strtotime($cusDueMonth.'-1 month'));
                            // }else{
                            echo date('m-Y', strtotime($cusDueMonth));
                            // }
                        } else {
                            //For Weekly && Day.
                            echo date('d-m-Y', strtotime($cusDueMonth));
                        } ?></td>
                    <td>
                        <?php
                        // if($i == '1' and $loan_type == 'interest'){
                        //     echo date('M', strtotime($cusDueMonth)); 
                        // }elseif($loan_type == 'interest'){
                        //     echo date('M', strtotime($cusDueMonth.'-1 month')); 
                        // }else{
                        echo date('M', strtotime($cusDueMonth));
                        // }
                        ?>
                    </td>

                    <?php if ($loan_type == 'emi') { ?>
                        <td><?php echo $due_amt_1; ?></td>
                    <?php } ?>
                    <?php if ($loan_type == 'interest') { ?>
                        <td><?php echo $last_princ_amt; ?></td>
                        <td><?php echo $last_int_amt; ?></td>
                    <?php } ?>

                    <?php
                    if ($loanFrom['due_method_calc'] == 'Monthly' || $loanFrom['due_method_scheme'] == '1') {
                        if (date('Y-m', strtotime($cusDueMonth)) <=  date('Y-m')) { ?>
                            <td>
                                <?php
                                $LDObj = new GetLoanDetails($con, $req_id, $cusDueMonth,'Due Chart');
                                echo $LDObj->response['pending']; ?>
                            </td>
                            <td>
                                <?php
                                $LDObj = new GetLoanDetails($con, $req_id, $cusDueMonth,'Due Chart');
                                echo $LDObj->response['payable']; ?>
                            </td>
                        <?php } else if (date('Y-m', strtotime($cusDueMonth)) >  date('Y-m') && $curDateChecker == true) { ?>
                            <td>
                                <?php //$response = getNextLoanDetails($con, $req_id, $cusDueMonth);
                                //echo $response['pending']; 
                                ?>
                            </td>
                            <td>
                                <?php //$response = getNextLoanDetails($con, $req_id, $cusDueMonth);
                                //echo $response['payable']; 
                                ?>
                            </td>
                        <?php
                            $curDateChecker = false; //set to false because, pending and payable only need one month after current month
                        } else {
                        ?>
                            <td></td>
                            <td></td>
                        <?php
                        }
                    } else {
                        if (date('Y-m-d', strtotime($cusDueMonth)) <=  date('Y-m-d')) { ?>
                            <td>
                                <?php $LDObj = new GetLoanDetails($con, $req_id, $cusDueMonth,'Due Chart');
                                echo $LDObj->response['pending']; ?>
                            </td>
                            <td>
                                <?php $LDObj = new GetLoanDetails($con, $req_id, $cusDueMonth,'Due Chart');
                                echo $LDObj->response['payable']; ?>
                            </td>
                        <?php } else if (date('Y-m-d', strtotime($cusDueMonth)) >  date('Y-m-d') && $curDateChecker == true) { ?>
                            <td>
                                <?php //$response = getNextLoanDetails($con, $req_id, $cusDueMonth);
                                // echo $response['pending']; 
                                ?>
                            </td>
                            <td>
                                <?php //$response = getNextLoanDetails($con, $req_id, $cusDueMonth);
                                // echo $response['payable']; 
                                ?>
                            </td>
                        <?php
                            $curDateChecker = false; //set to false because, pending and payable only need one month after current month
                        } else {
                        ?>
                            <td></td>
                            <td></td>
                    <?php
                        }
                    }
                    ?>

                    <td></td>
                    <!-- for collected amt -->
                    <?php if ($loan_type == 'emi') { ?>
                        <td> </td>
                    <?php } ?>
                    <?php if ($loan_type == 'interest') { ?>
                        <td> </td>
                        <td> </td>
                    <?php } ?>

                    <td> <?php echo $bal_amt; ?></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>

            <?php
                $i++;
            }
        }

        $currentMonth = date('Y-m-d');
        if ($loanFrom['due_method_calc'] == 'Monthly' || $loanFrom['due_method_scheme'] == '1') {
            $maturity_month = $maturity_month_obj->modify('+1 month')->format('Y-m-01');
            //Query for Monthly.
            $run = $connect->query("SELECT c.coll_code, c.due_amt, c.pending_amt, c.payable_amt, c.coll_date, c.trans_date, c.due_amt_track, c.princ_amt_track,c.int_amt_track, c.bal_amt, c.coll_charge_track, c.coll_location, c.pre_close_waiver, alc.due_start_from, alc.maturity_month, alc.due_method_calc, u.fullname, u.role
            FROM `collection` c
            LEFT JOIN acknowlegement_loan_calculation alc ON c.req_id = alc.req_id
            LEFT JOIN user u ON c.insert_login_id = u.user_id
            WHERE c.`req_id` = '$req_id' AND (c.due_amt_track != '' or c.pre_close_waiver!='')
            AND 
            (
                (c.coll_date BETWEEN '$maturity_month' AND '$currentMonth') OR (c.trans_date BETWEEN '$maturity_month' AND '$currentMonth' AND c.trans_date != '0000-00-00')
            )");
        } else
        if ($loanFrom['due_method_scheme'] == '2') {
            $maturity_month = $maturity_month_obj->modify('+1 week')->format('Y-m-d');
            //Query For Weekly.
            $run = $connect->query("SELECT c.coll_code, c.due_amt, c.pending_amt, c.payable_amt, c.coll_date, c.trans_date, c.due_amt_track, c.bal_amt, c.coll_charge_track, c.coll_location, c.pre_close_waiver, alc.maturity_month, alc.due_method_calc, u.fullname, u.role
            FROM `collection` c
            LEFT JOIN acknowlegement_loan_calculation alc ON c.req_id = alc.req_id
            LEFT JOIN user u ON c.insert_login_id = u.user_id
            WHERE c.`req_id` = '$req_id' 
            AND (c.due_amt_track != '' OR c.pre_close_waiver != '')
            AND (
                    (c.coll_date BETWEEN '$maturity_month' AND '$currentMonth')
                    OR (c.trans_date BETWEEN '$maturity_month' AND '$currentMonth' AND c.trans_date != '0000-00-00')
                );
            ");
        } else
        if ($loanFrom['due_method_scheme'] == '3') {
            $maturity_month = $maturity_month_obj->modify('+1 day')->format('Y-m-d');
            //Query For Day.
            $run = $connect->query("SELECT c.coll_code, c.due_amt, c.pending_amt, c.payable_amt, c.coll_date, c.trans_date, c.due_amt_track, c.bal_amt, c.coll_charge_track, c.coll_location, c.pre_close_waiver, alc.maturity_month, alc.maturity_month, alc.due_method_calc, u.fullname, u.role
            FROM `collection` c
            LEFT JOIN acknowlegement_loan_calculation alc ON c.req_id = alc.req_id
            LEFT JOIN user u ON c.insert_login_id = u.user_id
            WHERE c.`req_id` = '$req_id' AND (c.due_amt_track != '' or c.pre_close_waiver!='')
            AND (
                (c.coll_date BETWEEN '$maturity_month' AND '$currentMonth') OR
                (c.trans_date BETWEEN '$maturity_month' AND '$currentMonth')
            ) ");
        }

        if ($run->rowCount() > 0) {
            $due_amt_track = 0;
            $waiver = 0;
            while ($row = $run->fetch()) {
                $role = $row['role'];
                $collectionAmnt = intVal($row['due_amt_track']);
                $due_amt_track = intVal($row['due_amt_track']);
                $waiver = intVal($row['pre_close_waiver']);
                $bal_amt = $bal_amt - $due_amt_track - $waiver;
            ?>
                <tr>
                    <!-- <td> <?php echo $i; ?></td>
                    <td><?php
                        if ($loanFrom['due_method_calc'] == 'Monthly' || $loanFrom['due_method_scheme'] == '1') {
                            //For Monthly.
                            echo date('m-Y', strtotime($issue_date));
                        } else {
                            //For Weekly && Day.
                            echo date('d-m-Y', strtotime($row['trans_date'] != '0000-00-00' ? $row['trans_date'] : $row['coll_date']));
                        }
                        ?></td>
                    <td><?php echo date('M', strtotime($issue_date)); ?></td>
                    <td><?php echo $row['due_amt']; ?></td> -->
                    <td></td>
                    <td></td>
                    <td></td>

                    <?php if ($loan_type == 'emi') { ?>
                        <td></td>
                    <?php } ?>
                    <?php if ($loan_type == 'interest') { ?>
                        <td></td>
                        <td></td>
                    <?php } ?>

                    <td><?php $pendingMinusCollection = (intVal($row['pending_amt']));
                        if ($pendingMinusCollection != '') {
                            echo $pendingMinusCollection;
                        } else {
                            echo 0;
                        } ?></td>
                    <td><?php $payableMinusCollection = (intVal($row['payable_amt']));
                        if ($payableMinusCollection != '') {
                            echo $payableMinusCollection;
                        } //else{echo 0;} 
                        ?></td>
                    <td><?php echo date('d-m-Y', strtotime($row['coll_date'])); ?></td>

                    <?php if ($loan_type == 'emi') { ?>
                        <td>
                            <?php if ($row['due_amt_track'] > 0) {
                                echo $row['due_amt_track'];
                            } elseif ($row['pre_close_waiver'] > 0) {
                                echo $row['pre_close_waiver'];
                            } ?>
                        </td>
                    <?php } ?>

                    <?php if ($loan_type == 'interest') { ?>
                        <td>
                            <?php if ($PcollectionAmnt > 0) {
                                echo $PcollectionAmnt;
                            } elseif ($row['pre_close_waiver'] > 0) {
                                echo $row['pre_close_waiver'];
                            } ?>
                        </td>
                        <td>
                            <?php if ($IcollectionAmnt > 0) {
                                echo $IcollectionAmnt;
                            } ?>
                        </td>
                    <?php } ?>

                    <td><?php echo $bal_amt; ?></td>
                    <td><?php if ($row['pre_close_waiver'] > 0) {
                            echo $row['pre_close_waiver'];
                        } else {
                            echo '0';
                        } ?></td>
                    <td><?php if (isset($role) && $role == '1') {
                            echo 'Director';
                        } else if (isset($role) && $role == '2') {
                            echo 'Agent';
                        } else if (isset($role) && $role == '3') {
                            echo 'Staff';
                        } ?>
                    </td>
                    <td><?php echo $row['fullname']; ?></td>
                    <td><?php if ($row['coll_location'] == '1') {
                            echo 'By Self';
                        } elseif ($row['coll_location'] == '2') {
                            echo 'On Spot';
                        } elseif ($row['coll_location'] == '3') {
                            echo 'Bank Transfer';
                        } ?></td>
                    <td> <a class='print_due_coll' id="" value="<?php echo $row['coll_code']; ?>"> <i class="fa fa-print" aria-hidden="true"></i> </a> </td>
                </tr>

        <?php
                $i++;
            }
        }
        ?>

    </tbody>
</table>