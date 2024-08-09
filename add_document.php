<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add_document</title>
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
<form action="add_document.php" method="post" enctype="multipart/form-data">
    <label for="Title">Τίτλος:</label><br>
    <input type="text" id="Title" name="Title" required><br>
    <label for="descriptions">Περιγραφή:</label><br>
    <textarea id="descriptions" name="descriptions" required></textarea><br>
    <label for="File_name">Αρχείο:</label><br>
    <input type="file" id="File_name" name="File_name" required><br>
    <input type="submit" value="Υποβολή">
</form>


<?php
// Σύνδεση με τη βάση δεδομένων
include_once('db_connection.php');
	
// Εάν έχει υποβληθεί η φόρμα
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Title = $_POST['Title'];
    $descriptions = $_POST['descriptions'];
    
    // Πληροφορίες αρχείου
    $file_name = $_FILES['File_name']['name'];
    $file_tmp = $_FILES['File_name']['tmp_name'];
    
    $upload_directory = "Files/";  
    $upload_file = $upload_directory . basename($file_name);

    
    // Μεταφορά του αρχείου στον τελικό προορισμό
    if (move_uploaded_file($file_tmp, $upload_file)) {
        // Εάν η μεταφορά αρχείου είναι επιτυχής, προσθέστε τα δεδομένα στη βάση δεδομένων
        $sql = "INSERT INTO documents (Title, descriptions, File_name) VALUES ('$Title', '$descriptions', '$file_name')";
        
        if ($conn->query($sql) === TRUE) {
            echo "Το έγγραφο προστέθηκε επιτυχώς!";
        } else {
            echo "Σφάλμα κατά την προσθήκη του εγγράφου: " . $conn->error;
        }
    } else {
        echo "Σφάλμα κατά την μεταφορά του αρχείου.";
    }
}

// Κλείσιμο σύνδεσης
$conn->close();
?>

</body>
</html>