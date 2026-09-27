<?php
$host = "localhost";
$db_user = "root";      
$db_pass = "";          
$db_name = "travel_planner";


$conn = new mysqli($host, $db_user, $db_pass, $db_name);


if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}
?>
