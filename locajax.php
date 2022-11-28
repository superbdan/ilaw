<?php
include('connection.php');
// $conn = mysqli_connect('localhost','root','','database');
// $conn->set_charset("utf8");

if (isset($_POST['regionId'])){
    $RegionId = $_POST['regionId'];
    $query = mysqli_query($con,"select * from table_province where region_id ='$RegionId'");

    while ($row = mysqli_fetch_array($query)){
       
    //    $provinceID = $row = ['region_id'] ;
    //    $province = $row['province_name'];  
       echo '<option value="'.$row["province_id"].'">'.$row["province_name"].'</option>';

    }
}

if (isset($_POST['provinceId'])){
    $provinceId = $_POST['provinceId'];
    $query = mysqli_query($con,"select * from table_municipality where province_id ='$provinceId'");

    while ($row = mysqli_fetch_array($query)){
       
    //    $provinceID = $row = ['region_id'] ;
    //    $province = $row['province_name'];  
       echo '<option value="'.$row["municipality_id"].'">'.$row["municipality_name"].'</option>';

    }
}
?>