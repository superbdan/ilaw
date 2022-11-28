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
                    <h5 class="pt-2" ><strong>Settings</strong></h5>
                    <ul class="nav ml-auto add_product">
                        <li><a tabindex="0" class="btn btn-secondary pb-1" role="button" data-toggle="popover" data-trigger="focus" title="Content Guide" data-content="This section will help you to update or change the entire data you have set on their respective sections."><i class="fa fa-info fa-lg"></i></a></li>
                    </ul>
                </ol>
            </nav>
<!--Button Modifier -->
    <button onclick="window.location='m_best sellers.php';" class="btn btn-secondary btn-block"><i class="fa fa-pencil"></i> Update Best Sellers Items</button>
    <button onclick="window.location='m_new arrival.php';" class="btn btn-secondary btn-block"><i class="fa fa-pencil"></i> Update New Arrival Items</button>
    <button onclick="window.location='m_testimonial.php';" class="btn btn-secondary btn-block"><i class="fa fa-pencil"></i> Update Testimonial Section</button>
    <!--<button onclick="window.location='m_customer supp.php';" class="btn btn-secondary btn-block"><i class="fa fa-pencil"></i> Modify Customer Support</button> -->
    <button onclick="window.location='m_faqs.php';" class="btn btn-secondary btn-block"><i class="fa fa-pencil"></i> Update Frequently Asked Questions</button>
    <button onclick="window.location='m_company team.php';" class="btn btn-secondary btn-block"><i class="fa fa-pencil"></i> Update Company Team</button>
    <button onclick="window.location='m_about us.php';" class="btn btn-secondary btn-block"><i class="fa fa-pencil"></i> Update About Us</button>
    <button onclick="window.location='m_online banks.php';" class="btn btn-secondary btn-block"><i class="fa fa-pencil"></i> Update Online Banks Displayed in Checkout Page</button>
    <button onclick="window.location='m_ilaw gallery.php';" class="btn btn-secondary btn-block"><i class="fa fa-pencil"></i> Update ILAW Gallery</button>
    <button onclick="window.location='m_reviews.php';" class="btn btn-secondary btn-block"><i class="fa fa-pencil"></i> Update Rate and Reviews</button>
    <button onclick="window.location='m_instruction.php';" class="btn btn-secondary btn-block"><i class="fa fa-pencil"></i> Update Shopping Instruction</button>
<?php
    include("footer.php")
?>
</div>
