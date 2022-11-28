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
            <h5 class="pt-2"><strong>Update About Us</strong></h5>
            <ul class="nav ml-auto add_product">
                <li><a type="button" id="add_button" name="modify" data-toggle="modal" data-target="#m_aboutusModal" class="btn btn-info ml-3 p-1"><i class="fa fa-pencil"></i> Edit About Us</a></li>
            </ul>
        </ol>
        <ol class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item" aria-current="page"><a href="settings.php">Settings</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a>Update About Us</a></li>
        </ol>
    </nav>
    <span id="alert_action"></span>
    <div class="mt-1 mb-3 p-3 button-container bg-white border shadow-sm">
        <h1> About Us </h1>
        <h6>Our Brief History<b></b></h6>
        <p id="history"></p><br>
        <h6><b>Our Culture</b></h6>
        <p id="culture"></p> </br>
        <h6><b>Our Mission</b></h6>
        <p id="mission"></p> </br>
        <h6><b>Our Vision</b></h6>
        <p id="vision"></p>
    </div>
    <!-- About Us -->
    <div id="m_aboutusModal" class="modal fade">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <form action="" id="about_form" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header mt-2">
                        <h4 class="modal-title"><i class="fa fa-plus"></i> Add About Us</h4>
                    </div>
                    <div class="modal-body">
                        <!-- Our Brief History -->
                        <div class="form-floating mt-2">
                            <label for="floatingSelect1 mt-2"><b>Insert Company History:</b></label>
                            <textarea class="form-control" name="mhistory" placeholder="Details" id="mhistory" style="height: 150px; resize:none;" required></textarea>
                        </div>
                        <!-- End of Our Brief History -->

                        <!-- Our Culture -->
                        <div class="form-floating mt-2">
                            <label for="floatingSelect1 mt-2"><b>Insert Company Culture:</b></label>
                            <textarea class="form-control" name="mculture" placeholder="Details" id="mculture" style="height: 150px; resize:none;" required></textarea>
                        </div>
                        <!-- End of Our Culture -->

                        <!-- Our Mission -->
                        <div class="form-floating mt-2">
                            <label for="floatingSelect1 mt-2"><b>Insert Company Mission:</b></label>
                            <textarea class="form-control" name="mmission" placeholder="Details" id="mmission" style="height: 150px; resize:none;" required></textarea>
                        </div>
                        <!-- End of Our Mission -->

                        <!-- Our Vision -->
                        <div class="form-floating mt-2">
                            <label for="floatingSelect1 mt-2"><b>Insert Company Vision:</b></label>
                            <textarea class="form-control" name="mvision" placeholder="Details" id="mvision" style="height: 150px; resize:none;" required></textarea>
                        </div>
                        <!-- End of Our Vision -->
                    </div>

                    <div class="modal-footer">
                        <input type="hidden" name="id" id="id" />
                        <input type="hidden" name="btn_action" id="btn_action" />
                        <input type="submit" name="action" id="action" class="btn btn-info" value="Update" />
                        <input type="button" class="btn btn-secondary" data-dismiss="modal" value="Close" >
                    </div>
                </div>
        </div>
        </form>
    </div>
    <!-- End of About Us -->
    <?php
    include("footer.php")
    ?>

</div>
<script>
    $(document).ready(function() {

        $('#add_button').click(function() {
            $('.modal-title').html("<i class='fa fa-plus'></i> Add Company About us Information");
            $('#action').val('Add');
            $('#btn_action').val('Add');
        });

        $(document).on('submit', '#about_form', function(event) {
            event.preventDefault();
            $('#action').attr('disabled', 'disabled');
            var form_data = $(this).serialize();
            $.ajax({
                url: "m_about us_action.php",
                method: "POST",
                data: form_data,
                success: function(data) {
                    $('#m_aboutusModal').modal('hide');
                    $('#alert_action').fadeIn().html('<div class="alert alert-success">' + data + '</div>');
                    $('#action').attr('disabled', false);
                    load_about_data();
                }
            })
        });



        load_about_data();

        function load_about_data() {
            $.ajax({
                url: "m_about us_fetch.php",
                method: "POST",
                data: {
                    action: 'load_data'
                },
                dataType: "JSON",
                success: function(data) {
                    $('#history').text(data.history);
                    $('#culture').text(data.culture);
                    $('#mission').text(data.mission);
                    $('#vision').text(data.vision);
                    $('#id').val(data.id)
                    $('#mhistory').text(data.history);
                    $('#mculture').text(data.culture);
                    $('#mmission').text(data.mission);
                    $('#mvision').text(data.vision);
                }
            })
        }

    });
</script>