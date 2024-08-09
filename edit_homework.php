<?php
// Σύνδεση με τη βάση δεδομένων
include_once('db_connection.php');

if(isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    if(isset($_POST['Stoxoi']) && isset($_POST['Paradotea']) && isset($_POST['Hmeromhnia'])) {
        $Stoxoi = $_POST['Stoxoi'];
        $Paradotea = $_POST['Paradotea'];
        $Hmeromhnia = $_POST['Hmeromhnia'];

        // Πληροφορίες αρχείου
        if(isset($_FILES['fileUpload']) && $_FILES['fileUpload']['error'] == UPLOAD_ERR_OK) {
            $file_name = $_FILES['fileUpload']['name'];
            $file_tmp = $_FILES['fileUpload']['tmp_name'];

            $upload_directory = "Files/";
            $upload_file = $upload_directory . basename($file_name);
            
            // Μεταφορά του αρχείου στον τελικό προορισμό
            if (move_uploaded_file($file_tmp, $upload_file)) {
                // Ερώτημα για ενημέρωση της ανακοίνωσης με το νέο αρχείο
                $sql = "UPDATE homeworks SET Stoxoi='$Stoxoi', Ekfwnhsh='$file_name', Paradotea='$Paradotea', Hmeromhnia='$Hmeromhnia' WHERE Ayxwn_arithmos=$id";

                if ($conn->query($sql) === TRUE) {
                    echo "Επιτυχής ενημέρωση εγγράφου!";
                } else {
                    echo "Σφάλμα κατά την ενημέρωση του εγγράφου: " . $conn->error;
                }
            } else {
                echo "Σφάλμα κατά την μεταφορά του αρχείου.";
            }
        } else {
            // Αν δεν έχει ανακτηθεί αρχείο, να αναφέρετε το σφάλμα
            echo "Σφάλμα κατά τη μεταφόρτωση του αρχείου ή δεν έχει επιλεγεί αρχείο.";
        }
    }

    // Ερώτημα για την επιλεγμένη ανακοίνωση
    $sql = "SELECT Ayxwn_arithmos, Stoxoi, Ekfwnhsh, Paradotea, Hmeromhnia FROM homeworks WHERE Ayxwn_arithmos = $id";
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
            <title>Επεξεργασία εγγράφου</title>
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
        </head>
        <body>
            <div id="login-container">
                <form action="edit_homework.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
                    <label for="Stoxoi">Στόχοι:</label><br>
                    <textarea id="Stoxoi" name="Stoxoi" required><?php echo $row['Stoxoi']; ?></textarea><br>
                    <label for="Ekfwnhsh">Εκφώνηση:</label><br>
                    <input type="file" id="Ekfwnhsh" name="fileUpload" required><br>
                    <label for="Paradotea">Παραδοτέα:</label><br>
                    <textarea id="Paradotea" name="Paradotea" required><?php echo $row['Paradotea']; ?></textarea><br>
                    <label for="Hmeromhnia">Ημερομηνία παράδοσης:</label><br>
                    <input type="text" id="Hmeromhnia" name="Hmeromhnia" value="<?php echo $row['Hmeromhnia']; ?>" required><br>
                    <input type="submit" value="Αποθήκευση" id="login-button">
                </form>
            </div>
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

