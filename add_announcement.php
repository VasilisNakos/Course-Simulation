<?php

require_once __DIR__ . '/includes/auth.php';
requireRole('Tutor');

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verifyCsrf();
    require_once __DIR__ . '/db_connection.php';

    $hmeromhnia = $_POST['Hmeromhnia'] ?? '';
    $thema = $_POST['Thema'] ?? '';
    $kyriwsKeimeno = $_POST['Kyriws_Keimeno'] ?? '';

    $stmt = $conn->prepare('INSERT INTO announcements (Hmeromhnia, Thema, Kyriws_Keimeno) VALUES (?, ?, ?)');
    $stmt->bind_param('sss', $hmeromhnia, $thema, $kyriwsKeimeno);

    if ($stmt->execute()) {
        $message = 'Η ανακοίνωση προστέθηκε επιτυχώς!';
    } else {
        $message = 'Σφάλμα κατά την προσθήκη της ανακοίνωσης.';
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add_announcement</title>
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
    <form action="add_announcement.php" method="post">
        <?php echo csrfField(); ?>
        <label for="Hmeromhnia">Ημερομηνία:</label><br>
        <input type="date" id="Hmeromhnia" name="Hmeromhnia" required><br>
        <label for="Thema">Θέμα:</label><br>
        <textarea id="Thema" name="Thema" required></textarea><br>
        <label for="Kyriws_Keimeno">Κυρίως Κείμενο:</label><br>
        <textarea id="Kyriws_Keimeno" name="Kyriws_Keimeno" required></textarea><br>
        <input type="submit" value="Υποβολή">
    </form>
    <p><a href="announcement_tutor.php">Επιστροφή</a></p>
</div>
</body>
</html>
