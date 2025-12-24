<?php
$localhost = "localhost";
$username = "root";
$password = "";
$dbname = "schema";
$conn = new PDO("mysql:host=$localhost;dbname=$dbname", $username, $password);
if (!$conn) {
    die("Connection failed: " . $conn->errorInfo());
}

?>

