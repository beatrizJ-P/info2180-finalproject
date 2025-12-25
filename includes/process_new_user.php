<?php include_once './dbconfig.php';?>

<?php 
if(isset($_POST['firstname'])&& isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['role'])) {
    // Include database connection
    
    // Retrieve and sanitize form data
    $firstname = htmlspecialchars(trim($_POST['firstname']));
    $lastname = htmlspecialchars(trim($_POST['lastname']));
    $password = htmlspecialchars(trim($_POST['password']));
    $email = htmlspecialchars(trim($_POST['email']));
    $role = htmlspecialchars(trim($_POST['role']));
    // Sanitize inputs

    

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    //echo "$firstname, $lastname, $email, $role, $hashedPassword";

    // Insert into database
    $stmt = $conn->prepare("INSERT INTO users (firstname, lastname, password, email, role) VALUES (:firstname, :lastname, :password, :email, :role)");
    $stmt->bindParam(':firstname', $firstname);
    $stmt->bindParam(':lastname', $lastname);
    $stmt->bindParam(':password', $hashedPassword);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':role', $role);
    if ($stmt->execute()) {
        echo "<h3>New user created successfully</h3>";
        exit();
    } else {
        echo "Error: " . $stmt->errorInfo()[2];
    }
}else{
    echo "<h3>All fields are required.</h3>";
}
   /* $password = trim($_POST['password']);
    $email = trim($_POST['email']);
    $role = trim($_POST['role']);

    // Sanitize inputs
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);
    $email = mysqli_real_escape_string($conn, $email);
    $role = mysqli_real_escape_string($conn, $role);

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert into database
    $sql = "INSERT INTO users (username, password_hash, email, role) VALUES ('$username', '$hashedPassword', '$email', '$role')";
    
    if (mysqli_query($conn, $sql)) {
        echo "New user created successfully";
        header("Location: newusers.html");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
*/
?>
