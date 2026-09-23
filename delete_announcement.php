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
    die('Δεν παρείχεται αναγνωριστικό ανακοίνωσης.');
}

$stmt = $conn->prepare('DELETE FROM announcements WHERE Ayxwn_arithmos = ?');
$stmt->bind_param('i', $id);

if ($stmt->execute()) {
    echo 'Η ανακοίνωση διαγράφηκε επιτυχώς! <a href="announcement_tutor.php">Επιστροφή</a>';
} else {
    echo 'Σφάλμα κατά τη διαγραφή της ανακοίνωσης.';
}

$stmt->close();
$conn->close();

?>
