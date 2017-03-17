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

	

	

	$title = $_REQUEST["title"];
	$description = $_REQUEST["description"];
	
	$sql = "INSERT INTO postDatabase(title, description) VALUES($title, $description)";

	if ($conn->query($sql) === TRUE) 
	{
    	echo "New record created successfully";
	} 
	else 
	{
    	echo "Error: " . $sql . "<br>" . $conn->error;
	}

$conn->close();

		
	

?>