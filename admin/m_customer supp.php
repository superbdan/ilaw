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
                    <h5 class="pt-2" ><strong>Customer Support</strong></h5>
                    <ul class="nav ml-auto add_product">
                        <li><a type="button" id="add_button" name="modify" data-toggle="modal" data-target="#m_customersuppModal"  class="btn btn-info ml-3 p-1"><i class="fa fa-pencil"></i> Modify Custpmer Support</a></li>
                    </ul>
                </ol>
                <ol class="breadcrumb breadcrumb-arrow">
                    <li class="breadcrumb-item" aria-current="page"><a href="settings.php">Settings</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a>Modify Customer Support</a></li>
        </ol>
            </nav>
            <div class="mt-1 mb-3 p-3 button-container bg-white border shadow-sm">
                <h1> How To Buy </h1>
                <p><?php echo $details_htb; ?></p>
                
            </div>
<!-- About Us -->
    <div id="m_customersuppModal" class="modal fade">
    	<div class="modal-dialog modal-lg modal-dialog-scrollable">
            <form action="" method="post" enctype="multipart/form-data">
    			<div class="modal-content">
					<div class="modal-header">
						<h3>Update Customer Support</h3>
    				</div>
    				<div class="modal-body">
                    <!-- How To Buy -->
                    <label for="floatingSelect1 mt-2">How to Buy:</label>
                    <div class="form-floating mt-2">
                        <textarea class="form-control" name="details_htb" placeholder="Details" style="height: 150px; resize:none;" required><?php echo $details_htb; ?></textarea>
                    </div>
                    <!-- End of How To Buy -->

                    <!-- Our Culture -->
                    <div class="form-floating mt-2">
                            <input type="text" class="form-control" id="floatingInput2" value="<?php echo $label2; ?>" name="label2" placeholder="Our Culture" required> 
                    </div>
                    <div class="form-floating mt-2">
                        <textarea class="form-control" name="details2" placeholder="Details" id="floatingTextarea2" style="height: 150px; resize:none;" required><?php echo $details2; ?></textarea>
                    </div>
                    <!-- End of Our Culture -->

                    <!-- Our Mission -->
                    <div class="form-floating mt-2">
                            <input type="text" class="form-control" id="floatingInput3" value="<?php echo $label3; ?>" name="label3" placeholder="Our Mission" required> 
                    </div>
                    <div class="form-floating mt-2">
                        <textarea class="form-control" name="details3" placeholder="Details" id="floatingTextarea3" style="height: 150px; resize:none;" required><?php echo $details3; ?></textarea>
                    </div>
                    <!-- End of Our Mission -->

                     <!-- Our Vision -->
                     <div class="form-floating mt-2">
                            <input type="text" class="form-control" id="floatingInput4" value="<?php echo $label4; ?>" name="label4" placeholder="Our Vision" required> 
                    </div>
                    <div class="form-floating mt-2">
                        <textarea class="form-control" name="details4" placeholder="Details" id="floatingTextarea4" style="height: 150px; resize:none;" required><?php echo $details4; ?></textarea>
                    </div>
                    <!-- End of Our Vision -->

    					<div class="modal-footer">
                        <button type="submit" class="btn btn-success" name="submit" onclick="return confirm('Are you sure you want to Add this Data?')">Update</button>
                        <form action="" method="post">
                            <button type="submit" class="btn btn-danger" name="delete" onclick="return confirm('Are you sure you want to remove all of this Data?')">Remove Data</button>
                        </form>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    					</div>
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
