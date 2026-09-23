<?php

require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/db_connection.php';

requireRole('Tutor');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    die('Method not allowed.');
}

verifyCsrf();

$id = (int)($_POST['id'] ?? 0);
if ($id <= 0) {
    die('Δεν παρείχεται αναγνωριστικό εγγράφου.');
}

$select = $conn->prepare('SELECT File_name FROM documents WHERE Ayxwn_arithmos = ?');
$select->bind_param('i', $id);
$select->execute();
$result = $select->get_result();
$row = $result->fetch_assoc();
$select->close();

if (!$row) {
    die('Δεν βρέθηκε έγγραφο.');
}

deleteStoredFile($row['File_name']);

$stmt = $conn->prepare('DELETE FROM documents WHERE Ayxwn_arithmos = ?');
$stmt->bind_param('i', $id);

if ($stmt->execute()) {
    echo 'Το έγγραφο διαγράφηκε επιτυχώς! <a href="documents_tutor.php">Επιστροφή</a>';
} else {
    echo 'Σφάλμα κατά τη διαγραφή του εγγράφου.';
}

$stmt->close();
$conn->close();

?>
