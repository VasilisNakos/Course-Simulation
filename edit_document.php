<?php

require_once __DIR__ . '/includes/auth.php';
requireRole('Tutor');
require_once __DIR__ . '/db_connection.php';

$id = (int)($_GET['id'] ?? 0);
$message = '';

if ($id <= 0) {
    die('Δεν παρείχεται αναγνωριστικό εγγράφου.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verifyCsrf();

    $title = $_POST['Title'] ?? '';
    $descriptions = $_POST['descriptions'] ?? '';

    $select = $conn->prepare('SELECT File_name FROM documents WHERE Ayxwn_arithmos = ?');
    $select->bind_param('i', $id);
    $select->execute();
    $existing = $select->get_result()->fetch_assoc();
    $select->close();

    if (!$existing) {
        die('Δεν βρέθηκε έγγραφο.');
    }

    $storedName = $existing['File_name'];
    $hasUpload = isset($_FILES['File_name']) && ($_FILES['File_name']['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_NO_FILE;

    if ($hasUpload) {
        $newStoredName = validateUploadedFile($_FILES['File_name']);
        if ($newStoredName === null) {
            $message = 'Μη έγκυρο ή μη επιτρεπόμενο αρχείο.';
        } elseif (!storeUploadedFile($_FILES['File_name'], $newStoredName)) {
            $message = 'Σφάλμα κατά τη μεταφόρτωση του αρχείου.';
        } else {
            deleteStoredFile($storedName);
            $storedName = $newStoredName;
        }
    }

    if ($message === '') {
        $stmt = $conn->prepare('UPDATE documents SET Title = ?, descriptions = ?, File_name = ? WHERE Ayxwn_arithmos = ?');
        $stmt->bind_param('sssi', $title, $descriptions, $storedName, $id);

        if ($stmt->execute()) {
            $message = 'Επιτυχής ενημέρωση εγγράφου!';
        } else {
            $message = 'Σφάλμα κατά την ενημέρωση του εγγράφου.';
        }

        $stmt->close();
    }
}

$stmt = $conn->prepare('SELECT Ayxwn_arithmos, Title, descriptions, File_name FROM documents WHERE Ayxwn_arithmos = ?');
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$stmt->close();
$conn->close();

if (!$row) {
    die('Δεν βρέθηκε έγγραφο.');
}
?>
<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Επεξεργασία εγγράφου</title>
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
    <form action="edit_document.php?id=<?php echo (int)$id; ?>" method="post" enctype="multipart/form-data">
        <?php echo csrfField(); ?>
        <label for="Title">Τίτλος:</label><br>
        <input type="text" id="Title" name="Title" value="<?php echo h($row['Title']); ?>" required><br>
        <label for="descriptions">Περιγραφή:</label><br>
        <textarea id="descriptions" name="descriptions" required><?php echo h($row['descriptions']); ?></textarea><br>
        <label for="File_name">Νέο αρχείο (προαιρετικό):</label><br>
        <input type="file" id="File_name" name="File_name" accept=".pdf,.doc,.docx,.png,.jpg,.jpeg,.gif,.txt,.ppt,.pptx"><br>
        <input type="submit" value="Αποθήκευση">
    </form>
    <p><a href="documents_tutor.php">Επιστροφή</a></p>
</div>
</body>
</html>
