<?php

session_start();

require_once 'config.php';



$name = $_POST["username"];
$password = $_POST["password"];

$sql = "SELECT * FROM $db_table WHERE userName = '$name' AND password = '$password' ";
$query = mysqli_query($conn, $sql);
$row = mysqli_num_rows($query);
$fet_info = mysqli_fetch_assoc($query);

if ($row == 1) {

    $_SESSION["name"] = $fet_info["username"];
    $_SESSION['admin'] = $fet_info['admin'];
    $_SESSION['pub'] = $fet_info['publickey'];
    $_SESSION['pri'] = $fet_info['privatekey'];


    $message = "Success!";
    $redir = "viewPosts.php";

} else {

    $message = "Incorrect username or password!";
    $redir = "index.html";
}

echo "<script>", "alert('$message');", "window.location.href='$redir';", "</script>";
