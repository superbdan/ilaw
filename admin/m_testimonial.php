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
            <h5 class="pt-2"><strong>Update Testimonial Section</strong></h5>
            <ul class="nav ml-auto add_product">
                <li><a type="button" class="print_table btn btn-secondary p-2" data-toggle="tooltip" data-placement="bottom" title="Print Table"><i class="fa fa-print fa-lg"></i></a></li>
                <li><a type="button" id="add_button" name="modify" data-toggle="modal" data-target="#m_testimonialModal" class="btn btn-info ml-2 p-1"><i class="fa fa-pencil"></i> Add Another Testimony</a></li>
            </ul>
        </ol>
        <ol class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item" aria-current="page"><a href="settings.php">Settings</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a>Update Testimonial Section</a></li>
        </ol>
    </nav>
    <span id="alert_action"></span>
    <div class="mt-1 mb-3 p-3 button-container bg-white border shadow-sm">
        <!--Datatable-->
        <div class="table-responsive ">
            <table id="testimony_data" class="table table-bordered table-hover w-100 table-sm">
                <thead>
                    <tr>
                        <th class="print_border text-center"><b>IMAGE</b></th>
                        <th class="print_border text-center"><b>FULL NAME</b></th>
                        <th class="print_border text-center"><b>TITLE</b></th>
                        <th class="print_border text-center"><b>FEEDBACK</b></th>
                        <th class="print_border text-center"><b>RATINGS</b></th>
                        <th class="print_border text-center"><b>ACTIONS</b></th>
                    </tr>
                </thead>
            </table>
        </div>
        <!--/Datatable-->
    </div>

    <!-- Company Form -->
    <div id="m_testimonialModal" class="modal fade">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <form action="" id="testimony_form" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><i class="fa fa-plus"></i> Add Testimony</h4>
                    </div>
                    <div class="modal-body">


                        <!-- Profile Image -->
                        <label for="floatingSelect1 mt-2"><b>Insert Profile Image:</b></label>
                        <div class="form-floating mb-2">
                            <input type="file" class="form-control" style="cursor: pointer;" id="testimony_img" name="testimony_img" accept="image/*" required>
                        </div>
                        <!-- End of Profile Image -->

                        <!-- Full Name -->
                        <div class="form-floating mt-2">
                            <label for="floatingSelect1 mt-2"><b>Full Name:</b></label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <!-- End of Full Name -->

                        <!-- Title -->
                        <div class="form-floating mt-2">
                            <label for="floatingSelect1 mt-2"><b>Title:</b></label>
                            <input type="text" class="form-control" id="title" name="title"  required>
                        </div>
                        <!-- End of Title-->

                        <!-- Feedback -->
                        <div class="form-floating mt-2">
                            <label for="floatingSelect1 mt-2"><b>Feedback:</b></label>
                            <textarea class="form-control" name="feedback" id="feedback" placeholder="Feedback" style="height: 150px; resize:none;" require></textarea>
                        </div>
                        <!-- End of Feedback-->

                        <!-- Customer Rating -->
                        <div class="form-group mt-2">
                            <label for="floatingSelect1 mt-2"><b>Customer Rating:</b></label>
                            <select style="cursor:pointer" name="rating" id="rating" class="form-control" required>
                                <option value="">--- Select Customer Rating ---</option>
                                <option value="1">⭐</option>
                                <option value="2">⭐⭐</option>
                                <option value="3">⭐⭐⭐</option>
                                <option value="4">⭐⭐⭐⭐</option>
                                <option value="5">⭐⭐⭐⭐⭐</option>
                            </select>
                        </div>
                </div>

                        <!-- End of Customer Rating-->

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
    
    <!-- End of Company Form -->
    <?php
    include("footer.php")
    ?>
</div>
<script>
    // For Printing Table
function printData()
{
   var divToPrint=document.getElementById("testimony_data");
   newWin= window.open("");
   newWin.document.write('<style>.print_border{border: 1px black solid} .print_none{display:none} .table{border-collapse: collapse;} .table td {border: 1px black solid}</style>');
   newWin.document.write('<header> <p>ILAW Lighting and Equipment Trading</p></header>');
   newWin.document.write('<title>ILAW Lighting and Equipment Trading</title>');
   newWin.document.write('<center><h1>Testimony Data<h1><center>');
   newWin.document.write(divToPrint.outerHTML);
   newWin.print();
}

$('.print_table').on('click',function(){
printData();
})
// End of Printing Table code

    $(document).ready(function() {

        $('#add_button').click(function() {
            $('#testimony_form')[0].reset();
            $('.modal-title').html("<i class='fa fa-plus'></i> Add Testimony");
            $('#action').val('Add');
            $('#btn_action').val('Add');
        });

        $(document).on('submit', '#testimony_form', function(event) {
            event.preventDefault();
            $('#action').attr('disabled', 'disabled');
            var form_data = $(this).serialize();
            $.ajax({
                url: "m_testimonial_action.php",
                method: "POST",
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(data) {
                    $('#testimony_form')[0].reset();
                    $('#m_testimonialModal').modal('hide');
                    $('#alert_action').fadeIn().html('<div class="alert alert-success">' + data + '</div>');
                    $('#action').attr('disabled', false);
                    testimonydataTable.ajax.reload();
                }
            })
        });


        $(document).on('click', '.update', function() {
            var id = $(this).attr("id");
            var btn_action = 'fetch_single';
            var tst = new DataTransfer();
            $.ajax({
                url: "m_testimonial_action.php",
                method: "POST",
                data: {
                    id: id,
                    btn_action: btn_action
                },
                dataType: "json",
                success: function(data) {
                    $('#m_testimonialModal').modal('show');
                    $('#name').val(data.name);
                    $('#title').val(data.title);
                    $('#feedback').val(data.feedback);
                    $('#rating').val(data.rating);
                    $('.modal-title').html("<i class='fa fa-pencil-square-o'></i> Edit Testimony");
                    $('#id').val(id);
                    $('#action').val('Edit');
                    $('#btn_action').val("Edit");
                    tst.items.add(new File(['test'], data.image));
                    testimony_img.files = tst.files;
                }
            })
        });

        var testimonydataTable = $('#testimony_data').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                url: "m_testimonial_fetch.php",
                type: "POST"
            },
            "columnDefs": [{
                "targets": [0, 1],
                "orderable": false,
            }, ],
            "pageLength": 9999999
        });

        $(document).on('click', '.delete', function(){
        	var id = $(this).attr('id');
        	var btn_action = 'delete';
        	if(confirm("Are you sure you want to change status?"))
        	{
        		$.ajax({
        			url:"m_testimonial_action.php",
        			method:"POST",
        			data:{id:id, btn_action:btn_action},
        			success:function(data)
        			{
        				$('#alert_action').fadeIn().html('<div class="alert alert-Secondary">'+data+'</div>');
        				testimonydataTable.ajax.reload();
        			}
        		})
        	}
        	else
        	{
        		return false;
        	}
        });
    });
</script>
<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/dataTables.bootstrap4.min.js"></script>