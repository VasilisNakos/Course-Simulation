<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
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
    <h2>Πιστοποίηση</h2>
    <form action="login.php" method="post">   
        <div>
            <label for="Loginame">Username:</label>
            <input type="text" id="login" name="Loginame" required style="margin-bottom: 30px;"><br>
        </div>
    
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
    
        <div>
            <input type="submit" id="login-button" value="Login">
        </div>
    </form>
    
</div>

<?php


// Σύνδεση με τη βάση δεδομένων
$conn = new mysqli('webpagesdb.it.auth.gr:3306','Vasileios','ergasia123','student4041partB');

session_start(); // Ξεκινάει τη συνεδρία

// Έλεγχος αν ο χρήστης έχει υποβάλει τη φόρμα
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Πάρτε τις τιμές που υποβλήθηκαν από τη φόρμα εισόδου
    $Loginame = $_POST['Loginame'];
    $password = $_POST['password'];

    // Εκτέλεση ερωτήματος στη βάση δεδομένων για επικύρωση του χρήστη
    $sql = "SELECT * FROM user WHERE Loginame = '$Loginame' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    // Έλεγχος αν υπάρχει τουλάχιστον ένας χρήστης με αυτά τα στοιχεία
    if (mysqli_num_rows($result) == 1) {
        // Επιτυχής σύνδεση - ανάκατευθύνετε τον χρήστη στην κατάλληλη σελίδα ανάλογα με τον ρόλο του
        $row = mysqli_fetch_assoc($result);
        $_SESSION['role'] = $row['role'];
        if ($row['role'] == 'Student' ) {
            header('Location: index_student.php');
            exit();
        }
         else if($row['role'] == 'Tutor'){
            header('Location: index_tutor.php');
            exit();
        }
        else{
        // Αποτυχία επικύρωσης - εμφανίστε ένα μήνυμα σφάλματος
        echo "Λανθασμένο όνομα χρήστη ή κωδικός πρόσβασης.";
        }
    }

}
?> 

</body>
</html>