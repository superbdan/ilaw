 <!--Browser Icon-->
 <link rel="icon" type="image/x-icon" href="images/Logos/ILAW_Logo.png">
 <?php
include('database_connection.php');

$active = "Items";
include('header.php');
include('sidebar.php');
include('../function.php');

?>

<!--Main Content-->
<div class="col-sm-9 col-xs-12 content pt-3 pl-0">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <h5 class="pt-2" ><strong>Critical Products</strong></h5>
                    <ul class="nav ml-auto add_product">
                        <li><a type="button" class="print_table btn btn-secondary p-2" data-toggle="tooltip" data-placement="bottom" title="Print Table"><i class="fa fa-print fa-lg"></i></a></i></a></li>
                    </ul>
                </ol>

                <ol class="breadcrumb breadcrumb-arrow">
                    <li class="breadcrumb-item" aria-current="page"><a href="items.php">Items</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a>Critical Products</a></li>
                </ol>
            </nav>
            <span id="alert_action"></span>
			<div style="clear:both"></div>
                     <!--Datatable-->
                    <div class="mt-1 mb-3 p-3 button-container bg-white border shadow-sm">
                        <div class="table-responsive">
                            <table id="items_data" class="table table-bordered table-hover w-100 table-sm display nowrap">
								<thead>
									<tr>
									<th class="print_border text-center"><b>ITEM NAME</b></th>
									<th class="print_border text-center"><b>CATEGORY</b></th>
									<th class="print_border text-center"><b>COST</b></th>
									<th class="print_border text-center"><b>PRICE</b></th>
									<th class="print_border text-center"><b>IN-HOLD</b></th>
									<th class="print_border text-center"><b>SUPPLIER</b></th>
									<th class="print_border text-center"><b>UNIT</b></th>
									<th class="print_border text-center"><b>STATUS</b></th>
									<th class="print_border text-center"><b>ACTIONS</b></th>
									</tr>
								</thead>
                    		</table>
                    	</div>
					<!--/Datatable-->
            </div>
    <div id="itemsModal" class="modal fade">
    	<div class="modal-dialog modal-lg">
    		<form method="post" id="items_form">
    			<div class="modal-content">
    				<div class="modal-header">
						<h4 class="modal-title"><i class="fa fa-plus"></i> Add Items</h4>
						<a type="button" data-dismiss="modal" aria-label="Close">
	          		<span aria-hidden="true" class="h5 pt-3" style="cursor: pointer"><i class="fa fa-times fa-lg"></i></span></a>
    				</div>
    					<div class="modal-body">
							
							<div class="form-group">
							<label><b>Item Name:</b></label>
							<input type="text" name="items_name" id="items_name" class="form-control" required />
							
							<div class="form-group mt-4">
							<label><b>Item Description:</b></label>
							<textarea type="text" style="resize:none;" name="item_descript" id="item_descript" class="form-control" required></textarea>
							</div>

							<div class="row">
							<div class="col-sm-4">
								<div class="form-group">
                                <label><b>Category:</b></label>
                                <select style="cursor:pointer" name="category_id" id="category_id" class="form-control" required>
                                    <option value="">--- Select Category ---</option>
                                    <?php echo fill_category_list($connect);?>
                                </select>
								</div>
							</div>
							
							<div class="col-sm-4">
								<div class="form-group">
                                <label><b>Supplier:</b></label>
                                <select style="cursor:pointer"  name="supplier_id" id="supplier_id" class="form-control" required>
                                    <option value="">--- Select Supplier ---</option>
                                    <?php echo fill_suppliers_list($connect);?>
                                </select>
                            	</div>
							</div>
							
							<div class="col-sm-4">
								<div class="form-group">
                                <label><b>Unit of Measurement:</b></label>
                                <select style="cursor:pointer"  name="measurement_id" id="measurement_id" class="form-control" required>
                                    <option value="">--- Select Unit of Measurement ---</option>
                                    <?php echo fill_measurement_list($connect);?>
                                </select>
                            	</div>
							</div>
							</div>

							<div class="row">
							<div class="col-sm-3">
								<div class="form-group">
								<label><b>In Stocks:</b></label>
								<input type="number" name="items_stocks" id="items_stocks" class="form-control" required />
							</div>
							</div>

							<div class="col-sm-3">
								<div class="form-group">
								<label><b>Low Stock:</b></label>
								<input type="number" name="items_low" id="items_low" class="form-control" required/>
							</div>
							</div>

							<div class="col-sm-3">
								<div class="form-group">
								<label><b>Cost:</b></label>
								<input type="number" name="items_cost" id="items_cost" class="form-control" required />
								</div>
							</div>

							<div class="col-sm-3">
    							<div class="form-group">
								<label><b>Selling Price:</b></label>
								<input type="number" name="items_price" id="items_price" class="form-control" required />
								</div>
							</div>
							</div>

							<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
								<label><b>1st Product Image:</b></label>
								<input type="file" id="product_img1" name="product_img1" accept= ".jpg, .png" class="form-control" style="cursor: pointer;" required>
								</div>
								<img src="../admin/product_images/default-avatar.jpg" width="0" id="img1_db" class="fade"/> 
							</div>
							<div class="col-sm-6">
								<div class="form-group">
								<label><b>2nd Product Image:</b></label>
								<input type="file" id="product_img2" name="product_img2" accept= ".jpg, .png" class="form-control" style="cursor: pointer;" required>
								</div>
								<img src="../admin/product_images/default-avatar.jpg" width="0" id="img2_db" class="fade"/>
							</div>
							</div>
							</div>

						</div>
    				
    				<div class="modal-footer">
    					<input type="hidden" name="items_id" id="items_id"/>
    					<input type="hidden" name="btn_action" id="btn_action"/>
    					<input type="submit" name="action" id="action" class="btn btn-info" value="Add" />
    					<input type="reset" name="action" id="action" class="btn btn-danger" value="Clear" />
    				</div>
					
    			</div>
    		</form>
    	</div>
    </div>

	<div id="stockModal" class="modal fade">
    	<div class="modal-dialog">
    		<form method="post" id="items_form">
    			<div class="modal-content">
    				<div class="modal-header">
						<h4 class="modal-title"><i class="fa fa-plus"></i> Add Stock</h4>
						<a type="button" data-dismiss="modal" aria-label="Close">
	          		<span aria-hidden="true" class="h5 pt-3" style="cursor: pointer"><i class="fa fa-times fa-lg"></i></span></a>
    				</div>
    					<div class="modal-body">
						
							<div class="form-group">
                                <label><b>Item Name:</b></label>
                                <select style="cursor:pointer"  name="supplier_id" id="supplier_id" class="form-control" required>
                                    <option value="">--- Select Item Name ---</option>
                                    <?php /*echo fill_suppliers_list($connect);*/?>
                                </select>
                            </div>
							<div class="form-group">
                                <label><b>Item Model:</b></label>
                                <select style="cursor:pointer"  name="measurement_id" id="measurement_id" class="form-control" required>
                                    <option value="">--- Select Item Model ---</option>
                                    <?php /*echo fill_measurement_list($connect);*/?>
                                </select>
                            </div>
							
							<div class="form-group">
							<label><b>In Stocks:</b></label>
							<input type="number" step="0.01" name="items_stocks" id="items_stocks" class="form-control" required />
							</div>
							<div class="form-group">
							<label><b>Low Stock:</b></label>
							<input type="number" step="0.01" name="items_low" id="items_low" class="form-control" required />
							</div>

							<div class="form-group">
							<label><b>Cost:</b></label>
							<input type="number" step="0.01" name="items_cost" id="items_cost" class="form-control" required />
							</div>
    						<div class="form-group">
							<label><b>Selling Price:</b></label>
							<input type="number" step="0.01" name="items_price" id="items_price" class="form-control" required />
							</div>

						</div>
    				
    				<div class="modal-footer">
    					<input type="hidden" name="items_id" id="items_id"/>
    					<input type="hidden" name="btn_action" id="btn_action"/>
    					<input type="submit" name="action" id="action" class="btn btn-info" value="Add" />
    					<input type="reset" name="action" id="action" class="btn btn-danger" value="Clear" />
    				</div>
					
    			</div>
    		</form>
    	</div>
    </div>

	<div id="dataModal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <h4 class="modal-title"><i class="fa fa-eye"></i> View Item</h4>  
                </div>  
                <div class="modal-body" id="items_detail">  
                </div>  
                <div class="modal-footer">  
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                </div>  
           </div>  
      </div>

 </div> 
 
