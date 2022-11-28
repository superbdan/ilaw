 <!--Browser Icon-->
 <link rel="icon" type="image/x-icon" href="../images/Logos/ILAW_Logo.png">
 <?php
    include('../database_connection.php');
    include('../../connection.php');
    $active = "Customers";
    include('header.php');
    include('sidebar.php');
    include('../../function.php');

    if (isset($_GET['id'])) {
        $transaction = $_GET['id'];
        $sql = "SELECT * FROM customer_order_product WHERE transaction_id = '$transaction' ";
        $result = $con->query($sql);
    } else echo '<script type="text/javascript">
    window.location.href = "../admin/staff/customers.php"
    </script>';

    $query = "SELECT * FROM customer_order INNER JOIN table_province ON customer_order.province = table_province.province_id
    INNER JOIN table_municipality ON customer_order.city = table_municipality.municipality_id
    INNER JOIN table_region ON customer_order.region = table_region.region_id
    WHERE transaction_id ='$transaction'";
    $result2 = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result2);
    if (mysqli_num_rows($result2) == 0) {
        echo '<script type="text/javascript">
        window.location.href = "../admin/staff/customers.php"
        </script>';
    } else {
        $courier = $row['courier'];
        $customer = $row['customer_id'];
    }
    ?>
 <!--Content right-->
 <!--Main Content-->

 <div class="col-sm-9 col-xs-12 content pt-3 pl-0">
     <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
             <h5 class="pt-2"><strong>Counter <i class="fa fa-shopping-cart"></i></strong></h5>
             <ul class="nav ml-auto add_product">
                 <li><a type="button" class="btn btn-info text-white  p-2 ml-1" data-toggle="tooltip" data-placement="bottom" title="Check Inventory" href="items.php"><i class="fa fa-archive fa-lg"></i></a></li>
                 <li><a type="button" class="btn btn-secondary text-white p-2 ml-1" data-toggle="tooltip" data-placement="bottom" title="Back to Customer List" href="customers.php"><i class="fa fa-mail-reply fa-lg"></i></a></li>

             </ul>
         </ol>

         <ol class="breadcrumb breadcrumb-arrow">
             <li class="breadcrumb-item" aria-current="page"><a href="customers.php">Customers</a></li>
             <li class="breadcrumb-item active" aria-current="page"><a>Counter</a></li>
             <li class="breadcrumb-item active" aria-current="page"><a><?php echo $transaction; ?></a></li>
         </ol>
         <span id="alert_action"></span>
         <div id="invoiceModal" class="modal fade">
             <div class="modal-dialog">
                 <form method="post" id="invoice_form">
                     <div class="modal-content" id="print">
                         <!--Invoice-->
                         <div class="p-3 button-container bg-white border shadow-sm">
                             <ul class="pt-1 d-flex justify-content-between">
                                 <li class="d-flex">
                                     <h3 class="m-2 mr-auto">Invoice Receipt</h3>
                                 </li>
                                 <button type="button" class="btn btn-secondary p-2 ml-1" data-toggle="tooltip" data-placement="bottom" title="Back" data-dismiss="modal"><i class="text-white fa fa-mail-reply fa-lg"></i></button>
                             </ul>
                             <div class="dropdown-divider"></div>

                             <div class="row mt-3 mb-4">
                                 <!--Address-->
                                 <div class="col-md-6 col-sm-6 col-6">
                                     <div class="invoice-from">
                                         <address>
                                             <p><small>Sent to</small></p> <strong><?php echo $row['email'] ?></strong>
                                             <p class="mt-1 mb-0"> <?php echo $row['address'] ?></p>
                                         </address>
                                     </div>
                                 </div>

                                 <div class="col-md-6 col-sm-6 col-6">
                                     <div class="invoice-to text-right">
                                         <address>
                                             <p><small>Recieved from</small></p>
                                             <strong>ILAW</strong>
                                             <p class="mt-1 mb-0">Phase 11 Block 14 Lot 48 Carmona Estates Brgy Lantic 4116 Carmona, Philippines</p>
                                         </address>
                                     </div>
                                 </div>
                             </div>
                             <!--/Address-->

                             <!--Invoice Order-->

                             <div class="table-responsive mt-5">
                                 <table class="table">
                                     <thead>
                                         <tr class="bg-secondary text-white">
                                             <th>Transaction ID</th>
                                             <th>Product Name</th>
                                             <th>Unit</th>
                                             <th>Quantity</th>
                                             <th>Price</th>
                                             <th>Total</th>
                                         </tr>
                                     </thead>
                                     <tbody>
                                         <?php
                                            while ($receiptrow = mysqli_fetch_array($result)) {
                                                echo '  
                                                 <tr>  
                                                        <td>' . $receiptrow["transaction_id"] . '</td>
                                                        <td>' . $receiptrow["product_name"] . '</td>  
                                                        <td>' . $receiptrow["unit"] . '</td> 
                                                        <td>' . $receiptrow["quantity"] . '</td>
                                                        <td>' . $receiptrow["price"] . '</td>
                                                        <td>' . $receiptrow["total"] . '</td>

                                                </tr> 
                                                ';
                                            }
                                            ?>
                                         <tr class="border-bottom">
                                         </tr>
                                     </tbody>
                                 </table>
                                 <div class="text-right mt-4 p-4">
                                     <p><strong>Sub - Total amount: <?php $query = "SELECT * FROM customer_order_product WHERE transaction_id = '$transaction' ";
                                                                    $totalRes = mysqli_query($con, $query);
                                                                    $qty = 0;
                                                                    $subtotal = 0;
                                                                    while ($totalrow = mysqli_fetch_assoc($totalRes)) {
                                                                        $subtotal += $totalrow['total'];
                                                                    }
                                                                    echo $subtotal ?></strong></p>
                                     <p><strong>Shipping: $1000.00</strong></p>
                                     <!-- <p><span>vat(10%): $150.00</span></p> -->
                                     <h4 class="mt-2"><strong>Total: $16,050.00</strong></h4>
                                 </div>

                                 <div class="dropdown-divider"></div>

                                 <div class="form-group text-right p-3">
                                     <button type="button" class="btn btn-success"><i class="fa fa-send"></i> Send invoice</button>
                                     <button type="button" class="btn btn-theme ml-1" id="print"> <i class="fa fa-print"></i> Print</button>
                                 </div>

                             </div>

                             <!--/Invoice Order-->
                         </div>
                         <!--/Invoice-->
                     </div>
                 </form>
             </div>
         </div>
         <div id="proof_modal" class="modal fade">
             <div class="modal-dialog">
                 <form method="post" id="proof_form">
                     <div class="modal-content">
                         <div class="p-3 button-container bg-white border shadow-sm">
                             <ul class="pt-1 d-flex justify-content-between">
                                 <li class="d-flex">
                                     <h3 class="m-2 mr-auto">Proof of Payment</h3>
                                 </li>
                                 <button type="button" class="btn btn-secondary p-2 ml-1" data-toggle="tooltip" data-placement="bottom" title="Back" data-dismiss="modal"><i class="text-white fa fa-mail-reply fa-lg"></i></button>
                             </ul>
                             <!-- Customer Proof of Payment -->
                             <div class="dropdown-divider mb-3"></div>
                             <div class="form-group p-2 border text-center" style="background: #f1f5f9;">
                                 <img src="../proof_of_payment/<?php echo $row['payment'] ?>" height="auto" width="100%" />
                             </div>
                             <div class="dropdown-divider"></div>
                             <div class="justify-content-around">
                                 <div class="text-center">
                                     <span class="badge badge-none text-dark ">Note: Check if the proof of payment is valid or not.</span>
                                     <span class="badge badge-none text-dark ">Check your bank account if you received the payment.</span>
                                 </div>
                             </div>

                         </div>
                 </form>
             </div>
         </div>

     </nav>

     <div style="clear:both"></div>
     <!-- Customer Details -->
     <div class="button-container" id="payment_container">
         <div class="row">
             <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                 <div class="mt-1 mb-1 p-3 bg-white border shadow-sm">
                     <h5 class="mt-2 text-center"><strong>Customer Information</strong></h5>
                     <hr>

                     <div class="d-flex justify-content-center">
                         <?php $query = "SELECT profile FROM customer_order LEFT JOIN user_details ON customer_order.customer_id =  user_details.user_id where customer_order.customer_id = '$customer' LIMIT 1;";
                            $img = mysqli_query($con, $query);
                            $rowimg = mysqli_fetch_assoc($img);
                            echo ' <img src="../../images/user-img/' . $rowimg['profile'] . '" height="125px" width="125px"/>' ?>

                         <br>
                         <button type="button" class="btn btn-warning ml-3" data-toggle="modal" data-target="#proof_modal"><img src="../images/Profiles/pop_icon.png" height="80px" width="80px" /><span class="badge badge-none text-dark ">Proof of Payment<br>(See Attachment)</span></button>
                     </div>
                     <div class="d-flex align-items-center justify-content-center mt-3">
                         <table class="mt-3">
                             <tr>
                                 <td><span>Customer Name: </span><span class="text-theme"><?php echo $row['customer_name'] ?></span></td>
                             </tr>
                             <tr>
                                 <td><span>Customer ID: </span><span class="text-theme"><?php echo $row['customer_id'] ?></span></td>
                             </tr>
                             <tr>
                                 <td><span>Contact #: </span><span class="text-theme"><?php echo $row['customer_no'] ?></span></td>
                             </tr>
                             <tr>
                                 <td><span>Full Address: </span><span class="text-theme"><?php echo $row['address'], ', ', $row['municipality_name'], ', ', $row['province_name'], ', ', $row['region_name'], ', ', $row['zip'] ?></span></td>
                             </tr>
                             <tr>
                                 <td><span>Courier Preffered: </span><span class="text-theme"><?php $query = "SELECT courier_name, courier_fee FROM couriers LEFT JOIN customer_order ON couriers.courier_id = customer_order.courier where couriers.courier_id ='$courier';";
                                                                                                $rescourier = mysqli_query($con, $query);
                                                                                                $rowcourier = mysqli_fetch_assoc($rescourier);
                                                                                                $courierfee = $rowcourier['courier_fee'];
                                                                                                echo $rowcourier['courier_name'] ?></span></td>
                             </tr>


                             <td><span>Mode of Payment: </span><span class="text-theme"><?php echo $row['payment_method'] ?></span></td>
                             <tr>
                                 <td><span>Customer Note: </span><span class="text-theme"><?php echo $row['customer_note'] ?></span></td>
                             </tr>
                         </table>
                     </div>
                 </div>
                 <center>
                     <input type="hidden" name="transaction_id" id="transaction_id" value="<?php echo $transaction ?>" />
                     <?php $query = "SELECT * FROM customer_order WHERE transaction_id = '$transaction'";
                        $get = mysqli_query($con, $query);
                        $status = mysqli_fetch_assoc($get);
                        if ($status['status'] == '1') {
                            echo '<button type="button" class="btn btn-info p-1 m-2 mr-3 text-center courier" name="courier"><i class="fa fa-truck fa-lg"></i> Send To Courier</button>';
                        } else {
                            echo '<button type="button" class="btn btn-success p-1 m-2 mr-3 text-center" name="courier"><i class="fa fa-truck fa-lg"></i> Successfully Sent to Courier</button>';
                        } ?>

                     <?php date_default_timezone_set('Asia/Manila'); ?>
                     <label class="btn btn-secondary p-1 m-2 text-center user-select-all"><?php echo date("M d, Y h:i a"); ?></label>
                     <input type="hidden" name="time" id="time" value="<?php echo date("M d, Y h:i a"); ?>">

             </div>
             <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                 <div class="mt-1 mb-1 p-3 bg-white border shadow-sm">
                     <h5 class="mt-2 text-center"><strong>Transaction Details</strong></h5>
                     <hr>
                     <ul class="list-group" id="payment_notice">
                         <li class="list-group-item d-flex justify-content-between align-items-center">
                             Payment Status:
                             <?php if ($row['payment_status'] == "pending") {
                                    echo '  <span class="badge badge-warning badge-pill font-weight-bold">Pending</span>';
                                } elseif ($row['payment_status'] == "validated") {
                                    echo '  <span class="badge badge-success badge-pill font-weight-bold">Validated</span>';
                                } elseif ($row['payment_status'] == "invalidated") {
                                    echo '  <span class="badge badge-danger badge-pill font-weight-bold">Invalidated</span>';
                                }
                                ?>
                         </li>
                         <li class="list-group-item d-flex justify-content-between align-items-center">
                             Transaction ID:
                             <span class="font-weight-bold"><?php echo $transaction; ?></span>
                         </li>
                         <li class="list-group-item d-flex justify-content-between align-items-center">
                             Purchased Item(s):
                             <span class="font-weight-bold"><?php $query = "SELECT * FROM customer_order_product WHERE transaction_id ='$transaction'";
                                                            $result2 = mysqli_query($con, $query);
                                                            $row1 = mysqli_num_rows($result2);
                                                            echo $row1 ?></span>

                         </li>
                         <li class="list-group-item d-flex justify-content-between align-items-center">
                             Shipping Total:
                             <span class="font-weight-bold">₱<?php echo $courierfee ?></span>
                         </li>
                         <h3>
                             <li class="list-group-item d-flex justify-content-between align-items-center font-weight-bold">
                                 Order Total:
                                 <span>₱<?php echo number_format($row['total_amount'], 2) ?></span>
                             </li>
                         </h3>


                     </ul>
                 </div>
             </div>

         </div>
     </div>
     <!--Datatable-->
     <div class="mt-1 mb-3 p-3 button-container bg-white border shadow-sm">
         <div class="table-responsive">
             <h5 class="mt-2 text-center"><strong>Products Ordered</strong></h5>
             <hr>
             <table id="order_data" class="table table-bordered table-hover w-100 table-sm">
                 <thead>
                     <tr>
                         <!-- <th>ID</th> -->
                         <th class="text-center"><b>TRANSACTION ID</b></th>
                         <th class="text-center"><b>PRODUCT NAME</b></th>
                         <th class="text-center"><b>UNIT</b></th>
                         <th class="text-center"><b>QUANTITY</b></th>
                         <th class="text-center"><b>PRICE</b></th>
                         <th class="text-center"><b>SUB-TOTAL</b></th>

                     </tr>
                 </thead>
                 <?php
                    $sql = "SELECT * FROM customer_order_product WHERE transaction_id = '$transaction' ";
                    $tblOrders = mysqli_query($con, $sql);
                    while ($row = mysqli_fetch_array($tblOrders)) {

                        echo '  
                            <tr>  
                                    <td>' . $row["transaction_id"] . '</td>
                                    <td>' . $row["product_name"] . '</td>  
                                    <td>' . $row["unit"] . '</td> 
                                    <td>' . $row["quantity"] . '</td>
                                    <td>₱' . number_format($row["price"], 2) . '</td>
                                    <td>₱' . number_format($row["total"], 2) . '</td>
                                            
                            </tr> 
                               ';
                    }
                    ?>
             </table>
         </div>
         <!--/Datatable-->
     </div>

     <!--End of Main Content-->
     <?php
        include("../footer.php")
        ?>




     <script>
         $(document).ready(function() {
             $('#print').click(function() {
                 window.print('#invoiceModal');
                 var prtContent = document.getElementById("print");
                 var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
                 WinPrint.document.write(prtContent.innerHTML);
                 WinPrint.document.close();
                 WinPrint.focus();
                 WinPrint.print();
             });

             $(document).on('click', '.courier', function() {
                 var transaction_id = $('#transaction_id').val();
                 var time = $('#time').val();
                 var btn_action = 'courier';
                 Swal.fire({
                     icon: 'question',
                     title: 'Move this order?',
                     showDenyButton: false,
                     showCancelButton: true,
                     confirmButtonText: 'Yes'
                 }).then((result) => {
                     /* Read more about isConfirmed, isDenied below */
                     if (result.isConfirmed) {
                         $.ajax({
                             url: 'counter_action.php',
                             method: "POST",
                             data: {
                                 transaction_id: transaction_id,
                                 time: time,
                                 btn_action: btn_action
                             },
                             success: function(data) {
                                 $('#proof_modal').modal('hide');
                                 $("#payment_container").load(location.href + " #payment_container");
                                 $('#alert_action').fadeIn().html(data)
                                 Swal.fire('Success.', 'Order is Transfered !', 'success')

                             }
                         })
                     }

                 });
             });

         });
     </script>
     <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
     <script src="assets/js/jquery.dataTables.min.js"></script>
     <script src="assets/js/dataTables.bootstrap4.min.js"></script>