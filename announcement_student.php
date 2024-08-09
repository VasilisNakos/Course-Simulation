<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ανακοινώσεις</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    
    <div id="box1"><h1>Ανακοινώσεις</h1></div>
    <div id="container">
        <div id="box2"><nav>
            <ul>
                <li><a href="index_student.php">Αρχική σελίδα</a></li>
                <li><a href="announcement_student.php">Ανακοινώσεις</a></li>
                <li><a href="communication_student.php">Επικοινωνία</a></li>
                <li><a href="documents_student.php">Έγραφα μαθήματος</a></li>
                <li><a href="homework_student.php">Εργασίες</a></li>
            </ul>
        </nav>
        </div>
        <div id="box3" class="announcement-box">
            <?php
            // Σύνδεση με τη βάση δεδομένων
            include_once('db_connection.php');

            // Ερώτημα για τις ανακοινώσεις
            $sql = "SELECT Ayxwn_arithmos, Hmeromhnia, Thema, Kyriws_Keimeno FROM announcements ORDER BY Ayxwn_arithmos DESC";
            $result = $conn->query($sql);

            // Έλεγχος αν υπάρχουν αποτελέσματα
            if ($result->num_rows > 0) {
                // Εμφάνιση αποτελεσμάτων
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='announcement'>";
                    echo "<h2 style='font-size: 20px;'><span style='color: green;'><p>Ανακοίνωση {$row['Ayxwn_arithmos']}</p></span></h2>";
                    echo "<p><strong>Ημερομηνία:</strong> {$row['Hmeromhnia']}</p>";
                    echo "<p><strong>Θέμα:</strong> {$row['Thema']}</p>";
                    echo "<p>{$row['Kyriws_Keimeno']}</p>";
                    echo "</div>";
                }
            } else {
                echo "Δεν υπάρχουν ανακοινώσεις.";
            }

            // Κλείσιμο σύνδεσης
            $conn->close();
            ?>
            <a href="#top" style="float:right;">Top</a>
        </div>
    </div>

</body>

</html>
