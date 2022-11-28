<?php
include('database_connection.php');




if ($_POST['btn_action'] == 'view_user') {
    $output = "";
    $query = "SELECT *
    FROM review_table
    LEFT JOIN user_details ON review_table.user_id = user_details.user_id
    where review_id = :review_id";
    $statement = $connect->prepare($query);
    $statement->execute(
        array(
            ':review_id'    =>    $_POST['review']
        )
    );
    $result = $statement->fetchAll();
    $output .= '  
    <div class="table-responsive">  
          <table class="table table-bordered">';
    foreach ($result as $row) {
        if (isset($row['profile']) == "") {
            $profile = 'Anonymous.png';
            $name = 'Anonymous';
        } else {
            $profile = $row['profile'];
            $name =  $row["first_name"] . ' ' . $row['middle_name'] . ' ' . $row['last_name'];
        }


        $output .= ' 
        <tr>  
			<td width="30%"><label><b>Profile Picture</b></label></td>  
			<td width="60%"><img src="../images/user-img/' . $profile . '" width="100" id="img2_db" </td> 
		</tr> 
        <tr>  
             <td width="30%"><label><b>Name</b></label></td>  
             <td width="70%">' . $name . '</td>  
        </tr> 
        <tr>  
            <td width="30%"><label><b>Title</b></label></td>  
            <td width="70%">' . $row["title_review"] . '</td> 
        </tr> 
        <tr>  
            <td width="30%"><label><b>Feedback</b></label></td>  
            <td width="70%">' . $row["user_review"] . '</td> 
        </tr>  
     
    </tr> 
             
   ';
    }
    $output .= '  
          </table>  
     </div>  
     ';
    echo $output;
}
