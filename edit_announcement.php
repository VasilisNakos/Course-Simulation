<?php

require_once __DIR__ . '/includes/auth.php';
requireRole('Tutor');
require_once __DIR__ . '/db_connection.php';

$id = (int)($_GET['id'] ?? 0);
$message = '';

if ($id <= 0) {
    die('Δεν παρείχεται αναγνωριστικό ανακοίνωσης.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verifyCsrf();

    $hmeromhnia = $_POST['Hmeromhnia'] ?? '';
    $thema = $_POST['Thema'] ?? '';
    $kyriwsKeimeno = $_POST['Kyriws_Keimeno'] ?? '';

    $stmt = $conn->prepare('UPDATE announcements SET Hmeromhnia = ?, Thema = ?, Kyriws_Keimeno = ? WHERE Ayxwn_arithmos = ?');
    $stmt->bind_param('sssi', $hmeromhnia, $thema, $kyriwsKeimeno, $id);

    if ($stmt->execute()) {
        $message = 'Επιτυχής ενημέρωση ανακοίνωσης!';
    } else {
        $message = 'Σφάλμα κατά την ενημέρωση της ανακοίνωσης.';
    }

    $stmt->close();
}

$stmt = $conn->prepare('SELECT Ayxwn_arithmos, Hmeromhnia, Thema, Kyriws_Keimeno FROM announcements WHERE Ayxwn_arithmos = ?');
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$stmt->close();
$conn->close();

if (!$row) {
    die('Δεν βρέθηκε ανακοίνωση.');
}
?>
<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Επεξεργασία Ανακοίνωσης</title>
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
    <form action="edit_announcement.php?id=<?php echo (int)$id; ?>" method="post">
        <?php echo csrfField(); ?>
        <label for="Hmeromhnia">Ημερομηνία:</label><br>
        <input type="date" id="Hmeromhnia" name="Hmeromhnia" value="<?php echo h($row['Hmeromhnia']); ?>" required><br>
        <label for="Thema">Θέμα:</label><br>
        <textarea id="Thema" name="Thema" required><?php echo h($row['Thema']); ?></textarea><br>
        <label for="Kyriws_Keimeno">Κύριος Κείμενο:</label><br>
        <textarea id="Kyriws_Keimeno" name="Kyriws_Keimeno" required><?php echo h($row['Kyriws_Keimeno']); ?></textarea><br>
        <input type="submit" value="Αποθήκευση">
    </form>
    <p><a href="announcement_tutor.php">Επιστροφή</a></p>
</div>
</body>
</html>
