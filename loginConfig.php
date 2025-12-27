<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dolphin_crm";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo json_encode([
        "status" => "error",
        "message" => "Database connection failed: " . $conn->connect_error
    ]);
    exit;
}

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE email = ?";
$stmt = $conn -> prepare($sql);
$stmt -> bind_param("s", $email);
$stmt -> execute();
$result = $stmt -> get_result();

if($result -> num_rows > 0) {
    $data = $result -> fetch_assoc();

    if(password_verify($password, $data['password'])) {
        $_SESSION['user_id'] = $data['id'];
        $_SESSION['email'] = $data['email'];
        $_SESSION['role'] = $data['role'];
        $_SESSION['logged_in'] = true;
        echo json_encode(["status" => "success", "message" => "Login successful"]);
    } 
    else {
        echo json_encode(["status" => "error", "message" => "Invalid login attempt. Please try again."]);
    }
}
else {
    echo json_encode(["status" => "error", "message" => "Invalid login attempt. Please try again."]);
}

$stmt->close();
$conn->close();
?>
