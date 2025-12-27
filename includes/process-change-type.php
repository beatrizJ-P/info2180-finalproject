<?php 
require_once 'dbconfig.php';
if (isset($_POST['contact_id'])&& isset($_POST['type'])) {
    if (filter_var($_POST['contact_id'], FILTER_VALIDATE_INT) !== false) {
        $contact_id = htmlspecialchars($_POST['contact_id']);
        $type = htmlspecialchars($_POST['type']);
        if (!$contact_id) {
            exit();
        }
        if (!$type) {
            exit();
        }
        if($type == "Support"){
            $stmt = $conn->prepare("UPDATE contacts SET type = :type WHERE id = :id");
            $stmt->bindParam(':id', $contact_id);
            $stmt->bindParam(':type', $type);
            if ($stmt->execute()) {
                echo "Switch to Sales Lead";
                exit();
            } 
        } elseif($type == "Sales"){
            $type = "Sales Lead";
            $stmt = $conn->prepare("UPDATE contacts SET type = :type WHERE id = :id");
            $stmt->bindParam(':id', $contact_id);
            $stmt->bindParam(':type', $type);
            if ($stmt->execute()) {
                echo "Switch to Support";
                exit();
            }
        }

    }
}
?>