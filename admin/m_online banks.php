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
             <h5 class="pt-2"><strong>Update Online Banks</strong></h5>
             <ul class="nav ml-auto add_product">
                 <li><a type="button" href="generate_reports/generate_online_bank_reports.php" class="btn btn-secondary p-2 text-white" data-toggle="tooltip" data-placement="bottom" title="Print Table"><i class="fa fa-print fa-lg"></i></a></li>
                 <li><a type="button" id="add_button" name="modify" data-toggle="modal" data-target="#m_onlinebanksModal" class="btn btn-info ml-2 p-1"><i class="fa fa-pencil"></i> Add Another Online Bank</a></li>
             </ul>
         </ol>
         <ol class="breadcrumb breadcrumb-arrow">
             <li class="breadcrumb-item" aria-current="page"><a href="settings.php">Settings</a></li>
             <li class="breadcrumb-item active" aria-current="page"><a>Update Online Banks</a></li>
         </ol>
     </nav>
     <span id="alert_action"></span>
     <div class="mt-1 mb-3 p-3 button-container bg-white border shadow-sm">
         <!--Datatable-->
         <div class="table-responsive ">
             <table id="onlinebank_data" class="table table-bordered table-hover w-100 table-sm">
                 <thead>
                     <tr>
                         <th class="print_border text-center"><b>E-WALLETS</b></th>
                         <th class="print_border text-center"><b>BANK NAME</b></th>
                         <th class="print_border text-center"><b>BANK DETAILS</b></th>
                         <th class="print_border text-center"><b>ACTIONS</b></th>
                     </tr>
                 </thead>
             </table>
             <!--/Datatable-->
         </div>

         <!-- Online Banks Form -->
         <div id="m_onlinebanksModal" class="modal fade">
             <div class="modal-dialog modal-2x modal-dialog-scrollable">
                 <form action="" id="bank_form" method="post" enctype="multipart/form-data">
                     <div class="modal-content">
                         <div class="modal-header">
                             <h4 class="modal-title"><i class="fa fa-plus"></i> Add Online Bank</h4>
                         </div>
                         <div class="modal-body">
                             <!-- Online Bank Logo -->

                             <label for="floatingSelect1 mt-2"><b>Insert Online Bank Logo:</b></label>
                             <div class="form-floating mb-2">
                                 <input type="file" class="form-control" id="bank_img" name="bank_img" accept="image/*" required>
                             </div>
                             <label for="floatingSelect1 mt-2"><b>Insert Bank Account Name:</b></label>
                             <div class="form-floating mb-2">
                                 <input type="text" class="form-control" id="bank_name" name="bank_name" required>
                             </div>
                             <label for="floatingSelect1 mt-2"><b>Insert Bank Account Number:</b></label>
                             <div class="form-floating mb-2">
                                 <input type="text" class="form-control" id="bank_details" name="bank_details" required>
                             </div>
                             <!-- End of Online Bank Logo -->
                         </div>

                         <div class="modal-footer">
                             <input type="hidden" name="id" id="id" />
                             <input type="hidden" name="btn_action" id="btn_action" />
                             <input type="submit" name="action" id="action" class="btn btn-info" value="Add" />
                             <input type="reset" name="action" id="action" class="btn btn-danger" value="Clear" />
                         </div>
                     </div>
             </div>
             </form>
         </div>
     </div>
     <!-- End of Online Banks Form -->
     <?php
        include("footer.php")
        ?>
 </div>
 <script>
     $(document).ready(function() {

         $('#add_button').click(function() {
             $('#bank_form')[0].reset();
             $('.modal-title').html("<i class='fa fa-plus'></i> Add Online Bank");
             $('#action').val('Add');
             $('#btn_action').val('Add');
         });

         $(document).on('submit', '#bank_form', function(event) {
             event.preventDefault();
             $('#action').attr('disabled', 'disabled');
             var form_data = $(this).serialize();
             $.ajax({
                 url: "m_online banks_action.php",
                 method: "POST",
                 data: new FormData(this),
                 processData: false,
                 contentType: false,
                 success: function(data) {
                     $('#bank_form')[0].reset();
                     $('#m_onlinebanksModal').modal('hide');
                     $('#alert_action').fadeIn().html('<div class="alert alert-success">' + data + '</div>');
                     $('#action').attr('disabled', false);
                     bankingdataTable.ajax.reload();
                 }
             })
         });

         $(document).on('click', '.update', function() {
             var id = $(this).attr("id");
             var btn_action = 'fetch_single';
             var tst = new DataTransfer();
             $.ajax({
                 url: "m_online banks_action.php",
                 method: "POST",
                 data: {
                     id: id,
                     btn_action: btn_action
                 },
                 dataType: "json",
                 success: function(data) {
                     $('#m_onlinebanksModal').modal('show');
                     $('#bank_name').val(data.bank_name);
                     $('#bank_details').val(data.bank_details);
                     $('.modal-title').html("<i class='fa fa-pencil-square-o'></i> Edit Bank Information");
                     $('#id').val(id);
                     $('#action').val('Edit');
                     $('#btn_action').val("Edit");
                     tst.items.add(new File(['test'], data.image));
                     bank_img.files = tst.files;
                 }
             })
         });

         var bankingdataTable = $('#onlinebank_data').DataTable({
             "processing": true,
             "serverSide": true,
             "order": [],
             "ajax": {
                 url: "m_online banks_fetch.php",
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
             if (confirm("Are you sure you want to change status?")) {
                 $.ajax({
                     url: "m_online banks_action.php",
                     method: "POST",
                     data: {
                         id: id,
                         btn_action: btn_action
                     },
                     success: function(data) {
                         $('#alert_action').fadeIn().html('<div class="alert alert-Secondary">' + data + '</div>');
                         bankingdataTable.ajax.reload();
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