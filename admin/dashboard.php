<?php
include '../config/database.php';
include '../src/navbar.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

// Fetch data for statistics
$totalUsersQuery = "SELECT COUNT(*) as total_users FROM users";
$totalUsersResult = $conn->query($totalUsersQuery);
$totalUsers = $totalUsersResult->fetch_assoc()['total_users'];

$totalQuestionsQuery = "SELECT COUNT(*) as total_questions FROM questions";
$totalQuestionsResult = $conn->query($totalQuestionsQuery);
$totalQuestions = $totalQuestionsResult->fetch_assoc()['total_questions'];

$totalQuizzesQuery = "SELECT COUNT(DISTINCT question_id) as total_quizzes FROM answers";
$totalQuizzesResult = $conn->query($totalQuizzesQuery);
$totalQuizzes = $totalQuizzesResult->fetch_assoc()['total_quizzes'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            margin-bottom: 20px;
        }
        .card-title {
            font-size: 1.5rem;
        }
        .card-text {
            font-size: 1.2rem;
        }
        .card-icon {
            font-size: 3rem;
            color: #007bff;
        }
        .dashboard-link {
            text-decoration: none;
            color: #000;
        }
        .dashboard-link:hover {
            text-decoration: none;
            color: #000;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Admin Dashboard</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fas fa-users card-icon"></i>
                        <h5 class="card-title">Total Users</h5>
                        <p class="card-text"><?php echo $totalUsers; ?></p>
                        <a href="manage_users.php" class="dashboard-link"><button class="btn btn-primary">Manage Users</button></a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fas fa-question-circle card-icon"></i>
                        <h5 class="card-title">Total Questions</h5>
                        <p class="card-text"><?php echo $totalQuestions; ?></p>
                        <a href="manage_questions.php" class="dashboard-link"><button class="btn btn-primary">Manage Questions</button></a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fas fa-chart-line card-icon"></i>
                        <h5 class="card-title">Total Quizzes</h5>
                        <p class="card-text"><?php echo $totalQuizzes; ?></p>
                        <a href="analytics.php" class="dashboard-link"><button class="btn btn-primary">Analytics</button></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center">
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
