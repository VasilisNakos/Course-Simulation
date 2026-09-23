<?php

require_once __DIR__ . '/includes/auth.php';

$error = '';

if (!empty($_SESSION['user_id'])) {
    if (($_SESSION['role'] ?? '') === 'Tutor') {
        header('Location: index_tutor.php');
    } else {
        header('Location: index_student.php');
    }
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verifyCsrf();
    require_once __DIR__ . '/db_connection.php';

    $loginame = trim($_POST['Loginame'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = $conn->prepare('SELECT id, Loginame, password, role FROM user WHERE Loginame = ?');
    $stmt->bind_param('s', $loginame);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();
    $conn->close();

    if ($user && password_verify($password, $user['password'])) {
        session_regenerate_id(true);
        $_SESSION['user_id'] = (int)$user['id'];
        $_SESSION['loginame'] = $user['Loginame'];
        $_SESSION['role'] = $user['role'];

        if ($user['role'] === 'Tutor') {
            header('Location: index_tutor.php');
        } else {
            header('Location: index_student.php');
        }
        exit;
    }

    $error = 'Λανθασμένο όνομα χρήστη ή κωδικός πρόσβασης.';
}
?>
<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        #login-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        input {
            width: 100%;
            padding: 8px;
            margin: 8px 0;
            box-sizing: border-box;
        }

        #login-button {
            background-color: #4caf50;
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 4px;
            cursor: pointer;
        }

        .error {
            color: #b00020;
            margin-bottom: 12px;
        }
    </style>
</head>
<body>

<div id="login-container">
    <h2>Πιστοποίηση</h2>
    <?php if ($error !== ''): ?>
        <p class="error"><?php echo h($error); ?></p>
    <?php endif; ?>
    <form action="login.php" method="post">
        <?php echo csrfField(); ?>
        <div>
            <label for="Loginame">Username:</label>
            <input type="text" id="login" name="Loginame" required style="margin-bottom: 30px;"><br>
        </div>

        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div>
            <input type="submit" id="login-button" value="Login">
        </div>
    </form>
</div>

</body>
</html>
