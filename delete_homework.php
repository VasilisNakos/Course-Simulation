<?php
// Σύνδεση με τη βάση δεδομένων
include_once('db_connection.php');

// Έλεγχος αν υπάρχει το αναγνωριστικό της εργασίας στο URL
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    // Εκτέλεση ερωτήματος DELETE
    $sql = "DELETE FROM homeworks WHERE Ayxwn_arithmos = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Η εργασία διαγράφηκε επιτυχώς!";
    } else {
        echo "Σφάλμα κατά τη διαγραφή της εργασίας: " . $conn->error;
    }
} else {
    echo "Δεν παρείχεται αναγνωριστικό εργασίας.";
}

// Κλείσιμο σύνδεσης
$conn->close();
?>