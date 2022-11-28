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
            <h5 class="pt-2"><strong>Update Company Team</strong></h5>
            <ul class="nav ml-auto add_product">
                <li><a type="button" class="print_table btn btn-secondary p-2" data-toggle="tooltip" data-placement="bottom" title="Print Table"><i class="fa fa-print fa-lg"></i></a></li>
                <li><a type="button" id="add_button" name="modify" data-toggle="modal" data-target="#m_companyModal" class="btn btn-info ml-2 p-1"><i class="fa fa-pencil"></i> Add Another Company Team</a></li>
            </ul>
        </ol>
        <ol class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item" aria-current="page"><a href="settings.php">Settings</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a>Update Company Team</a></li>
        </ol>
    </nav>
    <span id="alert_action"></span>
    <div class="mt-1 mb-3 p-3 button-container bg-white border shadow-sm">
        <!--Datatable-->
        <div class="table-responsive ">
            <table id="companyteam_data" class="table table-bordered table-hover w-100 table-sm">
                <thead>
                    <tr>
                        <th class="print_border text-center"><b>IMAGE</b></th>
                        <th class="print_border text-center"><b>FULL NAME</b></th>
                        <th class="print_border text-center"><b>POSITION</b></th>
                        <th class="print_border text-center"><b>DESCRIPTION</b></th>
                        <th class="print_border text-center"><b>ACTIONS</b></th>
                    </tr>
                </thead>
            </table>
        </div>
        <!--/Datatable-->
    </div>

    <!-- Company Form -->
    <div id="m_companyModal" class="modal fade">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <form action="" id="cteam_form" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><i class="fa fa-plus"></i> Add Company Team</h4>
                    </div>
                    <div class="modal-body">

                        <!-- Profile Image -->
                        <label for="floatingSelect1 mt-2"><b>Insert Profile Image:</b></label>
                        <div class="form-floating">
                            <input type="file" id="team_img" name="team_img" accept=".jpg, .png" class="form-control mb-2" style="cursor: pointer;" required>
                        </div>
                        <!-- End of Profile Image -->

                        <!-- Full Name -->
                        <label for="floatingSelect1"><b>Full Name:</b></label>
                        <div class="form-floating">
                            <input type="text" class="form-control mb-2" id="name" name="name" required>
                        </div>
                        <!-- End of Full Name -->

                        <!-- Position -->
                        <label for="floatingSelect1"><b>Position:</b></label>
                        <div class="form-floating">
                            <input type="text" class="form-control mb-2" id="role" name="role" required>
                        </div>
                        <!-- End of Position-->

                        <!-- Description -->
                        <label for="floatingSelect1"><b>Desscription:</b></label>
                        <div class="form-floating">
                            <textarea class="form-control" id="description" name="description" placeholder="Write the member description here..."style="height: 150px; resize:none;" required></textarea>
                        </div>
                        <!-- End of Description-->
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
    <!-- End of Company Form -->
    <?php
    include("footer.php")
    ?>
</div>
<script>
    // For Printing Table
function printData()
{
   var divToPrint=document.getElementById("companyteam_data");
   newWin= window.open("");
   newWin.document.write('<style>.print_border{border: 1px black solid} .print_none{display:none} .table{border-collapse: collapse;} .table td {border: 1px black solid}</style>');
   newWin.document.write('<header> <p>ILAW Lighting and Equipment Trading</p></header>');
   newWin.document.write('<title>ILAW Lighting and Equipment Trading</title>');
   newWin.document.write('<center><h1>Company Team Data<h1><center>');
   newWin.document.write(divToPrint.outerHTML);
   newWin.print();
}

$('.print_table').on('click',function(){
printData();
})
// End of Printing Table code

    $(document).ready(function() {

        $('#add_button').click(function() {
            $('#cteam_form')[0].reset();
            $('.modal-title').html("<i class='fa fa-plus'></i> Add Member");
            $('#action').val('Add');
            $('#btn_action').val('Add');
        });

        $(document).on('submit', '#cteam_form', function(event) {
            event.preventDefault();
            $('#action').attr('disabled', 'disabled');
            var form_data = $(this).serialize();
            $.ajax({
                url: "m_company team_action.php",
                method: "POST",
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(data) {
                    $('#cteam_form')[0].reset();
                    $('#m_companyModal').modal('hide');
                    $('#alert_action').fadeIn().html('<div class="alert alert-success">' + data + '</div>');
                    $('#action').attr('disabled', false);
                    teamdataTable.ajax.reload();
                }
            })
        });

        $(document).on('click', '.update', function() {
            var id = $(this).attr("id");
            var btn_action = 'fetch_single';
            var tst = new DataTransfer();
            $.ajax({
                url: "m_company team_action.php",
                method: "POST",
                data: {
                    id: id,
                    btn_action: btn_action
                },
                dataType: "json",
                success: function(data) {
                    $('#m_companyModal').modal('show');
                    $('#name').val(data.name);
                    $('#role').val(data.role);
                    $('#description').val(data.description);
                    $('.modal-title').html("<i class='fa fa-pencil-square-o'></i> Edit Company Team");
                    $('#id').val(id);
                    $('#action').val('Edit');
                    $('#btn_action').val("Edit");
                    tst.items.add(new File(['test'], data.image));
                    team_img.files = tst.files;
                }
            })
        });

        var teamdataTable = $('#companyteam_data').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                url: "m_company team_fetch.php",
                type: "POST"
            },
            "columnDefs": [{
                "targets": [0, 1, 2],
                "orderable": false,
            }, ],
            "pageLength": 9999999
        });

        $(document).on('click', '.delete', function() {
            var id = $(this).attr('id');
            var btn_action = 'delete';
            if (confirm("Are you sure you want to change status?")) {
                $.ajax({
                    url: "m_company team_action.php",
                    method: "POST",
                    data: {
                        id: id,
                        btn_action: btn_action
                    },
                    success: function(data) {
                        $('#alert_action').fadeIn().html('<div class="alert alert-Secondary">' + data + '</div>');
                        teamdataTable.ajax.reload();
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




<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/dataTables.bootstrap4.min.js"></script>