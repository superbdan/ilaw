<?php
include("../connection.php");

if (isset($_POST['itemsId'])) {
    $courierId = $_POST['itemsId'];
    $query = mysqli_query($con, "select * from items where items_id ='$itemsId'");
    while ($row = mysqli_fetch_assoc($query)) {
        $item_price['items_price'] =  $row["items_price"];
        
        echo json_encode($item_price);
        // echo '<option value="'.$row["courier_fee"].'">'.$row["courier_fee"].'</option>';
    }
}

if (isset($_POST['prod'])) {
    $prod = $_POST['prod'];
    $query = mysqli_query($con, "select * from items 
    inner JOIN category on items.category_id = category.category_id
    where items_name ='$prod'");
    while ($row = mysqli_fetch_assoc($query)) {
        $item_price['items_price'] =  $row["items_price"];
        $item_price['category_name'] = $row['category_name'];
        // echo '<option value="'.$row["courier_fee"].'">'.$row["courier_fee"].'</option>';
    }
    echo json_encode($item_price);
}