<!-- End of Main Content-->
<?php
    include("footer.php")
?>

<script>
// For Printing Table
function printData()
{
   var divToPrint=document.getElementById("items_data");
   newWin= window.open("");
   newWin.document.write('<style>.print_border{border: 1px black solid} .print_none{display:none} .table{border-collapse: collapse;} .table td {border: 1px black solid}</style>');
   newWin.document.write('<title>ILAW Lighting and Equipment Trading</title>');
   newWin.document.write('<center><h1>Critical Items Printed Data<h1><center>');
   newWin.document.write(divToPrint.outerHTML);
   newWin.print();
}

$('.print_table').on('click',function(){
printData();
})
// End of Printing Table code

// Main Function
$(document).ready(function(){

	$('#add_button').click(function(){
		$('#items_form')[0].reset();
		$('.modal-title').html("<i class='fa fa-plus'></i> Add Items");
		$('#action').val('Add');
		$('#btn_action').val('Add');
	});

	$(document).on('submit','#items_form', function(event){
		event.preventDefault();
		$('#action').attr('disabled','disabled');
		var form_data = $(this).serialize();
		$.ajax({
			url:"critical_action.php",
			method:"POST",
			data:new FormData(this),
			processData: false,
			contentType: false,
			success:function(data)
			{
				console.log(data)
				$('#items_form')[0].reset();
				$('#itemsModal').modal('hide');
				$('#alert_action').fadeIn().html('<div class="alert alert-success">'+data+'</div>');
				$('#action').attr('disabled', false);
				itemsdataTable.ajax.reload();
			}
		})
	});

	$(document).on('click', '.update', function(){
		var items_id = $(this).attr("id");
		var btn_action = 'fetch_single';
		$.ajax({
			url:"critical_action.php",
			method:"POST",
			data:{items_id:items_id, btn_action:btn_action},
			dataType:"json",
			success:function(data)
			{
				
				$('#items_name').val(data.items_name);
				$('#item_descript').val(data.item_descript);
				$('#category_id').val(data.category_id);
				$('#items_stocks').val(data.items_stocks);
				$('#supplier_id').val(data.supplier_id);
				$('#measurement_id').val(data.measurement_id);
				$('#items_cost').val(data.items_cost);
				$('#items_price').val(data.items_price);
				$('#items_low').val(data.items_low);
						$('#img1_db').attr("src", "../admin/product_images/"+data.product_img1);
				$('#img2_db').attr("src", "../admin/product_images/"+data.product_img2);
				$('.modal-title').html("<i class='fa fa-pencil-square-o'></i> Edit items");
				$('#items_id').val(items_id);
				$('#action').val('Edit');
				$('#btn_action').val("Edit");
				$('#itemsModal').modal('show');
			}
		})
	});

	var itemsdataTable = $('#items_data').DataTable({
		"processing":true,
		"serverSide":true,
		"order":[],
		"ajax":{
			url:"critical_fetch.php",
			type:"POST"
		},
		"columnDefs":[
			{
				"targets":[0, 1, 2, 3, 4, 5, 6, 7],
				"orderable":false,
			},
		],
		
		"pageLength": 9999999
	});
	$(document).on('click','.delete', function(){
		var items_id = $(this).attr("id");
		var status  = $(this).data('status');
		var btn_action = 'delete';
		if(confirm("Are you sure you want to delete this item?"))
		{
			$.ajax({
				url:"critical_action.php",
				method:"POST",
				data:{items_id:items_id, status:status, btn_action:btn_action},
				success:function(data)
				{
					$('#alert_action').fadeIn().html('<div class="alert alert-Danger">'+data+'</div>');
					itemsdataTable.ajax.reload();
				}
			})
		}
		else
		{
			return false;
		}
	});

	$(document).on('click', '.view_data', function(){  
           var items_id = $(this).attr("id");
		   var btn_action = 'fetch_single';  
           if(items_id != '')  
           {  
                $.ajax({  
                     url:"critical_action.php",  
                     method:"POST",  
                     data:{items_id:items_id},  
                     success:function(data){  
                          $('#items_detail').html(data);
						  $('#items_table').html('show');  
                          $('#dataModal').modal('show');  
						  $('#btn_action').val("view_data");
						  $('#items_name').val(data.items_name);
				$('#category_id').val(data.category_id);
				$('#items_stocks').val(data.items_stocks);
				$('#supplier_id').val(data.supplier_id);
				$('#measurement_id').val(data.measurement_id);
				$('#items_cost').val(data.items_cost);
				$('#items_price').val(data.items_price);
				$('#items_low').val(data.items_low);
				$('.modal-title').html("<i class='fa fa-pencil-square-o'></i> Edit Items");
				$('#items_id').val(items_id);
                     }  
                });  
           }            
      }); 

	  $(document).on('click', '.view', function(){  
           var items_id = $(this).attr("id"); 
		   $('#action').val('View');
		   var btn_action = 'View';
           if(items_id != '')  
           {  
                $.ajax({  
                     url:"critical_action.php",  
                     method:"POST",  
                     data:{items_id:items_id, btn_action:btn_action},  
                     success:function(data){  
                          $('#items_detail').html(data);  
                          $('#dataModal').modal('show'); 
						  $('#img1_db').attr("src", "../admin/product_images/"+data.product_img1);
						  $('#img2_db').attr("src", "../admin/product_images/"+data.product_img2); 
                     }  
                });  
           }        
      });   
});
</script>
<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/dataTables.bootstrap4.min.js"></script>
</div>
