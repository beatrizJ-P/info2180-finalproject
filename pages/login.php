<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include "../includes/metadata.php" ?>
        <title>Dolphin CRM Login</title>
        <script src="../js/login.js"></script>
    </head>
    <body>
        <?php include "../includes/header.php" ?>
        <main class = "loginPage">
            <h2>Login</h2>
            <div id="loginError">
            </div>
            <form action="./pages/login.php" method="POST">
                <!--<label for="email">Email address</label>-->
                <input type="email" id="email" name="email" placeholder="Email address" required />

                <!--<label for="email">Password</label>-->
                <input type="password" id="password" name="password" placeholder="Password" required />

                <button type = "submit">Login</button>
            </form>
        </main>
        <?php include "../includes/footer.php" ?>
</body>
</html>

