<?php
require_once __DIR__ . '/includes/auth.php';
requireRole('Student');
require_once __DIR__ . '/db_connection.php';
?>
<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ανακοινώσεις</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <div id="box1"><h1>Ανακοινώσεις</h1></div>
    <div id="container">
        <div id="box2"><?php include __DIR__ . '/includes/nav_student.php'; ?></div>
        <div id="box3" class="announcement-box">
            <?php
            $sql = 'SELECT Ayxwn_arithmos, Hmeromhnia, Thema, Kyriws_Keimeno FROM announcements ORDER BY Ayxwn_arithmos DESC';
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="announcement">';
                    echo '<h2 style="font-size: 20px;"><span style="color: green;">Ανακοίνωση ' . h((string)$row['Ayxwn_arithmos']) . '</span></h2>';
                    echo '<p><strong>Ημερομηνία:</strong> ' . h($row['Hmeromhnia']) . '</p>';
                    echo '<p><strong>Θέμα:</strong> ' . h($row['Thema']) . '</p>';
                    echo '<p>' . nl2br(h($row['Kyriws_Keimeno'])) . '</p>';
                    echo '</div>';
                }
            } else {
                echo 'Δεν υπάρχουν ανακοινώσεις.';
            }

            $conn->close();
            ?>
            <a href="#top" style="float:right;">Top</a>
        </div>
    </div>

</body>
</html>
