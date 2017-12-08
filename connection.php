<?php

function Connect(){
$servername = "localhost";
$username = "madisonrogers";
$password = "QCKMEQOY";
$db = "f17_madisonrogers";

// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
//echo "Yay connected";
return $conn;
}
?>