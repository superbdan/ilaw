<?php 
require '../connection.php';
include('database_connection.php');
if (isset($_POST['remove'])) {
    $stmt2 = $connect->prepare('DELETE FROM logs');
    $stmt2->execute();


}