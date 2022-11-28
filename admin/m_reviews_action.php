<?php

include('database_connection.php');
$user = $_SESSION['type'];
if (isset($_POST['btn_action'])) {

	// if ($_POST['btn_action'] == 'fetch_single') {
	// 	$query = "
	// 	SELECT * FROM reviews_table WHERE review_id = :review_id
	// 	";
	// 	$statement = $connect->prepare($query);
	// 	$statement->execute(
	// 		array(
	// 			':review_id'	=>	$_POST["review_id"]
	// 		)
	// 	);
	// 	$result = $statement->fetchAll();
	// 	foreach ($result as $row) {
	// 		$output['user_name'] = $row['user_name'];
	// 		$output['user_id'] = $row['user_id'];
	// 		$output['user_rating'] = $row['user_rating'];
	// 		$output['title_review'] = $row['title_review'];
	// 		$output['review_img'] = $row['review_img'];
	// 	}
	// 	echo json_encode($output);
	// }

	if ($_POST['btn_action'] == 'delete') {
		$query = "
		DELETE FROM review_table WHERE review_id = :review_id
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':review_id'		=>	$_POST["review_id"]
			)
		);
		$logquery = "
		INSERT INTO logs (action, user) 
		VALUES (:review_id, :user_name)
		";
		$logstmt = $connect->prepare($logquery);
		$logstmt->execute(
			array(
				':review_id'                => 'Deleted a Review',
				':user_name'                =>    $user,
			)
		);
		$result = $statement->fetchAll();
		if (isset($result)) {
			echo 'A Review has been Removed!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
		}
	}
}
