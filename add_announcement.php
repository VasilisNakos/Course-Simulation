<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add_announcement</title>
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
<!-- Φόρμα προσθήκης νέας ανακοίνωσης -->
<form action="add_announcement.php" method="post">
    <label for="Hmeromhnia">Ημερομηνία:</label><br>
    <input type="text" id="Hmeromhnia" name="Hmeromhnia" required><br>
    <label for="Thema">Θέμα:</label><br>
    <textarea id="Thema" name="Thema" required></textarea><br>
    <label for="Kyriws_Keimeno">Κυρίως Κείμενο:</label><br>
    <textarea id="Kyriws_Keimeno" name="Kyriws_Keimeno" required></textarea><br>
    <input type="submit" value="Υποβολή">
</form>


<?php
// Σύνδεση με τη βάση δεδομένων
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Σύνδεση με τη βάση δεδομένων
    include_once('db_connection.php');

    // Λήψη δεδομένων από τη φόρμα
    $Hmeromhnia = $_POST['Hmeromhnia'];
    $Thema = $_POST['Thema'];
    $Kyriws_Keimeno = $_POST['Kyriws_Keimeno'];

    // Εισαγωγή δεδομένων στη βάση δεδομένων
    $sql = "INSERT INTO announcements (Hmeromhnia,Thema,Kyriws_Keimeno) VALUES ('$Hmeromhnia', '$Thema','$Kyriws_Keimeno')";

    if ($conn->query($sql) === TRUE) {
        echo "Η ανακοίνωση προστέθηκε επιτυχώς!";
    } else {
        echo "Σφάλμα κατά την προσθήκη της ανακοίνωσης: " . $conn->error;
    }

    // Κλείσιμο σύνδεσης
    $conn->close();
}
?>

</body>
</html>