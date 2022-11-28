 <!--Browser Icon-->
 <link rel="icon" type="image/x-icon" href="images/Logos/ILAW_Logo.png">
<?php
include('database_connection.php');

$active = "Suppliers";
include('header.php');
include('sidebar.php');
?>
<!--Main Content-->
<div class="col-sm-9 col-xs-12 content pt-3 pl-0">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<h5 class="pt-2"><strong>Suppliers</strong></h5>
			<ul class="nav ml-auto add_product">
				<li><a type="button" id="printButton" href="generate_reports/generate_suppliers_reports.php" class="btn btn-secondary p-2 text-white" data-toggle="tooltip" data-placement="bottom" title="Print Table"><i class="fa fa-print fa-lg"></i></a></li>
				<li>
					<div class="row" align="right">
						<button type="button" name="add" id="add_button" data-toggle="modal" data-target="#supplierModal" class="btn btn-info mt-1 ml-4 mr-3 p-1"><i class="fa fa-plus-square"></i> Add New Supplier</button>
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
			<table id="supplier_data" class="table table-bordered table-hover w-100 table-sm">
				<thead>
					<tr>
						<th class="print_border text-center"><b>SUPPLIER LOGO</b></th>
						<th class="print_border text-center"><b>SUPPLIER NAME</b></th>
						<th class="print_border text-center"><b>CONTACT NO.</b></th>
						<th class="print_border text-center"><b>ADDRESS</b></th>
						<th class="print_border text-center"><b>AVAILABILITY</b></th>
						<th class="print_border text-center"><b>ACTIONS</b></th>
					</tr>
				</thead>
			</table>
		</div>
		<!--/Datatable-->
	</div>
	<div id="supplierModal" class="modal fade">
		<div class="modal-dialog">
			<form method="post" id="supplier_form">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title"><i class="fa fa-plus"></i> Add Supplier</h4>
						<a type="button" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true" class="h5 pt-3" style="cursor: pointer"><i class="fa fa-times fa-lg"></i></span></a>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>Supplier Name</label>
							<input type="text" name="supplier_name" id="supplier_name" class="form-control" required />
						</div>
						<div class="form-group">
							<label>Contact No</label>
							<input type="text" name="contact_no" id="contact_no" class="form-control" required />
						</div>
						<div class="form-group">
							<label>Address</label>
							<input type="text" name="address" id="address" class="form-control" required />
						</div>
						<div class="form-group">
							<label><b>Supplier Logo:</b></label>
							<input type="file" id="supplier_img" name="supplier_img" accept=".jpg, .png" class="form-control" style="cursor: pointer;" required>
						</div>
					</div>
					<div class="modal-footer">
						<input type="hidden" name="supplier_id" id="supplier_id" />
						<input type="hidden" name="btn_action" id="btn_action" />
						<input type="submit" name="action" id="action" class="btn btn-info" value="Add" />
						<input type="reset" name="action" id="action" class="btn btn-danger" value="Clear" />
					</div>

				</div>
			</form>
		</div>
	</div>
	<?php
	include("footer.php")
	?>
</div>

<script>
	// For Printing Table
	function printData() {
		var divToPrint = document.getElementById("supplier_data");
		newWin = window.open("");
		newWin.document.write('<style>.print_border{border: 1px black solid} .print_none{display:none} .table{border-collapse: collapse;} .table td {border: 1px black solid}</style>');
		newWin.document.write('<title>ILAW Lighting and Equipment Trading</title>');
		newWin.document.write('<center><h1>Suppliers Printed Data<h1><center>');
		newWin.document.write(divToPrint.outerHTML);
		newWin.print();
	}

	$('.print_table').on('click', function() {
		printData();
	})
	// End of Printing Table code

	// Main Function
	$(document).ready(function() {

		$('#add_button').click(function() {
			$('#supplierModal').modal('show');
			$('#supplier_form')[0].reset();
			$('.modal-title').html("<i class='fa fa-plus'></i> Add a Supplier");
			$('#action').val('Add');
			$('#btn_action').val('Add');
		});

		$(document).on('submit', '#supplier_form', function(event) {
			event.preventDefault();
			$('#action').attr('disabled', 'disabled');
			var form_data = $(this).serialize();
			$.ajax({
				url: "supplier_action.php",
				method: "POST",
				data: new FormData(this),
				processData: false,
				contentType: false,
				success: function(data) {
					$('#supplier_form')[0].reset();
					$('#supplierModal').modal('hide');
					$('#alert_action').fadeIn().html('<div class="alert alert-success">' + data + '</div>');
					$('#action').attr('disabled', false);
					supplierdataTable.ajax.reload();
				}
			})
		});

		$(document).on('click', '.update', function() {
			var supplier_id = $(this).attr("id");
			var btn_action = 'fetch_single';
			var tst = new DataTransfer();
			$.ajax({
				url: 'supplier_action.php',
				method: "POST",
				data: {
					supplier_id: supplier_id,
					btn_action: btn_action
				},
				dataType: "json",
				success: function(data) {
					$('#supplierModal').modal('show');
					$('#supplier_name').val(data.supplier_name);
					$('#contact_no').val(data.contact_no);
					$('#address').val(data.address);
					// $('#supplier_img').(data.address);
					$('.modal-title').html("<i class='fa fa-pencil-square-o'></i> Edit Suppliers");
					$('#supplier_id').val(supplier_id);
					$('#action').val('Edit');
					$('#btn_action').val('Edit');
					tst.items.add(new File(['test'], data.supplier_img));
                    supplier_img.files = tst.files;
				}
			})
		});


		
		$(document).on('click', '.change', function() {
				var supplier_id = $(this).attr('id');
				var status = $(this).data("status");
				var btn_action = 'change';
				if (confirm("Are you sure you want to change availability of this?")) {
					$.ajax({
						url: "supplier_action.php",
						method: "POST",
						data: {
							supplier_id: supplier_id,
							status: status,
							btn_action: btn_action
						},
						success: function(data) {
							$('#alert_action').fadeIn().html('<div class="alert alert-Secondary">' + data + '</div>');
							supplierdataTable.ajax.reload();
						}
					})
				} else {
					return false;
				}
			});



		var supplierdataTable = $('#supplier_data').DataTable({
			"processing": true,
			"serverSide": true,
			"order": [],
			"ajax": {
				url: "supplier_fetch.php",
				type: "POST"
			},
			"columnDefs": [{
					"targets": [0, 1, 2, 3],
					"orderable": false,
				},

			],

			"pageLength": 9999999
		});
	});
</script>

<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/dataTables.bootstrap4.min.js"></script>