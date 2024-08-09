<?php
// Σύνδεση με τη βάση δεδομένων
include_once('db_connection.php');

// Έλεγχος αν υπάρχει το αναγνωριστικό της ανακοίνωσης στο URL
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    // Εκτέλεση ερωτήματος DELETE
    $sql = "DELETE FROM announcements WHERE Ayxwn_arithmos = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Η ανακοίνωση διαγράφηκε επιτυχώς!";
    } else {
        echo "Σφάλμα κατά τη διαγραφή της ανακοίνωσης: " . $conn->error;
    }
} else {
    echo "Δεν παρείχεται αναγνωριστικό ανακοίνωσης.";
}

// Κλείσιμο σύνδεσης
$conn->close();
?>
