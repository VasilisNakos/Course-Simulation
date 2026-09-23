<?php

require_once __DIR__ . '/includes/auth.php';
requireRole('Tutor');
require_once __DIR__ . '/db_connection.php';

$id = (int)($_GET['id'] ?? 0);
$message = '';

if ($id <= 0) {
    die('Δεν παρείχεται αναγνωριστικό εργασίας.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verifyCsrf();

    $stoxoi = $_POST['Stoxoi'] ?? '';
    $paradotea = $_POST['Paradotea'] ?? '';
    $hmeromhnia = $_POST['Hmeromhnia'] ?? '';

    $select = $conn->prepare('SELECT Ekfwnhsh FROM homeworks WHERE Ayxwn_arithmos = ?');
    $select->bind_param('i', $id);
    $select->execute();
    $existing = $select->get_result()->fetch_assoc();
    $select->close();

    if (!$existing) {
        die('Δεν βρέθηκε εργασία.');
    }

    $storedName = $existing['Ekfwnhsh'];
    $hasUpload = isset($_FILES['fileUpload']) && ($_FILES['fileUpload']['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_NO_FILE;

    if ($hasUpload) {
        $newStoredName = validateUploadedFile($_FILES['fileUpload']);
        if ($newStoredName === null) {
            $message = 'Μη έγκυρο ή μη επιτρεπόμενο αρχείο.';
        } elseif (!storeUploadedFile($_FILES['fileUpload'], $newStoredName)) {
            $message = 'Σφάλμα κατά τη μεταφόρτωση του αρχείου.';
        } else {
            deleteStoredFile($storedName);
            $storedName = $newStoredName;
        }
    }

    if ($message === '') {
        $stmt = $conn->prepare('UPDATE homeworks SET Stoxoi = ?, Ekfwnhsh = ?, Paradotea = ?, Hmeromhnia = ? WHERE Ayxwn_arithmos = ?');
        $stmt->bind_param('ssssi', $stoxoi, $storedName, $paradotea, $hmeromhnia, $id);

        if ($stmt->execute()) {
            $message = 'Επιτυχής ενημέρωση εργασίας!';
        } else {
            $message = 'Σφάλμα κατά την ενημέρωση της εργασίας.';
        }

        $stmt->close();
    }
}

$stmt = $conn->prepare('SELECT Ayxwn_arithmos, Stoxoi, Ekfwnhsh, Paradotea, Hmeromhnia FROM homeworks WHERE Ayxwn_arithmos = ?');
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$stmt->close();
$conn->close();

if (!$row) {
    die('Δεν βρέθηκε εργασία.');
}
?>
<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Επεξεργασία εργασίας</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        #login-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }

        input, textarea {
            width: 100%;
            padding: 8px;
            margin: 8px 0;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>
<div id="login-container">
    <?php if ($message !== ''): ?>
        <p><?php echo h($message); ?></p>
    <?php endif; ?>
    <form action="edit_homework.php?id=<?php echo (int)$id; ?>" method="post" enctype="multipart/form-data">
        <?php echo csrfField(); ?>
        <label for="Stoxoi">Στόχοι:</label><br>
        <textarea id="Stoxoi" name="Stoxoi" required><?php echo h($row['Stoxoi']); ?></textarea><br>
        <label for="Ekfwnhsh">Νέα εκφώνηση (προαιρετικό):</label><br>
        <input type="file" id="Ekfwnhsh" name="fileUpload" accept=".pdf,.doc,.docx,.png,.jpg,.jpeg,.gif,.txt,.ppt,.pptx"><br>
        <label for="Paradotea">Παραδοτέα:</label><br>
        <textarea id="Paradotea" name="Paradotea" required><?php echo h($row['Paradotea']); ?></textarea><br>
        <label for="Hmeromhnia">Ημερομηνία παράδοσης:</label><br>
        <input type="date" id="Hmeromhnia" name="Hmeromhnia" value="<?php echo h($row['Hmeromhnia']); ?>" required><br>
        <input type="submit" value="Αποθήκευση">
    </form>
    <p><a href="homework_tutor.php">Επιστροφή</a></p>
</div>
</body>
</html>
