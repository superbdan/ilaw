<?php

//user_action.php

include('database_connection.php');
include('../connection.php');
include('../function.php');
$user = $_SESSION['type'];
if (isset($_POST['btn_action'])) {
	if ($_POST['btn_action'] == 'Add') {
		// $master = 
		// $staff = get_sta
		if ($_POST['user_type'] == 'master') {
			$user_id = get_master_id($con);
		} elseif ($_POST['user_type'] == 'user') {
			$user_id = get_user_id($con);
		} else {
			$user_id = get_staff_id($con);
		}
		$profile = "default_icon.png";
		$password = $_POST['user_password'];
		$encpass = password_hash($password, PASSWORD_DEFAULT);
		$code = "0";
		// $email = $_POST["email"];
		// //prepare the statement
		// $stmt = $pdo->prepare("SELECT * FROM users WHERE email=?");
		// //execute the statement
		// $stmt->execute([$email]);
		// //fetch result
		// $user = $stmt->fetch();
		// if ($user) {
		// 	// email exists
		// } else {
		// 	// email does not exist
		// } 

		$query = "					
		INSERT INTO user_details (user_id, first_name, middle_name, last_name, profile, user_email, region, province, city, home_address, zip_code, user_contact, user_password, user_type, code, user_status) 
		VALUES (:user_id, :first_name, :middle_name, :last_name, :profile, :user_email, :region, :province, :city, :home_address, :zip_code, :user_contact, :user_password, :user_type, :code, :user_status)
		";


		$statement = $connect->prepare($query);
		$statement->execute(


			array(
				':user_id'	=>	$user_id,
				':first_name'	=>	$_POST["first_name"],
				':middle_name'	=>	$_POST["middle_name"],
				':last_name'	=>	$_POST["last_name"],
				':zip_code'	=>	$_POST["zip_code"],
				':profile'	=>	$profile,
				':user_email'	=>	$_POST["email"],
				':region'	=>	$_POST["region"],
				':province'	=>	$_POST["province"],
				':city'	=>	$_POST["city"],
				':home_address'	=>	$_POST["home_address"],
				':user_contact'	=>	$_POST["user_contact"],
				':user_password'	=>	$encpass,
				':user_type'	=>	$_POST["user_type"],
				':code'	=>	$code,
				':user_status'	=>	$_POST["status"],

			)
		);
		$logquery = "
		INSERT INTO logs (action, user) 
		VALUES (:transaction_id, :user)
		";
		$logstmt = $connect->prepare($logquery);
		$logstmt->execute(
			array(
				':transaction_id'                => 'Added a User '.$user_id.'',
				':user'                =>    $user,
			)
		);
		$result = $statement->fetchAll();
		if (isset($result)) {
			echo 'Username added <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
		}
	}

	// if ($_POST['btn_action'] == 'fetch_single') {
	// 	$query = "SELECT * FROM user_details WHERE id = :id";
	// 	$statement = $connect->prepare($query);
	// 	$statement->execute(
	// 		array(
	// 			':id'	=>	$_POST["id"]
	// 		)
	// 	);
	// 	$result = $statement->fetchAll();
	// 	foreach ($result as $row) {
	// 		$output['user_name'] = $row['user_name'];
	// 		$output['user_email'] = $row['user_email'];
	// 		$output['user_contact'] = $row['user_contact'];
	// 		$output['user_address'] = $row['user_address'];
	// 		$output['user_password'] = $row['user_password'];
	// 		$output['user_type'] = $row['user_type'];
	// 		$output['user_status'] = $row['user_status'];
	// 	}
	// 	echo json_encode($output);
	// }
	if ($_POST['btn_action'] == 'update') {
		$status = 'Active';
		if ($_POST['status'] == 'Active') {
			$status = 'Inactive';
		}
		$query = "
		UPDATE user_details 
		SET user_status = :user_status 
		WHERE user_id = :user_id
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':user_status'	=>	$status,
				':user_id'		=>	$_POST["user_id"]
			)
		);
		$logquery = "
		INSERT INTO logs (action, user) 
		VALUES (:transaction_id, :user)
		";
		$logstmt = $connect->prepare($logquery);
		$logstmt->execute(
			array(
				':transaction_id'                => 'Updated '.$_POST["user_id"].' Status',
				':user'                =>    $user,
			)
		);
		$result = $statement->fetchAll();
		if (isset($result)) {
			echo 'User Status Change to <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>' . $status;
		}
	}

	// if ($_POST['btn_action'] == 'Edit') {
	// 	$query = "
	// 	UPDATE user_details set user_name = :user_name,
	// 	user_email = :user_email,
	//     user_contact = :user_contact,
	//     user_address = :user_address,
	//     user_type = :user_type,
	//     user_status = :user_status
	// 	WHERE id = :id
	// 	";
	// 	$statement = $connect->prepare($query);
	// 	$statement->execute(
	// 		array(
	// 			':user_name'	=>	$_POST["user_name"],
	// 			':user_email'	=>	$_POST["user_email"],
	// 			':user_contact'	=>	$_POST["user_contact"],
	// 			':user_address'	=>	$_POST["user_address"],
	// 			':user_type'	=>	$_POST["user_type"],
	// 			':user_status'	=>	$_POST["user_status"],
	// 			':id'	=>	$_POST["id"]
	// 		)
	// 	);
	// 	$result = $statement->fetchAll();
	// 	if (isset($result)) {
	// 		echo 'Username Edited <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
	// 	}
	// }
	if ($_POST['btn_action'] == 'delete') {
		$query = "
		DELETE FROM user_details 
		WHERE user_id = :user_id
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':user_id' =>	$_POST["id"]
			)
		);
		$logquery = "
		INSERT INTO logs (action, user) 
		VALUES (:transaction_id, :user)
		";
		$logstmt = $connect->prepare($logquery);
		$logstmt->execute(
			array(
				':transaction_id'                => 'Removed User '.$_POST["id"].'',
				':user'                =>    $user,
			)
		);
		$result = $statement->fetchAll();
		if (isset($result)) {
			echo 'User ' . $_POST["id"] . ' has been deleted <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
		}
	}
}
