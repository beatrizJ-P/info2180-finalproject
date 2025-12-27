<?php 
session_start();
if (isset($_SESSION['id'])){
    session_destroy();
    header('Location:login.php');
    exit;
}

require './includes/dbconfig.php';
include './includes/metadata.php';
include './includes/header.php';
include './includes/sidebar.php';

$contact_id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM Contacts WHERE id = :id");
$stmt->bindParam(':id', $contact_id);
$stmt->execute();
$contact = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt = $conn->prepare("SELECT * FROM users WHERE id = ". $contact['created_by']);
$stmt->execute();
$createdby=$stmt->fetchAll(PDO::FETCH_ASSOC)[0];
$name = $createdby['firstname'].' '.$createdby['lastname'];

$stmt = $conn->prepare("SELECT * FROM notes where contact_id= " . $contact['id']);
$stmt->execute();
$notes= $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $conn->prepare("SELECT * FROM users WHERE id = ". $contact['assigned_to']);
$stmt ->execute();
$assignedto = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];
$aname= $assignedto['firstname'].' '.$assignedto['lastname'];


function convertDateFormat($date){
    $date = explode("-", $date);
    $monthNum  = $date[1];
    $dateObj   = DateTime::createFromFormat('!m', $monthNum);
    $monthName = $dateObj->format('F');
    return $monthName . " " . $date[2] . ", " . $date[0];
}

function convertTimeFormat($date){
// Example MySQL TIME or DATETIME value
$mysqlTime = $date; // Could also be just "14:35:00"

// Create a DateTime object from the MySQL value
try {
    $dateTime = new DateTime($mysqlTime);

    // Format to 12-hour time with AM/PM
    $formattedTime = $dateTime->format('h A');
    return $formattedTime;

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

}
?>


<section class ='view-contact-section'>
    <header class='page-head'>
        <div class="view-contact-container">
            <div class='contact-head'>
                <i class='fas fa-user-circle' style='font-size:60px; position:relative; color:#ccc;'></i> <strong id="ntitle"><?=$contact['title'].'.'.' '.$contact['firstname'].' '.$contact['lastname']?></strong>
                <p>
                    Created on  <?= convertDateFormat(substr($contact['created_at'],0,10)); ?> by  <?= $name; ?> <br>
                    Updated on  <?= convertDateFormat(substr($contact['updated_at'],0,10)); ?>
                </p>
            </div>   
            <div class='btns'>
                <button id='assign'><i class ='fas fa-hand-paper'></i> Assign To Me</button> 
                <button id='switch'><i class ='fas fa-exchange'></i> Switch To <?php if ($contact['type']=="Support") {echo "Sales Lead";} else{echo "Support";}?></button> 
            </div>    
        </div>
    </header>
    <div id='info-container'>
        <div id='email-info'>
            <label for="email"><h4>Email</h4></label>
            <p>
                <?= $contact['email']?>
            </p>
        
            <label for="telephone"><h4>Telephone</h4></label>
            <p>
                <?= $contact['telephone']?>  
            </p>
        </div>
        <div id='company-info'>
            <label for="company"><h4>Company</h4></label>
            <p>
                <?=$contact['company']?>
            </p>
       
            <label for="assigned"><h4>Assigned To</h4></label>
            <p>
                <?=$aname?>
            </p>
        </div>
    </div>
    <br>
    <div id='notes-container'>
        <div id='note-info'>
            <label for='notes'><i class='fa-sharp fa-solid fa-pen-to-square'></i> Notes</label>
        </div>
        <div class='fetch-notes'>
            <?php foreach($notes as $note){
                $stmt = $conn->prepare("SELECT * FROM users WHERE id = ".$note['created_by']);
                $stmt->execute();
                $createdby=$stmt->fetchAll(PDO::FETCH_ASSOC)[0];
        
                echo "<h4>".$createdby['firstname'].' '.$createdby['lastname']."</h4>";
                echo "<p>".$note['comment']."</p>";
                echo "<p>". convertDateFormat(substr($note['created_at'],0,10))." at ". ltrim(convertTimeFormat($note['created_at']),'0')."</p>";

            }
            ?>

        </div>
    </div>
    <br>
    <div class='add-notes'>
        <form method='POST' action='submit'>
            <div class='add-container'>
                <label for='add-notes'>Add a note about <?=$contact['firstname']?></label>
                <textarea name='add' placeholder="Enter details here."></textarea>
            </div>
            <div class='btn-container'>
                <button id='add-note-btn' type='submit' class='<?=$id?>'>Add Note</button>
            </div>
     
        </form>
    </div>
</section>