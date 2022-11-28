<?php
include('database_connection.php');
include('../connection.php');

if (isset($_GET['id'])) {
    $transaction = $_GET['id'];
    $sql = "SELECT * FROM customer_order_product WHERE transaction_id = '$transaction' ";
    $result = $con->query($sql);
} else  'connection failed';

$query = "SELECT * FROM customer_order
INNER JOIN table_municipality ON customer_order.city = table_municipality.municipality_id
INNER JOIN table_province ON customer_order.province = table_province.province_id
INNER JOIN table_region ON customer_order.region = table_region.region_id Where transaction_id ='$transaction'";
$result2 = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result2);
$courier = $row['courier'];
$customer = $row['customer_id']
?>




<!--Meta Responsive tag-->
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>ILAW</title>
<!--Browser Icon-->
<link rel="icon" type="image/x-icon" href="images/Logos/ILAW_Logo.png">
<!--Bootstrap CSS-->
<link rel="stylesheet" href="assets/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/css/dataTables.bootstrap4.min.css">
<!--Font Awesome-->
<link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
<link rel="stylesheet" href="assets/css/fontawesome.css">

<body style="background-color: #e9ecef">
    <div class="container mt-3">
        <form method="post">
            <div class="modal-content">
                <!--Invoice-->
                <div class="p-3 button-container bg-white border shadow-sm" id="print_invoice">
                    <h3><i class="fa fa-shopping-cart"></i></i> Invoice Receipt</h3>
                    <div class="dropdown-divider"></div>

                    <div class="row mt-3 mb-4">
                        <!--Address-->
                        <div class="col-md-6 col-sm-6 col-6">
                            <div class="invoice-from">
                                <address>
                                    <p><small>Sent to</small></p> <strong><?php echo $row['email'] ?></strong>
                                    <h5>
                                        <p class="mt-1 mb-0"> <?php echo $row['customer_name'] ?></p>
                                    </h5>
                                    <p class="mt-1 mb-0"> <?php echo $row['address'], ', ', $row['municipality_name'], ', ', $row['province_name'], ', ', $row['region_name'], ', ', $row['zip'] ?></p>
                                </address>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6 col-6">
                            <div class="invoice-to text-right">
                                <address>
                                    <p><small>Recieved from</small></p>
                                    <img src="../images/Logo/ILAW_Logo2.png" alt="ILAW Logo" width="40px" class="shadow">
                                    <p class="mt-1 mb-0">Phase 11 Block 14 Lot 48 Carmona Estates Brgy Lantic 4116
                                        <br>Carmona, Cavite, Philippines
                                    </p>
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
                                                        <td>₱' . number_format($receiptrow["price"], 2) . '</td>
                                                        <td>₱' . number_format($receiptrow["total"], 2) . '</td>

                                                </tr> 
                                                ';
                                }
                                ?>
                                <tr class="border-bottom">
                                </tr>
                            </tbody>
                        </table>
                        <div class="text-right mt-4 p-4">
                            <p><strong>Sub - Total Amount: ₱<?php $query = "SELECT * FROM customer_order_product WHERE transaction_id = '$transaction' ";
                                                            $totalRes = mysqli_query($con, $query);
                                                            $qty = 0;
                                                            $subtotal = 0;
                                                            while ($totalrow = mysqli_fetch_assoc($totalRes)) {
                                                                $subtotal += $totalrow['total'];
                                                            }
                                                            echo number_format(($subtotal), 2) ?></strong></p>
                            <p><strong><?php $query = "SELECT courier_name, courier_fee FROM couriers LEFT JOIN customer_order ON couriers.courier_id = customer_order.courier where couriers.courier_id ='$courier';";
                                        $rescourier = mysqli_query($con, $query);
                                        $rowcourier = mysqli_fetch_assoc($rescourier);
                                        $overall = $subtotal + $rowcourier['courier_fee'];
                                        echo 'Shipping Fee: ₱ ' . number_format($rowcourier['courier_fee'], 2); ?></strong></p>
                            <!-- <p><span>vat(10%): $150.00</span></p> -->
                            <h4 class="mt-2"><strong>Total: ₱<?php echo number_format(($overall), 2) ?></strong></h4>
                        </div>

                        <div class="dropdown-divider"></div>
                        <h5 class="text-center pt-2"> Thank you for purchasing! Have a great day.😊</h5>
                    </div>

                    <!--/Invoice Order-->
                </div>
                <!--/Invoice-->
            </div>
        </form>
    </div>
    </div>
    </form>
    </div>
</body>