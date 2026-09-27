<?php
$host = "localhost";
$db_user = "root";      // XAMPP default username
$db_pass = "";          // XAMPP default password (empty)
$db_name = "travel_planner";

// Connection 
$conn = new mysqli($host, $db_user, $db_pass, $db_name);

// Connection 
if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}
?>