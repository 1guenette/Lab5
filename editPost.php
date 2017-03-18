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
	$newTitle = $_REQUEST["newTitle"];
	$newDesc = $_REQUEST["newDescription"];
	
	//need to account for username, put username as parameter in ajax and front-end before checking for username in sql desc.  (DO LATER)
	$sql = "UPDATE postDatabase SET description=$newDesc, title=$newTitle WHERE description=$description, title=$title "; 

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