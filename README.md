Εκπαιδευτικά Περιβάλλοντα Διαδικτύου
Εργασία Μέρος B
Ονοματεπώνυμο: Νάκος Βασίλειος   ΑΕΜ: 4041

Περιγραφή Υλοποιήσεων:
add_announcement.php:  Το αρχείο add_announcement.php είναι υπεύθυνο για τη δημιουργία και προσθήκη νέων ανακοινώσεων στη βάση δεδομένων του συστήματος. Περιλαμβάνει τόσο την HTML φόρμα για την εισαγωγή των ανακοινώσεων όσο και τον κώδικα PHP για την αποθήκευση αυτών των δεδομένων στη βάση.

Add_document.php:  Το αρχείο add_document.php επιτρέπει την προσθήκη νέων εγγράφων στη βάση δεδομένων μέσω μιας HTML φόρμας. Συνδυάζει τη χρήση HTML για την εμφάνιση της φόρμας και PHP για την αποθήκευση των δεδομένων στη βάση δεδομένων και τη διαχείριση των αρχείων που μεταφορτώνονται.

Add_homework.php: Το αρχείο add_homework.php επιτρέπει την προσθήκη νέων εργασιών (homeworks) στη βάση δεδομένων μέσω μιας HTML φόρμας. Συνδυάζει τη χρήση HTML για την εμφάνιση της φόρμας και PHP για την αποθήκευση των δεδομένων στη βάση δεδομένων και τη διαχείριση των αρχείων που μεταφορτώνονται.

Add_user.php: Το αρχείο add_user.php επιτρέπει την προσθήκη νέων χρηστών στη βάση δεδομένων μέσω μιας HTML φόρμας. Συνδυάζει τη χρήση HTML για την εμφάνιση της φόρμας και PHP για την αποθήκευση των δεδομένων στη βάση δεδομένων.

Announcement_student.php: Το αρχείο announcement_student.php είναι μια σελίδα η οποία εμφανίζει ανακοινώσεις για τους φοιτητές, με δυνατότητα πλοήγησης σε άλλες σχετικές σελίδες. Χρησιμοποιεί HTML για τη διάταξη της σελίδας και PHP για την απόκτηση δεδομένων από τη βάση δεδομένων και την εμφάνιση των ανακοινώσεων.

Announcement_tutor.php: Το αρχείο announcement_tutor.php αποτελεί μια σελίδα ανακοινώσεων για τους καθηγητές, η οποία επιτρέπει στους χρήστες να διαχειρίζονται (δημιουργία, επεξεργασία, διαγραφή) τις ανακοινώσεις που σχετίζονται με τα μαθήματά τους. Η σελίδα χρησιμοποιεί σύνδεση με βάση δεδομένων για την ανάκτηση των ανακοινώσεων και PHP για τη δημιουργία δυναμικού περιεχομένου.

Communication_student.php: Το αρχείο communication_student.php παρέχει στους φοιτητές δύο τρόπους για αποστολή email προς τον καθηγητή μέσω web φόρμας και χρησιμοποιώντας μια συγκεκριμένη διεύθυνση email.

Db_connection.php: Το αρχείο db_connection.php παρέχει τη σύνδεση με τη βάση δεδομένων MySQL στον διακομιστή webpagesdb.it.auth.gr στη θύρα 3306, χρησιμοποιώντας το όνομα χρήστη και τον κωδικό πρόσβασης . Η βάση δεδομένων που επιλέγεται είναι η student4041partB.

Delete_announcement.php:  Το αρχείο delete_announcement.php επιτελεί τη λειτουργία της διαγραφής μιας ανακοίνωσης από τη βάση δεδομένων με βάση το αναγνωριστικό της ανακοίνωσης (Ayxwn_arithmos).

Delete_document.php: Το αρχείο delete_document.php είναι υπεύθυνο για τη διαγραφή ενός εγγράφου από τη βάση δεδομένων με βάση το αναγνωριστικό του εγγράφου (Ayxwn_arithmos).
Delete_homework.php: Το αρχείο delete_homework.php είναι υπεύθυνο για τη διαγραφή μιας εργασίας από τη βάση δεδομένων με βάση το αναγνωριστικό της εργασίας (Ayxwn_arithmos).

Documents_student.php: Το αρχείο documents_student.php είναι υπεύθυνο για την εμφάνιση εγγράφων μαθήματος στους φοιτητές από τη βάση δεδομένων. Περιλαμβάνει σύνδεση με τη βάση, ερώτημα SQL για ανάκτηση των εγγράφων, εμφάνιση αποτελεσμάτων σε δομή HTML και κλείσιμο της σύνδεσης. Αν δεν υπάρχουν εγγράφα, εμφανίζει αντίστοιχο μήνυμα.

Documents_tutor.php: Το αρχείο documents_tutor.php είναι υπεύθυνο για την παρουσίαση και διαχείριση των εγγράφων μαθήματος από τους καθηγητές. Περιλαμβάνει δυνατότητες προσθήκης, επεξεργασίας και διαγραφής εγγράφων. Εάν δεν υπάρχουν εγγραφές, εμφανίζει αντίστοιχο μήνυμα.

