# Educational Environment Platform

An educational platform was developed for announcements, document sharing,  
assignment management, and communication between students and instructors within the framework  
of a university course.

## Technologies:
* **Back-End:** PHP (User Management, CRUD operations)
* **Front-End:** HTML, CSS (UI/UX)
* **Database:** MySQL (Database Management)

## Features:

1. User Registration/Login System (Roles: Students & Instructors)
2. Posting Announcements & Document Sharing
3. Assignment Management (Submission & Evaluation)
4. Email Communication

---

## Local XAMPP Setup

1. Start Apache and MySQL in XAMPP.
2. Import the database:
   ```bash
   mysql -u root -e "CREATE DATABASE IF NOT EXISTS student4041partB CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;"
   mysql -u root student4041partB < student4041partB.sql
   ```
3. Ensure `Files/` exists and is writable (created automatically on first upload).
4. Open `http://localhost/Course-Simulation/` in your browser.

Database connection defaults are in `db_connection.php` (`localhost`, user `root`, empty password).

## Test accounts (local)

After importing `student4041partB.sql`, three demo users are seeded (2 students, 1 tutor). Passwords are stored as bcrypt hashes; log in with the same demo passwords from the original course deployment. Plaintext passwords are no longer committed in this repository.
