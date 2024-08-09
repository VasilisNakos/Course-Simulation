<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add_user</title>
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

<form action="add_user.php" method="post">
    <label for="Onoma">Όνομα:</label><br>
    <input type="text" id="Onoma" name="Onoma" required><br>
    <label for="Epwnymo">Επώνυμο:</label><br>
    <textarea id="Epwnymo" name="Epwnymo" required></textarea><br>
    <label for="Loginame">Loginame:</label><br>
    <textarea id="Loginame" name="Loginame" required></textarea><br>
    <label for="password">password:</label><br>
    <textarea id="password" name="password" required></textarea><br>
    <label for="role">role:</label><br>
    <textarea id="role" name="role" required></textarea><br>
    <input type="submit" value="Υποβολή">
</form>


<?php
// Σύνδεση με τη βάση δεδομένων
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Σύνδεση με τη βάση δεδομένων
   
	include_once('db_connection.php');

    // Λήψη δεδομένων από τη φόρμα
    $Onoma = $_POST['Onoma'];
    $Epwnymo = $_POST['Epwnymo'];
    $Loginame = $_POST['Loginame'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Εισαγωγή δεδομένων στη βάση δεδομένων
    $sql = "INSERT INTO user ( Onoma, Epwnymo, Loginame, password, role) VALUES ('$Onoma','$Epwnymo','$Loginname','$password','$role')";

    if ($conn->query($sql) === TRUE) {
        echo "O χρήστης προστέθηκε επιτυχώς!";
    } else {
        echo "Σφάλμα κατά την προσθήκη του χρήστη" . $conn->error;
    }

    // Κλείσιμο σύνδεσης
    $conn->close();
}
?>

</body>
</html>