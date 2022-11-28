<?php

//items_action.php

include('database_connection.php');
$user = $_SESSION['type'];
$user_name = $_SESSION['name'];
if(isset($_POST['btn_action']))
{
	if($_POST['btn_action'] == 'Add')
	{
		//upload
		$target_dir = "product_images/";
		$uploadOk = 1;
		$imgname = $_FILES["product_img1"]["name"];
		$imageFileType = strtolower(pathinfo($imgname,PATHINFO_EXTENSION));
		$randomno=rand(0,100000);
		$rename='Product'.date('Ymd').$randomno;
		$newname=$rename.'.'.$imageFileType;
		$fileTmpPath = $_FILES['product_img1']['tmp_name'];
		$target_file = $target_dir . $newname;
		// Check if image file is a actual image or fake image
		if(move_uploaded_file($fileTmpPath, $target_file))
		{
		  $message ='File is successfully uploaded.';
		}
		else
		{
		  $message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
		}

		//upload
		$target_dir2 = "product_images/";
		$uploadOk = 1;
		$imgname2= $_FILES["product_img2"]["name"];
		$imageFileType2= strtolower(pathinfo($imgname,PATHINFO_EXTENSION));
		$randomno2=rand(0,100000);
		$rename2='Product'.date('Ymd').$randomno2;
		$newname2=$rename2.'.'.$imageFileType2;
		$fileTmpPath2 = $_FILES['product_img2']['tmp_name'];
		$target_file2 = $target_dir2 . $newname2;
		// Check if image file is a actual image or fake image
		if(move_uploaded_file($fileTmpPath2, $target_file2))
		{
		  $message ='File is successfully uploaded.';
		}
		else
		{
		  $message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
		}


		$items_name = $_POST["items_name"];
		$item_descript = $_POST["item_descript"];
		$category_id	=	$_POST["category_id"];
		$items_cost	=	$_POST["items_cost"];
		$items_price	=	$_POST["items_price"];
		$items_stocks	=	$_POST["items_stocks"];
		$target_stocks	=	$_POST["target_stocks"];
		$items_low	=	$_POST["items_low"];
		$supplier_id	=	$_POST["supplier_id"];
		$measurement_id	=	$_POST["measurement_id"];
		$product_img1	=	basename($_FILES["product_img1"]["name"]);
		$product_img2	=	basename($_FILES["product_img2"]["name"]);
		$stock_status;
		if ($items_stocks >= $target_stocks) {
			$stock_status = "Full";
		} elseif ($items_stocks <= $items_low * 2) {
			$stock_status = "Warning";
		} elseif ($items_stocks <= $items_low) {
			$stock_status = "Critical";
		} else {
			$stock_status = "Good";
		}

		$query = "
		INSERT INTO items (items_name, item_descript, category_id, items_cost, items_price, items_stocks, target_stocks, items_low, supplier_id, measurement_id, product_img1, product_img2, items_status, stock_status) 
		VALUES (:items_name, :item_descript, :category_id, :items_cost, :items_price, :items_stocks, :target_stocks, :items_low, :supplier_id, :measurement_id, :product_img1, :product_img2, 'active', :stock_status)
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':items_name'	=>	$_POST["items_name"],
				':item_descript'	=>	$_POST["item_descript"],
				':category_id'	=>	$_POST["category_id"],
				':items_cost'	=>	$_POST["items_cost"],
				':items_price'	=>	$_POST["items_price"],
				':items_stocks'	=>	$_POST["items_stocks"],
				':target_stocks'	=>	$_POST["target_stocks"],
				':items_low'	=>	$_POST["items_low"],
				':supplier_id'	=>	$_POST["supplier_id"],
				':measurement_id'	=>	$_POST["measurement_id"],
				':product_img1'	=>	$newname,
				':product_img2'	=>	$newname2,
				':stock_status'	=>	$stock_status

			)
		);
		$logquery = "
		INSERT INTO logs (action, user) 
		VALUES (:transaction_id, :user)
		";
        $logstmt = $connect->prepare($logquery);
        $logstmt->execute(
            array(
                ':transaction_id'                => 'Added New Item '.$_POST["items_name"].'',
                ':user'                =>    $user,
            )
        );
		$result = $statement->fetchAll();
		if(isset($result))
		{
			echo 'Item Added Successfully! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
		}
	}

	if($_POST['btn_action'] == 'Add_stock')
	{
		
		$items_status;
		$stocks_latest;
		$items_id = $_POST["items_id"];
		$query = "SELECT * FROM items WHERE items_id = :items_id";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':items_id'	=>	$_POST["items_id"]
			)
		);
		$result = $statement->fetchAll();
		foreach($result as $row)
		{
			$items_name = $row["items_name"];
			$items_stocks = $row["items_stocks"];
            $items_low = $row["items_low"];
            $target_stocks = $row["target_stocks"];
		}
		$quantity = $_POST["quantity"];
		$stocks_latest = $quantity + $items_stocks;
		$stock_status;
		if ($stocks_latest >= $row["target_stocks"] ){
			$stock_status = "Full";
		} elseif ($stocks_latest <= $row["items_low"]){
			$stock_status = "Critical"; 
		} elseif ($stocks_latest <= ($row["items_low"] * 2)){
			$stock_status = "Warning";
		} else {
			$stock_status = "Good";
		}
		
		$query = "
		UPDATE items set
		items_stocks = :items_stocks,
		stock_status = :stock_status
		WHERE items_id = :items_id
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(	
				':stock_status'	=>	$stock_status,	
				':items_stocks'	=>	$stocks_latest,
				':items_id'		=>	$_POST["items_id"],
			)
		);

		if ($user=='master'){
			$user_type = 'Admin: ';
		} elseif ($user=='staff'){
			$user_type = 'Staff: ';
		} else{
			$user_type = 'Customer: ';
		}


		$stock_logs = "
		INSERT INTO stock_logs (item_name, stock_quantity, incharge, type, activity) 
		VALUES (:item_name, :quantity, :user, '1', 'added stock')
		";
        $stockstmt = $connect->prepare($stock_logs);
        $stockstmt->execute(
            array(
                ':item_name'                => $items_name,
                ':user'                =>    $user_type.''.$user_name,
				':quantity'                =>    $quantity,
            )
        );


		$logquery = "
		INSERT INTO logs (action, user) 
		VALUES (:transaction_id, :user)
		";
        $logstmt = $connect->prepare($logquery);
        $logstmt->execute(
            array(
                ':transaction_id'                => 'Added '.$quantity.' Stocks on Item '.$items_name.'',
                ':user'                =>    $user,
            )
        );
		$result = $statement->fetchAll();
		if(isset($result))
		{
			echo 'Stocks added Successfully! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
		}
	}
	if($_POST['btn_action'] == 'fetch_single')
	{
		$query = "SELECT * FROM items WHERE items_id = :items_id";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':items_id'	=>	$_POST["items_id"]
			)
		);
		$result = $statement->fetchAll();
		foreach($result as $row)
		{
			$output['image1'] = $row['product_img1'];
			$output['image2'] = $row['product_img2'];
			$output['items_name'] = $row['items_name'];
			$output['item_descript'] = $row['item_descript'];
			$output['category_id'] = $row['category_id'];
			$output['items_cost'] = $row['items_cost'];
			$output['items_price'] = $row['items_price'];
			$output['target_stocks'] = $row['target_stocks'];
			$output['items_low'] = $row['items_low'];
			$output['supplier_id'] = $row['supplier_id'];
			$output['measurement_id'] = $row['measurement_id'];
			$output['items_stocks'] = $row['items_stocks'];
			$output['stock_status'] = $row['stock_status'];
		}
		echo json_encode($output);
	}

	if($_POST['btn_action'] == 'Edit')
	{
		//upload
		$target_dir = "product_images/";
		$uploadOk = 1;
		$imgname = $_FILES["product_img1"]["name"];
		$imageFileType = strtolower(pathinfo($imgname,PATHINFO_EXTENSION));
		$randomno=rand(0,100000);
		$rename='Product'.date('Ymd').$randomno;
		$newname=$rename.'.'.$imageFileType;
		$fileTmpPath = $_FILES['product_img1']['tmp_name'];
		$target_file = $target_dir . $newname;
		// Check if image file is a actual image or fake image
		if(move_uploaded_file($fileTmpPath, $target_file))
		{
		  $message ='File is successfully uploaded.';
		}
		else
		{
		  $message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
		}

		//upload
		$target_dir2 = "product_images/";
		$uploadOk = 1;
		$imgname2= $_FILES["product_img2"]["name"];
		$imageFileType2= strtolower(pathinfo($imgname,PATHINFO_EXTENSION));
		$randomno2=rand(0,100000);
		$rename2='Product'.date('Ymd').$randomno2;
		$newname2=$rename2.'.'.$imageFileType2;
		$fileTmpPath2 = $_FILES['product_img2']['tmp_name'];
		$target_file2 = $target_dir2 . $newname2;
		// Check if image file is a actual image or fake image
		if(move_uploaded_file($fileTmpPath2, $target_file2))
		{
		  $message ='File is successfully uploaded.';
		}
		else
		{
		  $message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
		}

		$stock_status;
		if ($_POST["items_stocks"] >= $_POST["target_stocks"] ){
			$stock_status = "Full";
		} elseif ($_POST["items_stocks"] <= $_POST["items_low"]){
			$stock_status = "Critical";
		} elseif ($_POST["items_stocks"] <= ($_POST["items_low"] * 2)){
			$stock_status = "Warning";
		} elseif ($_POST["items_stocks"] <= $_POST["items_low"]){
			$stock_status = "Critical";
		} else {
			$stock_status = "Good";
		}
		
		$query = "
		UPDATE items set items_name = :items_name,
		item_descript = :item_descript,
		category_id = :category_id,
		items_cost = :items_cost,
		items_price = :items_price,
		items_stocks = :items_stocks,
		target_stocks = :target_stocks,
		items_low = :items_low,
		supplier_id = :supplier_id,
		measurement_id = :measurement_id,
		product_img1 = :product_img1,
		product_img2 = :product_img2,
		stock_status = :stock_status
		WHERE items_id = :items_id
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(	
				':stock_status'	=>	$stock_status,	
				':measurement_id'	=>	$_POST["measurement_id"],
				':supplier_id'	=>	$_POST["supplier_id"],
				':target_stocks'	=>	$_POST["target_stocks"],
				':items_low'	=>	$_POST["items_low"],
				':items_stocks'	=>	$_POST["items_stocks"],
				':items_price'	=>	$_POST["items_price"],
				':items_cost'	=>	$_POST["items_cost"],
				':category_id'	=>	$_POST["category_id"],
				':item_descript' =>	$_POST["item_descript"],
				':items_name'	=>	$_POST["items_name"],
				':items_id'		=>	$_POST["items_id"],
				':product_img1'	=>	$newname,
				':product_img2'	=>	$newname2
			)
		);
		$logquery = "
		INSERT INTO logs (action, user) 
		VALUES (:transaction_id, :user)
		";
        $logstmt = $connect->prepare($logquery);
        $logstmt->execute(
            array(
                ':transaction_id'                => 'Updated Item '.$_POST["items_name"].'',
                ':user'                =>    $user,
            )
        );
		$result = $statement->fetchAll();
		if(isset($result))
		{
			echo 'Item Edited Successfully! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
		}
	}
	if($_POST['btn_action'] == 'delete')
	{
		$query = "
		DELETE FROM items 
		WHERE items_id = :items_id
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':items_id'		=>	$_POST["items_id"]
			)
		);
		$logquery = "
		INSERT INTO logs (action, user) 
		VALUES (:transaction_id, :user)
		";
        $logstmt = $connect->prepare($logquery);
        $logstmt->execute(
            array(
                ':transaction_id'                => 'Removed an Item',
                ':user'                =>    $user,
            )
        );
		$result = $statement->fetchAll();
		if(isset($result))
		{
			echo 'Item Removed! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
		}
	}

	if($_POST['btn_action'] == 'View')  
	{
		$output = '';   
		$query = $connect->prepare("SELECT * FROM items 
		INNER JOIN category ON category.category_id = items.category_id 
		INNER JOIN suppliers ON suppliers.supplier_id = items.supplier_id
		INNER JOIN measurement ON measurement.measurement_id = items.measurement_id WHERE items_id = :items_id");  
		$query->execute(
			 array(':items_id'		=>	$_POST["items_id"]));
		$output .= '  
		<div class="table-responsive">  
			  <table class="table table-bordered">';  
		while($row = $query->fetch(PDO::FETCH_ASSOC)){
		 {  
			$output .= '  
			<tr>  
				 <td width="30%"><label><b>Item Name</b></label></td>  
				 <td width="70%">'.$row["items_name"].'</td>  
			</tr>
			<tr>  
				 <td width="30%"><label><b>Item Description</b></label></td>  
				 <td width="70%">'.$row["item_descript"].'</td>  
			</tr> 
			<tr>  
				 <td width="30%"><label><b>Category</b></label></td>  
				 <td width="70%">'.$row["category_name"].'</td>  
			</tr>  
			<tr>  
				 <td width="30%"><label><b>Supplier</b></label></td>  
				 <td width="70%">'.$row["supplier_name"].'</td>  
			</tr>  
			<tr>  
				 <td width="30%"><label><b>Measurement</b></label></td>  
				 <td width="70%">'.$row["measurement_name"].'</td>  
			</tr>  
			<tr>  
				 <td width="30%"><label><b>Stocks</b></label></td>  
				 <td width="70%">'.$row["items_stocks"].'</td>  
			</tr> 
			<tr>  
				 <td width="30%"><label><b>Target Stocks</b></label></td>  
				 <td width="70%">'.$row["target_stocks"].'</td>  
			</tr>  
			<tr>  
				 <td width="30%"><label><b>Low Stock</b></label></td>  
				 <td width="70%">'.$row["items_low"].'</td>  
			</tr>   
			<tr>  
			<td width="30%"><label><b>Cost</b></label></td>  
			<td width="70%">₱'.$row["items_cost"].'</td>  
			 </tr>  
			
			<tr>  
				 <td width="30%"><label><b>Selling Price</b></label></td>  
				 <td width="70%">₱'.$row["items_price"].'</td>  
			</tr> 
			<tr>  
				 <td width="30%"><label><b>Pictures</b></label></td>  
				 <td width="70%"><img src="../admin/product_images/'.$row["product_img1"].'" width="100" id="img2_db" /> <img src="../admin/product_images/'.$row["product_img2"].'" width="100" id="img2_db" /> </td>
				  
			</tr>  
	   ';  
		 }  
	 $output .= '  
			  </table>  
		 </div>  
		 ';  
		 echo $output;
		}
	}
}

?>
