 <!--Browser Icon-->
 <link rel="icon" type="image/x-icon" href="images/Logos/ILAW_Logo.png">
 <?php
	include('database_connection.php');

	$active = "Categories";
	include('header.php');
	include('sidebar.php');
	?>
 <!--Content right-->
 <!--Main Content-->
 <div class="col-sm-9 col-xs-12 content pt-3 pl-0">
 	<nav aria-label="breadcrumb">
 		<ol class="breadcrumb">
 			<h5 class="pt-2"><strong>Categories</strong></h5>
 			<ul class="nav ml-auto add_product">
 				<li><a type="button" href="generate_reports/generate_categories_reports.php" class="btn btn-secondary p-2 text-white" data-toggle="tooltip" data-placement="bottom" title="Print Table"><i class="fa fa-print fa-lg"></i></a></li>
 				<li>
 					<div class="row" align="right">
 						<button type="button" name="add" id="add_button" data-toggle="modal" data-target="#categoryModal" class="btn btn-info mt-1 ml-4 mr-3 p-1"><i class="fa fa-plus-square"></i> Add New Category</button>
 					</div>
 				</li>
 			</ul>
 		</ol>
 	</nav>
 	<span id="alert_action"></span>
 	<div style="clear:both"></div>
 	<!--Datatable-->
 	<div class="mt-1 mb-3 p-3 button-container bg-white border shadow-sm">
 		<div class="table-responsive">
 			<table id="category_data" class="table table-bordered table-hover w-100 table-sm" cellspacing="0">
 				<thead>
 					<tr>
 						<th class="print_border  text-center"><b>CATEGORY NAME</b></th>
 						<th class="print_border  text-center"><b>STATUS</b></th>
 						<th class="print_border text-center"><b>AVAILABILITY</b></th>
 						<th class="print_border text-center"><b>ACTION</b></th>
 					</tr>
 				</thead>
 				
 			</table>
 		</div>
 		<!--/Datatable-->
 	</div>
 	<div id="categoryModal" class="modal fade">
 		<div class="modal-dialog">
 			<form method="post" id="category_form">
 				<div class="modal-content">
 					<div class="modal-header">
 						<h4 class="modal-title"><i class="fa fa-plus"></i> Add Category</h4>
 						<a type="button" data-dismiss="modal" aria-label="Close">
 							<span aria-hidden="true" class="h5 pt-3" style="cursor: pointer"><i class="fa fa-times fa-lg"></i></span></a>
 					</div>
 					<div class="modal-body">
 						<label><b>Enter Category Name:</b></label>
 						<input type="text" name="category_name" id="category_name" class="form-control" required />
 					</div>
 					<div class="modal-footer">
 						<input type="hidden" name="name" id="name" />
 						<input type="hidden" name="category_id" id="category_id" />
 						<input type="hidden" name="btn_action" id="btn_action" />
 						<input type="submit" name="action" id="action" class="btn btn-info" value="Add" />
 						<input type="reset" name="action" id="action" class="btn btn-danger" value="Clear" />
 					</div>
 				</div>
 			</form>
 		</div>
 	</div>
 	<!--End of Main Content-->

 	<?php
		include("footer.php")
		?>
 	<script>
 		// For Printing Table
 		function printData() {
 			var divToPrint = document.getElementById("category_data");
 			newWin = window.open("");
 			newWin.document.write('<style>.print_border{border: 1px black solid} .print_none{display:none} .table{border-collapse: collapse;} .table td {border: 1px black solid}</style>');
 			newWin.document.write('<title>ILAW Lighting and Equipment Trading</title>');
 			newWin.document.write('<center><h1>Category Printed Data<h1><center>');
 			newWin.document.write(divToPrint.outerHTML);
 			newWin.print();
 		}

 		$('.print_table').on('click', function() {
 			printData();
 		})
 		// End of Printing Table code

 		$(document).ready(function() {

 			$('#add_button').click(function() {
 				$('#category_form')[0].reset();
 				$('.modal-title').html("<i class='fa fa-plus'></i> Add Category");
 				$('#action').val('Add');
 				$('#btn_action').val('Add');
 			});

 			$(document).on('submit', '#category_form', function(event) {
 				event.preventDefault();
 				$('#action').attr('disabled', 'disabled');
 				var form_data = $(this).serialize();
 				$.ajax({
 					url: "category_action.php",
 					method: "POST",
 					data: form_data,
 					success: function(data) {
 						$('#category_form')[0].reset();
 						$('#categoryModal').modal('hide');
 						$('#alert_action').fadeIn().html('<div class="alert alert-success">' + data + '</div>');
 						$('#action').attr('disabled', false);
 						categorydataTable.ajax.reload();
 					}
 				})
 			});

 			$(document).on('click', '.update', function() {
 				var category_id = $(this).attr("id");
 				var btn_action = 'fetch_single';
 				var name = $(this).data("name");
 				$.ajax({
 					url: "category_action.php",
 					method: "POST",
 					data: {
 						category_id: category_id,
 						btn_action: btn_action
 					},
 					dataType: "json",
 					success: function(data) {
 						$('#categoryModal').modal('show');
 						$('#category_name').val(data.category_name);
 						$('.modal-title').html("<i class='fa fa-pencil-square-o'></i> Edit Category");
 						$('#category_id').val(category_id);
 						$('#name').val(name);
 						$('#action').val('Edit');
 						$('#btn_action').val("Edit");
 					}
 				})
 			});

 			var categorydataTable = $('#category_data').DataTable({
 				"processing": true,
 				"serverSide": true,
 				"order": [],
 				"ajax": {
 					url: "category_fetch.php",
 					type: "POST"
 				},
 				"columnDefs": [{
 					"targets": [0, 1, 2],
 					"orderable": false,
 				}, ],
 				"pageLength": 9999999
 			});
 			$(document).on('click', '.delete', function() {
 				var category_id = $(this).attr('id');
 				var status = $(this).data("status");
 				var btn_action = 'delete';
 				if (confirm("Are you sure you want to change status?")) {
 					$.ajax({
 						url: "category_action.php",
 						method: "POST",
 						data: {
 							category_id: category_id,
 							status: status,
 							btn_action: btn_action
 						},
 						success: function(data) {
 							$('#alert_action').fadeIn().html('<div class="alert alert-Secondary">' + data + '</div>');
 							categorydataTable.ajax.reload();
 						}
 					})
 				} else {
 					return false;
 				}
 			});
 		});
 	</script>
 	<script src="assets/js/jquery.dataTables.min.js"></script>
 	<script src="assets/js/dataTables.bootstrap4.min.js"></script>