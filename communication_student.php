<?php
require_once __DIR__ . '/includes/auth.php';
requireRole('Student');

define('TUTOR_EMAIL', 'tutor@csd.auth.test.gr');

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verifyCsrf();

    $sender = trim($_POST['sender'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $body = trim($_POST['message'] ?? '');

    if (!filter_var($sender, FILTER_VALIDATE_EMAIL)) {
        $message = 'Παρακαλώ εισάγετε έγκυρη διεύθυνση email αποστολέα.';
    } elseif ($subject === '' || $body === '') {
        $message = 'Συμπληρώστε θέμα και κείμενο.';
    } else {
        $headers = 'From: ' . $sender . "\r\n" .
                   'Reply-To: ' . $sender . "\r\n" .
                   'X-Mailer: PHP/' . phpversion();

        if (@mail(TUTOR_EMAIL, $subject, $body, $headers)) {
            $message = 'Το email στάλθηκε με επιτυχία.';
        } else {
            $message = 'Η αποστολή email απέτυχε. Χρησιμοποιήστε τη διεύθυνση mailto παρακάτω.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Επικοινωνία</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <div id="box1"><h1>Επικοινωνία</h1></div>
    <div id="container">
        <div id="box2"><?php include __DIR__ . '/includes/nav_student.php'; ?></div>
        <div id="box3">
            <p>Η συγκεκριμένη ιστοσελίδα θα περιέχει δύο δυνατότητες για την αποστολή email στον καθηγητή:</p>
            <ul>
                <li>Μέσω web φόρμας</li>
                <li>Με χρήση email διεύθυνσης</li>
            </ul>
            <h2 style="font-size: 20px;"><span style="color: green;">Αποστολή e-mail μέσω web φόρμας</span></h2>

            <?php if ($message !== ''): ?>
                <p><?php echo h($message); ?></p>
            <?php endif; ?>

            <form action="communication_student.php" method="post">
                <?php echo csrfField(); ?>
                <label for="sender">Αποστολέας:</label>
                <input type="email" id="sender" name="sender" required style="margin-bottom: 30px;"><br>

                <label for="subject">Θέμα:</label>
                <input type="text" id="subject" name="subject" required style="margin-bottom: 30px;"><br>

                <label for="message">Κείμενο:</label>
                <textarea id="message" name="message" required style="margin-bottom: 0px;"></textarea><br>

                <input type="submit" value="Αποστολή">
            </form>

            <h2 style="font-size: 20px;"><span style="color: green;">Αποστολή e-mail με χρήση e-mail διεύθυνσης</span></h2>
            <p>Εναλλακτικά, μπορείτε να αποστείλετε e-mail στην παρακάτω διεύθυνση ηλεκτρονικού ταχυδρομείου: <a href="mailto:<?php echo h(TUTOR_EMAIL); ?>"><?php echo h(TUTOR_EMAIL); ?></a></p>
        </div>
    </div>

</body>
</html>
