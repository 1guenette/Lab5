<?php
/**
 * Created by IntelliJ IDEA.
 * User: Sovann
 * Date: 3/16/17
 * Time: 8:55 PM
 */

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
$db_table2 = "posts";
$db_table3 = "messages";


// Create connection
$conn = new mysqli($server, $username, $password, $db_name) or die("Cannot connect to server");


