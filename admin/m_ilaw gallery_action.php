<?php

//supplier_action.php

include('database_connection.php');
$user = $_SESSION['type'];
if (isset($_POST['btn_action'])) {
	if ($_POST['btn_action'] == 'Add') {
		$target_dir = "ilaw_gallery/";
		$fileTmpPath = $_FILES['gallery_img']['tmp_name'];
		$target_file = $target_dir . basename($_FILES["gallery_img"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
		// Check if image file is a actual image or fake image
		if (move_uploaded_file($fileTmpPath, $target_file)) {
			$message = 'File is successfully uploaded.';
		} else {
			$message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
		}



		$query = "
		INSERT INTO gallery (image, date) 
		VALUES (:image, :date)
		";

		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':image'	=>	basename($_FILES["gallery_img"]["name"]),
				':date'	=>	date("Y-m-d"),

			)
		);
		$logquery = "
		INSERT INTO logs (action, user) 
		VALUES (:transaction_id, :user)
		";
		$logstmt = $connect->prepare($logquery);
		$logstmt->execute(
			array(
				':transaction_id'                => 'Added a Gallery Image',
				':user'                =>    $user,
			)
		);
		$result = $statement->fetchAll();
		if (isset($result)) {
			echo 'A Gallery Image Added Successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
		}
	}


	if ($_POST['btn_action'] == 'change') {
		$status = 'Active';
		if ($_POST['status'] == 'active') {
			$status = 'inactive';
		}
		$query = "
		UPDATE gallery
		SET status = :status 
		WHERE id = :id
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':status'	=>	$status,
				':id'		=>	$_POST["id"]
			)
		);
		$logquery = "
		INSERT INTO logs (action, user) 
		VALUES (:transaction_id, :user)
		";
		$logstmt = $connect->prepare($logquery);
		$logstmt->execute(
			array(
				':transaction_id'                => 'Changed a Gallery Image Status',
				':user'                =>    $user,
			)
		);
		$result = $statement->fetchAll();
		if (isset($result)) {
			echo 'Status Changed to <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>' . $status;
		}
	}


	if ($_POST['btn_action'] == 'delete') {
		$query = "
		DELETE FROM gallery WHERE id = :id
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':id'		=>	$_POST["id"]
			)
		);
		$logquery = "
		INSERT INTO logs (action, user) 
		VALUES (:transaction_id, :user)
		";
		$logstmt = $connect->prepare($logquery);
		$logstmt->execute(
			array(
				':transaction_id'                => 'Removed a Gallery Image',
				':user'                =>    $user,
			)
		);
		$result = $statement->fetchAll();
		if (isset($result)) {
			echo 'Image has been removed!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
		}
	}
}
