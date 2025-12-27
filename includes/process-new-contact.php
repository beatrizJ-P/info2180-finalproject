<?php 

require_once 'dbconfig.php';
    if (isset($_POST['title']) && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['company']) && isset($_POST['type']) && isset($_POST['assigned_to'])) {
        // Include database connection

        // Retrieve and sanitize form data
        $firstname = htmlspecialchars(trim($_POST['firstname']));
        $lastname = htmlspecialchars(trim($_POST['lastname']));
        $email = htmlspecialchars(trim($_POST['email']));
        $title = htmlspecialchars(trim($_POST['title']));
        $telephone = htmlspecialchars(trim($_POST['phone']));
        $company = htmlspecialchars(trim($_POST['company']));
        $type = htmlspecialchars(trim($_POST['type']));
        $assigned_to = htmlspecialchars(trim($_POST['assigned_to']));

        // Insert into database
        $stmt = $conn->prepare("INSERT INTO contacts (title, firstname, lastname, email, telephone, company, type, assigned_to) VALUES (:title, :firstname, :lastname, :email, :telephone, :company, :type, :assigned_to)");
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':lastname', $lastname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':telephone', $telephone);
        $stmt->bindParam(':company', $company);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':assigned_to', $assigned_to);
        if ($stmt->execute()) {
            echo "<h3>New contact created successfully</h3>";
            exit();
        } else {
            echo "Error: " . $stmt->errorInfo()[2];
        }
    } else {
        echo "<h3>All fields are required.</h3>";
    }
?>