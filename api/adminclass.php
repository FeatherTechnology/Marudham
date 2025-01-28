<?php
require 'PHPMailerAutoload.php';
require 'moneyFormatIndia.php';
include("iedit-config.php");
class admin
{

	public function getuser($mysqli, $idupd)
	{
		$qry = "SELECT * FROM user WHERE user_id='" . mysqli_real_escape_string($mysqli, $idupd) . "'";
		$res = $mysqli->query($qry) or die("Error in Get All Records" . $mysqli->error);
		$detailrecords = array();
		if ($mysqli->affected_rows > 0) {
			$row = $res->fetch_object();
			$detailrecords['user_id']                    = $row->user_id;
			$detailrecords['fullname']                     = strip_tags($row->fullname);
			$detailrecords['user_name']                 = strip_tags($row->user_name);
			$detailrecords['user_password']              = strip_tags($row->user_password);
			$detailrecords['role']              = strip_tags($row->role);
			$detailrecords['role_type']              = strip_tags($row->role_type);
			$detailrecords['dir_id']              = strip_tags($row->dir_id);
			$detailrecords['ag_id']              = strip_tags($row->ag_id);
			$detailrecords['staff_id']              = strip_tags($row->staff_id);
			$detailrecords['company_id']              = strip_tags($row->company_id);
			$detailrecords['branch_id']              = strip_tags($row->branch_id);
			$detailrecords['loan_cat']              = strip_tags($row->loan_cat);
			$detailrecords['agentforstaff']              = strip_tags($row->agentforstaff);
			$detailrecords['line_id']              = strip_tags($row->line_id);
			$detailrecords['group_id']              = strip_tags($row->group_id);
			$detailrecords['download_access']              = strip_tags($row->download_access);
			$detailrecords['mastermodule']              = strip_tags($row->mastermodule);
			$detailrecords['company_creation']              = strip_tags($row->company_creation);
			$detailrecords['branch_creation']              = strip_tags($row->branch_creation);
			$detailrecords['loan_category']              = strip_tags($row->loan_category);
			$detailrecords['loan_calculation']              = strip_tags($row->loan_calculation);
			$detailrecords['loan_scheme']              = strip_tags($row->loan_scheme);
			$detailrecords['area_creation']              = strip_tags($row->area_creation);
			$detailrecords['area_mapping']              = strip_tags($row->area_mapping);
			$detailrecords['area_approval']              = strip_tags($row->area_approval);
			$detailrecords['adminmodule']              = strip_tags($row->adminmodule);
			$detailrecords['director_creation']              = strip_tags($row->director_creation);
			$detailrecords['agent_creation']              = strip_tags($row->agent_creation);
			$detailrecords['staff_creation']              = strip_tags($row->staff_creation);
			$detailrecords['manage_user']              = strip_tags($row->manage_user);
			$detailrecords['doc_mapping']              = strip_tags($row->doc_mapping);
			$detailrecords['bank_creation']              = strip_tags($row->bank_creation);
			$detailrecords['requestmodule']              = strip_tags($row->requestmodule);
			$detailrecords['request']              = strip_tags($row->request);
			$detailrecords['request_list_access']              = strip_tags($row->request_list_access);
			$detailrecords['verificationmodule']              = strip_tags($row->verificationmodule);
			$detailrecords['verification']              = strip_tags($row->verification);
			$detailrecords['approvalmodule']              = strip_tags($row->approvalmodule);
			$detailrecords['approval']              = strip_tags($row->approval);
			$detailrecords['acknowledgementmodule']              = strip_tags($row->acknowledgementmodule);
			$detailrecords['acknowledgement']              = strip_tags($row->acknowledgement);
			$detailrecords['loanissuemodule']              = strip_tags($row->loanissuemodule);
			$detailrecords['loan_issue']              = strip_tags($row->loan_issue);
			$detailrecords['collectionmodule']              = strip_tags($row->collectionmodule);
			$detailrecords['collection']              = strip_tags($row->collection);
			$detailrecords['collection_access']              = strip_tags($row->collection_access);
			$detailrecords['closedmodule']              = strip_tags($row->closedmodule);
			$detailrecords['closed']              = strip_tags($row->closed);
			$detailrecords['nocmodule']              = strip_tags($row->nocmodule);
			$detailrecords['noc']              = strip_tags($row->noc);
			$detailrecords['doctrackmodule']              = strip_tags($row->doctrackmodule);
			$detailrecords['doctrack']              = strip_tags($row->doctrack);
			$detailrecords['doc_rec_access']              = strip_tags($row->doc_rec_access);
			$detailrecords['updatemodule']              = strip_tags($row->updatemodule);
			$detailrecords['update_screen']              = strip_tags($row->update_screen);
			$detailrecords['concernmodule']              = strip_tags($row->concernmodule);
			$detailrecords['concern_creation']              = strip_tags($row->concern_creation);
			$detailrecords['concern_solution']              = strip_tags($row->concern_solution);
			$detailrecords['concern_feedback']              = strip_tags($row->concern_feedback);
			$detailrecords['accountsmodule']              = strip_tags($row->accountsmodule);
			$detailrecords['cash_tally']              = strip_tags($row->cash_tally);
			$detailrecords['cash_tally_admin']              = strip_tags($row->cash_tally_admin);
			$detailrecords['bank_details']              = strip_tags($row->bank_details);
			$detailrecords['bank_clearance']              = strip_tags($row->bank_clearance);
			$detailrecords['finance_insight']              = strip_tags($row->finance_insight);
			$detailrecords['followupmodule']              = strip_tags($row->followupmodule);
			$detailrecords['promotion_activity']              = strip_tags($row->promotion_activity);
			$detailrecords['loan_followup']              = strip_tags($row->loan_followup);
			$detailrecords['confirmation_followup']              = strip_tags($row->confirmation_followup);
			$detailrecords['due_followup']              = strip_tags($row->due_followup);

			$detailrecords['reportmodule'] = strip_tags($row->reportmodule);
			$detailrecords['ledger_report'] = strip_tags($row->ledger_report);
			$detailrecords['request_report'] = strip_tags($row->request_report);
			$detailrecords['cus_profile_report'] = strip_tags($row->cus_profile_report);
			$detailrecords['loan_issue_report'] = strip_tags($row->loan_issue_report);
			$detailrecords['collection_report'] = strip_tags($row->collection_report);
			$detailrecords['balance_report'] = strip_tags($row->balance_report);
			$detailrecords['due_list_report'] = strip_tags($row->due_list_report);
			$detailrecords['closed_report'] = strip_tags($row->closed_report);
			$detailrecords['agent_report'] = strip_tags($row->agent_report);

			$detailrecords['search_module'] = strip_tags($row->search_module);
			$detailrecords['search'] = strip_tags($row->search);
			$detailrecords['bulk_upload_module'] = strip_tags($row->bulk_upload_module);
			$detailrecords['bulk_upload'] = strip_tags($row->bulk_upload);
			$detailrecords['loan_track_module'] = strip_tags($row->loan_track_module);
			$detailrecords['loan_track'] = strip_tags($row->loan_track);
			$detailrecords['sms_module'] = strip_tags($row->sms_module);
			$detailrecords['sms_generation'] = strip_tags($row->sms_generation);

			$detailrecords['status']                     = strip_tags($row->status);
		}
		return $detailrecords;
	}


	// Add Company
	public function addcompanycreation($mysqli, $userid)
	{

		if (isset($_POST['company_name'])) {
			$company_name = $_POST['company_name'];
		}
		if (isset($_POST['address1'])) {
			$address1 = $_POST['address1'];
		}
		$address2 = '';
		if (isset($_POST['address2'])) {
			$address2 = $_POST['address2'];
		}
		if (isset($_POST['state'])) {
			$state = $_POST['state'];
		}
		if (isset($_POST['district1'])) {
			$district = $_POST['district1'];
		}
		if (isset($_POST['taluk1'])) {
			$taluk = $_POST['taluk1'];
		}
		if (isset($_POST['place'])) {
			$place = $_POST['place'];
		}
		if (isset($_POST['pincode'])) {
			$pincode = $_POST['pincode'];
		}
		if (isset($_POST['website'])) {
			$website = $_POST['website'];
		}
		if (isset($_POST['mailid'])) {
			$mailid = $_POST['mailid'];
		}
		if (isset($_POST['mobile'])) {
			$mobile = $_POST['mobile'];
		}
		if (isset($_POST['whatsapp'])) {
			$whatsapp = $_POST['whatsapp'];
		}
		if (isset($_POST['landline'])) {
			$landline = $_POST['landline'];
		}

		$insertQry = "INSERT INTO company_creation(company_name, address1, address2, state, district, taluk, place, pincode, website, mailid, 
			mobile,whatsapp,landline,insert_user_id,created_date) 
			VALUES('" . strip_tags($company_name) . "','" . strip_tags($address1) . "', '" . strip_tags($address2) . "', '" . strip_tags($state) . "', '" . strip_tags($district) . "', 
			'" . strip_tags($taluk) . "', '" . strip_tags($place) . "', '" . strip_tags($pincode) . "', '" . strip_tags($website) . "', '" . strip_tags($mailid) . "', '" . strip_tags($mobile) . "',
			'" . strip_tags($whatsapp) . "','" . strip_tags($landline) . "','" . strip_tags($userid) . "',current_timestamp )";

		$insresult = $mysqli->query($insertQry) or die("Error " . $mysqli->error);
	}

	// Get Company
	public function getCompanyCreation($mysqli, $id)
	{

		$trusteeSelect = "SELECT * FROM company_creation WHERE company_id='" . mysqli_real_escape_string($mysqli, $id) . "' ";
		$res = $mysqli->query($trusteeSelect) or die("Error in Get All Records" . $mysqli->error);
		$detailrecords = array();
		if ($mysqli->affected_rows > 0) {
			$row = $res->fetch_object();
			$detailrecords['company_id']      = $row->company_id;
			$detailrecords['company_name']    = $row->company_name;
			$detailrecords['address1']    = $row->address1;
			$detailrecords['address2']    = $row->address2;
			$detailrecords['state']    = $row->state;
			$detailrecords['district']    = $row->district;
			$detailrecords['taluk']    = $row->taluk;
			$detailrecords['place']    = $row->place;
			$detailrecords['pincode']    = $row->pincode;
			$detailrecords['website']    = $row->website;
			$detailrecords['mailid']    = $row->mailid;
			$detailrecords['mobile']    = $row->mobile;
			$detailrecords['whatsapp']    = $row->whatsapp;
			$detailrecords['landline']    = $row->landline;
		}

		return $detailrecords;
	}

	// Update Company
	public function updatecompanycreation($mysqli, $id, $userid)
	{

		if (isset($_POST['company_name'])) {
			$company_name = $_POST['company_name'];
		}
		if (isset($_POST['address1'])) {
			$address1 = $_POST['address1'];
		}
		$address2 = '';
		if (isset($_POST['address2'])) {
			$address2 = $_POST['address2'];
		}
		if (isset($_POST['state'])) {
			$state = $_POST['state'];
		}
		if (isset($_POST['district1'])) {
			$district = $_POST['district1'];
		}
		if (isset($_POST['taluk1'])) {
			$taluk = $_POST['taluk1'];
		}
		if (isset($_POST['place'])) {
			$place = $_POST['place'];
		}
		if (isset($_POST['pincode'])) {
			$pincode = $_POST['pincode'];
		}
		if (isset($_POST['website'])) {
			$website = $_POST['website'];
		}
		if (isset($_POST['mailid'])) {
			$mailid = $_POST['mailid'];
		}
		if (isset($_POST['mobile'])) {
			$mobile = $_POST['mobile'];
		}
		if (isset($_POST['whatsapp'])) {
			$whatsapp = $_POST['whatsapp'];
		}
		if (isset($_POST['landline'])) {
			$landline = $_POST['landline'];
		}
		$updateQry = "UPDATE company_creation SET company_name = '" . strip_tags($company_name) . "', address1='" . strip_tags($address1) . "', 
			address2='" . strip_tags($address2) . "', state='" . strip_tags($state) . "', district='" . strip_tags($district) . "', taluk='" . strip_tags($taluk) . "', 
			place='" . strip_tags($place) . "', pincode='" . strip_tags($pincode) . "', website='" . strip_tags($website) . "', mailid='" . strip_tags($mailid) . "', mobile='" . strip_tags($mobile) . "',
			whatsapp='" . strip_tags($whatsapp) . "',landline='" . strip_tags($landline) . "',update_user_id='" . strip_tags($userid) . "',updated_date= current_timestamp(), status = '0' WHERE company_id= '" . strip_tags($id) . "' ";
		$updresult = $mysqli->query($updateQry) or die("Error in in update Query!." . $mysqli->error);
	}
	//  Delete Company
	public function deleteCompanyCreation($mysqli, $id, $userid)
	{
		$deleteQry = "UPDATE company_creation set status='1', update_user_id='" . strip_tags($userid) . "' WHERE company_id  = '" . strip_tags($id) . "' ";
		$runQry = $mysqli->query($deleteQry) or die("Error in delete query" . $mysqli->error);
	}

	// get loan category creation name
	public function getLoanCategoryCreation($mysqli)
	{

		$qry = "SELECT * FROM loan_category_creation WHERE 1 AND status=0 ORDER BY loan_category_creation_id DESC";
		$res = $mysqli->query($qry) or die("Error in Get All Records" . $mysqli->error);
		$detailrecords = array();
		$i = 0;
		if ($mysqli->affected_rows > 0) {
			while ($row = $res->fetch_object()) {
				$detailrecords[$i]['loan_category_creation_id']            = $row->loan_category_creation_id;
				$detailrecords[$i]['loan_category_creation_name']       	= strip_tags($row->loan_category_creation_name);
				$i++;
			}
		}
		return $detailrecords;
	}

	// Add Loan Category
	public function addLoanCategoryDetails($mysqli, $userid)
	{

		if (isset($_POST['loan_category_name'])) {
			$loan_category_name = $_POST['loan_category_name'];
		}
		if (isset($_POST['sub_category_name'])) {
			$sub_category_name = $_POST['sub_category_name'];
		}
		if (isset($_POST['loan_limit'])) {
			$loan_limit = $_POST['loan_limit'];
		}
		if (isset($_POST['loan_category_ref_name'])) {
			$loan_category_ref_name = $_POST['loan_category_ref_name'];
		}

		$insertQry = "INSERT INTO loan_category(loan_category_name, sub_category_name,loan_limit, insert_user_id) 
		VALUES('" . strip_tags($loan_category_name) . "','" . strip_tags($sub_category_name) . "','" . strip_tags($loan_limit) . "', '" . strip_tags($userid) . "' )";
		$insresult = $mysqli->query($insertQry) or die("Error " . $mysqli->error);
		$loan_category_id = $mysqli->insert_id;

		for ($i = 0; $i < sizeof($loan_category_ref_name); $i++) {
			$qry = $mysqli->query("INSERT INTO loan_category_ref(loan_category_ref_name, loan_category_id) 
			VALUES('" . strip_tags($loan_category_ref_name[$i]) . "', '" . strip_tags($loan_category_id) . "') ");
		}
	}

	// Get Trustee
	public function getLoanCategoryDetails($mysqli, $id)
	{

		$loanCatSelect = "SELECT * FROM loan_category WHERE loan_category_id='" . mysqli_real_escape_string($mysqli, $id) . "' ";
		$res = $mysqli->query($loanCatSelect) or die("Error in Get All Records" . $mysqli->error);
		$detailrecords = array();
		if ($mysqli->affected_rows > 0) {
			$row = $res->fetch_object();
			$loan_categoryId      = $row->loan_category_id;
			$detailrecords['loan_category_id']      = $row->loan_category_id;
			$detailrecords['loan_category_name']    = $row->loan_category_name;
			$detailrecords['sub_category_name']    = $row->sub_category_name;
			$detailrecords['loan_limit']    = $row->loan_limit;
		}

		$loan_categoryRefId = 0;
		$rrSelect = "SELECT * FROM loan_category_ref WHERE loan_category_id='" . mysqli_real_escape_string($mysqli, $loan_categoryId) . "' ";
		$res1 = $mysqli->query($rrSelect) or die("Error in Get All Records" . $mysqli->error);
		if ($mysqli->affected_rows > 0) {
			while ($row1 = $res1->fetch_object()) {

				$loan_categoryRefId         		= $row1->loan_category_ref_id;
				$loan_category_ref_id[]     			= $row1->loan_category_ref_id;
				$loan_category_ref_name[]             = $row1->loan_category_ref_name;
			}
		}
		if ($loan_categoryRefId > 0) {
			$detailrecords['loan_category_ref_id']        = $loan_category_ref_id;
			$detailrecords['loan_category_ref_name']      = $loan_category_ref_name;
		} else {
			$detailrecords['loan_category_ref_id']      = array();
			$detailrecords['loan_category_ref_name']     = array();
		}

		return $detailrecords;
	}

	// Update Trustee
	public function updateLoanCategoryDetails($mysqli, $id, $userid)
	{

		if (isset($_POST['loan_category_name'])) {
			$loan_category_name = $_POST['loan_category_name'];
		}
		if (isset($_POST['sub_category_name'])) {
			$sub_category_name = $_POST['sub_category_name'];
		}
		if (isset($_POST['loan_limit'])) {
			$loan_limit = $_POST['loan_limit'];
		}
		if (isset($_POST['loan_category_ref_name'])) {
			$loan_category_ref_name = $_POST['loan_category_ref_name'];
		}

		$updateQry = 'UPDATE loan_category SET loan_category_name = "' . strip_tags($loan_category_name) . '", sub_category_name = "' . strip_tags($sub_category_name) . '",loan_limit = "' . strip_tags($loan_limit) . '", status = "0" WHERE loan_category_id = "' . mysqli_real_escape_string($mysqli, $id) . '" ';
		$res = $mysqli->query($updateQry) or die("Error in in update Query!." . $mysqli->error);

		$DeleterrRef = $mysqli->query("DELETE FROM loan_category_ref WHERE loan_category_id = '" . $id . "' ");

		for ($i = 0; $i <= sizeof($loan_category_ref_name) - 1; $i++) {

			$rrUpdaet = "INSERT INTO loan_category_ref(loan_category_id, loan_category_ref_name) VALUES('" . strip_tags($id) . "', '" . strip_tags($loan_category_ref_name[$i]) . "')";
			$updresult = $mysqli->query($rrUpdaet) or die("Error in in update Query!." . $mysqli->error);
		}
	}

	//  Delete Loan Category
	public function deleteLoanCategoryDetails($mysqli, $id, $userid)
	{

		$date  = date('Y-m-d');
		$courseDelete = "UPDATE loan_category set status='1', delete_user_id='" . strip_tags($userid) . "' WHERE loan_category_id  = '" . strip_tags($id) . "' ";
		$runQry = $mysqli->query($courseDelete) or die("Error in delete query" . $mysqli->error);
	}

	//  Get Company Name
	public function getCompanyName($mysqli)
	{
		$qry = "SELECT * FROM company_creation WHERE 1 AND status=0 ORDER BY company_id DESC";
		$res = $mysqli->query($qry) or die("Error in Get All Records" . $mysqli->error);
		$detailrecords = array();
		$i = 0;
		if ($mysqli->affected_rows > 0) {
			while ($row = $res->fetch_object()) {
				$detailrecords[$i]['company_id']            = $row->company_id;
				$detailrecords[$i]['company_name']          = strip_tags($row->company_name);
				$i++;
			}
		}
		return $detailrecords;
	}

	// Add Branch Creation
	public function addBranchCreation($mysqli, $userid)
	{
		if (isset($_POST['branch_code'])) {
			$branch_code = $_POST['branch_code'];
		}
		if (isset($_POST['branch_name'])) {
			$branch_name = $_POST['branch_name'];
		}
		if (isset($_POST['email_id'])) {
			$email_id = $_POST['email_id'];
		}
		if (isset($_POST['address1'])) {
			$address1 = $_POST['address1'];
		}
		$address2 = '';
		if (isset($_POST['address2'])) {
			$address2 = $_POST['address2'];
		}
		if (isset($_POST['state'])) {
			$state = $_POST['state'];
		}
		if (isset($_POST['taluk'])) {
			$taluk = $_POST['taluk'];
		}
		if (isset($_POST['mobile_number'])) {
			$mobile_number = $_POST['mobile_number'];
		}
		if (isset($_POST['whatsapp_number'])) {
			$whatsapp_number = $_POST['whatsapp_number'];
		}
		if (isset($_POST['landline_number'])) {
			$landline_number = $_POST['landline_number'];
		}
		if (isset($_POST['place'])) {
			$place = $_POST['place'];
		}
		if (isset($_POST['pincode'])) {
			$pincode = $_POST['pincode'];
		}
		if (isset($_POST['district'])) {
			$district = $_POST['district'];
		}
		if (isset($_POST['company_name'])) {
			$company_name = $_POST['company_name'];
		}
		if (isset($_POST['userid'])) {
			$userid = $_POST['userid'];
		}
		$branchInsert = "INSERT INTO branch_creation(branch_code, branch_name, mobile_number, email_id, address1, address2, state, district,
        taluk, place, pincode, whatsapp_number, landline_number, company_name, insert_login_id)
        VALUES('" . strip_tags($branch_code) . "','" . strip_tags($branch_name) . "', '" . strip_tags($mobile_number) . "','" . strip_tags($email_id) . "', '" . strip_tags($address1) . "',
        '" . strip_tags($address2) . "', '" . strip_tags($state) . "', '" . strip_tags($district) . "',  '" . strip_tags($taluk) . "','" . strip_tags($place) . "', '" . strip_tags($pincode) . "',
        '" . strip_tags($whatsapp_number) . "', '" . strip_tags($landline_number) . "', '" . strip_tags($company_name) . "', '" . strip_tags($userid) . "' )";
		$insresult = $mysqli->query($branchInsert) or die("Error " . $mysqli->error);
	}
	// Get Branch Creation
	public function getBranchCreation($mysqli, $id)
	{
		$branchSelect = "SELECT * FROM branch_creation WHERE branch_id='" . mysqli_real_escape_string($mysqli, $id) . "' ";
		$res = $mysqli->query($branchSelect) or die("Error in Get All Records" . $mysqli->error);
		$detailrecords = array();
		if ($mysqli->affected_rows > 0) {
			$row = $res->fetch_object();
			$detailrecords['branch_id']      = $row->branch_id;
			$detailrecords['branch_code']    = $row->branch_code;
			$detailrecords['branch_name']    = $row->branch_name;
			$detailrecords['taluk']    = $row->taluk;
			$detailrecords['district']    = $row->district;
			$detailrecords['email_id']        = $row->email_id;
			$detailrecords['address1']      = $row->address1;
			$detailrecords['address2']      = $row->address2;
			$detailrecords['state']       = $row->state;
			$detailrecords['place']         = $row->place;
			$detailrecords['pincode']       = $row->pincode;
			$detailrecords['mobile_number']    = $row->mobile_number;
			$detailrecords['whatsapp_number']       = $row->whatsapp_number;
			$detailrecords['landline_number']  = $row->landline_number;
			$detailrecords['company_name']  = $row->company_name;
		}
		return $detailrecords;
	}
	// Update Branch Creation
	public function updateBranchCreation($mysqli, $id, $userid)
	{
		if (isset($_POST['branch_code'])) {
			$branch_code = $_POST['branch_code'];
		}
		if (isset($_POST['branch_name'])) {
			$branch_name = $_POST['branch_name'];
		}
		if (isset($_POST['email_id'])) {
			$email_id = $_POST['email_id'];
		}
		if (isset($_POST['address1'])) {
			$address1 = $_POST['address1'];
		}
		$address2 = '';
		if (isset($_POST['address2'])) {
			$address2 = $_POST['address2'];
		}
		if (isset($_POST['state'])) {
			$state = $_POST['state'];
		}
		if (isset($_POST['taluk'])) {
			$taluk = $_POST['taluk'];
		}
		if (isset($_POST['mobile_number'])) {
			$mobile_number = $_POST['mobile_number'];
		}
		if (isset($_POST['whatsapp_number'])) {
			$whatsapp_number = $_POST['whatsapp_number'];
		}
		if (isset($_POST['landline_number'])) {
			$landline_number = $_POST['landline_number'];
		}
		if (isset($_POST['place'])) {
			$place = $_POST['place'];
		}
		if (isset($_POST['pincode'])) {
			$pincode = $_POST['pincode'];
		}
		if (isset($_POST['district'])) {
			$district = $_POST['district'];
		}
		if (isset($_POST['company_name'])) {
			$company_name = $_POST['company_name'];
		}
		if (isset($_POST['userid'])) {
			$userid = $_POST['userid'];
		}
		$branchUpdaet = "UPDATE branch_creation SET branch_code = '" . strip_tags($branch_code) . "', branch_name = '" . strip_tags($branch_name) . "',
			mobile_number='" . strip_tags($mobile_number) . "', email_id='" . strip_tags($email_id) . "', address1='" . strip_tags($address1) . "', address2='" . strip_tags($address2) . "',
			state='" . strip_tags($state) . "', taluk = '" . strip_tags($taluk) . "', district = '" . strip_tags($district) . "', place='" . strip_tags($place) . "',
			pincode='" . strip_tags($pincode) . "', whatsapp_number='" . strip_tags($whatsapp_number) . "', company_name='" . strip_tags($company_name) . "', landline_number='" . strip_tags($landline_number) . "',
			update_login_id='" . strip_tags($userid) . "', status = '0' WHERE branch_id= '" . strip_tags($id) . "' ";
		$updresult = $mysqli->query($branchUpdaet) or die("Error in in update Query!." . $mysqli->error);
	}
	//  Delete Branch Creation
	public function deleteBranchCreation($mysqli, $id, $userid)
	{
		$date  = date('Y-m-d');
		$branchDelete = "UPDATE branch_creation set status='1', delete_login_id='" . strip_tags($userid) . "' WHERE branch_id = '" . strip_tags($id) . "' ";
		$runQry = $mysqli->query($branchDelete) or die("Error in delete query" . $mysqli->error);
	}

	// Add Loan Calculation
	public function addLoanCalculation($mysqli, $userid)
	{
		if (isset($_POST['loan_category'])) {
			$loan_category = $_POST['loan_category'];
		}
		if (isset($_POST['sub_category'])) {
			$sub_category = $_POST['sub_category'];
		}
		if (isset($_POST['due_method'])) {
			$due_method = $_POST['due_method'];
		}
		if (isset($_POST['due_type'])) {
			$due_type = $_POST['due_type'];
			// $due_type = implode(",",$due_types);
		}
		if (isset($_POST['profit_method'])) {
			$profit_methods = $_POST['profit_method'];
			$profit_method = implode(",", $profit_methods);
		}
		if (isset($_POST['calculate_method'])) {
			$calculate_method = $_POST['calculate_method'];
		}
		if (isset($_POST['intrest_rate_min'])) {
			$intrest_rate_min = $_POST['intrest_rate_min'];
		}
		if (isset($_POST['intrest_rate_max'])) {
			$intrest_rate_max = $_POST['intrest_rate_max'];
		}
		if (isset($_POST['due_period_min'])) {
			$due_period_min = $_POST['due_period_min'];
		}
		if (isset($_POST['due_period_max'])) {
			$due_period_max = $_POST['due_period_max'];
		}
		if (isset($_POST['doc_charge_type'])) {
			$doc_charge_type = $_POST['doc_charge_type'];
		}
		if (isset($_POST['document_charge_min'])) {
			$document_charge_min = $_POST['document_charge_min'];
		}
		if (isset($_POST['document_charge_max'])) {
			$document_charge_max = $_POST['document_charge_max'];
		}
		if (isset($_POST['proc_fee_type'])) {
			$proc_fee_type = $_POST['proc_fee_type'];
		}
		if (isset($_POST['processing_fee_min'])) {
			$processing_fee_min = $_POST['processing_fee_min'];
		}
		if (isset($_POST['processing_fee_max'])) {
			$processing_fee_max = $_POST['processing_fee_max'];
		}
		// if(isset($_POST['loan_limit'])){
		// 	$loan_limit = $_POST['loan_limit'];
		// }
		$due_date = '';
		if (isset($_POST['due_date'])) {
			$due_date = $_POST['due_date'];
		}
		$grace_period = '';
		if (isset($_POST['grace_period'])) {
			$grace_period = $_POST['grace_period'];
		}
		$penalty = '';
		if (isset($_POST['penalty'])) {
			$penalty = $_POST['penalty'];
		}
		if (isset($_POST['overdue'])) {
			$overdue = $_POST['overdue'];
		}
		if (isset($_POST['collection_info'])) {
			$collection_info = $_POST['collection_info'];
		}
		if (isset($_POST['userid'])) {
			$userid = $_POST['userid'];
		}
		$loanInsert = "INSERT INTO loan_calculation(loan_category, sub_category, due_method, due_type, profit_method, calculate_method, intrest_rate_min,
		intrest_rate_max, due_period_min, due_period_max,doc_charge_type, document_charge_min, document_charge_max, proc_fee_type,processing_fee_min, processing_fee_max,
		due_date, grace_period, penalty, overdue, collection_info, insert_login_id)
		VALUES('" . strip_tags($loan_category) . "','" . strip_tags($sub_category) . "', '" . strip_tags($due_method) . "','" . strip_tags($due_type) . "', '" . strip_tags($profit_method) . "',
		'" . strip_tags($calculate_method) . "', '" . strip_tags($intrest_rate_min) . "', '" . strip_tags($intrest_rate_max) . "',  '" . strip_tags($due_period_min) . "','" . strip_tags($due_period_max) . "', '" . strip_tags($doc_charge_type) . "','" . strip_tags($document_charge_min) . "',
		'" . strip_tags($document_charge_max) . "','" . strip_tags($proc_fee_type) . "', '" . strip_tags($processing_fee_min) . "', '" . strip_tags($processing_fee_max) . "',
		'" . strip_tags($due_date) . "','" . strip_tags($grace_period) . "', '" . strip_tags($penalty) . "', '" . strip_tags($overdue) . "', '" . strip_tags($collection_info) . "', '" . strip_tags($userid) . "' )";
		$insresult = $mysqli->query($loanInsert) or die("Error " . $mysqli->error);
	}
	// Get Loan Calculation
	public function getLoanCalculation($mysqli, $id)
	{
		$loanSelect = "SELECT * FROM loan_calculation WHERE loan_cal_id='" . mysqli_real_escape_string($mysqli, $id) . "' ";
		$res = $mysqli->query($loanSelect) or die("Error in Get All Records" . $mysqli->error);
		$detailrecords = array();
		if ($mysqli->affected_rows > 0) {
			$row = $res->fetch_object();
			$detailrecords['loan_cal_id']        = $row->loan_cal_id;
			$detailrecords['loan_category']      = $row->loan_category;
			$detailrecords['sub_category']       = $row->sub_category;
			$detailrecords['due_method']         = $row->due_method;
			$detailrecords['due_type']           = $row->due_type;
			$detailrecords['profit_method']      = $row->profit_method;
			$detailrecords['calculate_method']   = $row->calculate_method;
			$detailrecords['intrest_rate_min']   = $row->intrest_rate_min;
			$detailrecords['intrest_rate_max']   = $row->intrest_rate_max;
			$detailrecords['due_period_min']     = $row->due_period_min;
			$detailrecords['due_period_max']     = $row->due_period_max;
			$detailrecords['doc_charge_type']     = $row->doc_charge_type;
			$detailrecords['document_charge_min'] = $row->document_charge_min;
			$detailrecords['document_charge_max'] = $row->document_charge_max;
			$detailrecords['proc_fee_type'] = $row->proc_fee_type;
			$detailrecords['processing_fee_min'] = $row->processing_fee_min;
			$detailrecords['processing_fee_max'] = $row->processing_fee_max;
			// $detailrecords['loan_limit']           = $row->loan_limit;
			$detailrecords['due_date']           = $row->due_date;
			$detailrecords['grace_period']       = $row->grace_period;
			$detailrecords['penalty']            = $row->penalty;
			$detailrecords['overdue']            = $row->overdue;
			$detailrecords['collection_info']    = $row->collection_info;
		}
		return $detailrecords;
	}
	// Update Loan Calculation
	public function updateLoanCalculation($mysqli, $id, $userid)
	{
		if (isset($_POST['loan_category'])) {
			$loan_category = $_POST['loan_category'];
		}
		// print_r($loan_category);die;
		if (isset($_POST['sub_category'])) {
			$sub_category = $_POST['sub_category'];
		}
		if (isset($_POST['due_method'])) {
			$due_method = $_POST['due_method'];
		}
		if (isset($_POST['due_type'])) {
			$due_type = $_POST['due_type'];
			// $due_type = implode(",",$due_types);
		}
		if (isset($_POST['profit_method'])) {
			$profit_methods = $_POST['profit_method'];
			$profit_method = implode(",", $profit_methods);
		}
		if (isset($_POST['calculate_method'])) {
			$calculate_method = $_POST['calculate_method'];
		}
		if (isset($_POST['intrest_rate_min'])) {
			$intrest_rate_min = $_POST['intrest_rate_min'];
		}
		if (isset($_POST['intrest_rate_max'])) {
			$intrest_rate_max = $_POST['intrest_rate_max'];
		}
		if (isset($_POST['due_period_min'])) {
			$due_period_min = $_POST['due_period_min'];
		}
		if (isset($_POST['due_period_max'])) {
			$due_period_max = $_POST['due_period_max'];
		}
		if (isset($_POST['doc_charge_type'])) {
			$doc_charge_type = $_POST['doc_charge_type'];
		}
		if (isset($_POST['document_charge_min'])) {
			$document_charge_min = $_POST['document_charge_min'];
		}
		if (isset($_POST['document_charge_max'])) {
			$document_charge_max = $_POST['document_charge_max'];
		}
		if (isset($_POST['proc_fee_type'])) {
			$proc_fee_type = $_POST['proc_fee_type'];
		}
		if (isset($_POST['processing_fee_min'])) {
			$processing_fee_min = $_POST['processing_fee_min'];
		}
		if (isset($_POST['processing_fee_max'])) {
			$processing_fee_max = $_POST['processing_fee_max'];
		}
		// if(isset($_POST['loan_limit'])){
		// 	$loan_limit = $_POST['loan_limit'];
		// }
		$due_date = '';
		if (isset($_POST['due_date'])) {
			$due_date = $_POST['due_date'];
		}
		$grace_period = '';
		if (isset($_POST['grace_period'])) {
			$grace_period = $_POST['grace_period'];
		}
		$penalty = '';
		if (isset($_POST['penalty'])) {
			$penalty = $_POST['penalty'];
		}
		if (isset($_POST['overdue'])) {
			$overdue = $_POST['overdue'];
		}
		if (isset($_POST['collection_info'])) {
			$collection_info = $_POST['collection_info'];
		}
		if (isset($_POST['userid'])) {
			$userid = $_POST['userid'];
		}
		$loanUpdaet = "UPDATE loan_calculation SET loan_category = '" . strip_tags($loan_category) . "', sub_category = '" . strip_tags($sub_category) . "', due_method='" . strip_tags($due_method) . "',
	due_type = '" . strip_tags($due_type) . "', profit_method = '" . strip_tags($profit_method) . "', calculate_method = '" . strip_tags($calculate_method) . "',
	intrest_rate_min = '" . strip_tags($intrest_rate_min) . "', intrest_rate_max = '" . strip_tags($intrest_rate_max) . "',  due_period_min = '" . strip_tags($due_period_min) . "',
	due_period_max = '" . strip_tags($due_period_max) . "',doc_charge_type = '" . strip_tags($doc_charge_type) . "', document_charge_min = '" . strip_tags($document_charge_min) . "',
	document_charge_max = '" . strip_tags($document_charge_max) . "',proc_fee_type = '" . strip_tags($proc_fee_type) . "', processing_fee_min = '" . strip_tags($processing_fee_min) . "',
	processing_fee_max = '" . strip_tags($processing_fee_max) . "', due_date = '" . strip_tags($due_date) . "',
	grace_period = '" . strip_tags($grace_period) . "', penalty = '" . strip_tags($penalty) . "', overdue = '" . strip_tags($overdue) . "', collection_info = '" . strip_tags($collection_info) . "',
	update_login_id='" . strip_tags($userid) . "', status = '0' WHERE loan_cal_id= '" . strip_tags($id) . "' ";
		$updresult = $mysqli->query($loanUpdaet) or die("Error in in update Query!." . $mysqli->error);
	}
	//  Delete Loan Calculation
	public function deleteLoanCalculation($mysqli, $id, $userid)
	{
		$date  = date('Y-m-d');
		$loanDelete = "UPDATE loan_calculation set status='1', delete_login_id='" . strip_tags($userid) . "' WHERE loan_cal_id = '" . strip_tags($id) . "' ";
		$runQry = $mysqli->query($loanDelete) or die("Error in delete query" . $mysqli->error);
	}

	// Get Area 
	public function getAreaList($mysqli)
	{
		$selectQry = "SELECT * FROM area_list_creation WHERE status= 0  ";
		$res = $mysqli->query($selectQry) or die("Error in Get All Records" . $mysqli->error);
		$detailrecords = array();
		$j = 0;
		if ($mysqli->affected_rows > 0) {
			while ($row = $res->fetch_object()) {
				$detailrecords[$j]['area_id']      = $row->area_id;
				$detailrecords[$j]['area_name']    = $row->area_name;
				$j++;
			}
		}
		// $selectQry = "SELECT * FROM area_list_creation JOIN sub_area_list_creation on area_list_creation.area_id = sub_area_list_creation.area_id_ref 
		// JOIN area_line_mapping on FIND_IN_SET(sub_area_list_creation.sub_area_id, area_line_mapping.sub_area_id) > 0 WHERE area_list_creation.status= 0 and 
		// sub_area_list_creation.status=0 and area_line_mapping.status=0 ";
		// $res = $mysqli->query($selectQry) or die("Error in Get All Records".$mysqli->error);
		// $detailrecords = array();$j=0;
		// if ($mysqli->affected_rows>0)
		// {
		// 	while($row = $res->fetch_object()){
		// 		$detailrecords[$j]['area_id']      = $row->area_id;
		// 		$detailrecords[$j]['area_name']    = $row->area_name;
		// 		$j++;
		// 	}
		// }

		return $detailrecords;
	}
	// Get SubArea 
	public function getSubAreaList($mysqli)
	{
		$selectQry = "SELECT * FROM sub_area_list_creation WHERE status= 0  ";
		$res = $mysqli->query($selectQry) or die("Error in Get All Records" . $mysqli->error);
		$detailrecords = array();
		$j = 0;
		if ($mysqli->affected_rows > 0) {
			while ($row = $res->fetch_object()) {
				$detailrecords[$j]['sub_area_id']      = $row->sub_area_id;
				$detailrecords[$j]['area_id_ref']    = $row->area_id_ref;
				$detailrecords[$j]['sub_area_name']    = $row->sub_area_name;
				$j++;
			}
		}
		return $detailrecords;
	}

	// Add Area Creation
	public function addAreaCreation($mysqli, $userid)
	{
		if (isset($_POST['area'])) {
			$area_name_id = $_POST['area'];
		}
		if (isset($_POST['sub_area'])) {
			$sub_area = $_POST['sub_area'];
		}
		if (isset($_POST['taluk'])) {
			$taluk = $_POST['taluk'];
		}
		if (isset($_POST['district'])) {
			$district = $_POST['district'];
		}
		if (isset($_POST['state'])) {
			$state = $_POST['state'];
		}
		if (isset($_POST['pincode'])) {
			$pincode = $_POST['pincode'];
		}
		$insertQry = "INSERT INTO area_creation(area_name_id, sub_area, taluk, district, state, pincode, insert_login_id,created_date	)
		VALUES('" . strip_tags($area_name_id) . "','" . strip_tags($sub_area) . "', '" . strip_tags($taluk) . "', '" . strip_tags($district) . "',
			'" . strip_tags($state) . "',  '" . strip_tags($pincode) . "', '" . strip_tags($userid) . "',current_timestamp() )";
		$insresult = $mysqli->query($insertQry) or die("Error " . $mysqli->error);
	}

	// Update Area Creation
	public function updateAreaCreation($mysqli, $id, $userid)
	{
		if (isset($_POST['area'])) {
			$area_name_id = $_POST['area'];
		}
		if (isset($_POST['sub_area'])) {
			$sub_area = $_POST['sub_area'];
		}
		if (isset($_POST['taluk'])) {
			$taluk = $_POST['taluk'];
		}
		if (isset($_POST['district'])) {
			$district = $_POST['district'];
		}
		if (isset($_POST['state'])) {
			$state = $_POST['state'];
		}
		if (isset($_POST['pincode'])) {
			$pincode = $_POST['pincode'];
		}
		if (isset($_POST['enabledisable'])) {
			$enabledisable = $_POST['enabledisable'];
		}
		$updateQry = "UPDATE area_creation set area_name_id='" . strip_tags($area_name_id) . "', sub_area='" . strip_tags($sub_area) . "', taluk='" . strip_tags($taluk) . "', 
		district= '" . strip_tags($district) . "', state='" . strip_tags($state) . "', pincode= '" . strip_tags($pincode) . "', enable= '" . strip_tags($enabledisable) . "', update_login_id='" . strip_tags($userid) . "', 
		updated_date	 = current_timestamp(), status=0 WHERE area_creation_id = '" . $id . "' ";
		$result = $mysqli->query($updateQry) or die("Error " . $mysqli->error);
	}

	// Get Area Creation
	public function getAreaCreation($mysqli, $id)
	{
		$selectQry = "SELECT * FROM area_creation WHERE area_creation_id='" . mysqli_real_escape_string($mysqli, $id) . "' ";
		$res = $mysqli->query($selectQry) or die("Error in Get All Records" . $mysqli->error);
		$detailrecords = array();
		if ($mysqli->affected_rows > 0) {
			$row = $res->fetch_object();
			$detailrecords['area_creation_id']      = $row->area_creation_id;
			$detailrecords['area_name_id']    = $row->area_name_id;
			$detailrecords['sub_area']    = $row->sub_area;
			$detailrecords['taluk']    = $row->taluk;
			$detailrecords['district']    = $row->district;
			$detailrecords['state']       = $row->state;
			$detailrecords['pincode']       = $row->pincode;
			$detailrecords['enable']       = $row->enable;
		}
		return $detailrecords;
	}

	//  Delete Area Creation
	public function deleteAreaCreation($mysqli, $id, $userid)
	{
		$branchDelete = "UPDATE area_creation set status='1', delete_login_id='" . strip_tags($userid) . "' WHERE area_creation_id = '" . strip_tags($id) . "' ";
		$runQry = $mysqli->query($branchDelete) or die("Error in delete query" . $mysqli->error);
	}

	// Get Loan caltegory list for loan calculation
	public function getloanCategoryList($mysqli)
	{

		$loanCatSelect = "SELECT * FROM loan_category GROUP BY loan_category_name";
		$res = $mysqli->query($loanCatSelect) or die("Error in Get All Records" . $mysqli->error);
		$detailrecords = array();
		if ($mysqli->affected_rows > 0) {
			$i = 0;
			while ($row = $res->fetch_object()) {
				$loan_categoryId[$i]      = $row->loan_category_id;
				$detailrecords[$i]['loan_category_id']      = $row->loan_category_id;
				$detailrecords[$i]['loan_category_name_id']    = $row->loan_category_name;
				$detailrecords[$i]['sub_category_name']    = $row->sub_category_name;

				$Qry = "SELECT * FROM loan_category_creation WHERE loan_category_creation_id= '" . $detailrecords[$i]['loan_category_name_id'] . "' and status = 0 ";
				$res1 = $mysqli->query($Qry) or die("Error in Get All Records" . $mysqli->error);
				$row1 = $res1->fetch_object();
				$detailrecords[$i]['loan_category_name'] = $row1->loan_category_creation_name;
				$i++;
			}
		}
		return $detailrecords;
	}
	// Get Loan Calculation list disable Loan category
	public function getloanCalculationList($mysqli)
	{

		$loanCatSelect = "SELECT * FROM loan_category GROUP BY loan_category_name";
		$res = $mysqli->query($loanCatSelect) or die("Error in Get All Records" . $mysqli->error);
		$detailrecords = array();
		if ($mysqli->affected_rows > 0) {
			$i = 0;
			while ($row = $res->fetch_object()) {
				$loan_categoryId[$i]      = $row->loan_category_id;
				$detailrecords[$i]['loan_category_id']      = $row->loan_category_id;
				$detailrecords[$i]['loan_category_name_id']    = $row->loan_category_name;
				$detailrecords[$i]['sub_category_name']    = $row->sub_category_name;

				$Qry = "SELECT * FROM loan_category_creation WHERE loan_category_creation_id= '" . $detailrecords[$i]['loan_category_name_id'] . "' and status = 0 ";
				$res1 = $mysqli->query($Qry) or die("Error in Get All Records" . $mysqli->error);
				$row1 = $res1->fetch_object();
				$detailrecords[$i]['loan_category_name'] = $row1->loan_category_creation_name;
				$i++;
			}
		}
		return $detailrecords;
	}

	// Add Monthly Loan Scheme Creation
	public function addMonthlyLoanScheme($mysqli, $userid)
	{
		if (isset($_POST['loan_category'])) {
			$loan_category = $_POST['loan_category'];
		}
		if (isset($_POST['sub_category'])) {
			$sub_category = $_POST['sub_category'];
		}
		if (isset($_POST['scheme_name'])) {
			$scheme_name = $_POST['scheme_name'];
		}
		if (isset($_POST['scheme_short'])) {
			$short_name = $_POST['scheme_short'];
		}
		if (isset($_POST['due_method'])) {
			$due_method = $_POST['due_method'];
		}
		if (isset($_POST['profit_method'])) {
			$profit_methods = $_POST['profit_method'];
			$profit_method = implode(",", $profit_methods);
		}
		// if (isset($_POST['intrest_rate'])) {
		// 	$intrest_rate = $_POST['intrest_rate'];
		// }
		if (isset($_POST['total_due'])) {
			$total_due = $_POST['total_due'];
		}
		if (isset($_POST['advance_due'])) {
			$advance_due = $_POST['advance_due'];
		}
		if (isset($_POST['due_period'])) {
			$due_period = $_POST['due_period'];
		}
		if (isset($_POST['intreset_type'])) {
			$intreset_type = $_POST['intreset_type'];
		}
		if (isset($_POST['intreset_min'])) {
			$intreset_min = $_POST['intreset_min'];
		}
		if (isset($_POST['intreset_max'])) {
			$intreset_max = $_POST['intreset_max'];
		}
		if (isset($_POST['doc_charge_type'])) {
			$doc_charge_type = $_POST['doc_charge_type'];
		}
		if (isset($_POST['doc_charge_min'])) {
			$doc_charge_min = $_POST['doc_charge_min'];
		}
		if (isset($_POST['doc_charge_max'])) {
			$doc_charge_max = $_POST['doc_charge_max'];
		}
		if (isset($_POST['proc_fee_type'])) {
			$proc_fee_type = $_POST['proc_fee_type'];
		}
		if (isset($_POST['proc_fee_min'])) {
			$proc_fee_min = $_POST['proc_fee_min'];
		}
		if (isset($_POST['proc_fee_max'])) {
			$proc_fee_max = $_POST['proc_fee_max'];
		}
		$due_date = '';
		if (isset($_POST['due_date'])) {
			$due_date = $_POST['due_date'];
		}
		$grace_period = '';
		if (isset($_POST['grace_period'])) {
			$grace_period = $_POST['grace_period'];
		}
		$penalty = '';
		if (isset($_POST['penalty'])) {
			$penalty = $_POST['penalty'];
		}
		if (isset($_POST['overdue'])) {
			$overdue = $_POST['overdue'];
		}

		$insertQry = "INSERT INTO loan_scheme(scheme_name, short_name, loan_category, sub_category, due_method, profit_method,total_due,advance_due,due_period,intreset_type,intreset_min,intreset_max,doc_charge_type,
		doc_charge_min,doc_charge_max,proc_fee_type,proc_fee_min,proc_fee_max,due_date,overdue,grace_period,penalty,insert_login_id,created_date)
		VALUES('" . strip_tags($scheme_name) . "','" . strip_tags($short_name) . "', '" . strip_tags($loan_category) . "', '" . strip_tags($sub_category) . "',
		'" . strip_tags($due_method) . "','" . strip_tags($profit_method) . "', '" . strip_tags($total_due) . "',
		'" . strip_tags($advance_due) . "','" . strip_tags($due_period) . "','" . strip_tags($intreset_type) . "', '" . strip_tags($intreset_min) . "','" . strip_tags($intreset_max) . "','" . strip_tags($doc_charge_type) . "', '" . strip_tags($doc_charge_min) . "',
		'" . strip_tags($doc_charge_max) . "','" . strip_tags($proc_fee_type) . "', '" . strip_tags($proc_fee_min) . "', '" . strip_tags($proc_fee_max) . "',
		'" . strip_tags($due_date) . "','" . strip_tags($overdue) . "', '" . strip_tags($grace_period) . "', '" . strip_tags($penalty) . "', '" . strip_tags($userid) . "',current_timestamp() )";
		$insresult = $mysqli->query($insertQry) or die("Error " . $mysqli->error);
	}

	// Add Weekly Loan Scheme Creation
	public function addWeeklyLoanScheme($mysqli, $userid)
	{
		if (isset($_POST['loan_category1'])) {
			$loan_category1 = $_POST['loan_category1'];
		}
		if (isset($_POST['sub_category1'])) {
			$sub_category1 = $_POST['sub_category1'];
		}
		if (isset($_POST['scheme_name1'])) {
			$scheme_name1 = $_POST['scheme_name1'];
		}
		if (isset($_POST['scheme_short1'])) {
			$short_name1 = $_POST['scheme_short1'];
		}
		if (isset($_POST['due_method1'])) {
			$due_method1 = $_POST['due_method1'];
		}
		if (isset($_POST['profit_method1'])) {
			$profit_methods = $_POST['profit_method1'];
			$profit_method1 = implode(",", $profit_methods);
		}
		// if (isset($_POST['intrest_rate1'])) {
		// 	$intrest_rate1 = $_POST['intrest_rate1'];
		// }
		if (isset($_POST['due_period1'])) {
			$due_period1 = $_POST['due_period1'];
		}
		if (isset($_POST['intreset_type1'])) {
			$intreset_type1 = $_POST['intreset_type1'];
		}
		if (isset($_POST['intreset_min1'])) {
			$intreset_min1 = $_POST['intreset_min1'];
		}
		if (isset($_POST['intreset_max1'])) {
			$intreset_max1 = $_POST['intreset_max1'];
		}
		if (isset($_POST['doc_charge_type1'])) {
			$doc_charge_type1 = $_POST['doc_charge_type1'];
		}
		if (isset($_POST['doc_charge_min1'])) {
			$doc_charge_min1 = $_POST['doc_charge_min1'];
		}
		if (isset($_POST['doc_charge_max1'])) {
			$doc_charge_max1 = $_POST['doc_charge_max1'];
		}
		if (isset($_POST['proc_fee_type1'])) {
			$proc_fee_type1 = $_POST['proc_fee_type1'];
		}
		if (isset($_POST['proc_fee_min1'])) {
			$proc_fee_min1 = $_POST['proc_fee_min1'];
		}
		if (isset($_POST['proc_fee_max1'])) {
			$proc_fee_max1 = $_POST['proc_fee_max1'];
		}
		$due_day = '';
		if (isset($_POST['due_day'])) {
			$due_day = $_POST['due_day'];
		}
		if (isset($_POST['overdue1'])) {
			$overdue1 = $_POST['overdue1'];
		}

		$insertQry = "INSERT INTO loan_scheme(scheme_name, short_name, loan_category, sub_category, due_method, profit_method,due_period,intreset_type,intreset_min,intreset_max,doc_charge_type,
		doc_charge_min,doc_charge_max,proc_fee_type,proc_fee_min,proc_fee_max,due_date,overdue,insert_login_id,created_date)
		VALUES('" . strip_tags($scheme_name1) . "','" . strip_tags($short_name1) . "', '" . strip_tags($loan_category1) . "', '" . strip_tags($sub_category1) . "',
		'" . strip_tags($due_method1) . "','" . strip_tags($profit_method1) . "',  '" . strip_tags($due_period1) . "', '" . strip_tags($intreset_type1) . "','" . strip_tags($intreset_min1) . "','" . strip_tags($intreset_max1) . "',
		'" . strip_tags($doc_charge_type1) . "', '" . strip_tags($doc_charge_min1) . "',
		'" . strip_tags($doc_charge_max1) . "','" . strip_tags($proc_fee_type1) . "', '" . strip_tags($proc_fee_min1) . "', '" . strip_tags($proc_fee_max1) . "',
		'" . strip_tags($due_day) . "','" . strip_tags($overdue1) . "', '" . strip_tags($userid) . "',current_timestamp() )";
		$insresult = $mysqli->query($insertQry) or die("Error " . $mysqli->error);
	}

	// Add Daily Loan Scheme Creation
	public function addDailyLoanScheme($mysqli, $userid)
	{
		if (isset($_POST['loan_category2'])) {
			$loan_category2 = $_POST['loan_category2'];
		}
		if (isset($_POST['sub_category2'])) {
			$sub_category2 = $_POST['sub_category2'];
		}
		if (isset($_POST['scheme_name2'])) {
			$scheme_name2 = $_POST['scheme_name2'];
		}
		if (isset($_POST['scheme_short2'])) {
			$short_name2 = $_POST['scheme_short2'];
		}
		if (isset($_POST['due_method2'])) {
			$due_method2 = $_POST['due_method2'];
		}
		if (isset($_POST['profit_method2'])) {
			$profit_methods = $_POST['profit_method2'];
			$profit_method2 = implode(",", $profit_methods);
		}
		// if (isset($_POST['intrest_rate2'])) {
		// 	$intrest_rate2 = $_POST['intrest_rate2'];
		// }
		if (isset($_POST['due_period2'])) {
			$due_period2 = $_POST['due_period2'];
		}
		if (isset($_POST['intreset_type2'])) {
			$intreset_type2 = $_POST['intreset_type2'];
		}
		if (isset($_POST['intreset_min2'])) {
			$intreset_min2 = $_POST['intreset_min2'];
		}
		if (isset($_POST['intreset_max2'])) {	
			$intreset_max2 = $_POST['intreset_max2'];
		}
		if (isset($_POST['doc_charge_type2'])) {
			$doc_charge_type2 = $_POST['doc_charge_type2'];
		}
		if (isset($_POST['doc_charge_min2'])) {
			$doc_charge_min2 = $_POST['doc_charge_min2'];
		}
		if (isset($_POST['doc_charge_max2'])) {
			$doc_charge_max2 = $_POST['doc_charge_max2'];
		}
		if (isset($_POST['proc_fee_type2'])) {
			$proc_fee_type2 = $_POST['proc_fee_type2'];
		}
		if (isset($_POST['proc_fee_min2'])) {
			$proc_fee_min2 = $_POST['proc_fee_min2'];
		}
		if (isset($_POST['proc_fee_max2'])) {
			$proc_fee_max2 = $_POST['proc_fee_max2'];
		}

		if (isset($_POST['overdue2'])) {
			$overdue2 = $_POST['overdue2'];
		}

		$insertQry = "INSERT INTO loan_scheme(scheme_name, short_name, loan_category, sub_category, due_method, profit_method,due_period,intreset_type,intreset_min,intreset_max,doc_charge_type,
		doc_charge_min,doc_charge_max,proc_fee_type,proc_fee_min,proc_fee_max,overdue,insert_login_id,created_date)
		VALUES('" . strip_tags($scheme_name2) . "','" . strip_tags($short_name2) . "', '" . strip_tags($loan_category2) . "', '" . strip_tags($sub_category2) . "',
		'" . strip_tags($due_method2) . "','" . strip_tags($profit_method2) . "', '" . strip_tags($due_period2) . "', '" . strip_tags($intreset_type2) . "','" . strip_tags($intreset_min2) . "','" . strip_tags($intreset_max2) . "',
		'" . strip_tags($doc_charge_type2) . "', '" . strip_tags($doc_charge_min2) . "','" . strip_tags($doc_charge_max2) . "',
		'" . strip_tags($proc_fee_type2) . "', '" . strip_tags($proc_fee_min2) . "', '" . strip_tags($proc_fee_max2) . "','" . strip_tags($overdue2) . "', '" . strip_tags($userid) . "',current_timestamp() )";
		$insresult = $mysqli->query($insertQry) or die("Error " . $mysqli->error);
	}

	// Get Area Creation
	public function getLoanScheme($mysqli, $id)
	{
		$selectQry = "SELECT * FROM loan_scheme WHERE scheme_id='" . mysqli_real_escape_string($mysqli, $id) . "' ";
		$res = $mysqli->query($selectQry) or die("Error in Get All Records" . $mysqli->error);
		$detailrecords = array();
		if ($mysqli->affected_rows > 0) {
			$row = $res->fetch_object();
			$detailrecords['scheme_id']      = $row->scheme_id;
			$detailrecords['scheme_name']    = $row->scheme_name;
			$detailrecords['short_name']    = $row->short_name;
			$detailrecords['loan_category']    = $row->loan_category;
			$detailrecords['sub_category']    = $row->sub_category;
			$detailrecords['due_method']       = $row->due_method;
			$detailrecords['profit_method']       = $row->profit_method;
			$detailrecords['intrest_rate']       = $row->intrest_rate;
			$detailrecords['total_due']       = $row->total_due;
			$detailrecords['advance_due']       = $row->advance_due;
			$detailrecords['due_period']       = $row->due_period;
			$detailrecords['intreset_type']       = $row->intreset_type;
			$detailrecords['intreset_min']       = $row->intreset_min;
			$detailrecords['intreset_max']       = $row->intreset_max;
			$detailrecords['doc_charge_type']       = $row->doc_charge_type;
			$detailrecords['doc_charge_min']       = $row->doc_charge_min;
			$detailrecords['doc_charge_max']       = $row->doc_charge_max;
			$detailrecords['proc_fee_type']       = $row->proc_fee_type;
			$detailrecords['proc_fee_min']       = $row->proc_fee_min;
			$detailrecords['proc_fee_max']       = $row->proc_fee_max;
			$detailrecords['due_date']       = $row->due_date;
			$detailrecords['overdue']       = $row->overdue;
			$detailrecords['grace_period']       = $row->grace_period;
			$detailrecords['penalty']       = $row->penalty;
		}
		return $detailrecords;
	}

	//Update Monthly Loan Scheme 
	public function updateMonthlyLoanScheme($mysqli, $id, $userid)
	{
		if (isset($_POST['loan_category'])) {
			$loan_category = $_POST['loan_category'];
		}
		if (isset($_POST['sub_category'])) {
			$sub_category = $_POST['sub_category'];
		}
		if (isset($_POST['scheme_name'])) {
			$scheme_name = $_POST['scheme_name'];
		}
		if (isset($_POST['scheme_short'])) {
			$short_name = $_POST['scheme_short'];
		}
		if (isset($_POST['due_method'])) {
			$due_method = $_POST['due_method'];
		}
		if (isset($_POST['profit_method'])) {
			$profit_methods = $_POST['profit_method'];
			$profit_method = implode(",", $profit_methods);
		}
		// if (isset($_POST['intrest_rate'])) {
		// 	$intrest_rate = $_POST['intrest_rate'];
		// }
		if (isset($_POST['total_due'])) {
			$total_due = $_POST['total_due'];
		}
		if (isset($_POST['advance_due'])) {
			$advance_due = $_POST['advance_due'];
		}
		if (isset($_POST['due_period'])) {
			$due_period = $_POST['due_period'];
		}
		if (isset($_POST['intreset_type'])) {
			$intreset_type = $_POST['intreset_type'];
		}
		if (isset($_POST['intreset_min'])) {
			$intreset_min = $_POST['intreset_min'];
		}
		if (isset($_POST['intreset_max'])) {
			$intreset_max = $_POST['intreset_max'];
		}
		if (isset($_POST['doc_charge_type'])) {
			$doc_charge_type = $_POST['doc_charge_type'];
		}
		if (isset($_POST['doc_charge_min'])) {
			$doc_charge_min = $_POST['doc_charge_min'];
		}
		if (isset($_POST['doc_charge_max'])) {
			$doc_charge_max = $_POST['doc_charge_max'];
		}
		if (isset($_POST['proc_fee_type'])) {
			$proc_fee_type = $_POST['proc_fee_type'];
		}
		if (isset($_POST['proc_fee_min'])) {
			$proc_fee_min = $_POST['proc_fee_min'];
		}
		if (isset($_POST['proc_fee_max'])) {
			$proc_fee_max = $_POST['proc_fee_max'];
		}
		$due_date = '';
		if (isset($_POST['due_date'])) {
			$due_date = $_POST['due_date'];
		}
		$grace_period = '';
		if (isset($_POST['grace_period'])) {
			$grace_period = $_POST['grace_period'];
		}
		$penalty = '';
		if (isset($_POST['penalty'])) {
			$penalty = $_POST['penalty'];
		}
		if (isset($_POST['overdue'])) {
			$overdue = $_POST['overdue'];
		}

		$updatetQry = "UPDATE loan_scheme set scheme_name = '" . strip_tags($scheme_name) . "', short_name='" . strip_tags($short_name) . "', loan_category='" . strip_tags($loan_category) . "',
		sub_category='" . strip_tags($sub_category) . "', due_method='" . strip_tags($due_method) . "', profit_method='" . strip_tags($profit_method) . "',
		total_due='" . strip_tags($total_due) . "',advance_due ='" . strip_tags($advance_due) . "',due_period='" . strip_tags($due_period) . "',intreset_type= '" . strip_tags($intreset_type) . "',intreset_min= '" . strip_tags($intreset_min) . "',intreset_max= '" . strip_tags($intreset_max) . "',doc_charge_type= '" . strip_tags($doc_charge_type) . "',
		doc_charge_min='" . strip_tags($doc_charge_min) . "',doc_charge_max='" . strip_tags($doc_charge_max) . "',proc_fee_type='" . strip_tags($proc_fee_type) . "',proc_fee_min='" . strip_tags($proc_fee_min) . "',
		proc_fee_max='" . strip_tags($proc_fee_max) . "',due_date='" . strip_tags($due_date) . "',overdue='" . strip_tags($overdue) . "',grace_period='" . strip_tags($grace_period) . "',penalty='" . strip_tags($penalty) . "',
		update_login_id='" . strip_tags($userid) . "',updated_date= current_timestamp(), status=0 where scheme_id = '" . $id . "'";
		$result = $mysqli->query($updatetQry) or die("Error " . $mysqli->error);
	}

	//Update Weekly Loan Scheme 
	public function updateWeeklyLoanScheme($mysqli, $id, $userid)
	{
		if (isset($_POST['loan_category1'])) {
			$loan_category1 = $_POST['loan_category1'];
		}
		if (isset($_POST['sub_category1'])) {
			$sub_category1 = $_POST['sub_category1'];
		}
		if (isset($_POST['scheme_name1'])) {
			$scheme_name1 = $_POST['scheme_name1'];
		}
		if (isset($_POST['scheme_short1'])) {
			$short_name1 = $_POST['scheme_short1'];
		}
		if (isset($_POST['due_method1'])) {
			$due_method1 = $_POST['due_method1'];
		}
		if (isset($_POST['profit_method1'])) {
			$profit_methods = $_POST['profit_method1'];
			$profit_method1 = implode(",", $profit_methods);
		}
		if (isset($_POST['due_period1'])) {
			$due_period1 = $_POST['due_period1'];
		}
		if (isset($_POST['intreset_type1'])) {
			$intreset_type1 = $_POST['intreset_type1'];
		}
		if (isset($_POST['intreset_min1'])) {
			$intreset_min1 = $_POST['intreset_min1'];
		}
		if (isset($_POST['intreset_max1'])) {
			$intreset_max1 = $_POST['intreset_max1'];
		}
		if (isset($_POST['doc_charge_type1'])) {
			$doc_charge_type1 = $_POST['doc_charge_type1'];
		}
		if (isset($_POST['doc_charge_min1'])) {
			$doc_charge_min1 = $_POST['doc_charge_min1'];
		}
		if (isset($_POST['doc_charge_max1'])) {
			$doc_charge_max1 = $_POST['doc_charge_max1'];
		}
		if (isset($_POST['proc_fee_type1'])) {
			$proc_fee_type1 = $_POST['proc_fee_type1'];
		}
		if (isset($_POST['proc_fee_min1'])) {
			$proc_fee_min1 = $_POST['proc_fee_min1'];
		}
		if (isset($_POST['proc_fee_max1'])) {
			$proc_fee_max1 = $_POST['proc_fee_max1'];
		}
		$due_day = '';
		if (isset($_POST['due_day'])) {
			$due_day = $_POST['due_day'];
		}
		if (isset($_POST['overdue1'])) {
			$overdue1 = $_POST['overdue1'];
		}

		$updatetQry = "UPDATE loan_scheme set scheme_name = '" . strip_tags($scheme_name1) . "', short_name='" . strip_tags($short_name1) . "', loan_category='" . strip_tags($loan_category1) . "',
		sub_category='" . strip_tags($sub_category1) . "', due_method='" . strip_tags($due_method1) . "', profit_method='" . strip_tags($profit_method1) . "',due_period='" . strip_tags($due_period1) . "',intreset_type= '" . strip_tags($intreset_type1) . "',intreset_min= '" . strip_tags($intreset_min1) . "',intreset_max= '" . strip_tags($intreset_max1) . "',
		doc_charge_type= '" . strip_tags($doc_charge_type1) . "',
		doc_charge_min='" . strip_tags($doc_charge_min1) . "',doc_charge_max='" . strip_tags($doc_charge_max1) . "',proc_fee_type='" . strip_tags($proc_fee_type1) . "',proc_fee_min='" . strip_tags($proc_fee_min1) . "',
		proc_fee_max='" . strip_tags($proc_fee_max1) . "',due_date='" . strip_tags($due_day) . "',overdue='" . strip_tags($overdue1) . "',update_login_id='" . strip_tags($userid) . "',updated_date= current_timestamp(), status=0 where scheme_id = '" . $id . "'";
		$result = $mysqli->query($updatetQry) or die("Error " . $mysqli->error);
	}

	//Update Daily Loan Scheme 
	public function updateDailyLoanScheme($mysqli, $id, $userid)
	{
		if (isset($_POST['loan_category2'])) {
			$loan_category2 = $_POST['loan_category2'];
		}
		if (isset($_POST['sub_category2'])) {
			$sub_category2 = $_POST['sub_category2'];
		}
		if (isset($_POST['scheme_name2'])) {
			$scheme_name2 = $_POST['scheme_name2'];
		}
		if (isset($_POST['scheme_short2'])) {
			$short_name2 = $_POST['scheme_short2'];
		}
		if (isset($_POST['due_method2'])) {
			$due_method2 = $_POST['due_method2'];
		}
		if (isset($_POST['profit_method2'])) {
			$profit_methods = $_POST['profit_method2'];
			$profit_method2 = implode(",", $profit_methods);
		}
		// if (isset($_POST['intrest_rate2'])) {
		// 	$intrest_rate2 = $_POST['intrest_rate2'];
		// }
		if (isset($_POST['due_period2'])) {
			$due_period2 = $_POST['due_period2'];
		}
		if (isset($_POST['intreset_type1'])) {
			$intreset_type2 = $_POST['intreset_type1'];
		}
		if (isset($_POST['intreset_min1'])) {
			$intreset_min2 = $_POST['intreset_min1'];
		}
		if (isset($_POST['intreset_max1'])) {
			$intreset_max2 = $_POST['intreset_max1'];
		}
		if (isset($_POST['doc_charge_type2'])) {
			$doc_charge_type2 = $_POST['doc_charge_type2'];
		}
		if (isset($_POST['doc_charge_min2'])) {
			$doc_charge_min2 = $_POST['doc_charge_min2'];
		}
		if (isset($_POST['doc_charge_max2'])) {
			$doc_charge_max2 = $_POST['doc_charge_max2'];
		}
		if (isset($_POST['proc_fee_type2'])) {
			$proc_fee_type2 = $_POST['proc_fee_type2'];
		}
		if (isset($_POST['proc_fee_min2'])) {
			$proc_fee_min2 = $_POST['proc_fee_min2'];
		}
		if (isset($_POST['proc_fee_max2'])) {
			$proc_fee_max2 = $_POST['proc_fee_max2'];
		}

		if (isset($_POST['overdue2'])) {
			$overdue2 = $_POST['overdue2'];
		}

		$updatetQry = "UPDATE loan_scheme set scheme_name = '" . strip_tags($scheme_name2) . "', short_name='" . strip_tags($short_name2) . "', loan_category='" . strip_tags($loan_category2) . "',
		sub_category='" . strip_tags($sub_category2) . "', due_method='" . strip_tags($due_method2) . "', profit_method='" . strip_tags($profit_method2) . "', 
		due_period='" . strip_tags($due_period2) . "',intreset_type= '" . strip_tags($intreset_type2) . "',intreset_min= '" . strip_tags($intreset_min2) . "',intreset_max= '" . strip_tags($intreset_max2) . "'doc_charge_type= '" . strip_tags($doc_charge_type2) . "',
		doc_charge_min='" . strip_tags($doc_charge_min2) . "',doc_charge_max='" . strip_tags($doc_charge_max2) . "',proc_fee_type='" . strip_tags($proc_fee_type2) . "',proc_fee_min='" . strip_tags($proc_fee_min2) . "',
		proc_fee_max='" . strip_tags($proc_fee_max2) . "',overdue='" . strip_tags($overdue2) . "',update_login_id='" . strip_tags($userid) . "',updated_date= current_timestamp(),status=0 where scheme_id = '" . $id . "'";
		$result = $mysqli->query($updatetQry) or die("Error " . $mysqli->error);
	}

	//  Delete Loan Scheme
	public function deleteLoanScheme($mysqli, $id, $userid)
	{
		$deleteQry = "UPDATE loan_scheme set status='1', delete_login_id='" . strip_tags($userid) . "' WHERE scheme_id = '" . strip_tags($id) . "' ";
		$runQry = $mysqli->query($deleteQry) or die("Error in delete query" . $mysqli->error);
	}

	// Get Branch names
	public function getBranchList($mysqli)
	{
		$selectQry = "SELECT * FROM branch_creation WHERE status= 0  ";
		$res = $mysqli->query($selectQry) or die("Error in Get All Records" . $mysqli->error);
		$detailrecords = array();
		$j = 0;
		if ($mysqli->affected_rows > 0) {
			while ($row = $res->fetch_object()) {
				$detailrecords[$j]['branch_id']      = $row->branch_id;
				$detailrecords[$j]['branch_name']    = $row->branch_name;
				$j++;
			}
		}
		return $detailrecords;
	}

	// Add Area Mapping for Line
	public function addAreaMappingLine($mysqli, $userid)
	{
		if (isset($_POST['line_name'])) {
			$line_name = $_POST['line_name'];
		}
		if (isset($_POST['company_id'])) {
			$company_id = $_POST['company_id'];
		}
		if (isset($_POST['branch'])) {
			$branch_id = $_POST['branch'];
		}
		if (isset($_POST['area'])) {
			$area_id = $_POST['area'];
		}
		$sub_area = '';
		if (isset($_POST['sub_area'])) {
			$sub_area = $_POST['sub_area'];
		}
		$insertQry = "INSERT INTO area_line_mapping(line_name, area_id, sub_area_id,company_id, branch_id, insert_login_id, created_date)
		VALUES('" . strip_tags($line_name) . "','" . strip_tags($area_id) . "', '" . strip_tags($sub_area) . "', '" . strip_tags($company_id) . "','" . strip_tags($branch_id) . "', '" . strip_tags($userid) . "',current_timestamp() )";
		$insresult = $mysqli->query($insertQry) or die("Error " . $mysqli->error);
	}
	// Add Area Mapping for Group
	public function addAreaMappingGroup($mysqli, $userid)
	{
		if (isset($_POST['group_name'])) {
			$group_name = $_POST['group_name'];
		}
		if (isset($_POST['company_id1'])) {
			$company_id = $_POST['company_id1'];
		}
		if (isset($_POST['branch1'])) {
			$branch_id = $_POST['branch1'];
		}
		if (isset($_POST['area1'])) {
			$area_id = $_POST['area1'];
		}
		$sub_area_id = '';
		if (isset($_POST['sub_area1'])) {
			$sub_area_id = $_POST['sub_area1'];
		}
		$insertQry = "INSERT INTO area_group_mapping(group_name, area_id, sub_area_id,company_id, branch_id, insert_login_id, created_date)
		VALUES('" . strip_tags($group_name) . "','" . strip_tags($area_id) . "', '" . strip_tags($sub_area_id) . "','" . strip_tags($company_id) . "', '" . strip_tags($branch_id) . "', '" . strip_tags($userid) . "',current_timestamp() )";
		$insresult = $mysqli->query($insertQry) or die("Error " . $mysqli->error);
	}

	// Update Area Mapping Line
	public function updateAreaMappingLine($mysqli, $id, $userid)
	{
		if (isset($_POST['line_name'])) {
			$line_name = $_POST['line_name'];
		}
		if (isset($_POST['company_id'])) {
			$company_id = $_POST['company_id'];
		}
		if (isset($_POST['branch'])) {
			$branch_id = $_POST['branch'];
		}
		if (isset($_POST['area'])) {
			$area_id = $_POST['area'];
		}
		$sub_area_id = '';
		if (isset($_POST['sub_area'])) {
			$sub_area_id = $_POST['sub_area'];
		}
		$updateQry = "UPDATE area_line_mapping set line_name='" . strip_tags($line_name) . "', area_id='" . strip_tags($area_id) . "', sub_area_id='" . strip_tags($sub_area_id) . "', 
		company_id='" . strip_tags($company_id) . "',branch_id= '" . strip_tags($branch_id) . "', update_login_id='" . strip_tags($userid) . "', 
		updated_date = current_timestamp(), status=0 WHERE map_id = '" . $id . "' ";
		$result = $mysqli->query($updateQry) or die("Error " . $mysqli->error);
	}
	// Update Area Mapping Group
	public function updateAreaMappingGroup($mysqli, $id, $userid)
	{
		if (isset($_POST['group_name'])) {
			$group_name = $_POST['group_name'];
		}
		if (isset($_POST['company_id1'])) {
			$company_id = $_POST['company_id1'];
		}
		if (isset($_POST['branch1'])) {
			$branch_id = $_POST['branch1'];
		}
		if (isset($_POST['area1'])) {
			$area_id = $_POST['area1'];
		}
		$sub_area_id = '';
		if (isset($_POST['sub_area1'])) {
			$sub_area_id = $_POST['sub_area1'];
		}
		$updateQry = "UPDATE area_group_mapping set group_name='" . strip_tags($group_name) . "', area_id='" . strip_tags($area_id) . "', sub_area_id='" . strip_tags($sub_area_id) . "', 
		company_id='" . strip_tags($company_id) . "',branch_id= '" . strip_tags($branch_id) . "', update_login_id='" . strip_tags($userid) . "', 
		updated_date	 = current_timestamp(), status=0 WHERE map_id = '" . $id . "' ";
		$result = $mysqli->query($updateQry) or die("Error " . $mysqli->error);
	}

	// Get Area Mapping
	public function getAreaMappingLine($mysqli, $id)
	{
		$selectQry = "SELECT * FROM area_line_mapping WHERE map_id='" . mysqli_real_escape_string($mysqli, $id) . "' ";
		$res = $mysqli->query($selectQry) or die("Error in Get All Records" . $mysqli->error);
		$detailrecords = array();
		if ($mysqli->affected_rows > 0) {
			$row = $res->fetch_object();
			$detailrecords['map_id']      = $row->map_id;
			$detailrecords['line_name']    = $row->line_name;
			$detailrecords['area_id']    = $row->area_id;
			$detailrecords['sub_area_id']    = $row->sub_area_id;
			$detailrecords['company_id']       = $row->company_id;
			$detailrecords['branch_id']       = $row->branch_id;
		}
		return $detailrecords;
	}
	// Get Area Mapping
	public function getAreaMappingGroup($mysqli, $id)
	{
		$selectQry = "SELECT * FROM area_group_mapping WHERE map_id='" . mysqli_real_escape_string($mysqli, $id) . "' ";
		$res = $mysqli->query($selectQry) or die("Error in Get All Records" . $mysqli->error);
		$detailrecords = array();
		if ($mysqli->affected_rows > 0) {
			$row = $res->fetch_object();
			$detailrecords['map_id']      = $row->map_id;
			$detailrecords['group_name']    = $row->group_name;
			$detailrecords['area_id']    = $row->area_id;
			$detailrecords['sub_area_id']    = $row->sub_area_id;
			$detailrecords['company_id']       = $row->company_id;
			$detailrecords['branch_id']       = $row->branch_id;
		}
		return $detailrecords;
	}

	//  Delete Area Mapping
	public function deleteAreaMappingLine($mysqli, $id, $userid)
	{
		$branchDelete = "UPDATE area_line_mapping set status='1', delete_login_id='" . strip_tags($userid) . "' WHERE map_id = '" . strip_tags($id) . "' ";
		$runQry = $mysqli->query($branchDelete) or die("Error in delete query" . $mysqli->error);
	}
	//  Delete Area Mapping
	public function deleteAreaMappingGroup($mysqli, $id, $userid)
	{
		$branchDelete = "UPDATE area_group_mapping set status='1', delete_login_id='" . strip_tags($userid) . "' WHERE map_id = '" . strip_tags($id) . "' ";
		$runQry = $mysqli->query($branchDelete) or die("Error in delete query" . $mysqli->error);
	}

	// Add Director
	public function addDirectorCreation($mysqli, $userid)
	{

		if (isset($_POST['dir_type'])) {
			$dir_type = $_POST['dir_type'];
		}
		if (isset($_POST['dir_name'])) {
			$dir_name = $_POST['dir_name'];
		}
		if (isset($_POST['dir_code'])) {
			$dir_code = $_POST['dir_code'];
		}
		if (isset($_POST['company_id'])) {
			$company_id = $_POST['company_id'];
		}
		$branch_id = '';
		if (isset($_POST['branch_id'])) {
			$branch_id = $_POST['branch_id'];
		}
		if (isset($_POST['address1'])) {
			$address1 = $_POST['address1'];
		}
		$address2 = '';
		if (isset($_POST['address2'])) {
			$address2 = $_POST['address2'];
		}
		if (isset($_POST['state'])) {
			$state = $_POST['state'];
		}
		if (isset($_POST['district1'])) {
			$district = $_POST['district1'];
		}
		if (isset($_POST['taluk1'])) {
			$taluk = $_POST['taluk1'];
		}
		if (isset($_POST['place'])) {
			$place = $_POST['place'];
		}
		if (isset($_POST['pincode'])) {
			$pincode = $_POST['pincode'];
		}
		if (isset($_POST['mailid'])) {
			$mail_id = $_POST['mailid'];
		}
		if (isset($_POST['mobile'])) {
			$mobile_no = $_POST['mobile'];
		}
		if (isset($_POST['whatsapp'])) {
			$whatsapp_no = $_POST['whatsapp'];
		}

		$insertQry = "INSERT INTO director_creation(dir_code, dir_type, dir_name,company_id,branch_id,address1, address2, state, district, taluk, place, pincode, mail_id, 
		mobile_no,whatsapp_no,insert_login_id,created_date) 
		VALUES('" . strip_tags($dir_code) . "','" . strip_tags($dir_type) . "','" . strip_tags($dir_name) . "','" . strip_tags($company_id) . "','" . strip_tags($branch_id) . "',
		'" . strip_tags($address1) . "', '" . strip_tags($address2) . "', '" . strip_tags($state) . "', '" . strip_tags($district) . "','" . strip_tags($taluk) . "', 
		'" . strip_tags($place) . "', '" . strip_tags($pincode) . "','" . strip_tags($mail_id) . "', '" . strip_tags($mobile_no) . "',
		'" . strip_tags($whatsapp_no) . "','" . strip_tags($userid) . "',current_timestamp )";

		$insresult = $mysqli->query($insertQry) or die("Error " . $mysqli->error);
	}

	// Get Company
	public function getDirectorCreation($mysqli, $id)
	{

		$trusteeSelect = "SELECT * FROM director_creation WHERE dir_id='" . mysqli_real_escape_string($mysqli, $id) . "' ";
		$res = $mysqli->query($trusteeSelect) or die("Error in Get All Records" . $mysqli->error);
		$detailrecords = array();
		if ($mysqli->affected_rows > 0) {
			$row = $res->fetch_object();
			$detailrecords['dir_id']      = $row->dir_id;
			$detailrecords['dir_code']    = $row->dir_code;
			$detailrecords['dir_name']    = $row->dir_name;
			$detailrecords['dir_type']    = $row->dir_type;
			$detailrecords['company_id']    = $row->company_id;
			$detailrecords['branch_id']    = $row->branch_id;
			$detailrecords['dir_type']    = $row->dir_type;
			$detailrecords['address1']    = $row->address1;
			$detailrecords['address2']    = $row->address2;
			$detailrecords['state']    = $row->state;
			$detailrecords['district']    = $row->district;
			$detailrecords['taluk']    = $row->taluk;
			$detailrecords['place']    = $row->place;
			$detailrecords['pincode']    = $row->pincode;
			$detailrecords['mail_id']    = $row->mail_id;
			$detailrecords['mobile_no']    = $row->mobile_no;
			$detailrecords['whatsapp_no']    = $row->whatsapp_no;
		}

		return $detailrecords;
	}

	// Update Company
	public function updateDirectorCreation($mysqli, $id, $userid)
	{

		if (isset($_POST['dir_type'])) {
			$dir_type = $_POST['dir_type'];
		}
		if (isset($_POST['dir_name'])) {
			$dir_name = $_POST['dir_name'];
		}
		if (isset($_POST['dir_code'])) {
			$dir_code = $_POST['dir_code'];
		}
		if (isset($_POST['company_id'])) {
			$company_id = $_POST['company_id'];
		}
		$branch_id = '';
		if (isset($_POST['branch_id'])) {
			$branch_id = $_POST['branch_id'];
		}
		if (isset($_POST['address1'])) {
			$address1 = $_POST['address1'];
		}
		$address2 = '';
		if (isset($_POST['address2'])) {
			$address2 = $_POST['address2'];
		}
		if (isset($_POST['state'])) {
			$state = $_POST['state'];
		}
		if (isset($_POST['district1'])) {
			$district = $_POST['district1'];
		}
		if (isset($_POST['taluk1'])) {
			$taluk = $_POST['taluk1'];
		}
		if (isset($_POST['place'])) {
			$place = $_POST['place'];
		}
		if (isset($_POST['pincode'])) {
			$pincode = $_POST['pincode'];
		}
		if (isset($_POST['mailid'])) {
			$mail_id = $_POST['mailid'];
		}
		if (isset($_POST['mobile'])) {
			$mobile_no = $_POST['mobile'];
		}
		if (isset($_POST['whatsapp'])) {
			$whatsapp_no = $_POST['whatsapp'];
		}
		$updateQry = "UPDATE director_creation SET dir_code = '" . strip_tags($dir_code) . "', dir_type = '" . strip_tags($dir_type) . "',dir_name = '" . strip_tags($dir_name) . "', 
		company_id = '" . strip_tags($company_id) . "',branch_id = '" . strip_tags($branch_id) . "',address1='" . strip_tags($address1) . "', 
		address2='" . strip_tags($address2) . "', state='" . strip_tags($state) . "', district='" . strip_tags($district) . "', taluk='" . strip_tags($taluk) . "', 
		place='" . strip_tags($place) . "', pincode='" . strip_tags($pincode) . "', mail_id='" . strip_tags($mail_id) . "', mobile_no ='" . strip_tags($mobile_no) . "',
		whatsapp_no='" . strip_tags($whatsapp_no) . "',update_login_id='" . strip_tags($userid) . "',updated_date= current_timestamp(), status = '0' WHERE dir_id= '" . strip_tags($id) . "' ";
		$updresult = $mysqli->query($updateQry) or die("Error in in update Query!." . $mysqli->error);
	}
	//  Delete Company
	public function deleteDirectorCreation($mysqli, $id, $userid)
	{
		$deleteQry = "UPDATE director_creation set status='1', update_login_id='" . strip_tags($userid) . "' WHERE dir_id  = '" . strip_tags($id) . "' ";
		$runQry = $mysqli->query($deleteQry) or die("Error in delete query" . $mysqli->error);
	}

	// Get Scheme list for Agent Creation
	public function getschemeList($mysqli)
	{

		$loanCatSelect = "SELECT * FROM loan_scheme WHERE 1 and status = 0 ";
		$res = $mysqli->query($loanCatSelect) or die("Error in Get All Records" . $mysqli->error);
		$detailrecords = array();
		if ($mysqli->affected_rows > 0) {
			$i = 0;
			while ($row = $res->fetch_object()) {
				$detailrecords[$i]['scheme_id']      = $row->scheme_id;
				$detailrecords[$i]['scheme_name']      = $row->scheme_name;
				$i++;
			}
		}
		return $detailrecords;
	}

	// Add Agent
	public function addAgentCreation($mysqli, $userid)
	{

		if (isset($_POST['ag_code'])) {
			$ag_code = $_POST['ag_code'];
		}
		if (isset($_POST['ag_name'])) {
			$ag_name = $_POST['ag_name'];
		}
		if (isset($_POST['company_id'])) {
			$company_id = $_POST['company_id'];
		}
		$branch_id = '';
		if (isset($_POST['branch_id'])) {
			$branch_id = $_POST['branch_id'];
		}
		if (isset($_POST['ag_group']) and $_POST['ag_group'] != '') {
			$ag_group = $_POST['ag_group'];
		}
		// else{
		// 	$mysqli->query("INSERT into agent_group_creation (agent_group_name) values ('".$ag_name."') ");
		// 	$ag_group = $mysqli->insert_id;
		// }
		if (isset($_POST['mail'])) {
			$mail = $_POST['mail'];
		}
		if (isset($_POST['state'])) {
			$state = $_POST['state'];
		}
		if (isset($_POST['district1'])) {
			$district = $_POST['district1'];
		}
		if (isset($_POST['taluk1'])) {
			$taluk = $_POST['taluk1'];
		}
		if (isset($_POST['place'])) {
			$place = $_POST['place'];
		}
		if (isset($_POST['pincode'])) {
			$pincode = $_POST['pincode'];
		}
		if (isset($_POST['name'])) {
			$comm_name = $_POST['name'];
		}
		if (isset($_POST['designation'])) {
			$comm_des = $_POST['designation'];
		}
		if (isset($_POST['mobile'])) {
			$comm_mobile = $_POST['mobile'];
		}
		if (isset($_POST['whatsapp'])) {
			$comm_whatsapp = $_POST['whatsapp'];
		}
		if (isset($_POST['loan_category'])) {
			$loan_category = $_POST['loan_category'];
		}
		if (isset($_POST['sub_category'])) {
			$sub_category = $_POST['sub_category'];
		}
		$scheme = '';
		if (isset($_POST['scheme'])) {
			$scheme = $_POST['scheme'];
		}
		if (isset($_POST['loan_pay'])) {
			$loan_payment = $_POST['loan_pay'];
		}
		if (isset($_POST['responsible'])) {
			$responsible = $_POST['responsible'];
		}
		if (isset($_POST['coll_point'])) {
			$collection_point = $_POST['coll_point'];
		}
		if (isset($_POST['bank_name'])) {
			$bank_name = $_POST['bank_name'];
		}
		if (isset($_POST['bank_branch_name'])) {
			$bank_branch_name = $_POST['bank_branch_name'];
		}
		if (isset($_POST['acc_no'])) {
			$acc_no = $_POST['acc_no'];
		}
		if (isset($_POST['ifsc'])) {
			$ifsc = $_POST['ifsc'];
		}
		if (isset($_POST['holder_name'])) {
			$holder_name = $_POST['holder_name'];
		}
		if (isset($_POST['more_info'])) {
			$more_info = $_POST['more_info'];
		}

		$insertQry = "INSERT INTO agent_creation(ag_code, ag_name,ag_group_id,company_id,branch_id, mail,state, district, taluk, place, pincode,loan_category,sub_category,scheme,loan_payment,
		responsible,collection_point,bank_name,bank_branch_name, acc_no,ifsc,holder_name,more_info,insert_login_id,created_date) 
		VALUES('" . strip_tags($ag_code) . "','" . strip_tags($ag_name) . "','" . strip_tags($ag_group) . "','" . strip_tags($company_id) . "','" . strip_tags($branch_id) . "','" . strip_tags($mail) . "',
		'" . strip_tags($state) . "', '" . strip_tags($district) . "','" . strip_tags($taluk) . "', 
		'" . strip_tags($place) . "', '" . strip_tags($pincode) . "','" . strip_tags($loan_category) . "', '" . strip_tags($sub_category) . "',
		'" . strip_tags($scheme) . "', '" . strip_tags($loan_payment) . "','" . strip_tags($responsible) . "', '" . strip_tags($collection_point) . "',
		'" . strip_tags($bank_name) . "', '" . strip_tags($bank_branch_name) . "','" . strip_tags($acc_no) . "', '" . strip_tags($ifsc) . "',
		'" . strip_tags($holder_name) . "', '" . strip_tags($more_info) . "','" . strip_tags($userid) . "',current_timestamp )";
		$insresult = $mysqli->query($insertQry) or die("Error " . $mysqli->error);
		$agent_reff = $mysqli->insert_id;

		for ($i = 0; $i <= sizeof($comm_name) - 1; $i++) {
			$mysqli->query("INSERT INTO agent_communication_details (agent_reff_id, name,designation,mobile,whatsapp) 
			VALUES('" . $agent_reff . "', '" . $comm_name[$i] . "' , '" . $comm_des[$i] . "' , '" . $comm_mobile[$i] . "', '" . $comm_whatsapp[$i] . "')");
		}
	}

	// Get Agent
	public function getAgentCreation($mysqli, $id)
	{

		$selectQry = "SELECT * FROM agent_creation WHERE ag_id='" . mysqli_real_escape_string($mysqli, $id) . "' ";
		$res = $mysqli->query($selectQry) or die("Error in Get All Records" . $mysqli->error);
		$detailrecords = array();
		if ($mysqli->affected_rows > 0) {
			$row = $res->fetch_object();
			$detailrecords['ag_id']      = $row->ag_id;
			$detailrecords['ag_code']    = $row->ag_code;
			$detailrecords['ag_name']    = $row->ag_name;
			$detailrecords['ag_group']    = $row->ag_group_id;
			$detailrecords['company_id']    = $row->company_id;
			$detailrecords['branch_id']    = $row->branch_id;
			$detailrecords['mail']    = $row->mail;
			$detailrecords['state']    = $row->state;
			$detailrecords['district']    = $row->district;
			$detailrecords['taluk']    = $row->taluk;
			$detailrecords['place']    = $row->place;
			$detailrecords['pincode']    = $row->pincode;
			$detailrecords['loan_category']    = $row->loan_category;
			$detailrecords['sub_category']    = $row->sub_category;
			$detailrecords['scheme']    = $row->scheme;
			$detailrecords['loan_payment']    = $row->loan_payment;
			$detailrecords['responsible']    = $row->responsible;
			$detailrecords['collection_point']    = $row->collection_point;
			$detailrecords['bank_name']    = $row->bank_name;
			$detailrecords['holder_name']    = $row->holder_name;
			$detailrecords['acc_no']    = $row->acc_no;
			$detailrecords['ifsc']    = $row->ifsc;
			$detailrecords['bank_branch_name']    = $row->bank_branch_name;
			$detailrecords['more_info']    = $row->more_info;
		}
		$selectQry = "SELECT * FROM agent_communication_details WHERE agent_reff_id='" . mysqli_real_escape_string($mysqli, $id) . "' ";
		$res1 = $mysqli->query($selectQry) or die("Error in Get All Records" . $mysqli->error);
		if ($mysqli->affected_rows > 0) {
			while ($row1 = $res1->fetch_object()) {

				$comm_id1         		= $row1->comm_id;
				$comm_id[]     			= $row1->comm_id;
				$agent_reff_id[]     			= $row1->agent_reff_id;
				$comm_name[]             = $row1->name;
				$comm_designation[]             = $row1->designation;
				$comm_mobile[]             = $row1->mobile;
				$comm_whatsapp[]             = $row1->whatsapp;
			}
		}
		if ($comm_id1 > 0) {
			$detailrecords['agent_reff_id']        = $agent_reff_id;
			$detailrecords['comm_name']      = $comm_name;
			$detailrecords['comm_designation']      = $comm_designation;
			$detailrecords['comm_mobile']      = $comm_mobile;
			$detailrecords['comm_whatsapp']      = $comm_whatsapp;
		} else {
			$detailrecords['agent_reff_id']        = array();
			$detailrecords['comm_name']      = array();
			$detailrecords['comm_designation']      = array();
			$detailrecords['comm_mobile']      = array();
			$detailrecords['comm_whatsapp']      = array();
		}

		return $detailrecords;
	}

	// Update Agent
	public function updateAgentCreation($mysqli, $id, $userid)
	{

		if (isset($_POST['ag_code'])) {
			$ag_code = $_POST['ag_code'];
		}
		if (isset($_POST['ag_name'])) {
			$ag_name = $_POST['ag_name'];
		}
		if (isset($_POST['ag_group']) and $_POST['ag_group'] != '') {
			$ag_group = $_POST['ag_group'];
		}
		// else{
		// 	$mysqli->query("INSERT into agent_group_creation (agent_group_name) values ('".$ag_name."') ");
		// 	$ag_group = $mysqli->insert_id;
		// }
		if (isset($_POST['company_id'])) {
			$company_id = $_POST['company_id'];
		}
		$branch_id = '';
		if (isset($_POST['branch_id'])) {
			$branch_id = $_POST['branch_id'];
		}
		if (isset($_POST['mail'])) {
			$mail = $_POST['mail'];
		}
		if (isset($_POST['state'])) {
			$state = $_POST['state'];
		}
		if (isset($_POST['district1'])) {
			$district = $_POST['district1'];
		}
		if (isset($_POST['taluk1'])) {
			$taluk = $_POST['taluk1'];
		}
		if (isset($_POST['place'])) {
			$place = $_POST['place'];
		}
		if (isset($_POST['pincode'])) {
			$pincode = $_POST['pincode'];
		}
		if (isset($_POST['name'])) {
			$comm_name = $_POST['name'];
		}
		if (isset($_POST['designation'])) {
			$comm_des = $_POST['designation'];
		}
		if (isset($_POST['mobile'])) {
			$comm_mobile = $_POST['mobile'];
		}
		if (isset($_POST['whatsapp'])) {
			$comm_whatsapp = $_POST['whatsapp'];
		}
		if (isset($_POST['loan_category'])) {
			$loan_category = $_POST['loan_category'];
		}
		if (isset($_POST['sub_category'])) {
			$sub_category = $_POST['sub_category'];
		}
		$scheme = '';
		if (isset($_POST['scheme'])) {
			$scheme = $_POST['scheme'];
		}
		if (isset($_POST['loan_pay'])) {
			$loan_payment = $_POST['loan_pay'];
		}
		if (isset($_POST['responsible'])) {
			$responsible = $_POST['responsible'];
		}
		if (isset($_POST['coll_point'])) {
			$collection_point = $_POST['coll_point'];
		}
		if (isset($_POST['bank_name'])) {
			$bank_name = $_POST['bank_name'];
		}
		if (isset($_POST['bank_branch_name'])) {
			$bank_branch_name = $_POST['bank_branch_name'];
		}
		if (isset($_POST['acc_no'])) {
			$acc_no = $_POST['acc_no'];
		}
		if (isset($_POST['ifsc'])) {
			$ifsc = $_POST['ifsc'];
		}
		if (isset($_POST['holder_name'])) {
			$holder_name = $_POST['holder_name'];
		}
		if (isset($_POST['more_info'])) {
			$more_info = $_POST['more_info'];
		}

		$mysqli->query("DELETE FROM agent_communication_details where agent_reff_id = '" . strip_tags($id) . "' ");

		$updateQry = "UPDATE agent_creation SET ag_code = '" . strip_tags($ag_code) . "', ag_name = '" . strip_tags($ag_name) . "',ag_group_id = '" . strip_tags($ag_group) . "', 
		company_id = '" . strip_tags($company_id) . "',branch_id = '" . strip_tags($branch_id) . "',mail='" . strip_tags($mail) . "',
		state='" . strip_tags($state) . "', district='" . strip_tags($district) . "', taluk='" . strip_tags($taluk) . "', place='" . strip_tags($place) . "', 
		pincode='" . strip_tags($pincode) . "',loan_category='" . strip_tags($loan_category) . "', sub_category='" . strip_tags($sub_category) . "', scheme ='" . strip_tags($scheme) . "',
		loan_payment='" . strip_tags($loan_payment) . "',responsible='" . strip_tags($responsible) . "',collection_point='" . strip_tags($collection_point) . "',
		bank_name='" . strip_tags($bank_name) . "',acc_no='" . strip_tags($acc_no) . "',ifsc='" . strip_tags($ifsc) . "',bank_branch_name='" . strip_tags($bank_branch_name) . "',holder_name='" . strip_tags($holder_name) . "',
		more_info='" . strip_tags($more_info) . "',status=0,update_login_id='" . strip_tags($userid) . "',updated_date= current_timestamp(), status = '0' WHERE ag_id= '" . strip_tags($id) . "' ";
		$updresult = $mysqli->query($updateQry) or die("Error in in update Query!." . $mysqli->error);

		for ($i = 0; $i <= sizeof($comm_name) - 1; $i++) {
			$mysqli->query("INSERT INTO agent_communication_details (agent_reff_id, name,designation,mobile,whatsapp) 
			VALUES('" . $id . "', '" . $comm_name[$i] . "' , '" . $comm_des[$i] . "' , '" . $comm_mobile[$i] . "', '" . $comm_whatsapp[$i] . "')");
		}
	}
	//  Delete Agent
	public function deleteAgentCreation($mysqli, $id, $userid)
	{
		$deleteQry = "UPDATE agent_creation set status='1', delete_login_id='" . strip_tags($userid) . "' WHERE ag_id  = '" . strip_tags($id) . "' ";
		$runQry = $mysqli->query($deleteQry) or die("Error in delete query" . $mysqli->error);
	}


	// Add Staff
	public function addStaffCreation($mysqli, $userid)
	{

		if (isset($_POST['staff_code'])) {
			$staff_code = $_POST['staff_code'];
		}
		if (isset($_POST['staff_name'])) {
			$staff_name = $_POST['staff_name'];
		}
		if (isset($_POST['staff_type'])) {
			$staff_type = $_POST['staff_type'];
		}
		if (isset($_POST['address'])) {
			$address = $_POST['address'];
		}
		if (isset($_POST['state'])) {
			$state = $_POST['state'];
		}
		if (isset($_POST['district1'])) {
			$district = $_POST['district1'];
		}
		if (isset($_POST['taluk1'])) {
			$taluk = $_POST['taluk1'];
		}
		if (isset($_POST['place'])) {
			$place = $_POST['place'];
		}
		if (isset($_POST['pincode'])) {
			$pincode = $_POST['pincode'];
		}
		if (isset($_POST['mail'])) {
			$mail = $_POST['mail'];
		}
		if (isset($_POST['mobile1'])) {
			$mobile1 = $_POST['mobile1'];
		}
		if (isset($_POST['mobile2'])) {
			$mobile2 = $_POST['mobile2'];
		}
		if (isset($_POST['whatsapp'])) {
			$whatsapp = $_POST['whatsapp'];
		}
		if (isset($_POST['cug_no'])) {
			$cug_no = $_POST['cug_no'];
		}
		if (isset($_POST['company_id'])) {
			$company_id = $_POST['company_id'];
		}
		if (isset($_POST['department'])) {
			$department = $_POST['department'];
		}
		if (isset($_POST['team'])) {
			$team = $_POST['team'];
		}
		if (isset($_POST['designation'])) {
			$designation = $_POST['designation'];
		}
		$insertQry = "INSERT INTO staff_creation(`staff_code`, `staff_name`, `staff_type`, `address`, `state`, `district`, `taluk`, `place`, `pincode`, `mail`, 
		`mobile1`, `mobile2`, `whatsapp`, `cug_no`, `company_id`, `department`, `team`, `designation`, `insert_login_id`,`created_date`) 
		VALUES('" . strip_tags($staff_code) . "','" . strip_tags($staff_name) . "','" . strip_tags($staff_type) . "','" . strip_tags($address) . "','" . strip_tags($state) . "',
		'" . strip_tags($district) . "','" . strip_tags($taluk) . "','" . strip_tags($place) . "', '" . strip_tags($pincode) . "',
		'" . strip_tags($mail) . "', '" . strip_tags($mobile1) . "','" . strip_tags($mobile2) . "','" . strip_tags($whatsapp) . "','" . strip_tags($cug_no) . "',
		'" . strip_tags($company_id) . "','" . strip_tags($department) . "','" . strip_tags($team) . "','" . strip_tags($designation) . "','" . strip_tags($userid) . "',current_timestamp )";

		$insresult = $mysqli->query($insertQry) or die("Error " . $mysqli->error);
	}

	// Get Staff
	public function getStaffCreation($mysqli, $id)
	{

		$selectQry = "SELECT * FROM staff_creation WHERE staff_id='" . mysqli_real_escape_string($mysqli, $id) . "' ";
		$res = $mysqli->query($selectQry) or die("Error in Get All Records" . $mysqli->error);
		$detailrecords = array();
		if ($mysqli->affected_rows > 0) {
			$row = $res->fetch_object();
			$detailrecords['staff_id']      = $row->staff_id;
			$detailrecords['staff_code']    = $row->staff_code;
			$detailrecords['staff_name']    = $row->staff_name;
			$detailrecords['staff_type']    = $row->staff_type;
			$detailrecords['address']    = $row->address;
			$detailrecords['state']    = $row->state;
			$detailrecords['district']    = $row->district;
			$detailrecords['taluk']    = $row->taluk;
			$detailrecords['place']    = $row->place;
			$detailrecords['pincode']    = $row->pincode;
			$detailrecords['mail']    = $row->mail;
			$detailrecords['mobile1']    = $row->mobile1;
			$detailrecords['mobile2']    = $row->mobile2;
			$detailrecords['whatsapp']    = $row->whatsapp;
			$detailrecords['cug_no']    = $row->cug_no;
			$detailrecords['company_id']    = $row->company_id;
			$detailrecords['department']    = $row->department;
			$detailrecords['team']    = $row->team;
			$detailrecords['designation']    = $row->designation;
		}

		return $detailrecords;
	}

	// Update Company
	public function updateStaffCreation($mysqli, $id, $userid)
	{

		if (isset($_POST['staff_code'])) {
			$staff_code = $_POST['staff_code'];
		}
		if (isset($_POST['staff_name'])) {
			$staff_name = $_POST['staff_name'];
		}
		if (isset($_POST['staff_type'])) {
			$staff_type = $_POST['staff_type'];
		}
		if (isset($_POST['address'])) {
			$address = $_POST['address'];
		}
		if (isset($_POST['state'])) {
			$state = $_POST['state'];
		}
		if (isset($_POST['district1'])) {
			$district = $_POST['district1'];
		}
		if (isset($_POST['taluk1'])) {
			$taluk = $_POST['taluk1'];
		}
		if (isset($_POST['place'])) {
			$place = $_POST['place'];
		}
		if (isset($_POST['pincode'])) {
			$pincode = $_POST['pincode'];
		}
		if (isset($_POST['mail'])) {
			$mail = $_POST['mail'];
		}
		if (isset($_POST['mobile1'])) {
			$mobile1 = $_POST['mobile1'];
		}
		if (isset($_POST['mobile2'])) {
			$mobile2 = $_POST['mobile2'];
		}
		if (isset($_POST['whatsapp'])) {
			$whatsapp = $_POST['whatsapp'];
		}
		if (isset($_POST['cug_no'])) {
			$cug_no = $_POST['cug_no'];
		}
		if (isset($_POST['company_id'])) {
			$company_id = $_POST['company_id'];
		}
		if (isset($_POST['department'])) {
			$department = $_POST['department'];
		}
		if (isset($_POST['team'])) {
			$team = $_POST['team'];
		}
		if (isset($_POST['designation'])) {
			$designation = $_POST['designation'];
		}
		$updateQry = "UPDATE staff_creation SET staff_code = '" . strip_tags($staff_code) . "', staff_name = '" . strip_tags($staff_name) . "',staff_type = '" . strip_tags($staff_type) . "', 
		address = '" . strip_tags($address) . "',state='" . strip_tags($state) . "', district='" . strip_tags($district) . "', taluk='" . strip_tags($taluk) . "', 
		place='" . strip_tags($place) . "', pincode='" . strip_tags($pincode) . "', mail='" . strip_tags($mail) . "', mobile1 ='" . strip_tags($mobile1) . "',mobile2='" . strip_tags($mobile2) . "',
		whatsapp='" . strip_tags($whatsapp) . "',cug_no='" . strip_tags($cug_no) . "',company_id='" . strip_tags($company_id) . "',department='" . strip_tags($department) . "',
		team='" . strip_tags($team) . "',designation='" . strip_tags($designation) . "',update_login_id='" . strip_tags($userid) . "',updated_date= current_timestamp(), 
		status = '0' WHERE staff_id= '" . strip_tags($id) . "' ";
		$updresult = $mysqli->query($updateQry) or die("Error in in update Query!." . $mysqli->error);
	}
	//  Delete Company
	public function deleteStaffCreation($mysqli, $id, $userid)
	{
		$deleteQry = "UPDATE staff_creation set status='1', update_login_id='" . strip_tags($userid) . "' WHERE staff_id  = '" . strip_tags($id) . "' ";
		$runQry = $mysqli->query($deleteQry) or die("Error in delete query" . $mysqli->error);
	}

	// Get Scheme list for Agent Creation
	public function getagentNameList($mysqli)
	{
		$selectQry = "SELECT * FROM agent_creation WHERE 1 and status = 0 ";
		$res = $mysqli->query($selectQry) or die("Error in Get All Records" . $mysqli->error);
		$detailrecords = array();
		if ($mysqli->affected_rows > 0) {
			$i = 0;
			while ($row = $res->fetch_object()) {
				$detailrecords[$i]['ag_id']      = $row->ag_id;
				$detailrecords[$i]['ag_name']      = $row->ag_name;
				$i++;
			}
		}
		return $detailrecords;
	}

	// Add User
	public function addUser($mysqli, $userid)
	{
		if (isset($_POST['role'])) {
			$role = $_POST['role'];
		}
		if (isset($_POST['role_type'])) {
			$role_type = $_POST['role_type'];
		}
		$ag_name = '';
		if (isset($_POST['ag_name'])) {
			$ag_name = $_POST['ag_name'];
		}
		$dir_name = '';
		if (isset($_POST['dir_name'])) {
			$dir_name = $_POST['dir_name'];
		}
		$staff_name = '';
		if (isset($_POST['staff_name'])) {
			$staff_name = $_POST['staff_name'];
		}
		if (isset($_POST['full_name'])) {
			$full_name = $_POST['full_name'];
		}
		if (isset($_POST['email'])) {
			$email = $_POST['email'];
		}
		if (isset($_POST['user_id'])) {
			$user_name = $_POST['user_id'];
		}
		if (isset($_POST['password'])) {
			$user_password = $_POST['password'];
		}
		if (isset($_POST['company_id'])) {
			$company_id = $_POST['company_id'];
		}
		if (isset($_POST['branch_id'])) {
			$branch_id = $_POST['branch_id'];
		}
		$loan_cat = '';
		if (isset($_POST['loan_cat'])) {
			$loan_cat = $_POST['loan_cat'];
		}
		$agentforstaff = '';
		if (isset($_POST['agentforstaff'])) {
			$agentforstaff = $_POST['agentforstaff'];
		}
		$line = '';
		if (isset($_POST['line'])) {
			$line = $_POST['line'];
		}
		$group = '';
		if (isset($_POST['group'])) {
			$group = $_POST['group'];
		}
		$download_access = '1';
		if (isset($_POST['download_access'])) {
			$download_access = $_POST['download_access'];
		}
		if (isset($_POST['mastermodule']) &&    $_POST['mastermodule'] == 'Yes') {
			$mastermodule = 0;
		} else {
			$mastermodule = 1;
		}
		if (isset($_POST['company_creation']) &&    $_POST['company_creation'] == 'Yes') {
			$company_creation = 0;
		} else {
			$company_creation = 1;
		}
		if (isset($_POST['branch_creation']) &&    $_POST['branch_creation'] == 'Yes') {
			$branch_creation = 0;
		} else {
			$branch_creation = 1;
		}
		if (isset($_POST['loan_category']) &&    $_POST['loan_category'] == 'Yes') {
			$loan_category = 0;
		} else {
			$loan_category = 1;
		}
		if (isset($_POST['loan_calculation']) &&    $_POST['loan_calculation'] == 'Yes') {
			$loan_calculation = 0;
		} else {
			$loan_calculation = 1;
		}
		if (isset($_POST['loan_scheme']) &&    $_POST['loan_scheme'] == 'Yes') {
			$loan_scheme = 0;
		} else {
			$loan_scheme = 1;
		}
		if (isset($_POST['area_creation']) &&    $_POST['area_creation'] == 'Yes') {
			$area_creation = 0;
		} else {
			$area_creation = 1;
		}
		if (isset($_POST['area_mapping']) &&    $_POST['area_mapping'] == 'Yes') {
			$area_mapping = 0;
		} else {
			$area_mapping = 1;
		}
		if (isset($_POST['area_status']) &&    $_POST['area_status'] == 'Yes') {
			$area_approval = 0;
		} else {
			$area_approval = 1;
		}
		if (isset($_POST['adminmodule']) &&    $_POST['adminmodule'] == 'Yes') {
			$adminmodule = 0;
		} else {
			$adminmodule = 1;
		}
		if (isset($_POST['director_creation']) &&    $_POST['director_creation'] == 'Yes') {
			$director_creation = 0;
		} else {
			$director_creation = 1;
		}
		if (isset($_POST['agent_creation']) &&    $_POST['agent_creation'] == 'Yes') {
			$agent_creation = 0;
		} else {
			$agent_creation = 1;
		}
		if (isset($_POST['staff_creation']) &&    $_POST['staff_creation'] == 'Yes') {
			$staff_creation = 0;
		} else {
			$staff_creation = 1;
		}
		if (isset($_POST['manage_user']) &&    $_POST['manage_user'] == 'Yes') {
			$manage_user = 0;
		} else {
			$manage_user = 1;
		}
		if (isset($_POST['doc_mapping']) &&    $_POST['doc_mapping'] == 'Yes') {
			$doc_mapping = 0;
		} else {
			$doc_mapping = 1;
		}
		if (isset($_POST['bank_creation']) &&    $_POST['bank_creation'] == 'Yes') {
			$bank_creation = 0;
		} else {
			$bank_creation = 1;
		}
		if (isset($_POST['requestmodule']) &&    $_POST['requestmodule'] == 'Yes') {
			$requestmodule = 0;
		} else {
			$requestmodule = 1;
		}
		if (isset($_POST['request']) &&    $_POST['request'] == 'Yes') {
			$request = 0;
		} else {
			$request = 1;
		}
		if (isset($_POST['request_list_access']) &&    $_POST['request_list_access'] == 'Yes') {
			$request_list_access = 0;
		} else {
			$request_list_access = 1;
		}
		if (isset($_POST['verificationmodule']) &&    $_POST['verificationmodule'] == 'Yes') {
			$verificationmodule = 0;
		} else {
			$verificationmodule = 1;
		}
		if (isset($_POST['verification']) &&    $_POST['verification'] == 'Yes') {
			$verification = 0;
		} else {
			$verification = 1;
		}
		if (isset($_POST['approvalmodule']) &&    $_POST['approvalmodule'] == 'Yes') {
			$approvalmodule = 0;
		} else {
			$approvalmodule = 1;
		}
		if (isset($_POST['approval']) &&    $_POST['approval'] == 'Yes') {
			$approval = 0;
		} else {
			$approval = 1;
		}
		if (isset($_POST['acknowledgementmodule']) &&    $_POST['acknowledgementmodule'] == 'Yes') {
			$acknowledgementmodule = 0;
		} else {
			$acknowledgementmodule = 1;
		}
		if (isset($_POST['acknowledgement']) &&    $_POST['acknowledgement'] == 'Yes') {
			$acknowledgement = 0;
		} else {
			$acknowledgement = 1;
		}
		if (isset($_POST['loanissuemodule']) &&    $_POST['loanissuemodule'] == 'Yes') {
			$loanissuemodule = 0;
		} else {
			$loanissuemodule = 1;
		}
		if (isset($_POST['loan_issue']) &&    $_POST['loan_issue'] == 'Yes') {
			$loan_issue = 0;
		} else {
			$loan_issue = 1;
		}
		if (isset($_POST['collectionmodule']) &&    $_POST['collectionmodule'] == 'Yes') {
			$collectionmodule = 0;
		} else {
			$collectionmodule = 1;
		}
		if (isset($_POST['collection']) &&    $_POST['collection'] == 'Yes') {
			$collection = 0;
		} else {
			$collection = 1;
		}
		if (isset($_POST['collection_access']) &&    $_POST['collection_access'] == 'Yes') {
			$collection_access = 0;
		} else {
			$collection_access = 1;
		}
		if (isset($_POST['closedmodule']) &&    $_POST['closedmodule'] == 'Yes') {
			$closedmodule = 0;
		} else {
			$closedmodule = 1;
		}
		if (isset($_POST['closed']) &&    $_POST['closed'] == 'Yes') {
			$closed = 0;
		} else {
			$closed = 1;
		}
		if (isset($_POST['nocmodule']) &&    $_POST['nocmodule'] == 'Yes') {
			$nocmodule = 0;
		} else {
			$nocmodule = 1;
		}
		if (isset($_POST['noc']) &&    $_POST['noc'] == 'Yes') {
			$noc = 0;
		} else {
			$noc = 1;
		}
		if (isset($_POST['doctrackmodule']) &&    $_POST['doctrackmodule'] == 'Yes') {
			$doctrackmodule = 0;
		} else {
			$doctrackmodule = 1;
		}
		if (isset($_POST['doctrack']) &&    $_POST['doctrack'] == 'Yes') {
			$doctrack = 0;
		} else {
			$doctrack = 1;
		}
		if (isset($_POST['doc_rec_access']) &&    $_POST['doc_rec_access'] == 'Yes') {
			$doc_rec_access = 0;
		} else {
			$doc_rec_access = 1;
		}
		if (isset($_POST['updatemodule']) &&    $_POST['updatemodule'] == 'Yes') {
			$updatemodule = 0;
		} else {
			$updatemodule = 1;
		}
		if (isset($_POST['update']) &&    $_POST['update'] == 'Yes') {
			$update_screen = 0;
		} else {
			$update_screen = 1;
		}
		if (isset($_POST['concernmodule']) &&    $_POST['concernmodule'] == 'Yes') {
			$concernmodule = 0;
		} else {
			$concernmodule = 1;
		}
		if (isset($_POST['concernCreation']) &&    $_POST['concernCreation'] == 'Yes') {
			$concernCreation = 0;
		} else {
			$concernCreation = 1;
		}
		if (isset($_POST['concernSolution']) &&    $_POST['concernSolution'] == 'Yes') {
			$concernSolution = 0;
		} else {
			$concernSolution = 1;
		}
		if (isset($_POST['concernFeedback']) &&    $_POST['concernFeedback'] == 'Yes') {
			$concernFeedback = 0;
		} else {
			$concernFeedback = 1;
		}
		if (isset($_POST['accountsmodule']) &&    $_POST['accountsmodule'] == 'Yes') {
			$accountsmodule = 0;
		} else {
			$accountsmodule = 1;
		}
		if (isset($_POST['cash_tally']) &&    $_POST['cash_tally'] == 'Yes') {
			$cash_tally = 0;
		} else {
			$cash_tally = 1;
		}
		if (isset($_POST['cash_tally_admin']) &&    $_POST['cash_tally_admin'] == 'Yes') {
			$cash_tally_admin = 0;
		} else {
			$cash_tally_admin = 1;
		}
		if (isset($_POST['bank_details'])) {
			$bank_details = $_POST['bank_details'];
		}
		if (isset($_POST['bank_clearance']) &&    $_POST['bank_clearance'] == 'Yes') {
			$bank_clearance = 0;
		} else {
			$bank_clearance = 1;
		}
		if (isset($_POST['finance_insight']) &&    $_POST['finance_insight'] == 'Yes') {
			$finance_insight = 0;
		} else {
			$finance_insight = 1;
		}
		if (isset($_POST['followupmodule']) &&    $_POST['followupmodule'] == 'Yes') {
			$followupmodule = 0;
		} else {
			$followupmodule = 1;
		}
		if (isset($_POST['promotion_activity']) &&    $_POST['promotion_activity'] == 'Yes') {
			$promotion_activity = 0;
		} else {
			$promotion_activity = 1;
		}
		if (isset($_POST['loan_followup']) &&    $_POST['loan_followup'] == 'Yes') {
			$loan_followup = 0;
		} else {
			$loan_followup = 1;
		}
		if (isset($_POST['conf_followup']) &&    $_POST['conf_followup'] == 'Yes') {
			$conf_followup = 0;
		} else {
			$conf_followup = 1;
		}
		if (isset($_POST['due_followup']) &&    $_POST['due_followup'] == 'Yes') {
			$due_followup = 0;
		} else {
			$due_followup = 1;
		}
		if (isset($_POST['reportmodule']) &&    $_POST['reportmodule'] == 'Yes') {
			$reportmodule = 0;
		} else {
			$reportmodule = 1;
		}
		if (isset($_POST['ledger_report']) &&    $_POST['ledger_report'] == 'Yes') {
			$ledger_report = 0;
		} else {
			$ledger_report = 1;
		}
		if (isset($_POST['request_report']) &&    $_POST['request_report'] == 'Yes') {
			$request_report = 0;
		} else {
			$request_report = 1;
		}
		if (isset($_POST['cus_profile_report']) &&    $_POST['cus_profile_report'] == 'Yes') {
			$cus_profile_report = 0;
		} else {
			$cus_profile_report = 1;
		}
		if (isset($_POST['loan_issue_report']) &&    $_POST['loan_issue_report'] == 'Yes') {
			$loan_issue_report = 0;
		} else {
			$loan_issue_report = 1;
		}
		if (isset($_POST['collection_report']) &&    $_POST['collection_report'] == 'Yes') {
			$collection_report = 0;
		} else {
			$collection_report = 1;
		}
		if (isset($_POST['balance_report']) &&    $_POST['balance_report'] == 'Yes') {
			$balance_report = 0;
		} else {
			$balance_report = 1;
		}
		if (isset($_POST['due_list_report']) &&    $_POST['due_list_report'] == 'Yes') {
			$due_list_report = 0;
		} else {
			$due_list_report = 1;
		}
		if (isset($_POST['closed_report']) &&    $_POST['closed_report'] == 'Yes') {
			$closed_report = 0;
		} else {
			$closed_report = 1;
		}
		if (isset($_POST['agent_report']) &&    $_POST['agent_report'] == 'Yes') {
			$agent_report = 0;
		} else {
			$agent_report = 1;
		}
		if (isset($_POST['searchmodule']) &&    $_POST['searchmodule'] == 'Yes') {
			$searchmodule = 0;
		} else {
			$searchmodule = 1;
		}
		if (isset($_POST['search_screen']) &&    $_POST['search_screen'] == 'Yes') {
			$search_screen = 0;
		} else {
			$search_screen = 1;
		}
		if (isset($_POST['bulk_upload_module']) &&    $_POST['bulk_upload_module'] == 'Yes') {
			$bulk_upload_module = 0;
		} else {
			$bulk_upload_module = 1;
		}
		if (isset($_POST['bulk_upload']) &&    $_POST['bulk_upload'] == 'Yes') {
			$bulk_upload = 0;
		} else {
			$bulk_upload = 1;
		}
		if (isset($_POST['loan_track_module']) &&    $_POST['loan_track_module'] == 'Yes') {
			$loan_track_module = 0;
		} else {
			$loan_track_module = 1;
		}
		if (isset($_POST['loan_track']) &&    $_POST['loan_track'] == 'Yes') {
			$loan_track = 0;
		} else {
			$loan_track = 1;
		}
		if (isset($_POST['sms_module']) &&    $_POST['sms_module'] == 'Yes') {
			$sms_module = 0;
		} else {
			$sms_module = 1;
		}
		if (isset($_POST['sms_generation']) &&    $_POST['sms_generation'] == 'Yes') {
			$sms_generation = 0;
		} else {
			$sms_generation = 1;
		}
		$insertQry = "INSERT INTO user(`fullname`,`emailid`, `user_name`, `user_password`, `role`, `role_type`, `dir_id`,
        `ag_id`, `staff_id`, `company_id`, `branch_id`,`loan_cat`, `agentforstaff`,`line_id`, `group_id`,`download_access`, `mastermodule`, `company_creation`, `branch_creation`, `loan_category`, `loan_calculation`,
        `loan_scheme`, `area_creation`, `area_mapping`, `area_approval`, `adminmodule`, `director_creation`, `agent_creation`, `staff_creation`, `manage_user`,`doc_mapping`,`bank_creation`,`requestmodule`,
        `request`,`request_list_access`,`verificationmodule`,`verification`,`approvalmodule`,`approval`,`acknowledgementmodule`,`acknowledgement`,`loanissuemodule`,`loan_issue`,
		`collectionmodule`,`collection`,`collection_access`,`closedmodule`,`closed`,`nocmodule`,`noc`,
		`doctrackmodule`,`doctrack`,`doc_rec_access`,`updatemodule`,`update_screen`,`concernmodule`, `concern_creation`, `concern_solution`,`concern_feedback`,
		`accountsmodule`,`cash_tally`,`cash_tally_admin`,`bank_details`,`bank_clearance`,`finance_insight`,
		`followupmodule`, `promotion_activity`, `loan_followup`, `confirmation_followup`, `due_followup`, `reportmodule`, `ledger_report`, 
		`request_report`, `cus_profile_report`, `loan_issue_report`, `collection_report`, `balance_report`, `due_list_report`, `closed_report`, `agent_report`,
		`search_module`,`search`,`bulk_upload_module`, `bulk_upload`, `loan_track_module`, `loan_track`,`sms_module`,`sms_generation`,`insert_login_id`,`created_date`)
        VALUES('" . strip_tags($full_name) . "','" . strip_tags($email) . "','" . strip_tags($user_name) . "','" . strip_tags($user_password) . "','" . strip_tags($role) . "',
        '" . strip_tags($role_type) . "','" . strip_tags($dir_name) . "','" . strip_tags($ag_name) . "','" . strip_tags($staff_name) . "','" . strip_tags($company_id) . "',
        '" . strip_tags($branch_id) . "','" . strip_tags($loan_cat) . "','" . strip_tags($agentforstaff) . "','" . strip_tags($line) . "','" . strip_tags($group) . "',
		'" . strip_tags($download_access) . "', '" . strip_tags($mastermodule) . "','" . strip_tags($company_creation) . "',
        '" . strip_tags($branch_creation) . "','" . strip_tags($loan_category) . "','" . strip_tags($loan_calculation) . "','" . strip_tags($loan_scheme) . "','" . strip_tags($area_creation) . "',
        '" . strip_tags($area_mapping) . "','" . strip_tags($area_approval) . "','" . strip_tags($adminmodule) . "','" . strip_tags($director_creation) . "',
        '" . strip_tags($agent_creation) . "','" . strip_tags($staff_creation) . "','" . strip_tags($manage_user) . "','" . strip_tags($doc_mapping) . "','" . strip_tags($bank_creation) . "','" . strip_tags($requestmodule) . "','" . strip_tags($request) . "',
        '" . strip_tags($request_list_access) . "','" . strip_tags($verificationmodule) . "','" . strip_tags($verification) . "','" . strip_tags($approvalmodule) . "','" . strip_tags($approval) . "',
        '" . strip_tags($acknowledgementmodule) . "','" . strip_tags($acknowledgement) . "','" . strip_tags($loanissuemodule) . "','" . strip_tags($loan_issue) . "',
		'" . strip_tags($collectionmodule) . "','" . strip_tags($collection) . "','" . strip_tags($collection_access) . "','" . strip_tags($closedmodule) . "','" . strip_tags($closed) . "',
		'" . strip_tags($nocmodule) . "','" . strip_tags($noc) . "','" . strip_tags($doctrackmodule) . "','" . strip_tags($doctrack) . "','" . strip_tags($doc_rec_access) . "','" . strip_tags($updatemodule) . "','" . strip_tags($update_screen) . "','" . strip_tags($concernmodule) . "','" . strip_tags($concernCreation) . "','" . strip_tags($concernSolution) . "','" . strip_tags($concernFeedback) . "',
		'" . strip_tags($accountsmodule) . "','" . strip_tags($cash_tally) . "','" . strip_tags($cash_tally_admin) . "','" . strip_tags($bank_details) . "','" . strip_tags($bank_clearance) . "','" . strip_tags($finance_insight) . "',
		'" . strip_tags($followupmodule) . "','" . strip_tags($promotion_activity) . "','" . strip_tags($loan_followup) . "','" . strip_tags($conf_followup) . "','" . strip_tags($due_followup) .
			"',
		'" . strip_tags($reportmodule) . "', '" . strip_tags($ledger_report) . "', '" . strip_tags($request_report) . "', '" . strip_tags($cus_profile_report) . "', '" . strip_tags($loan_issue_report) .
			"',
		'" . strip_tags($collection_report) . "', '" . strip_tags($balance_report) . "', '" . strip_tags($due_list_report) . "', '" . strip_tags($closed_report) . "', '" . strip_tags($agent_report) . "',
		'" . strip_tags($searchmodule) . "', '" . strip_tags($search_screen) . "','" . strip_tags($bulk_upload_module) . "', '" . strip_tags($bulk_upload) . "',
		'" . strip_tags($loan_track_module) . "', '" . strip_tags($loan_track) . "','" . strip_tags($sms_module) . "','" . strip_tags($sms_generation) . "','" . strip_tags($userid) . "',now() )";
		// echo $insertQry;die;
		$insresult = $mysqli->query($insertQry) or die("Error " . $mysqli->error);
	}

	//Update Manage User
	function updateUser($mysqli, $id, $user_id)
	{
		if (isset($_POST['role'])) {
			$role = $_POST['role'];
		}
		if (isset($_POST['role_type'])) {
			$role_type = $_POST['role_type'];
		}
		$ag_name = '';
		if (isset($_POST['ag_name'])) {
			$ag_name = $_POST['ag_name'];
		}
		$dir_name = '';
		if (isset($_POST['dir_name'])) {
			$dir_name = $_POST['dir_name'];
		}
		$staff_name = '';
		if (isset($_POST['staff_name'])) {
			$staff_name = $_POST['staff_name'];
		}
		if (isset($_POST['full_name'])) {
			$full_name = $_POST['full_name'];
		}
		if (isset($_POST['email'])) {
			$email = $_POST['email'];
		}
		if (isset($_POST['user_id'])) {
			$user_name = $_POST['user_id'];
		}
		if (isset($_POST['password'])) {
			$user_password = $_POST['password'];
		}
		if (isset($_POST['company_id'])) {
			$company_id = $_POST['company_id'];
		}
		if (isset($_POST['branch_id'])) {
			$branch_id = $_POST['branch_id'];
		}
		$loan_cat = '';
		if (isset($_POST['loan_cat'])) {
			$loan_cat = $_POST['loan_cat'];
		}
		$agentforstaff = '';
		if (isset($_POST['agentforstaff'])) {
			$agentforstaff = $_POST['agentforstaff'];
		}
		$line = '';
		if (isset($_POST['line'])) {
			$line = $_POST['line'];
		}
		$group = '';
		if (isset($_POST['group'])) {
			$group = $_POST['group'];
		}
		$download_access = '1';
		if (isset($_POST['download_access'])) {
			$download_access = $_POST['download_access'];
		}
		if (isset($_POST['mastermodule']) &&    $_POST['mastermodule'] == 'Yes') {
			$mastermodule = 0;
		} else {
			$mastermodule = 1;
		}
		if (isset($_POST['company_creation']) &&    $_POST['company_creation'] == 'Yes') {
			$company_creation = 0;
		} else {
			$company_creation = 1;
		}
		if (isset($_POST['branch_creation']) &&    $_POST['branch_creation'] == 'Yes') {
			$branch_creation = 0;
		} else {
			$branch_creation = 1;
		}
		if (isset($_POST['loan_category']) &&    $_POST['loan_category'] == 'Yes') {
			$loan_category = 0;
		} else {
			$loan_category = 1;
		}
		if (isset($_POST['loan_calculation']) &&    $_POST['loan_calculation'] == 'Yes') {
			$loan_calculation = 0;
		} else {
			$loan_calculation = 1;
		}
		if (isset($_POST['loan_scheme']) &&    $_POST['loan_scheme'] == 'Yes') {
			$loan_scheme = 0;
		} else {
			$loan_scheme = 1;
		}
		if (isset($_POST['area_creation']) &&    $_POST['area_creation'] == 'Yes') {
			$area_creation = 0;
		} else {
			$area_creation = 1;
		}
		if (isset($_POST['area_mapping']) &&    $_POST['area_mapping'] == 'Yes') {
			$area_mapping = 0;
		} else {
			$area_mapping = 1;
		}
		if (isset($_POST['area_status']) &&    $_POST['area_status'] == 'Yes') {
			$area_approval = 0;
		} else {
			$area_approval = 1;
		}
		if (isset($_POST['adminmodule']) &&    $_POST['adminmodule'] == 'Yes') {
			$adminmodule = 0;
		} else {
			$adminmodule = 1;
		}
		if (isset($_POST['director_creation']) &&    $_POST['director_creation'] == 'Yes') {
			$director_creation = 0;
		} else {
			$director_creation = 1;
		}
		if (isset($_POST['agent_creation']) &&    $_POST['agent_creation'] == 'Yes') {
			$agent_creation = 0;
		} else {
			$agent_creation = 1;
		}
		if (isset($_POST['staff_creation']) &&    $_POST['staff_creation'] == 'Yes') {
			$staff_creation = 0;
		} else {
			$staff_creation = 1;
		}
		if (isset($_POST['manage_user']) &&    $_POST['manage_user'] == 'Yes') {
			$manage_user = 0;
		} else {
			$manage_user = 1;
		}
		if (isset($_POST['doc_mapping']) &&    $_POST['doc_mapping'] == 'Yes') {
			$doc_mapping = 0;
		} else {
			$doc_mapping = 1;
		}
		if (isset($_POST['bank_creation']) &&    $_POST['bank_creation'] == 'Yes') {
			$bank_creation = 0;
		} else {
			$bank_creation = 1;
		}
		if (isset($_POST['requestmodule']) &&    $_POST['requestmodule'] == 'Yes') {
			$requestmodule = 0;
		} else {
			$requestmodule = 1;
		}
		if (isset($_POST['request']) &&    $_POST['request'] == 'Yes') {
			$request = 0;
		} else {
			$request = 1;
		}
		if (isset($_POST['request_list_access']) &&    $_POST['request_list_access'] == 'Yes') {
			$request_list_access = 0;
		} else {
			$request_list_access = 1;
		}
		if (isset($_POST['verificationmodule']) &&    $_POST['verificationmodule'] == 'Yes') {
			$verificationmodule = 0;
		} else {
			$verificationmodule = 1;
		}
		if (isset($_POST['verification']) &&    $_POST['verification'] == 'Yes') {
			$verification = 0;
		} else {
			$verification = 1;
		}
		if (isset($_POST['approvalmodule']) &&    $_POST['approvalmodule'] == 'Yes') {
			$approvalmodule = 0;
		} else {
			$approvalmodule = 1;
		}
		if (isset($_POST['approval']) &&    $_POST['approval'] == 'Yes') {
			$approval = 0;
		} else {
			$approval = 1;
		}
		if (isset($_POST['acknowledgementmodule']) &&    $_POST['acknowledgementmodule'] == 'Yes') {
			$acknowledgementmodule = 0;
		} else {
			$acknowledgementmodule = 1;
		}
		if (isset($_POST['acknowledgement']) &&    $_POST['acknowledgement'] == 'Yes') {
			$acknowledgement = 0;
		} else {
			$acknowledgement = 1;
		}
		if (isset($_POST['loanissuemodule']) &&    $_POST['loanissuemodule'] == 'Yes') {
			$loanissuemodule = 0;
		} else {
			$loanissuemodule = 1;
		}
		if (isset($_POST['loan_issue']) &&    $_POST['loan_issue'] == 'Yes') {
			$loan_issue = 0;
		} else {
			$loan_issue = 1;
		}
		if (isset($_POST['collectionmodule']) &&    $_POST['collectionmodule'] == 'Yes') {
			$collectionmodule = 0;
		} else {
			$collectionmodule = 1;
		}
		if (isset($_POST['collection']) &&    $_POST['collection'] == 'Yes') {
			$collection = 0;
		} else {
			$collection = 1;
		}
		if (isset($_POST['collection_access']) &&    $_POST['collection_access'] == 'Yes') {
			$collection_access = 0;
		} else {
			$collection_access = 1;
		}
		if (isset($_POST['closedmodule']) &&    $_POST['closedmodule'] == 'Yes') {
			$closedmodule = 0;
		} else {
			$closedmodule = 1;
		}
		if (isset($_POST['closed']) &&    $_POST['closed'] == 'Yes') {
			$closed = 0;
		} else {
			$closed = 1;
		}
		if (isset($_POST['nocmodule']) &&    $_POST['nocmodule'] == 'Yes') {
			$nocmodule = 0;
		} else {
			$nocmodule = 1;
		}
		if (isset($_POST['noc']) &&    $_POST['noc'] == 'Yes') {
			$noc = 0;
		} else {
			$noc = 1;
		}
		if (isset($_POST['doctrackmodule']) &&    $_POST['doctrackmodule'] == 'Yes') {
			$doctrackmodule = 0;
		} else {
			$doctrackmodule = 1;
		}
		if (isset($_POST['doctrack']) &&    $_POST['doctrack'] == 'Yes') {
			$doctrack = 0;
		} else {
			$doctrack = 1;
		}
		if (isset($_POST['doc_rec_access']) &&    $_POST['doc_rec_access'] == 'Yes') {
			$doc_rec_access = 0;
		} else {
			$doc_rec_access = 1;
		}
		if (isset($_POST['updatemodule']) &&    $_POST['updatemodule'] == 'Yes') {
			$updatemodule = 0;
		} else {
			$updatemodule = 1;
		}
		if (isset($_POST['update']) &&    $_POST['update'] == 'Yes') {
			$update_screen = 0;
		} else {
			$update_screen = 1;
		}
		if (isset($_POST['concernmodule']) &&    $_POST['concernmodule'] == 'Yes') {
			$concernmodule = 0;
		} else {
			$concernmodule = 1;
		}
		if (isset($_POST['concernCreation']) &&    $_POST['concernCreation'] == 'Yes') {
			$concernCreation = 0;
		} else {
			$concernCreation = 1;
		}
		if (isset($_POST['concernSolution']) &&    $_POST['concernSolution'] == 'Yes') {
			$concernSolution = 0;
		} else {
			$concernSolution = 1;
		}
		if (isset($_POST['concernFeedback']) &&    $_POST['concernFeedback'] == 'Yes') {
			$concernFeedback = 0;
		} else {
			$concernFeedback = 1;
		}
		if (isset($_POST['accountsmodule']) &&    $_POST['accountsmodule'] == 'Yes') {
			$accountsmodule = 0;
		} else {
			$accountsmodule = 1;
		}
		if (isset($_POST['cash_tally']) &&    $_POST['cash_tally'] == 'Yes') {
			$cash_tally = 0;
		} else {
			$cash_tally = 1;
		}
		if (isset($_POST['cash_tally_admin']) &&    $_POST['cash_tally_admin'] == 'Yes') {
			$cash_tally_admin = 0;
		} else {
			$cash_tally_admin = 1;
		}
		if (isset($_POST['bank_details'])) {
			$bank_details = $_POST['bank_details'];
		}
		if (isset($_POST['bank_clearance']) &&    $_POST['bank_clearance'] == 'Yes') {
			$bank_clearance = 0;
		} else {
			$bank_clearance = 1;
		}
		if (isset($_POST['finance_insight']) &&    $_POST['finance_insight'] == 'Yes') {
			$finance_insight = 0;
		} else {
			$finance_insight = 1;
		}
		if (isset($_POST['followupmodule']) &&    $_POST['followupmodule'] == 'Yes') {
			$followupmodule = 0;
		} else {
			$followupmodule = 1;
		}
		if (isset($_POST['promotion_activity']) &&    $_POST['promotion_activity'] == 'Yes') {
			$promotion_activity = 0;
		} else {
			$promotion_activity = 1;
		}
		if (isset($_POST['loan_followup']) &&    $_POST['loan_followup'] == 'Yes') {
			$loan_followup = 0;
		} else {
			$loan_followup = 1;
		}
		if (isset($_POST['conf_followup']) &&    $_POST['conf_followup'] == 'Yes') {
			$conf_followup = 0;
		} else {
			$conf_followup = 1;
		}
		if (isset($_POST['due_followup']) &&    $_POST['due_followup'] == 'Yes') {
			$due_followup = 0;
		} else {
			$due_followup = 1;
		}
		if (isset($_POST['reportmodule']) &&    $_POST['reportmodule'] == 'Yes') {
			$reportmodule = 0;
		} else {
			$reportmodule = 1;
		}
		if (isset($_POST['ledger_report']) &&    $_POST['ledger_report'] == 'Yes') {
			$ledger_report = 0;
		} else {
			$ledger_report = 1;
		}
		if (isset($_POST['request_report']) &&    $_POST['request_report'] == 'Yes') {
			$request_report = 0;
		} else {
			$request_report = 1;
		}
		if (isset($_POST['cus_profile_report']) &&    $_POST['cus_profile_report'] == 'Yes') {
			$cus_profile_report = 0;
		} else {
			$cus_profile_report = 1;
		}
		if (isset($_POST['loan_issue_report']) &&    $_POST['loan_issue_report'] == 'Yes') {
			$loan_issue_report = 0;
		} else {
			$loan_issue_report = 1;
		}
		if (isset($_POST['collection_report']) &&    $_POST['collection_report'] == 'Yes') {
			$collection_report = 0;
		} else {
			$collection_report = 1;
		}
		if (isset($_POST['balance_report']) &&    $_POST['balance_report'] == 'Yes') {
			$balance_report = 0;
		} else {
			$balance_report = 1;
		}
		if (isset($_POST['due_list_report']) &&    $_POST['due_list_report'] == 'Yes') {
			$due_list_report = 0;
		} else {
			$due_list_report = 1;
		}
		if (isset($_POST['closed_report']) &&    $_POST['closed_report'] == 'Yes') {
			$closed_report = 0;
		} else {
			$closed_report = 1;
		}
		if (isset($_POST['agent_report']) &&    $_POST['agent_report'] == 'Yes') {
			$agent_report = 0;
		} else {
			$agent_report = 1;
		}
		if (isset($_POST['searchmodule']) &&    $_POST['searchmodule'] == 'Yes') {
			$searchmodule = 0;
		} else {
			$searchmodule = 1;
		}
		if (isset($_POST['search_screen']) &&    $_POST['search_screen'] == 'Yes') {
			$search_screen = 0;
		} else {
			$search_screen = 1;
		}
		if (isset($_POST['bulk_upload_module']) &&    $_POST['bulk_upload_module'] == 'Yes') {
			$bulk_upload_module = 0;
		} else {
			$bulk_upload_module = 1;
		}
		if (isset($_POST['bulk_upload']) &&    $_POST['bulk_upload'] == 'Yes') {
			$bulk_upload = 0;
		} else {
			$bulk_upload = 1;
		}
		if (isset($_POST['loan_track_module']) &&    $_POST['loan_track_module'] == 'Yes') {
			$loan_track_module = 0;
		} else {
			$loan_track_module = 1;
		}
		if (isset($_POST['loan_track']) &&    $_POST['loan_track'] == 'Yes') {
			$loan_track = 0;
		} else {
			$loan_track = 1;
		}

		if (isset($_POST['sms_module']) &&    $_POST['sms_module'] == 'Yes') {
			$sms_module = 0;
		} else {
			$sms_module = 1;
		}
		if (isset($_POST['sms_generation']) &&    $_POST['sms_generation'] == 'Yes') {
			$sms_generation = 0;
		} else {
			$sms_generation = 1;
		}
		$updateQry = "UPDATE `user` SET `fullname` = '" . strip_tags($full_name) . "',`emailid` = '" . strip_tags($email) . "',`user_name` = '" . strip_tags($user_name) . "',
	`user_password` = '" . strip_tags($user_password) . "',`role` = '" . strip_tags($role) . "',`role_type` = '" . strip_tags($role_type) . "',`dir_id` = '" . strip_tags($dir_name) . "',
	`ag_id` = '" . strip_tags($ag_name) . "',`staff_id` = '" . strip_tags($staff_name) . "',`company_id` = '" . strip_tags($company_id) . "',`branch_id` = '" . strip_tags($branch_id) . "',
	`loan_cat` = '" . strip_tags($loan_cat) . "',agentforstaff='" . strip_tags($agentforstaff) . "',`line_id` = '" . strip_tags($line) . "',`group_id` = '" . strip_tags($group) . "',
	`download_access` = '" . strip_tags($download_access) . "', `mastermodule` = '" . strip_tags($mastermodule) . "',
	`company_creation` = '" . strip_tags($company_creation) . "',`branch_creation` = '" . strip_tags($branch_creation) . "',`loan_category` = '" . strip_tags($loan_category) . "',
	`loan_calculation` = '" . strip_tags($loan_calculation) . "',`loan_scheme` = '" . strip_tags($loan_scheme) . "',`area_creation` = '" . strip_tags($area_creation) . "',
	`area_mapping` = '" . strip_tags($area_mapping) . "',`area_approval` = '" . strip_tags($area_approval) . "',`adminmodule` = '" . strip_tags($adminmodule) . "',
	`director_creation` = '" . strip_tags($director_creation) . "',`agent_creation` = '" . strip_tags($agent_creation) . "',`staff_creation` = '" . strip_tags($staff_creation) . "',
	`manage_user` = '" . strip_tags($manage_user) . "',`doc_mapping`='" . strip_tags($doc_mapping) . "',`bank_creation`='" . strip_tags($bank_creation) . "',`requestmodule`='" . strip_tags($requestmodule) . "',
	`request`='" . strip_tags($request) . "',`request_list_access`='" . strip_tags($request_list_access) . "',`verificationmodule`='" . strip_tags($verificationmodule) . "',`verification`='" . strip_tags($verification) . "',
	`approvalmodule`='" . strip_tags($approvalmodule) . "',`approval`='" . strip_tags($approval) . "',`acknowledgementmodule`='" . strip_tags($acknowledgementmodule) . "',
	`acknowledgement`='" . strip_tags($acknowledgement) . "',`loanissuemodule`='" . strip_tags($loanissuemodule) . "',`loan_issue`='" . strip_tags($loan_issue) . "',
	`collectionmodule` = '" . strip_tags($collectionmodule) . "', `collection` = '" . strip_tags($collection) . "', `collection_access` = '" . strip_tags($collection_access) . "',
	`closedmodule` = '" . strip_tags($closedmodule) . "', `closed` = '" . strip_tags($closed) . "', `nocmodule` = '" . strip_tags($nocmodule) . "',`noc` = '" . strip_tags($noc) . "',`doctrackmodule` = '" . strip_tags($doctrackmodule) . "',
	`doctrack` = '" . strip_tags($doctrack) . "',`doc_rec_access` = '" . strip_tags($doc_rec_access) . "',
	`updatemodule` = '" . strip_tags($updatemodule) . "',`update_screen` = '" . strip_tags($update_screen) . "',
	`concernmodule`='" . strip_tags($concernmodule) . "',`concern_creation`='" . strip_tags($concernCreation) . "',`concern_solution`='" . strip_tags($concernSolution) . "',`concern_feedback`='" . strip_tags($concernFeedback) . "',
	`accountsmodule`='" . strip_tags($accountsmodule) . "',`cash_tally`='" . strip_tags($cash_tally) . "',`cash_tally_admin`='" . strip_tags($cash_tally_admin) . "',`bank_details`='" . strip_tags($bank_details) . "',
	`bank_clearance`='" . strip_tags($bank_clearance) . "',	`finance_insight`='" . strip_tags($finance_insight) . "',
	`followupmodule`='" . strip_tags($followupmodule) . "',	`promotion_activity`='" . strip_tags($promotion_activity) . "',`loan_followup`='" . strip_tags($loan_followup) . "',
	`confirmation_followup`='" . strip_tags($conf_followup) . "',`due_followup`='" . strip_tags($due_followup) . "',
	`reportmodule` = '" . strip_tags($reportmodule) . "', `ledger_report` = '" . strip_tags($ledger_report) . "', `request_report` = '" . strip_tags($request_report) . "', 
	`cus_profile_report` = '" . strip_tags($cus_profile_report) . "', `loan_issue_report` = '" . strip_tags($loan_issue_report) . "', 
	`collection_report` = '" . strip_tags($collection_report) . "', `balance_report` = '" . strip_tags($balance_report) .
			"', 
	`due_list_report` = '" . strip_tags($due_list_report) . "', `closed_report` = '" . strip_tags($closed_report) . "', `agent_report` = '" . strip_tags($agent_report) . "',
	`search_module` = '" . strip_tags($searchmodule) . "', `search` = '" . strip_tags($search_screen) . "',`bulk_upload_module` = '" . strip_tags($bulk_upload_module) . "', `bulk_upload` = '" . strip_tags($bulk_upload) .
			"',
	`loan_track_module` = '" . strip_tags($loan_track_module) . "', `loan_track` = '" . strip_tags($loan_track) . "', `sms_module` = '" . strip_tags($sms_module) . "', `sms_generation` = '" . strip_tags($sms_generation) . "',`status` = 0,`update_login_id` = '" . strip_tags($user_id) . "',`updated_date` = current_timestamp() WHERE user_id = '" . strip_tags($id) . "' ";
		$result = $mysqli->query($updateQry) or die;
	}

	//Delete Manage user 
	function deleteUser($mysqli, $id, $user_id)
	{
		$deleteQry = "UPDATE user set status='1' , delete_login_id = '" . strip_tags($user_id) . "' where user_id = '" . $id . "' ";
		$res = $mysqli->query($deleteQry);
	}

	// Add Documentation mapping
	public function addDocumentMapping($mysqli, $userid)
	{

		if (isset($_POST['loan_category'])) {
			$loan_category = $_POST['loan_category'];
		}
		if (isset($_POST['sub_category'])) {
			$sub_category = $_POST['sub_category'];
		}
		if (isset($_POST['doc_creation'])) {
			$doc_creation = $_POST['doc_creation'];
		}

		$insertQry = "INSERT INTO doc_mapping(`loan_category`, `sub_category`, `doc_creation` ,`insert_login_id`,`created_date`) 
		VALUES('" . strip_tags($loan_category) . "','" . strip_tags($sub_category) . "','" . strip_tags($doc_creation) . "','" . strip_tags($userid) . "','CURRENT_TIMESTAMP' )";

		$insresult = $mysqli->query($insertQry) or die("Error " . $mysqli->error);
	}

	// Get Documentation mapping
	public function getDocumentMapping($mysqli, $id)
	{

		$selectQry = "SELECT * FROM doc_mapping WHERE doc_map_id='" . mysqli_real_escape_string($mysqli, $id) . "' ";
		$res = $mysqli->query($selectQry) or die("Error in Get All Records" . $mysqli->error);
		$detailrecords = array();
		if ($mysqli->affected_rows > 0) {
			$row = $res->fetch_object();
			$detailrecords['doc_map_id']      = $row->doc_map_id;
			$detailrecords['loan_category']    = $row->loan_category;
			$detailrecords['sub_category']    = $row->sub_category;
			$detailrecords['doc_creation']    = $row->doc_creation;
		}
		return $detailrecords;
	}

	// Add Documentation mapping
	public function updateDocumentMapping($mysqli, $id, $userid)
	{

		if (isset($_POST['loan_category'])) {
			$loan_category = $_POST['loan_category'];
		}
		if (isset($_POST['sub_category'])) {
			$sub_category = $_POST['sub_category'];
		}
		if (isset($_POST['doc_creation'])) {
			$doc_creation = $_POST['doc_creation'];
		}

		$insertQry = "UPDATE `doc_mapping` SET `loan_category`='" . strip_tags($loan_category) . "',`sub_category`='" . strip_tags($sub_category) . "',`doc_creation`='" . strip_tags($doc_creation) . "',
		`status`='0',`update_login_id`='" . strip_tags($userid) . "',`updated_date`= 'CURRENT_TIMESTAMP' WHERE doc_map_id = '" . $id . "' ";

		$insresult = $mysqli->query($insertQry) or die("Error " . $mysqli->error);
	}

	//Delete Documentation mapping 
	function deleteDocumentMapping($mysqli, $id, $user_id)
	{
		$deleteQry = "UPDATE doc_mapping set status='1' , delete_login_id = '" . strip_tags($user_id) . "' where doc_map_id = '" . $id . "' ";
		$res = $mysqli->query($deleteQry);
	}

	// Get Area 
	public function getArea($mysqli)
	{
		$selectQry = "SELECT * FROM area_list_creation WHERE status= 0 and area_enable = 0 ";
		$res = $mysqli->query($selectQry) or die("Error in Get All Records" . $mysqli->error);
		$detailrecords = array();
		$j = 0;
		if ($mysqli->affected_rows > 0) {
			while ($row = $res->fetch_object()) {
				$detailrecords[$j]['area_id']      = $row->area_id;
				$detailrecords[$j]['area_name']    = $row->area_name;
				$j++;
			}
		}
		return $detailrecords;
	}

	// Add Request
	public function addRequest($mysqli, $userid)
	{

		if (isset($_POST['user_type'])) {
			$user_type = $_POST['user_type'];
		}
		if (isset($_POST['user'])) {
			$user = $_POST['user'];
		}
		$agent = '';
		if (isset($_POST['agent']) && $_POST['agent'] != '') {
			$agent = $_POST['agent'];
		} else if (isset($_POST['ag_id_load']) and $_POST['ag_id_load'] != '') {
			$agent = $_POST['ag_id_load'];
		}
		$responsible = '';
		if (isset($_POST['responsible'])) {
			$responsible = $_POST['responsible'];
		}
		$remarks = '';
		if (isset($_POST['remark'])) {
			$remarks = $_POST['remark'];
		}
		$declaration = '';
		if (isset($_POST['declaration'])) {
			$declaration = $_POST['declaration'];
		}
		// if (isset($_POST['req_code'])) {
		// 	$req_code = $_POST['req_code'];
		// }
		if (isset($_POST['dor'])) {
			$dor = $_POST['dor'];
		}
		if (isset($_POST['cus_id'])) {
			$cus_id =  preg_replace('/\s+/', '', $_POST['cus_id']);
		}
		if (isset($_POST['cus_data'])) {
			$cus_data = $_POST['cus_data'];
		}
		if (isset($_POST['cus_name'])) {
			$cus_name = $_POST['cus_name'];
		}
		if (isset($_POST['dob'])) {
			$dob = $_POST['dob'];
		}
		if (isset($_POST['age'])) {
			$age = $_POST['age'];
		}
		if (isset($_POST['gender'])) {
			$gender = $_POST['gender'];
		}
		if (isset($_POST['state'])) {
			$state = $_POST['state'];
		}
		if (isset($_POST['district1'])) {
			$district = $_POST['district1'];
		}
		if (isset($_POST['taluk1'])) {
			$taluk = $_POST['taluk1'];
		}
		if (isset($_POST['area'])) {
			$area = $_POST['area'];
		}
		if (isset($_POST['sub_area'])) {
			$sub_area = $_POST['sub_area'];
		}
		if (isset($_POST['address'])) {
			$address = $_POST['address'];
		}
		if (isset($_POST['mobile1'])) {
			$mobile1 = $_POST['mobile1'];
		}
		$mobile2 = '';
		if (isset($_POST['mobile2'])) {
			$mobile2 = $_POST['mobile2'];
		}
		if (isset($_POST['father_name'])) {
			$father_name = $_POST['father_name'];
		}
		if (isset($_POST['mother_name'])) {
			$mother_name = $_POST['mother_name'];
		}
		if (isset($_POST['marital'])) {
			$marital = $_POST['marital'];
		}
		$spouse_name = '';
		if (isset($_POST['spouse_name'])) {
			$spouse_name = $_POST['spouse_name'];
		}
		if (isset($_POST['occupation_type'])) {
			$occupation_type = $_POST['occupation_type'];
		}
		if (isset($_POST['occupation'])) {
			$occupation = $_POST['occupation'];
		}
		if (!empty($_FILES['pic']['name'])) {
			$pic = $_FILES['pic']['name'];
			$pic_temp = $_FILES['pic']['tmp_name'];
			$picfolder = "uploads/request/customer/" . $pic;
			$fileExtension = pathinfo($picfolder, PATHINFO_EXTENSION); //get the file extention
			$pic = uniqid() . '.' . $fileExtension;
			while (file_exists("uploads/request/customer/" . $pic)) {
				//this loop will continue until it generates a unique file name
				$pic = uniqid() . '.' . $fileExtension;
			}
			move_uploaded_file($pic_temp, "uploads/request/customer/" . $pic);
		} else {
			$pic = $_POST['img_exist'];
		}

		if (isset($_POST['loan_category'])) {
			$loan_category = $_POST['loan_category'];
		}
		if (isset($_POST['sub_category'])) {
			$sub_category = $_POST['sub_category'];
		}
		$tot_value = '';
		if (isset($_POST['tot_value'])) {
			$tot_value = $_POST['tot_value'];
		}
		$ad_amt = '';
		if (isset($_POST['ad_amt'])) {
			$ad_amt = $_POST['ad_amt'];
		}
		$ad_perc = '';
		if (isset($_POST['ad_perc'])) {
			$ad_perc = $_POST['ad_perc'];
		}
		if (isset($_POST['loan_amt'])) {
			$loan_amt = $_POST['loan_amt'];
		}
		if (isset($_POST['poss_type'])) {
			$poss_type = $_POST['poss_type'];
		}
		$due_amt = '';
		if (isset($_POST['due_amt'])) {
			$due_amt = $_POST['due_amt'];
		}
		$due_period = '';
		if (isset($_POST['due_period'])) {
			$due_period = $_POST['due_period'];
		}
		$category_info = '';
		if (isset($_POST['category_info'])) {
			$category_info = $_POST['category_info'];
		}

		try {
			// Disable autocommit to start a transaction
			$mysqli->autocommit(FALSE);
			$myStr = "REQ";
			$selectIC = $mysqli->query("SELECT req_code FROM request_creation WHERE req_code != '' ORDER BY req_id DESC LIMIT 1 FOR UPDATE");
			if ($selectIC->num_rows > 0) {
				$row = $selectIC->fetch_assoc();
				$ac2 = $row["req_code"];

				$appno2 = ltrim(strstr($ac2, '-'), '-');
				$appno2 = $appno2 + 1;
				$req_code = $myStr . "-" . "$appno2";
			} else {
				$initialapp = $myStr . "-101";
				$req_code = $initialapp;
			}

			$insertQry = "INSERT INTO request_creation(`user_type`, `user_name`, `agent_id`, `responsible`, `remarks`, `declaration`, `req_code`, `dor`, `cus_id`,
		`cus_data`, `cus_name`, `dob`, `age`, `gender`, `state`, `district`, `taluk`, `area`, `sub_area`, `address`, `mobile1`, `mobile2`, `father_name`, 
		`mother_name`, `marital`, `spouse_name`, `occupation_type`, `occupation`, `pic`, `loan_category`, `sub_category`, `tot_value`, `ad_amt`, `ad_perc`, 
		`loan_amt`, `poss_type`, `due_amt`, `due_period`, `insert_login_id`,`created_date`) 
		VALUES('" . strip_tags($user_type) . "','" . strip_tags($user) . "','" . strip_tags($agent) . "','" . strip_tags($responsible) . "','" . strip_tags($remarks) . "',
		'" . strip_tags($declaration) . "','" . strip_tags($req_code) . "','" . strip_tags($dor) . "', '" . strip_tags($cus_id) . "',
		'" . strip_tags($cus_data) . "','" . strip_tags($cus_name) . "','" . strip_tags($dob) . "', '" . strip_tags($age) . "', '" . strip_tags($gender) . "', '" . strip_tags($state) . "',
		'" . strip_tags($district) . "','" . strip_tags($taluk) . "','" . strip_tags($area) . "', '" . strip_tags($sub_area) . "', '" . strip_tags($address) . "', '" . strip_tags($mobile1) . "',
		'" . strip_tags($mobile2) . "','" . strip_tags($father_name) . "','" . strip_tags($mother_name) . "', '" . strip_tags($marital) . "', '" . strip_tags($spouse_name) . "', '" . strip_tags($occupation_type) . "',
		'" . strip_tags($occupation) . "','" . strip_tags($pic) . "','" . strip_tags($loan_category) . "', '" . strip_tags($sub_category) . "', '" . strip_tags($tot_value) . "', '" . strip_tags($ad_amt) . "',
		'" . strip_tags($ad_perc) . "', '" . strip_tags($loan_amt) . "','" . strip_tags($poss_type) . "','" . strip_tags($due_amt) . "','" . strip_tags($due_period) . "',
		'" . strip_tags($userid) . "',current_timestamp )";

			$insresult = $mysqli->query($insertQry) or die("Error " . $mysqli->error);
			$req_ref_id = $mysqli->insert_id;

			if ($cus_data == 'New') {

				$CustomerInsert = "INSERT INTO customer_register (`cus_id`,`req_ref_id`, `customer_name`, `dob`, `age`, `gender`, `state`, `district`,
				`taluk`, `area`, `sub_area`, `address`, `mobile1`, `mobile2`, `father_name`, `mother_name`, `marital`, `spouse`, `occupation_type`, `occupation`,`pic`)
				VALUES('" . strip_tags($cus_id) . "','" . strip_tags($req_ref_id) . "','" . strip_tags($cus_name) . "','" . strip_tags($dob) . "', '" . strip_tags($age) . "', '" . strip_tags($gender) . "', '" . strip_tags($state) . "',
				'" . strip_tags($district) . "','" . strip_tags($taluk) . "','" . strip_tags($area) . "', '" . strip_tags($sub_area) . "', '" . strip_tags($address) . "', '" . strip_tags($mobile1) . "',
				'" . strip_tags($mobile2) . "','" . strip_tags($father_name) . "','" . strip_tags($mother_name) . "', '" . strip_tags($marital) . "', '" . strip_tags($spouse_name) . "',
				'" . strip_tags($occupation_type) . "','" . strip_tags($occupation) . "','" . strip_tags($pic) . "' )";
				$insresult = $mysqli->query($CustomerInsert) or die("Error " . $mysqli->error);
			}

			for ($i = 0; $i < sizeof($category_info); $i++) {
				$insertQry = "INSERT INTO `request_category_info`(`req_ref_id`, `category_info`) VALUES ('" . strip_tags($req_ref_id) . "','" . strip_tags($category_info[$i]) . "') ";
				$insresult = $mysqli->query($insertQry) or die("Error " . $mysqli->error);
			}

		// Commit the transaction
		$mysqli->commit();

		// Enable autocommit again
		$mysqli->autocommit(TRUE);

		}catch(Exception $e){
			// Rollback the transaction in case of error
			$mysqli->rollback();
			$mysqli->autocommit(TRUE);
			echo "Error: " . $e->getMessage();
		}
	}

	// public function cancelRequest($mysqli,$can, $userid){
	// 	$cancelQry = $mysqli->query("Update request_creation set cus_status = 4,updated_date=now(), update_login_id= $userid where req_id = $can ") or die($mysqli->error());
	// 	$cancelQry = $mysqli->query("Update customer_register set cus_status = 4,updated_date=now() where req_ref_id = $can ") or die($mysqli->error());
	// }
	// public function revokeRequest($mysqli,$rev, $userid){
	// 	$revokeQry = $mysqli->query("Update request_creation set cus_status = 8,updated_date=now(), update_login_id= $userid where req_id = $rev ") or die($mysqli->error());
	// 	$revokeQry = $mysqli->query("Update customer_register set cus_status = 8,updated_date=now() where req_ref_id = $rev ") or die($mysqli->error());
	// }
	public function deleteRequest($mysqli, $del, $userid)
	{
		$deleteQry = $mysqli->query("Update request_creation set status = 1,updated_date=now(), delete_login_id= $userid where req_id = $del ") or die($mysqli->error());
	}

	public function getRequest($mysqli, $id)
	{
		$qry = $mysqli->query("SELECT * FROM request_creation where status = 0 and req_id = $id and cus_status = 0");
		$detailrecords = array();
		if ($mysqli->affected_rows > 0) {
			$row = $qry->fetch_assoc();
			$detailrecords['req_id'] = $row['req_id'];
			$detailrecords['user_type'] = $row['user_type'];
			$detailrecords['user_name'] = $row['user_name'];
			$detailrecords['agent_id'] = $row['agent_id'];
			$detailrecords['responsible'] = $row['responsible'];
			$detailrecords['remarks'] = $row['remarks'];
			$detailrecords['declaration'] = $row['declaration'];
			$detailrecords['req_code'] = $row['req_code'];
			$detailrecords['dor'] = $row['dor'];
			$detailrecords['cus_id'] = $row['cus_id'];
			$detailrecords['cus_data'] = $row['cus_data'];
			$detailrecords['cus_name'] = $row['cus_name'];
			$detailrecords['dob'] = $row['dob'];
			$detailrecords['age'] = $row['age'];
			$detailrecords['gender'] = $row['gender'];
			$detailrecords['state'] = $row['state'];
			$detailrecords['district'] = $row['district'];
			$detailrecords['taluk'] = $row['taluk'];
			$detailrecords['area'] = $row['area'];
			$detailrecords['sub_area'] = $row['sub_area'];
			$detailrecords['address'] = $row['address'];
			$detailrecords['mobile1'] = $row['mobile1'];
			$detailrecords['mobile2'] = $row['mobile2'];
			$detailrecords['father_name'] = $row['father_name'];
			$detailrecords['mother_name'] = $row['mother_name'];
			$detailrecords['marital'] = $row['marital'];
			$detailrecords['spouse_name'] = $row['spouse_name'];
			$detailrecords['occupation_type'] = $row['occupation_type'];
			$detailrecords['occupation'] = $row['occupation'];
			$detailrecords['pic'] = $row['pic'];
			$detailrecords['loan_category'] = $row['loan_category'];
			$detailrecords['sub_category'] = $row['sub_category'];
			$detailrecords['tot_value'] = $row['tot_value'];
			$detailrecords['ad_amt'] = $row['ad_amt'];
			$detailrecords['ad_perc'] = $row['ad_perc'];
			$detailrecords['loan_amt'] = $row['loan_amt'];
			$detailrecords['poss_type'] = $row['poss_type'];
			$detailrecords['due_amt'] = $row['due_amt'];
			$detailrecords['due_period'] = $row['due_period'];
			$detailrecords['cus_status'] = $row['cus_status'];
		}
		return $detailrecords;
	}
	public function getCategoryInfo($mysqli, $id)
	{
		$qry = $mysqli->query("SELECT * FROM request_category_info where req_ref_id = $id ");
		$detailrecords = array();
		$i = 0;
		if ($mysqli->affected_rows > 0) {
			while ($row = $qry->fetch_assoc()) {
				$detailrecords[$i] = $row['category_info'];
				$i++;
			}
		}
		return $detailrecords;
	}

	// Update Request
	public function updateRequest($mysqli, $id, $userid)
	{

		if (isset($_POST['user_type'])) {
			$user_type = $_POST['user_type'];
		}
		if (isset($_POST['user'])) {
			$user = $_POST['user'];
		}
		$agent = '';
		if (isset($_POST['agent']) && $_POST['agent'] != '') {
			$agent = $_POST['agent'];
			// }else if(isset($_POST['ag_id_upd']) && $_POST['ag_id_upd'] != ''){
			// 	$agent = $_POST['ag_id_upd'];
		}
		$responsible = '';
		if (isset($_POST['responsible'])) {
			$responsible = $_POST['responsible'];
		}
		$remarks = '';
		if (isset($_POST['remark'])) {
			$remarks = $_POST['remark'];
		}
		$declaration = '';
		if (isset($_POST['declaration'])) {
			$declaration = $_POST['declaration'];
		}
		if (isset($_POST['req_code'])) {
			$req_code = $_POST['req_code'];
		}
		if (isset($_POST['dor'])) {
			$dor = $_POST['dor'];
		}
		if (isset($_POST['cus_id'])) {
			$cus_id =  preg_replace('/\s+/', '', $_POST['cus_id']);
		}
		if (isset($_POST['cus_data'])) {
			$cus_data = $_POST['cus_data'];
		}
		if (isset($_POST['cus_name'])) {
			$cus_name = $_POST['cus_name'];
		}
		if (isset($_POST['dob'])) {
			$dob = $_POST['dob'];
		}
		if (isset($_POST['age'])) {
			$age = $_POST['age'];
		}
		if (isset($_POST['gender'])) {
			$gender = $_POST['gender'];
		}
		if (isset($_POST['state'])) {
			$state = $_POST['state'];
		}
		if (isset($_POST['district1'])) {
			$district = $_POST['district1'];
		}
		if (isset($_POST['taluk1'])) {
			$taluk = $_POST['taluk1'];
		}
		if (isset($_POST['area'])) {
			$area = $_POST['area'];
		}
		if (isset($_POST['sub_area'])) {
			$sub_area = $_POST['sub_area'];
		}
		if (isset($_POST['address'])) {
			$address = $_POST['address'];
		}
		if (isset($_POST['mobile1'])) {
			$mobile1 = $_POST['mobile1'];
		}
		$mobile2 = '';
		if (isset($_POST['mobile2'])) {
			$mobile2 = $_POST['mobile2'];
		}
		if (isset($_POST['father_name'])) {
			$father_name = $_POST['father_name'];
		}
		if (isset($_POST['mother_name'])) {
			$mother_name = $_POST['mother_name'];
		}
		if (isset($_POST['marital'])) {
			$marital = $_POST['marital'];
		}
		$spouse_name = '';
		if (isset($_POST['spouse_name'])) {
			$spouse_name = $_POST['spouse_name'];
		}
		if (isset($_POST['occupation_type'])) {
			$occupation_type = $_POST['occupation_type'];
		}
		if (isset($_POST['occupation'])) {
			$occupation = $_POST['occupation'];
		}

		if (!empty($_FILES['pic']['name'])) {
			$pic = $_FILES['pic']['name'];
			$pic_temp = $_FILES['pic']['tmp_name'];
			$picfolder = "uploads/request/customer/" . $pic;

			$fileExtension = pathinfo($picfolder, PATHINFO_EXTENSION); //get the file extention
			$pic = uniqid() . '.' . $fileExtension;
			while (file_exists("uploads/request/customer/" . $pic)) {
				//this loop will continue until it generates a unique file name
				$pic = uniqid() . '.' . $fileExtension;
			}
			move_uploaded_file($pic_temp, "uploads/request/customer/" . $pic);
		} elseif (isset($_POST['pic_upd']) and $_POST['pic_upd'] != '') {
			$pic = $_POST['pic_upd'];
		}
		if (isset($_POST['loan_category'])) {
			$loan_category = $_POST['loan_category'];
		}
		if (isset($_POST['sub_category'])) {
			$sub_category = $_POST['sub_category'];
		}
		$tot_value = '';
		if (isset($_POST['tot_value'])) {
			$tot_value = $_POST['tot_value'];
		}
		$ad_amt = '';
		if (isset($_POST['ad_amt'])) {
			$ad_amt = $_POST['ad_amt'];
		}
		$ad_perc = '';
		if (isset($_POST['ad_perc'])) {
			$ad_perc = $_POST['ad_perc'];
		}
		if (isset($_POST['loan_amt'])) {
			$loan_amt = $_POST['loan_amt'];
		}
		if (isset($_POST['poss_type'])) {
			$poss_type = $_POST['poss_type'];
		}
		$due_amt = '';
		if (isset($_POST['due_amt'])) {
			$due_amt = $_POST['due_amt'];
		}
		$due_period = '';
		if (isset($_POST['due_period'])) {
			$due_period = $_POST['due_period'];
		}
		$category_info = '';
		if (isset($_POST['category_info'])) {
			$category_info = $_POST['category_info'];
		}



		$insertQry = "UPDATE `request_creation` SET `user_type`='" . strip_tags($user_type) . "',`user_name`='" . strip_tags($user) . "',`agent_id`='" . strip_tags($agent) . "',
		`responsible`='" . strip_tags($responsible) . "',`remarks`='" . strip_tags($remarks) . "',`declaration`='" . strip_tags($declaration) . "',`req_code`='" . strip_tags($req_code) . "',
		`dor`='" . strip_tags($dor) . "',`cus_id`='" . strip_tags($cus_id) . "',
		`cus_data`='" . strip_tags($cus_data) . "',`cus_name`='" . strip_tags($cus_name) . "',`dob`='" . strip_tags($dob) . "',`age`='" . strip_tags($age) . "',
		`gender`='" . strip_tags($gender) . "',`state`='" . strip_tags($state) . "',`district`='" . strip_tags($district) . "',
		`taluk`='" . strip_tags($taluk) . "',`area`='" . strip_tags($area) . "',`sub_area`='" . strip_tags($sub_area) . "',`address`='" . strip_tags($address) . "',`mobile1`='" . strip_tags($mobile1) . "',
		`mobile2`='" . strip_tags($mobile2) . "',`father_name`='" . strip_tags($father_name) . "',
		`mother_name`='" . strip_tags($mother_name) . "',`marital`='" . strip_tags($marital) . "',`spouse_name`='" . strip_tags($spouse_name) . "',`occupation_type`='" . strip_tags($occupation_type) . "',
		`occupation`='" . strip_tags($occupation) . "',`pic`='" . strip_tags($pic) . "',
		`loan_category`='" . strip_tags($loan_category) . "',`sub_category`='" . strip_tags($sub_category) . "',`tot_value`='" . strip_tags($tot_value) . "',`ad_amt`='" . strip_tags($ad_amt) . "',
		`ad_perc`='" . strip_tags($ad_perc) . "',`loan_amt`='" . strip_tags($loan_amt) . "',
		`poss_type`='" . strip_tags($poss_type) . "',`due_amt`='" . strip_tags($due_amt) . "',`due_period`='" . strip_tags($due_period) .
			"',
		`update_login_id`='" . strip_tags($userid) . "',`updated_date`=current_timestamp WHERE `req_id` = '" . $id . "' and `cus_status` = '0' ";

		$insresult = $mysqli->query($insertQry) or die("Error " . $mysqli->error);


		$CustomerDelete = $mysqli->query("DELETE From customer_register where cus_id = '" . strip_tags($cus_id) . "' and cus_status= 0");

		$CustomerInsert = "INSERT INTO customer_register (`cus_id`,`req_ref_id`, `customer_name`, `dob`, `age`, `gender`, `state`, `district`,
			`taluk`, `area`, `sub_area`, `address`, `mobile1`, `mobile2`, `father_name`, `mother_name`, `marital`, `spouse`, `occupation_type`, `occupation`,`pic`)
			VALUES('" . strip_tags($cus_id) . "','" . strip_tags($id) . "','" . strip_tags($cus_name) . "','" . strip_tags($dob) . "', '" . strip_tags($age) . "', '" . strip_tags($gender) . "', '" . strip_tags($state) . "',
			'" . strip_tags($district) . "','" . strip_tags($taluk) . "','" . strip_tags($area) . "', '" . strip_tags($sub_area) . "', '" . strip_tags($address) . "', '" . strip_tags($mobile1) . "',
			'" . strip_tags($mobile2) . "','" . strip_tags($father_name) . "','" . strip_tags($mother_name) . "', '" . strip_tags($marital) . "', '" . strip_tags($spouse_name) . "',
			'" . strip_tags($occupation_type) . "','" . strip_tags($occupation) . "','" . strip_tags($pic) . "' )";
		$insresult = $mysqli->query($CustomerInsert) or die("Error " . $mysqli->error);

		$categoryDelete = $mysqli->query("DELETE From request_category_info where req_ref_id = '" . strip_tags($id) . "' ");
		for ($i = 0; $i < sizeof($category_info); $i++) {
			$insertQry = "INSERT INTO `request_category_info`(`req_ref_id`, `category_info`) VALUES ('" . strip_tags($id) . "','" . strip_tags($category_info[$i]) . "') ";
			$insresult = $mysqli->query($insertQry) or die("Error " . $mysqli->error);
		}
	}

	//Cancel verification 
	// function cancelVerification($mysqli,$id, $userid){
	// 	$qry = $mysqli->query("UPDATE request_creation set cus_status = 5,updated_date=now(), update_login_id = $userid where req_id = $id ") or die('Error While Cancelling Verification');
	// 	$qry = $mysqli->query("UPDATE in_verification set cus_status = 5 ,updated_date=now(), update_login_id = $userid where req_id = $id ") or die('Error While Cancelling Verification');
	// }
	// // Revoke Verification
	// public function revokeVerification($mysqli,$rev, $userid){
	// 	$revokeQry = $mysqli->query("Update request_creation set cus_status = 9,updated_date=now(), update_login_id= $userid where req_id = $rev ") or die($mysqli->error());
	// 	$revokeQry = $mysqli->query("Update in_verification set cus_status = 9,updated_date=now(), update_login_id= $userid where req_id = $rev ") or die($mysqli->error());
	// }
	//Delete verification 
	function deleteVerification($mysqli, $id, $userid)
	{
		$qry = $mysqli->query("UPDATE request_creation set status = 1,updated_date=now(), delete_login_id = $userid where req_id = $id ") or die('Error While Removing Verification');
		$qry = $mysqli->query("UPDATE in_verification set status = 1,updated_date=now(), delete_login_id = $userid where req_id = $id ") or die('Error While Removing Verification');
	}

	//Cancel Approval
	function cancelApproval($mysqli, $id, $userid)
	{
		$qry = $mysqli->query("UPDATE request_creation set cus_status = 6,updated_date=now(), update_login_id = $userid where req_id = $id ") or die('Error While Cancelling Verification');
		$qry = $mysqli->query("UPDATE in_verification set cus_status = 6,updated_date=now(), update_login_id = $userid where req_id = $id ") or die('Error While Cancelling Verification');
	}

	public function getRequestForVerification($mysqli, $id)
	{
		$qry = $mysqli->query("SELECT * FROM in_verification where req_id = '$id' ");
		$reqToverify = array();
		if ($mysqli->affected_rows > 0) {
			$row = $qry->fetch_assoc();
			$reqToverify['req_id'] = $row['req_id'];
			$reqToverify['user_type'] = $row['user_type'];
			$reqToverify['user_name'] = $row['user_name'];
			$reqToverify['agent_id'] = $row['agent_id'];
			$reqToverify['responsible'] = $row['responsible'];
			$reqToverify['remarks'] = $row['remarks'];
			$reqToverify['declaration'] = $row['declaration'];
			$reqToverify['req_code'] = $row['req_code'];
			$reqToverify['dor'] = $row['dor'];
			$reqToverify['cus_id'] = $row['cus_id'];
			$reqToverify['cus_data'] = $row['cus_data'];
			$reqToverify['cus_name'] = $row['cus_name'];
			$reqToverify['dob'] = $row['dob'];
			$reqToverify['age'] = $row['age'];
			$reqToverify['gender'] = $row['gender'];
			$reqToverify['blood_group'] = $row['blood_group'];
			$reqToverify['state'] = $row['state'];
			$reqToverify['district'] = $row['district'];
			$reqToverify['taluk'] = $row['taluk'];
			$reqToverify['area'] = $row['area'];
			$reqToverify['sub_area'] = $row['sub_area'];
			$reqToverify['address'] = $row['address'];
			$reqToverify['mobile1'] = $row['mobile1'];
			$reqToverify['mobile2'] = $row['mobile2'];
			$reqToverify['father_name'] = $row['father_name'];
			$reqToverify['mother_name'] = $row['mother_name'];
			$reqToverify['marital'] = $row['marital'];
			$reqToverify['spouse_name'] = $row['spouse_name'];
			$reqToverify['occupation_type'] = $row['occupation_type'];
			$reqToverify['occupation'] = $row['occupation'];
			$reqToverify['pic'] = $row['pic'];
			$reqToverify['loan_category'] = $row['loan_category'];
			$reqToverify['sub_category'] = $row['sub_category'];
			$reqToverify['tot_value'] = $row['tot_value'];
			$reqToverify['ad_amt'] = $row['ad_amt'];
			$reqToverify['ad_perc'] = $row['ad_perc'];
			$reqToverify['loan_amt'] = $row['loan_amt'];
			$reqToverify['poss_type'] = $row['poss_type'];
			$reqToverify['due_amt'] = $row['due_amt'];
			$reqToverify['due_period'] = $row['due_period'];
			$reqToverify['cus_status'] = $row['cus_status'];


			$areaQry = $mysqli->query("SELECT area_name from area_list_creation where area_id = '" . $row['area'] . "' ");
			$reqToverify['area_name'] = $areaQry->fetch_assoc()['area_name'];

			$subareaQry = $mysqli->query("SELECT sub_area_name from sub_area_list_creation where sub_area_id = '" . $row['sub_area'] . "' ");
			$reqToverify['sub_area_name'] = $subareaQry->fetch_assoc()['sub_area_name'];
		}


		return $reqToverify;
	}

	// Add Verification
	public function addCustomerProfile($mysqli, $userid)
	{
		if (isset($_POST['req_id'])) {
			$req_id = $_POST['req_id'];
		}
		if (isset($_POST['cus_id'])) {
			$cus_id =  preg_replace('/\s+/', '', $_POST['cus_id']);
		}
		if (isset($_POST['cus_name'])) {
			$cus_name = $_POST['cus_name'];
		}
		if (isset($_POST['gender'])) {
			$gender = $_POST['gender'];
		}
		if (isset($_POST['dob'])) {
			$dob =  $_POST['dob'];
		}
		if (isset($_POST['age'])) {
			$age = $_POST['age'];
		}
		if (isset($_POST['bloodGroup'])) {
			$bloodGroup = $_POST['bloodGroup'];
		}
		if (isset($_POST['mobile1'])) {
			$mobile1 = $_POST['mobile1'];
		}
		$mobile2 = '';
		if (isset($_POST['mobile2'])) {
			$mobile2 = $_POST['mobile2'];
		}
		$whatsapp_no = '';
		if (isset($_POST['whatsapp_no'])) {
			$whatsapp_no = $_POST['whatsapp_no'];
		}
		if (!empty($_FILES['pic']['name'])) {
			// Delete the file from both the request and verification folders
			$pic_req = $_POST['cus_image'];
			unlink("uploads/request/customer/{$pic_req}");
			unlink("uploads/verification/customer/{$pic_req}");

			// Get the original filename and temporary path of the uploaded file
			$pic = $_FILES['pic']['name'];
			$pic_temp = $_FILES['pic']['tmp_name'];

			// Extract the file extension from the original filename
			$fileExtension = pathinfo($pic, PATHINFO_EXTENSION);

			// Generate a unique filename
			$pic_req = uniqid() . '.' . $fileExtension;
			// Check if the unique filename already exists in the request folder
			while (file_exists("uploads/request/customer/{$pic_req}")) {
				// If it exists, generate a new unique filename
				$pic_req = uniqid() . '.' . $fileExtension;
			}
			// Move the uploaded file to the request folder with the new unique filename
			move_uploaded_file($pic_temp, "uploads/request/customer/{$pic_req}");
			copy("uploads/request/customer/{$pic_req}", "uploads/verification/customer/{$pic_req}");
		} else {
			// If no file was uploaded, use the existing image filename
			$pic_req = $_POST['cus_image'];
		}


		if (isset($_POST['guarentor_name'])) {
			$guarentor_name = $_POST['guarentor_name'];
		}
		if (isset($_POST['guarentor_relationship'])) {
			$guarentor_relationship = $_POST['guarentor_relationship'];
		}
		if (!empty($_FILES['guarentorpic']['name'])) {
			//to delete old pic
			$goldpic = $_POST['guarentor_image'];
			$check_file_exts = "uploads/verification/guarentor/" . $goldpic;

			if(file_exists($check_file_exts)){
				unlink($check_file_exts);
			}

			$guarentor = $_FILES['guarentorpic']['name'];
			$pic_temp = $_FILES['guarentorpic']['tmp_name'];
			$picfolder = "uploads/verification/guarentor/" . $guarentor;

			$fileExtension = pathinfo($picfolder, PATHINFO_EXTENSION); //get the file extention
			$guarentor = uniqid() . '.' . $fileExtension;
			while (file_exists("uploads/verification/guarentor/" . $guarentor)) {
				//this loop will continue until it generates a unique file name
				$guarentor = uniqid() . '.' . $fileExtension;
			}
			move_uploaded_file($pic_temp, "uploads/verification/guarentor/" . $guarentor);
		} else {
			$guarentor = $_POST['guarentor_image'];
		}
		if (isset($_POST['cus_type'])) {
			$cus_type = $_POST['cus_type'];
		}
		$cus_exist_type = ''; //*******
		if (isset($_POST['cus_exist_type'])) {
			$cus_exist_type = $_POST['cus_exist_type'];
		}
		if (isset($_POST['cus_res_type'])) {
			$cus_res_type = $_POST['cus_res_type'];
		}
		if (isset($_POST['cus_res_details'])) {
			$cus_res_details = $_POST['cus_res_details'];
		}
		if (isset($_POST['cus_res_address'])) {
			$cus_res_address = $_POST['cus_res_address'];
		}
		if (isset($_POST['cus_res_native'])) {
			$cus_res_native = $_POST['cus_res_native'];
		}
		if (isset($_POST['cus_occ_type'])) {
			$cus_occ_type = $_POST['cus_occ_type'];
		}
		if (isset($_POST['cus_occ_detail'])) {
			$cus_occ_detail = $_POST['cus_occ_detail'];
		}
		if (isset($_POST['cus_occ_income'])) {
			$cus_occ_income = $_POST['cus_occ_income'];
		}
		if (isset($_POST['cus_occ_address'])) {
			$cus_occ_address = $_POST['cus_occ_address'];
		}
		if (isset($_POST['cus_occ_dow'])) {
			$cus_occ_dow = $_POST['cus_occ_dow'];
		}
		if (isset($_POST['cus_occ_abt'])) {
			$cus_occ_abt = $_POST['cus_occ_abt'];
		}
		if (isset($_POST['area_cnfrm'])) {
			$area_cnfrm = $_POST['area_cnfrm'];
		}
		if (isset($_POST['state'])) {
			$state = $_POST['state'];
		}
		if (isset($_POST['district'])) {
			$district = $_POST['district'];
		}
		if (isset($_POST['taluk'])) {
			$taluk = $_POST['taluk'];
		}
		if (isset($_POST['area'])) {
			$area = $_POST['area'];
		}
		if (isset($_POST['sub_area'])) {
			$sub_area = $_POST['sub_area'];
		}
		if (isset($_POST['latlong'])) {
			$latlong = $_POST['latlong'];
		}
		if (isset($_POST['area_group'])) {
			$area_group = $_POST['area_group'];
		}
		if (isset($_POST['area_line'])) {
			$area_line = $_POST['area_line'];
		}

		if (isset($_POST['cus_how_know'])) {
			$cus_how_know = $_POST['cus_how_know'];
		}
		if (isset($_POST['cus_loan_count'])) {
			$cus_loan_count = $_POST['cus_loan_count'];
		}
		if (isset($_POST['cus_frst_loanDate'])) {
			$cus_frst_loanDate = $_POST['cus_frst_loanDate'];
		}
		if (isset($_POST['cus_travel_cmpy'])) {
			$cus_travel_cmpy = $_POST['cus_travel_cmpy'];
		}
		if (isset($_POST['cus_monthly_income'])) {
			$cus_monthly_income = $_POST['cus_monthly_income'];
		}
		if (isset($_POST['cus_other_income'])) {
			$cus_other_income = $_POST['cus_other_income'];
		}
		if (isset($_POST['cus_support_income'])) {
			$cus_support_income = $_POST['cus_support_income'];
		}
		if (isset($_POST['cus_Commitment'])) {
			$cus_Commitment = $_POST['cus_Commitment'];
		}
		if (isset($_POST['cus_monDue_capacity'])) {
			$cus_monDue_capacity = $_POST['cus_monDue_capacity'];
		}
		$cus_loan_limit = '';
		if (isset($_POST['cus_loan_limit'])) {
			$cus_loan_limit = $_POST['cus_loan_limit'];
		}
		if (isset($_POST['about_cus'])) {
			$about_cus = $_POST['about_cus'];
		}
		if (isset($_POST['cus_Tableid'])) {
			$cus_Tableid = $_POST['cus_Tableid'];
		}

		if ($cus_Tableid == '') {
			$qry = $mysqli->query("SELECT * From customer_profile where req_id = $req_id");
			if ($qry->num_rows == 0) {
				//this will filter out duplication entry in customer profile table
				$insertQry = "INSERT INTO `customer_profile`( `req_id`, `cus_id`, `cus_name`, `gender`, `dob`, `age`, `blood_group`, `mobile1`, `mobile2`, `whatsapp`,`cus_pic`, `guarentor_name`, `guarentor_relation`, `guarentor_photo`, `cus_type`, `cus_exist_type`, `residential_type`, `residential_details`, `residential_address`, `residential_native_address`, `occupation_type`, `occupation_details`, `occupation_income`, `occupation_address`, `dow`, `abt_occ`, `area_confirm_type`, `area_confirm_state`, `area_confirm_district`, `area_confirm_taluk`, `area_confirm_area`, `area_confirm_subarea`,`latlong` , `area_group`, `area_line`, `cus_status`, `insert_login_id`,`created_date`) VALUES('" . strip_tags($req_id) . "','" . strip_tags($cus_id) . "','" . strip_tags($cus_name) . "','" . strip_tags($gender) . "','" . strip_tags($dob) . "', '" . strip_tags($age) . "', '" . strip_tags($bloodGroup) . "', '" . strip_tags($mobile1) . "','" . strip_tags($mobile2) . "','" . strip_tags($whatsapp_no) . "','" . strip_tags($pic_req) . "','" . strip_tags($guarentor_name) . "', '" . strip_tags($guarentor_relationship) . "', '" . strip_tags($guarentor) . "', '" . strip_tags($cus_type) . "',
				'" . strip_tags($cus_exist_type) . "','" . strip_tags($cus_res_type) . "','" . strip_tags($cus_res_details) . "','" . strip_tags($cus_res_address) . "', '" . strip_tags($cus_res_native) . "', '" . strip_tags($cus_occ_type) . "','" . strip_tags($cus_occ_detail) . "','" . strip_tags($cus_occ_income) . "','" . strip_tags($cus_occ_address) . "','" . strip_tags($cus_occ_dow) . "','" . strip_tags($cus_occ_abt) . "','" . strip_tags($area_cnfrm) . "','" . strip_tags($state) . "','" . strip_tags($district) . "','" . strip_tags($taluk) . "','" . strip_tags($area) . "','" . strip_tags($sub_area) . "','" . strip_tags($latlong) . "','" . strip_tags($area_group) . "','" . strip_tags($area_line) . "','10','" . $userid . "',current_timestamp() )";
				$insresult = $mysqli->query($insertQry) or die("Error " . $mysqli->error);

				$insertQry = "UPDATE request_creation set cus_status = 10,updated_date=now() where req_id ='" . strip_tags($req_id) . "' ";
				$insresult = $mysqli->query($insertQry) or die("Error " . $mysqli->error);

				$insertQry = "UPDATE in_verification set cus_status = 10,`cus_id`='" . strip_tags($cus_id) . "',`cus_name`='" . strip_tags($cus_name) . "',`gender`='" . strip_tags($gender) . "',`dob`='" . strip_tags($dob) . "',`age`='" . strip_tags($age) . "',`blood_group`='" . strip_tags($bloodGroup) . "',`mobile1`='" . strip_tags($mobile1) . "', `mobile2`='" . strip_tags($mobile2) . "',`pic`='" . strip_tags($pic_req) . "',updated_date=now() where req_id ='" . strip_tags($req_id) . "' ";
				$insresult = $mysqli->query($insertQry) or die("Error " . $mysqli->error);
			}
		} else {

			$cusUpd = "UPDATE `customer_profile` SET `req_id`='" . strip_tags($req_id) . "',`cus_id`='" . strip_tags($cus_id) . "',`cus_name`='" . strip_tags($cus_name) . "',`gender`='" . strip_tags($gender) . "',`dob`='" . strip_tags($dob) . "',`age`='" . strip_tags($age) . "',`blood_group`='" . strip_tags($bloodGroup) . "',`mobile1`='" . strip_tags($mobile1) . "',`mobile2`='" . strip_tags($mobile2) . "',`whatsapp`='" . strip_tags($whatsapp_no) . "',`cus_pic`='" . strip_tags($pic_req) . "',`guarentor_name`='" . strip_tags($guarentor_name) . "',`guarentor_relation`='" . strip_tags($guarentor_relationship) . "',`guarentor_photo`='" . strip_tags($guarentor) . "',`cus_type`='" . strip_tags($cus_type) . "',`cus_exist_type`='" . strip_tags($cus_exist_type) . "',`residential_type`='" . strip_tags($cus_res_type) . "',`residential_details`='" . strip_tags($cus_res_details) . "',`residential_address`='" . strip_tags($cus_res_address) . "',`residential_native_address`='" . strip_tags($cus_res_native) . "',`occupation_type`='" . strip_tags($cus_occ_type) . "',`occupation_details`='" . strip_tags($cus_occ_detail) . "',`occupation_income`='" . strip_tags($cus_occ_income) . "',`occupation_address`='" . strip_tags($cus_occ_address) . "',`dow`='" . strip_tags($cus_occ_dow) . "',`abt_occ`='" . strip_tags($cus_occ_abt) . "',`area_confirm_type`='" . strip_tags($area_cnfrm) . "',`area_confirm_state`='" . strip_tags($state) . "',`area_confirm_district`='" . strip_tags($district) . "',`area_confirm_taluk`='" . strip_tags($taluk) . "',`area_confirm_area`='" . strip_tags($area) . "',`area_confirm_subarea`='" . strip_tags($sub_area) . "',`latlong`='" . strip_tags($latlong) . "',`area_group`='" . strip_tags($area_group) . "',`area_line`='" . strip_tags($area_line) . "',`update_login_id`='" . $userid . "',`updated_date`= now() WHERE `id`='" . strip_tags($cus_Tableid) . "' ";

			$updateCus = $mysqli->query($cusUpd) or die("Error " . $mysqli->error);

			$insertQry = "UPDATE in_verification set `cus_id`='" . strip_tags($cus_id) . "',`cus_name`='" . strip_tags($cus_name) . "',`gender`='" . strip_tags($gender) . "',`dob`='" . strip_tags($dob) . "',`age`='" . strip_tags($age) . "',`blood_group`='" . strip_tags($bloodGroup) . "',`mobile1`='" . strip_tags($mobile1) . "', `mobile2`='" . strip_tags($mobile2) . "',`pic`='" . strip_tags($pic_req) . "' where req_id ='" . strip_tags($req_id) . "' ";
			$insresult = $mysqli->query($insertQry) or die("Error " . $mysqli->error);
		}

		$updateCus = "UPDATE `customer_register` SET  `cus_id`='" . strip_tags($cus_id) . "',`customer_name`='" . strip_tags($cus_name) . "',`gender`='" . strip_tags($gender) . "',`dob`='" . strip_tags($dob) . "',`age`='" . strip_tags($age) . "',`blood_group`='" . strip_tags($bloodGroup) . "',`mobile1`='" . strip_tags($mobile1) . "', `mobile2`='" . strip_tags($mobile2) . "',`pic`='" . strip_tags($pic_req) . "',`how_to_know`='" . strip_tags($cus_how_know) . "',`loan_count`='" . strip_tags($cus_loan_count) . "',`first_loan_date`='" . strip_tags($cus_frst_loanDate) . "',`travel_with_company`='" . strip_tags($cus_travel_cmpy) . "',`monthly_income`='" . strip_tags($cus_monthly_income) . "',`other_income`='" . strip_tags($cus_other_income) . "',`support_income`='" . strip_tags($cus_support_income) . "',`commitment`='" . strip_tags($cus_Commitment) . "',`monthly_due_capacity`='" . strip_tags($cus_monDue_capacity) . "',`loan_limit`='" . strip_tags($cus_loan_limit) . "',`about_customer`='" . strip_tags($about_cus) . "',`residential_type`='" . strip_tags($cus_res_type) . "',`residential_details`='" . strip_tags($cus_res_details) . "',`residential_address`='" . strip_tags($cus_res_address) . "',`residential_native_address`='" . strip_tags($cus_res_native) . "',`occupation_info_occ_type`='" . strip_tags($cus_occ_type) . "',`occupation_details`='" . strip_tags($cus_occ_detail) . "',`occupation_income`='" . strip_tags($cus_occ_income) . "',`occupation_address`='" . strip_tags($cus_occ_address) . "',`dow`='" . strip_tags($cus_occ_dow) . "',`abt_occ`='" . strip_tags($cus_occ_abt) . "',`area_confirm_type`='" . strip_tags($area_cnfrm) . "',`area_confirm_state`='" . strip_tags($state) . "',`area_confirm_district`='" . strip_tags($district) . "',`area_confirm_taluk`='" . strip_tags($taluk) . "',`area_confirm_area`='" . strip_tags($area) . "',`area_confirm_subarea`='" . strip_tags($sub_area) . "',`latlong`='" . strip_tags($latlong) . "',`area_group`='" . strip_tags($area_group) . "',`area_line`='" . strip_tags($area_line) . "' WHERE `cus_id`= '" . strip_tags($cus_id) . "' ";
		$insresult = $mysqli->query($updateCus) or die("Error " . $mysqli->error);
	}

	// Get Customer Profile Info.
	public function getCustomerProfile($mysqli, $req_id)
	{

		$qry = $mysqli->query("SELECT cp.*,cr.how_to_know,cr.loan_count,cr.first_loan_date,cr.travel_with_company,cr.monthly_income,cr.other_income,cr.support_income,cr.commitment,cr.monthly_due_capacity,cr.loan_limit,cr.about_customer FROM `customer_profile` cp  LEFT JOIN `customer_register` cr on cp.cus_id = cr.cus_id WHERE cp.req_id='$req_id' ");
		$detailrecords = array();
		$i = 0;
		if ($mysqli->affected_rows > 0) {
			while ($row = $qry->fetch_assoc()) {
				$detailrecords['cus_Tableid'] = $row['id'];
				$detailrecords['req_id'] = $row['req_id'];
				$detailrecords['cus_id'] = $row['cus_id'];
				$detailrecords['cus_name'] = $row['cus_name'];
				$detailrecords['gender'] = $row['gender'];
				$detailrecords['dob'] = $row['dob'];
				$detailrecords['age'] = $row['age'];
				$detailrecords['blood_group'] = $row['blood_group'];
				$detailrecords['mobile1'] = $row['mobile1'];
				$detailrecords['mobile2'] = $row['mobile2'];
				$detailrecords['whatsapp'] = $row['whatsapp'];
				$detailrecords['cus_pic'] = $row['cus_pic'];
				$detailrecords['guarentor_name'] = $row['guarentor_name'];
				$detailrecords['guarentor_relation'] = $row['guarentor_relation'];
				$detailrecords['guarentor_photo'] = $row['guarentor_photo'];
				$detailrecords['cus_type'] = $row['cus_type'];
				$detailrecords['cus_exist_type'] = $row['cus_exist_type'];
				$detailrecords['residential_type'] = $row['residential_type'];
				$detailrecords['residential_details'] = $row['residential_details'];
				$detailrecords['residential_address'] = $row['residential_address'];
				$detailrecords['residential_native_address'] = $row['residential_native_address'];
				$detailrecords['occupation_type'] = $row['occupation_type'];
				$detailrecords['occupation_details'] = $row['occupation_details'];
				$detailrecords['occupation_income'] = $row['occupation_income'];
				$detailrecords['occupation_address'] = $row['occupation_address'];
				$detailrecords['area_confirm_type'] = $row['area_confirm_type'];
				$detailrecords['area_confirm_state'] = $row['area_confirm_state'];
				$detailrecords['area_confirm_district'] = $row['area_confirm_district'];
				$detailrecords['area_confirm_taluk'] = $row['area_confirm_taluk'];
				$detailrecords['area_confirm_area'] = $row['area_confirm_area'];
				$detailrecords['area_confirm_subarea'] = $row['area_confirm_subarea'];
				$detailrecords['latlong'] = $row['latlong'];
				$detailrecords['area_group'] = $row['area_group'];
				$detailrecords['area_line'] = $row['area_line'];
				$detailrecords['communication'] = $row['communication'];
				$detailrecords['com_audio'] = $row['com_audio'];
				$detailrecords['verification_person'] = $row['verification_person'];
				$detailrecords['verification_location'] = $row['verification_location'];
				$detailrecords['cus_status'] = $row['cus_status'];
				$detailrecords['how_to_know'] = $row['how_to_know'];
				$detailrecords['loan_count'] = $row['loan_count'];
				$detailrecords['first_loan_date'] = $row['first_loan_date'];
				$detailrecords['travel_with_company'] = $row['travel_with_company'];
				$detailrecords['monthly_income'] = $row['monthly_income'];
				$detailrecords['other_income'] = $row['other_income'];
				$detailrecords['support_income'] = $row['support_income'];
				$detailrecords['commitment'] = $row['commitment'];
				$detailrecords['monthly_due_capacity'] = $row['monthly_due_capacity'];
				$detailrecords['loan_limit'] = $row['loan_limit'];
				$detailrecords['about_customer'] = $row['about_customer'];
				$detailrecords['dow'] = $row['dow'];
				$detailrecords['abt_occ'] = $row['abt_occ'];
				$i++;
			}
		}

		return $detailrecords;
	}

	// Add Documentation
	public function addDocumentation($mysqli, $userid)
	{
		if (isset($_POST['req_id'])) {
			$req_id = $_POST['req_id'];
		}
		if (isset($_POST['cus_id_doc'])) {
			$cus_id_doc = $_POST['cus_id_doc'];
		}
		if (isset($_POST['Customer_name'])) {
			$Customer_name = $_POST['Customer_name'];
		}
		if (isset($_POST['cus_profile_id'])) {
			$cus_profile_id = $_POST['cus_profile_id'];
		}
		if (isset($_POST['doc_id'])) {
			$doc_id =  $_POST['doc_id'];
		}
		if (isset($_POST['mortgage_process'])) {
			$mortgage_process = $_POST['mortgage_process'];
		}
		if (isset($_POST['Propertyholder_type'])) {
			$Propertyholder_type = $_POST['Propertyholder_type'];
		}
		$Propertyholder_name = '';
		if (isset($_POST['Propertyholder_name'])) {
			$Propertyholder_name = $_POST['Propertyholder_name'];
		}
		$Propertyholder_relationship_name = '';
		if (isset($_POST['Propertyholder_relationship_name'])) {
			$Propertyholder_relationship_name = $_POST['Propertyholder_relationship_name'];
		}
		if (isset($_POST['doc_property_relation'])) {
			$doc_property_relation = $_POST['doc_property_relation'];
		}
		if (isset($_POST['doc_property_pype'])) {
			$doc_property_pype = $_POST['doc_property_pype'];
		}
		if (isset($_POST['doc_property_measurement'])) {
			$doc_property_measurement = $_POST['doc_property_measurement'];
		}
		if (isset($_POST['doc_property_location'])) {
			$doc_property_location = $_POST['doc_property_location'];
		}
		if (isset($_POST['doc_property_value'])) {
			$doc_property_value = $_POST['doc_property_value'];
		}
		if (isset($_POST['endorsement_process'])) {
			$endorsement_process = $_POST['endorsement_process'];
		}
		if (isset($_POST['owner_type'])) {
			$owner_type = $_POST['owner_type'];
		}
		$owner_name = '';
		if (isset($_POST['owner_name'])) {
			$owner_name = $_POST['owner_name'];
		}
		$ownername_relationship_name = '';
		if (isset($_POST['ownername_relationship_name'])) {
			$ownername_relationship_name = $_POST['ownername_relationship_name'];
		}
		if (isset($_POST['en_relation'])) {
			$en_relation = $_POST['en_relation'];
		}
		if (isset($_POST['vehicle_type'])) {
			$vehicle_type = $_POST['vehicle_type'];
		}
		if (isset($_POST['vehicle_process'])) {
			$vehicle_process = $_POST['vehicle_process'];
		}
		if (isset($_POST['en_Company'])) {
			$en_Company = $_POST['en_Company'];
		}

		if (isset($_POST['en_Model'])) {
			$en_Model = $_POST['en_Model'];
		}
		if (isset($_POST['doc_table_id'])) {
			$doc_table_id = $_POST['doc_table_id'];
		}
		if ($doc_table_id == '') {
			$qry = $mysqli->query("SELECT * From verification_documentation where req_id = $req_id");
			if ($qry->num_rows == 0) {
				//this will filter out duplication entry in customer profile table
				$insertQry = "INSERT INTO `verification_documentation`( `req_id`, `cus_id_doc`, `customer_name`, `cus_profile_id`, `doc_id`, `mortgage_process`, `Propertyholder_type`, `Propertyholder_name`, `Propertyholder_relationship_name`, `doc_property_relation`, `doc_property_type`, `doc_property_measurement`, `doc_property_location`, `doc_property_value`, `endorsement_process`, `owner_type`, `owner_name`, `ownername_relationship_name`, `en_relation`, `vehicle_type`, `vehicle_process`, `en_Company`, `en_Model`, `cus_status`, `insert_login_id`,`created_date`) VALUES('" . strip_tags($req_id) . "','" . strip_tags($cus_id_doc) . "','" . strip_tags($Customer_name) . "','" . strip_tags($cus_profile_id) . "','" . strip_tags($doc_id) . "', '" . strip_tags($mortgage_process) . "', '" . strip_tags($Propertyholder_type) . "', '" . strip_tags($Propertyholder_name) . "','" . strip_tags($Propertyholder_relationship_name) . "','" . strip_tags($doc_property_relation) . "','" . strip_tags($doc_property_pype) . "','" . strip_tags($doc_property_measurement) . "', '" . strip_tags($doc_property_location) . "', '" . strip_tags($doc_property_value) . "', '" . strip_tags($endorsement_process) . "','" . strip_tags($owner_type) . "','" . strip_tags($owner_name) . "','" . strip_tags($ownername_relationship_name) . "','" . strip_tags($en_relation) . "','" . strip_tags($vehicle_type) . "','" . strip_tags($vehicle_process) . "','" . strip_tags($en_Company) . "','" . strip_tags($en_Model) . "','11','" . $userid . "',current_timestamp() )";

				$insresult = $mysqli->query($insertQry) or die("Error " . $mysqli->error);

				$insertQry = "UPDATE request_creation set cus_status = 11,updated_date=now() where req_id ='" . strip_tags($req_id) . "' ";
				$insresult = $mysqli->query($insertQry) or die("Error " . $mysqli->error);

				$insertQry = "UPDATE in_verification set cus_status = 11,updated_date=now() where req_id ='" . strip_tags($req_id) . "' ";
				$insresult = $mysqli->query($insertQry) or die("Error " . $mysqli->error);
			}
		} else {
			$update_doc = " UPDATE `verification_documentation` SET `req_id`='" . strip_tags($req_id) . "',`cus_id_doc`='" . strip_tags($cus_id_doc) . "',`customer_name`='" . strip_tags($Customer_name) . "',`cus_profile_id`='" . strip_tags($cus_profile_id) . "',`doc_id`='" . strip_tags($doc_id) . "',`mortgage_process`='" . strip_tags($mortgage_process) . "',`Propertyholder_type`='" . strip_tags($Propertyholder_type) . "',`Propertyholder_name`='" . strip_tags($Propertyholder_name) . "',`Propertyholder_relationship_name`='" . strip_tags($Propertyholder_relationship_name) . "',`doc_property_relation`='" . strip_tags($doc_property_relation) . "',`doc_property_type`='" . strip_tags($doc_property_pype) . "',`doc_property_measurement`='" . strip_tags($doc_property_measurement) . "',`doc_property_location`='" . strip_tags($doc_property_location) . "',`doc_property_value`='" . strip_tags($doc_property_value) . "',`endorsement_process`='" . strip_tags($endorsement_process) . "',`owner_type`='" . strip_tags($owner_type) . "',`owner_name`='" . strip_tags($owner_name) . "',`ownername_relationship_name`='" . strip_tags($ownername_relationship_name) . "',`en_relation`='" . strip_tags($en_relation) . "',`vehicle_type`='" . strip_tags($vehicle_type) . "',`vehicle_process`='" . strip_tags($vehicle_process) . "',`en_Company`='" . strip_tags($en_Company) . "',`en_Model`='" . strip_tags($en_Model) . "',`status`='0',`update_login_id`='" . $userid . "' WHERE `id` = '" . strip_tags($doc_table_id) . "' ";

			$updDocResult = $mysqli->query($update_doc) or die("Error " . $mysqli->error);
		}
	}

	// Get Documentation Info.
	public function getDocument($mysqli, $req_id)
	{

		$qry = $mysqli->query("SELECT * FROM verification_documentation where req_id = $req_id ");
		$detailrecords = array();
		$i = 0;
		if ($mysqli->affected_rows > 0) {
			while ($row = $qry->fetch_assoc()) {
				$detailrecords['doc_Tableid'] = $row['id'];
				$detailrecords['req_id'] = $row['req_id'];
				$detailrecords['mortgage_process'] = $row['mortgage_process'];
				$detailrecords['Propertyholder_type'] = $row['Propertyholder_type'];
				$detailrecords['Propertyholder_name'] = $row['Propertyholder_name'];
				$detailrecords['Propertyholder_relationship_name'] = $row['Propertyholder_relationship_name'];
				$detailrecords['doc_property_relation'] = $row['doc_property_relation'];
				$detailrecords['doc_property_type'] = $row['doc_property_type'];
				$detailrecords['doc_property_measurement'] = $row['doc_property_measurement'];
				$detailrecords['doc_property_location'] = $row['doc_property_location'];
				$detailrecords['doc_property_value'] = $row['doc_property_value'];
				$detailrecords['mortgage_name'] = $row['mortgage_name'];
				$detailrecords['mortgage_dsgn'] = $row['mortgage_dsgn'];
				$detailrecords['mortgage_nuumber'] = $row['mortgage_nuumber'];
				$detailrecords['reg_office'] = $row['reg_office'];
				$detailrecords['mortgage_value'] = $row['mortgage_value'];
				$detailrecords['mortgage_document'] = $row['mortgage_document'];
				$detailrecords['mortgage_document_upd'] = $row['mortgage_document_upd'];
				$detailrecords['mortgage_document_pending'] = $row['mortgage_document_pending'];
				$detailrecords['endorsement_process'] = $row['endorsement_process'];
				$detailrecords['owner_type'] = $row['owner_type'];
				$detailrecords['owner_name'] = $row['owner_name'];
				$detailrecords['ownername_relationship_name'] = $row['ownername_relationship_name'];
				$detailrecords['en_relation'] = $row['en_relation'];
				$detailrecords['vehicle_type'] = $row['vehicle_type'];
				$detailrecords['vehicle_process'] = $row['vehicle_process'];
				$detailrecords['en_Company'] = $row['en_Company'];
				$detailrecords['en_Model'] = $row['en_Model'];
				$detailrecords['vehicle_reg_no'] = $row['vehicle_reg_no'];
				$detailrecords['endorsement_name'] = $row['endorsement_name'];
				$detailrecords['en_RC'] = $row['en_RC'];
				$detailrecords['Rc_document_upd'] = $row['Rc_document_upd'];
				$detailrecords['Rc_document_pending'] = $row['Rc_document_pending'];
				$detailrecords['en_Key'] = $row['en_Key'];
				$detailrecords['gold_info'] = $row['gold_info'];
				$detailrecords['gold_sts'] = $row['gold_sts'];
				$detailrecords['gold_type'] = $row['gold_type'];
				$detailrecords['Purity'] = $row['Purity'];
				$detailrecords['gold_Count'] = $row['gold_Count'];
				$detailrecords['gold_Weight'] = $row['gold_Weight'];
				$detailrecords['gold_Value'] = $row['gold_Value'];
				$detailrecords['document_name'] = $row['document_name'];
				$detailrecords['document_details'] = $row['document_details'];
				$detailrecords['document_type'] = $row['document_type'];
				// $detailrecords['doc_info_upload'] = $row['doc_info_upload'];
				$detailrecords['document_holder'] = $row['document_holder'];
				$detailrecords['docholder_name'] = $row['docholder_name'];
				$detailrecords['docholder_relationship_name'] = $row['docholder_relationship_name'];
				$detailrecords['doc_relation'] = $row['doc_relation'];
				$detailrecords['cus_status'] = $row['cus_status'];

				$i++;
			}
		}

		return $detailrecords;
	}

	// Get Customer Info for Documentation from Customer_profile table.
	public function getcusInfoForDoc($mysqli, $req_id)
	{

		$qry = $mysqli->query("SELECT * FROM customer_profile where req_id = $req_id ");
		$detailrecords = array();
		$i = 0;
		if ($mysqli->affected_rows > 0) {
			while ($row = $qry->fetch_assoc()) {
				$detailrecords['cus_profile_id'] = $row['id'];
				$detailrecords['cus_id'] = $row['cus_id'];
				$detailrecords['cus_name'] = $row['cus_name'];
				$detailrecords['area_confirm_area'] = $row['area_confirm_area'];
				$detailrecords['area_confirm_subarea'] = $row['area_confirm_subarea'];
				$detailrecords['cus_status'] = $row['cus_status'];


				$result = $mysqli->query("SELECT area_name FROM area_list_creation where area_id = '" . $detailrecords['area_confirm_area'] . "' and status=0 and area_enable = 0");
				$area = $result->fetch_assoc();
				$detailrecords['area_name'] = $area['area_name'];

				$subarearesult = $mysqli->query("SELECT sub_area_name FROM sub_area_list_creation where sub_area_id = '" . $detailrecords['area_confirm_subarea'] . "' and status=0 and sub_area_enable = 0");
				$subarea = $subarearesult->fetch_assoc();
				$detailrecords['sub_area_name'] = $subarea['sub_area_name'];


				$i++;
			}
		}
		return $detailrecords;
	}


	public function getCusInfoForLoanCal($mysqli, $id)
	{
		$qry = $mysqli->query("SELECT * FROM customer_profile where req_id = $id ");
		$detailrecords = array();
		$i = 0;
		if ($mysqli->affected_rows > 0) {
			while ($row = $qry->fetch_assoc()) {
				$detailrecords['cus_id'] = $row['cus_id'];
				$detailrecords['cus_name'] = $row['cus_name'];
				$detailrecords['cus_pic'] = $row['cus_pic'];
				$detailrecords['cus_type'] = $row['cus_type'];
				$detailrecords['mobile'] = $row['mobile1'];
				$i++;
			}
		}
		return $detailrecords;
	}


	// Get Loan caltegory list for Documentation
	public function getloanCategoryForDoc($mysqli, $loan_category)
	{

		$Qry = "SELECT * FROM loan_category_creation WHERE loan_category_creation_id= '$loan_category'";
		$res1 = $mysqli->query($Qry) or die("Error in Get All Records" . $mysqli->error);
		$row1 = $res1->fetch_object();
		$detailrecords['loan_category_name'] = $row1->loan_category_creation_name;

		return $detailrecords;
	}

	//Add Loan Calculation
	function addVerificationLoanCalculation($mysqli, $userid)
	{
		if (isset($_POST['cus_id_loan'])) {
			$cus_id_loan = $_POST['cus_id_loan'];
		}
		if (isset($_POST['req_id'])) {
			$req_id = $_POST['req_id'];
		}
		if (isset($_POST['cus_name_loan'])) {
			$cus_name_loan = $_POST['cus_name_loan'];
		}
		if (isset($_POST['cus_data_loan'])) {
			$cus_data_loan = $_POST['cus_data_loan'];
		}
		if (isset($_POST['mobile_loan'])) {
			$mobile_loan = $_POST['mobile_loan'];
		}
		if (isset($_POST['pic_loan'])) {
			$pic_loan = $_POST['pic_loan'];
		}
		if (isset($_POST['loan_category'])) {
			$loan_category = $_POST['loan_category'];
		}
		if (isset($_POST['sub_category'])) {
			$sub_category = $_POST['sub_category'];
		}
		$category_info = [];
		if (isset($_POST['category_info'])) {
			$category_info = $_POST['category_info'];
		}
		$tot_value = '';
		if (isset($_POST['tot_value'])) {
			$tot_value = $_POST['tot_value'];
		}
		$ad_amt = '';
		if (isset($_POST['ad_amt'])) {
			$ad_amt = $_POST['ad_amt'];
		}
		if (isset($_POST['loan_amt'])) {
			$loan_amt = $_POST['loan_amt'];
		}
		if (isset($_POST['profit_type'])) {
			$profit_type = $_POST['profit_type'];
		}
		$due_method_calc = '';
		if (isset($_POST['due_method_calc'])) {
			$due_method_calc = $_POST['due_method_calc'];
			if ($profit_type == '2') {
				$due_method_calc = '';
			}
		}
		$due_type = '';
		if (isset($_POST['due_type'])) {
			$due_type = $_POST['due_type'];
			if ($profit_type == '2') {
				$due_type = '';
			}
		}
		$profit_method = '';
		if (isset($_POST['profit_method'])) {
			$profit_method = $_POST['profit_method'];
			if ($profit_type == '2') {
				$profit_method = '';
			}
		}
		$calc_method = '';
		if (isset($_POST['calc_method'])) {
			$calc_method = $_POST['calc_method'];
			if ($profit_type == '2') {
				$calc_method = '';
			}
		}
		$due_method_scheme = '';
		if (isset($_POST['due_method_scheme'])) {
			$due_method_scheme = $_POST['due_method_scheme'];
			if ($profit_type == '1') {
				$due_method_scheme = '';
			}
		}
		$scheme_profit_method = '';
		if (isset($_POST['scheme_profit_method'])) {
			$scheme_profit_method = $_POST['scheme_profit_method'];
			if ($profit_type == '1') {
				$scheme_profit_method = '';
			}
		}
		$day_scheme = '';
		if (isset($_POST['day_scheme'])) {
			$day_scheme = $_POST['day_scheme'];
			if ($profit_type == '1') {
				$day_scheme = '';
			}
		}
		$scheme_name = '';
		if (isset($_POST['scheme_name'])) {
			$scheme_name = $_POST['scheme_name'];
			if ($profit_type == '1') {
				$scheme_name = '';
			}
		}
		if (isset($_POST['int_rate'])) {
			$int_rate = $_POST['int_rate'];
		}
		if (isset($_POST['due_period'])) {
			$due_period = $_POST['due_period'];
		}
		if (isset($_POST['doc_charge'])) {
			$doc_charge = $_POST['doc_charge'];
		}
		if (isset($_POST['proc_fee'])) {
			$proc_fee = $_POST['proc_fee'];
		}
		if (isset($_POST['loan_amt_cal'])) {
			$loan_amt_cal = $_POST['loan_amt_cal'];
		}
		if (isset($_POST['principal_amt_cal'])) {
			$principal_amt_cal = $_POST['principal_amt_cal'];
		}
		if (isset($_POST['int_amt_cal'])) {
			$int_amt_cal = $_POST['int_amt_cal'];
		}
		$tot_amt_cal = '';
		if (isset($_POST['tot_amt_cal'])) {
			$tot_amt_cal = $_POST['tot_amt_cal'];
		}
		$due_amt_cal = '';
		if (isset($_POST['due_amt_cal'])) {
			$due_amt_cal = $_POST['due_amt_cal'];
		}
		if (isset($_POST['doc_charge_cal'])) {
			$doc_charge_cal = $_POST['doc_charge_cal'];
		}
		if (isset($_POST['proc_fee_cal'])) {
			$proc_fee_cal = $_POST['proc_fee_cal'];
		}
		if (isset($_POST['net_cash_cal'])) {
			$net_cash_cal = $_POST['net_cash_cal'];
		}
		if (isset($_POST['due_start_from'])) {
			$due_start_from = $_POST['due_start_from'];
		}
		if (isset($_POST['maturity_month'])) {
			$maturity_month = $_POST['maturity_month'];
		}
		if (isset($_POST['collection_method'])) {
			$collection_method = $_POST['collection_method'];
		}
		if (isset($_POST['loan_cal_id'])) { //To check Whether it is for update 
			$loan_cal_id = $_POST['loan_cal_id'];
		}
		if (isset($_POST['Communitcation_to_cus'])) {
			$Communitcation_to_cus = $_POST['Communitcation_to_cus'];
		}

		if (!empty($_FILES['verification_audio']['name'])) {
			$verify_audio = $_FILES['verification_audio']['name'];
			$audio_temp = $_FILES['verification_audio']['tmp_name'];
			$audiofolder = "uploads/verification/verifyInfo_audio/" . $verify_audio;

			$qry = $mysqli->query("SELECT * From verification_loan_calculation where req_id = $req_id");
			if ($qry->num_rows == 0) {
				//this will protect uploading same file again into server incase of resubmittion
				$fileExtension = pathinfo($audiofolder, PATHINFO_EXTENSION); //get the file extention
				$verify_audio = uniqid() . '.' . $fileExtension;
				while (file_exists("uploads/verification/verifyInfo_audio/" . $verify_audio)) {
					//this loop will continue until it generates a unique file name
					$verify_audio = uniqid() . '.' . $fileExtension;
				}
				move_uploaded_file($audio_temp, "uploads/verification/verifyInfo_audio/" . $verify_audio);
			}
		} else {
			$verify_audio = $_POST['verification_audio_upd'];
		}
		if (isset($_POST['verifyPerson'])) {
			$verifyPerson = $_POST['verifyPerson'];
		}
		if (isset($_POST['verification_location'])) {
			$verification_location = $_POST['verification_location'];
		}


		if ($loan_cal_id > 0 and $loan_cal_id != '') {
			$mysqli->query("UPDATE verification_loan_calculation SET cus_id_loan = '" . strip_tags($cus_id_loan) . "', cus_name_loan = '" . strip_tags($cus_name_loan) . "', 
			cus_data_loan = '" . strip_tags($cus_data_loan) . "', mobile_loan = '" . strip_tags($mobile_loan) . "', pic_loan = '" . strip_tags($pic_loan) . "', 
				loan_category = '" . strip_tags($loan_category) . "', sub_category = '" . strip_tags($sub_category) . "', tot_value = '" . strip_tags($tot_value) . "', ad_amt = '" . strip_tags($ad_amt) . "',
				loan_amt = '" . strip_tags($loan_amt) . "', profit_type = '" . strip_tags($profit_type) . "', due_method_calc = '" . strip_tags($due_method_calc) . "', 
				due_type = '" . strip_tags($due_type) . "', profit_method = '" . strip_tags($profit_method) . "', calc_method = '" . strip_tags($calc_method) . "', 
				due_method_scheme = '" . strip_tags($due_method_scheme) . "',profit_method_scheme = '" . strip_tags($scheme_profit_method) . "', day_scheme = '" . strip_tags($day_scheme) . "', scheme_name = '" . strip_tags($scheme_name) . "', 
				int_rate = '" . strip_tags($int_rate) . "', due_period = '" . strip_tags($due_period) . "', doc_charge = '" . strip_tags($doc_charge) . "', proc_fee = '" . strip_tags($proc_fee) . "', 
				loan_amt_cal = '" . strip_tags($loan_amt_cal) . "', principal_amt_cal = '" . strip_tags($principal_amt_cal) . "', int_amt_cal = '" . strip_tags($int_amt_cal) . "', 
				tot_amt_cal = '" . strip_tags($tot_amt_cal) . "', due_amt_cal = '" . strip_tags($due_amt_cal) . "', doc_charge_cal = '" . strip_tags($doc_charge_cal) . "', 
				proc_fee_cal = '" . strip_tags($proc_fee_cal) . "', net_cash_cal = '" . strip_tags($net_cash_cal) . "', due_start_from = '" . strip_tags($due_start_from) . "', 
				maturity_month = '" . strip_tags($maturity_month) . "', collection_method = '" . strip_tags($collection_method) . "',
				`communication`='" . strip_tags($Communitcation_to_cus) . "',`com_audio`='" . strip_tags($verify_audio) . "',`verification_person`='" . strip_tags($verifyPerson) . "',`verification_location`='" . strip_tags($verification_location) . "',
				cus_status = 12, update_login_id = $userid, 
				update_date = current_timestamp() WHERE req_id = $req_id ");

			$mysqli->query("DELETE FROM verif_loan_cal_category where req_id = '" . strip_tags($req_id) . "' and loan_cal_id='" . strip_tags($loan_cal_id) . "'");

			for ($i = 0; $i < sizeof($category_info); $i++) {
				$mysqli->query("INSERT INTO `verif_loan_cal_category`(`req_id`, `loan_cal_id`, `category`) VALUES ('" . strip_tags($req_id) . "','" . strip_tags($loan_cal_id) . "',
				'" . strip_tags($category_info[$i]) . "' )");
			}
		} else {
			$qry = $mysqli->query("SELECT * From verification_loan_calculation where req_id = $req_id");
			if ($qry->num_rows == 0) {
				//this will filter out duplication entry in customer profile table

				$mysqli->query("INSERT INTO verification_loan_calculation (`req_id`, `cus_id_loan`, `cus_name_loan`,`cus_data_loan`, `mobile_loan`, `pic_loan`, `loan_category`, `sub_category`,
				`tot_value`, `ad_amt`, `loan_amt`, `profit_type`, `due_method_calc`, `due_type`, `profit_method`, `calc_method`, `due_method_scheme`,`profit_method_scheme`, `day_scheme`, `scheme_name`, 
				`int_rate`, `due_period`, `doc_charge`, `proc_fee`, `loan_amt_cal`, `principal_amt_cal`, `int_amt_cal`, `tot_amt_cal`, `due_amt_cal`, `doc_charge_cal`, `proc_fee_cal`, `net_cash_cal`,
				`due_start_from`, `maturity_month`, `collection_method`,  `communication`, `com_audio`, `verification_person`, `verification_location`, `cus_status`, `insert_login_id`,`create_date`) 
				VALUES ('" . strip_tags($req_id) . "', '" . strip_tags($cus_id_loan) . "', 
				'" . strip_tags($cus_name_loan) . "', '" . strip_tags($cus_data_loan) . "','" . strip_tags($mobile_loan) . "', '" . strip_tags($pic_loan) . "', '" . strip_tags($loan_category) . "', 
				'" . strip_tags($sub_category) . "', '" . strip_tags($tot_value) . "', '" . strip_tags($ad_amt) . "', '" . strip_tags($loan_amt) . "', '" . strip_tags($profit_type) . "', 
				'" . strip_tags($due_method_calc) . "', '" . strip_tags($due_type) . "', '" . strip_tags($profit_method) . "', '" . strip_tags($calc_method) . "', '" . strip_tags($due_method_scheme) . "', 
				'" . strip_tags($scheme_profit_method) . "','" . strip_tags($day_scheme) . "', '" . strip_tags($scheme_name) . "', '" . strip_tags($int_rate) . "', '" . strip_tags($due_period) . "', '" . strip_tags($doc_charge) . "', 
				'" . strip_tags($proc_fee) . "', '" . strip_tags($loan_amt_cal) . "', '" . strip_tags($principal_amt_cal) . "', '" . strip_tags($int_amt_cal) . "', '" . strip_tags($tot_amt_cal) . "', 
				'" . strip_tags($due_amt_cal) . "', '" . strip_tags($doc_charge_cal) . "', '" . strip_tags($proc_fee_cal) . "', '" . strip_tags($net_cash_cal) . "', '" . strip_tags($due_start_from) . "', 
				'" . strip_tags($maturity_month) . "', '" . strip_tags($collection_method) . "',
				'" . strip_tags($Communitcation_to_cus) . "','" . strip_tags($verify_audio) . "','" . strip_tags($verifyPerson) . "','" . strip_tags($verification_location) . "', 12, $userid, current_timestamp()) ");
				$loan_cal_id = $mysqli->insert_id;

				for ($i = 0; $i < sizeof($category_info); $i++) {
					$mysqli->query("INSERT INTO `verif_loan_cal_category`(`req_id`, `loan_cal_id`, `category`) VALUES ('" . strip_tags($req_id) . "','" . strip_tags($loan_cal_id) . "',
				'" . strip_tags($category_info[$i]) . "' )");
				}

			}
		}
		$mysqli->query("UPDATE request_creation set cus_status = 12,updated_date=now() where req_id ='" . strip_tags($req_id) . "' "); //12 means loan calculation completed

		$mysqli->query("UPDATE in_verification set cus_status = 12,updated_date=now() where req_id ='" . strip_tags($req_id) . "' ");
	}

	function getLoanCalculationForVerification($mysqli, $req_id)
	{
		$detailrecords = array();
		$Qry = $mysqli->query("SELECT * FROM `verification_loan_calculation` WHERE req_id = '" . strip_tags($req_id) . "' ");
		if ($mysqli->affected_rows > 0) {
			while ($row = $Qry->fetch_assoc()) {
				$detailrecords['loan_cal_id'] = $row['loan_cal_id'];
				// $detailrecords['req_id'] = $row['req_id'];
				$detailrecords['cus_id_loan'] = $row['cus_id_loan'];
				$detailrecords['cus_name_loan'] = $row['cus_name_loan'];
				$detailrecords['cus_data_loan'] = $row['cus_data_loan'];
				$detailrecords['mobile_loan'] = $row['mobile_loan'];
				$detailrecords['pic_loan'] = $row['pic_loan'];
				$detailrecords['loan_category'] = $row['loan_category'];
				$detailrecords['sub_category'] = $row['sub_category'];
				$detailrecords['tot_value'] = $row['tot_value'];
				$detailrecords['ad_amt'] = $row['ad_amt'];
				$detailrecords['loan_amt'] = $row['loan_amt'];
				$detailrecords['profit_type'] = $row['profit_type'];
				$detailrecords['due_method_calc'] = $row['due_method_calc'];
				$detailrecords['due_type'] = $row['due_type'];
				$detailrecords['profit_method'] = $row['profit_method'];
				$detailrecords['calc_method'] = $row['calc_method'];
				$detailrecords['due_method_scheme'] = $row['due_method_scheme'];
				$detailrecords['day_scheme'] = $row['day_scheme'];
				$detailrecords['scheme_name'] = $row['scheme_name'];
				$detailrecords['scheme_profit_method'] = $row['profit_method_scheme'];
				$detailrecords['int_rate'] = $row['int_rate'];
				$detailrecords['due_period'] = $row['due_period'];
				$detailrecords['doc_charge'] = $row['doc_charge'];
				$detailrecords['proc_fee'] = $row['proc_fee'];
				$detailrecords['loan_amt_cal'] = $row['loan_amt_cal'];
				$detailrecords['principal_amt_cal'] = $row['principal_amt_cal'];
				$detailrecords['int_amt_cal'] = $row['int_amt_cal'];
				$detailrecords['tot_amt_cal'] = $row['tot_amt_cal'];
				$detailrecords['due_amt_cal'] = $row['due_amt_cal'];
				$detailrecords['doc_charge_cal'] = $row['doc_charge_cal'];
				$detailrecords['proc_fee_cal'] = $row['proc_fee_cal'];
				$detailrecords['net_cash_cal'] = $row['net_cash_cal'];
				$detailrecords['due_start_from'] = $row['due_start_from'];
				$detailrecords['maturity_month'] = $row['maturity_month'];
				$detailrecords['collection_method'] = $row['collection_method'];
				$detailrecords['communication'] = $row['communication'];
				$detailrecords['com_audio'] = $row['com_audio'];
				$detailrecords['verification_person'] = $row['verification_person'];
				$detailrecords['verification_location'] = $row['verification_location'];
				$detailrecords['cus_status'] = $row['cus_status'];
			}
		}
		return $detailrecords;
	}

	//Get Loan calculation Category info for edit
	function getVerificationLoanCalCategory($mysqli, $loan_cal_id)
	{
		$detailrecords = array();
		$Qry = $mysqli->query("SELECT * FROM `verif_loan_cal_category` WHERE loan_cal_id = '" . strip_tags($loan_cal_id) . "' ");
		if ($mysqli->affected_rows > 0) {
			$i = 0;
			while ($row = $Qry->fetch_assoc()) {
				$detailrecords[$i]['req_id'] = $row['req_id'];
				$detailrecords[$i]['loan_cal_id'] = $row['loan_cal_id'];
				$detailrecords[$i]['category'] = $row['category'];
				$i++;
			}
		}
		return $detailrecords;
	}

	///  Acknowlegement Start

	// Get Acknowlegement Customer Profile Info.
	public function getAcknowlegeCustomerProfile($mysqli, $req_id)
	{

		$qry = $mysqli->query("SELECT cp.*,cr.how_to_know,cr.loan_count,cr.first_loan_date,cr.travel_with_company,cr.monthly_income,cr.other_income,cr.support_income,cr.commitment,cr.monthly_due_capacity,cr.loan_limit,cr.about_customer FROM `acknowlegement_customer_profile` cp  LEFT JOIN `customer_register` cr on cp.cus_id = cr.cus_id WHERE cp.req_id='$req_id' ");
		$detailrecords = array();
		$i = 0;
		if ($mysqli->affected_rows > 0) {
			while ($row = $qry->fetch_assoc()) {
				$detailrecords['cus_Tableid'] = $row['id'];
				$detailrecords['req_id'] = $row['req_id'];
				$detailrecords['cus_id'] = $row['cus_id'];
				$detailrecords['cus_name'] = $row['cus_name'];
				$detailrecords['gender'] = $row['gender'];
				$detailrecords['dob'] = $row['dob'];
				$detailrecords['age'] = $row['age'];
				$detailrecords['blood_group'] = $row['blood_group'];
				$detailrecords['mobile1'] = $row['mobile1'];
				$detailrecords['mobile2'] = $row['mobile2'];
				$detailrecords['whatsapp'] = $row['whatsapp'];
				$detailrecords['cus_pic'] = $row['cus_pic'];
				$detailrecords['guarentor_name'] = $row['guarentor_name'];
				$detailrecords['guarentor_relation'] = $row['guarentor_relation'];
				$detailrecords['guarentor_photo'] = $row['guarentor_photo'];
				$detailrecords['cus_type'] = $row['cus_type'];
				$detailrecords['cus_exist_type'] = $row['cus_exist_type'];
				$detailrecords['residential_type'] = $row['residential_type'];
				$detailrecords['residential_details'] = $row['residential_details'];
				$detailrecords['residential_address'] = $row['residential_address'];
				$detailrecords['residential_native_address'] = $row['residential_native_address'];
				$detailrecords['occupation_type'] = $row['occupation_type'];
				$detailrecords['occupation_details'] = $row['occupation_details'];
				$detailrecords['occupation_income'] = $row['occupation_income'];
				$detailrecords['occupation_address'] = $row['occupation_address'];
				$detailrecords['area_confirm_type'] = $row['area_confirm_type'];
				$detailrecords['area_confirm_state'] = $row['area_confirm_state'];
				$detailrecords['area_confirm_district'] = $row['area_confirm_district'];
				$detailrecords['area_confirm_taluk'] = $row['area_confirm_taluk'];
				$detailrecords['area_confirm_area'] = $row['area_confirm_area'];
				$detailrecords['area_confirm_subarea'] = $row['area_confirm_subarea'];
				$detailrecords['latlong'] = $row['latlong'];
				$detailrecords['area_group'] = $row['area_group'];
				$detailrecords['area_line'] = $row['area_line'];
				$detailrecords['communication'] = $row['communication'];
				$detailrecords['com_audio'] = $row['com_audio'];
				$detailrecords['verification_person'] = $row['verification_person'];
				$detailrecords['verification_location'] = $row['verification_location'];
				$detailrecords['cus_status'] = $row['cus_status'];
				$detailrecords['how_to_know'] = $row['how_to_know'];
				$detailrecords['loan_count'] = $row['loan_count'];
				$detailrecords['first_loan_date'] = $row['first_loan_date'];
				$detailrecords['travel_with_company'] = $row['travel_with_company'];
				$detailrecords['monthly_income'] = $row['monthly_income'];
				$detailrecords['other_income'] = $row['other_income'];
				$detailrecords['support_income'] = $row['support_income'];
				$detailrecords['commitment'] = $row['commitment'];
				$detailrecords['monthly_due_capacity'] = $row['monthly_due_capacity'];
				$detailrecords['loan_limit'] = $row['loan_limit'];
				$detailrecords['about_customer'] = $row['about_customer'];
				$detailrecords['dow'] = $row['dow'];
				$detailrecords['abt_occ'] = $row['abt_occ'];
				$i++;
			}
		}

		return $detailrecords;
	}

	// Add Acknowlegement Documentation
	public function addAcknowlegeDocumentation($mysqli, $userid)
	{
		if (isset($_POST['req_id'])) {
			$req_id = $_POST['req_id'];
		}
		if (isset($_POST['cus_id_doc'])) {
			$cus_id_doc = $_POST['cus_id_doc'];
		}
		if (isset($_POST['Customer_name'])) {
			$Customer_name = $_POST['Customer_name'];
		}
		if (isset($_POST['cus_profile_id'])) {
			$cus_profile_id = $_POST['cus_profile_id'];
		}
		if (isset($_POST['doc_id'])) {
			$doc_id =  $_POST['doc_id'];
		}
		if (isset($_POST['mortgage_process_post'])) {
			$mortgage_process = $_POST['mortgage_process_post'];
		}
		if (isset($_POST['Propertyholder_type'])) {
			$Propertyholder_type = $_POST['Propertyholder_type'];
		}
		$Propertyholder_name = '';
		if (isset($_POST['Propertyholder_name'])) {
			$Propertyholder_name = $_POST['Propertyholder_name'];
		}
		$Propertyholder_relationship_name = '';
		if (isset($_POST['Propertyholder_relationship_name'])) {
			$Propertyholder_relationship_name = $_POST['Propertyholder_relationship_name'];
		}
		if (isset($_POST['doc_property_relation'])) {
			$doc_property_relation = $_POST['doc_property_relation'];
		}
		if (isset($_POST['doc_property_pype'])) {
			$doc_property_pype = $_POST['doc_property_pype'];
		}
		if (isset($_POST['doc_property_measurement'])) {
			$doc_property_measurement = $_POST['doc_property_measurement'];
		}
		if (isset($_POST['doc_property_location'])) {
			$doc_property_location = $_POST['doc_property_location'];
		}
		if (isset($_POST['doc_property_value'])) {
			$doc_property_value = $_POST['doc_property_value'];
		}
		if (isset($_POST['mortgage_name'])) {
			$mortgage_name = $_POST['mortgage_name'];
		}
		if (isset($_POST['mortgage_dsgn'])) {
			$mortgage_dsgn = $_POST['mortgage_dsgn'];
		}
		if (isset($_POST['mortgage_nuumber'])) {
			$mortgage_nuumber = $_POST['mortgage_nuumber'];
		}
		if (isset($_POST['reg_office'])) {
			$reg_office = $_POST['reg_office'];
		}
		if (isset($_POST['mortgage_value'])) {
			$mortgage_value = $_POST['mortgage_value'];
		}
		if (isset($_POST['mortgage_document'])) {
			$mortgage_document = $_POST['mortgage_document'];
		}
		$pendingchk = 'NO';
		if (!empty($_FILES['mortgage_document_upd']['name'])) {
			$mortgage_document_upd = $_FILES['mortgage_document_upd']['name'];
			$upd_temp = $_FILES['mortgage_document_upd']['tmp_name'];
			$folder = "uploads/verification/mortgage_doc/" . $mortgage_document_upd;

			$qry = $mysqli->query("SELECT * From acknowlegement_documentation where req_id = $req_id");
			if ($qry->num_rows == 0) {
				//this will protect uploading same file again into server incase of resubmittion
				$fileExtension = pathinfo($folder, PATHINFO_EXTENSION); //get the file extention
				$mortgage_document_upd = uniqid() . '.' . $fileExtension;
				while (file_exists("uploads/verification/mortgage_doc/" . $mortgage_document_upd)) {
					//this loop will continue until it generates a unique file name
					$mortgage_document_upd = uniqid() . '.' . $fileExtension;
				}
				move_uploaded_file($upd_temp, "uploads/verification/mortgage_doc/" . $mortgage_document_upd);
			}
		} else if (isset($_POST['mortgage_doc_upd']) and $_POST['mortgage_doc_upd'] != '') {
			$mortgage_document_upd = $_POST['mortgage_doc_upd'];
		} else {
			if (isset($_POST['pendingchk'])) {
				$pendingchk = $_POST['pendingchk'];
				$mortgage_document_upd = '';
			}
		}
		if (isset($_POST['endorsement_process_post'])) {
			$endorsement_process = $_POST['endorsement_process_post'];
		}
		if (isset($_POST['owner_type'])) {
			$owner_type = $_POST['owner_type'];
		}
		$owner_name = '';
		if (isset($_POST['owner_name'])) {
			$owner_name = $_POST['owner_name'];
		}
		$ownername_relationship_name = '';
		if (isset($_POST['ownername_relationship_name'])) {
			$ownername_relationship_name = $_POST['ownername_relationship_name'];
		}
		if (isset($_POST['en_relation'])) {
			$en_relation = $_POST['en_relation'];
		}
		if (isset($_POST['vehicle_type'])) {
			$vehicle_type = $_POST['vehicle_type'];
		}
		if (isset($_POST['vehicle_process'])) {
			$vehicle_process = $_POST['vehicle_process'];
		}
		if (isset($_POST['en_Company'])) {
			$en_Company = $_POST['en_Company'];
		}

		if (isset($_POST['en_Model'])) {
			$en_Model = $_POST['en_Model'];
		}
		$vehicle_reg_no = '';
		if (isset($_POST['vehicle_reg_no'])) {
			$vehicle_reg_no = $_POST['vehicle_reg_no'];
		}
		if (isset($_POST['endorsement_name'])) {
			$endorsement_name = $_POST['endorsement_name'];
		}
		if (isset($_POST['en_RC'])) {
			$en_RC = $_POST['en_RC'];
		}
		$endorsependingchk = 'NO';
		if (!empty($_FILES['Rc_document_upd']['name'])) {
			$Rc_document_upd = $_FILES['Rc_document_upd']['name'];
			$upd_temp = $_FILES['Rc_document_upd']['tmp_name'];
			$folder = "uploads/verification/endorsement_doc/" . $Rc_document_upd;

			$qry = $mysqli->query("SELECT * From acknowlegement_documentation where req_id = $req_id");
			if ($qry->num_rows == 0) {
				//this will protect uploading same file again into server incase of resubmittion
				$fileExtension = pathinfo($folder, PATHINFO_EXTENSION); //get the file extention
				$Rc_document_upd = uniqid() . '.' . $fileExtension;
				while (file_exists("uploads/verification/endorsement_doc/" . $Rc_document_upd)) {
					//this loop will continue until it generates a unique file name
					$Rc_document_upd = uniqid() . '.' . $fileExtension;
				}
				move_uploaded_file($upd_temp, "uploads/verification/endorsement_doc/" . $Rc_document_upd);
			}
		} else if (isset($_POST['rc_doc_upd']) and $_POST['rc_doc_upd'] != '') {
			$Rc_document_upd = $_POST['rc_doc_upd'];
		} else {
			if (isset($_POST['endorsependingchk'])) {
				$endorsependingchk = $_POST['endorsependingchk'];
				$Rc_document_upd = '';
			}
		}
		if (isset($_POST['en_Key'])) {
			$en_Key = $_POST['en_Key'];
		}

		if (isset($_POST['adhar_print'])) {
			$adhar_print = $_POST['adhar_print'];
		}
		if (isset($_POST['name_print'])) {
			$name_print = $_POST['name_print'];
		}
		if (isset($_POST['fingerprint'])) {
			$fingerprint = $_POST['fingerprint'];
		}
		if (isset($_POST['hand_selection'])) {
			$hand = $_POST['hand_selection'];
		}

		if (isset($_POST['doc_table_id'])) {
			$doc_table_id = $_POST['doc_table_id'];
		}


		if ($doc_table_id == '') {
			$qry = $mysqli->query("SELECT * From acknowlegement_documentation where req_id = $req_id");
			if ($qry->num_rows == 0) {
				//this will filter out duplication entry in customer profile table
				$insertQry = "INSERT INTO `acknowlegement_documentation`( `req_id`, `cus_id_doc`, `customer_name`, `cus_profile_id`, `doc_id`, `mortgage_process`, `Propertyholder_type`, `Propertyholder_name`, `Propertyholder_relationship_name`, `doc_property_relation`, `doc_property_type`, `doc_property_measurement`, `doc_property_location`, `doc_property_value`, `endorsement_process`, `owner_type`, `owner_name`, `ownername_relationship_name`, `en_relation`, `vehicle_type`, `vehicle_process`, `en_Company`, `en_Model`, `cus_status`, `insert_login_id`) VALUES('" . strip_tags($req_id) . "','" . strip_tags($cus_id_doc) . "','" . strip_tags($Customer_name) . "','" . strip_tags($cus_profile_id) . "','" . strip_tags($doc_id) . "', '" . strip_tags($mortgage_process) . "', '" . strip_tags($Propertyholder_type) . "', '" . strip_tags($Propertyholder_name) . "','" . strip_tags($Propertyholder_relationship_name) . "','" . strip_tags($doc_property_relation) . "','" . strip_tags($doc_property_pype) . "','" . strip_tags($doc_property_measurement) . "', '" . strip_tags($doc_property_location) . "', '" . strip_tags($doc_property_value) . "', '" . strip_tags($endorsement_process) . "','" . strip_tags($owner_type) . "','" . strip_tags($owner_name) . "','" . strip_tags($ownername_relationship_name) . "','" . strip_tags($en_relation) . "','" . strip_tags($vehicle_type) . "','" . strip_tags($vehicle_process) . "','" . strip_tags($en_Company) . "','" . strip_tags($en_Model) . "','11','" . $userid . "' )";

				$insresult = $mysqli->query($insertQry) or die("Error " . $mysqli->error);
			}
		} else {
			$update_doc = " UPDATE `acknowlegement_documentation` SET `req_id`='" . strip_tags($req_id) . "',`cus_id_doc`='" . strip_tags($cus_id_doc) . "',`customer_name`='" . strip_tags($Customer_name) . "',`cus_profile_id`='" . strip_tags($cus_profile_id) . "',`doc_id`='" . strip_tags($doc_id) . "',`mortgage_process`='" . strip_tags($mortgage_process) . "',`Propertyholder_type`='" . strip_tags($Propertyholder_type) . "',`Propertyholder_name`='" . strip_tags($Propertyholder_name) . "',`Propertyholder_relationship_name`='" . strip_tags($Propertyholder_relationship_name) . "',`doc_property_relation`='" . strip_tags($doc_property_relation) . "',`doc_property_type`='" . strip_tags($doc_property_pype) . "',`doc_property_measurement`='" . strip_tags($doc_property_measurement) . "',`doc_property_location`='" . strip_tags($doc_property_location) . "',`doc_property_value`='" . strip_tags($doc_property_value) . "',`mortgage_name`='" . strip_tags($mortgage_name) . "',`mortgage_dsgn`='" . strip_tags($mortgage_dsgn) . "',`mortgage_nuumber`='" . strip_tags($mortgage_nuumber) . "',`reg_office`='" . strip_tags($reg_office) . "',`mortgage_value`='" . strip_tags($mortgage_value) . "',`mortgage_document`='" . strip_tags($mortgage_document) . "',`mortgage_document_upd`='" . strip_tags($mortgage_document_upd) . "',`mortgage_document_pending`='" . strip_tags($pendingchk) . "',`endorsement_process`='" . strip_tags($endorsement_process) . "',`owner_type`='" . strip_tags($owner_type) . "',`owner_name`='" . strip_tags($owner_name) . "',`ownername_relationship_name`='" . strip_tags($ownername_relationship_name) . "',`en_relation`='" . strip_tags($en_relation) . "',`vehicle_type`='" . strip_tags($vehicle_type) . "',`vehicle_process`='" . strip_tags($vehicle_process) . "',`en_Company`='" . strip_tags($en_Company) . "',`en_Model`='" . strip_tags($en_Model) . "',`vehicle_reg_no`='" . strip_tags($vehicle_reg_no) . "',`endorsement_name`='" . strip_tags($endorsement_name) . "',`en_RC`='" . strip_tags($en_RC) . "',`Rc_document_upd`='" . strip_tags($Rc_document_upd) . "',`Rc_document_pending`='" . strip_tags($endorsependingchk) . "',`en_Key`='" . strip_tags($en_Key) . "',`status`='0',`submitted`='1',`update_login_id`='" . $userid . "' WHERE `id` = '" . strip_tags($doc_table_id) . "' ";

			$updDocResult = $mysqli->query($update_doc) or die("Error " . $mysqli->error);
		}

		//iterate thru fingerprint array
		for ($i = 0; $i < sizeof($fingerprint); $i++) {
			// allow only if fingerprint has been entered
			if ($fingerprint[$i] != '') {
				//check whether this adhar number already have fingerprint
				$qry = $mysqli->query("SELECT adhar_num from `fingerprints` where adhar_num='" . strip_tags($adhar_print[$i]) . "' ");
				if ($qry->num_rows == 0) {
					//insert finger prints as new values if not already exist
					$qry = "INSERT INTO `fingerprints`(`adhar_num`, `name`,`hand`,`ansi_template`, `insert_user_id`, `created_date`) VALUES ('" . $adhar_print[$i] . "','" . $name_print[$i] . "','" . $hand[$i] . "','" . $fingerprint[$i] . "',$userid,now() ) ";
					$result = $mysqli->query($qry) or die("Error " . $mysqli->error);
				} else {
					//update fingerprint at that adhar number if already exist
					$qry = "UPDATE `fingerprints` SET `hand`='" . $hand[$i] . "',`ansi_template`='" . $fingerprint[$i] . "',`update_user_id`='$userid',`updated_date`= now() WHERE `adhar_num`='" . strip_tags($adhar_print[$i]) . "' ";
					$result = $mysqli->query($qry) or die("Error " . $mysqli->error);
				}
			}
		}
	}

	// Get Customer Info for Documentation from Customer_profile table.
	public function getAckcusInfoForDoc($mysqli, $req_id)
	{

		$qry = $mysqli->query("SELECT * FROM acknowlegement_customer_profile where req_id = $req_id ");
		$detailrecords = array();
		$i = 0;
		if ($mysqli->affected_rows > 0) {
			while ($row = $qry->fetch_assoc()) {
				$detailrecords['cus_profile_id'] = $row['id'];
				$detailrecords['cus_id'] = $row['cus_id'];
				$detailrecords['cus_name'] = $row['cus_name'];
				$detailrecords['area_confirm_area'] = $row['area_confirm_area'];
				$detailrecords['area_confirm_subarea'] = $row['area_confirm_subarea'];
				$detailrecords['cus_status'] = $row['cus_status'];


				$result = $mysqli->query("SELECT area_name FROM area_list_creation where area_id = '" . $detailrecords['area_confirm_area'] . "' and status=0 and area_enable = 0");
				$area = $result->fetch_assoc();
				$detailrecords['area_name'] = $area['area_name'];

				$subarearesult = $mysqli->query("SELECT sub_area_name FROM sub_area_list_creation where sub_area_id = '" . $detailrecords['area_confirm_subarea'] . "' and status=0 and sub_area_enable = 0");
				$subarea = $subarearesult->fetch_assoc();
				$detailrecords['sub_area_name'] = $subarea['sub_area_name'];


				$i++;
			}
		}
		return $detailrecords;
	}

	// Get Documentation Info.
	public function getAcknowlegementDocument($mysqli, $req_id)
	{

		$qry = $mysqli->query("SELECT * FROM acknowlegement_documentation where req_id = $req_id ");
		$detailrecords = array();
		$i = 0;
		if ($mysqli->affected_rows > 0) {
			while ($row = $qry->fetch_assoc()) {
				$detailrecords['doc_Tableid'] = $row['id'];
				$detailrecords['req_id'] = $row['req_id'];
				$detailrecords['mortgage_process'] = $row['mortgage_process'];
				$detailrecords['Propertyholder_type'] = $row['Propertyholder_type'];
				$detailrecords['Propertyholder_name'] = $row['Propertyholder_name'];
				$detailrecords['Propertyholder_relationship_name'] = $row['Propertyholder_relationship_name'];
				$detailrecords['doc_property_relation'] = $row['doc_property_relation'];
				$detailrecords['doc_property_type'] = $row['doc_property_type'];
				$detailrecords['doc_property_measurement'] = $row['doc_property_measurement'];
				$detailrecords['doc_property_location'] = $row['doc_property_location'];
				$detailrecords['doc_property_value'] = $row['doc_property_value'];
				$detailrecords['mortgage_name'] = $row['mortgage_name'];
				$detailrecords['mortgage_dsgn'] = $row['mortgage_dsgn'];
				$detailrecords['mortgage_nuumber'] = $row['mortgage_nuumber'];
				$detailrecords['reg_office'] = $row['reg_office'];
				$detailrecords['mortgage_value'] = $row['mortgage_value'];
				$detailrecords['mortgage_document'] = $row['mortgage_document'];
				$detailrecords['mortgage_document_upd'] = $row['mortgage_document_upd'];
				$detailrecords['mortgage_document_pending'] = $row['mortgage_document_pending'];
				$detailrecords['endorsement_process'] = $row['endorsement_process'];
				$detailrecords['owner_type'] = $row['owner_type'];
				$detailrecords['owner_name'] = $row['owner_name'];
				$detailrecords['ownername_relationship_name'] = $row['ownername_relationship_name'];
				$detailrecords['en_relation'] = $row['en_relation'];
				$detailrecords['vehicle_type'] = $row['vehicle_type'];
				$detailrecords['vehicle_process'] = $row['vehicle_process'];
				$detailrecords['en_Company'] = $row['en_Company'];
				$detailrecords['en_Model'] = $row['en_Model'];
				$detailrecords['vehicle_reg_no'] = $row['vehicle_reg_no'];
				$detailrecords['endorsement_name'] = $row['endorsement_name'];
				$detailrecords['en_RC'] = $row['en_RC'];
				$detailrecords['Rc_document_upd'] = $row['Rc_document_upd'];
				$detailrecords['Rc_document_pending'] = $row['Rc_document_pending'];
				$detailrecords['en_Key'] = $row['en_Key'];
				$detailrecords['gold_info'] = $row['gold_info'];
				$detailrecords['gold_sts'] = $row['gold_sts'];
				$detailrecords['gold_type'] = $row['gold_type'];
				$detailrecords['Purity'] = $row['Purity'];
				$detailrecords['gold_Count'] = $row['gold_Count'];
				$detailrecords['gold_Weight'] = $row['gold_Weight'];
				$detailrecords['gold_Value'] = $row['gold_Value'];
				$detailrecords['document_name'] = $row['document_name'];
				$detailrecords['document_details'] = $row['document_details'];
				$detailrecords['document_type'] = $row['document_type'];
				$detailrecords['doc_info_upload'] = $row['doc_info_upload'];
				$detailrecords['document_holder'] = $row['document_holder'];
				$detailrecords['docholder_name'] = $row['docholder_name'];
				$detailrecords['docholder_relationship_name'] = $row['docholder_relationship_name'];
				$detailrecords['doc_relation'] = $row['doc_relation'];
				$detailrecords['cus_status'] = $row['cus_status'];
				$detailrecords['submitted'] = $row['submitted'];

				$i++;
			}
		}

		return $detailrecords;
	}

	public function getAcknowlegeCusInfoForLoanCal($mysqli, $id)
	{
		$qry = $mysqli->query("SELECT * FROM acknowlegement_customer_profile where req_id = $id ");
		$detailrecords = array();
		$i = 0;
		if ($mysqli->affected_rows > 0) {
			while ($row = $qry->fetch_assoc()) {
				$detailrecords['cus_id'] = $row['cus_id'];
				$detailrecords['cus_name'] = $row['cus_name'];
				$detailrecords['cus_pic'] = $row['cus_pic'];
				$detailrecords['cus_type'] = $row['cus_type'];
				$detailrecords['mobile'] = $row['mobile1'];
				$detailrecords['communication'] = $row['communication'];
				$detailrecords['com_audio'] = $row['com_audio'];
				$detailrecords['verification_person'] = $row['verification_person'];
				$detailrecords['verification_location'] = $row['verification_location'];
				$i++;
			}
		}
		return $detailrecords;
	}

	//Add Loan Calculation
	function addAcknowledgementLoanCalculation($mysqli, $userid)
	{
		if (isset($_POST['cus_id_loan'])) {
			$cus_id_loan = $_POST['cus_id_loan'];
		}
		if (isset($_POST['req_id'])) {
			$req_id = $_POST['req_id'];
		}
		if (isset($_POST['cus_name_loan'])) {
			$cus_name_loan = $_POST['cus_name_loan'];
		}
		if (isset($_POST['cus_data_loan'])) {
			$cus_data_loan = $_POST['cus_data_loan'];
		}
		if (isset($_POST['mobile_loan'])) {
			$mobile_loan = $_POST['mobile_loan'];
		}
		if (isset($_POST['pic_loan'])) {
			$pic_loan = $_POST['pic_loan'];
		}
		if (isset($_POST['loan_category_ack'])) {
			$loan_category = $_POST['loan_category_ack'];
		}
		if (isset($_POST['sub_category_ack'])) {
			$sub_category = $_POST['sub_category_ack'];
		}
		if (isset($_POST['category_info'])) {
			$category_info = $_POST['category_info'];
		}
		$tot_value = '';
		if (isset($_POST['tot_value'])) {
			$tot_value = $_POST['tot_value'];
		}
		$ad_amt = '';
		if (isset($_POST['ad_amt'])) {
			$ad_amt = $_POST['ad_amt'];
		}
		if (isset($_POST['loan_amt'])) {
			$loan_amt = $_POST['loan_amt'];
		}
		if (isset($_POST['profit_type_ack'])) {
			$profit_type = $_POST['profit_type_ack'];
		}
		$due_method_calc = '';
		if (isset($_POST['due_method_calc'])) {
			$due_method_calc = $_POST['due_method_calc'];
			if ($profit_type == '2') {
				$due_method_calc = '';
			}
		}
		$due_type = '';
		if (isset($_POST['due_type'])) {
			$due_type = $_POST['due_type'];
			if ($profit_type == '2') {
				$due_type = '';
			}
		}
		$profit_method = '';
		if (isset($_POST['profit_method_ack'])) {
			$profit_method = $_POST['profit_method_ack'];
			if ($profit_type == '2') {
				$profit_method = '';
			}
		}
		$calc_method = '';
		if (isset($_POST['calc_method'])) {
			$calc_method = $_POST['calc_method'];
			if ($profit_type == '2') {
				$calc_method = '';
			}
		}
		$due_method_scheme = '';
		if (isset($_POST['due_method_scheme_ack'])) {
			$due_method_scheme = $_POST['due_method_scheme_ack'];
			if ($profit_type == '1') {
				$due_method_scheme = '';
			}
		}
		$day_scheme = '';
		if (isset($_POST['day_scheme_ack'])) {
			$day_scheme = $_POST['day_scheme_ack'];
			if ($profit_type == '1') {
				$day_scheme = '';
			}
		}
		$scheme_profit_method = '';
		if (isset($_POST['profit_method_scheme_ack'])) {
			$scheme_profit_method = $_POST['profit_method_scheme_ack'];
			if ($profit_type == '1') {
				$scheme_profit_method = '';
			}
		}
		$scheme_name = '';
		if (isset($_POST['scheme_name_ack'])) {
			$scheme_name = $_POST['scheme_name_ack'];
			if ($profit_type == '1') {
				$scheme_name = '';
			}
		}
		if (isset($_POST['int_rate'])) {
			$int_rate = $_POST['int_rate'];
		}
		if (isset($_POST['due_period'])) {
			$due_period = $_POST['due_period'];
		}
		if (isset($_POST['doc_charge'])) {
			$doc_charge = $_POST['doc_charge'];
		}
		if (isset($_POST['proc_fee'])) {
			$proc_fee = $_POST['proc_fee'];
		}
		if (isset($_POST['loan_amt_cal'])) {
			$loan_amt_cal = $_POST['loan_amt_cal'];
		}
		if (isset($_POST['principal_amt_cal'])) {
			$principal_amt_cal = $_POST['principal_amt_cal'];
		}
		if (isset($_POST['int_amt_cal'])) {
			$int_amt_cal = $_POST['int_amt_cal'];
		}
		$tot_amt_cal = '';
		if (isset($_POST['tot_amt_cal'])) {
			$tot_amt_cal = $_POST['tot_amt_cal'];
		}
		$due_amt_cal = '';
		if (isset($_POST['due_amt_cal'])) {
			$due_amt_cal = $_POST['due_amt_cal'];
		}
		if (isset($_POST['doc_charge_cal'])) {
			$doc_charge_cal = $_POST['doc_charge_cal'];
		}
		if (isset($_POST['proc_fee_cal'])) {
			$proc_fee_cal = $_POST['proc_fee_cal'];
		}
		if (isset($_POST['net_cash_cal'])) {
			$net_cash_cal = $_POST['net_cash_cal'];
		}
		if (isset($_POST['due_start_from'])) {
			$due_start_from = $_POST['due_start_from'];
		}
		if (isset($_POST['maturity_month'])) {
			$maturity_month = $_POST['maturity_month'];
		}
		if (isset($_POST['collection_method'])) {
			$collection_method = $_POST['collection_method'];
		}
		if (isset($_POST['loan_cal_id'])) { //To check Whether it is for update 
			$loan_cal_id = $_POST['loan_cal_id'];
		}

		if (isset($_POST['Communitcation_to_cus_ack'])) {
			$Communitcation_to_cus = $_POST['Communitcation_to_cus_ack'];
		}

		if (!empty($_FILES['verification_audio']['name'])) {
			$verify_audio = $_FILES['verification_audio']['name'];
			$audio_temp = $_FILES['verification_audio']['tmp_name'];
			$audiofolder = "uploads/verification/verifyInfo_audio/" . $verify_audio;

			$fileExtension = pathinfo($audiofolder, PATHINFO_EXTENSION); //get the file extention
			$verify_audio = uniqid() . '.' . $fileExtension;
			while (file_exists("uploads/verification/verifyInfo_audio/" . $verify_audio)) {
				//this loop will continue until it generates a unique file name
				$verify_audio = uniqid() . '.' . $fileExtension;
			}

			move_uploaded_file($audio_temp, "uploads/verification/verifyInfo_audio/" . $verify_audio);
		} else {
			$verify_audio = $_POST['verification_audio_upd'];
		}
		if (isset($_POST['verifyPerson'])) {
			$verifyPerson = $_POST['verifyPerson'];
		}
		if (isset($_POST['verification_location_ack'])) {
			$verification_location = $_POST['verification_location_ack'];
		}
		if (isset($_POST['cus_profile_id'])) {
			$cus_profile_id = $_POST['cus_profile_id'];
		}

		if ($loan_cal_id > 0 and $loan_cal_id != '') {
			$updateQry = $mysqli->query("UPDATE acknowlegement_loan_calculation SET cus_id_loan = '" . strip_tags($cus_id_loan) . "', cus_name_loan = '" . strip_tags($cus_name_loan) . "', 
						cus_data_loan = '" . strip_tags($cus_data_loan) . "', mobile_loan = '" . strip_tags($mobile_loan) . "', pic_loan = '" . strip_tags($pic_loan) . "', 
						loan_category = '" . strip_tags($loan_category) . "', sub_category = '" . strip_tags($sub_category) . "', tot_value = '" . strip_tags($tot_value) . "', ad_amt = '" . strip_tags($ad_amt) . "',
						loan_amt = '" . strip_tags($loan_amt) . "', profit_type = '" . strip_tags($profit_type) . "', due_method_calc = '" . strip_tags($due_method_calc) . "', 
						due_type = '" . strip_tags($due_type) . "', profit_method = '" . strip_tags($profit_method) . "', calc_method = '" . strip_tags($calc_method) . "', 
						due_method_scheme = '" . strip_tags($due_method_scheme) . "', profit_method_scheme = '" . strip_tags($scheme_profit_method) . "', day_scheme = '" . strip_tags($day_scheme) . "', scheme_name = '" . strip_tags($scheme_name) . "', 
						int_rate = '" . strip_tags($int_rate) . "', due_period = '" . strip_tags($due_period) . "', doc_charge = '" . strip_tags($doc_charge) . "', proc_fee = '" . strip_tags($proc_fee) . "', 
						loan_amt_cal = '" . strip_tags($loan_amt_cal) . "', principal_amt_cal = '" . strip_tags($principal_amt_cal) . "', int_amt_cal = '" . strip_tags($int_amt_cal) . "', 
						tot_amt_cal = '" . strip_tags($tot_amt_cal) . "', due_amt_cal = '" . strip_tags($due_amt_cal) . "', doc_charge_cal = '" . strip_tags($doc_charge_cal) . "', 
						proc_fee_cal = '" . strip_tags($proc_fee_cal) . "', net_cash_cal = '" . strip_tags($net_cash_cal) . "', due_start_from = '" . strip_tags($due_start_from) . "', 
						maturity_month = '" . strip_tags($maturity_month) . "', collection_method = '" . strip_tags($collection_method) . "', cus_status = 12, update_login_id = $userid, 
						update_date = current_timestamp() WHERE req_id = $req_id ");

			$deleteCat = $mysqli->query("DELETE FROM acknowledgement_loan_cal_category where req_id = '" . strip_tags($req_id) . "' and loan_cal_id='" . strip_tags($loan_cal_id) . "'");

			for ($i = 0; $i < sizeof($category_info); $i++) {
				$insertCategory = $mysqli->query("INSERT INTO `acknowledgement_loan_cal_category`(`req_id`, `loan_cal_id`, `category`) VALUES ('" . strip_tags($req_id) . "','" . strip_tags($loan_cal_id) . "',
						'" . strip_tags($category_info[$i]) . "' )");
			}
		} else {
echo "INSERT INTO acknowlegement_loan_calculation (`req_id`, `cus_id_loan`, `cus_name_loan`,`cus_data_loan`, `mobile_loan`, `pic_loan`, `loan_category`, `sub_category`,
						`tot_value`, `ad_amt`, `loan_amt`, `profit_type`, `due_method_calc`, `due_type`, `profit_method`, `calc_method`, `due_method_scheme`, `profit_method_scheme`,`day_scheme`, `scheme_name`, 
						`int_rate`, `due_period`, `doc_charge`, `proc_fee`, `loan_amt_cal`, `principal_amt_cal`, `int_amt_cal`, `tot_amt_cal`, `due_amt_cal`, `doc_charge_cal`, `proc_fee_cal`, `net_cash_cal`,
						`due_start_from`, `maturity_month`, `collection_method`, `cus_status`, `insert_login_id`,`create_date`) VALUES ('" . strip_tags($req_id) . "', '" . strip_tags($cus_id_loan) . "', 
						'" . strip_tags($cus_name_loan) . "', '" . strip_tags($cus_data_loan) . "','" . strip_tags($mobile_loan) . "', '" . strip_tags($pic_loan) . "', '" . strip_tags($loan_category) . "', 
						'" . strip_tags($sub_category) . "', '" . strip_tags($tot_value) . "', '" . strip_tags($ad_amt) . "', '" . strip_tags($loan_amt) . "', '" . strip_tags($profit_type) . "', 
						'" . strip_tags($due_method_calc) . "', '" . strip_tags($due_type) . "', '" . strip_tags($profit_method) . "', '" . strip_tags($calc_method) . "', '" . strip_tags($due_method_scheme) . "', '" . strip_tags($scheme_profit_method) . "', 
						'" . strip_tags($day_scheme) . "', '" . strip_tags($scheme_name) . "', '" . strip_tags($int_rate) . "', '" . strip_tags($due_period) . "', '" . strip_tags($doc_charge) . "', 
						'" . strip_tags($proc_fee) . "', '" . strip_tags($loan_amt_cal) . "', '" . strip_tags($principal_amt_cal) . "', '" . strip_tags($int_amt_cal) . "', '" . strip_tags($tot_amt_cal) . "', 
						'" . strip_tags($due_amt_cal) . "', '" . strip_tags($doc_charge_cal) . "', '" . strip_tags($proc_fee_cal) . "', '" . strip_tags($net_cash_cal) . "', '" . strip_tags($due_start_from) . "', 
						'" . strip_tags($maturity_month) . "', '" . strip_tags($collection_method) . "', 12, $userid, current_timestamp())  ";	$insertQry = $mysqli->query("INSERT INTO acknowlegement_loan_calculation (`req_id`, `cus_id_loan`, `cus_name_loan`,`cus_data_loan`, `mobile_loan`, `pic_loan`, `loan_category`, `sub_category`,
						`tot_value`, `ad_amt`, `loan_amt`, `profit_type`, `due_method_calc`, `due_type`, `profit_method`, `calc_method`, `due_method_scheme`, `profit_method_scheme`,`day_scheme`, `scheme_name`, 
						`int_rate`, `due_period`, `doc_charge`, `proc_fee`, `loan_amt_cal`, `principal_amt_cal`, `int_amt_cal`, `tot_amt_cal`, `due_amt_cal`, `doc_charge_cal`, `proc_fee_cal`, `net_cash_cal`,
						`due_start_from`, `maturity_month`, `collection_method`, `cus_status`, `insert_login_id`,`create_date`) VALUES ('" . strip_tags($req_id) . "', '" . strip_tags($cus_id_loan) . "', 
						'" . strip_tags($cus_name_loan) . "', '" . strip_tags($cus_data_loan) . "','" . strip_tags($mobile_loan) . "', '" . strip_tags($pic_loan) . "', '" . strip_tags($loan_category) . "', 
						'" . strip_tags($sub_category) . "', '" . strip_tags($tot_value) . "', '" . strip_tags($ad_amt) . "', '" . strip_tags($loan_amt) . "', '" . strip_tags($profit_type) . "', 
						'" . strip_tags($due_method_calc) . "', '" . strip_tags($due_type) . "', '" . strip_tags($profit_method) . "', '" . strip_tags($calc_method) . "', '" . strip_tags($due_method_scheme) . "', '" . strip_tags($scheme_profit_method) . "', 
						'" . strip_tags($day_scheme) . "', '" . strip_tags($scheme_name) . "', '" . strip_tags($int_rate) . "', '" . strip_tags($due_period) . "', '" . strip_tags($doc_charge) . "', 
						'" . strip_tags($proc_fee) . "', '" . strip_tags($loan_amt_cal) . "', '" . strip_tags($principal_amt_cal) . "', '" . strip_tags($int_amt_cal) . "', '" . strip_tags($tot_amt_cal) . "', 
						'" . strip_tags($due_amt_cal) . "', '" . strip_tags($doc_charge_cal) . "', '" . strip_tags($proc_fee_cal) . "', '" . strip_tags($net_cash_cal) . "', '" . strip_tags($due_start_from) . "', 
						'" . strip_tags($maturity_month) . "', '" . strip_tags($collection_method) . "', 12, $userid, current_timestamp()) ");
			$loan_cal_id = $mysqli->insert_id;

			for ($i = 0; $i < sizeof($category_info); $i++) {
				$insertCategory = $mysqli->query("INSERT INTO `acknowledgement_loan_cal_category`(`req_id`, `loan_cal_id`, `category`) VALUES ('" . strip_tags($req_id) . "','" . strip_tags($loan_cal_id) . "',
						'" . strip_tags($category_info[$i]) . "' )");
			}
		}

		$cusUpd = "UPDATE `acknowlegement_customer_profile` SET `communication`='" . strip_tags($Communitcation_to_cus) . "',`com_audio`='" . strip_tags($verify_audio) . "',`verification_person`='" . strip_tags($verifyPerson) . "',`verification_location`='" . strip_tags($verification_location) . "',`update_login_id`='" . $userid . "',`updated_date`= now() WHERE `id`='" . strip_tags($cus_profile_id) . "' ";

		$updateCus = $mysqli->query($cusUpd) or die("Error " . $mysqli->error);
	}

	function getAckLoanCalculationForVerification($mysqli, $req_id)
	{
		$detailrecords = array();
		$Qry = $mysqli->query("SELECT * FROM `acknowlegement_loan_calculation` WHERE req_id = '" . strip_tags($req_id) . "' ");
		if ($mysqli->affected_rows > 0) {
			while ($row = $Qry->fetch_assoc()) {
				$detailrecords['loan_cal_id'] = $row['loan_cal_id'];
				// $detailrecords['req_id'] = $row['req_id'];
				$detailrecords['cus_id_loan'] = $row['cus_id_loan'];
				$detailrecords['cus_name_loan'] = $row['cus_name_loan'];
				$detailrecords['cus_data_loan'] = $row['cus_data_loan'];
				$detailrecords['mobile_loan'] = $row['mobile_loan'];
				$detailrecords['pic_loan'] = $row['pic_loan'];
				$detailrecords['loan_category'] = $row['loan_category'];
				$detailrecords['sub_category'] = $row['sub_category'];
				$detailrecords['tot_value'] = $row['tot_value'];
				$detailrecords['ad_amt'] = $row['ad_amt'];
				$detailrecords['loan_amt'] = $row['loan_amt'];
				$detailrecords['profit_type'] = $row['profit_type'];
				$detailrecords['due_method_calc'] = $row['due_method_calc'];
				$detailrecords['due_type'] = $row['due_type'];
				$detailrecords['profit_method'] = $row['profit_method'];
				$detailrecords['calc_method'] = $row['calc_method'];
				$detailrecords['due_method_scheme'] = $row['due_method_scheme'];
				$detailrecords['scheme_profit_method'] = $row['profit_method_scheme'];
				$detailrecords['day_scheme'] = $row['day_scheme'];
				$detailrecords['scheme_name'] = $row['scheme_name'];
				$detailrecords['int_rate'] = $row['int_rate'];
				$detailrecords['due_period'] = $row['due_period'];
				$detailrecords['doc_charge'] = $row['doc_charge'];
				$detailrecords['proc_fee'] = $row['proc_fee'];
				$detailrecords['loan_amt_cal'] = $row['loan_amt_cal'];
				$detailrecords['principal_amt_cal'] = $row['principal_amt_cal'];
				$detailrecords['int_amt_cal'] = $row['int_amt_cal'];
				$detailrecords['tot_amt_cal'] = $row['tot_amt_cal'];
				$detailrecords['due_amt_cal'] = $row['due_amt_cal'];
				$detailrecords['doc_charge_cal'] = $row['doc_charge_cal'];
				$detailrecords['proc_fee_cal'] = $row['proc_fee_cal'];
				$detailrecords['net_cash_cal'] = $row['net_cash_cal'];
				$detailrecords['due_start_from'] = $row['due_start_from'];
				$detailrecords['maturity_month'] = $row['maturity_month'];
				$detailrecords['collection_method'] = $row['collection_method'];
				$detailrecords['communication'] = $row['communication'];
				$detailrecords['com_audio'] = $row['com_audio'];
				$detailrecords['verification_person'] = $row['verification_person'];
				$detailrecords['verification_location'] = $row['verification_location'];
				$detailrecords['cus_status'] = $row['cus_status'];
			}
		}
		return $detailrecords;
	}

	//Get Loan calculation Category info for edit
	function getAckVerificationLoanCalCategory($mysqli, $loan_cal_id)
	{
		$detailrecords = array();
		$Qry = $mysqli->query("SELECT * FROM `acknowledgement_loan_cal_category` WHERE loan_cal_id = '" . strip_tags($loan_cal_id) . "' ");
		if ($mysqli->affected_rows > 0) {
			$i = 0;
			while ($row = $Qry->fetch_assoc()) {
				$detailrecords[$i]['req_id'] = $row['req_id'];
				$detailrecords[$i]['loan_cal_id'] = $row['loan_cal_id'];
				$detailrecords[$i]['category'] = $row['category'];
				$i++;
			}
		}
		return $detailrecords;
	}

	//Cancel Acknowledgement
	// function cancelAcknowledgement($mysqli,$id, $userid){
	// 	$qry = $mysqli->query("UPDATE request_creation set cus_status = 7, updated_date=now(), update_login_id = $userid where req_id = $id ") or die('Error While Cancelling Acknowledgement');
	// 	$qry = $mysqli->query("UPDATE in_verification set cus_status = 7, updated_date=now() , update_login_id = $userid where req_id = $id ") or die('Error While Cancelling Acknowledgement');
	// 	$qry = $mysqli->query("UPDATE in_approval set cus_status = 7, updated_date=now() , update_login_id = $userid where req_id = $id ") or die('Error While Cancelling Acknowledgement');
	// 	$qry = $mysqli->query("UPDATE in_acknowledgement set cus_status = 7, updated_date=now() , update_login_id = $userid where req_id = $id  ") or die('Error While Cancelling Acknowledgement');
	// }
	//Delete Acknowledgement
	function removeAcknowledgement($mysqli, $id, $userid)
	{
		$qry = $mysqli->query("UPDATE request_creation set status = 1,updated_date=now(), delete_login_id = $userid where req_id = $id ") or die('Error While Removing Acknowledgement');
		$qry = $mysqli->query("UPDATE in_verification set status = 1,updated_date=now(), delete_login_id = $userid where req_id = $id ") or die('Error While Removing Acknowledgement');
		$qry = $mysqli->query("UPDATE in_approval set status = 1,updated_date=now(), delete_login_id = $userid where req_id = $id ") or die('Error While Removing Acknowledgement');
		$qry = $mysqli->query("UPDATE in_acknowledgement set status = 1,updated_date=now(), delete_login_id = $userid where req_id = $id  ") or die('Error While Removing Acknowledgement');
	}

	///  Acknowlegement END

	// Add Loan Issue
	public function addloanIssue($mysqli, $userid)
	{
		if (isset($_POST['req_id'])) {
			$req_id = $_POST['req_id'];
		}
		if (isset($_POST['cus_id'])) {
			$cus_id =  preg_replace('/\s+/', '', $_POST['cus_id']);
		}
		if (isset($_POST['loan_amt_cal'])) {
			$loan_amt_cal = $_POST['loan_amt_cal'];
		}
		if (isset($_POST['net_cash_cal'])) {
			$net_cash_cal = $_POST['net_cash_cal'];
		}
		if (isset($_POST['issue_to'])) {
			$issue_to =  $_POST['issue_to'];
		}
		if (isset($_POST['agent_id'])) {
			$agent_id = $_POST['agent_id'];
		}
		if (isset($_POST['issued_mode'])) {
			$issued_mode = $_POST['issued_mode'];
		}
		if (isset($_POST['payment_type'])) {
			$payment_type = $_POST['payment_type'];
		}
		if (isset($_POST['cash'])) {
			$cash = $_POST['cash'];
		}
		if (isset($_POST['bank_id'])) {
			$bank_id = $_POST['bank_id'];
		}
		if (isset($_POST['chequeno'])) {
			$chequeno = $_POST['chequeno'];
		}
		if (isset($_POST['chequeValue'])) {
			$chequeValue = $_POST['chequeValue'];
		}
		if (isset($_POST['chequeRemark'])) {
			$chequeRemark = $_POST['chequeRemark'];
		}
		if (isset($_POST['transaction_id'])) {
			$transaction_id = $_POST['transaction_id'];
		}
		if (isset($_POST['transaction_value'])) {
			$transaction_value = $_POST['transaction_value'];
		}
		if (isset($_POST['transaction_remark'])) {
			$transaction_remark = $_POST['transaction_remark'];
		}
		if (isset($_POST['balance'])) {
			$balance = $_POST['balance'];
		}
		if (isset($_POST['cash_guarentor_name'])) {
			$cash_guarentor_name = $_POST['cash_guarentor_name'];
		}
		if (isset($_POST['relationship'])) {
			$relationship = $_POST['relationship'];
		}
		if (isset($_POST['due_start_from'])) {
			$due_start_from = $_POST['due_start_from'];
		}
		if (isset($_POST['maturity_month'])) {
			$maturity_month = $_POST['maturity_month'];
		}

		$insertQry = "INSERT INTO `loan_issue`( `req_id`, `cus_id`, `issued_to`, `agent_id`, `issued_mode`, `payment_type`, `cash`,`bank_id`, `cheque_no`, `cheque_value`, `cheque_remark`, `transaction_id`, `transaction_value`, `transaction_remark`, `balance_amount`,`loan_amt`, `net_cash`,`cash_guarentor_name`,`relationship`, `status`, `insert_login_id`,`created_date`)  VALUES('" . strip_tags($req_id) . "','" . strip_tags($cus_id) . "','" . strip_tags($issue_to) . "','" . strip_tags($agent_id) . "','" . strip_tags($issued_mode) . "', '" . strip_tags($payment_type) . "', '" . strip_tags($cash) . "','" . strip_tags($bank_id) . "', '" . strip_tags($chequeno) . "','" . strip_tags($chequeValue) . "','" . strip_tags($chequeRemark) . "','" . strip_tags($transaction_id) . "','" . strip_tags($transaction_value) . "', '" . strip_tags($transaction_remark) . "', '" . strip_tags($balance) . "', '" . strip_tags($loan_amt_cal) . "','" . strip_tags($net_cash_cal) . "','" . strip_tags($cash_guarentor_name) . "','" . strip_tags($relationship) . "','0','" . $userid . "',now() )";

		$insresult = $mysqli->query($insertQry) or die("Error " . $mysqli->error);


		$updateQry = $mysqli->query("UPDATE acknowlegement_loan_calculation SET due_start_from = '" . strip_tags($due_start_from) . "', maturity_month = '" . strip_tags($maturity_month) . "', update_login_id = $userid,update_date = current_timestamp() WHERE req_id = $req_id ");
		// $qry = $mysqli->query("SELECT customer_name, mobile1 from customer_register where req_ref_id = '$req_id' ");
		// $row = $qry->fetch_assoc();
		// $customer_name = $row['customer_name'];
		// $cus_mobile1 = $row['mobile1'];

		// $message = "";
		// $templateid	= ''; //FROM DLT PORTAL.
		// // Account details
		// $apiKey = '';
		// // Message details
		// $sender = '';
		// // Prepare data for POST request
		// $data = 'access_token='.$apiKey.'&to='.$cus_mobile1.'&message='.$message.'&service=T&sender='.$sender.'&template_id='.$templateid;
		// // Send the GET request with cURL
		// $url = 'https://sms.messagewall.in/api/v2/sms/send?'.$data; 
		// $response = file_get_contents($url);  
		// // Process your response here
		// return $response; 

	}

	function getLoanList($mysqli, $id)
	{
		$detailrecords = array();
		$Qry = $mysqli->query("SELECT `cus_id`,`cus_name`,`mobile1`,`cus_pic`,`area_confirm_area`,`area_confirm_subarea`,`area_line` FROM `acknowlegement_customer_profile` WHERE req_id = '" . strip_tags($id) . "' ");
		if ($Qry->num_rows > 0) {
			$row = $Qry->fetch_assoc();
			$detailrecords = $row;
		}

		//Getting area Name
		$qry = $mysqli->query("SELECT area_name FROM area_list_creation WHERE area_id = '" . $detailrecords['area_confirm_area'] . "' ");
		$detailrecords['area_name'] = $qry->fetch_assoc()['area_name'];

		//Getting sub area Name
		$qry = $mysqli->query("SELECT sub_area_name FROM sub_area_list_creation WHERE sub_area_id = '" . $detailrecords['area_confirm_subarea'] . "' ");
		$detailrecords['sub_area_name'] = $qry->fetch_assoc()['sub_area_name'];

		// Getting Line Id, Branch ID, Branch Name
		$qry = $mysqli->query("SELECT b.branch_id, b.branch_name, l.map_id FROM branch_creation b JOIN area_line_mapping l ON l.branch_id = b.branch_id WHERE l.line_name = '" . $detailrecords['area_line'] . "'");
		$row = $qry->fetch_assoc();
		$detailrecords['line_id'] = $row['map_id'];
		$detailrecords['branch_id'] = $row['branch_id'];
		$detailrecords['branch_name'] = $row['branch_name'];

		return $detailrecords;
	}

	//Closed
	function addClosed($mysqli, $close_req_id, $userid)
	{
		if (isset($_POST['cus_id'])) {
			$cus_id = $_POST['cus_id'];
		}
		if (isset($_POST['closed_Sts'])) {
			$closed_Sts = $_POST['closed_Sts'];
		}
		$closed_Sts_consider = '';
		if (isset($_POST['closed_Sts']) &&  $_POST['closed_Sts'] == '1') { // If Status is Consider then level will store.
			if (isset($_POST['closed_Sts_consider'])) {
				$closed_Sts_consider =  $_POST['closed_Sts_consider'];
			}
		}
		if (isset($_POST['closed_Sts_remark'])) {
			$closed_Sts_remark = $_POST['closed_Sts_remark'];
		}

		$mysqli->query("INSERT INTO `closed_status`( `req_id`, `cus_id`, `closed_sts`, `consider_level`, `remark`,`cus_sts`,`insert_login_id`,`created_date`) VALUES ('" . strip_tags($close_req_id) . "','" . strip_tags($cus_id) . "','" . strip_tags($closed_Sts) . "','" . strip_tags($closed_Sts_consider) . "','" . strip_tags($closed_Sts_remark) . "', '21','$userid',now() )");

		$mysqli->query("UPDATE request_creation set cus_status = 21,updated_date = now(), update_login_id = $userid WHERE  cus_id = '" . $cus_id . "' and req_id = '" .  $close_req_id . "' && cus_status = '20' ") or die('Error on Request Table');

		$mysqli->query("UPDATE customer_register set cus_status = 21 WHERE cus_id = '" . $cus_id . "' and req_ref_id = '" .  $close_req_id . "' ") or die('Error on Customer Table');

		$mysqli->query("UPDATE in_verification set cus_status = 21, update_login_id = $userid WHERE cus_id = '" . $cus_id . "' and req_id = '" .  $close_req_id . "' && cus_status = '20' ") or die('Error on inVerification Table');

		$mysqli->query("UPDATE `in_approval` SET `cus_status`= 21,`update_login_id`= $userid WHERE  cus_id = '" . $cus_id . "' and req_id = '" .  $close_req_id . "' && cus_status = '20' ") or die('Error on in_approval Table');

		$mysqli->query("UPDATE `in_acknowledgement` SET `cus_status`= 21,`update_login_id`= $userid and updated_date=now() WHERE  cus_id = '" . $cus_id . "' and req_id = '" .  $close_req_id . "' && cus_status = '20' ") or die('Error on in_acknowledgement Table');

		$mysqli->query("UPDATE `in_issue` SET `cus_status`= 21,`update_login_id` = $userid where cus_id = '" . $cus_id . "' and req_id = '" .  $close_req_id . "' && cus_status = '20' ") or die('Error on in_issue Table');
		
		$mysqli->query("UPDATE `closed_status` SET `cus_sts`='21',`update_login_id`=$userid,`updated_date`= now() WHERE `cus_sts`='20' and req_id = '" .  $close_req_id . "' && `cus_id`='" . $cus_id . "' ") or die('Error on closed_status Table');

		$mysqli->query("INSERT INTO `document_track`(`req_id`, `cus_id`, `track_status`, `insert_login_id`, `created_date`) 
		VALUES('" . strip_tags($close_req_id) . "','" . strip_tags($cus_id) . "','3','$userid', now()) ");
	}

	//Get User Details for Consent Creation.
	function getUserDetails($mysqli, $userid)
	{
		$getDetails = array();
		$selectQry = $mysqli->query("SELECT `user_id`,`fullname`,`user_name`,`role`,`role_type`,`staff_id`,`company_id`,`branch_id` FROM `user` WHERE user_id='" . $userid . "' ");
		if ($selectQry->num_rows > 0) {
			$row = $selectQry->fetch_assoc();
			$getDetails = $row;
		}
		// //Getting Company Name
		// $qry = $mysqli->query("SELECT company_name FROM company_creation WHERE company_id = " . $getDetails['company_id']);
		// $getDetails['company_name'] = $qry->fetch_assoc()['company_name'];
		//Getting Staff Code
		if ($getDetails['staff_id'] != '') {
			$qry = $mysqli->query("SELECT staff_code FROM staff_creation WHERE staff_id = '" . $getDetails['staff_id'] . "' ");
			$getDetails['staff_code'] = $qry->fetch_assoc()['staff_code'];
		}
		return $getDetails;
	}
	//Concern Subject
	public function getconSubject($mysqli)
	{
		$qry = "SELECT * FROM concern_subject WHERE 1 AND status=0 ORDER BY concern_sub_id DESC";
		$res = $mysqli->query($qry) or die("Error in Get All Records" . $mysqli->error);
		$detailrecords = array();
		$i = 0;
		if ($mysqli->affected_rows > 0) {
			while ($row = $res->fetch_object()) {
				$detailrecords[$i]['concern_sub_id']            = $row->concern_sub_id;
				$detailrecords[$i]['concern_subject']           = strip_tags($row->concern_subject);
				$i++;
			}
		}
		return $detailrecords;
	}

	// Add Concern
	function addConcern($mysqli, $userid)
	{

		if (isset($_POST['raising_for'])) {
			$raising_for = $_POST['raising_for'];
		}

		$self_name = '';
		$self_code = '';
		if (isset($raising_for) && $raising_for == '1') {
			if (isset($_POST['self_name'])) {
				$self_name = $_POST['self_name'];
			}
			if (isset($_POST['self_code'])) {
				$self_code =  $_POST['self_code'];
			}
		}

		$staff_name = '';
		$staff_dept_name = '';
		$staff_team_name = '';
		if (isset($raising_for) && $raising_for == '2') {
			if (isset($_POST['staff_name'])) {
				$staff_name = $_POST['staff_name'];
			}
			if (isset($_POST['staff_dept_name'])) {
				$staff_dept_name = $_POST['staff_dept_name'];
			}
			if (isset($_POST['staff_team_name'])) {
				$staff_team_name = $_POST['staff_team_name'];
			}
		}

		$ag_name = '';
		$ag_grp = '';
		if (isset($raising_for) && $raising_for == '3') {
			if (isset($_POST['ag_name'])) {
				$ag_name = $_POST['ag_name'];
			}
			if (isset($_POST['ag_grp'])) {
				$ag_grp = $_POST['ag_grp'];
			}
		}

		$cus_id = '';
		$cus_name = '';
		$cus_area = '';
		$cus_sub_area = '';
		$cus_group = '';
		$cus_line = '';
		if (isset($raising_for) && $raising_for == '4') {
			if (isset($_POST['cus_id'])) {
				$cus_id =  preg_replace('/\s+/', '', $_POST['cus_id']);
			}
			if (isset($_POST['cus_name'])) {
				$cus_name = $_POST['cus_name'];
			}
			if (isset($_POST['cus_area'])) {
				$cus_area = $_POST['cus_area'];
			}
			if (isset($_POST['cus_sub_area'])) {
				$cus_sub_area = $_POST['cus_sub_area'];
			}
			if (isset($_POST['cus_group'])) {
				$cus_group = $_POST['cus_group'];
			}
			if (isset($_POST['cus_line'])) {
				$cus_line = $_POST['cus_line'];
			}
		}

		if (isset($_POST['com_date'])) {
			$com_date = $_POST['com_date'];
		}
		if (isset($_POST['com_code'])) {
			$com_code = $_POST['com_code'];
		}
		if (isset($_POST['branch_name'])) {
			$branch_name = $_POST['branch_name'];
		}
		if (isset($_POST['concern_to'])) {
			$concern_to = $_POST['concern_to'];
		}

		$to_dept_name = '';
		if (isset($concern_to) && $concern_to == '1') {
			if (isset($_POST['to_dept_name'])) {
				$to_dept_name = $_POST['to_dept_name'];
			}
		}

		$to_team_name = '';
		if (isset($concern_to) && $concern_to == '2') {
			if (isset($_POST['to_team_name'])) {
				$to_team_name = $_POST['to_team_name'];
			}
		}

		if (isset($_POST['com_sub'])) {
			$com_sub = $_POST['com_sub'];
		}
		if (isset($_POST['com_remark'])) {
			$com_remark = $_POST['com_remark'];
		}
		if (isset($_POST['com_priority'])) {
			$com_priority = $_POST['com_priority'];
		}
		if (isset($_POST['staff_assign_to'])) {
			$staff_assign_to = $_POST['staff_assign_to'];
		}


		$insertQry = "INSERT INTO `concern_creation`( `raising_for`, `self_name`, `self_code`, `staff_name`, `staff_dept_name`, `staff_team_name`, `ag_name`, `ag_grp`, `cus_id`, `cus_name`, `cus_area`, `cus_sub_area`, `cus_group`, `cus_line`, `com_date`, `com_code`, `branch_name`, `concern_to`, `to_dept_name`, `to_team_name`, `com_sub`, `com_remark`, `com_priority`, `staff_assign_to`, `insert_user_id`) VALUES('" . strip_tags($raising_for) . "','" . strip_tags($self_name) . "','" . strip_tags($self_code) . "','" . strip_tags($staff_name) . "',
				'" . strip_tags($staff_dept_name) . "', '" . strip_tags($staff_team_name) . "', '" . strip_tags($ag_name) . "', '" . strip_tags($ag_grp) . "','" . strip_tags($cus_id) . "',
				'" . strip_tags($cus_name) . "','" . strip_tags($cus_area) . "','" . strip_tags($cus_sub_area) . "', '" . strip_tags($cus_group) . "', '" . strip_tags($cus_line) . "', 
				'" . strip_tags($com_date) . "','" . strip_tags($com_code) . "','" . strip_tags($branch_name) . "','" . strip_tags($concern_to) . "','" . strip_tags($to_dept_name) . "','" . strip_tags($to_team_name) . "',
				'" . strip_tags($com_sub) . "','" . strip_tags($com_remark) . "','" . strip_tags($com_priority) . "','" . strip_tags($staff_assign_to) . "','" . strip_tags($userid) . "')";

		$insresult = $mysqli->query($insertQry) or die("Error " . $mysqli->error);
	} //

	function getConcernCreation($mysqli, $idupd, $userid)
	{
		$detailrecords = array();
		$Qry = $mysqli->query("SELECT * FROM `concern_creation` WHERE id = '" . strip_tags($idupd) . "' ");
		if ($mysqli->affected_rows > 0) {
			$row = $Qry->fetch_assoc();
			$detailrecords['id'] = $row['id'];
			$detailrecords['raising_for'] = $row['raising_for'];
			$detailrecords['self_name'] = $row['self_name'];
			$detailrecords['self_code'] = $row['self_code'];
			$detailrecords['staff_name'] = $row['staff_name'];
			$detailrecords['staff_dept_name'] = $row['staff_dept_name'];
			$detailrecords['staff_team_name'] = $row['staff_team_name'];
			// $detailrecords['ag_name'] = $row['ag_name'];
			$detailrecords['ag_grp'] = $row['ag_grp'];
			$detailrecords['cus_id'] = $row['cus_id'];
			$detailrecords['cus_name'] = $row['cus_name'];
			$detailrecords['cus_area'] = $row['cus_area'];
			$detailrecords['cus_sub_area'] = $row['cus_sub_area'];
			$detailrecords['cus_group'] = $row['cus_group'];
			$detailrecords['cus_line'] = $row['cus_line'];
			$detailrecords['com_date'] = $row['com_date'];
			$detailrecords['com_code'] = $row['com_code'];
			// $detailrecords['branch_name'] = $row['branch_name'];
			$detailrecords['concern_to'] = $row['concern_to'];
			$detailrecords['to_dept_name'] = $row['to_dept_name'];
			$detailrecords['to_team_name'] = $row['to_team_name'];
			$detailrecords['com_sub'] = $row['com_sub'];
			$detailrecords['com_remark'] = $row['com_remark'];
			$detailrecords['com_priority'] = $row['com_priority'];
			// $detailrecords['staff_assign_to'] = $row['staff_assign_to'];
			$detailrecords['solution_date'] = $row['solution_date'];
			$detailrecords['communication'] = $row['communication'];
			$detailrecords['uploads'] = $row['uploads'];
			$detailrecords['solution_remark'] = $row['solution_remark'];
			// $detailrecords['insert_user_id'] = $row['insert_user_id'];


			//Agent Name.
			$ag_name = $row['ag_name'];
			if ($ag_name != '') {
				$qry = $mysqli->query("SELECT ag_name FROM agent_creation  where ag_id = '" . strip_tags($ag_name) . "' ");
				$row1 = $qry->fetch_assoc();
				$detailrecords['ag_name'] = $row1['ag_name'];
			} else {
				$detailrecords['ag_name'] = '';
			}

			//Branch Name.
			$branch_id = $row['branch_name'];
			if ($branch_id != '') {
				$qry = $mysqli->query("SELECT b.branch_name FROM branch_creation b  where b.branch_id = '" . strip_tags($branch_id) . "' ");
				$row1 = $qry->fetch_assoc();
				$detailrecords['branch_name'] = $row1['branch_name'];
			} else {
				$detailrecords['branch_name'] = '';
			}

			// //Concern Subject Name 
			// $com_sub_id = $row['com_sub'];
			// if($com_sub_id !=''){
			// $qry = $mysqli->query("SELECT concern_subject FROM concern_subject where concern_sub_id = '".strip_tags($com_sub_id)."' ");
			// $row1 = $qry->fetch_assoc();
			// $detailrecords['com_sub'] = $row1['concern_subject'];
			// }else{
			// 	$detailrecords['com_sub'] = '';
			// }

			//Staff Assign Name
			$staff_id = $row['staff_assign_to'];
			if ($staff_id != '') {
				$qry = $mysqli->query("SELECT staff_name FROM `staff_creation` where staff_id ='" . strip_tags($staff_id) . "'");
				$row1 = $qry->fetch_assoc();
				$detailrecords['staff_assign_to'] = $row1['staff_name'];
			} else {
				$detailrecords['staff_assign_to'] = '';
			}

			//Insert user Name
			$insert_user = $row['insert_user_id'];
			if ($staff_id != '') {
				$qry = $mysqli->query("SELECT fullname FROM `user` where user_id ='" . strip_tags($insert_user) . "'");
				$row1 = $qry->fetch_assoc();
				$detailrecords['insert_user_name'] = $row1['fullname'];
			} else {
				$detailrecords['insert_user_name'] = '';
			}
		}
		return $detailrecords;
	}

	//Add Concern Solution 
	function addConcernsolution($mysqli, $userid)
	{

		if (isset($_POST['solution_date'])) {
			$solution_date = $_POST['solution_date'];
		}
		if (isset($_POST['Com_for_solution'])) {
			$Com_for_solution = $_POST['Com_for_solution'];
		}

		$concern_upload = '';
		// if(isset($_FILES['concern_upload']) && $_POST['Com_for_solution'] == '1'){

		// 	$filesArr3 = $_FILES['concern_upload'];
		// 	$concern_upload = ''; 
		// 	$uploadDir = "uploads/concern/";
		// 	// File upload path  
		// 	foreach($filesArr3['name'] as $key=>$val)
		// 	{
		// 		$fileName = basename($filesArr3['name'][$key]);  
		// 		$targetFilePath = $uploadDir . $fileName; 

		// 		// Check whether file type is valid  
		// 		$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);  

		// 			// Upload file to server  
		// 			if(move_uploaded_file($filesArr3["tmp_name"][$key], $targetFilePath)){  
		// 				$concern_upload .= $fileName.',';  
		// 		}
		// 	}
		// }
		if (isset($_FILES['concern_upload']) && $_POST['Com_for_solution'] == '1') {
			$filesArr3 = $_FILES['concern_upload'];
			$uploadDir = "uploads/concern/";

			foreach ($filesArr3['name'] as $key => $val) {
				$fileName = basename($filesArr3['name'][$key]);
				$targetFilePath = $uploadDir . $fileName;

				$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

				$uniqueFileName = uniqid() . '.' . $fileType;
				while (file_exists($uploadDir . $uniqueFileName)) {
					$uniqueFileName = uniqid() . '.' . $fileType;
				}

				if (move_uploaded_file($filesArr3["tmp_name"][$key], $uploadDir . $uniqueFileName)) {
					$concern_upload .= $uniqueFileName . ',';
				}
			}

			// Use $concern_uploads array containing the unique file names uploaded
			// Do something with $concern_uploads as needed
		}


		if (isset($_POST['solution_remark'])) {
			$solution_remark = $_POST['solution_remark'];
		}
		if (isset($_POST['id'])) {
			$id = $_POST['id'];
		}

		$concern_upload = rtrim($concern_upload, ','); //trims the comma at right last

		$updConcern = $mysqli->query("UPDATE `concern_creation` SET `status`= 1 ,`solution_date`='" . strip_tags($solution_date) . "',`communication`='" . strip_tags($Com_for_solution) . "',`uploads`='" . strip_tags($concern_upload) . "',`solution_remark`='" . strip_tags($solution_remark) . "',`update_user_id`='" . strip_tags($userid) . "',`updated_date`= now() WHERE `id`='" . strip_tags($id) . "' ");
	}
	function getCustomerRegister($mysqli, $cus_id)
	{
		$qry = $mysqli->query("SELECT *  FROM `customer_register` WHERE cus_id = '$cus_id' ");
		$detailrecords = array();
		$i = 0;
		if ($mysqli->affected_rows > 0) {
			while ($row = $qry->fetch_assoc()) {
				$detailrecords['cus_reg_id'] = $row['cus_reg_id'];
				$detailrecords['req_id'] = $row['req_ref_id'];
				$detailrecords['cus_id'] = $row['cus_id'];
				// $detailrecords['cus_id'] = $row['cus_data']; //
				$detailrecords['cus_name'] = $row['customer_name'];
				$detailrecords['dob'] = $row['dob'];
				$detailrecords['age'] = $row['age'];
				$detailrecords['gender'] = $row['gender'];
				$detailrecords['state'] = $row['state'];
				$detailrecords['district'] = $row['district'];
				$detailrecords['taluk'] = $row['taluk'];
				$detailrecords['area'] = $row['area'];
				$detailrecords['sub_area'] = $row['sub_area'];
				$detailrecords['address'] = $row['address'];
				$detailrecords['mobile1'] = $row['mobile1'];
				$detailrecords['mobile2'] = $row['mobile2'];
				$detailrecords['father_name'] = $row['father_name'];
				$detailrecords['mother_name'] = $row['mother_name'];
				$detailrecords['marital'] = $row['marital'];
				$detailrecords['spouse'] = $row['spouse'];
				$detailrecords['occupation_type'] = $row['occupation_type'];
				$detailrecords['occupation'] = $row['occupation'];
				$detailrecords['cus_pic'] = $row['pic'];
				$detailrecords['how_to_know'] = $row['how_to_know'];
				$detailrecords['loan_count'] = $row['loan_count'];
				$detailrecords['first_loan_date'] = $row['first_loan_date'];
				$detailrecords['travel_with_company'] = $row['travel_with_company'];
				$detailrecords['monthly_income'] = $row['monthly_income'];
				$detailrecords['other_income'] = $row['other_income'];
				$detailrecords['support_income'] = $row['support_income'];
				$detailrecords['commitment'] = $row['commitment'];
				$detailrecords['monthly_due_capacity'] = $row['monthly_due_capacity'];
				$detailrecords['loan_limit'] = $row['loan_limit'];
				$detailrecords['about_customer'] = $row['about_customer'];
				$detailrecords['dow'] = $row['dow'];
				$detailrecords['abt_occ'] = $row['abt_occ'];
				// $detailrecords['cus_type'] = $row['cus_type'];
				// $detailrecords['cus_exist_type'] = $row['cus_exist_type'];
				$detailrecords['residential_type'] = $row['residential_type'];
				$detailrecords['residential_details'] = $row['residential_details'];
				$detailrecords['residential_address'] = $row['residential_address'];
				$detailrecords['residential_native_address'] = $row['residential_native_address'];
				$detailrecords['occupation_info_occ_type'] = $row['occupation_info_occ_type'];
				$detailrecords['occupation_details'] = $row['occupation_details'];
				$detailrecords['occupation_income'] = $row['occupation_income'];
				$detailrecords['occupation_address'] = $row['occupation_address'];
				$detailrecords['area_confirm_type'] = $row['area_confirm_type'];
				$detailrecords['area_confirm_state'] = $row['area_confirm_state'];
				$detailrecords['area_confirm_district'] = $row['area_confirm_district'];
				$detailrecords['area_confirm_taluk'] = $row['area_confirm_taluk'];
				$detailrecords['area_confirm_area'] = $row['area_confirm_area'];
				$detailrecords['area_confirm_subarea'] = $row['area_confirm_subarea'];
				$detailrecords['latlong'] = $row['latlong'];
				$detailrecords['area_group'] = $row['area_group'];
				$detailrecords['area_line'] = $row['area_line'];
				$detailrecords['cus_status'] = $row['cus_status'];

				$result = $mysqli->query("SELECT area_name FROM area_list_creation where area_id = '" . $row['area_confirm_area'] . "' and status=0 and area_enable = 0");
				$area = $result->fetch_assoc();
				if ($mysqli->affected_rows > 0) {
					$detailrecords['area_name'] = $area['area_name'];
				} else {
					$detailrecords['area_name'] = '';
				}
				$subarearesult = $mysqli->query("SELECT sub_area_name FROM sub_area_list_creation where sub_area_id = '" . $row['area_confirm_subarea'] . "' and status=0 and sub_area_enable = 0");
				$subarea = $subarearesult->fetch_assoc();
				if ($mysqli->affected_rows > 0) {
					$detailrecords['sub_area_name'] = $subarea['sub_area_name'];
				} else {
					$detailrecords['sub_area_name'] = '';
				}

				// $reqResult = $mysqli->query("SELECT `req_id` FROM `request_creation` WHERE `cus_id`='".$row['cus_id']."' ");
				// // $request_id = '';
				// while($req_row = $reqResult->fetch_assoc()){
				//     $request_id[]= $req_row['req_id'];
				// }
				// $detailrecords['request_id'] = $request_id;
				$i++;
			}
		}
		return $detailrecords;
	}
	// Get Documentation Info.
	public function getDocumentDetails($mysqli, $cus_id)
	{
		$qry = $mysqli->query("SELECT * FROM acknowlegement_documentation where cus_id_doc = $cus_id ");
		$detailrecords = array();
		$i = 0;
		if ($mysqli->affected_rows > 0) {
			while ($row = $qry->fetch_assoc()) {
				$detailrecords[$i]['doc_Tableid'] = $row['id'];
				$detailrecords[$i]['req_id'] = $row['req_id'];
				$detailrecords[$i]['doc_id'] = $row['doc_id'];
				$detailrecords[$i]['mortgage_process'] = $row['mortgage_process'];
				$detailrecords[$i]['Propertyholder_type'] = $row['Propertyholder_type'];
				$detailrecords[$i]['Propertyholder_name'] = $row['Propertyholder_name'];
				$detailrecords[$i]['Propertyholder_relationship_name'] = $row['Propertyholder_relationship_name'];
				$detailrecords[$i]['doc_property_relation'] = $row['doc_property_relation'];
				$detailrecords[$i]['doc_property_type'] = $row['doc_property_type'];
				$detailrecords[$i]['doc_property_measurement'] = $row['doc_property_measurement'];
				$detailrecords[$i]['doc_property_location'] = $row['doc_property_location'];
				$detailrecords[$i]['doc_property_value'] = $row['doc_property_value'];
				$detailrecords[$i]['mortgage_name'] = $row['mortgage_name'];
				$detailrecords[$i]['mortgage_dsgn'] = $row['mortgage_dsgn'];
				$detailrecords[$i]['mortgage_nuumber'] = $row['mortgage_nuumber'];
				$detailrecords[$i]['reg_office'] = $row['reg_office'];
				$detailrecords[$i]['mortgage_value'] = $row['mortgage_value'];
				$detailrecords[$i]['mortgage_document'] = $row['mortgage_document'];
				$detailrecords[$i]['mortgage_document_upd'] = $row['mortgage_document_upd'];
				$detailrecords[$i]['mortgage_document_pending'] = $row['mortgage_document_pending'];
				$detailrecords[$i]['endorsement_process'] = $row['endorsement_process'];
				$detailrecords[$i]['owner_type'] = $row['owner_type'];
				$detailrecords[$i]['owner_name'] = $row['owner_name'];
				$detailrecords[$i]['ownername_relationship_name'] = $row['ownername_relationship_name'];
				$detailrecords[$i]['en_relation'] = $row['en_relation'];
				$detailrecords[$i]['vehicle_type'] = $row['vehicle_type'];
				$detailrecords[$i]['vehicle_process'] = $row['vehicle_process'];
				$detailrecords[$i]['en_Company'] = $row['en_Company'];
				$detailrecords[$i]['en_Model'] = $row['en_Model'];
				$detailrecords[$i]['vehicle_reg_no'] = $row['vehicle_reg_no'];
				$detailrecords[$i]['endorsement_name'] = $row['endorsement_name'];
				$detailrecords[$i]['en_RC'] = $row['en_RC'];
				$detailrecords[$i]['Rc_document_upd'] = $row['Rc_document_upd'];
				$detailrecords[$i]['Rc_document_pending'] = $row['Rc_document_pending'];
				$detailrecords[$i]['en_Key'] = $row['en_Key'];
				$detailrecords[$i]['gold_info'] = $row['gold_info'];
				$detailrecords[$i]['gold_sts'] = $row['gold_sts'];
				$detailrecords[$i]['gold_type'] = $row['gold_type'];
				$detailrecords[$i]['Purity'] = $row['Purity'];
				$detailrecords[$i]['gold_Count'] = $row['gold_Count'];
				$detailrecords[$i]['gold_Weight'] = $row['gold_Weight'];
				$detailrecords[$i]['gold_Value'] = $row['gold_Value'];
				$detailrecords[$i]['document_name'] = $row['document_name'];
				$detailrecords[$i]['document_details'] = $row['document_details'];
				$detailrecords[$i]['document_type'] = $row['document_type'];
				$detailrecords[$i]['doc_info_upload'] = $row['doc_info_upload'];
				$detailrecords[$i]['document_holder'] = $row['document_holder'];
				$detailrecords[$i]['docholder_name'] = $row['docholder_name'];
				$detailrecords[$i]['docholder_relationship_name'] = $row['docholder_relationship_name'];
				$detailrecords[$i]['doc_relation'] = $row['doc_relation'];
				$detailrecords[$i]['cus_status'] = $row['cus_status'];
				$i++;
			}
		}
		return $detailrecords;
	}

	// Add Company
	public function addBankCreation($mysqli, $userid)
	{

		if (isset($_POST['bank_name'])) {
			$bank_name = $_POST['bank_name'];
		}
		if (isset($_POST['short_name'])) {
			$short_name = $_POST['short_name'];
		}
		if (isset($_POST['acc_no'])) {
			$acc_no = $_POST['acc_no'];
		}
		if (isset($_POST['ifsc'])) {
			$ifsc = $_POST['ifsc'];
		}
		if (isset($_POST['branch'])) {
			$branch = $_POST['branch'];
		}
		if (isset($_FILES['qr_code'])) {
			$qr_code = $_FILES['qr_code']['name'];
			$qr_code_temp = $_FILES['qr_code']['tmp_name'];
			$qr_codefolder = "uploads/bank/" . $qr_code;

			$fileExtension = pathinfo($qr_codefolder, PATHINFO_EXTENSION); //get the file extention
			$qr_code = uniqid() . '.' . $fileExtension;
			while (file_exists("uploads/bank/" . $qr_code)) {
				//this loop will continue until it generates a unique file name
				$qr_code = uniqid() . '.' . $fileExtension;
			}

			move_uploaded_file($qr_code_temp, "uploads/bank/" . $qr_code);
		}
		if (isset($_POST['gpay'])) {
			$gpay = $_POST['gpay'];
		}
		if (isset($_POST['company'])) {
			$company = $_POST['company'];
		}
		if (isset($_POST['under_branch'])) {
			$under_branch = $_POST['under_branch'];
		}

		$insertQry = "INSERT INTO `bank_creation`(`bank_name`,`short_name`, `acc_no`, `ifsc`, `branch`, `qr_code`, `gpay`,`company`, `under_branch`,`insert_login_id`, `created_date`) VALUES 
			('" . strip_tags($bank_name) . "','" . strip_tags($short_name) . "','" . strip_tags($acc_no) . "','" . strip_tags($ifsc) . "','" . strip_tags($branch) . "','" . strip_tags($qr_code) . "','" . strip_tags($gpay) . "',
			'" . strip_tags($company) . "','" . strip_tags($under_branch) . "',$userid ,now() )";

		$insresult = $mysqli->query($insertQry) or die("Error " . $mysqli->error);
	}

	// Update Company
	public function updateBankCreation($mysqli, $id, $userid)
	{

		if (isset($_POST['bank_name'])) {
			$bank_name = $_POST['bank_name'];
		}
		if (isset($_POST['short_name'])) {
			$short_name = $_POST['short_name'];
		}
		if (isset($_POST['acc_no'])) {
			$acc_no = $_POST['acc_no'];
		}
		if (isset($_POST['ifsc'])) {
			$ifsc = $_POST['ifsc'];
		}
		if (isset($_POST['branch'])) {
			$branch = $_POST['branch'];
		}
		if (isset($_FILES['qr_code']) && $_FILES['qr_code']['name'] != '') {
			//remove old file
			if ($_POST['qr_code_name'] != '') {
				unlink('uploads/bank/' . $_POST['qr_code_name']);
			}

			$qr_code = $_FILES['qr_code']['name'];
			$qr_code_temp = $_FILES['qr_code']['tmp_name'];
			$qr_codefolder = "uploads/bank/" . $qr_code;

			$fileExtension = pathinfo($qr_codefolder, PATHINFO_EXTENSION); //get the file extention
			$qr_code = uniqid() . '.' . $fileExtension;
			while (file_exists("uploads/bank/" . $qr_code)) {
				//this loop will continue until it generates a unique file name
				$qr_code = uniqid() . '.' . $fileExtension;
			}

			move_uploaded_file($qr_code_temp, "uploads/bank/" . $qr_code);
		} else {
			$qr_code = $_POST['qr_code_name'];
		}
		if (isset($_POST['gpay'])) {
			$gpay = $_POST['gpay'];
		}
		if (isset($_POST['company'])) {
			$company = $_POST['company'];
		}
		if (isset($_POST['under_branch'])) {
			$under_branch = $_POST['under_branch'];
		}

		$updateQry = "UPDATE `bank_creation` SET `bank_name`='" . strip_tags($bank_name) . "',`short_name`='" . strip_tags($short_name) . "',`acc_no`='" . strip_tags($acc_no) . "',`ifsc`='" . strip_tags($ifsc) . "',
			`branch`='" . strip_tags($branch) . "',`qr_code`='" . strip_tags($qr_code) . "',`gpay`='" . strip_tags($gpay) . "',`company`='" . strip_tags($company) . "',
			`under_branch`='" . strip_tags($under_branch) . "',`update_login_id`=$userid WHERE id= $id";
		$updresult = $mysqli->query($updateQry) or die("Error in in update Query!." . $mysqli->error);
	}
	// Get Company
	public function getBankCreation($mysqli, $id)
	{

		$trusteeSelect = "SELECT * FROM bank_creation WHERE id='" . mysqli_real_escape_string($mysqli, $id) . "' ";
		$res = $mysqli->query($trusteeSelect) or die("Error in Get All Records" . $mysqli->error);

		if ($row = $res->fetch_object()) {
			$detailrecords = [
				'id'   => $row->id,
				'bank_name'   => $row->bank_name,
				'short_name'   => $row->short_name,
				'acc_no'   => $row->acc_no,
				'ifsc'   => $row->ifsc,
				'branch'   => $row->branch,
				'qr_code'   => $row->qr_code,
				'gpay'   => $row->gpay,
				'company'   => $row->company,
				'under_branch'   => $row->under_branch
			];
		} else {
			$detailrecords = array();
		}
		return $detailrecords;
	}

	//  Delete Company
	public function deleteBankCreation($mysqli, $id, $userid)
	{
		$deleteQry = "UPDATE bank_creation set status='1', delete_login_id='" . strip_tags($userid) . "' WHERE id  = '" . strip_tags($id) . "' ";
		$runQry = $mysqli->query($deleteQry) or die("Error in delete query" . $mysqli->error);
	}

	// Add Update
	public function addUpdateCustomerProfile($mysqli, $userid)
	{

		if (isset($_POST['cus_id'])) {
			$cus_id =  preg_replace('/\s+/', '', $_POST['cus_id']);
		}
		if (isset($_POST['cus_name'])) {
			$cus_name = $_POST['cus_name'];
		}
		if (isset($_POST['dob'])) {
			$dob =  $_POST['dob'];
		}
		if (isset($_POST['age'])) {
			$age = $_POST['age'];
		}
		if (isset($_POST['gender'])) {
			$gender = $_POST['gender'];
		}
		if (isset($_POST['state'])) {
			$state = $_POST['state'];
		}
		if (isset($_POST['district'])) {
			$district = $_POST['district'];
		}
		if (isset($_POST['taluk'])) {
			$taluk = $_POST['taluk'];
		}
		if (isset($_POST['area'])) {
			$area = $_POST['area'];
		}
		if (isset($_POST['sub_area'])) {
			$sub_area = $_POST['sub_area'];
		}
		if (isset($_POST['address'])) {
			$address = $_POST['address'];
		}
		if (isset($_POST['mobile1'])) {
			$mobile1 = $_POST['mobile1'];
		}
		$mobile2 = '';
		if (isset($_POST['mobile2'])) {
			$mobile2 = $_POST['mobile2'];
		}
		if (isset($_POST['father_name'])) {
			$father_name = $_POST['father_name'];
		}
		if (isset($_POST['mother_name'])) {
			$mother_name = $_POST['mother_name'];
		}
		if (isset($_POST['marital'])) {
			$marital = $_POST['marital'];
		}
		$spouse_name = '';
		if (isset($_POST['spouse_name'])) {
			$spouse_name = $_POST['spouse_name'];
		}
		if (isset($_POST['occupation_type'])) {
			$occupation_type = $_POST['occupation_type'];
		}
		if (isset($_POST['occupation'])) {
			$occupation = $_POST['occupation'];
		}
		if (isset($_POST['cus_res_type'])) {
			$cus_res_type = $_POST['cus_res_type'];
		}
		if (isset($_POST['cus_res_details'])) {
			$cus_res_details = $_POST['cus_res_details'];
		}
		if (isset($_POST['cus_res_address'])) {
			$cus_res_address = $_POST['cus_res_address'];
		}
		if (isset($_POST['cus_res_native'])) {
			$cus_res_native = $_POST['cus_res_native'];
		}
		if (isset($_POST['cus_occ_type'])) {
			$cus_occ_type = $_POST['cus_occ_type'];
		}
		if (isset($_POST['cus_occ_detail'])) {
			$cus_occ_detail = $_POST['cus_occ_detail'];
		}
		if (isset($_POST['cus_occ_income'])) {
			$cus_occ_income = $_POST['cus_occ_income'];
		}
		if (isset($_POST['cus_occ_address'])) {
			$cus_occ_address = $_POST['cus_occ_address'];
		}
		if (isset($_POST['area_cnfrm'])) {
			$area_cnfrm = $_POST['area_cnfrm'];
		}
		if (isset($_POST['area_state'])) {
			$area_state = $_POST['area_state'];
		}
		if (isset($_POST['area_district'])) {
			$area_district = $_POST['area_district'];
		}
		if (isset($_POST['area_taluk'])) {
			$area_taluk = $_POST['area_taluk'];
		}
		if (isset($_POST['area_confirm'])) {
			$area_confirm = $_POST['area_confirm'];
		}
		if (isset($_POST['area_sub_area'])) {
			$area_sub_area = $_POST['area_sub_area'];
		}
		if (isset($_POST['area_group'])) {
			$area_group = $_POST['area_group'];
		}
		if (isset($_POST['latlong'])) {
			$latlong = $_POST['latlong'];
		}
		if (isset($_POST['area_line'])) {
			$area_line = $_POST['area_line'];
		}

		if (isset($_POST['cus_how_know'])) {
			$cus_how_know = $_POST['cus_how_know'];
		}
		if (isset($_POST['cus_loan_count'])) {
			$cus_loan_count = $_POST['cus_loan_count'];
		}
		if (isset($_POST['cus_frst_loanDate'])) {
			$cus_frst_loanDate = $_POST['cus_frst_loanDate'];
		}
		if (isset($_POST['cus_travel_cmpy'])) {
			$cus_travel_cmpy = $_POST['cus_travel_cmpy'];
		}
		if (isset($_POST['cus_monthly_income'])) {
			$cus_monthly_income = $_POST['cus_monthly_income'];
		}
		if (isset($_POST['cus_other_income'])) {
			$cus_other_income = $_POST['cus_other_income'];
		}
		if (isset($_POST['cus_support_income'])) {
			$cus_support_income = $_POST['cus_support_income'];
		}
		if (isset($_POST['cus_Commitment'])) {
			$cus_Commitment = $_POST['cus_Commitment'];
		}
		if (isset($_POST['cus_monDue_capacity'])) {
			$cus_monDue_capacity = $_POST['cus_monDue_capacity'];
		}
		if (isset($_POST['cus_loan_limit'])) {
			$cus_loan_limit = $_POST['cus_loan_limit'];
		}
		if (isset($_POST['about_cus'])) {
			$about_cus = $_POST['about_cus'];
		}

		$updateCus = "UPDATE `customer_register` SET `customer_name`='" . strip_tags($cus_name) . "',`dob`='" . strip_tags($dob) . "',`age`='" . strip_tags($age) . "',`gender`='" . strip_tags($gender) . "',`state`='" . strip_tags($state) . "',`district`='" . strip_tags($district) . "',`taluk`='" . strip_tags($taluk) . "',`area`='" . strip_tags($area) . "',`sub_area`='" . strip_tags($sub_area) . "',`address`='" . strip_tags($address) . "',`mobile1`='" . strip_tags($mobile1) . "', `mobile2`='" . strip_tags($mobile2) . "',`father_name`='" . strip_tags($father_name) . "',`mother_name`='" . strip_tags($mother_name) . "',`marital`='" . strip_tags($marital) . "',`spouse`='" . strip_tags($spouse_name) . "',`occupation_type`='" . strip_tags($occupation_type) . "',`occupation`='" . strip_tags($occupation) . "',`how_to_know`='" . strip_tags($cus_how_know) . "',`loan_count`='" . strip_tags($cus_loan_count) . "',`first_loan_date`='" . strip_tags($cus_frst_loanDate) . "',`travel_with_company`='" . strip_tags($cus_travel_cmpy) . "',`monthly_income`='" . strip_tags($cus_monthly_income) . "',`other_income`='" . strip_tags($cus_other_income) . "',`support_income`='" . strip_tags($cus_support_income) . "',`commitment`='" . strip_tags($cus_Commitment) . "',`monthly_due_capacity`='" . strip_tags($cus_monDue_capacity) . "',`loan_limit`='" . strip_tags($cus_loan_limit) . "',`about_customer`='" . strip_tags($about_cus) . "',`residential_type`='" . strip_tags($cus_res_type) . "',`residential_details`='" . strip_tags($cus_res_details) . "',`residential_address`='" . strip_tags($cus_res_address) . "',`residential_native_address`='" . strip_tags($cus_res_native) . "',`occupation_info_occ_type`='" . strip_tags($cus_occ_type) . "',`occupation_details`='" . strip_tags($cus_occ_detail) . "',`occupation_income`='" . strip_tags($cus_occ_income) . "',`occupation_address`='" . strip_tags($cus_occ_address) . "',`area_confirm_type`='" . strip_tags($area_cnfrm) . "',`area_confirm_state`='" . strip_tags($area_state) . "',`area_confirm_district`='" . strip_tags($area_district) . "',`area_confirm_taluk`='" . strip_tags($area_taluk) . "',`area_confirm_area`='" . strip_tags($area_confirm) . "',`area_confirm_subarea`='" . strip_tags($area_sub_area) . "',`latlong`='" . strip_tags($latlong) . "',`area_group`='" . strip_tags($area_group) . "',`area_line`='" . strip_tags($area_line) . "' WHERE `cus_id`= '" . strip_tags($cus_id) . "' ";
		$insresult = $mysqli->query($updateCus) or die("Error " . $mysqli->error);
	}


	// Add Update Documentation
	public function updateMortEndorse($mysqli, $userid, $type)
	{

		if ($type == 'mort') {

			if (isset($_POST['mortgage_process'])) {
				$mortgage_process = $_POST['mortgage_process'];
			}
			if (isset($_POST['Propertyholder_type'])) {
				$Propertyholder_type = $_POST['Propertyholder_type'];
			}
			$Propertyholder_name = '';
			if (isset($_POST['Propertyholder_name'])) {
				$Propertyholder_name = $_POST['Propertyholder_name'];
			}
			$Propertyholder_relationship_name = '';
			if (isset($_POST['Propertyholder_relationship_name'])) {
				$Propertyholder_relationship_name = $_POST['Propertyholder_relationship_name'];
			}
			if (isset($_POST['doc_property_relation'])) {
				$doc_property_relation = $_POST['doc_property_relation'];
			}
			if (isset($_POST['doc_property_pype'])) {
				$doc_property_pype = $_POST['doc_property_pype'];
			}
			if (isset($_POST['doc_property_measurement'])) {
				$doc_property_measurement = $_POST['doc_property_measurement'];
			}
			if (isset($_POST['doc_property_location'])) {
				$doc_property_location = $_POST['doc_property_location'];
			}
			if (isset($_POST['doc_property_value'])) {
				$doc_property_value = $_POST['doc_property_value'];
			}
			if (isset($_POST['mortgage_name'])) {
				$mortgage_name = $_POST['mortgage_name'];
			}
			if (isset($_POST['mortgage_dsgn'])) {
				$mortgage_dsgn = $_POST['mortgage_dsgn'];
			}
			if (isset($_POST['mortgage_nuumber'])) {
				$mortgage_nuumber = $_POST['mortgage_nuumber'];
			}
			if (isset($_POST['reg_office'])) {
				$reg_office = $_POST['reg_office'];
			}
			if (isset($_POST['mortgage_value'])) {
				$mortgage_value = $_POST['mortgage_value'];
			}
			if (isset($_POST['mortgage_document'])) {
				$mortgage_document = $_POST['mortgage_document'];
			}
			$pendingchk = 'NO';
			if (!empty($_FILES['mortgage_document_upd']['name'])) {
				$mortgage_doc_upd = $_FILES['mortgage_document_upd']['name'];
				$upd_temp = $_FILES['mortgage_document_upd']['tmp_name'];
				$folder = "uploads/verification/mortgage_doc/" . $mortgage_doc_upd;

				$fileExtension = pathinfo($folder, PATHINFO_EXTENSION); //get the file extention
				$mortgage_doc_upd = uniqid() . '.' . $fileExtension;
				while (file_exists("uploads/verification/mortgage_doc/" . $mortgage_doc_upd)) {
					//this loop will continue until it generates a unique file name
					$mortgage_doc_upd = uniqid() . '.' . $fileExtension;
				}

				move_uploaded_file($upd_temp, "uploads/verification/mortgage_doc/" . $mortgage_doc_upd);
			} else {
				if (isset($_POST['pendingchk'])) {
					$pendingchk = $_POST['pendingchk'];
					$mortgage_doc_upd = '';
				}
			}

			//////////////////////////////////////
		} else if ($type == 'endor') {

			if (isset($_POST['endorsement_process'])) {
				$endorsement_process = $_POST['endorsement_process'];
			}
			if (isset($_POST['owner_type'])) {
				$owner_type = $_POST['owner_type'];
			}
			$owner_name = '';
			if (isset($_POST['owner_name'])) {
				$owner_name = $_POST['owner_name'];
			}
			$ownername_relationship_name = '';
			if (isset($_POST['ownername_relationship_name'])) {
				$ownername_relationship_name = $_POST['ownername_relationship_name'];
			}
			if (isset($_POST['en_relation'])) {
				$en_relation = $_POST['en_relation'];
			}
			if (isset($_POST['vehicle_type'])) {
				$vehicle_type = $_POST['vehicle_type'];
			}
			if (isset($_POST['vehicle_process'])) {
				$vehicle_process = $_POST['vehicle_process'];
			}
			if (isset($_POST['en_Company'])) {
				$en_Company = $_POST['en_Company'];
			}

			if (isset($_POST['en_Model'])) {
				$en_Model = $_POST['en_Model'];
			}
			$vehicle_reg_no = '';
			if (isset($_POST['vehicle_reg_no'])) {
				$vehicle_reg_no = $_POST['vehicle_reg_no'];
			}
			if (isset($_POST['endorsement_name'])) {
				$endorsement_name = $_POST['endorsement_name'];
			}
			if (isset($_POST['en_RC'])) {
				$en_RC = $_POST['en_RC'];
			}
			$endorsependingchk = 'NO';
			if (!empty($_FILES['Rc_document_upd']['name'])) {
				$Rc_document_upd = $_FILES['Rc_document_upd']['name'];
				$upd_temp = $_FILES['Rc_document_upd']['tmp_name'];
				$folder = "uploads/verification/endorsement_doc/" . $Rc_document_upd;

				$fileExtension = pathinfo($folder, PATHINFO_EXTENSION); //get the file extention
				$Rc_document_upd = uniqid() . '.' . $fileExtension;
				while (file_exists("uploads/verification/endorsement_doc/" . $Rc_document_upd)) {
					//this loop will continue until it generates a unique file name
					$Rc_document_upd = uniqid() . '.' . $fileExtension;
				}

				move_uploaded_file($upd_temp, "uploads/verification/endorsement_doc/" . $Rc_document_upd);
			} else {
				if (isset($_POST['endorsependingchk'])) {
					$endorsependingchk = $_POST['endorsependingchk'];
					$Rc_document_upd = '';
				}
			}
			if (isset($_POST['en_Key'])) {
				$en_Key = $_POST['en_Key'];
			}
		}

		if (isset($_POST['req_id_doc'])) {
			$req_id = $_POST['req_id_doc'];
		}

		$qry = 'UPDATE acknowlegement_documentation SET ';

		if ($type == 'mort') {

			$qry .= " `mortgage_process`='" . strip_tags($mortgage_process) . "',`Propertyholder_type`='" . strip_tags($Propertyholder_type) . "',
					`Propertyholder_name`='" . strip_tags($Propertyholder_name) . "',`Propertyholder_relationship_name`='" . strip_tags($Propertyholder_relationship_name) . "',
					`doc_property_relation`='" . strip_tags($doc_property_relation) . "',`doc_property_type`='" . strip_tags($doc_property_pype) . "',
					`doc_property_measurement`='" . strip_tags($doc_property_measurement) . "',`doc_property_location`='" . strip_tags($doc_property_location) . "',
					`doc_property_value`='" . strip_tags($doc_property_value) . "',`mortgage_name`='" . strip_tags($mortgage_name) . "',`mortgage_dsgn`='" . strip_tags($mortgage_dsgn) . "',
					`mortgage_nuumber`='" . strip_tags($mortgage_nuumber) . "',`reg_office`='" . strip_tags($reg_office) . "',`mortgage_value`='" . strip_tags($mortgage_value) . "',
					`mortgage_document`='" . strip_tags($mortgage_document) . "',`mortgage_document_upd`='" . strip_tags($mortgage_doc_upd) . "',
					`mortgage_document_pending`='" . strip_tags($pendingchk) . "',`update_login_id`='$userid',`updated_date`=now() ";
		} else if ($type == 'endor') {

			$qry .= " `endorsement_process`='" . strip_tags($endorsement_process) . "',`owner_type`='" . strip_tags($owner_type) . "',`owner_name`='" . strip_tags($owner_name) . "',
					`ownername_relationship_name`='" . strip_tags($ownername_relationship_name) . "',`en_relation`='" . strip_tags($en_relation) . "',`vehicle_type`='" . strip_tags($vehicle_type) . "',
					`vehicle_process`='" . strip_tags($vehicle_process) . "',`en_Company`='" . strip_tags($en_Company) . "',`en_Model`='" . strip_tags($en_Model) . "',
					`vehicle_reg_no`='" . strip_tags($vehicle_reg_no) . "',`endorsement_name`='" . strip_tags($endorsement_name) . "',`en_RC`='" . strip_tags($en_RC) . "',
					`Rc_document_upd`='" . strip_tags($Rc_document_upd) . "',`Rc_document_pending`='" . strip_tags($endorsependingchk) . "',`en_Key`='" . strip_tags($en_Key) . "',
					`update_login_id`='$userid',`updated_date`=now() ";
		}

		$qry .= " WHERE req_id = '$req_id' ";

		$run = $mysqli->query($qry);
	}


	//Bank Details Fetch
	public function getBankDetails($mysqli)
	{
		$qry = "SELECT * FROM bank_creation WHERE 1 ";
		$res = $mysqli->query($qry) or die("Error in Get All Records" . $mysqli->error);
		$i = 0;
		$detailrecords = array();
		while ($row = $res->fetch_object()) {
			$detailrecords[$i]	 = [
				'id'   => $row->id,
				'bank_name'   => $row->bank_name,
				'short_name'   => $row->short_name,
				'acc_no'   => $row->acc_no,
				'ifsc'   => $row->ifsc,
				'branch'   => $row->branch,
				'qr_code'   => $row->qr_code,
				'gpay'   => $row->gpay,
				'company'   => $row->company,
				'under_branch'   => $row->under_branch
			];
			$i++;
		}
		return $detailrecords;
	}

	//Customer Profile update 
	public function updateCustomerProfile($mysqli, $userid)
	{
		if (isset($_POST['cus_id'])) {
			$cus_id =  preg_replace('/\s+/', '', $_POST['cus_id']);
		}
		if (isset($_POST['cus_name'])) {
			$cus_name = $_POST['cus_name'];
		}
		if (isset($_POST['dob'])) {
			$dob =  $_POST['dob'];
		}
		if (isset($_POST['age'])) {
			$age = $_POST['age'];
		}
		if (isset($_POST['gender'])) {
			$gender = $_POST['gender'];
		}
		if (isset($_POST['state'])) {
			$state = $_POST['state'];
		}
		if (isset($_POST['district'])) {
			$district = $_POST['district'];
		}
		if (isset($_POST['taluk'])) {
			$taluk = $_POST['taluk'];
		}
		if (isset($_POST['area'])) {
			$area = $_POST['area'];
		}
		if (isset($_POST['sub_area'])) {
			$sub_area = $_POST['sub_area'];
		}
		if (isset($_POST['cus_address'])) {
			$cus_address = $_POST['cus_address'];
		}
		if (isset($_POST['mobile1'])) {
			$mobile1 = $_POST['mobile1'];
		}
		$mobile2 = '';
		if (isset($_POST['mobile2'])) {
			$mobile2 = $_POST['mobile2'];
		}
		if (isset($_POST['father_name'])) {
			$father_name = $_POST['father_name'];
		}
		if (isset($_POST['mother_name'])) {
			$mother_name = $_POST['mother_name'];
		}
		if (isset($_POST['marital'])) {
			$marital = $_POST['marital'];
		}
		$spouse_name = '';
		if (isset($_POST['spouse_name'])) {
			$spouse_name = $_POST['spouse_name'];
		}

		if (!empty($_FILES['pic']['name'])) {
			$oldPic = $_POST['cus_image'];
			if ($oldPic != '') {
				unlink("uploads/request/customer/" . $oldPic); //delete old pic
				unlink("uploads/verification/customer/" . $oldPic); //delete old pic
			}

			// Get the original filename and temporary path of the uploaded file
			$pic = $_FILES['pic']['name'];
			$pic_temp = $_FILES['pic']['tmp_name'];

			// Extract the file extension from the original filename
			$fileExtension = pathinfo($pic, PATHINFO_EXTENSION);

			// Generate a unique filename
			$cus_pic = uniqid() . '.' . $fileExtension;
			// Check if the unique filename already exists in the request folder
			while (file_exists("uploads/request/customer/{$cus_pic}")) {
				// If it exists, generate a new unique filename
				$cus_pic = uniqid() . '.' . $fileExtension;
			}
			// Move the uploaded file to the request folder with the new unique filename
			move_uploaded_file($pic_temp, "uploads/request/customer/{$cus_pic}");
			copy("uploads/request/customer/{$cus_pic}", "uploads/verification/customer/{$cus_pic}");
		} else {
			$cus_pic = $_POST['cus_image'];
		}

		if (isset($_POST['guarentor_name'])) {
			$guarentor_name = $_POST['guarentor_name'];
		}
		if (isset($_POST['guarentor_relationship'])) {
			$guarentor_relation = $_POST['guarentor_relationship'];
		}
		if (!empty($_FILES['guarentorpic']['name'])) {
			$oldPic = $_POST['guarentor_image'];
			if ($oldPic != '') {
				unlink("uploads/verification/guarentor/" . $oldPic); //delete old pic
			}

			$guarentor_pic = $_FILES['guarentorpic']['name'];
			$pic_temp = $_FILES['guarentorpic']['tmp_name'];
			$picfolder = "uploads/verification/guarentor/" . $guarentor_pic;

			$fileExtension = pathinfo($picfolder, PATHINFO_EXTENSION); //get the file extention
			$guarentor_pic = uniqid() . '.' . $fileExtension;
			while (file_exists("uploads/verification/guarentor/" . $guarentor_pic)) {
				//this loop will continue until it generates a unique file name
				$guarentor_pic = uniqid() . '.' . $fileExtension;
			}

			move_uploaded_file($pic_temp, "uploads/verification/guarentor/" . $guarentor_pic);
		} else {
			$guarentor_pic = $_POST['guarentor_image'];
		}
		if (isset($_POST['occupation_type'])) {
			$occupation_type = $_POST['occupation_type'];
		}
		if (isset($_POST['occupation'])) {
			$occupation = $_POST['occupation'];
		}
		if (isset($_POST['cus_res_type'])) {
			$cus_res_type = $_POST['cus_res_type'];
		}
		if (isset($_POST['cus_res_details'])) {
			$cus_res_details = $_POST['cus_res_details'];
		}
		if (isset($_POST['cus_res_address'])) {
			$cus_res_address = $_POST['cus_res_address'];
		}
		if (isset($_POST['cus_res_native'])) {
			$cus_res_native = $_POST['cus_res_native'];
		}
		if (isset($_POST['cus_occ_type'])) {
			$cus_occ_type = $_POST['cus_occ_type'];
		}
		if (isset($_POST['cus_occ_detail'])) {
			$cus_occ_detail = $_POST['cus_occ_detail'];
		}
		if (isset($_POST['cus_occ_income'])) {
			$cus_occ_income = $_POST['cus_occ_income'];
		}
		if (isset($_POST['cus_occ_address'])) {
			$cus_occ_address = $_POST['cus_occ_address'];
		}
		if (isset($_POST['cus_occ_dow'])) {
			$cus_occ_dow = $_POST['cus_occ_dow'];
		}
		if (isset($_POST['cus_occ_abt'])) {
			$cus_occ_abt = $_POST['cus_occ_abt'];
		}
		if (isset($_POST['area_cnfrm'])) {
			$area_cnfrm = $_POST['area_cnfrm'];
		}
		if (isset($_POST['area_state'])) {
			$area_state = $_POST['area_state'];
		}
		if (isset($_POST['area_district'])) {
			$area_district = $_POST['area_district'];
		}
		if (isset($_POST['area_taluk'])) {
			$area_taluk = $_POST['area_taluk'];
		}
		if (isset($_POST['area_confirm'])) {
			$area_confirm = $_POST['area_confirm'];
		}
		if (isset($_POST['area_sub_area'])) {
			$area_sub_area = $_POST['area_sub_area'];
		}
		if (isset($_POST['area_group'])) {
			$area_group = $_POST['area_group'];
		}
		if (isset($_POST['latlong'])) {
			$latlong = $_POST['latlong'];
		}
		if (isset($_POST['area_line'])) {
			$area_line = $_POST['area_line'];
		}
		if (isset($_POST['cus_how_know'])) {
			$cus_how_know = $_POST['cus_how_know'];
		}
		if (isset($_POST['cus_loan_count'])) {
			$cus_loan_count = $_POST['cus_loan_count'];
		}
		if (isset($_POST['cus_frst_loanDate'])) {
			$cus_frst_loanDate = $_POST['cus_frst_loanDate'];
		}
		if (isset($_POST['cus_travel_cmpy'])) {
			$cus_travel_cmpy = $_POST['cus_travel_cmpy'];
		}
		if (isset($_POST['cus_monthly_income'])) {
			$cus_monthly_income = $_POST['cus_monthly_income'];
		}
		if (isset($_POST['cus_other_income'])) {
			$cus_other_income = $_POST['cus_other_income'];
		}
		if (isset($_POST['cus_support_income'])) {
			$cus_support_income = $_POST['cus_support_income'];
		}
		if (isset($_POST['cus_Commitment'])) {
			$cus_Commitment = $_POST['cus_Commitment'];
		}
		if (isset($_POST['cus_monDue_capacity'])) {
			$cus_monDue_capacity = $_POST['cus_monDue_capacity'];
		}
		if (isset($_POST['cus_loan_limit'])) {
			$cus_loan_limit = $_POST['cus_loan_limit'];
		}
		if (isset($_POST['about_cus'])) {
			$about_cus = $_POST['about_cus'];
		}
		if (isset($_POST['cus_Tableid'])) {
			$cus_Tableid = $_POST['cus_Tableid'];
		}


		$cusUpd = "UPDATE `customer_profile` SET `cus_id`='" . strip_tags($cus_id) . "',`cus_name`='" . strip_tags($cus_name) . "',`gender`='" . strip_tags($gender) . "',`dob`='" . strip_tags($dob) . "',`age`='" . strip_tags($age) . "',`mobile1`='" . strip_tags($mobile1) . "',`mobile2`='" . strip_tags($mobile2) . "',`cus_pic`='" . strip_tags($cus_pic) . "',`guarentor_name`='" . strip_tags($guarentor_name) . "',`guarentor_relation`='" . strip_tags($guarentor_relation) . "',`guarentor_photo`='" . strip_tags($guarentor_pic) . "',`residential_type`='" . strip_tags($cus_res_type) . "',`residential_details`='" . strip_tags($cus_res_details) . "',`residential_address`='" . strip_tags($cus_res_address) . "',`residential_native_address`='" . strip_tags($cus_res_native) . "',`occupation_type`='" . strip_tags($cus_occ_type) . "',`occupation_details`='" . strip_tags($cus_occ_detail) . "',`occupation_income`='" . strip_tags($cus_occ_income) . "',`occupation_address`='" . strip_tags($cus_occ_address) . "',`dow`='" . strip_tags($cus_occ_dow) . "',`abt_occ`='" . strip_tags($cus_occ_abt) . "',`area_confirm_type`='" . strip_tags($area_cnfrm) . "',`area_confirm_state`='" . strip_tags($area_state) . "',`area_confirm_district`='" . strip_tags($area_district) . "',`area_confirm_taluk`='" . strip_tags($area_taluk) . "',`area_confirm_area`='" . strip_tags($area_confirm) . "',`area_confirm_subarea`='" . strip_tags($area_sub_area) . "',`latlong`='" . strip_tags($latlong) . "',`area_group`='" . strip_tags($area_group) . "',`area_line`='" . strip_tags($area_line) . "',`update_login_id`='" . $userid . "',`updated_date`= now() WHERE `cus_id`='" . strip_tags($cus_id) . "' ";
		$updateCus = $mysqli->query($cusUpd) or die("Error " . $mysqli->error);

		$insertQry = "UPDATE in_verification set `cus_name`='" . strip_tags($cus_name) . "',`gender`='" . strip_tags($gender) . "',`dob`='" . strip_tags($dob) . "',`age`='" . strip_tags($age) . "',`mobile1`='" . strip_tags($mobile1) . "', `mobile2`='" . strip_tags($mobile2) . "' where `cus_id`='" . strip_tags($cus_id) . "' ";
		$insresult = $mysqli->query($insertQry) or die("Error " . $mysqli->error);


		$updateCus = "UPDATE `customer_register` SET  `cus_id`='" . strip_tags($cus_id) . "',`customer_name`='" . strip_tags($cus_name) . "',`gender`='" . strip_tags($gender) . "',`dob`='" . strip_tags($dob) . "',`age`='" . strip_tags($age) . "',`state`='" . strip_tags($state) . "',`district`='" . strip_tags($district) . "',`taluk`='" . strip_tags($taluk) . "',`area`='" . strip_tags($area) . "',`sub_area`='" . strip_tags($sub_area) . "',`address`='" . strip_tags($cus_address) . "',`mobile1`='" . strip_tags($mobile1) . "', `mobile2`='" . strip_tags($mobile2) . "',`father_name`='" . strip_tags($father_name) . "',`mother_name`='" . strip_tags($mother_name) . "',`marital`='" . strip_tags($marital) . "',`spouse`='" . strip_tags($spouse_name) . "',`occupation_type`='" . strip_tags($occupation_type) . "',`occupation`='" . strip_tags($occupation) . "',`pic` = '" . strip_tags($cus_pic) . "', `how_to_know`='" . strip_tags($cus_how_know) . "',`loan_count`='" . strip_tags($cus_loan_count) . "',`first_loan_date`='" . strip_tags($cus_frst_loanDate) . "',`travel_with_company`='" . strip_tags($cus_travel_cmpy) . "',`monthly_income`='" . strip_tags($cus_monthly_income) . "',`other_income`='" . strip_tags($cus_other_income) . "',`support_income`='" . strip_tags($cus_support_income) . "',`commitment`='" . strip_tags($cus_Commitment) . "',`monthly_due_capacity`='" . strip_tags($cus_monDue_capacity) . "',`loan_limit`='" . strip_tags($cus_loan_limit) . "',`about_customer`='" . strip_tags($about_cus) . "',`residential_type`='" . strip_tags($cus_res_type) . "',`residential_details`='" . strip_tags($cus_res_details) . "',`residential_address`='" . strip_tags($cus_res_address) . "',`residential_native_address`='" . strip_tags($cus_res_native) . "',`occupation_info_occ_type`='" . strip_tags($cus_occ_type) . "',`occupation_details`='" . strip_tags($cus_occ_detail) . "',`occupation_income`='" . strip_tags($cus_occ_income) . "',`occupation_address`='" . strip_tags($cus_occ_address) . "',`dow`='" . strip_tags($cus_occ_dow) . "',`abt_occ`='" . strip_tags($cus_occ_abt) . "',`area_confirm_type`='" . strip_tags($area_cnfrm) . "',`area_confirm_state`='" . strip_tags($area_state) . "',`area_confirm_district`='" . strip_tags($area_district) . "',`area_confirm_taluk`='" . strip_tags($area_taluk) . "',`area_confirm_area`='" . strip_tags($area_confirm) . "',`area_confirm_subarea`='" . strip_tags($area_sub_area) . "',`latlong`='" . strip_tags($latlong) . "',`area_group`='" . strip_tags($area_group) . "',`area_line`='" . strip_tags($area_line) . "' WHERE `cus_id`= '" . strip_tags($cus_id) . "' ";
		$insresult = $mysqli->query($updateCus) or die("Error " . $mysqli->error);


		$updateACkCus = "UPDATE `acknowlegement_customer_profile` SET `cus_id`='" . strip_tags($cus_id) . "',`cus_name`='" . strip_tags($cus_name) . "',`gender`='" . strip_tags($gender) . "',`dob`='" . strip_tags($dob) . "',`age`='" . strip_tags($age) . "',`mobile1`='" . strip_tags($mobile1) . "',`mobile2`='" . strip_tags($mobile2) . "',`cus_pic`='" . strip_tags($cus_pic) . "',`guarentor_name`='" . strip_tags($guarentor_name) . "',`guarentor_relation`='" . strip_tags($guarentor_relation) . "',`guarentor_photo`='" . strip_tags($guarentor_pic) . "',`residential_type`='" . strip_tags($cus_res_type) . "',`residential_details`='" . strip_tags($cus_res_details) . "',`residential_address`='" . strip_tags($cus_res_address) . "',`residential_native_address`='" . strip_tags($cus_res_native) . "',`occupation_type`='" . strip_tags($cus_occ_type) . "',`occupation_details`='" . strip_tags($cus_occ_detail) . "',`occupation_income`='" . strip_tags($cus_occ_income) . "',`occupation_address`='" . strip_tags($cus_occ_address) . "',`dow`='" . strip_tags($cus_occ_dow) . "',`abt_occ`='" . strip_tags($cus_occ_abt) . "',`area_confirm_type`='" . strip_tags($area_cnfrm) . "',`area_confirm_state`='" . strip_tags($area_state) . "',`area_confirm_district`='" . strip_tags($area_district) . "',`area_confirm_taluk`='" . strip_tags($area_taluk) . "',`area_confirm_area`='" . strip_tags($area_confirm) . "',`area_confirm_subarea`='" . strip_tags($area_sub_area) . "',`latlong`='" . strip_tags($latlong) . "',`area_group`='" . strip_tags($area_group) . "',`area_line`='" . strip_tags($area_line) . "',`update_login_id`='" . $userid . "',`updated_date`= now() WHERE `cus_id`='" . strip_tags($cus_id) . "' ";
		$insresult = $mysqli->query($updateACkCus) or die("Error " . $mysqli->error);
	}

	public function getGuarantorDetails($mysqli, $cus_id)
	{

		$qry = $mysqli->query("SELECT * FROM `customer_profile` WHERE cus_id='$cus_id' ORDER by id DESC ");
		$detailrecords = array();
		$i = 0;
		if ($mysqli->affected_rows > 0) {
			$row = $qry->fetch_assoc();
			$detailrecords['guarentor_name'] = $row['guarentor_name'];
			$detailrecords['guarentor_relation'] = $row['guarentor_relation'];
			$detailrecords['guarentor_photo'] = $row['guarentor_photo'];
		}

		return $detailrecords;
	}

	public function getDataForDashboard($mysqli, $userid)
	{

		$today = date('Y-m-d');
		$data = array();

		// $sql = $mysqli->query("SELECT count(*) FROM `request_creation` WHERE insert_login_id = $userid and date(created_date) = date('$today') ");
		$sql = $mysqli->query("SELECT count(*) FROM `request_creation` WHERE insert_login_id = $userid ");
		$row = $sql->fetch_assoc();
		$data['today_request'] = $row['count(*)'] ?? 0;
		// $sql = $mysqli->query("SELECT count(*) FROM `request_creation` WHERE insert_login_id = $userid and ( month(created_date) = month('$today') and year(created_date) = year('$today') ) ");
		$sql = $mysqli->query("SELECT count(*) FROM `request_creation` WHERE insert_login_id = $userid  ");
		$row = $sql->fetch_assoc();
		$data['month_request'] = $row['count(*)'] ?? 0;


		// $sql = $mysqli->query("SELECT count(*) FROM ( SELECT MAX(id) AS last_id FROM loan_issue WHERE insert_login_id = $userid and balance_amount = '0' and date(created_date) = date('$today') GROUP BY req_id ) AS subquery ");
		$sql = $mysqli->query("SELECT count(*) FROM ( SELECT MAX(id) AS last_id FROM loan_issue WHERE insert_login_id = $userid and balance_amount = '0' GROUP BY req_id ) AS subquery;");
		$row = $sql->fetch_assoc();
		$data['today_loan'] = $row['count(*)'] ?? 0;
		// $sql = $mysqli->query("SELECT count(*) FROM ( SELECT MAX(id) AS last_id FROM loan_issue WHERE insert_login_id = $userid and balance_amount = '0' and ( month(created_date) = month('$today') and year(created_date) = year('$today') ) GROUP BY req_id ) AS subquery");
		$sql = $mysqli->query("SELECT count(*) FROM ( SELECT MAX(id) AS last_id FROM loan_issue WHERE insert_login_id = $userid and balance_amount = '0' GROUP BY req_id ) AS subquery;");
		$row = $sql->fetch_assoc();
		$data['month_loan'] = $row['count(*)'] ?? 0;


		// $sql = $mysqli->query("SELECT count(*) FROM `collection` WHERE insert_login_id = $userid and date(created_date) = date('$today') ");
		$sql = $mysqli->query("SELECT count(*) FROM `collection` WHERE insert_login_id = $userid ");
		$row = $sql->fetch_assoc();
		$data['today_collection_no'] = $row['count(*)'] ?? 0;
		// $sql = $mysqli->query("SELECT count(*) FROM `collection` WHERE insert_login_id = $userid and ( month(created_date) = month('$today') and year(created_date) = year('$today') )");
		$sql = $mysqli->query("SELECT count(*) FROM `collection` WHERE insert_login_id = $userid ");
		$row = $sql->fetch_assoc();
		$data['month_collection_no'] = $row['count(*)'] ?? 0;


		// $sql = $mysqli->query("SELECT sum(total_paid_track) as total_paid FROM `collection` WHERE insert_login_id = $userid and date(created_date) = date('$today') ");
		$sql = $mysqli->query("SELECT sum(total_paid_track) as total_paid FROM `collection` WHERE insert_login_id = $userid ");
		$row = $sql->fetch_assoc();
		$data['today_collection'] = moneyFormatIndia($row['total_paid']) ?? 0;

		// $sql = $mysqli->query("SELECT sum(total_paid_track) as total_paid FROM `collection` WHERE insert_login_id = $userid and ( month(created_date) = month('$today') and year(created_date) = year('$today') ) ");
		$sql = $mysqli->query("SELECT sum(total_paid_track) as total_paid FROM `collection` WHERE insert_login_id = $userid ");
		$row = $sql->fetch_assoc();
		$data['month_collection'] = moneyFormatIndia($row['total_paid']) ?? 0;



		return $data;
	}

	public function sendMonthlyReminder()
	{

		$m_customer_name = [];
		if (isset($_POST['m_cus_name'])) {
			$m_customer_name = $_POST['m_cus_name'];
		}
		if (isset($_POST['m_cus_no'])) {
			$m_customer_no = $_POST['m_cus_no'];
		}
		if (isset($_POST['m_cus_due'])) {
			$m_customer_due = $_POST['m_cus_due'];
		}

		for ($i = 0; $i < count($m_customer_name); $i++) {
			// $message = "Hi ".$m_customer_name[$i].", Your loan payment of ".$m_customer_due[$i]." is due on ".date('01/m/Y').". Please pay on time to avoid penalty. -MARUDM";
			// $templateid	= ''; //FROM DLT PORTAL.
			// // Account details
			// $apiKey = '';
			// // Message details
			// $sender = '';
			// // Prepare data for POST request
			// $data = 'access_token='.$apiKey.'&to='.$m_customer_no[$i].'&message='.$message.'&service=T&sender='.$sender.'&template_id='.$templateid;
			// // Send the GET request with cURL
			// $url = 'https://sms.messagewall.in/api/v2/sms/send?'.$data; 
			// $response = file_get_contents($url);  
			// // Process your response here
			// return $response; 
		}
	}

	public function sendbirthdaySMS()
	{

		$cus_name = [];
		if (isset($_POST['cus_name'])) {
			$cus_name = $_POST['cus_name'];
		}
		if (isset($_POST['cus_mobileno'])) {
			$cus_mobileno = $_POST['cus_mobileno'];
		}

		for ($i = 0; $i < count($cus_name); $i++) {
			// $message = "Dear ".$cus_name[$i].", today is a special day for you. Marudham Capitals wishes you 'Happy birthday'.-MARUDM";
			// $templateid	= ''; //FROM DLT PORTAL.
			// // Account details
			// $apiKey = '';
			// // Message details
			// $sender = '';
			// // Prepare data for POST request
			// $data = 'access_token='.$apiKey.'&to='.$cus_mobileno[$i].'&message='.$message.'&service=T&sender='.$sender.'&template_id='.$templateid;
			// // Send the GET request with cURL
			// $url = 'https://sms.messagewall.in/api/v2/sms/send?'.$data; 
			// $response = file_get_contents($url);  
			// // Process your response here
			// return $response; 
		}
	}

	public function sendfestivalSMS($mysqli, $userid)
	{

		$festival_name = [];
		if (isset($_POST['festival_name'])) {
			$festival_name = $_POST['festival_name'];
		}

		$qry = $mysqli->query("SELECT customer_name, mobile1 from customer_register ");
		while ($row = $qry->fetch_assoc()) {
			$customer_name[] = $row['customer_name'];
			$cus_mobile1[] = $row['mobile1'];
		}

		for ($a = 0; $a < count($festival_name); $a++) {
			for ($i = 0; $i < count($customer_name); $i++) {
				// $message = "Hi ".$customer_name[$i].", Wishing you a joyous ".$festival_name[$a]."! May it bring happiness, prosperity, and good health to you and your loved ones.Best wishes!-MARUDM";
				// $templateid	= ''; //FROM DLT PORTAL.
				// // Account details
				// $apiKey = '';
				// // Message details
				// $sender = '';
				// // Prepare data for POST request
				// $data = 'access_token='.$apiKey.'&to='.$cus_mobile1[$i].'&message='.$message.'&service=T&sender='.$sender.'&template_id='.$templateid;
				// // Send the GET request with cURL
				// $url = 'https://sms.messagewall.in/api/v2/sms/send?'.$data; 
				// $response = file_get_contents($url);  
				// // Process your response here
				// return $response; 
			} // customer count loop
		} //Festival name loop
	}
}//Class End
