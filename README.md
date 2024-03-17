This is a Leave Management System designed to facilitate the management of leave applications for students. The system is built using HTML, CSS, JavaScript, and PHP, with backend database functionality provided by XAMPP SQL.

Features
Login System: Users can log in as either a student or an admin.
Student Dashboard:
View personal details.
Check pending, permitted, or rejected leave applications.
Submit leave applications for personal or medical reasons.
Admin Dashboard:
View leave applications submitted by students.
Process leave applications (approve or reject).
Installation
Clone the repository:
bash
Copy code
git clone https://github.com/your-username/leave-management-system.git
Import the SQL database:

Use phpMyAdmin or MySQL command line to import the provided SQL file (database.sql).
Configure database connection:

Update the database connection details in config.php file.
Launch the application:

Start XAMPP and navigate to http://localhost/leave-management-system/login.html in your web browser.
Usage
Login:

Use the provided credentials for student or admin login.
Student Credentials: (username: student, password: password)
Admin Credentials: (username: admin, password: password)
Student Dashboard:

View personal details and leave application status.
Submit leave applications using the provided forms.
Admin Dashboard:

View leave applications submitted by students.
Process leave applications by approving or rejecting them.
Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.