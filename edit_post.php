<?php

require_once 'config.php';

$edited_prompt = $_REQUEST['upd_post'];
$post_to_update = $_REQUEST['msg'];

$query_update = "UPDATE $db_table2 SET description = '$edited_prompt' WHERE description = '$post_to_update'";

mysqli_query($conn, $query_update);

$conn->close();
