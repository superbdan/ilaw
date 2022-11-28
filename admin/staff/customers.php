<!--Browser Icon-->
<link rel="icon" type="image/x-icon" href="../images/Logos/ILAW_Logo.png">
<?php
include('../database_connection.php');
$active = "Customers";
include('header.php');
include('sidebar.php');
include('../../function.php');

?>

<!--Content right-->
<!--Main Content-->
<div class="col-sm-9 col-xs-12 content pt-3 pl-0">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
                    <h5 class="pt-2" ><strong>Customers</strong></h5>
            <ul class="nav ml-auto add_product">
                <li><a type="button" href="../generate_reports/generate_pending_customers_reports.php" class="btn btn-secondary p-2 text-white" data-toggle="tooltip" data-placement="bottom" title="Print Table"><i class="fa fa-print fa-lg"></i></a></li>
            </ul>
        </ol>
    </nav>
    <span id="alert_action"></span>
    <div style="clear:both"></div>
    <div class="button-container custom-tabs">
    <nav>
        <div class="nav nav-tabs nav-fill" id="nav-custom-2" role="tablist">
        <a class="nav-item nav-link active" id="nav-customers"  href="customers.php" role="tab" aria-controls="nav-customers-2" aria-selected="true"><strong>Customers</strong></a>

        <a class="nav-item nav-link" id="nav-ship" href="customer-to-ship.php" role="tab" aria-controls="nav-ship-2" aria-selected="false"><strong>To Ship</strong></a>

        <a class="nav-item nav-link" id="nav-receive" href="customer-to-received.php" role="tab" aria-controls="nav-receive-2" aria-selected="false"><strong>To Receive</strong></a>

        <a class="nav-item nav-link" id="nav-complete" href="customer-completed.php" role="tab" aria-controls="nav-complete-2" aria-selected="false"><strong>Complete</strong></a>

        <a class="nav-item nav-link" id="nav-cancel" href="customer-cancelled.php" role="tab" aria-controls="nav-cancel-2" aria-selected="false"><strong>Canceled</strong></a> 
    </div>
    </nav>
        <div class="tab-pane fade show active" id="custom-customers-2" role="tabpanel" aria-labelledby="nav-customers-2">
    <!--Customers Datatable-->
    <div class="mt-1 mb-3 p-3 button-container bg-white border shadow-sm">
        <div class="table-responsive">
            <table id="order_data" class="table table-bordered table-hover w-100 table-sm">
            <thead>
                            <tr>
                                <!-- <th>ID</th> -->
                                <th class="print_border text-center"><b>TRANSACTION ID</b></th>
                                <th class="print_border text-center"><b>CUSTOMER ID</b></th>
                                <th class="print_border text-center"><b>CUSTOMER NAME</b></th>
                                <th class="print_border text-center"><b>CONTACT</b></th>
                                <th class="print_border text-center"><b>ADDRESS</b></th>
                                <th class="print_border text-center"><b>STATUS</b></th>
                            </tr>
                        </thead>
            </table>
        </div>
    </div>
    <!--/Customers Datatable-->
    </div>
    
    <div id="customerModal" class="modal fade">

        <div class="modal-dialog modal-lg">
            <form method="post" id="order_form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><i class="fa fa-plus"></i> Create Order</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label name="transaction_id"><b>Transaction ID:</b> <?php echo get_invoice_no($connect); ?></label>
                            <input type="hidden" name="transaction_id" value="<?php echo get_invoice_no($connect); ?>">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><b>Enter Receiver Name:</b></label>
                                    <input type="text" name="customer_name" id="customer_name" class="form-control" placeholder="Name" required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><b>Enter Customer ID:</b></label>
                                    <input type="text" name="customer_id" id="customer_id" class="form-control" placeholder="ID" required />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="mt-2"><b>Enter Product Details: </b> (Click the "+" button to add orders)</label>
                            <hr>
                            <span id="span_product_details"></span>
                            <hr>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><b>Enter Contact Number:</b></label>
                                    <input type="number" name="customer_no" id="customer_no" class="form-control" placeholder="11 Digit Number" required/>
                                </div>
                            </div>
                        
                        <div class="col-md-8">
                        <div class="form-group">
                            <label><b>Enter Receiver Address:</b></label>
                            <input name="order_address" style="resize:none;" id="order_address" class="form-control" placeholder="Enter Exact Address" height="10px" required></input>
                        </div>
                        </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">

                                <h2>Total:</h2>

                            </div>
                            <div class="col-md-5">
                                <input class="form-control subtotal" type='text' id='subtotal' name='subtotal' readonly />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="inventory_order_id" id="inventory_order_id" />
                        <input type="hidden" name="btn_action" id="btn_action" />
                        <input type="submit" name="action" id="action" class="btn btn-info" value="Add" />
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>
    <!--End of Main Content-->
    <?php
    include("../footer.php")
    ?>

    <script>
