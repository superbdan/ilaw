 <!--Browser Icon-->
 <link rel="icon" type="image/x-icon" href="../images/Logos/ILAW_Logo.png">
<?php
include('../database_connection.php');

$active = "Couriers";
include('header.php');
include('sidebar.php');
?>
<!--Main Content-->
<div class="col-sm-9 col-xs-12 content pt-3 pl-0">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <h5 class="pt-2" ><strong>Couriers</strong></h5>
                    <ul class="nav ml-auto add_product">
                        <li><a type="button" href="../generate_reports/generate_courier_reports.php" class="btn btn-secondary p-2 text-white" data-toggle="tooltip" data-placement="bottom" title="Print Table"><i class="fa fa-print fa-lg"></i></a></li>
                    </ul>
                </ol>
            </nav>
			<span id="alert_action"></span>
			<div style="clear:both"></div>
                     <!--Datatable-->
                    <div class="mt-1 mb-3 p-3 button-container bg-white border shadow-sm">
                        <div class="table-responsive">
                            <table id="courier_data" class="table table-bordered table-hover w-100 table-sm">
							<thead>
								<tr>
									<th class="print_border  text-center"><b>COURIER NAME</b></th>
									<th class="print_border text-center"><b>COURIER FEE</b></th>
									<th class="print_border  text-center"><b>CONTACT NO.</b></th>
									<th class="print_border  text-center"><b>ADDRESS</b></th>
								</tr>
							</thead>
                    		</table>
                    	</div>
					<!--/Datatable-->
            </div>
	<div id="courierModal" class="modal fade">
    	<div class="modal-dialog">
    		<form method="post" id="courier_form">
    			<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title"><i class="fa fa-plus"></i> Add Courier</h4>
    				</div>
    				<div class="modal-body">
					<div class="form-group">
							<label>Courier Name</label>
							<input type="text" name="courier_name" id="courier_name" class="form-control" required />
						</div>
    					<div class="form-group">
							<label>Contact No</label>
							<input type="text" name="contact_no" id="contact_no" class="form-control" required />
						</div>
						<div class="form-group">
							<label>Address</label>
							<input type="text" name="address" id="address" class="form-control" required />
						</div>
    				</div>
    				<div class="modal-footer">
    					<input type="hidden" name="courier_id" id="courier_id" />
    					<input type="hidden" name="btn_action" id="btn_action" />
    					<input type="submit" name="action" id="action" class="btn btn-info" value="Add" />
    					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    				</div>
    			</div>
    		</form>
    	</div>
    </div>
<?php
    include("../footer.php")
?>
</div>

<script>
// For Printing Table
function printData()
{
   var divToPrint=document.getElementById("courier_data");
   newWin= window.open("");
   newWin.document.write('<style>.print_border{border: 1px black solid} .print_none{display:none} .table{border-collapse: collapse;} .table td {border: 1px black solid}</style>');
   newWin.document.write('<title>ILAW Lighting and Equipment Trading</title>');
   newWin.document.write('<center><h1>Couriers Printed Data<h1><center>');
   newWin.document.write(divToPrint.outerHTML);
   newWin.print();
}

$('.print_table').on('click',function(){
printData();
})
// End of Printing Table code

//Main Function
$(document).ready(function(){

	$('#add_button').click(function(){
		$('#courierModal').modal('show');
		$('#courier_form')[0].reset();
		$('.modal-title').html("<i class='fa fa-plus'></i> Add a Courier");
		$('#action').val('Add');
		$('#btn_action').val('Add');
	});

	$(document).on('submit','#courier_form', function(event){
		event.preventDefault();
		$('#action').attr('disabled','disabled');
		var form_data = $(this).serialize();
		$.ajax({
			url:"../couriers_action.php",
			method:"POST",
			data:form_data,
			success:function(data)
			{
				$('#courier_form')[0].reset();
				$('#courierModal').modal('hide');
				$('#alert_action').fadeIn().html('<div class="alert alert-success">'+data+'</div>');
				$('#action').attr('disabled', false);
				courierdataTable.ajax.reload();
			}
		})
	});

	$(document).on('click', '.update', function(){
		var courier_id = $(this).attr("id");
		var btn_action = 'fetch_single';
		$.ajax({
			url:'../couriers_action.php',
			method:"POST",
			data:{courier_id:courier_id, btn_action:btn_action},
			dataType:"json",
			success:function(data)
			{
				$('#courierModal').modal('show');
				$('#courier_name').val(data.courier_name);
				$('#contact_no').val(data.contact_no);
				$('#address').val(data.address);
				$('.modal-title').html("<i class='fa fa-pencil-square-o'></i> Edit Courier");
				$('#courier_id').val(courier_id);
				$('#action').val('Edit');
				$('#btn_action').val('Edit');
			}
		})
	});

	$(document).on('click','.delete', function(){
		var courier_id = $(this).attr("id");
		var status  = $(this).data('status');
		var btn_action = 'delete';
		if(confirm("Are you sure you want to delete this courier?"))
		{
			$.ajax({
				url:"../couriers_action.php",
				method:"POST",
				data:{courier_id:courier_id, status:status, btn_action:btn_action},
				success:function(data)
				{
					$('#alert_action').fadeIn().html('<div class="alert alert-info">'+data+'</div>');
					courierdataTable.ajax.reload();
				}
			})
		}
		else
		{
			return false;
		}
	});


	var courierdataTable = $('#courier_data').DataTable({
		"processing":true,
		"serverSide":true,
		"order":[],
		"ajax":{
			url:"../couriers_fetch.php",
			type:"POST"
		},
		"columnDefs":[
			{
				"targets":[0,1,2],
				"orderable":false,
			},
		],
		"pageLength": 9999999
	});

});
</script>

<script src="../assets/js/jquery.dataTables.min.js"></script>
<script src="../assets/js/dataTables.bootstrap4.min.js"></script>