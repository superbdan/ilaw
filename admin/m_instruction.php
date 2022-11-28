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
             <h5 class="pt-2"><strong>Update Shopping Instruction</strong></h5>
             <ul class="nav ml-auto add_product">
                 <li><a type="button" class="print_table btn btn-secondary p-2" data-toggle="tooltip" data-placement="bottom" title="Print Table"><i class="fa fa-print fa-lg"></i></a></li>
                 <li><a type="button" id="add_button" name="modify" data-toggle="modal" data-target="#m_instruction_modal" class="btn btn-info ml-2 p-1"><i class="fa fa-pencil"></i> Add Shopping Instruction</a></li>
             </ul>
         </ol>
         <ol class="breadcrumb breadcrumb-arrow">
             <li class="breadcrumb-item" aria-current="page"><a href="settings.php">Settings</a></li>
             <li class="breadcrumb-item active" aria-current="page"><a>Update Shopping Instruction</a></li>
         </ol>
     </nav>
     <span id="alert_action"></span>
     <div class="mt-1 mb-3 p-3 button-container bg-white border shadow-sm">
         <!--Datatable-->
         <div class="table-responsive ">
             <table id="instruction_data" class="table table-bordered table-hover w-100 table-sm">
                 <thead>
                     <tr>
                         <th class="print_border text-center"><b>LEFT IMAGE</b></th>
                         <th class="print_border text-center"><b>TITLE</b></th>
                         <th class="print_border text-center"><b>RIGHT INSTRUCTION</b></th>
                         <th class="print_border text-center"><b>RIGHT IMAGE</b></th>
                         <th class="print_border text-center"><b>TITLE</b></th>
                         <th class="print_border text-center"><b>LEFT INSTRUCTION</b></th>
                         <th class="print_border text-center"><b>ACTIONS</b></th>
                     </tr>
                 </thead>
             </table>
             <!--/Datatable-->
         </div>

         <!-- Online Banks Form -->
         <div id="m_instruction_modal" class="modal fade">
             <div class="modal-dialog modal-lg modal-2x modal-dialog-scrollable">
                 <form action="" id="instruction_form" method="post" enctype="multipart/form-data">
                     <div class="modal-content">
                         <div class="modal-header">
                             <h4><i class="fa fa-plus"></i> Add Shopping Instruction</h4>
                         </div>
                         <div class="modal-body">
                             <!-- Shopping Instruction -->
                             <label for="floatingSelect1 mt-2"><b>Insert Left Image:</b></label>
                             <div class="form-floating mb-2">
                                 <input type="file" class="form-control" id="image1" name="image1" accept="image/*">
                             </div>
                             <label for="floatingSelect1 mt-2"><b>Insert Title:</b></label>
                             <div class="form-floating mb-2">
                                 <input type="text" class="form-control" id="title1" name="title1" required>
                             </div>
                             <label for="floatingSelect1 mt-2"><b>Insert Right Instruction:</b></label>
                             <div class="form-floating mb-2">
                                 <textarea class="form-control" name="instruction1" placeholder="Details" id="instruction1" style="height: 150px; resize:none;" required></textarea>
                             </div>
                             <label for="floatingSelect1 mt-2"><b>Insert Right Image:</b></label>
                             <div class="form-floating mb-2">
                                 <input type="file" class="form-control" id="image2" name="image2" accept="image/*">
                             </div>
                             <label for="floatingSelect1 mt-2"><b>Insert Title:</b></label>
                             <div class="form-floating mb-2">
                                 <input type="text" class="form-control" id="title2" name="title2" required>
                             </div>
                             <label for="floatingSelect1 mt-2"><b>Insert Left Instruction:</b></label>
                             <div class="form-floating mb-2">
                                 <textarea class="form-control" name="instruction2" placeholder="Details" id="instruction2" style="height: 150px; resize:none;" required></textarea>
                             </div>
                             <!-- Shopping Instruction -->
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
     // For Printing Table
     function printData() {
         var divToPrint = document.getElementById("instruction_data");
         newWin = window.open("");
         newWin.document.write('<style>.print_border{border: 1px black solid} .print_none{display:none} .table{border-collapse: collapse;} .table td {border: 1px black solid}</style>');
         newWin.document.write('<title>ILAW Lighting and Equipment Trading</title>');
         newWin.document.write('<header> <p>ILAW Lighting and Equipment Trading</p></header>');
         newWin.document.write('<center><h1>Shopping Instruction Data<h1><center>');
         newWin.document.write(divToPrint.outerHTML);
         newWin.print();
     }

     $('.print_table').on('click', function() {
         printData();
     })
     // End of Printing Table code

     $(document).ready(function() {

         $('#add_button').click(function() {
             $('#instruction_form')[0].reset();
             $('.modal-title').html("<i class='fa fa-plus'></i> Add New Instructions");
             $("#image1").attr("required", true);
             $("#image2").attr("required", true);
             //  $('input[name^="fileupload"]').each(function() {
             //      $(this).rules('add', {
             //          required: true,
             //          accept: "image/jpeg, image/pjpeg"
             //      })
             //  })






             $('#action').val('Add');
             $('#btn_action').val('Add');
         });

         $(document).on('submit', '#instruction_form', function(event) {
             event.preventDefault();
             $('#action').attr('disabled', 'disabled');
             var form_data = $(this).serialize();
             $.ajax({
                 url: "m_instruction_action.php",
                 method: "POST",
                 data: new FormData(this),
                 processData: false,
                 contentType: false,
                 success: function(data) {
                     $('#instruction_form')[0].reset();
                     $('#m_instruction_modal').modal('hide');
                     $('#alert_action').fadeIn().html('<div class="alert alert-success">' + data + '</div>');
                     $('#action').attr('disabled', false);
                     instructiondataTable.ajax.reload();
                 }
             })
         });

         $(document).on('click', '.update', function() {
             var id = $(this).attr("id");
             var btn_action = 'fetch_single';
             $.ajax({
                 url: "m_instruction_action.php",
                 method: "POST",
                 data: {
                     id: id,
                     btn_action: btn_action
                 },
                 dataType: "json",
                 success: function(data) {
                     $('#m_instruction_modal').modal('show');
                     $("#image1").attr("required", false);
                     $("#image2").attr("required", false);
                     $('#instruction1').val(data.instruction1);
                     $('#instruction2').val(data.instruction2);
                     $('#title1').val(data.title1);
                     $('#title2').val(data.title2);
                     $('#id').val(id);
                     $('#action').val('Edit');
                     $('#btn_action').val("Edit");
                 }
             })
         });

         var instructiondataTable = $('#instruction_data').DataTable({
             "processing": true,
             "serverSide": true,
             "order": [],
             "ajax": {
                 url: "m_instruction_fetch.php",
                 type: "POST"
             },
             "columnDefs": [{
                 "targets": [0, 1, 2, 3],
                 "orderable": false,
             }, ],
             "pageLength": 9999999
         });

         $(document).on('click', '.delete', function() {
             var id = $(this).attr('id');
             var btn_action = 'delete';
             if (confirm("Are you sure you want to change status?")) {
                 $.ajax({
                     url: "m_instruction_action.php",
                     method: "POST",
                     data: {
                         id: id,
                         btn_action: btn_action
                     },
                     success: function(data) {
                         $('#alert_action').fadeIn().html('<div class="alert alert-Secondary">' + data + '</div>');
                         instructiondataTable.ajax.reload();
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