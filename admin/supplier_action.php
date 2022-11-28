<?php

//supplier_action.php

include('database_connection.php');
$user = $_SESSION['type'];
if (isset($_POST['btn_action'])) {
	if ($_POST['btn_action'] == 'Add') {
		$target_dir = "supplier_images/";
		$fileTmpPath = $_FILES['supplier_img']['tmp_name'];
		$target_file = $target_dir . basename($_FILES["supplier_img"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
		// Check if image file is a actual image or fake image
		if (move_uploaded_file($fileTmpPath, $target_file)) {
			$message = 'File is successfully uploaded.';
		} else {
			$message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
		}
		$supplier_img	=	basename($_FILES["supplier_img"]["name"]);


		$query = "
		INSERT INTO suppliers (supplier_img, supplier_name, contact_no, address) 
		VALUES (:supplier_img, :supplier_name, :contact_no, :address)
		";

		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':supplier_img'	=>	basename($_FILES["supplier_img"]["name"]),
				':supplier_name'	=>	$_POST["supplier_name"],
				':contact_no'	=>	$_POST["contact_no"],
				':address'	=>	$_POST["address"]

			)
		);
		$logquery = "
		INSERT INTO logs (action, user) 
		VALUES (:transaction_id, :user)
		";
		$logstmt = $connect->prepare($logquery);
		$logstmt->execute(
			array(
				':transaction_id'                => 'Added Supplier ' . $_POST["supplier_name"] . '',
				':user'                =>    $user,
			)
		);
		$result = $statement->fetchAll();
		if (isset($result)) {
			echo 'Supplier Added Successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
		}
	}

	if ($_POST['btn_action'] == 'fetch_single') {
		$query = "
		SELECT * FROM suppliers WHERE supplier_id = :supplier_id
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':supplier_id'	=>	$_POST["supplier_id"]
			)
		);
		$result = $statement->fetchAll();
		foreach ($result as $row) {
			$output['supplier_img'] = $row['supplier_img'];
			$output['supplier_name'] = $row['supplier_name'];
			$output['contact_no'] = $row['contact_no'];
			$output['address'] = $row['address'];
		}
		echo json_encode($output);
	}

	if ($_POST['btn_action'] == 'Edit') {
		$target_dir = "supplier_images/";
		$fileTmpPath = $_FILES['supplier_img']['tmp_name'];
		$target_file = $target_dir . basename($_FILES["supplier_img"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
		// Check if image file is a actual image or fake image
		if (move_uploaded_file($fileTmpPath, $target_file)) {
			$message = 'File is successfully uploaded.';
		} else {
			$message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
		}
		$supplier_img	=	basename($_FILES["supplier_img"]["name"]);

		$query = "
		UPDATE suppliers set 
		supplier_img = :supplier_img,
		supplier_name = :supplier_name, 
		contact_no = :contact_no, 
		address = :address
		WHERE supplier_id = :supplier_id
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':supplier_img'	=>	basename($_FILES["supplier_img"]["name"]),
				':supplier_name'	=>	$_POST["supplier_name"],
				':contact_no'	=>	$_POST["contact_no"],
				':address'	=>	$_POST["address"],
				':supplier_id'		=>	$_POST["supplier_id"]
			)
		);
		$logquery = "
		INSERT INTO logs (action, user) 
		VALUES (:transaction_id, :user)
		";
		$logstmt = $connect->prepare($logquery);
		$logstmt->execute(
			array(
				':transaction_id'                => 'Updated a Supplier ' . $_POST["supplier_name"] . '',
				':user'                =>    $user,
			)
		);
		$result = $statement->fetchAll();
		if (isset($result)) {
			echo 'Supplier Edited Successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
		}
	}

	if ($_POST['btn_action'] == 'change') {
		$status = 'Active';
		if ($_POST['status'] == 'active') {
			$status = 'Inactive';
		}
		$query = "
		UPDATE suppliers
		SET supplier_status = :supplier_status 
		WHERE supplier_id = :supplier_id
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':supplier_status'	=>	$status,
				':supplier_id'		=>	$_POST["supplier_id"]
			)
		);
		$logquery = "
		INSERT INTO logs (action, user) 
		VALUES (:transaction_id, :user)
		";
		$logstmt = $connect->prepare($logquery);
		$logstmt->execute(
			array(
				':transaction_id'                => 'Changed A Supplier Status',
				':user'                =>    $user,
			)
		);
		$result = $statement->fetchAll();
		if (isset($result)) {
			echo 'Supplier Status Changed to <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>' . $status;
		}
	}

	if ($_POST['btn_action'] == 'delete') {
		$query = "
		DELETE FROM suppliers WHERE supplier_id = :supplier_id
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':supplier_id'		=>	$_POST["supplier_id"]
			)
		);

		$result = $statement->fetchAll();
		if (isset($result)) {
			echo 'Supplier Removed!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
		}
	}
}
