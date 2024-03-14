<?php

class acknowledgmentClass
{
    public $user_id;
    function __construct($user_id)
    {
        $this->user_id = $user_id;
    }
    function getAcknowledgmentCounts($con)
    {
        $response = array();
        $today = date('Y-m-d');
        $sub_area_list = $_POST['sub_area_list'];

        $tot_in_ack = "SELECT COUNT(*) as tot_in_ack FROM request_creation where ( cus_status >= 3 and cus_status NOT IN(4, 5, 6, 8, 9, 10, 11, 12) ) ";
        $today_in_ack = "SELECT COUNT(*) as today_in_ack FROM request_creation where cus_status = 3 and date(updated_date) = '$today' ";
        $tot_issue = "SELECT COUNT(*) as tot_issue FROM request_creation req JOIN acknowlegement_customer_profile cp ON cp.req_id = req.req_id WHERE req.cus_status >= 14 ";
        $today_issue = "SELECT COUNT(*) as today_issue FROM request_creation req JOIN acknowlegement_customer_profile cp ON cp.req_id = req.req_id WHERE req.cus_status >= 14 and date(req.updated_date) = '$today' ";
        $tot_ack_bal = "SELECT COUNT(*) as tot_ack_bal FROM request_creation where (cus_status < 14 and cus_status >= 3 and cus_status NOT IN(4, 5, 6, 7, 8, 9, 10, 11, 12) ) ";
        $today_ack_bal = "SELECT COUNT(*) as today_ack_bal FROM request_creation where cus_status = 3 and date(updated_date) = '$today' ";
        $tot_cancel = "SELECT COUNT(*) as tot_cancel from request_creation where cus_status = 7 ";
        $today_cancel = "SELECT COUNT(*) as today_cancel from request_creation where cus_status = 7 and date(updated_date) = '$today' ";
        $tot_new = "SELECT COUNT(*) as tot_new from request_creation where (cus_status < 14 and cus_status >= 3 and cus_status NOT IN(4, 5, 6, 7, 8, 9, 10, 11, 12) ) and cus_data = 'New' ";
        $today_new = "SELECT COUNT(*) as today_new from request_creation where cus_status = 3 and cus_data = 'New' and date(updated_date) = '$today' ";
        $tot_existing = "SELECT COUNT(*) as tot_existing from request_creation where (cus_status < 14 and cus_status >= 3 and cus_status NOT IN(4, 5, 6, 7, 8, 9, 10, 11, 12) ) and cus_data = 'Existing' ";
        $today_existing = "SELECT COUNT(*) as today_existing from request_creation where cus_status = 3 and cus_data = 'Existing' and date(updated_date) = '$today' ";

        if (empty($sub_area_list)) {
            $sub_area_list = $this->getUserGroupBasedSubArea($con, $this->user_id);
        }

        $tot_in_ack .= " AND sub_area IN ($sub_area_list) ";
        $today_in_ack .= " AND sub_area IN ($sub_area_list) ";
        $tot_issue .= " AND ( CASE WHEN cp.area_confirm_subarea IS NOT NULL THEN cp.area_confirm_subarea IN ($sub_area_list) ELSE TRUE END )";
        $today_issue .= " AND ( CASE WHEN cp.area_confirm_subarea IS NOT NULL THEN cp.area_confirm_subarea IN ($sub_area_list) ELSE TRUE END )";
        $tot_ack_bal .= " AND sub_area IN ($sub_area_list) ";
        $today_ack_bal .= " AND sub_area IN ($sub_area_list) ";
        $tot_cancel .= " AND sub_area IN ($sub_area_list) ";
        $today_cancel .= " AND sub_area IN ($sub_area_list) ";
        $tot_new .= " AND sub_area IN ($sub_area_list) ";
        $today_new .= " AND sub_area IN ($sub_area_list) ";
        $tot_existing .= " AND sub_area IN ($sub_area_list) ";
        $today_existing .= " AND sub_area IN ($sub_area_list) ";


        $tot_in_ackQry = $con->query($tot_in_ack);
        $today_in_ackQry = $con->query($today_in_ack);
        $tot_issueQry = $con->query($tot_issue);
        $today_issueQry = $con->query($today_issue);
        $tot_ack_balQry = $con->query($tot_ack_bal);
        $today_ack_balQry = $con->query($today_ack_bal);
        $tot_cancelQry = $con->query($tot_cancel);
        $today_cancelQry = $con->query($today_cancel);
        $tot_newQry = $con->query($tot_new);
        $today_newQry = $con->query($today_new);
        $tot_existingQry = $con->query($tot_existing);
        $today_existingQry = $con->query($today_existing);


        $response['tot_in_ack'] = $tot_in_ackQry->fetch_assoc()['tot_in_ack'];
        $response['today_in_ack'] = $today_in_ackQry->fetch_assoc()['today_in_ack'];
        $response['tot_issue'] = $tot_issueQry->fetch_assoc()['tot_issue'];
        $response['today_issue'] = $today_issueQry->fetch_assoc()['today_issue'];
        $response['tot_ack_bal'] = $tot_ack_balQry->fetch_assoc()['tot_ack_bal'];
        $response['today_ack_bal'] = $today_ack_balQry->fetch_assoc()['today_ack_bal'];
        $response['tot_cancel'] = $tot_cancelQry->fetch_assoc()['tot_cancel'];
        $response['today_cancel'] = $today_cancelQry->fetch_assoc()['today_cancel'];
        $response['tot_revoke'] = 0;
        $response['today_revoke'] = 0;
        $response['tot_new'] = $tot_newQry->fetch_assoc()['tot_new'];
        $response['today_new'] = $today_newQry->fetch_assoc()['today_new'];
        $response['tot_existing'] = $tot_existingQry->fetch_assoc()['tot_existing'];
        $response['today_existing'] = $today_existingQry->fetch_assoc()['today_existing'];


        return $response;
    }

    function getUserGroupBasedSubArea($con, $user_id)
    {
        $sub_area_list = array();

        $userQry = $con->query("SELECT * FROM USER WHERE user_id = $user_id ");
        while ($rowuser = $userQry->fetch_assoc()) {
            $group_id = $rowuser['group_id'];
        }
        $group_id = explode(',', $group_id);
        foreach ($group_id as $group) {
            $groupQry = $con->query("SELECT * FROM area_group_mapping where map_id = $group ");
            $row_sub = $groupQry->fetch_assoc();
            $sub_area_list[] = $row_sub['sub_area_id'];
        }
        $sub_area_ids = array();
        foreach ($sub_area_list as $subarray) {
            $sub_area_ids = array_merge($sub_area_ids, explode(',', $subarray));
        }
        $sub_area_list = array();
        $sub_area_list = implode(',', $sub_area_ids);

        return $sub_area_list;
    }
}
