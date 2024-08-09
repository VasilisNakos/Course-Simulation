<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add_homework</title>
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

<form action="add_homework.php" method="post" enctype="multipart/form-data">
    <label for="Stoxoi">Στόχοι:</label><br>
    <input type="text" id="Stoxoi" name="Stoxoi" required><br>
    <label for="Ekfwnhsh">Εκφώνηση:</label><br>
    <input type="file" id="Ekfwnhsh" name="Ekfwnhsh" required><br>
    <label for="Paradotea">Παραδοτέα:</label><br>
    <textarea id="Paradotea" name="Paradotea" required></textarea><br>'
    <label for="Hmeromhnia">Ημερομηνία παράδοσης:</label><br>
    <input type="text" id="Hmeromhnia" name="Hmeromhnia" required><br>
    <input type="submit" value="Υποβολή">
</form>


<?php
// Σύνδεση με τη βάση δεδομένων
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
	include_once('db_connection.php');

    // Λήψη δεδομένων από τη φόρμα
    $Stoxoi = $_POST['Stoxoi'];
    $Ekfwnhsh = $_POST['Ekfwnhsh'];
    $Paradotea = $_POST['Paradotea'];
    $Hmeromhnia = $_POST['Hmeromhnia'];

     // Πληροφορίες αρχείου
    $file_name = $_FILES['Ekfwnhsh']['name'];
    $file_tmp = $_FILES['Ekfwnhsh']['tmp_name'];
    
    $upload_directory = "Files/";  
    $upload_file = $upload_directory . basename($file_name);
        
    // Εισαγωγή δεδομένων στη βάση δεδομένων
        // Μεταφορά του αρχείου στον τελικό προορισμό
    if (move_uploaded_file($file_tmp, $upload_file)) {
            // Εάν η μεταφορά αρχείου είναι επιτυχής, προσθέστε τα δεδομένα στη βάση δεδομένων
        $sql = "INSERT INTO homeworks (Stoxoi,Ekfwnhsh,Paradotea, Hmeromhnia) VALUES ('$Stoxoi', '$file_name','$Paradotea','$Hmeromhnia')";
            
        if ($conn->query($sql) === TRUE) {
            echo "Το έγγραφο προστέθηκε επιτυχώς!";
        } else {
            echo "Σφάλμα κατά την προσθήκη του εγγράφου: " . $conn->error;
        }
    } else {
        echo "Σφάλμα κατά την μεταφορά του αρχείου.";
    }


    // Κλείσιμο σύνδεσης
    $conn->close();
}
?>

</body>
</html>