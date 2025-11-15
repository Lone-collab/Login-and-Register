<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "users_db";

// conn define to store database connection object
//new mysqli automatically connects to the database using the specified values(host, user, password, database) 
$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>