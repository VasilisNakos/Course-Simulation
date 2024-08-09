<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Επικοινωνία</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    
    <div id="box1"><h1>Επικοινωνία</h1></div>
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
        <div id="box3">
            <p> Η συγκεκριμένη ιστοσελίδα θα περιέχει δύο δυνατότητες για την αποστολή email στον καθηγητή:</p>
            <ul>
                <li>Μέσω web φόρμας </li>
                <li> Με χρήση email διεύθυνσης </li>
            </ul>
            <h2 style="font-size: 20px;"><span style="color: green;">Αποστολή e-mail μέσω web φόρμας</span></h2>

                <form action="mailto:your-email@example.com" method="post" enctype="text/plain">
                    <label for="sender">Αποστολέας:</label>
                    <input type="text" id="sender" name="sender" required style="margin-bottom: 30px;"><br>
                    <label for="subject">Θέμα:</label>
                    <input type="text" id="subject" name="subject" required style="margin-bottom: 30px;"><br>
                    <label for="message">Κείμενο:</label>
                    <textarea id="message" name="message" required style="margin-bottom: 0px;"></textarea><br>
                    <input type="submit" value="Αποστολή">
                </form>

            

            <h2 style="font-size: 20px;"><span style="color: green;">Αποστολή e-mail με χρήση e-mail διεύθυνσης</span></h2>
            <p>Εναλλακτικά, μπορείτε να αποστείλετε e-mail στην παρακάτω διεύθυνση ηλεκτρονικού ταχυδρομείου: <a href="mailto:tutor@csd.auth.test.gr">tutor@csd.auth.test.gr</a></p>
        </div>
    </div>

</body>

</html>
