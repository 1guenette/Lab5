<?php

session_start();

require_once 'config.php';

$query = mysqli_query($conn, "SELECT * FROM $db_table2");

$data = array();
$row = mysqli_fetch_all($query);


foreach($row as $key => $value)
{
    $data[$key] = $value;
}

//Making the first posts appear first
$j = 0;
for($i = sizeof($data); $i >= 0; --$i){
    $dataReversed[$j] = $data[$i];
    $result = json_encode($dataReversed);
    $j++;
}

echo $result;
$conn->close();


