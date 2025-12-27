<?php
$localhost = "localhost";
$username = "root";
$password = "";
$dbname = "dolphin_crm";

try{
    $conn = new PDO("mysql:host=$localhost;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
    die("Connection failed");
}

?>

