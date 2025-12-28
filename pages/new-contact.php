<?php 
session_start();
//if (isset($_SESSION['id'])){
    //session_destroy();
   // header('Location:login.php');
    //exit;
//}
if ($_SESSION['logged_in'] === true) {
} else {
    header("Location: login.php");
    exit;
}

require '../includes/dbconfig.php';
include '../includes/metadata.php';
include '../includes/header.php'; 
include '../includes/sidebar.php';

$stmt = $conn->prepare("SELECT * FROM users");
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>New Contact</title>
        <script src="../js/new-contact.js" defer></script>
    </head>
<body>
    <section>
        <header class='page-head'>
            <div class="new-contact-container">
                <h2>New Contact</h2>
            </div>
        </header>

        <div class="form-container">
            <form>
                <div class="form-group">
                    <div class="fields">
                        <label for="title">Title</label><br>
                        <select name="title" id="title" required>
                            <option value="" disabled selected>Select</option>
                            <option value="Mr.">Mr.</option>
                            <option value="Ms.">Ms.</option>
                            <option value="Mrs.">Mrs.</option>
                            <option value="Dr.">Dr.</option>
                        </select>
                    </div><br>
                </div>
                <div class="form-group">
                    <div class="fields">
                        <label for="firstname">First Name</label>
                        <input type="text" id="firstname" name="firstname" required placeholder="Jane">
                    </div>
                    <div class="fields">
                        <label for="lastname">Last Name</label>
                        <input type="text" id="lastname" name="lastname" required placeholder="Doe">
                    </div>
                </div>
                <div class="form-group">
                    <div class="fields">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required placeholder="something@example.com">
                    </div>
                    <div class="fields">
                        <label for="telephone">Telephone</label>
                        <input type="tel" id="telephone" name="telephone" placeholder="123-456-7890" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="fields">
                        <label for="company">Company</label>
                        <input type="text" id="company" name="company" required>
                    </div>
                    <div class="fields">
                        <label for="type">Contact Type</label><br>
                        <select name="type" id="type" required>
                            <option value="" disabled selected>Select Type</option>
                            <option value="Sales Lead">Sales Lead</option>
                            <option value="Support">Support</option>
                        </select>
                    </div><br>
                </div>
                <div class="fields">
                    <label for="assigned_to">Assign To</label><br>
                    <select name="assigned_to" id="assigned_to" required>
                        <option value="" disabled selected>Select User</option>
                    <?php foreach ($users as $user): ?>
                            <option value="<?= $user['id'] ?>"><?= $user['firstname'] . ' ' . $user['lastname'] ?></option>
                    <?php endforeach; ?>
                    </select>
                </div>
                <div class="save-button">
                    <button type="button" id="create-contact-btn">Save</button>
            </div>
            <div id="result"></div>
            </form>  
        </div>  
    </section>
</body>
</html>