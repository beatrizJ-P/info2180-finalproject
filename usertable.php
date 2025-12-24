<?php
// Database connection parameters
$host = 'localhost';
$username = 'final_user';
$password = '';
$dbname = 'dolphin_crm';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$stmt = $conn->query("SELECT * FROM users");
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
//foreach ($results as $row) {
    // Debug: print each row
   // echo '<pre>' . print_r($row, true) . '</pre>';
//}
userTable($results);
function userTable($results){
echo "<table><thead><tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Password</th><th>Email</th><th>Role</th><th>Created</th></tr></thead><tbody>";
       foreach ($results as $row): 
        echo "<tr>";
          echo "<td>" .$row['id']. "</td>";
          echo "<td>" .$row['firstname']. "</td>";
          echo "<td>" .$row['lastname']. "</td>";
          echo "<td>" .$row['password']. "</td>";
          echo "<td>" .$row['email']. "</td>";
          echo "<td>" .$row['role']. "</td>";
          echo "<td>" .$row['created_at']. "</td>";
        echo "</tr>";

       endforeach; 
  echo"</tbody></table>";
}
?>