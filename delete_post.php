<?php

session_start();

require_once 'config.php';

$desc = $_REQUEST['msg'];

$query_delete = "DELETE FROM $db_table2 WHERE description = '$desc'";

mysqli_query($conn, $query_delete);

$conn->close();

