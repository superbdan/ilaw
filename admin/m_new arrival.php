 <!--Browser Icon-->
 <link rel="icon" type="image/x-icon" href="images/Logos/ILAW_Logo.png">
 <?php
    include('database_connection.php');

    $active = "Settings";
    include('header.php');
    include('sidebar.php');
    include('../function.php');
    ?>

 <!--Main Content-->
 <div class="col-sm-9 col-xs-12 content pt-3 pl-0">
     <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
             <h5 class="pt-2"><strong>Update New Arrival Items</strong></h5>
             <ul class="nav ml-auto add_product">
                <li><a type="button" href="generate_reports/generate_new_arrival_reports.php" class="btn btn-secondary ml-2 p-2 text-white" data-toggle="tooltip" data-placement="bottom" title="Print Table"><i class="fa fa-print fa-lg"></i></a></li>
                 <li><a type="button" id="add_button" name="modify" data-toggle="modal" data-target="#m_arrivalModal" class="btn btn-info ml-2 p-1"><i class="fa fa-pencil"></i> Add Another New Arrival Item</a></li>
             </ul>
         </ol>
         <ol class="breadcrumb breadcrumb-arrow">
             <li class="breadcrumb-item" aria-current="page"><a href="settings.php">Settings</a></li>
             <li class="breadcrumb-item active" aria-current="page"><a>Update New Arrival Items</a></li>
         </ol>
     </nav>
     <span id="alert_action"></span>
     <div class="mt-1 mb-3 p-3 button-container bg-white border shadow-sm">
         <!-- Datatable -->
         <div class="table-responsive ">
             <table id="narrival_data" class="table table-bordered table-hover w-100 table-sm">
                 <thead>
                     <tr>
                         <th class="print_border text-center"><b>PRODUCT SHOWCASE 1</b></th>
                         <th class="print_border text-center"><b>PRODUCT SHOWCASE 2</b></th>
                         <th class="print_border text-center"><b>NAME</b></th>
                         <th class="print_border text-center"><b>CATEGORY</b></th>
                         <th class="print_border text-center"><b>PRICE</b></th>
                         <th class="print_border text-center"><b>ACTION</b></th>
                     </tr>
                 </thead>
             </table>
             <!--/Datatable-->
         </div>
     </div>
     <!-- About Us -->
     <div id="m_arrivalModal" class="modal fade">
         <div class="modal-dialog modal-lg modal-dialog-scrollable">
             <form action="" id="arrival_form" method="post" enctype="multipart/form-data">
                 <div class="modal-content">
                     <div class="modal-header">
                         <h4 class="modal-title"><i class="fa fa-plus"></i><b> Add New Arrival</b></h4>
                     </div>
                     <div class="modal-body">

                         <label for="floatingSelect1 mt-2"><b>Insert Product Name:</label>
                         <div class="form-floating mb-2">
                             <select style="cursor:pointer" name="items_id" id="items_id" class="form-control" required>
                                 <option value="">--- Select Product ---</option>
                                 <?php echo fill_product_list($connect); ?>
                             </select>
                         </div>
                     <div class="modal-footer">
                         <input type="hidden" name="id" id="id" />
                         <input type="hidden" name="btn_action" id="btn_action" />
                         <input type="submit" name="action" id="action" class="btn btn-info" value="Add" />
                         <input type="reset" name="action" id="action" class="btn btn-danger" value="Clear" />
                     </div>
                 </div>
             </form>
         </div>
         </div>
     </div>
     <!-- End of About Us -->
     <?php
        include("footer.php")
        ?>
 </div>
 <script>
    
     $(document).ready(function() {

         $('#add_button').click(function() {
             $('#arrival_form')[0].reset();
             $('.modal-title').html("<i class='fa fa-plus'></i> Add New Arrival");
             $('#action').val('Add');
             $('#btn_action').val('Add');
         });

         $(document).on('submit', '#arrival_form', function(event) {
             event.preventDefault();
             $('#action').attr('disabled', 'disabled');
             var form_data = $(this).serialize();
             $.ajax({
                 url: "m_new arrival_action.php",
                 method: "POST",
                 data: new FormData(this),
                 processData: false,
                 contentType: false,
                 success: function(data) {
                     $('#arrival_form')[0].reset();
                     $('#m_arrivalModal').modal('hide');
                     $('#alert_action').fadeIn().html('<div class="alert alert-success">' + data + '</div>');
                     $('#action').attr('disabled', false);
                     n_arrivaldataTable.ajax.reload();
                 }
             })
         });

         $(document).on('click', '.update', function() {
             var id = $(this).attr("id");
             var btn_action = 'fetch_single';
             // var tst1 = new DataTransfer();
             // var tst2 = new DataTransfer();
             $.ajax({
                 url: "m_new arrival_action.php",
                 method: "POST",
                 data: {
                     id: id,
                     btn_action: btn_action
                 },
                 dataType: "json",
                 success: function(data) {
                     $('#m_arrivalModal').modal('show');
                     $('#name').val(data.name);
                     $('#category').val(data.category);
                     $('#price').val(data.price);
                     $('.modal-title').html("<i class='fa fa-pencil-square-o'></i> Edit New Arrival");
                     $('#id').val(id);
                     $('#action').val('Edit');
                     $('#btn_action').val("Edit");
                     // tst1.items.add(new File(['test'], data.image1));
                     // tst2.items.add(new File(['test'], data.image2));
                     // new_img1.files = tst1.files;
                     // new_img2.files = tst2.files;
                 }

             })
         });


         $("#name").on('change', function() {
             var prod = $(this).val();
             $.ajax({
                 method: "POST",
                 url: "product_price.php",
                 data: {
                     prod: prod
                 },
                 dataType: "json",
                 success: function(data) {
                     $("#price").val(data.items_price);
                     $("#category").val(data.category_name);
                 }

             });
         })




         var n_arrivaldataTable = $('#narrival_data').DataTable({
             "processing": true,
             "serverSide": true,
             "order": [],
             "ajax": {
                 url: "m_new arrival_fetch.php",
                 type: "POST"
             },
             "columnDefs": [{
                 "targets": [0, 1],
                 "orderable": false,
             }, ],
             "pageLength": 9999999
         });

         $(document).on('click', '.delete', function() {
             var id = $(this).attr('id');
             var btn_action = 'delete';
             if (confirm("Are you sure you want delete this new arrival item?")) {
                 $.ajax({
                     url: "m_new arrival_action.php",
                     method: "POST",
                     data: {
                         id: id,
                         btn_action: btn_action
                     },
                     success: function(data) {
                         $('#alert_action').fadeIn().html('<div class="alert alert-Secondary">' + data + '</div>');
                         n_arrivaldataTable.ajax.reload();
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