<?php

require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    session_start();
    $name = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM $db_table WHERE userName = '$name' AND password = '$password' ";
    $query = mysqli_query($conn, $sql);

    if (mysqli_num_rows($query) > 0) {


//        //Storing JSON data:
//        $myObj->name = $name;
//        $myObj->password = $password;
//        $myObj->admin = $result->admin;
//        $myObj->publicKey = $result->publicKey;
//        $myObj->privateKey = $result->privateKey;
//
//        $myJSON = json_encode($myObj);
//        echo $myJSON;

        $message = "Success!";
        $redir = "viewPosts.html";

    } else {
        $message = "Incorrect username or password!";
        $redir = "index.html";
    }

    echo "<script>", "alert('$message');", "window.location.href='$redir';", "</script>";
}
