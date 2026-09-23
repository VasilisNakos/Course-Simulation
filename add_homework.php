<?php

require_once __DIR__ . '/includes/auth.php';
requireRole('Tutor');

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verifyCsrf();
    require_once __DIR__ . '/db_connection.php';

    $stoxoi = $_POST['Stoxoi'] ?? '';
    $paradotea = $_POST['Paradotea'] ?? '';
    $hmeromhnia = $_POST['Hmeromhnia'] ?? '';
    $storedName = validateUploadedFile($_FILES['Ekfwnhsh'] ?? []);

    if ($storedName === null) {
        $message = 'Μη έγκυρο ή μη επιτρεπόμενο αρχείο.';
    } elseif (!storeUploadedFile($_FILES['Ekfwnhsh'], $storedName)) {
        $message = 'Σφάλμα κατά την μεταφορά του αρχείου.';
    } else {
        $stmt = $conn->prepare('INSERT INTO homeworks (Stoxoi, Ekfwnhsh, Paradotea, Hmeromhnia) VALUES (?, ?, ?, ?)');
        $stmt->bind_param('ssss', $stoxoi, $storedName, $paradotea, $hmeromhnia);

        if ($stmt->execute()) {
            $message = 'Η εργασία προστέθηκε επιτυχώς!';
        } else {
            deleteStoredFile($storedName);
            $message = 'Σφάλμα κατά την προσθήκη της εργασίας.';
        }

        $stmt->close();
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add_homework</title>
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
    <form action="add_homework.php" method="post" enctype="multipart/form-data">
        <?php echo csrfField(); ?>
        <label for="Stoxoi">Στόχοι:</label><br>
        <textarea id="Stoxoi" name="Stoxoi" required></textarea><br>
        <label for="Ekfwnhsh">Εκφώνηση:</label><br>
        <input type="file" id="Ekfwnhsh" name="Ekfwnhsh" required accept=".pdf,.doc,.docx,.png,.jpg,.jpeg,.gif,.txt,.ppt,.pptx"><br>
        <label for="Paradotea">Παραδοτέα:</label><br>
        <textarea id="Paradotea" name="Paradotea" required></textarea><br>
        <label for="Hmeromhnia">Ημερομηνία παράδοσης:</label><br>
        <input type="date" id="Hmeromhnia" name="Hmeromhnia" required><br>
        <input type="submit" value="Υποβολή">
    </form>
    <p><a href="homework_tutor.php">Επιστροφή</a></p>
</div>
</body>
</html>
