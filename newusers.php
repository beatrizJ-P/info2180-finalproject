<html>
<head>
    <meta charset="utf-8">
    <title>User Management</title>
    <script src="newusers.js" defer></script>
</head>
<body>
    <?php include 'header.php'; ?>
    <h1>New User</h1>
    <form id="new-user-form" method="POST" action="process_new_user.php">
        <label for="firstname">First Name:</label>
        <input type="text" id="firstname" name="firstname" placeholder="Jane"required>

        <label for="lastname">Last Name:</label>
        <input type="text" id="lastname" name="lastname" placeholder="Doe" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" placeholder="something@example.com" required>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <label for="role">Role:</label>
        <select id="role" name="role" required>
            <option value="admin">Admin</option>
            <option value="member" selected>Member</option>
        </select>

        <button type="submit">Save</button>
    </form> 
</body>
</html>