// For Printing Table
        function printData()
        {
        var divToPrint=document.getElementById("order_data");
        newWin= window.open("");
        newWin.document.write('<style>.print_border{border: 1px black solid} .print_none{display:none} .table{border-collapse: collapse;} .table td {border: 1px black solid}</style>');
        newWin.document.write('<title>ILAW Lighting and Equipment Trading</title>');
        newWin.document.write('<center><h1>Customers Printed Data<h1><center>');
        newWin.document.write(divToPrint.outerHTML);
        newWin.print();
        }

        $('.print_table').on('click',function(){
        printData();
        })
// End of Printing Table code

// Main Function
        $(document).ready(function() {
            var rowCount = 1;

            $('#add_button').click(function() {
                $('#orderModal').modal('show');
                $('#order_form')[0].reset();
                $('.modal-title').html("<i class='fa fa-plus'></i> Create Order");
                $('#action').val('Add');
                $('#btn_action').val('Add');
                $('#span_product_details').html('');
                add_product_row();
            });


            function add_product_row(count = '', ) {
                var html = '';
                rowCount++;
                html += '<span id="row' + count + '"><div class="row">';
                html += '<div class="col-md-3">';
                html += '<select name="product_name[]" style="cursor:pointer" id="product_name' + count + '" class=" form-control pvc"  required>';
                html += '<option value="">--- Select Product ---</option>';
                html += '<?php echo fill_product_list($connect); ?>';
                html += '</select><input type="hidden" name="hidden_product_name[]" id="hidden_product_name' + count + '" />';
                html += '</div>';
                html += '<div class="col-sm-2">';
                html += '<input type="text" name="unit[]"  class="form-control" placeholder="unit" required />';
                html += '</div>';
                html += '<div class="col-sm-2">';
                html += '<input class="form-control product_price" type="number" data-type="product_price" id="product_price_' + rowCount + '" min="1" placeholder="price" name="product_price[]" for="' + rowCount + '" required/>';
                html += '</div>';
                html += '<div class="col-sm-2">';
                html += '<input class="form-control quantity" type="number" id="quantity_' + rowCount + '" name="quantity[]" min="1" placeholder="quantity" for="' + rowCount + '" required/>';
                html += '</div>';
                html += '<div class="col-sm-2">';
                html += '<input class="form-control total_cost" type="text" id="total_cost_' + rowCount + '" placeholder="Sub Total" name="total_cost[]"  for="' + rowCount + '" readonly/>';
                html += '</div>';
                html += '<div class="col-sm-1">';
                if (count == '') {
                    html += '<button type="button" name="add_more" id="add_more" class="btn btn-success btn-xs mb-2">+</button>';
                } else {
                    html += '<button type="button" name="remove" id="' + count + '" class="btn btn-danger btn-xs mb-2 remove">-</button>';
                }
                html += '</div>';
                html += '</div></div></span>';
                $('#span_product_details').append(html);
                $('.selectpicker').selectpicker();
            }

            $("#order_form").on('input', 'input.quantity,input.product_price', function() {
                getTotalCost($(this).attr("for"));
            });

            function getTotalCost(ind) {
                var qty = $('#quantity_' + ind).val();
                var price = $('#product_price_' + ind).val();
                var totNumber = (qty * price);
                var tot = totNumber.toFixed(2);
                $('#total_cost_' + ind).val(tot);
                calculateSubTotal();
            }

            function calculateSubTotal() {
                var subtotal = 0;
                $('.total_cost').each(function() {
                    subtotal += parseFloat($(this).val());
                });
                $('#subtotal').val(subtotal);
            }
            var count = 0;
            $(document).on('click', '#add_more', function() {
                count = count + 1;
                add_product_row(count);

            });
            $(document).on('click', '.remove', function() {
                var row_no = $(this).attr("id");
                $('#row' + row_no).remove();
            });



            $(document).on('submit', '#order_form', function(event) {
                event.preventDefault();
                $('#action').attr('disabled', 'disabled');
                var form_data = $(this).serialize();

                $.ajax({
                    url: "../customer_action.php",
                    method: "POST",
                    data: form_data,
                    success: function(data) {
                        $('#order_form')[0].reset();
                        $('#customerModal').modal('hide');
                        $('#alert_action').fadeIn().html('<div class="alert alert-success">' + data + '</div>');
                        $('#action').attr('disabled', false);
                        orderdataTable.ajax.reload();
                        setTimeout(function() { // (2)
                            location.reload(); // then reload the page.(3)
                        }, 1000);
                    },
                })

            });

            var orderdataTable = $('#order_data').DataTable({
                "processing": true,
                "serverSide": true,
                "order": [],
                "ajax": {
                    url: "../customer_fetch.php",
                    type: "POST"
                },
                "columnDefs": [{
                    "targets": [0,1,2,3,4,5],
                    "orderable": false,
                }, ],
                "pageLength": 9999999
            });
        });
       
    </script>

    <script src="../assets/js/jquery.dataTables.min.js"></script>
    <script src="../assets/js/dataTables.bootstrap4.min.js"></script>
    <script src="../assets/js/jautocalc.js"></script>