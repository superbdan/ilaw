<?php
//database_connection.php

$connect = new PDO('mysql:host=localhost;dbname=u707920109_database', 'u707920109_root', 'Ilawadmin2021');
$connect->exec("set names utf8mb4");
session_start();

?>
