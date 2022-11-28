 <!--Browser Icon-->
 <link rel="icon" type="image/x-icon" href="../images/Logos/ILAW_Logo.png">

 <?php
    include('database_connection.php');
    date_default_timezone_set('Asia/Manila');
    $active = "Dashboard";
    include('header.php');
    include('sidebar.php');
    $now = new DateTime();
    ?>

 <!--Main Content-->
 <div class="col-sm-9 col-xs-12 content pt-3 pl-0">
     <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
             <h5 class="pt-2"><strong>Dashboard</strong></h5>
             <ul class="nav ml-auto add_product">
                 <li><a tabindex="0" class="btn btn-primary pb-1" role="button" data-toggle="popover" data-trigger="focus" title="Content Guide" data-content="The Dashboard serve as the summary review of the overall output of the table for easy monitoring."><i class="fa fa-info fa-lg"></i></a></li>
             </ul>
         </ol>
     </nav>
     <!--Dashboard Sales -->
     <div class="mt-1 mb-3 button-container">
         <div class="row pl-0">
             <!-- Dashboard Sales per Year -->
             <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-3">
                 <div class="bg-white border shadow">
                     <div class="p-2">
                         <ul class="income_sales">
                             <li>
                                 <h7 class="mt-2 text-theme"><small><strong>Sales This Year</strong></small>
                                     <h7>
                             </li>
                             <li class=" text-theme income_date">
                                 <h7><small><strong><?php echo $year = $now->format("Y"); ?></strong></small></h7>
                             </li>
                         </ul>
                         <?php
                            function yearly_output($connect)
                            {
                                $query = "
                                SELECT SUM(total_amount) as total FROM customer_order WHERE YEAR(date_created) = YEAR(CURRENT_DATE()) and status ='3'
                                ";
                                $statement = $connect->prepare($query);
                                $statement->execute();
                                $result = $statement->fetchAll();
                                foreach ($result as $row) {
                                    if ($row['total'] == "") {
                                        $output = '₱0';
                                    } else {
                                        $output = '₱' . $row['total'];
                                    }
                                }
                                return $output;
                            }
                            ?>
                         <h5 class="mt-4 text-center"><?php echo yearly_output($connect); ?></h5>


                         <center><label>Total Income</label></center>
                     </div>
                 </div>
             </div>
             <!-- End of Dashboard Sales per Year -->

             <!-- Dashboard Sales per Month -->
             <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-3">
                 <div class="bg-white border shadow">
                     <div class="p-2">
                         <ul class="income_sales">
                             <li>
                                 <h7 class="mt-2 text-theme"><small><strong>Sales This Month</strong></small>
                                     <h7>
                             </li>
                             <li class=" text-theme income_date">
                                 <h7><small><strong><?php echo $month = $now->format("M") ?></strong></small>
                                     <h7>
                             </li>
                         </ul>
                         <?php
                            function monthly_output($connect)
                            {
                                $query = "
                                SELECT SUM(total_amount) as total FROM customer_order WHERE MONTH(date_created) = MONTH(CURRENT_DATE()) and status ='3'
                                ";
                                $statement = $connect->prepare($query);
                                $statement->execute();
                                $result = $statement->fetchAll();
                                foreach ($result as $row) {
                                    if ($row['total'] == "") {
                                        $output = '₱0';
                                    } else {
                                        $output = '₱' . $row['total'];
                                    }
                                }
                                return $output;
                            }
                            ?>
                         <h5 class="mt-4 text-center"><?php echo monthly_output($connect); ?></h5>

                         <center><label>Total Income</label></center>
                     </div>
                 </div>
             </div>
             <!-- End Dashboard Sales per Month -->

             <!-- Dashboard Sales per Week -->
             <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-3">
                 <div class="bg-white border shadow">
                     <div class="p-2">
                         <ul class="income_sales">
                             <li>
                                 <h7 class="mt-2 text-theme"><small><strong>Sales This Week</strong></small>
                                     <h7>
                             </li>
                             <li class=" text-theme income_date">
                                 <h7><small><strong>W-<?php echo $week = $now->format("W") ?></strong></small>
                                     <h7>
                             </li>

                         </ul>
                         <?php
                            function weekly_output($connect)
                            {
                                $query = "
                                SELECT SUM(total_amount) as total
                                FROM  customer_order
                                WHERE  YEARWEEK(`date_created`, 1) = YEARWEEK(CURDATE(), 1) and status = '3'
                                ";
                                $statement = $connect->prepare($query);
                                $statement->execute();
                                $result = $statement->fetchAll();
                                foreach ($result as $row) {
                                    if ($row['total'] == "") {
                                        $output = '₱0';
                                    } else {
                                        $output = '₱' . $row['total'];
                                    }
                                }
                                return $output;
                            }
                            ?>
                         <h5 class="mt-4 text-center"><?php echo weekly_output($connect); ?></h5>

                         <center><label>Total Income</label></center>
                     </div>
                 </div>
             </div>
             <!-- End of Dashboard Sales per Week -->

             <!-- Dashboard Sales per Day -->
             <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-3">
                 <div class="bg-white border shadow">
                     <div class="p-2">
                         <ul class="income_sales">
                             <li>
                                 <h7 class="mt-2 text-theme"><small><strong>Sales This Day</strong></small>
                                     <h7>
                             </li>
                             <li class=" text-theme income_date">
                                 <h7><small><strong><?php echo $day = $now->format("d, D"); ?></strong></small>
                                     <h7>
                             </li>
                         </ul>
                         <?php
                            function daily_output($connect)
                            {
                                $query = "
                                SELECT SUM(total_amount) AS total FROM customer_order
                                LEFT JOIN order_tracking on customer_order.transaction_id = order_tracking.transaction_id
                                WHERE DAY(order_completed) = DAY(CURRENT_DATE()) and status ='3'
                            ";
                                $statement = $connect->prepare($query);
                                $statement->execute();
                                $result = $statement->fetchAll();
                                foreach ($result as $row) {
                                    if ($row['total'] == "") {
                                        $output = '₱0';
                                    } else {
                                        $output = '₱' . $row['total'];
                                    }
                                }
                                return $output;
                            }
                            ?>

                         <h5 class="mt-4 text-center"><?php echo daily_output($connect); ?></h5>

                         <center><label>Total Income</label></center>
                     </div>
                 </div>
             </div>
             <!-- End of Dashboard Sales per Day -->

         </div>
     </div>
     <!--Dashboard Sales -->

     <div class="mt-1 mb-3 button-container">
         <div class="row pl-0">
             <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-3">
                 <div class="bg-white border shadow">
                     <div class="media p-4">
                         <div class="align-self-center mr-3 rounded-circle notify-icon bg-dark-blue">
                             <i class="fa fa-users"></i>
                         </div>
                         <!-- Dashboard Pending Customer -->
                         <div class="media-body pl-2">
                             <?php
                                function pendcustCount($connect, $query)
                                {
                                    $statement = $connect->prepare($query);
                                    $statement->execute();
                                    return $statement->rowCount();
                                }
                                ?>
                             <h3 class="mt-0 mb-0 text-theme"><strong><?php echo pendcustCount($connect, "SELECT transaction_id FROM customer_order WHERE status = '0'"); ?></strong></h3>
                             <p><small class="bc-description text-theme">Pending Customers</small></p>
                         </div>
                         <!--End of Dashboard Pending Customer -->
                     </div>
                 </div>
             </div>

             <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-3">
                 <div class="bg-white border shadow">
                     <div class="media p-4">
                         <div class="align-self-center mr-3 rounded-circle notify-icon bg-dark-blue">
                             <i class="fa fa-users"></i>
                         </div>
                         <!-- Dashboard Completed Customer -->
                         <div class="media-body pl-2">
                             <?php
                                function custCount($connect, $query)
                                {
                                    $statement = $connect->prepare($query);
                                    $statement->execute();
                                    return $statement->rowCount();
                                }
                                ?>
                             <h3 class="mt-0 mb-0 text-theme"><strong><?php echo custCount($connect, "SELECT transaction_id FROM customer_order WHERE status = '3'"); ?></strong></h3>
                             <p><small class="bc-description text-theme">Completed Customers</small></p>
                         </div>
                         <!-- End of Dashboard Completed Customer -->

                     </div>
                 </div>
             </div>

             <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-3">
                 <div class="bg-dark-blue border shadow">
                     <div class="media p-4">
                         <div class="align-self-center mr-3 rounded-circle notify-icon bg-white">
                             <i class="fa fa-suitcase text-theme"></i>
                         </div>
                         <!-- Dashboard Total Products-->
                         <div class="media-body pl-2">

                             <?php
                                function rowCount($connect, $query)
                                {
                                    $statement = $connect->prepare($query);
                                    $statement->execute();
                                    return $statement->rowCount();
                                }
                                ?>
                             <h3 class="mt-0 mb-0 text-white"><strong><?php echo rowCount($connect, "SELECT items_id FROM items ORDER BY items_id"); ?></strong></h3>
                             <p><small class="bc-description text-white">Total Products</small></p>
                         </div>
                         <!-- Dashboard Total Products -->

                     </div>
                 </div>
             </div>

         </div>
     </div>

     <div class="mt-1 mb-3 button-container">
         <div class="row pl-0">
             <!--Sales Presenatation-->
             <div class="col-md-7">
                 <div class="mt-1 mb-3 p-3 button-container bg-white shadow-sm border">
                     <center>
                         <figure class="highcharts-figure">
                             <div id="container-1"></div>

                         </figure>
                     </center>
                 </div>
             </div>
             <!--/Sales Presentation-->
             <div class="col-md-5">
                 <!--Stock Status-->
                 <div class="mt-1 mb-3 p-3 button-container bg-white shadow-sm border">
                     <h6 class="mb-3">Stock Status</h6>
                     <hr>

                     <center>
                         <div id="donutChartEcharts" style="height: 370px; margin: 20px 0px 0px 0px"></div>
                     </center>
                 </div>
             </div>
         </div>
     </div>

     <div class="row mt-3">
         <div class="col-sm-12 col-md-6">
             <!--Highest Rating-->
             <div class="mt-1 mb-3 p-3 button-container bg-white shadow-sm border">
                 <div class="row justify-content-between ">
                     <h5 class="pt-1 pl-3">Fast Moving Products (Last 30 days)</h5>
                     <a type="button" id="printButton" href="../generate_reports/generate_fastmove_reports.php" class="btn btn-secondary p-2 mr-3 mb-1 text-white" data-toggle="tooltip" data-placement="bottom" title="Print Table"><i class="fa fa-print fa-lg"></i></a>
                 </div>

                 <div class="table-responsive">
                     <table class="table table-bordered table-hover w-100 table-sm display nowrap" id="fast_table">
                         <thead>
                             <tr>
                                 <th class="print_border4 text-center"><b>ITEM NAME</b></th>
                                 <th class="print_border4 text-center"><b>AVERAGE SALES</b></th>
                             </tr>
                         </thead>
                     </table>
                 </div>

             </div>
         </div>
         <!--/Highest RAting-->

         <div class="col-sm-12 col-md-6">
             <!--Region Dominate Report-->
             <div class="mt-1 mb-3 p-3 button-container bg-white shadow-sm border">
                 <div class="row justify-content-between ">
                     <h5 class="pt-1 pl-3">Slow Moving Products (Last 30 days)</h5>
                     <a type="button" id="printButton" href="../generate_reports/generate_slowmove_reports.php" class="btn btn-secondary p-2 mr-3 mb-1 text-white" data-toggle="tooltip" data-placement="bottom" title="Print Table"><i class="fa fa-print fa-lg"></i></a>
                 </div>

                 <div class="table-responsive">
                     <table class="table table-bordered table-hover w-100 table-sm display nowrap" id="slow_table">
                         <thead>
                             <tr>
                                 <th class="print_border4 text-center"><b>ITEM NAME</b></th>
                                 <th class="print_border4 text-center"><b>AVERAGE SALES</b></th>
                             </tr>
                         </thead>
                     </table>
                 </div>

             </div>
         </div>
     </div>

     <div class="row mt-3">
         <div class="col-sm-12 col-md-12">
             <div class="mt-1 mb-3 p-3 button-container bg-white shadow-sm border">
                 <center>
                     <figure class="highcharts-figure">
                         <div id="container-2"></div>
                     </figure>

                     <div class="row justify-content-between ">
                         <h5 class="pt-1 pl-3">Region Dominate Report</h5>
                         <a type="button" id="printButton" href="../generate_reports/generate_region_dominate_reports.php" class=" btn btn-secondary p-2 mr-3 ml-0 mb-1 text-white" data-toggle="tooltip" data-placement="bottom" title="Print Table"><i class="fa fa-print fa-lg"></i></a>
                     </div>

                     <div class="table-responsive">
                         <table class="table table-bordered table-hover w-100 table-sm display nowrap" id="region_table">
                             <thead>
                                 <tr>
                                     <th class="print_border2 text-center"><b>REGION</b></th>
                                     <th class="print_border2 text-center"><b>NUMBER OF CUSTOMERS</b></th>
                                 </tr>
                             </thead>
                         </table>
                     </div>
                     <!--/Region Dominate Report-->
                 </center>
             </div>
         </div>
     </div>

     <div class="col-md-12">
         <!--Highest Rating Report-->
         <div class="mt-1 mb-3 p-3 button-container bg-white shadow-sm border">
             <div class="row justify-content-between ">
                 <h5 class="pt-1 pl-3">Highest Rating Report</h5>
                 <a type="button" id="printButton" href="../generate_reports/generate_highest_rating_reports.php" class="btn btn-secondary p-2 mr-3 mb-1 text-white" data-toggle="tooltip" data-placement="bottom" title="Print Table"><i class="fa fa-print fa-lg"></i></a>
             </div>

             <div class="table-responsive">
                 <table class="table table-bordered table-hover w-100 table-sm display nowrap" id="review_table">
                     <thead>
                         <tr>
                             <th class="print_border text-center"><b>CUSTOMER ID</b></th>
                             <th class="print_border text-center"><b>CUSTOMER DETAILS</b></th>
                             <th class="print_border text-center"><b>RATE</b></th>
                         </tr>
                     </thead>
                 </table>
             </div>

         </div>
     </div>

     <div id="dataModal" class="modal fade">
         <div class="modal-dialog modal-lg">
             <div class="modal-content">
                 <div class="modal-header">
                     <h4 class="modal-title"><i class="fa fa-eye"></i> View Item</h4>
                 </div>
                 <div class="modal-body" id="sales_detail">
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                 </div>
             </div>
         </div>
     </div>
     <?php
        include("../footer.php")
        ?>
 </div>

 <!-- Page JavaScript Files-->
 <!--Popper JS-->
 <script src="../assets/js/popper.min.js"></script>
 <!--Bootstrap-->
 <script src="../assets/js/bootstrap.min.js"></script>
 <!--Sweet alert JS-->
 <script src="../assets/js/sweetalert.js"></script>
 <!--Progressbar JS-->
 <script src="../assets/js/progressbar.min.js"></script>
 <!--Flot.JS-->
 <script src="../assets/js/charts/jquery.flot.min.js"></script>
 <script src="../assets/js/charts/jquery.flot.pie.min.js"></script>
 <script src="../assets/js/charts/jquery.flot.categories.min.js"></script>
 <script src="../assets/js/charts/jquery.flot.stack.min.js"></script>
 <!--Sparkline-->
 <script src="../assets/js/charts/sparkline.min.js"></script>
 <!--Morris.JS-->
 <script src="../assets/js/charts/raphael.min.js"></script>
 <script src="../assets/js/charts/morris.js"></script>
 <!--Chart JS-->
 <script src="../assets/js/charts/chart.min.js"></script>
 <!--Echarts-->
 <script src="../assets/js/charts/echarts.min.js"></script>
 <script src="../assets/js/charts/echarts-data.js"></script>
 <!--Chartist JS-->
 <script src="../assets/js/charts/chartist.min.js"></script>
 <script src="../assets/js/charts/chartist-data.js"></script>
 <script src="../assets/js/charts/demo.js"></script>
 <script src="../assets/js/maps/jvector-maps.js"></script>
 <!--Bootstrap Calendar JS-->
 <script src="../assets/js/calendar/bootstrap_calendar.js"></script>
 <script src="../assets/js/calendar/demo.js"></script>
 <!-- HighCharts -->
 <script src="../assets/js/highcharts/highcharts.js"></script>
 <script src="../assets/js/highcharts/series-label.js"></script>
 <script src="../assets/js/highcharts/exporting.js"></script>
 <script src="../assets/js/highcharts/export-data.js"></script>
 <script src="../assets/js/highcharts/accessibility.js"></script>
 <script>
     Highcharts.chart('container-1', {
         chart: {
             type: 'spline'
         },
         title: {
             text: 'SALES TRANSACTION GRAPH '
         },
         subtitle: {
             text: ''
         },
         xAxis: [{
             categories: [<?php
                            $sql = "select date_format(date_created,'%Y') as year,sum(total_amount) as total, count(date_created) as orders
                      from customer_order
                      WHERE status = '3'
                      group by year(date_created)
                      order by year(date_created);";
                            $query = mysqli_query($con, $sql);

                            while ($row = mysqli_fetch_array($query)) {

                                $name = $row['year'];

                                $date = $row['total'];
                                echo "['" . $name . "'],";
                            } ?>],

         }],
         yAxis: {
             title: {
                 text: ''
             },

             labels: {
                 formatter: function() {
                     return Highcharts.numberFormat(this.value, 0);
                 }
             }
         },
         tooltip: {
             crosshairs: true,
             shared: true
         },

         series: [{
                 type: 'column',
                 name: 'Sales Graph',
                 color: '#154DA7',
                 data: [
                     <?php
                        $sql = "select date_format(date_created,'%Y') as year,sum(total_amount) as total, count(date_created) as orders
              from customer_order
              WHERE status = '3'
              group by year(date_created)
              order by year(date_created);";
                        $query = mysqli_query($con, $sql);

                        while ($row = mysqli_fetch_array($query)) {

                            $name = $row['year'];
                            $order = $row['orders'];

                            $date = $row['total'];
                            $concat = '₱' . $date;
                            echo "['" . $concat . "'," . $date . ",],";
                        } ?>


                 ],


             },
             //  {
             //    name: 'Internet Explorer',
             //    y: 11.84
             //  },
         ]
     });
 </script>


 <script>
     Highcharts.chart('container-2', {
         chart: {
             type: 'spline'
         },
         title: {
             text: 'REGION DOMINATE GRAPH '
         },
         subtitle: {
             text: ''
         },
         xAxis: [{
             categories: [<?php
                            $sql = "SELECT region_name, Count(region_name) as customer
                            FROM table_region
                            INNER JOIN customer_order ON customer_order.region = table_region.region_id
                            WHERE status = '3'
                            group by region_name";
                            $query = mysqli_query($con, $sql);

                            while ($row = mysqli_fetch_array($query)) {

                                // $name = $row['year'];

                                $region = $row['region_name'];
                                echo "['" . $region . "'],";
                            } ?>],

         }],
         yAxis: {
             title: {
                 text: ''
             },

             labels: {
                 formatter: function() {
                     return Highcharts.numberFormat(this.value, 0);
                 }
             }
         },
         tooltip: {
             crosshairs: true,
             shared: true
         },

         series: [{
                 type: 'column',
                 name: 'Customer Orders',
                 color: '#154DA7',
                 data: [
                     <?php
                        $sql = "SELECT region_name, Count(region_name) as customer
                        FROM table_region
                        INNER JOIN customer_order ON customer_order.region = table_region.region_id
                        WHERE status = '3'
                        group by region_name";
                        $query = mysqli_query($con, $sql);

                        while ($row = mysqli_fetch_array($query)) {

                            $region = $row['region_name'];
                            $productorder = $row['customer'];

                            // $date = $row['total'];
                            // $concat = '₱' . $date;
                            echo "['" . $region . "'," . $productorder . ",],";
                        } ?>


                 ],


             },
             //  {
             //    name: 'Internet Explorer',
             //    y: 11.84
             //  },
         ]
     });
 </script>

 <script>
     // For Printing Table
     function printData() {
         var divToPrint = document.getElementById("review_table");
         newWin = window.open("");
         newWin.document.write('<style>.print_border{border: 1px black solid} .print_none{display:none} .table{border-collapse: collapse;} .table td {border: 1px black solid}</style>');
         newWin.document.write('<title>ILAW Lighting and Equipment Trading</title>');
         newWin.document.write('<center><h1>Highest Rating Printed Data<h1><center>');
         newWin.document.write(divToPrint.outerHTML);
         newWin.print();
     }

     $('.print_table').on('click', function() {
         printData();
     })

     function printData2() {
         var divToPrint = document.getElementById("region_table");
         newWin = window.open("");
         newWin.document.write('<style>.print_border2{border: 1px black solid} .print_none2{display:none} .table{border-collapse: collapse;} .table td {border: 1px black solid}</style>');
         newWin.document.write('<title>ILAW Lighting and Equipment Trading</title>');
         newWin.document.write('<center><h1>Region Dominate Printed Data<h1><center>');
         newWin.document.write(divToPrint.outerHTML);
         newWin.print();
     }

     $('.print_table2').on('click', function() {
         printData2();
     })

     function printData3() {
         var divToPrint = document.getElementById("fast_table");
         newWin = window.open("");
         newWin.document.write('<style>.print_border3{border: 1px black solid} .print_none3{display:none} .table{border-collapse: collapse;} .table td {border: 1px black solid}</style>');
         newWin.document.write('<title>ILAW Lighting and Equipment Trading</title>');
         newWin.document.write('<center><h1>Fast Moving Products Printed Data<h1><center>');
         newWin.document.write(divToPrint.outerHTML);
         newWin.print();
     }

     $('.print_table3').on('click', function() {
         printData3();
     })

     function printData4() {
         var divToPrint = document.getElementById("slow_table");
         newWin = window.open("");
         newWin.document.write('<style>.print_border4{border: 1px black solid} .print_none4{display:none} .table{border-collapse: collapse;} .table td {border: 1px black solid}</style>');
         newWin.document.write('<title>ILAW Lighting and Equipment Trading</title>');
         newWin.document.write('<center><h1>Slow Moving Products Printed Data<h1><center>');
         newWin.document.write(divToPrint.outerHTML);
         newWin.print();
     }

     $('.print_table4').on('click', function() {
         printData4();
     })
     // End of Printing Table code


     $(document).ready(function() {
         $(document).on('click', '.user', function() {
             var user_id = $(this).attr("id");
             var btn_action = 'view_user';
             var review = $(this).data("id");
             $.ajax({
                 url: "dashboard_action.php",
                 method: "POST",
                 data: {
                     user_id: user_id,
                     btn_action: btn_action,
                     review: review
                 },
                 success: function(data) {
                     $('#sales_detail').html(data);
                     $('#dataModal').modal('show');
                     $('.modal-title').html("<i class='fa fa-user'></i> View Customer");

                 }
             });
         });


         var reviewdataTable = $('#review_table').DataTable({
             "bPaginate": false,
             "bLengthChange": false,
             //  "bFilter": true,
             //  "bInfo": false,
             "bAutoWidth": false,
             "searching": false,
             "processing": true,
             "serverSide": true,
             "info": false,
             "order": [],
             "ajax": {
                 url: "../rating_fetch.php",
                 type: "POST"
             },
             "columnDefs": [{
                 "targets": [0, 1, 2],
                 "orderable": false,
             }, ],
             "pageLength": 5
         });


         var regiondataTable = $('#region_table').DataTable({
             "bPaginate": false,
             "bLengthChange": false,
             //  "bFilter": true,
             //  "bInfo": false,
             "bAutoWidth": false,
             "searching": false,
             "processing": true,
             "serverSide": true,
             "info": false,
             "order": [],
             "ajax": {
                 url: "../region_market.php",
                 type: "POST"
             },
             "columnDefs": [{
                 "targets": [0, 1],
                 "orderable": false,
             }, ],
             "pageLength": 5
         });


         var fastdataTable = $('#fast_table').DataTable({
             "bPaginate": false,
             "bLengthChange": false,
             //  "bFilter": true,
             //  "bInfo": false,
             "bAutoWidth": false,
             "searching": false,
             "processing": true,
             "serverSide": true,
             "info": false,
             "order": [],
             "ajax": {
                 url: "../fast_moving.php",
                 type: "POST"
             },
             "columnDefs": [{
                 "targets": [0, 1],
                 "orderable": false,
             }, ],
             "pageLength": 5
         });


         var slowdataTable = $('#slow_table').DataTable({
             "bPaginate": false,
             "bLengthChange": false,
             //  "bFilter": true,
             //  "bInfo": false,
             "bAutoWidth": false,
             "searching": false,
             "processing": true,
             "serverSide": true,
             "info": false,
             "order": [],
             "ajax": {
                 url: "../slow_moving.php",
                 type: "POST"
             },
             "columnDefs": [{
                 "targets": [0, 1],
                 "orderable": false,
             }, ],
             "pageLength": 5
         });

     });

     // Donut Chart
     if ($("#donutChartEcharts").length) {
         <?php
            $query  = "SELECT 
            (SELECT Count(stock_status) FROM items where stock_status = 'Good') as Good, 
            (SELECT Count(stock_status) FROM items where stock_status = 'Critical') as Critical, 
            (SELECT Count(stock_status) FROM items where stock_status = 'Full') as Full,
            (SELECT Count(stock_status) FROM items where stock_status = 'Warning') as Warning
            from items group by stock_status
            LIMIT 1";
            $res    = mysqli_query($con, $query);
            $i = 0;
            $row = mysqli_fetch_assoc($res);
            $full = $row['Full'];
            $good = $row['Good'];
            $critical = $row['Critical'];
            $warning = $row['Warning'];



            ?>



         //  $critical = $resc;
         //  $full = "2";
         //  $good = "10";
         //  $warning = "2";

         var donutChart = echarts.init(document.getElementById('donutChartEcharts'));

         var donutOption = {
             tooltip: {
                 trigger: 'item',
                 formatter: "{a} <br/>{b}: {c} ({d}%)"
             },
             legend: {
                 orient: 'horizontal',
                 x: 'center',
                 data: ['Full', 'Good', 'Warning', 'Critical']

             },

             series: [{
                 name: 'Stock Status',
                 type: 'pie',
                 radius: ['50%', '70%'],
                 avoidLabelOverlap: false,
                 label: {
                     normal: {
                         show: false,
                         position: 'center'
                     },
                     emphasis: {
                         show: true,
                         textStyle: {
                             fontSize: '35',
                             fontWeight: 'bold'
                         }
                     }
                 },
                 labelLine: {
                     normal: {
                         show: false
                     }
                 },
                 data: [{
                         value: <?php echo $critical ?>,
                         name: 'Critical'
                     },
                     {
                         value: <?php echo $full ?>,
                         name: 'Full'
                     },
                     {
                         value: <?php echo $good ?>,
                         name: 'Good'
                     },
                     {
                         value: <?php echo $warning ?>,
                         name: 'Warning'
                     }
                 ]
             }, ],

             markArea: {
                 itemStyle: {
                     color: 'green',
                 }
             }

         };

         donutChart.setOption(donutOption);

     }
 </script>
 <script src="../assets/js/jquery.dataTables.min.js"></script>
 <script src="../assets/js/dataTables.bootstrap4.min.js"></script>