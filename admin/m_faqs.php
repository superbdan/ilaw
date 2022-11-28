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
            <h5 class="pt-2"><strong>Update Frequently Asked Questions (FAQs)</strong></h5>
            <ul class="nav ml-auto add_product">
                <li><a type="button" class="print_table btn btn-secondary p-2" data-toggle="tooltip" data-placement="bottom" title="Print Table"><i class="fa fa-print fa-lg"></i></a></li>
                <li><a type="button" id="add_button" name="modify" data-toggle="modal" data-target="#m_faqsModal" class="btn btn-info ml-2 p-1"><i class="fa fa-pencil"></i> Add Another FAQs</a></li>
            </ul>
        </ol>
        <ol class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item" aria-current="page"><a href="settings.php">Settings</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a>Update Frequently Asked Questions</a></li>
        </ol>
    </nav>
    <span id="alert_action"></span>
    <div class="mt-1 mb-3 p-3 button-container bg-white border shadow-sm">
        <!--Datatable-->
        <div class="table-responsive ">
            <table id="faqs_data" class="table table-bordered table-hover w-100 table-sm">
                <thead>
                    <tr>
                        <th class="print_border text-center"><b>QUESTIONS</b></th>
                        <th class="print_border text-center"><b>ANSWERS</b></th>
                        <th class="print_border text-center"><b>ACTIONS</b></th>
                    </tr>
                </thead>
            </table>
            <!--/Datatable-->
        </div>

        <!-- FAQs Form -->
        <div id="m_faqsModal" class="modal fade">
            <div class="modal-dialog modal-2x modal-dialog-scrollable">
                <form action="" id="faqs_form" method="post">
                    <div class="modal-content">
                        <div class="modal-header">
                        
                        <h4 class="modal-title"><i class="fa fa-plus"></i><span>Add Question</span></h4>

                        </div>
                        <div class="modal-body">
                            <!-- Question -->
                            <label for="floatingSelect1"><b>Question:</b></label>
                            <div class="form-floating mt-2">
                                <input type="text" class="form-control mb-2" name="question" id="question" required>
                            </div>
                            <!-- End of Question-->
                            <!-- Answer -->
                            <label for="floatingSelect1"><b>Answer:</b></label>
                            <div class="form-floating mt-2">
                                <textarea class="form-control" name="answer" id="answer" style="height: 150px; resize:none;" required></textarea>
                            </div>
                            <!-- End of Answer-->
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
function printData()
{
   var divToPrint=document.getElementById("faqs_data");
   newWin= window.open("");
   newWin.document.write('<style>.print_border{border: 1px black solid} .print_none{display:none} .table{border-collapse: collapse;} .table td {border: 1px black solid}</style>');
   newWin.document.write('<header> <p>ILAW Lighting and Equipment Trading</p></header>');
   newWin.document.write('<title>ILAW Lighting and Equipment Trading</title>');
   newWin.document.write('<center><h1>Frequently Asked Questions Data<h1><center>');
   newWin.document.write(divToPrint.outerHTML);
   newWin.print();
}

$('.print_table').on('click',function(){
printData();
})
// End of Printing Table code
    // Faqs main function
    $(document).ready(function() {

        $('#add_button').click(function() {
            $('#faqs_form')[0].reset();
            $('.modal-title').html("<i class='fa fa-plus'></i> Add Question");
            $('#action').val('Add');
            $('#btn_action').val('Add');
        });
    
        $(document).on('submit', '#faqs_form', function(event) {
            event.preventDefault();
            $('#action').attr('disabled', 'disabled');
            var form_data = $(this).serialize();
            $.ajax({
                url: "m_faqs_action.php",
                method: "POST",
                data: form_data,
                success: function(data) {
                    $('#faqs_form')[0].reset();
                    $('#m_faqsModal').modal('hide');
                    $('#alert_action').fadeIn().html('<div class="alert alert-success">' + data + '</div>');
                    $('#action').attr('disabled', false);
                    faqsdataTable.ajax.reload();
                }
            })
        });

        $(document).on('click', '.update', function(){
        	var id = $(this).attr("id");
        	var btn_action = 'fetch_single';
        	$.ajax({
        		url:"m_faqs_action.php",
        		method:"POST",
        		data:{id:id, btn_action:btn_action},
        		dataType:"json",
        		success:function(data)
        		{
        			$('#m_faqsModal').modal('show');
        			$('#question').val(data.question);
                    $('#answer').val(data.answer);
        			$('.modal-title').html("<i class='fa fa-pencil-square-o'></i> Edit Question and Answer");
        			$('#id').val(id);
        			$('#action').val('Edit');
        			$('#btn_action').val("Edit");
        		}
        	})
        });

        var faqsdataTable = $('#faqs_data').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                url: "m_faqs_fetch.php",
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
        	if(confirm("Are you sure you want delete this?"))
        	{
        		$.ajax({
        			url:"m_faqs_action.php",
        			method:"POST",
        			data:{id:id, btn_action:btn_action},
        			success:function(data)
        			{
        				$('#alert_action').fadeIn().html('<div class="alert alert-Secondary">'+data+'</div>');
        				faqsdataTable.ajax.reload();
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