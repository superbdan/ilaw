 <!--Browser Icon-->
 <link rel="icon" type="image/x-icon" href="images/Logos/ILAW_Logo.png">
 <?php
    include('database_connection.php');

    $active = "Customers";
    include('header.php');
    include('sidebar.php');
    include('../function.php');
    include('../connection.php');
    $query = "SELECT * FROM customer_order INNER JOIN table_province ON customer_order.province = table_province.province_id
    INNER JOIN table_municipality ON customer_order.city = table_municipality.municipality_id
    INNER JOIN table_region ON customer_order.region = table_region.region_id
    where status = '3'";
    $result = mysqli_query($con, $query);
    ?>

 <!--Content right-->
 <!--Main Content-->
 <div class="col-sm-9 col-xs-12 content pt-3 pl-0">
     <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
             <h5 class="pt-2"><strong>Customers</strong></h5>
             <ul class="nav ml-auto add_product">
                 <li><a type="button" href="generate_reports/generate_completed_customers_reports.php" class="btn btn-secondary p-2 text-white" data-toggle="tooltip" data-placement="bottom" title="Print Table"><i class="fa fa-print fa-lg"></i></a></li>
             </ul>
         </ol>
     </nav>
     <span id="alert_action"></span>
     <div style="clear:both"></div>
     <div class="button-container custom-tabs">
         <nav>
             <div class="nav nav-tabs nav-fill" id="nav-custom-2" role="tablist">
                 <a class="nav-item nav-link" id="nav-customers" href="customers.php" role="tab" aria-controls="nav-customers-2" aria-selected="true"><strong>Customers</strong></a>

                 <a class="nav-item nav-link" id="nav-ship" href="customer-to-ship.php" role="tab" aria-controls="nav-ship-2" aria-selected="false"><strong>To Ship</strong></a>

                 <a class="nav-item nav-link" id="nav-receive" href="customer-to-received.php" role="tab" aria-controls="nav-receive-2" aria-selected="false"><strong>To Receive</strong></a>

                 <a class="nav-item nav-link active" id="nav-complete" href="customer-completed.php" role="tab" aria-controls="nav-complete-2" aria-selected="false"><strong>Complete</strong></a>

                 <a class="nav-item nav-link" id="nav-cancel" href="customer-cancelled.php" role="tab" aria-controls="nav-cancel-2" aria-selected="false"><strong>Cancelled</strong></a>
             </div>
         </nav>
         <!--Datatable-->
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
                             <th class="print_border text-center"><b>PRINT INVOICE</b></th>
                         </tr>
                     </thead>
                     <?php

                        while ($row = mysqli_fetch_array($result)) {
                            echo '  
                               <tr>  
                                    <td>' . $row["transaction_id"] . '</td>
                                    <td>' . $row["customer_id"] . '</td> 
                                    <td>' . $row["customer_name"] . '</td>      
                                    <td>' . $row["customer_no"] . '</td>  
                                    <td>' . $row["address"] . ' ' . $row['municipality_name'] . ' ' . $row['province_name'] . ' ' . $row['region_name'] . ' ' . $row['zip'] . '</td>
                                    <td><center><a href="printInvoice.php?id=' . $row['transaction_id'] . '"  target=”_blank” class="btn btn-primary p-2 mt-1" data-toggle="tooltip" data-placement="bottom" title="Print"><i class="fa fa-print fa-lg" style="color:white"></i></a></center></td> 
                               </tr>  
                               ';
                        }
                        ?>
                 </table>
             </div>
         </div>
     </div>
     <!--End of Main Content-->
     <?php
        include("footer.php")
        ?>
     <script>
         // For Printing Table
         //  function printData() {
         //      var divToPrint = document.getElementById("order_data");
         //      newWin = window.open("");
         //      newWin.document.write('<style>.print_border{border: 1px black solid} .print_none{display:none} .table{border-collapse: collapse;} .table td {border: 1px black solid}</style>');
         //      newWin.document.write('<title>ILAW Lighting and Equipment Trading</title>');
         //      newWin.document.write('<center><h1>Customers Printed Data(Completed)<h1><center>');
         //      newWin.document.write(divToPrint.outerHTML);
         //      newWin.print();
         //  }

         //  $('.print_table').on('click', function() {
         //      printData();
         //  })
         // End of Printing Table code
         $(document).ready(function() {
             $('#order_data').DataTable();
         });
     </script>
     <script src="assets/js/jquery.dataTables.min.js"></script>
     <script src="assets/js/dataTables.bootstrap4.min.js"></script>