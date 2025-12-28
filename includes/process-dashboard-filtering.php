<?php 
    require_once 'dbconfig.php';
    if (isset($_POST['filter'])&& isset($_POST['id'])) {
        if (filter_var($_POST['id'], FILTER_VALIDATE_INT) !== false) {
        $filter = htmlspecialchars($_POST['filter']);
        $id = htmlspecialchars($_POST['id']); 
        if(!$filter) {
            exit();
        }
        if (!$id) {
            exit();
        }
        if($filter === 'Assigned to Me') {
            $exc = "SELECT * FROM Contacts WHERE assigned_to = :id";
            $stmt = $conn->prepare($exc);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($contacts as $contact):
                    $type="";
                    if($contact['type'] == "Support"){$type = "support";}
                    if($contact['type'] == "Sales Lead"){$type = "sales-lead";} 
                    ?>
                    <tr>
                        <td><strong><?= $contact['title'].'. '.$contact['firstname']. ' '.$contact['lastname']?></strong></td>
                        <td id="email"><?= $contact['email'] ?></td>
                        <td id="company"><?= $contact['company']?></td>
                        <td><span class="<?=$type ?>"><?= $contact['type'] ?></span></td>
                        <td><a href="view.php?id=<?= $contact['id']?>" class="viewbtn"> View</a></td>
                    </tr>
                 <?php endforeach; 
        }
    }
} elseif(isset($_POST['filter'])) {
        $filter = htmlspecialchars($_POST['filter']);
        if(!$filter) {
            exit();
        }
        if($filter === 'All') {
            $exc = "SELECT * FROM Contacts";
            $stmt = $conn->prepare($exc);
            $stmt->execute();
            $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($contacts as $contact):
                    $type="";
                    if($contact['type'] == "Support"){$type = "support";}
                    if($contact['type'] == "Sales Lead"){$type = "sales-lead";} 
                    ?>
                    <tr>
                        <td><strong><?= $contact['title'].'. '.$contact['firstname']. ' '.$contact['lastname']?></strong></td>
                        <td id="email"><?= $contact['email'] ?></td>
                        <td id="company"><?= $contact['company']?></td>
                        <td><span class="<?=$type ?>"><?= $contact['type'] ?></span></td>
                        <td><a href="view.php?id=<?= $contact['id']?>" class="viewbtn"> View</a></td>
                    </tr>
                 <?php endforeach; 
        } elseif ($filter === 'Sales Leads') {
            $exc = "SELECT * FROM Contacts WHERE type = 'Sales Lead'";
            $stmt = $conn->prepare($exc);
            $stmt->execute();
            $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($contacts as $contact):
                    $type="";
                    if($contact['type'] == "Sales Lead"){$type = "sales-lead";} 
                    ?>
                    <tr>
                        <td><strong><?= $contact['title'].'. '.$contact['firstname']. ' '.$contact['lastname']?></strong></td>
                        <td id="email"><?= $contact['email'] ?></td>
                        <td id="company"><?= $contact['company']?></td>
                        <td><span class="<?=$type ?>"><?= $contact['type'] ?></span></td>
                        <td><a href="view.php?id=<?= $contact['id']?>" class="viewbtn"> View</a></td>
                    </tr>
                 <?php endforeach;
        } elseif ($filter === 'Support') {
            $exc = "SELECT * FROM Contacts WHERE type = 'Support'";
            $stmt = $conn->prepare($exc);
            $stmt->execute();
            $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($contacts as $contact):
                    $type="";
                    if($contact['type'] == "Support"){$type = "support";}
                    ?>
                    <tr>
                        <td><strong><?= $contact['title'].'. '.$contact['firstname']. ' '.$contact['lastname']?></strong></td>
                        <td id="email"><?= $contact['email'] ?></td>
                        <td id="company"><?= $contact['company']?></td>
                        <td><span class="<?=$type ?>"><?= $contact['type'] ?></span></td>
                        <td><a href="view.php?id=<?= $contact['id']?>" class="viewbtn"> View</a></td>
                    </tr>
                 <?php endforeach;
        } 
    }
?>