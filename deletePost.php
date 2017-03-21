<?php
	session_start();
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

	

	$title = $_REQUEST["title"];
	$description = $_REQUEST["description"];
	
	
	$admin = "SELECT admin FROM postDatabase WHERE description=$description, title=$title";
	$conn->query($admin);

	$sql = "DELETE FROM postDatabase WHERE description=$description, title=$title"; 


	if ($_SESSION["name"] == "admin" && $admin == 1)
	{
		$conn->query($sql);
    	echo "New record created successfully";
	} 
	else 
	{
    	echo "Error: " . $sql . "<br>" . $conn->error;
	}

$conn->close();

		
	

?>