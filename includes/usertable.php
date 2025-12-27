<<<<<<< HEAD
<?php require_once './includes/dbconfig.php';?>
=======
<?php require_once '../includes/dbconfig.php';?>
>>>>>>> Hoo-Workspace
<?php
// Database connection parameters

$stmt = $conn->query("SELECT * FROM users");
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
//foreach ($results as $row) {
    // Debug: print each row
   // echo '<pre>' . print_r($row, true) . '</pre>';
//}
userTable($results);
function userTable($results){
echo "<table><thead><tr><th>Name</th><th>Email</th><th>Role</th><th>Created</th></tr></thead><tbody>";
       foreach ($results as $row): 
        echo "<tr>";
          echo "<td><strong>" .$row['firstname']. " " .$row['lastname']. "</strong></td>";
          echo "<td>" .$row['email']. "</td>";
          echo "<td>" .$row['role']. "</td>";
          echo "<td>" .$row['created_at']. "</td>";
        echo "</tr>";

       endforeach; 
  echo"</tbody></table>";
}
?>