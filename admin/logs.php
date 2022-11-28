 <!--Browser Icon-->
 <link rel="icon" type="image/x-icon" href="images/Logos/ILAW_Logo.png">
 <?php
	include('database_connection.php');

	$active = "Logs";
	include('header.php');
	include('sidebar.php');
	include('../connection.php');
	?>
 <style>
 	tfoot {
 		display: table-row-group;
 	}

 	tfoot input {
 		width: 100%;
 		padding: 3px;
 		box-sizing: border-box;
 	}
 </style>

 <!--Main Content-->
 <div class="col-sm-9 col-xs-12 content pt-3 pl-0">
 	<nav aria-label="breadcrumb">
 		<ol class="breadcrumb">
 			<h5 class="pt-2"><strong>Logs</strong></h5>
 			<ul class="nav ml-auto add_product">
			 	<li><a type="button" href="generate_reports/generate_logs_reports.php" class="btn btn-secondary p-2 text-white" data-toggle="tooltip" data-placement="bottom" title="Print Table"><i class="fa fa-print fa-lg"></i></a></li>
 				<li>
 					<div class="row" align="right">
 						<button type="button" name="add" id="delete" data-toggle="modal" class="btn btn-danger mt-1 ml-4 mr-3 p-1"><i class="fa fa-trash"></i> Clear Logs</button>
 					</div>
 				</li>
 			</ul>
 		</ol>
 	</nav>
 	<span id="alert_action"></span>
 	<div style="clear:both"></div>
 	<!--Datatable-->
 	<div class="mt-1 mb-3 p-3 button-container bg-white border shadow-sm" id="refresh">
 		<div class="table-responsive ">
 			<table id="example" class="table table-bordered table-hover w-100 table-sm">
 				<thead>
 					<tr>
 						<th class="print_border text-center"><b>DESCRIPTION</b></th>
 						<th class="print_border text-center"><b>INCHARGE</b></th>
 						<th class="print_border text-center"><b>DATE AND TIME</b></th>
 					</tr>
 				</thead>
 				<tfoot>
 					<tr>
 						<th class="print_none text-center"></th>
 						<th class="print_none text-center"></th>
 						<th class="print_none text-center"></th>
 					</tr>
 				</tfoot>
 				<?php
					$query = "SELECT action, user, DATE_FORMAT(t. timestamp,'%Y-%m-%d %r') AS date_field FROM logs AS t Order by  UNIX_TIMESTAMP(timestamp) DESC";
					$result = mysqli_query($con, $query);

					while ($row = mysqli_fetch_array($result)) {
						echo '  
                               <tr>  
                                    <td>' . $row["action"] . '</td>
                                    <td>' . $row["user"] . '</td> 
                                    <td>' . $row["date_field"] . '</td>       
                               </tr>  
                               ';
					}
					?>

 			</table>
 		</div>
 		<!--/Datatable-->
 	</div>
 	<?php
		include("footer.php")
		?>
 	<script>
 		// For Printing Table
		function printData()
		{
		var divToPrint=document.getElementById("example");
		newWin= window.open("");
		newWin.document.write('<style>.print_border{border: 1px black solid} .print_none{display:none} .table{border-collapse: collapse;} .table td {border: 1px black solid}</style>');
		newWin.document.write('<title>ILAW Lighting and Equipment Trading</title>');
		newWin.document.write('<center><h1>Logs Report Printed Data<h1><center>');
		newWin.document.write(divToPrint.outerHTML);
		newWin.print();
		}

		$('.print_table').on('click',function(){
		printData();
		})
		// End of Printing Table code


 		$(document).ready(function() {
 			$(document).on('click', '#delete', function() {
 				var remove = 'remove';
 				Swal.fire({
 					icon: 'warning',
 					title: 'Are you sure you want to Clear all logs ?',
 					showDenyButton: false,
 					showCancelButton: true,
 					confirmButtonText: 'Yes'
 				}).then((result) => {
 					/* Read more about isConfirmed, isDenied below */
 					if (result.isConfirmed) {
 						$.ajax({
 							url: "logs_action.php",
 							method: "POST",
 							data: {
 								remove: remove,

 							},

 							success: function(data) {
 								swal.fire({
 									icon: 'success',
 									title: 'Success.',
 									text: 'Logs Cleared Successfully !',
 									type: 'success'
 								}).then(function() {
 									location.reload();
 								});

 							}
 						})
 					}

 				});

 			});


 			// Setup - add a text input to each footer cell
 			$('#example tfoot th').each(function() {
 				var title = $(this).text();
 				$(this).html('<input type="text" placeholder="Search ' + title + '" />');
 			});

 			// DataTable
 			var table = $('#example').DataTable({
 				"order": [],
 				initComplete: function() {
 					// Apply the search
 					this.api()
 						.columns()
 						.every(function() {
 							var that = this;

 							$('input', this.footer()).on('keyup change clear', function() {
 								if (that.search() !== this.value) {
 									that.search(this.value).draw();
 								}
 							});
 						});
 				},
 			});





 		});
 	</script>
 	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 	<script src="assets/js/jquery.dataTables.min.js"></script>
 	<script src="assets/js/dataTables.bootstrap4.min.js"></script>