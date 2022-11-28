<?php

//supplier_action.php

include('database_connection.php');

if (isset($_POST["action"])) {
	$query = "
		SELECT * FROM about
		";
		$statement = $connect->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		foreach($result as $row)
		{
			$output['id'] = $row['id'];
			$output['history'] = $row['history'];
			$output['culture'] = $row['culture'];
			$output['mission'] = $row['mission'];
            $output['vision'] = $row['vision'];
		}
		echo json_encode($output);
}



?>