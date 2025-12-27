<html>
<head>
    <title>Users</title>
    <?php include '../includes/metadata.php'; ?>
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <div id="daniel-users-container">
        <!-- User list will be dynamically populated here -->
        
        <div id="usertable-container"> 
            
            <div id="table-header-container">
                <h1>Users</h1>
                <a href="./newusers.php" class="btn">+ Add User</a>
            </div>
            <div id="usertable"><?php include '../includes/usertable.php'; ?></div>
        </div>
       

    <div id="user-sidebar"><?php include '../includes/sidebar.php'; ?></div>
    </div>
</body>
</html>