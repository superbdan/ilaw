<?php
include('database_connection.php');




if ($_POST['btn_action'] == 'view_user') {
    $output = "";
    $query = "SELECT * FROM customer_order 
    INNER JOIN user_details ON customer_order.customer_id = user_details.user_id
    INNER JOIN couriers ON customer_order.courier = couriers.courier_id
    INNER JOIN table_province ON customer_order.province = table_province.province_id
    INNER JOIN table_municipality ON customer_order.city = table_municipality.municipality_id
    INNER JOIN table_region ON customer_order.region = table_region.region_id
    WHERE transaction_id = :transaction_id";
    $statement = $connect->prepare($query);
    $statement->execute(
        array(
            ':transaction_id'    =>    $_POST['transaction_id']
        )
    );
    $result = $statement->fetchAll();
    $output .= '  
    <div class="table-responsive">  
          <table class="table table-bordered">';
    foreach ($result as $row) {


        $output .= ' 
        
        <tr>  
			<td width="30%"><label><b>Profile Picture</b></label></td>  
			<td width="60%"><img src="../images/user-img/' . $row["profile"] . '" width="100" id="img2_db" </td> 
		</tr>  
        <tr>  
            <td width="30%"><label><b>User ID</b></label></td>  
            <td width="70%">' . $row["user_id"] . '</td> 
        </tr>  
        <tr>  
             <td width="30%"><label><b>Name</b></label></td>  
             <td width="70%">' . $row["first_name"] . '' . $row['middle_name'] . ' ' . $row['last_name'] . '</td>  
        </tr> 
        <tr>  
            <td width="30%"><label><b>Address</b></label></td>  
            <td width="70%">' . $row["home_address"] . ' ' . $row["municipality_name"] . ', ' . $row["province_name"] . ', ' . $row["region_name"] . ', ' . $row['zip_code'] . '</td> 
        </tr> 
        <tr>  
            <td width="30%"><label><b>Contact No.</b></label></td>  
            <td width="70%">' . $row["user_contact"] . '</td> 
        </tr>  
        <tr>  
            <td width="30%"><label><b>Courier Preffered</b></label></td>  
            <td width="70%">' . $row["courier_name"] . '</td> 
        </tr> 
        <tr>  
        <td width="30%"><label><b>Mode of Payment</b></label></td>  
        <td width="70%">' . $row['payment_method'] . '</td> 
    </tr> 
             
   ';
    }
    $output .= '  
          </table>  
     </div>  
     ';
    echo $output;
}


if ($_POST['btn_action'] == 'view_order') {
    $output = "";
    $query = "SELECT * FROM customer_order_product WHERE transaction_id = :transaction_id";
    $statement = $connect->prepare($query);
    $statement->execute(
        array(
            ':transaction_id'    =>    $_POST["transaction_id"]
        )
    );
    $result = $statement->fetchAll();
    $output .= '  
    <div class="table-responsive"> 
        <table class="table table-bordered">
        <tr class="bg-secondary text-white">
          <th>Transaction ID</th>
          <th>Product Name</th>
          <th>Unit</th>
          <th>Quantity</th>
          <th>Price</th>
          <th>Total</th>
        </tr>';

    foreach ($result as $row) {
        $output .= ' 
        <tr>  
            <td>' . $row["transaction_id"] . '</td>
            <td>' . $row["product_name"] . '</td>  
            <td>' . $row["unit"] . '</td> 
            <td>' . $row["quantity"] . '</td>
            <td>' . $row["price"] . '</td>
            <td>' . $row["total"] . '</td>
        </tr> 
		
    
             
   ';
    }
    $output .= '  
          </table>  
     </div>  
     ';
    echo $output;
}
