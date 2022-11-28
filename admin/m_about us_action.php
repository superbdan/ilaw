<?php

//supplier_action.php

include('database_connection.php');
$user = $_SESSION['type'];
if (isset($_POST['btn_action'])) {

    if ($_POST['btn_action'] == 'Add') {


        $query = "
		UPDATE about set history = :history, culture = :culture, mission = :mission, vision = :vision
		WHERE id = :id
		";

        $statement = $connect->prepare($query);
        $statement->execute(
            array(

                ':history'    =>    $_POST["mhistory"],
                ':culture'    =>    $_POST["mculture"],
                ':mission'    =>    $_POST["mmission"],
                ':vision'    =>    $_POST["mvision"],
                ':id' => $_POST["id"]


            )
        );
        $logquery = "
		INSERT INTO logs (action, user) 
		VALUES (:transaction_id, :user)
		";
        $logstmt = $connect->prepare($logquery);
        $logstmt->execute(
            array(
                ':transaction_id'                => 'Edited About Us',
                ':user'                =>    $user,
            )
        );
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'About Updated Successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
        }
    }
}
