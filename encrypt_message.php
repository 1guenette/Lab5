<?php
session_start();
include_once 'phpseclib/Crypt/RSA.php';
require_once 'config.php';

$sender = $_SESSION['name'];
$receiver = $_REQUEST['rec'];
$msg = $_REQUEST['msg'];
$sql = mysqli_query($conn, "SELECT publickey FROM $db_table WHERE username = '$receiver'");

$sqli = mysqli_fetch_array($sql);

$key = base64_decode($sqli[0]);
$rsa = new Crypt_RSA();
$rsa->loadKey($key);
$message = $rsa->encrypt($msg);

if ($message != "") {

    $message = base64_encode($message);

    $query_insert = "INSERT INTO $db_table3(receiver, sender, encrypted_m) VALUES('$receiver', '$sender', '$message')";
    mysqli_query($conn, $query_insert);
    echo "Message sent";

} else {
    echo "That user does not exist";
}

$conn->close();

