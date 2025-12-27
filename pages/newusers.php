<html>
<head>
    <title>User Management</title>
    <?php include '../includes/metadata.php'; ?>
    <script src="../js/newusers.js" defer></script>
</head>
<body>
    <?php include '../includes/header.php'; ?>
    <div id="daniel-new-user-container">
        
        <div id="newuserform-container">
            <h1>New User</h1>
            <div id="new-user-background"> 
                <div id="form-area"><?php include '../includes/newuserform.php'; ?></div>
                <div id="button-container">
                    <div id="result"></div>
                    <button id="btn-submit">Save</button>
                </div>
            </div>
           
            
        </div>
        <div id="newuser-sidebar"><?php include '../includes/sidebar.php'; ?></div>
    </div>
</body>
</html>