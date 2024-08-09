<?php
// Σύνδεση με τη βάση δεδομένων
include_once('db_connection.php');

if(isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    if(isset($_POST['Hmeromhnia']) && isset($_POST['Thema']) && isset($_POST['Kyriws_Keimeno'])) {
        $Hmeromhnia = $_POST['Hmeromhnia'];
        $Thema = $_POST['Thema'];
        $Kyriws_Keimeno = $_POST['Kyriws_Keimeno'];

        // Ερώτημα για ενημέρωση της ανακοίνωσης
        $sql = "UPDATE announcements SET Hmeromhnia='$Hmeromhnia', Thema='$Thema', Kyriws_Keimeno='$Kyriws_Keimeno' WHERE Ayxwn_arithmos=$id";

        if ($conn->query($sql) === TRUE) {
            echo "Επιτυχής ενημέρωση ανακοίνωσης!";
        } else {
            echo "Σφάλμα κατά την ενημέρωση της ανακοίνωσης: " . $conn->error;
        }
    }

    // Ερώτημα για την επιλεγμένη ανακοίνωση
    $sql = "SELECT Ayxwn_arithmos, Hmeromhnia, Thema, Kyriws_Keimeno FROM announcements WHERE Ayxwn_arithmos = $id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        // Εμφάνιση φόρμας επεξεργασίας
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Επεξεργασία Ανακοίνωσης</title>
        </head>
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
    </style>
        <body>
            <form action="edit_announcement.php?id=<?php echo $id; ?>" method="post">
                <label for="Hmeromhnia">Ημερομηνία:</label><br>
                <input type="text" id="Hmeromhnia" name="Hmeromhnia" value="<?php echo $row['Hmeromhnia']; ?>" required><br>
                <label for="Thema">Θέμα:</label><br>
                <textarea id="Thema" name="Thema" required><?php echo $row['Thema']; ?></textarea><br>
                <label for="Kyriws_Keimeno">Κύριος Κείμενο:</label><br>
                <textarea id="Kyriws_Keimeno" name="Kyriws_Keimeno" required><?php echo $row['Kyriws_Keimeno']; ?></textarea><br>
                <input type="submit" value="Αποθήκευση">
            </form>
        </body>
        </html>
        <?php
    } else {
        echo "Δεν βρέθηκε ανακοίνωση με αναγνωριστικό $id";
    }
} else {
    echo "Δεν παρείχεται αναγνωριστικό ανακοίνωσης.";
}

// Κλείσιμο σύνδεσης
$conn->close();
?>

