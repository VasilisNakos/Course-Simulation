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
    <title>Εργασίες</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <div id="box1"><h1>Εργασίες</h1></div>
    <div id="container">
        <div id="box2"><?php include __DIR__ . '/includes/nav_student.php'; ?></div>
        <div id="box3" class="announcement-box">
            <?php
            $sql = 'SELECT Ayxwn_arithmos, Stoxoi, Ekfwnhsh, Paradotea, Hmeromhnia FROM homeworks ORDER BY Ayxwn_arithmos DESC';
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $id = (int)$row['Ayxwn_arithmos'];
                    echo '<div class="announcement">';
                    echo '<h2 style="font-size: 20px;"><span style="color: green;">Εργασία ' . h((string)$id) . '</span></h2>';
                    echo '<p>Στόχοι: ' . nl2br(h($row['Stoxoi'])) . '</p>';
                    echo '<p>Κατεβάστε την εκφώνηση της εργασίας από <a href="' . h(downloadPath('homework', $id)) . '">εδώ</a></p>';
                    echo '<p>Παραδοτέα: ' . nl2br(h($row['Paradotea'])) . '</p>';
                    echo '<p><span style="color: red;">Ημερομηνία Παράδοσης:</span> ' . h($row['Hmeromhnia']) . '</p>';
                    echo '</div>';
                }
            } else {
                echo 'Δεν υπάρχουν Εργασίες.';
            }

            $conn->close();
            ?>
            <a href="#top">Top</a>
        </div>
    </div>

</body>
</html>
