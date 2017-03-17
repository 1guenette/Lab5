<?php
include_once('phpseclib/Crypt/RSA.php');

//Function for encrypting with RSA
function rsa_encrypt($string, $public_key)
{
    //Create an instance of the RSA cypher and load the key into it
    $cipher = new Crypt_RSA();
    $cipher->loadKey($public_key);
    //Set the encryption mode
    $cipher->setEncryptionMode(CRYPT_RSA_ENCRYPTION_PKCS1);
    //Return the encrypted version
    return $cipher->encrypt($string);
}

//Function for decrypting with RSA
function rsa_decrypt($string, $private_key)
{
    //Create an instance of the RSA cypher and load the key into it
    $cipher = new Crypt_RSA();
    $cipher->loadKey($private_key);
    //Set the encryption mode
    $cipher->setEncryptionMode(CRYPT_RSA_ENCRYPTION_PKCS1);
    //Return the decrypted version
    return $cipher->decrypt($string);
}

$rsa = new Crypt_RSA();
$rsa->setPrivateKeyFormat(CRYPT_RSA_PRIVATE_FORMAT_PKCS1);
$rsa->setPublicKeyFormat(CRYPT_RSA_PUBLIC_FORMAT_PKCS1);
extract($rsa->createKey(1024)); /// makes $publickey and $privatekey available

/*
   Change the following variables
   to match your local/live serv-
   er, mySQL database, and mySQL
   table. As well as the proper
   credentials.
*/

require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $name = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM $db_table WHERE username = '$name'");


    if (mysqli_num_rows($query) > 0) {

        $redir = "signUp.php";
        $message = "This account name already exists!";

    } else {

        $query_insert = "INSERT INTO $db_table (username, password, privatekey, publickey, admin) 
        VALUES ('$name', '$password', '$privatekey', '$publickey', False)"; //NOTE: check for valid column names

        //Querying the information
        mysqli_query($conn, $query_insert);

        $redir = "index.html";
        $message = "Account has been created!";

    }

    //Redirects with success or failure message
    echo "<script>", "alert('$message');", "window.location.href='$redir';", "</script>";

}

$conn->close();
?>

<!--BEGIN HTML-->
<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
<div class="container">
    <form action="signUp.php" method="post">
        <div class="page-header">
            <h3>Sign Up</h3>
        </div>
        <input placeholder="Enter a Username" type="text" name="username" required>
        <br><br>
        <input placeholder="Enter a Password" type="password" name="password" required>
        <br><br>
        <input type="submit" class="btn btn-success" id="submit">
    </form>

    <p id="desc"></p>
</div>
</body>
</html>
