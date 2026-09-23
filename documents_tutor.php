<?php
require_once __DIR__ . '/includes/auth.php';
requireRole('Tutor');
require_once __DIR__ . '/db_connection.php';
?>
<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Έγραφα μαθήματος</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <div id="box1"><h1>Έγραφα μαθήματος</h1></div>
    <div id="container">
        <div id="box2"><?php include __DIR__ . '/includes/nav_tutor.php'; ?></div>
        <div id="box3" class="announcement-box">
            <div class="announcement">
                <a href="add_document.php">Προσθήκη νέου εγγράφου</a>
            </div>
            <?php
            $sql = 'SELECT Ayxwn_arithmos, Title, descriptions, File_name FROM documents ORDER BY Ayxwn_arithmos DESC';
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $id = (int)$row['Ayxwn_arithmos'];
                    echo '<div class="announcement">';
                    echo '<h2 style="font-size: 20px;"><span style="color: green;">Ενότητα ' . h((string)$id) . '</span> ';
                    echo '<a href="edit_document.php?id=' . $id . '">[επεξεργασία]</a> ';
                    echo '<form method="post" action="delete_document.php" style="display:inline;" onsubmit="return confirm(\'Διαγραφή εγγράφου;\');">';
                    echo csrfField();
                    echo '<input type="hidden" name="id" value="' . $id . '">';
                    echo '<button type="submit" style="background:none;border:none;color:#00f;text-decoration:underline;cursor:pointer;padding:0;">[διαγραφή]</button>';
                    echo '</form></h2>';
                    echo '<p>Τίτλος: <strong>' . h($row['Title']) . '</strong></p>';
                    echo '<p>Περιγραφή: ' . nl2br(h($row['descriptions'])) . '</p>';
                    echo '<a href="' . h(downloadPath('document', $id)) . '">Download</a>';
                    echo '</div>';
                }
            } else {
                echo 'Δεν υπάρχουν έγγραφα.';
            }

            $conn->close();
            ?>
            <a href="#top" style="float:right;">Top</a>
        </div>
    </div>

</body>
</html>
