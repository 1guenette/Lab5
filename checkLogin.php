<?php
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

	
	$name = $_REQUEST["u"];
	$password = $_REQUEST["p"];
	if ($_SERVER["REQUEST_METHOD"] == "GET") 
	{
  		$name = $_GET["userName"];
  		$password = $_GET["password"];
 		
  		$sql = "SELECT userName, password, admin, publicKey, privateKey FROM Database WHERE userName = $name AND password = $password ";
		$result = $conn->query($sql);

		if($result->num_rows > 0 )
		{
		//Storing JSON data:
			$myObj->name = $name;
			$myObj->password = $password;
			$myObj->admin = $result->admin;
			$myObj->publicKey= $result->publicKey;
			$myObj->privateKey = $result->privateKey;
			
			$myJSON = json_encode($myObj);
			echo $myJSON;
		
		
		//redirects to post page
		header("Location: viewPosts.html");
	   		exit;
		}
		else
		{
			header("Location: login.html");
    		exit;
		}
	}

?>