<?php
$servername = "127.0.0.1";
$database = "u707920109_database";
$username = "u707920109_root";
$password = "Ilawadmin2021";
// Create connection
$con = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
$con->set_charset("utf8");
// echo "Connected successfully";
// mysqli_close($con);
?>
