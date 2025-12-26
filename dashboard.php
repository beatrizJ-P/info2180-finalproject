<?php
session_start();
require './includes/dbconfig.php';
include './includes/metadata.php';
include './includes/header.php';
include './includes/sidebar.php';

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

<div class="main-content">
    <div class="dashboard-header">
        <h2>Dashboard</h2>
        <button id="add-contact-btn">+ Add Contact</button>
    </div>


    <div class="dashboard-container">
    
        <div class="filter-options">

            <span id="filter-label"><img src="images/filter-icon.png" alt="Filter Icon" id="filter-icon"> Filter by: </>
            <button id="fltr_btn" data-filter="all" <?= $fltr === 'all' ? 'class="active"' : '' ?>>All</button>
            <button id="fltr_btn" data-filter="Sales Leads" <?= $fltr === 'Sales Leads' ? 'class="active"' : '' ?>>Sales Leads</button>
            <button id="fltr_btn" data-filter="Support" <?= $fltr === 'Support' ? 'class="active"' : '' ?>>Support</button>
            <button id="fltr_btn" data-filter="Assigned to Me" <?= $fltr === 'Assigned to Me' ? 'class="active"' : '' ?>>Assigned to Me</button>
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
            <tbody>
                <?php foreach ($contacts as $contact): ?>
                    <tr>
                        <td><?= $contact['title'].' '.$contact['firstname']. ' '.$contact['lastname']?></td>
                        <td><?= $contact['email'] ?></td>
                        <td><?= $contact['company']?></td>
                        <td><?= $contact['type'] ?></td>
                        <td><a href="" class="view-button" data="<?= $contact['assigned_to'] ?>"> View</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>




