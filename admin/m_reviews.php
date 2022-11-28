 <!--Browser Icon-->
 <link rel="icon" type="image/x-icon" href="images/Logos/ILAW_Logo.png">
 <?php
    include('database_connection.php');

    $active = "Settings";
    include('header.php');
    include('sidebar.php');
    ?>

 <!--Main Content-->
 <div class="col-sm-9 col-xs-12 content pt-3 pl-0">
     <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
             <h5 class="pt-2"><strong>Update Rate and Reviews</strong></h5>
             <ul class="nav ml-auto add_product">
                 <li><a type="button" class="print_table btn btn-secondary p-2" data-toggle="tooltip" data-placement="bottom" title="Print Table"><i class="fa fa-print fa-lg"></i></a></li>
             </ul>
         </ol>
         <ol class="breadcrumb breadcrumb-arrow">
             <li class="breadcrumb-item" aria-current="page"><a href="settings.php">Settings</a></li>
             <li class="breadcrumb-item active" aria-current="page"><a>Update Rate and Reviews</a></li>
         </ol>
     </nav>
     <span id="alert_action"></span>
     <div class="mt-1 mb-3 p-3 button-container bg-white border shadow-sm">
         <!--Datatable-->
         <div class="table-responsive ">
             <table id="reviews_data" class="table table-bordered table-hover w-100 table-sm">
                 <thead>
                     <tr>
                         <th class="print_border text-center"><b>USERNAME</b></th>
                         <th class="print_border text-center"><b>USER ID</b></th>
                         <th class="print_border text-center"><b>USER RATE</b></th>
                         <th class="print_border text-center"><b>TITLE</b></th>
                         <th class="print_border text-center"><b>FEEDBACK</b></th>
                         <th class="print_border text-center"><b>IMAGE</b></th>
                         <th class="print_border text-center"><b>ACTIONS</b></th>
                     </tr>
                 </thead>
                 <?php
                    $query = "SELECT * FROM review_table";
                    $result = mysqli_query($con, $query);

                    while ($row = mysqli_fetch_array($result)) {
                        $image = $row['review_img'];
                        $encode = json_decode($image);
                        if ($row['user_rating'] == '5') {
                            $rating = '⭐⭐⭐⭐⭐';
                        } elseif ($row['user_rating'] == '4') {
                            $rating = '⭐⭐⭐⭐';
                        } elseif ($row['user_rating'] == '3') {
                            $rating = '⭐⭐⭐';
                        } elseif ($row['user_rating'] == '2') {
                            $rating = '⭐⭐';
                        } elseif ($row['user_rating'] == '1') {
                            $rating = '⭐';
                        } else {
                            $rating = '✰✰✰✰✰';
                        }

                        echo '  
        
                     <tr>  
                                    <td>' .  $row['user_name'] . '</td>
                                    <td>' . $row['user_id'] . '</td> 
                                    <td>' . $rating . '</td>  
                                    <td>' . $row['title_review'] . '</td>     
                                    <td>' . $row['user_review'] . '</td><td>';
                        for ($i = 0; $i < count($encode); $i++) {;
                            echo '<img class="shadow" src="../images/review-upload/' . $encode[$i] . '" alt="Gallery Image" width="60px"/>';
                        }
                        echo '</td><td><center><button type="button" name="delete" id="' . $row["review_id"] . '" class="btn btn-danger btn-xs delete" data-toggle="tooltip" data-placement="bottom" title="Remove Review" data-status="' . $row["review_id"] . '"><i class="fa fa-trash"></i></button></center></td>
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
 </div>
 <script>
     // For Printing Table
     function printData() {
         var divToPrint = document.getElementById("reviews_data");
         newWin = window.open("");
         newWin.document.write('<style>.print_border{border: 1px black solid} .print_none{display:none} .table{border-collapse: collapse;} .table td {border: 1px black solid}</style>');
         newWin.document.write('<header> <p>ILAW Lighting and Equipment Trading</p></header>');
         newWin.document.write('<title>ILAW Lighting and Equipment Trading</title>');
         newWin.document.write('<center><h1>Reviews Data<h1><center>');
         newWin.document.write(divToPrint.outerHTML);
         newWin.print();
     }

     $('.print_table').on('click', function() {
         printData();
     })
     // End of Printing Table code
     $(document).ready(function() {
         var reviewsdataTable = $('#reviews_data').DataTable();

         $(document).on('click', '.delete', function() {
             var review_id = $(this).attr('id');
             var btn_action = 'delete';
             if (confirm("Are you sure you want to delete this review?")) {
                 $.ajax({
                     url: "m_reviews_action.php",
                     method: "POST",
                     data: {
                         review_id: review_id,
                         btn_action: btn_action
                     },
                     success: function(data) {
                         $("#reviews_data").load(location.href + " #reviews_data");
                         $('#alert_action').fadeIn().html('<div class="alert alert-Secondary">' + data + '</div>');
                     }
                 })
             } else {
                 return false;
             }
         });
     });
 </script>
 <script src="assets/js/jquery.dataTables.min.js"></script>
 <script src="assets/js/dataTables.bootstrap4.min.js"></script>