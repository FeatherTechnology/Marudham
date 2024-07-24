<!-- Page header start -->
<br><br>
<div class="page-header">
	<div style="background-color:#009688; width:100%; padding:12px; color: #ffff; font-size: 20px; border-radius:5px;">
		Marudham - Concern Feedback
	</div>
</div><br>

<?php
@session_start();
include('ajaxconfig.php');

if (isset($_SESSION["userid"])) {
	$userid = $_SESSION["userid"];
}

$userQry = $con->query("SELECT 1 FROM USER WHERE user_id = '$userid' && role ='3'"); // Check Whether the user is staff or not ,if not means concern screen will not be show.
$rowuser = mysqli_num_rows($userQry);
if ($rowuser > 0) {
?>

	<!-- Main container start -->
	<div class="main-container">
		<!-- Row start -->
		<div class="row gutters">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				<div class="table-container">

					<div class="table-responsive">
						<table id="concern_feedback_table" class="table custom-table">
							<thead>
								<tr>
									<th width="50">S.No.</th>
									<th>Concern Code</th>
									<th>Concern Date</th>
									<th>Branch Name</th>
									<th>Staff Assign</th>
									<th>Subject</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<!-- Row end -->
	</div>
	<!-- Main container end -->

<?php } else { ?>

	<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
		<div class="card">
			<div class="card-header" style="text-align: center;"> </div>
			<div class="card-body">
				<div class="row">

					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
						<div class="form-group">
							<h4 style="display: flex; justify-content: center; align-items: center; font-weight: bold;"> Concern Feedback is only for Staffs </h4>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>

<?php } ?>