<?php
// Σύνδεση με τη βάση δεδομένων
include_once('db_connection.php');

// Έλεγχος αν υπάρχει το αναγνωριστικό του εγγράφου στο URL
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    // Εκτέλεση ερωτήματος DELETE
    $sql = "DELETE FROM documents WHERE Ayxwn_arithmos = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Το έγγραφο διαγράφηκε επιτυχώς!";
    } else {
        echo "Σφάλμα κατά τη διαγραφή του εγγράφου: " . $conn->error;
    }
} else {
    echo "Δεν παρείχεται αναγνωριστικό εγγράφου.";
}

// Κλείσιμο σύνδεσης
$conn->close();
?>
