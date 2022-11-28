<?php  
//  load_data.php  
 $connect = mysqli_connect("localhost", "root", "", "database");  
 $output = '';  
 if(isset($_POST["brand_id"]))  
 {  
      if($_POST["brand_id"] != '')  
      {  
           $sql = "SELECT items_price FROM items WHERE items_name = '".$_POST["brand_id"]."'";  
      }  
      else  
      {  
           $sql = "SELECT * FROM items";  
      }  
      $result = mysqli_query($connect, $sql);  
    
      $output = $row["items_price"];  
      
      return $output;  
 }  
//  ?>