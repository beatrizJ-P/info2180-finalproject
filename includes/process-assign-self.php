<?php
    session_start();
    if (!isset($_SESSION['logged_in'])) {
    header("Location: login.php");
    exit;
}
require_once '../includes/dbconfig.php';
if (isset($_POST['user_id'])&& isset($_POST['contact_id'])) {
    
    if (filter_var($_POST['contact_id'], FILTER_VALIDATE_INT) !== false && filter_var($_POST['user_id'], FILTER_VALIDATE_INT) !== false) {
        $contact_id = htmlspecialchars($_POST['contact_id']);
        $user_id = htmlspecialchars($_POST['user_id']);
        if (!$contact_id) {
            exit();
        }
        if (!$user_id) {
            exit();
        }
    }

    $stmt = $conn->prepare("UPDATE contacts SET assigned_to = :user_id WHERE id = :contact_id");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':contact_id', $contact_id);
    $stmt->execute();
    $stmt = $conn->prepare("SELECT firstname, lastname FROM contacts WHERE id = :contact_id");
    $stmt->bindParam(':contact_id', $contact_id);
    $stmt->execute();
    $s = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $response = ["Success", $s[0]['firstname'].' '.$s[0]['lastname']];
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    echo "Error";
    
}