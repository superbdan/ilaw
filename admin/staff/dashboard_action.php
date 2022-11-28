<?php
include('database_connection.php');




if ($_POST['btn_action'] == 'view_user') {
    $review = $_POST['review'];
    $output = "";
    $query = "SELECT *
    FROM user_details
    inner JOIN review_table ON user_details.user_id = review_table.user_id
    Where review_id = '$review'";
    $statement = $connect->prepare($query);
    $statement->execute(
        array(
            ':user_id'    =>    $_POST["user_id"]
        )
    );
    $result = $statement->fetchAll();
    $output .= '  
    <div class="table-responsive">  
          <table class="table table-bordered">';
    foreach ($result as $row) {
        $output .= ' 
          
    <tr>  
             <td width="30%"><label><b>Name</b></label></td>  
             <td width="70%">' . $row["first_name"] . ' ' . $row['middle_name'] . ' ' . $row['last_name'] . '</td>  
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
