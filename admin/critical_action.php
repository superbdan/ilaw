<?php

//items_action.php

include('database_connection.php');

if(isset($_POST['btn_action']))
{
	if($_POST['btn_action'] == 'Add')
	{
		//upload
		$target_dir = "product_images/";
		$fileTmpPath = $_FILES['product_img1']['tmp_name'];
		$target_file = $target_dir . basename($_FILES["product_img1"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
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
		$fileTmpPath2 = $_FILES['product_img2']['tmp_name'];
		$target_file2 = $target_dir . basename($_FILES["product_img2"]["name"]);
		$uploadOk2 = 1;
		$imageFileType2 = strtolower(pathinfo($target_file2,PATHINFO_EXTENSION));
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
		$items_low	=	$_POST["items_low"];
		$supplier_id	=	$_POST["supplier_id"];
		$measurement_id	=	$_POST["measurement_id"];
		$product_img1	=	basename($_FILES["product_img1"]["name"]);
		$product_img2	=	basename($_FILES["product_img2"]["name"]);

		$query = "
		INSERT INTO items (items_name, item_descript, category_id, items_cost, items_price, items_stocks, items_low, supplier_id, measurement_id, product_img1, product_img2, items_status) 
		VALUES (:items_name, :item_descript, :category_id, :items_cost, :items_price, :items_stocks, :items_low, :supplier_id, :measurement_id, :product_img1, :product_img2, 'active')
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
				':items_low'	=>	$_POST["items_low"],
				':supplier_id'	=>	$_POST["supplier_id"],
				':measurement_id'	=>	$_POST["measurement_id"],
				':product_img1'	=>	basename($_FILES["product_img1"]["name"]),
				':product_img2'	=>	basename($_FILES["product_img2"]["name"])

			)
		);
		$result = $statement->fetchAll();
		if(isset($result))
		{
			echo 'Item Added Successfully! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
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
			$output['items_low'] = $row['items_low'];
			$output['supplier_id'] = $row['supplier_id'];
			$output['measurement_id'] = $row['measurement_id'];
			$output['items_stocks'] = $row['items_stocks'];
		}
		echo json_encode($output);
	}

	if($_POST['btn_action'] == 'Edit')
	{
		//upload
		$target_dir = "product_images/";
		$fileTmpPath = $_FILES['product_img1']['tmp_name'];
		$target_file = $target_dir . basename($_FILES["product_img1"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
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
		$fileTmpPath2 = $_FILES['product_img2']['tmp_name'];
		$target_file2 = $target_dir . basename($_FILES["product_img2"]["name"]);
		$uploadOk2 = 1;
		$imageFileType2 = strtolower(pathinfo($target_file2,PATHINFO_EXTENSION));
		// Check if image file is a actual image or fake image
		if(move_uploaded_file($fileTmpPath2, $target_file2))
		{
		  $message ='File is successfully uploaded.';
		}
		else
		{
		  $message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
		}
		
		$query = "
		UPDATE items set items_name = :items_name,
		item_descript = :item_descript,
		category_id = :category_id,
		items_cost = :items_cost,
		items_price = :items_price,
		items_stocks = :items_stocks,
		items_low = :items_low,
		supplier_id = :supplier_id,
		measurement_id = :measurement_id,
		product_img1 = :product_img1,
		product_img2 = :product_img2
		WHERE items_id = :items_id
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(		
				':measurement_id'	=>	$_POST["measurement_id"],
				':supplier_id'	=>	$_POST["supplier_id"],
				':items_low'	=>	$_POST["items_low"],
				':items_stocks'	=>	$_POST["items_stocks"],
				':items_price'	=>	$_POST["items_price"],
				':items_cost'	=>	$_POST["items_cost"],
				':category_id'	=>	$_POST["category_id"],
				':item_descript' =>	$_POST["item_descript"],
				':items_name'	=>	$_POST["items_name"],
				':items_id'		=>	$_POST["items_id"],
				':product_img1'	=>	basename($_FILES["product_img1"]["name"]),
				':product_img2'	=>	basename($_FILES["product_img2"]["name"])
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