edit_announcement.php: Το αρχείο edit_announcement.php είναι υπεύθυνο για την επεξεργασία υπάρχουσας ανακοίνωσης στη βάση δεδομένων. Αρχικά, ελέγχει την ύπαρξη και την εγκυρότητα του αναγνωριστικού της ανακοίνωσης στο URL. Στη συνέχεια, εάν η ανακοίνωση υπάρχει, προβάλλει μια φόρμα επεξεργασίας με τα πεδία της ημερομηνίας, του θέματος και του κύριου κειμένου προσποιούμενης ανακοίνωσης. Μετά την υποβολή της φόρμας, ενημερώνει την ανακοίνωση στη βάση δεδομένων. Εάν δεν βρεθεί καμία ανακοίνωση με το συγκεκριμένο αναγνωριστικό, εμφανίζει αντίστοιχο μήνυμα λάθους.

edit_document.php: Το αρχείο edit_document.php είναι υπεύθυνο για την επεξεργασία υπάρχοντος εγγράφου στη βάση δεδομένων. Αρχικά, ελέγχει την ύπαρξη και την εγκυρότητα του αναγνωριστικού του εγγράφου στο URL. Αν υπάρχει, προβάλλει μια φόρμα επεξεργασίας με τα πεδία του τίτλου, της περιγραφής και του αρχείου. Μετά την υποβολή της φόρμας, ενημερώνει το έγγραφο στη βάση δεδομένων, συμπεριλαμβανομένης της μεταφόρτωσης του νέου αρχείου. Εάν δεν βρεθεί έγγραφο με το συγκεκριμένο αναγνωριστικό, εμφανίζει αντίστοιχο μήνυμα λάθους.

Edit_homework.php: Το αρχείο edit_homework.php είναι υπεύθυνο για την επεξεργασία υπάρχουσας εργασίας στη βάση δεδομένων. Ελέγχει την ύπαρξη του αναγνωριστικού της εργασίας στο URL. Αν είναι έγκυρο, προβάλλει μια φόρμα επεξεργασίας με πεδία για στόχους, παραδοτέα, ημερομηνία παράδοσης και αρχείο εκφώνησης. Μετά την υποβολή, ενημερώνει την εργασία στη βάση δεδομένων και μεταφορτώνει το νέο αρχείο. Αν δεν βρεθεί η εργασία ή δεν παρέχεται αναγνωριστικό, εμφανίζει αντίστοιχα μηνύματα λάθους.

homework_student.php: Το αρχείο homework_student.php εμφανίζει μια λίστα εργασιών για τους φοιτητές. Eμφανίζει τις εργασίες με τα στοιχεία τους, όπως στόχοι, εκφώνηση, παραδοτέα και ημερομηνία παράδοσης. Αν δεν υπάρχουν εργασίες, εμφανίζεται μήνυμα που ενημερώνει ότι δεν υπάρχουν εργασίες.

Homework_tutor.php: Το αρχείο homework_tutor.php επιτρέπει στους διδάσκοντες να διαχειρίζονται τις εργασίες που έχουν αναθέσει. Περιλαμβάνει λειτουργίες για προσθήκη νέας εργασίας, καθώς και για διαγραφή και επεξεργασία υπαρχουσών εργασιών. Κάθε εργασία εμφανίζεται με τις λεπτομέρειες της (στόχοι, εκφώνηση, παραδοτέα, ημερομηνία παράδοσης) και συνδέσμους για διαγραφή ή επεξεργασία.

Index_student.php,Index_tutor.php: Tα δύο αρχεία index_student.php και index_tutor.php έχουν παρόμοια δομή και περιεχόμενο.Aποτελoύν την αρχική σελίδα με τη μόνη διαφορά να είναι οι σύνδεσμοι στο μενού πλοήγησης, που οδηγούν σε σελίδες σχετικές με τους φοιτητές ή τους καθηγητές αντίστοιχα.

Login.php: Το αρχείο login.php χρησιμοποιείται για την είσοδο χρηστών στο σύστημα, ελέγχοντας τα δεδομένα που υποβάλλονται από τη φόρμα εισόδου (<form>). Αν η πιστοποίηση είναι επιτυχής, ο χρήστης κατευθύνεται στην αντίστοιχη σελίδα ανάλογα με τον ρόλο του (φοιτητής ή καθηγητής).

Styles.css: Το αρχείο styles.css παρέχει τον στιλιστικό ορισμό για τη σελίδα HTML που απεικονίζει την εφαρμογή.

Βάση δεδομένων Πίνακες:  
1. announcements: Ο πίνακας αυτός χρησιμοποιείται για να διατηρεί και να παρουσιάζει όλες τις ανακοινώσεις που αφορούν τους χρήστες της εφαρμογής
2. documents: Αυτός ο πίνακας αποθηκεύει όλα τα έγγραφα που απαιτούνται για το μάθημα
3.homeworks: Αυτός ο πίνακας χρησιμοποιείται για την καταχώρηση και παρουσίαση όλων των εργασιών που πρέπει να εκπονήσουν οι χρήστες.
4.user: Ο πίνακας αυτός χρησιμοποιείται για τη διαχείριση των χρηστών και των διαπιστευτηρίων τους στο σύστημα. Περιλαμβάνει όλες τις απαραίτητες πληροφορίες τους για την αυθεντικοποίηση και τον έλεγχο πρόσβασης .
Στοιχεία για πρόσβαση χρηστών:
Profile πρόσβασης στην βάση δεδομένων:  login: Vasileios  password: ergasia123
Role:Student   Loginame: petrospanopoulos@gmail.com  Password: diadiktyo1234
Role:Student   Loginame: thanasis4@gmail.com   Password: ekpaideytika1234
Role:Tutor  Loginame: vasilisnakos2002@gmail.com   Password: mathima1234
Link δυναμικού ιστοχώρου: vasinako.webpages.auth.gr/4041partB/









