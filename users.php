<html>
<head>
    <title>Users</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    
</head>
<body>
    <?php include './includes/header.php'; ?>
    <h1>Users</h1>
    <button id="daniel-add-new-user-btn">+ Add User</button>
    <div id="daniel-users-container">
        <!-- User list will be dynamically populated here -->
        <?php include 'usertable.php'; ?>
    </div>
    <?php include './includes/footer.php'; ?>
    
</body>
</html>