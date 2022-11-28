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
             <h5 class="pt-2"><strong>Update Best Seller Items</strong></h5>
             <ul class="nav ml-auto add_product">
                 <li><a type="button" href="generate_reports/generate_best_seller_reports.php" class="btn btn-secondary ml-2 p-2 text-white" data-toggle="tooltip" data-placement="bottom" title="Print Table"><i class="fa fa-print fa-lg"></i></a></li>
                 <li><a type="button" id="add_button" name="modify" data-toggle="modal" data-target="#m_bestseller" class="btn btn-info ml-2 p-1"><i class="fa fa-pencil"></i> Add Another Best Seller Item</a></li>
             </ul>
         </ol>
         <ol class="breadcrumb breadcrumb-arrow">
             <li class="breadcrumb-item" aria-current="page"><a href="settings.php">Settings</a></li>
             <li class="breadcrumb-item active" aria-current="page"><a>Update Best Sellers Items</a></li>
         </ol>
     </nav>
     <span id="alert_action"></span>
     <div class="mt-1 mb-3 p-3 button-container bg-white border shadow-sm">
         <div class="table-responsive ">
             <table id="bestseller_data" class="table table-bordered table-hover w-100 table-sm">
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
     <div id="m_bestseller" class="modal fade">
         <div class="modal-dialog modal-lg modal-dialog-scrollable">
             <form action="" id="best_seller_form" method="post" enctype="multipart/form-data">
                 <div class="modal-content">
                     <div class="modal-header">
                         <h4 class="modal-title"><i class="fa fa-plus"></i> Add Best Seller</h4>
                     </div>
                     <div class="modal-body">

                         <label for="floatingSelect1 mt-2"><b>Insert Best Seller Product:</b></label>
                         <div class="form-floating mb-2">
                             <select style="cursor:pointer" name="items_id" id="items_id" class="form-control" required>
                                 <option value="">--- Select Product ---</option>
                                 <?php echo fill_product_list($connect); ?>
                             </select>
                         </div>
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
     <!-- End of About Us -->
     <?php
        include("footer.php")
        ?>

 </div>
 <script>

     $(document).ready(function() {

         $('#add_button').click(function() {
             $('#best_seller_form')[0].reset();
             $('.modal-title').html("<i class='fa fa-plus'></i> Add Best Seller");
             $('#action').val('Add');
             $('#btn_action').val('Add');
         });

         $(document).on('submit', '#best_seller_form', function(event) {
             event.preventDefault();
             $('#action').attr('disabled', 'disabled');
             var form_data = $(this).serialize();
             $.ajax({
                 url: "m_best sellers_action.php",
                 method: "POST",
                 data: new FormData(this),
                 processData: false,
                 contentType: false,
                 success: function(data) {
                     $('#best_seller_form')[0].reset();
                     $('#m_bestseller').modal('hide');
                     $('#alert_action').fadeIn().html('<div class="alert alert-success">' + data + '</div>');
                     $('#action').attr('disabled', false);
                     b_sellerdataTable.ajax.reload();
                 }
             })
         });

         $(document).on('click', '.update', function() {
             var id = $(this).attr("id");
             var btn_action = 'fetch_single';
             // var tst1 = new DataTransfer();
             // var tst2 = new DataTransfer();
             $.ajax({
                 url: "m_best sellers_action.php",
                 method: "POST",
                 data: {
                     id: id,
                     btn_action: btn_action
                 },
                 dataType: "json",
                 success: function(data) {
                     $('#m_bestseller').modal('show');
                     $('#name').val(data.name);
                     $('#category').val(data.category);
                     $('#price').val(data.price);
                     $('.modal-title').html("<i class='fa fa-pencil-square-o'></i> Edit Best Seller");
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

         var b_sellerdataTable = $('#bestseller_data').DataTable({
             "processing": true,
             "serverSide": true,
             "order": [],
             "ajax": {
                 url: "m_best sellers_fetch.php",
                 type: "POST"
             },
             "columnDefs": [{
                 "targets": [0, 1],
                 "orderable": false,
             }, ],
             "pageLength": 9999999
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
         });



         $(document).on('click', '.delete', function() {
             var id = $(this).attr('id');
             var btn_action = 'delete';
             if (confirm("Are you sure you want delete this best seller item?")) {
                 $.ajax({
                     url: "m_best sellers_action.php",
                     method: "POST",
                     data: {
                         id: id,
                         btn_action: btn_action
                     },
                     success: function(data) {
                         $('#alert_action').fadeIn().html('<div class="alert alert-Secondary">' + data + '</div>');
                         b_sellerdataTable.ajax.reload();
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