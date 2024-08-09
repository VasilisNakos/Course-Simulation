<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Εργασίες</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    
    <div id="box1"><h1>Εργασίες</h1></div>
    <div id="container">
        <div id="box2"><nav>
            <ul>
                <li><a href="index_tutor.php">Αρχική σελίδα</a></li>
                <li><a href="announcement_tutor.php">Ανακοινώσεις</a></li>
                <li><a href="communication_tutor.php">Επικοινωνία</a></li>
                <li><a href="documents_tutor.php">Έγραφα μαθήματος</a></li>
                <li><a href="homework_tutor.php">Εργασίες</a></li>
            </ul>
        </nav>
        </div>
        <div id="box3" class="announcement-box">
            <div class="announcement">
                <a href="add_homework.php">Προσθήκη νέας εργασίας</a>
            </div>
            <?php
            // Σύνδεση με τη βάση δεδομένων
            include_once('db_connection.php');

            // Ερώτημα για τις ανακοινώσεις
            $sql = "SELECT Ayxwn_arithmos, Stoxoi, Ekfwnhsh, Paradotea, Hmeromhnia FROM homeworks ORDER BY Ayxwn_arithmos DESC";
            $result = $conn->query($sql);

            // Έλεγχος αν υπάρχουν αποτελέσματα
            if ($result->num_rows > 0) {
                // Εμφάνιση αποτελεσμάτων
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='announcement'>";
                    echo "<h2 style='font-size: 20px;'><span style='color: green;'>Εργασία {$row['Ayxwn_arithmos']}</span> <a href='delete_homework.php?id={$row['Ayxwn_arithmos']}';'>[διαγραφή]</a> <a href='edit_homework.php?id={$row['Ayxwn_arithmos']}';'>[επεξεργασία]</a></h2>";
                    echo "<p>Στόχοι: {$row['Stoxoi']}</p>";
                    echo "<p>Κατεβάστε την εκφώνηση της εργασίας από</p><a href='{$row['Ekfwnhsh']}'>εδώ</a>";
                    echo "<p>Παραδοτέα:{$row['Paradotea']}</p>";
                    echo "<p><span style='color: red;'>Ημερομηνία Παράδοσης:</span>{$row['Hmeromhnia']}</p>";
                    echo "</div>";
                }
            } else {
                echo "Δεν υπάρχουν Εργασίες.";
            }

            // Κλείσιμο σύνδεσης
            $conn->close();
            ?>
            <a href="#top">Top</a>
        </div>
    </div>

</body>

</html>
