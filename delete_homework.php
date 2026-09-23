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
    die('Δεν παρείχεται αναγνωριστικό εργασίας.');
}

$select = $conn->prepare('SELECT Ekfwnhsh FROM homeworks WHERE Ayxwn_arithmos = ?');
$select->bind_param('i', $id);
$select->execute();
$result = $select->get_result();
$row = $result->fetch_assoc();
$select->close();

if (!$row) {
    die('Δεν βρέθηκε εργασία.');
}

deleteStoredFile($row['Ekfwnhsh']);

$stmt = $conn->prepare('DELETE FROM homeworks WHERE Ayxwn_arithmos = ?');
$stmt->bind_param('i', $id);

if ($stmt->execute()) {
    echo 'Η εργασία διαγράφηκε επιτυχώς! <a href="homework_tutor.php">Επιστροφή</a>';
} else {
    echo 'Σφάλμα κατά τη διαγραφή της εργασίας.';
}

$stmt->close();
$conn->close();

?>
