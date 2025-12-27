<?php 
    require_once 'dbconfig.php';

    if (isset($_POST['note']) && isset($_POST['contact_id'])) {
        if (filter_var($_POST['contact_id'], FILTER_VALIDATE_INT) !== false) {
            $note = htmlspecialchars($_POST['note']);
            $contact_id = $_POST['contact_id'];
            $stmt = $conn->prepare("INSERT INTO notes (contact_id, comment) VALUES (:contact_id, :note)");
            $stmt->bindParam(':contact_id', $contact_id);
            $stmt->bindParam(':note', $note);
            if ($stmt->execute()) {
                $stmt = $conn->prepare("SELECT * FROM notes where contact_id= :contact_id");
                $stmt->bindParam(':contact_id', $contact_id);
                if ($stmt->execute()) {
                $notes= $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach($notes as $note){
                $stmt = $conn->prepare("SELECT * FROM users WHERE id = ".$note['created_by']);
                $stmt->execute();
                $createdby=$stmt->fetchAll(PDO::FETCH_ASSOC)[0];
        
                echo "<h4>".$createdby['firstname'].' '.$createdby['lastname']."</h4>";
                echo "<p>".$note['comment']."</p>";
                echo "<p>". convertDateFormat(substr($note['created_at'],0,10))." at ". ltrim(convertTimeFormat($note['created_at']),'0')."</p>";

            }
                
            } else {
                echo "Error: " . $stmt->errorInfo()[2];
            }
        } else {
            echo "A note is Required.";
        }
        }
    }


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