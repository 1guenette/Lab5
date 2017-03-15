<?php
	include_once('Crypt/RSA.php');

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
	echo $privatekey;
	echo $publickey;


	


	$servername = "localhost:8080";
	$username = "uwamp";
	$password = "password";
	// Create connection
	$conn = new mysqli($servername, $username, $password);

	// Check connection
	if ($conn->connect_error) 
	{
    	die("Connection failed: " . $conn->connect_error);
	} 
	echo "Connected successfully";

	$name ="";
	$password = "";
	if ($_SERVER["REQUEST_METHOD"] == "POST") 
	{
  		$name = $_POST["userName"];
  		$password = $_POST["password"];


  		
  		$sql = "SELECT userName, password FROM Database WHERE userName = $name AND password = $password ";
		$result = $conn->query($sql);

		if($result->num_rows == 0 )
		{
			$sql = "INSERT INTO Database(userName, password, privateKey, publicKey, admin) VALUES ($name, $password, $privatekey, $publickey, False)"; //NOTE: check for valid column names
			$result = $conn->query($sql);


			header("Location: login.html");
    		exit;
		}
		else
		{
			echo "Invalid";
		}

	}



?>