# Quiz Master

## Description
Quiz Master is a web-based quiz application that allows users to take quizzes on various topics. The application stores user scores and provides feedback on quiz performance. Admins can manage users, questions, and view analytics through a dedicated admin panel.

## Technologies
- PHP
- MySQL
- HTML
- CSS
- Bootstrap
- Chart.js (for analytics)

## Features
- User Registration and Login
- Quiz Participation
- Profile Management
- Admin Dashboard
- User Management (Admin)
- Question Management (Admin)
- Analytics (Admin)

## Setup Instructions

1. Clone the repository:
    ```sh
    git clone https://github.com/mohammedmxz/quiz_master.git
    ```

2. Move into the project directory:
    ```sh
    cd quiz_master
    ```

3. Configure the database:
    - Create a MySQL database named `quiz_master`.
    - Import the `quiz_master.sql` file to set up the necessary tables.

4. Update the database configuration in `config/database.php`:
    ```php
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "quiz_master";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    ?>
    ```

5. Ensure your web server is set up to serve the project. If you're using XAMPP, place the project in the `htdocs` directory.

## Usage

1. Start your web server.
2. Open a web browser and navigate to `http://localhost/quiz_master`.
3. Register as a new user or log in with existing credentials.
4. As an admin, navigate to `http://localhost/quiz_master/admin/dashboard.php` to access the admin panel.

## Project Architecture

quiz_master/
├── admin/
│ ├── analytics.php
│ ├── analytics_data.php
│ ├── dashboard.php
│ ├── edit_user.php
│ ├── login.php
│ ├── logout.php
│ ├── manage_questions.php
│ ├── manage_users.php
├── config/
│ ├── database.php
├── public/
│ ├── index.php
│ ├── login.php
│ ├── logout.php
│ ├── navbar.php
│ ├── profile.php
│ ├── quiz.php
│ ├── register.php
├── src/
│ ├── login.php
│ ├── logout.php
│ ├── register.php
│ ├── profile.php
│ ├── quiz_o.php
│ ├── results_o.php
└── README.md





## Contributing

contributions are welcome! Please fork this repository and submit a pull request with your changes. Ensure that your code adheres to the project's coding standards and passes any tests.

