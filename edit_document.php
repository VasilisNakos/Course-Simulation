<?php
// Σύνδεση με τη βάση δεδομένων
include_once('db_connection.php');

if(isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    if(isset($_POST['Title']) && isset($_POST['descriptions']) && isset($_FILES['File_name'])) {
        $Title = $_POST['Title'];
        $descriptions = $_POST['descriptions'];
        $file_name = $_FILES['File_name']['name'];
        
        // Μεταφορά του αρχείου στον διακομιστή
        $upload_directory = "Files/";  
        $upload_file = $upload_directory . basename($file_name);
        
        if (move_uploaded_file($_FILES['File_name']['tmp_name'], $upload_file)) {
            // Ερώτημα για ενημέρωση της ανακοίνωσης
            $sql = "UPDATE documents SET Title='$Title', descriptions='$descriptions', File_name='$file_name' WHERE Ayxwn_arithmos=$id";
            
            if ($conn->query($sql) === TRUE) {
                echo "Επιτυχής ενημέρωση εγγράφου!";
            } else {
                echo "Σφάλμα κατά την ενημέρωση του εγγράφου: " . $conn->error;
            }
        } else {
            echo "Σφάλμα κατά τη μεταφόρτωση του αρχείου.";
        }
    }

    // Ερώτημα για την επιλεγμένη ανακοίνωση
    $sql = "SELECT Ayxwn_arithmos, Title, descriptions, File_name FROM documents WHERE Ayxwn_arithmos = $id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        // Εμφάνιση φόρμας επεξεργασίας
        ?>
        <!DOCTYPE html>
        <html lang="el">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Επεξεργασία εγγράφου</title>
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
            <form action="edit_document.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
                <label for="Title">Τίτλος:</label><br>
                <input type="text" id="Title" name="Title" value="<?php echo $row['Title']; ?>" required><br>
                <label for="descriptions">Περιγραφή:</label><br>
                <textarea id="descriptions" name="descriptions" required><?php echo $row['descriptions']; ?></textarea><br>
                <label for="File_name">Αρχείο:</label><br>
                <input type="file" id="File_name" name="File_name" required><br>
                <input type="submit" value="Αποθήκευση">
            </form>
        </body>
        </html>
        <?php
    } else {
        echo "Δεν βρέθηκε έγγραφο με αναγνωριστικό $id";
    }
} else {
    echo "Δεν παρείχεται αναγνωριστικό εγγράφου.";
}

// Κλείσιμο σύνδεσης
$conn->close();
?>
