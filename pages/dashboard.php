<?php
session_start();
//if (isset($_SESSION['id'])){
   // session_destroy();
    //header('Location:login.php');
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

$fltr = $_GET['filter'] ?? 'all';
$id =[];
$exc = "SELECT * FROM Contacts";

if ($fltr === 'Sales Leads') {
    $exc .="WHERE type = 'Sales Lead'";
    $stmt = $conn->prepare($exc);
} elseif ($fltr === 'Support') {
    $exc .="WHERE type = 'Support'";
    $stmt = $conn->prepare($exc);
} elseif ($fltr === 'Assigned to Me') {
    $exc .="WHERE assigned_to = :id";
    $id[':id'] = $_SESSION['user_id']; 
    $stmt = $conn->prepare($exc);
}

$stmt = $conn->prepare($exc);
$stmt->execute($id);
$contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<head>
    <title>Dashboard</title>
    <script src="../js/dashboard.js" defer></script>
</head>
<div class="main-content">
    <div class="dashboard-header">
        <h2>Dashboard</h2>
        <a href="./new-contact.php">
        <button id="add-contact-btn">+ Add Contact</button>
        </a>
    </div>


    <div class="dashboard-container">
            <div class="filter-options">

                <span id="filter-label"><img src="../images/filter-icon.png" alt="Filter Icon" id="filter-icon"> Filter by: </><span>
                <input type="hidden" id="user-id" value="<?= (int)$_SESSION['user_id'] ?>">
                <button id="fltr-btn-all" data-filter="all" <?= $fltr === 'all' ? 'class="active filter-all"' : '' ?>>All</button>
                <button id="fltr-btn-sales" data-filter="Sales Leads" <?= $fltr === 'Sales Lead' ? 'class="active filter-sales"' : '' ?>>Sales Leads</button>
                <button id="fltr-btn-support" data-filter="Support" <?= $fltr === 'Support' ? 'class="active filter-support"' : '' ?>>Support</button>
                <button id="fltr-btn-assigned" data-filter="Assigned to Me" <?= $fltr === 'Assigned to Me' ? 'class="active filter-assigned"' : '' ?>>Assigned to Me</button>
                <hr class="slider" id="slider_indicator">

            </div>

        <table class="contacts-table">
            <thead id="table-head">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Company</th>
                    <th>Type</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="results">
                <?php foreach ($contacts as $contact):
                    $type;
                    if($contact['type'] == "Support"){$type = "support";}
                    if($contact['type'] == "Sales Lead"){$type = "sales-lead";} 
                    ?>
                    <tr>
                        <td><strong><?= $contact['title'].' '.$contact['firstname']. ' '.$contact['lastname']?></strong></td>
                        <td id="email"><?= $contact['email'] ?></td>
                        <td id="company"><?= $contact['company']?></td>
                        <td><span class="<?=$type ?>"><?= $contact['type'] ?></span></td>
                        <td><a href="view.php?id=<?= $contact['id']?>" class="viewbtn"> View</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>




