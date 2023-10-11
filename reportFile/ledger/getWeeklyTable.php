<?php
include '../../ajaxconfig.php';

$weekly_date = date('Y-m-d',strtotime($_POST['weekly_date']));

//below query will get all the data of the customer who has taken daily scheme loans
//in that query, we will also have the opening balance for this current month based on last paid date
//collection table takes lasst paid row and subract balance amt with paid amt to get the exact paid amt
$qry = $con->query("
    SELECT 
        cp.req_id,
        cp.cus_name,
        cp.area_confirm_area as area_id,
        cp.area_confirm_subarea as sub_area_id,
        ii.updated_date as loan_date,
        lc.due_start_from as start_date,
        lc.maturity_month as maturity_date,
        lc.loan_category as loan_cat_id,
        lc.sub_category,
        lc.due_amt_cal as due_amt,
        lc.tot_amt_cal,
        lc.principal_amt_cal,
        al.area_name,
        sal.sub_area_name,
        lcc.loan_category_creation_name,
        (SELECT sum(due_amt_track) as due_amt_track FROM collection where req_id = cp.req_id) as total_paid,
        (SELECT bal_amt - due_amt_track as bal_amt FROM collection where req_id = cp.req_id and ( date(coll_date) <= date('$weekly_date') 
        and year(date(coll_date)) <= year('$weekly_date') ) ORDER BY date(coll_date) = date('$weekly_date') DESC,coll_id DESC LIMIT 1 ) as opening_balance
    FROM 
        acknowlegement_customer_profile cp 
        JOIN acknowlegement_loan_calculation lc ON cp.req_id = lc.req_id 
        JOIN loan_issue li ON cp.req_id = li.req_id
        JOIN in_issue ii ON cp.req_id = ii.req_id  
        JOIN area_list_creation al ON cp.area_confirm_area = al.area_id
        JOIN sub_area_list_creation sal ON cp.area_confirm_subarea = sal.sub_area_id
        JOIN loan_category_creation lcc ON lc.loan_category = lcc.loan_category_creation_id
    WHERE 
        (ii.cus_status >= 14 && ii.cus_status < 20) AND lc.due_method_scheme = 2 and date(lc.due_start_from) = '$weekly_date' ");

    $rows = array();
    while($row = $qry->fetch_assoc()){
        $rows[] = $row;
    }
    
?>

<?php
// Function to loop through weeks
function generateWeeks($start, $end) {
    $weeks = [];
    $currentDate = clone $start;
    
    while ($currentDate <= $end) {
        $weeks[] = $currentDate->format('Y-m-d');
        $currentDate->modify('+1 week');
    }

    return $weeks;
}

// Input date
$inputDate = date('Y-m-d',strtotime($_POST['weekly_date']));

// Create DateTime object from input date
$startDate = new DateTime($inputDate);

// Calculate end date (3rd month's week)
$endDate = clone $startDate;
$endDate->modify('+2 months');
$endDate->modify('+6 weeks');//modify here for getting how many weeks to select

// Generate weeks between start and end dates
$weeks = generateWeeks($startDate, $endDate);

// Output weeks
// print_r($weeks);
?>



<table class="table custom-table" id="weekly_table">
    <thead>
        <th>S.No</th>
        <th>Customer Name</th>
        <th>Area</th>
        <th>Sub Area</th>
        <th>Loan Date</th>
        <th>Start Date</th>
        <th>Maturity Date</th>
        <th>Loan Category</th>
        <th>Sub Category</th>
        <th>Due Amount</th>
        <th>Opening Balance</th>
        <?php
            for( $i = 0; $i < count($weeks); $i++ ) {
                ?>
                <th><?php echo $i+1;?></th>
                <?php
            }
        ?>
        <th>Total Paid</th>
        <th>Closing Balance</th>
    </thead>
    <tbody>
        <?php 
            $i = 1;
            
            if($qry->num_rows > 0){
                foreach($rows as $row) {
                    $total_paid = 0;
            ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $row['cus_name']; ?></td>
                        <td><?php echo $row['area_name']; ?></td>
                        <td><?php echo $row['sub_area_name']; ?></td>
                        <td><?php echo date('d-m-Y', strtotime($row['loan_date'])); ?></td>
                        <td><?php echo date('d-m-Y', strtotime($row['start_date'])); ?></td>
                        <td><?php echo date('d-m-Y', strtotime($row['maturity_date'])); ?></td>
                        <td><?php echo $row['loan_category_creation_name']; ?></td>
                        <td><?php echo $row['sub_category']; ?></td>
                        <td><?php echo moneyFormatIndia($row['due_amt']); ?></td>
                        <td>
                            <?php 
                                if($row['opening_balance'] != ''){
                                    echo moneyFormatIndia($row['opening_balance']); 
                                }else{
                                    $row['opening_balance'] = $row['tot_amt_cal']!=''?$row['tot_amt_cal']:$row['principal_amt_cal'];
                                    echo moneyFormatIndia($row['opening_balance']); 
                                }
                            ?>
                        </td>
                        <?php
                            for( $j = 0; $j < count($weeks); $j++ ) {
                                ?>
                                <td>
                                    <?php 
                                        $dates = getMondayAndSunday($weeks[$j]);
                                        //this query will get the all paid amt from collection table between the week dated given
                                        $coll_qry = $con->query("SELECT sum(due_amt_track) as due_amt_track FROM collection where req_id = '".$row['req_id']."' and date(coll_date) >= '".$dates['monday']."' and date(coll_date) <= '".$dates['sunday']."' ");
                                        $coll_row = $coll_qry->fetch_assoc();
                                        echo moneyFormatIndia($coll_row['due_amt_track']??0);
                                        $total_paid += $coll_row['due_amt_track'];
                                    ?>
                                </td>
                                <?php
                            }
                        ?>
                        <td><?php echo moneyFormatIndia($total_paid); ?></td>
                        <td><?php echo moneyFormatIndia($row['opening_balance'] - $total_paid); ?></td>
                    </tr>
                    
            <?php
                }
            }
        ?>
    </tbody>
</table>

<script type='text/javascript'>
    $(function() {
        $('#weekly_table').DataTable({
            "title":"Daily Ledger",
            'processing': true,
            'iDisplayLength': 5,
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
        });
    });
</script>

<?php
function moneyFormatIndia($num){
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

<?php
// Function to get previous Monday and following Sunday based on input date
function getMondayAndSunday($inputDate) {
    $inputDateTime = new DateTime($inputDate);
    $inputDayOfWeek = $inputDateTime->format('N'); // Get day of the week (1 = Monday, 7 = Sunday)
    
    // Calculate previous Monday and following Sunday
    $startDate = clone $inputDateTime;
    $endDate = clone $inputDateTime;

    if ($inputDayOfWeek != 1) {
        // If input date is not Monday, get previous Monday
        $startDate->modify('last monday');
    }

    // Get following Sunday
    $endDate->modify('next sunday');

    // Format dates as strings
    $monday = $startDate->format('Y-m-d');
    $sunday = $endDate->format('Y-m-d');

    return array('monday' => $monday, 'sunday' => $sunday);
}


?>
