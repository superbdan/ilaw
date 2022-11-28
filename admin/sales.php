 <!--Browser Icon-->
 <link rel="icon" type="image/x-icon" href="images/Logos/ILAW_Logo.png">
 <?php
  include('database_connection.php');
  include('../connection.php');
  $active = "Sales";
  include('header.php');
  include('sidebar.php');
  error_reporting(0);

  ?>
 <!--Main Content-->
 <div class="col-sm-9 col-xs-12 content pt-3 pl-0">
   <nav aria-label="breadcrumb">
     <ol class="breadcrumb">
       <h5 class="pt-2"><strong>Sales</strong></h5>

     </ol>
   </nav>
   <center>
     <div class="section-body">
       <div class="row">
         <div class="col-12">
           <div class="card">
             <div class="card-body">

               <figure class="highcharts-figure">
                 <div id="container-1"></div>

               </figure>
             </div>
           </div>
         </div>
   </center>
   <br>
   <div class="col-12">
     <div class="card">
       <div class="card-header">
         <div class="row justify-content-between p-2">
           <h5 class="pt-1">Sales Transaction</h5>
           <a type="button" id="printButton"  href="generate_reports/generate_sales_reports.php" class="print_table btn btn-secondary p-2 text-white" data-toggle="tooltip" data-placement="bottom" title="Print Table"><i class="fa fa-print fa-lg"></i></a>
         </div>
       </div>
       <div class="card-body">

         <div class="table-responsive">
           <table class="table table-striped table-bordered w-100 table-sm" id="sales_data">
             <thead>
               <tr>
                 <th class="print_border text-center"><b>TRANSACTION ID</b></th>
                 <th class="print_border text-center"><b>CUSTOMER DETAILS</b></th>
                 <th class="print_border text-center"><b>PURCHASED ITEM(S)</b></th>
                 <th class="print_border text-center"><b>TOTAL EXPENSES</b></th>
                 <th class="print_border text-center"><b>STATUS</b></th>
                 <th class="print_border text-center"><b>DATE AND TIME</b></th>
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
      include("footer.php")
      ?>
   </div>

   <!-- HighCharts -->
   <script src="assets/js/highcharts/highcharts.js"></script>
   <script src="assets/js/highcharts/series-label.js"></script>
   <script src="assets/js/highcharts/exporting.js"></script>
   <script src="assets/js/highcharts/export-data.js"></script>
   <script src="assets/js/highcharts/accessibility.js"></script>
   <!-- Order Report -->

   <script>
     // For Printing Table
    //  function printData() {
    //    var divToPrint = document.getElementById("sales_data");
    //    newWin = window.open("");
    //    newWin.document.write('<style>.print_border{border: 1px black solid} .print_none{display:none} .table{border-collapse: collapse;} .table td {border: 1px black solid}</style>');
    //    newWin.document.write('<title>ILAW Lighting and Equipment Trading</title>');
    //    newWin.document.write('<center><h1>Sales Transaction Printed Data<h1><center>');
    //    newWin.document.write(divToPrint.outerHTML);
    //    newWin.print();
    //  }

    //  $('.print_table').on('click', function() {
    //    printData();
    //  })
   </script>

   <script>
     Highcharts.chart('container-1', {
       chart: {
         type: 'spline'
       },
       title: {
         text: 'SALES TRANSACTION GRAPH ' + <?php echo date('Y'); ?>
       },
       subtitle: {
         text: 'Source: Ilaw Database'
       },
       xAxis: [{

         categories: [
           <?php
            $sql =  "select status,product_name, count(product_name) as purchases
            from customer_order_product
            left join customer_order on customer_order_product.transaction_id = customer_order.transaction_id
            WHERE status = '3'
            group by product_name";
            $query = mysqli_query($con, $sql);

            while ($row = mysqli_fetch_array($query)) {

              $product = $row['product_name'];
              echo "['" . $product . "'],";
            } ?>



         ],

         crosshair: true

       }, {
         categories: [<?php
                      $sql = "select date_format(date_created,'%M %Y') as month,sum(total_amount) as total
         from customer_order
         WHERE status = '3'
         group by year(date_created),month(date_created)
         order by year(date_created),month(date_created);";
                      $query = mysqli_query($con, $sql);

                      while ($row = mysqli_fetch_array($query)) {

                        $name = $row['month'];

                        $date = $row['total'];
                        echo "['" . $name . "'],";
                      } ?>],
              
       }],
       yAxis: {
         title: {
           text: 'Sales Transactions'
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
           type: 'line',
           name: 'Sales Graph',
           color: '#FFA500',
           xAxis: 1,
           data: [
             <?php
              $sql = "select date_format(date_created,'%M') as month,sum(total_amount) as total, count(date_created) as orders
         from customer_order
         WHERE status = '3'
         group by year(date_created),month(date_created)
         order by year(date_created),month(date_created);";
              $query = mysqli_query($con, $sql);

              while ($row = mysqli_fetch_array($query)) {

                $name = $row['month'];
                $order = $row['orders'];

                $date = $row['total'];
                $concat = '₱' . $date;
                echo "['" . $concat . "'," . $date . ",],";
              } ?>


           ],


         }, {
           type: 'column',
           name: 'Product Orders',
           color: '#6495ED',
           data: [<?php
                  $sql = "select status,product_name, count(product_name) as purchases
              from customer_order_product
              left join customer_order on customer_order_product.transaction_id = customer_order.transaction_id
              WHERE status = '3'
              group by product_name";
                  $query = mysqli_query($con, $sql);

                  while ($row = mysqli_fetch_array($query)) {

                    $name = $row['purchases'];
                    $product = $row['product_name'];
                    echo "['" . $product . "'," . $name . ",],";
                  } ?>],


           //  x: ['100', '500', '100']
         },
        //  {
        //    name: 'Internet Explorer',
        //    y: 11.84
        //  },
       ]
     });
   </script>
   <script>
     // Make monochrome colors
     var pieColors = (function() {
       var colors = [],
         base = Highcharts.getOptions().colors[0],
         i;

       for (i = 0; i < 10; i += 1) {
         // Start out with a darkened base color (negative brighten), and end
         // up with a much brighter color
         colors.push(Highcharts.color(base).brighten((i - 3) / 7).get());
       }
       return colors;
     }());

     // Build the chart
     Highcharts.chart('container', {
       chart: {
         plotBackgroundColor: null,
         plotBorderWidth: null,
         plotShadow: false,
         type: 'pie'
       },
       title: {
         text: 'Browser market shares at a specific website, 2014'
       },
       tooltip: {
         pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
       },
       accessibility: {
         point: {
           valueSuffix: '%'
         }
       },
       plotOptions: {
         pie: {
           allowPointSelect: true,
           cursor: 'pointer',
           colors: pieColors,
           dataLabels: {
             enabled: true,
             format: '<b>{point.name}</b><br>{point.percentage:.1f} %',
             distance: -50,
             filter: {
               property: 'percentage',
               operator: '>',
               value: 4
             }
           }
         }
       },
       series: [{
         name: 'Share',
         data: [{
             name: 'Chrome',
             y: 61.41
           },
           {
             name: 'Internet Explorer',
             y: 11.84
           },
           {
             name: 'Firefox',
             y: 10.85
           },
           {
             name: 'Edge',
             y: 4.67
           },
           {
             name: 'Safari',
             y: 4.18
           },
           {
             name: 'Other',
             y: 7.05
           }
         ]
       }]
     });
   </script>
   <script>
     $(document).ready(function() {
       var salesdataTable = $('#sales_data').DataTable({
         "processing": true,
         "serverSide": true,
         "order": [],
         "ajax": {
           url: "sales_fetch.php",
           type: "POST"
         },
         "columnDefs": [{
           "targets": [0, 1, 2],
           "orderable": false,
         }, ],
         "pageLength": 9999999
       });



       $(document).on('click', '.user', function() {
         var user_id = $(this).attr("id");
         var btn_action = 'view_user';
         var transaction = $(this).data("id");
         $.ajax({
           url: "sales_action.php",
           method: "POST",
           data: {
             user_id: user_id,
             btn_action: btn_action,
             transaction_id: transaction
           },
           success: function(data) {
             $('#sales_detail').html(data);
             $('#dataModal').modal('show');
             $('.modal-title').html("<i class='fa fa-user'></i> View Customer");

           }
         });
       });


       $(document).on('click', '.order', function() {
         var transaction_id = $(this).attr("id");
         var btn_action = 'view_order';
         $.ajax({
           url: "sales_action.php",
           method: "POST",
           data: {
             transaction_id: transaction_id,
             btn_action: btn_action
           },
           success: function(data) {
             $('#sales_detail').html(data);
             $('#dataModal').modal('show');
             $('.modal-title').html("<i class='fa fa-shopping-cart'></i> View Item(s)");

           }
         });
       });

     });
   </script>
   <script src="assets/js/jquery.dataTables.min.js"></script>
   <script src="assets/js/dataTables.bootstrap4.min.js"></script>