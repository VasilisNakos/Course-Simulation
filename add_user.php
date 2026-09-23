<?php

require_once __DIR__ . '/includes/auth.php';
requireRole('Tutor');

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verifyCsrf();
    require_once __DIR__ . '/db_connection.php';

    $onoma = trim($_POST['Onoma'] ?? '');
    $epwnymo = trim($_POST['Epwnymo'] ?? '');
    $loginame = trim($_POST['Loginame'] ?? '');
    $password = $_POST['password'] ?? '';
    $role = 'Student';

    if ($onoma === '' || $epwnymo === '' || $loginame === '' || $password === '') {
        $message = 'Συμπληρώστε όλα τα πεδία.';
    } else {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare('INSERT INTO user (Onoma, Epwnymo, Loginame, password, role) VALUES (?, ?, ?, ?, ?)');
        $stmt->bind_param('sssss', $onoma, $epwnymo, $loginame, $hash, $role);

        if ($stmt->execute()) {
            $message = 'Ο χρήστης προστέθηκε επιτυχώς!';
        } else {
            $message = 'Σφάλμα κατά την προσθήκη του χρήστη. Το Loginame μπορεί να υπάρχει ήδη.';
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
    <title>Add_user</title>
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
    <h2>Προσθήκη φοιτητή</h2>
    <?php if ($message !== ''): ?>
        <p><?php echo h($message); ?></p>
    <?php endif; ?>
    <form action="add_user.php" method="post">
        <?php echo csrfField(); ?>
        <label for="Onoma">Όνομα:</label><br>
        <input type="text" id="Onoma" name="Onoma" required><br>
        <label for="Epwnymo">Επώνυμο:</label><br>
        <input type="text" id="Epwnymo" name="Epwnymo" required><br>
        <label for="Loginame">Loginame:</label><br>
        <input type="text" id="Loginame" name="Loginame" required><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br>
        <input type="submit" value="Υποβολή">
    </form>
    <p><a href="index_tutor.php">Επιστροφή</a></p>
</div>
</body>
</html>
