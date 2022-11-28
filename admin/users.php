 <!--Browser Icon-->
 <link rel="icon" type="image/x-icon" href="images/Logos/ILAW_Logo.png">
 <?php
	include('database_connection.php');
	include('../connection.php');
	$active = "Users";
	include('header.php');
	include('sidebar.php');
	include('../function.php');
	?>

 <!--Main Content-->
 <div class="col-sm-9 col-xs-12 content pt-3 pl-0">
 	<nav aria-label="breadcrumb">
 		<ol class="breadcrumb">
 			<h5 class="pt-2"><strong>User</strong></h5>
 			<ul class="nav ml-auto add_product">
 				<li><a type="button" href="generate_reports/generate_users_reports.php" class="btn btn-secondary p-2 text-white" data-toggle="tooltip" data-placement="bottom" title="Print Table"><i class="fa fa-print fa-lg"></i></a></li>
 				<li>
 					<div class="row" align="right">
 						<button type="button" name="role" id="role_button" data-toggle="modal" data-target="#roleModal" class="btn btn-primary mt-1 ml-4 mr-3 p-1"><i class="fa fa-info"></i> View Role Details</button>
 					</div>
 				</li>
 				<li>
 				<li>
 					<div class="row" align="right">
 						<button type="button" name="add" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-info mt-1 ml-4 mr-3 p-1"><i class="fa fa-plus-square"></i> Add New User</button>
 					</div>
 				</li>
 				</li>
 			</ul>
 		</ol>
 	</nav>
 	<span id="alert_action"></span>
 	<div style="clear:both"></div>
 	<!--Datatable-->
 	<div class="mt-1 mb-3 p-3 button-container bg-white border shadow-sm">
 		<div class="table-responsive">
 			<table id="users_data" class="table table-bordered table-hover w-100 table-sm">
 				<thead>
 					<tr>
 						<th class="print_border text-center"><b>CUSTOMERS ID</b></th>
 						<th class="print_border text-center"><b>NAME</b></th>
 						<th class="print_border text-center"><b>EMAIL</b></th>
 						<th class="print_border text-center"><b>CONTACT</b></th>
 						<th class="print_border text-center"><b>ADDRESS</b></th>
 						<th class="print_border text-center"><b>TYPE</b></th>
 						<th class="print_border text-center"><b>STATUS</b></th>
 						<th class="print_border text-center"><b>ACTIONS</b></th>
 					</tr>
 				</thead>
 			</table>
 		</div>
 		<!--/Datatable-->
 	</div>
 	<div id="userModal" class="modal fade">
 		<div class="modal-dialog modal-lg">
 			<form method="post" id="user_form">
 				<div class="modal-content">
 					<div class="modal-header">
 						<h4 class="modal-title"><i class="fa fa-plus"></i> Add User</h4>
 						<a type="button" data-dismiss="modal" aria-label="Close">
 							<span aria-hidden="true" class="h5 pt-3" style="cursor: pointer"><i class="fa fa-times fa-lg"></i></span></a>
 					</div>
 					<div class="modal-body">

 						<div class="form-group">
 							<div class="row">
 								<div class="col-md-4">
 									<div class="form-group">
 										<label><b>First Name</b></label>
 										<input type="text" name="first_name" id="first_name" class="form-control" placeholder="First Name" required />
 									</div>
 								</div>
 								<div class="col-md-4">
 									<div class="form-group">
 										<label><b>Middle Name</b></label>
 										<input type="text" name="middle_name" id="middle_name" class="form-control" placeholder="Middle Name" />
 									</div>
 								</div>
 								<div class="col-md-4">
 									<div class="form-group">
 										<label><b>Last Name</b></label>
 										<input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last Name" required />
 									</div>
 								</div>
 							</div>
 						</div>
 						<div class="form-group">
 							<label><b>Email</b></label>
 							<input type="email" name="email" id="email" class="form-control" required />
 						</div>
 						<div class="form-group">
 							<div class="row">
 								<div class="col-md-6">
 									<div class="form-group">
 										<label><b>Contact Number</b></label>
 										<input type="text" name="user_contact" id="user_contact" class="form-control" placeholder="Mobile Number" required />
 									</div>
 								</div>
 								<div class="col-md-6">
 									<div class="form-group">
 										<label><b>Zip Code</b></label>
 										<input type="text" name="zip_code" id="zip_code" class="form-control" placeholder="Last Name" required />
 									</div>
 								</div>
 							</div>
 						</div>
 						<div class="row">
 							<div class="col-md-4">
 								<div class="form-group">
 									<label><b>Region</b></label>
 									<select class="form-control" id="region" name="region" style="cursor: pointer;" required>
 										<option value="">--- Select Region ---</option>
 										<?php
											$query = mysqli_query($con, "select * from table_region");
											while ($row = mysqli_fetch_array($query)) {
											?>
 											<option value="<?php echo $row['region_id']; ?>"> <?php echo $row['region_name']; ?> </option>
 										<?php
											}
											?>
 									</select>
 								</div>
 							</div>
 							<div class="col-md-4">
 								<div class="form-group">
 									<label><b>Province</b></label>
 									<select class="form-control" id="province" name="province" style="cursor: pointer;" required>
 										<option value="">--- Select Province ---</option>
 									</select>
 								</div>
 							</div>
 							<div class="col-md-4">
 								<div class="form-group">
 									<label><b>City/ Municipality</b></label>
 									<select class="form-control" id="city" name="city" style="cursor: pointer;" required>
 										<option value="">--- Select City ---</option>
 									</select>
 								</div>
 							</div>
 						</div>
 						<div class="form-group">
 							<label><b>Home Address</b></label>
 							<input type="text" name="home_address" id="home_address" class="form-control" required />
 						</div>
 						<div class="form-group">
 							<label><b>Password</b></label>
 							<input type="password" name="user_password" id="user_password" class="form-control" required />
 							<label class="text-black mt-2 ml-2"><input type="checkbox" onclick="myFunction()"> Show Password</label>
 						</div>

 						<div class="form-group">
 							<label><b>Type</b></label>
 							<select type="text" name="user_type" id="user_type" class="form-control" required>
 								<option>--- Select Type ---</option>
 								<option value="master">Master</option>
 								<option value="staff">Staff</option>
 								<option value="user">User</option>
 							</select>
 						</div>
 						<div class="form-group">
 							<label><b>Status</b></label>
 							<select type="text" name="status" id="status" class="form-control" required>
 								<option>--- Select Status ---</option>
 								<option value="Active">Active</option>
 								<option value="Inactive">Inactive</option>
 							</select>
 						</div>
 					</div>
 					<div class="modal-footer">
 						<input type="hidden" name="user_id" id="user_id" />
 						<input type="hidden" name="btn_action" id="btn_action" />
 						<input type="submit" name="action" id="action" class="btn btn-info" value="Add" />
 						<input type="reset" name="action" id="action" class="btn btn-danger" value="Clear" />
 					</div>
 				</div>
 			</form>
 		</div>
 	</div>
 	<div id="roleModal" class="modal fade">
 		<div class="modal-dialog">
 			<form method="post" id="user_information">
 				<div class="modal-content">
 					<div class="modal-header">
 						<h5><i class="fa fa-info"></i> Role Details</h4>
 					</div>
 					<div class="modal-body">
 						<div class="form-group">

 							<label style="font-weight: bold;">Administrator</label>
 							<p style="text-align: justify;">&nbsp;&nbsp;&nbsp;&nbsp;it refers to the owner of the ILAW company, you will notice the "master" label in the user type as it was indicated for the admin. The overall system can access by the admin as they can operate or manage interfaces from e-commerce to inventory system.</p>
 						</div>
 						<div class="form-group">
 							<label style="font-weight: bold;">Staff</label>
 							<p style="text-align: justify;">&nbsp;&nbsp;&nbsp;&nbsp;it refers to the secondary manager of the inventory, you will notice the "staff" label in the user type as it was indicated for the staff users, they can receive valid customer orders, invoice receipt from stocks to check the physical stock room. The Admin only allows them to view the inventory status.</p>
 						</div>
 						<div class="form-group">
 							<label style="font-weight: bold;">Customer</label>
 							<p style="text-align: justify;">&nbsp;&nbsp;&nbsp;&nbsp;it refers to the inquiring customer and buyers from the e-commerce, you will notice the "user" label in the user type as it was indicated for the customers. They can register their account on ILAW Website to acquire quick ordering process. </p>
 						</div>
 						<div class="modal-footer">
 							<button type="button" class="btn btn-info" data-dismiss="modal">Got it!</button>
 						</div>
 					</div>
 				</div>
 			</form>
 		</div>
 	</div>
 	<!-- End of Main Content-->
 	<?php
		include("footer.php")
		?>
 	<script>
 		///Show Password
 		function myFunction() {
 			var x = document.getElementById("user_password");
 			if (x.type === "password") {
 				x.type = "text";
 			} else {
 				x.type = "password";
 			}
 		}

 		// Main Function
 		$(document).ready(function() {
 			$('#add_button').click(function() {
 				$('#userModal').modal('show');
 				$('#user_form')[0].reset();
 				$('.modal-title').html("<i class='fa fa-plus'></i> Add a User");
 				$('#action').val('Add');
 				$('#btn_action').val('Add');
 			});

 			$(document).on('submit', '#user_form', function(event) {
 				event.preventDefault();
 				$('#action').attr('disabled', 'disabled');
 				var form_data = $(this).serialize();
 				$.ajax({
 					url: "user_action.php",
 					method: "POST",
 					data: form_data,
 					success: function(data) {
 						$('#user_form')[0].reset();
 						$('#userModal').modal('hide');
 						$('#alert_action').fadeIn().html('<div class="alert alert-success">' + data + '</div>');
 						$('#action').attr('disabled', false);
 						userdataTable.ajax.reload();
 						// console.log("success");
 					},
 				})
 			});

 			// $(document).on('click', '.update', function() {
 			// 	var id = $(this).attr("id");
 			// 	var btn_action = 'fetch_single';
 			// 	$.ajax({
 			// 		url: "user_action.php",
 			// 		method: "POST",
 			// 		data: {
 			// 			id: id,
 			// 			btn_action: btn_action
 			// 		},
 			// 		dataType: "json",
 			// 		success: function(data) {

 			// 			$('#user_name').val(data.user_name);
 			// 			$('#user_email').val(data.user_email);
 			// 			$('#user_contact').val(data.user_contact);
 			// 			$('#user_address').val(data.user_address);
 			// 			$('#user_password').val(data.user_password);
 			// 			$('#user_type').val(data.user_type);
 			// 			$('#user_status').val(data.user_status);
 			// 			$('.modal-title').html("<i class='fa fa-pencil-square-o'></i> Edit User");
 			// 			$('#id').val(id);
 			// 			$('#action').val('Edit');
 			// 			$('#btn_action').val("Edit");
 			// 			$('#userModal').modal('show');
 			// 		}
 			// 	})
 			// });

 			$(document).on('click', '.update', function() {
 				var user_id = $(this).attr('id');
 				var status = $(this).data("status");
 				var btn_action = 'update';
 				if (confirm("Are you sure you want to change availability of this?")) {
 					$.ajax({
 						url: "user_action.php",
 						method: "POST",
 						data: {
 							user_id: user_id,
 							status: status,
 							btn_action: btn_action
 						},
 						success: function(data) {
 							$('#alert_action').fadeIn().html('<div class="alert alert-Secondary">' + data + '</div>');
 							userdataTable.ajax.reload();
 						}
 					})
 				} else {
 					return false;
 				}
 			});



 			var userdataTable = $('#users_data').DataTable({
 				"processing": true,
 				"serverSide": true,
 				"order": [],
 				"ajax": {
 					url: "user_fetch.php",
 					type: "POST"
 				},
 				"columnDefs": [{
 					"targets": [0, 1, 2, 3, 4, 5, 6],
 					"orderable": false,
 				}, ],
 				"pageLength": 9999999
 			});


 			$(document).on('click', '.delete', function() {
 				var id = $(this).attr("id");
 				var status = $(this).data('status');
 				var btn_action = 'delete';
 				if (confirm("Are you sure you want to delete this user?")) {
 					$.ajax({
 						url: "user_action.php",
 						method: "POST",
 						data: {
 							id: id,
 							status: status,
 							btn_action: btn_action
 						},
 						success: function(data) {
 							$('#alert_action').fadeIn().html('<div class="alert alert-info">' + data + '</div>');
 							userdataTable.ajax.reload();
 						}
 					})
 				} else {
 					return false;
 				}
 			});


 		});
 		//location

 		$(document).ready(function() {
 			$("#region").on('change', function() {
 				var regionId = $(this).val();
 				$.ajax({
 					method: "POST",
 					url: "../locajax.php",
 					data: {
 						regionId: regionId
 					},
 					dataType: "html",
 					success: function(data) {
 						$("#province").html(data);
 					}

 				});
 			})

 			$("#province").on('click', function() {
 				var provinceId = $(this).val();
 				$.ajax({
 					method: "POST",
 					url: "../locajax.php",
 					data: {
 						provinceId: provinceId
 					},
 					dataType: "html",
 					success: function(data) {
 						$("#city").html(data);
 					}

 				});
 			})

 			$("#province").on('change', function() {
 				var provinceId = $(this).val();
 				$.ajax({
 					method: "POST",
 					url: "../locajax.php",
 					data: {
 						provinceId: provinceId
 					},
 					dataType: "html",
 					success: function(data) {
 						$("#city").html(data);
 					}

 				});
 			})


 		});
 	</script>
 	<script src="assets/js/jquery.dataTables.min.js"></script>
 	<script src="assets/js/dataTables.bootstrap4.min.js"></script>