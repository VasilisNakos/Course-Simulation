<?php require_once __DIR__ . '/includes/auth.php'; requireRole('Tutor'); ?>
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
        <div id="box2"><?php include __DIR__ . '/includes/nav_tutor.php'; ?></div>
        <div id="box3">
            <p>Η συγκεκριμένη ιστοσελίδα θα περιέχει δύο δυνατότητες για την αποστολή email στον καθηγητή:</p>
            <ul>
                <li>Μέσω web φόρμας</li>
                <li>Με χρήση email διεύθυνσης</li>
            </ul>
            <h2 style="font-size: 20px;"><span style="color: green;">Αποστολή e-mail μέσω web φόρμας</span></h2>
            <p>Οι φοιτητές μπορούν να σας στείλουν email μέσω της σελίδας επικοινωνίας φοιτητή.</p>

            <h2 style="font-size: 20px;"><span style="color: green;">Αποστολή e-mail με χρήση e-mail διεύθυνσης</span></h2>
            <p>Διεύθυνση ηλεκτρονικού ταχυδρομείου: <a href="mailto:tutor@csd.auth.test.gr">tutor@csd.auth.test.gr</a></p>
        </div>
    </div>

</body>
</html>
