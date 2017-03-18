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
	
	$sql = "UPDATE postDatabase SET description=$newDesc, title=$newTitle WHERE description=$description, title=$title, usr = $_SESSION['name']"; 
	

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