 <!--Browser Icon-->
 <link rel="icon" type="image/x-icon" href="images/Logos/ILAW_Logo.png">
<?php
include('database_connection.php');

$active = "Customers";
include('header.php');
include('sidebar.php');
include('../function.php');
include('../connection.php');
$transaction = get_invoice_no($connect); ;
?>

<!--Content right-->
<!--Main Content-->
<div class="col-sm-9 col-xs-12 content pt-3 pl-0">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <h5 class="pt-2"><strong>Customers</strong></h5>
            <ul class="nav ml-auto add_product">
                <li><a type="button" href="generate_reports/generate_pending_customers_reports.php" class="btn btn-secondary p-2 text-white" data-toggle="tooltip" data-placement="bottom" title="Print Table"><i class="fa fa-print fa-lg"></i></a></li>
                <li>
                    <div class="row" align="right">
                        <!-- <a type="button" href="admin-ordering.php" target=”_blank” class="btn btn-info p-1 mr-3 text-white"><i  class="fa fa-plus-square" title="New Order"></i> Add New Order</a> -->
                        <button type="button" name="add" id="add_button" onclick="location.href='admin-ordering.php'" class="btn btn-info mt-1 ml-4 mr-3 p-1"><i class="fa fa-plus-square"></i> Add New Order</button>
                    </div>
                </li>
            </ul>
        </ol>
    </nav>
    <span id="alert_action"></span>
    <div style="clear:both"></div>
    <div class="button-container custom-tabs">
        <nav>
            <div class="nav nav-tabs nav-fill" id="nav-custom-2" role="tablist">
                <a class="nav-item nav-link active" id="nav-customers" href="customers.php" role="tab" aria-controls="nav-customers-2" aria-selected="true"><strong>Customers</strong></a>

                <a class="nav-item nav-link" id="nav-ship" href="customer-to-ship.php" role="tab" aria-controls="nav-ship-2" aria-selected="false"><strong>To Ship</strong></a>

                <a class="nav-item nav-link" id="nav-receive" href="customer-to-received.php" role="tab" aria-controls="nav-receive-2" aria-selected="false"><strong>To Receive</strong></a>

                <a class="nav-item nav-link" id="nav-complete" href="customer-completed.php" role="tab" aria-controls="nav-complete-2" aria-selected="false"><strong>Completed</strong></a>

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
                                <th class="print_border text-center"><b>ACTION</b></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <!--/Customers Datatable-->
        </div>
    </div>
    <!--End of Main Content-->
    <?php
    include("footer.php")
    ?>

    <script>
        // For Printing Table
        // function printData() {
        //     var divToPrint = document.getElementById("order_data");
        //     newWin = window.open("");
        //     newWin.document.write('<style>.print_border{border: 1px black solid} .print_none{display:none} .table{border-collapse: collapse;} .table td {border: 1px black solid}</style>');
        //     newWin.document.write('<title>ILAW Lighting and Equipment Trading</title>');
        //     newWin.document.write('<center><h1>Customers Printed Data<h1><center>');
        //     newWin.document.write(divToPrint.outerHTML);
        //     newWin.print();
        // }

        // $('.print_table').on('click', function() {
        //     printData();
        // })
        // End of Printing Table code

        // Main Function
        $(document).ready(function() {
//courier 
            // $("#courier").on('change', function() {
            //     var courier = $(this).val();
            //     $.ajax({
            //         method: "POST",
            //         url: "courier_amount.php",
            //         data: {
            //             courier: courier
            //         },
            //         dataType: "json",
            //         success: function(data) {
            //             $("#fee").val(data.courier_fee);
            //             var subtotal = 0;
            //             var fee = $('#fee').val();
            //             $('.total_cost').each(function() {
            //                 subtotal += parseFloat($(this).val());
            //             });
            //             var total = parseFloat(fee) + parseFloat(subtotal);
            //             if (!isNaN(total)) {
            //                 $('#subtotal').val(total);

            //             } else {
            //                 $('#subtotal').val(0);
            //             }
            //         }

            //     });
            // })

            var orderdataTable = $('#order_data').DataTable({
                "processing": true,
                "serverSide": true,
                "order": [],
                "ajax": {
                    url: "customer_fetch.php",
                    type: "POST"
                },
                "columnDefs": [{
                    "targets": [0, 1, 2, 3, 4, 5, 6],
                    "orderable": false,
                }, ],
                "pageLength": 9999999
            });
        });
    </script>

    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/dataTables.bootstrap4.min.js"></script>
