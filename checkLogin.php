<?php

/*
   Change the following variables
   to match your local/live serv-
   er, mySQL database, and mySQL
   table. As well as the proper
   credentials.
*/
$server = "localhost";
$username = "root";
$password = "password";
$db_name = "accounts_for_lab5";
$db_table = "accounts";

// Create connection
$conn = new mysqli($server, $username, $password, $db_name) or die("Cannot connect to server");

$name = $_REQUEST["u"];
$password = $_REQUEST["p"];


if ($_SERVER["REQUEST_METHOD"] == "GET") {
    session_start();
    $name = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM $db_table WHERE userName = '$name' AND password = '$password' ";
    $query = mysqli_query($conn, $sql);

    if (mysqli_num_rows($query) > 0) {


        //Storing JSON data:
        $myObj->name = $name;
        $myObj->password = $password;
        $myObj->admin = $result->admin;
        $myObj->publicKey = $result->publicKey;
        $myObj->privateKey = $result->privateKey;

        $myJSON = json_encode($myObj);
        echo $myJSON;

        $message = "Success!";
        $redir = "viewPosts.html";

    } else {
        $message = "Incorrect username or password!";
        $redir = "login.html";
    }

    echo "<script>", "alert('$message');", "window.location.href='$redir';", "</script>";
}
