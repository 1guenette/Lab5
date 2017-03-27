<?php

session_start();

require_once 'config.php';

$usr = $_SESSION["name"];
$time_stamp = $_REQUEST['time'];
$title = $_REQUEST['t'];
$description = $_REQUEST['d'];

$query_insert = "INSERT INTO $db_table2(title, description, usr, post_time) VALUES('$title', '$description', '$usr', '$time_stamp')";

mysqli_query($conn, $query_insert);


$conn->close();


