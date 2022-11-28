<?php
if (isset($_SESSION['type'])) {
    if ($_SESSION['type'] == 'user') {
        header('location: ../index.php');
        die();
    } 
  }else {
    $active = " ";
    header('location: dashboard.php');
    die();
  }
  ?>
<!--Footer-->
<div class="row mt-5 mb-4 footer">
    <div class="col-sm-8">
        <span>&copy; All rights reserved 2021 developed by <a class="text-info" href="#">LBL Company</a></span>
    </div>
</div>

<!--Footer-->


