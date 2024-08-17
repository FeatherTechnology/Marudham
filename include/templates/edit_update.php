<!-- Page header start -->
<br><br>
<div class="page-header">
	<div style="background-color:#009688; width:100%; padding:12px; color: #ffff; font-size: 20px; border-radius:5px;">
		Marudham - Update List
	</div>
</div><br>
<!-- Page header end -->

<!-- Main container start -->
<div class="main-container">
	<!-- Row start -->
	<div class="row gutters">
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
			<div class="table-container">

				<div class="table-responsive">
					<?php
					$mscid = 0;
					if (isset($_GET['msc'])) {
						$mscid = $_GET['msc'];
						if ($mscid == 1) { ?>
							<div class="alert alert-success" role="alert">
								<div class="alert-text">Customer Verfication Successful!</div>
							</div>
						<?php
						}
						if ($mscid == 2) { ?>
							<div class="alert alert-success" role="alert">
								<div class="alert-text">Verication Cancelled Successfully!</div>
							</div>
						<?php
						}
						if ($mscid == 3) { ?>
							<div class="alert alert-danger" role="alert">
								<div class="alert-text">Verfication Removed Successfully!</div>
							</div>
						<?php
						}
						if ($mscid == 4) { ?>
							<div class="alert alert-danger" role="alert">
								<div class="alert-text">Request Cancelled Successfully!</div>
							</div>
						<?php
						}
						if ($mscid == 8) { ?>
							<div class="alert alert-danger" role="alert">
								<div class="alert-text">Request Revoked Successfully!</div>
							</div>
					<?php
						}
					}
					?>
					<table id="update_table" class="table custom-table">
						<thead>
							<tr>
								<th width="50">S.No.</th>
								<th>Customer ID</th>
								<th>Customer Name</th>
								<th>Mobile</th>
								<th>Area</th>
								<th>Branch</th>
								<th>Line</th>
								<th>Group</th>
								<th>Document Status</th>
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


<!-- Customer Status Modal -->
<div class="modal fade customerstatus" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content" style="background-color: white">
			<div class="modal-header">
				<h5 class="modal-title" id="myLargeModalLabel">Customer Status</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closeModal()">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">

				<br />
				<div class="row">
					<div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12"></div>
					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
						<div class="form-group">
							<input type="hidden" name="req_id" id="req_id">
							<!-- <label class="label">Existing Type</label>
							<input type="text" name="exist_type" id="exist_type" class="form-control" readonly > -->
						</div>
					</div>
					<div class="col-xl-2 col-lg-2 col-md-6 col-sm-4 col-12"></div>
				</div>
				<div id="updatedcusHistoryTable">
					<table class="table custom-table" id="cusHistoryTable">
						<thead>
							<tr>
								<th width="25">S. No</th>
								<th>Date</th>
								<th>Loan Category</th>
								<th>Sub Category</th>
								<th>Amount</th>
								<th>Status</th>
								<th>Sub Status</th>
							</tr>
						</thead>
						<tbody>

						</tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeModal()">Close</button>
			</div>
		</div>
	</div>
</div>

<!-- Loan Summary Modal -->
<div class="modal fade loansummary" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content" style="background-color: white">
			<div class="modal-header">
				<h5 class="modal-title" id="myLargeModalLabel">Loan Summary</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closeLoanModal()">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">

				<br />
				<div class="row">
					<div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12"></div>
					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
						<div class="form-group">
							<input type="hidden" name="req_id" id="req_id">
							<!-- <label class="label">Existing Type</label>
							<input type="text" name="exist_type" id="exist_type" class="form-control" readonly > -->
						</div>
					</div>
					<div class="col-xl-2 col-lg-2 col-md-6 col-sm-4 col-12"></div>
				</div>
				<div id="updatedloanSummaryTable">
					<table class="table custom-table" id="loanSummaryTable">
						<thead>
							<tr>
								<th width="25">S. No</th>
								<th>Feedback Label</th>
								<th>Feedback Rating</th>
								<th>Remarks</th>
							</tr>
						</thead>
						<tbody>

						</tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeLoanModal()">Close</button>
			</div>
		</div>
	</div>
</div>