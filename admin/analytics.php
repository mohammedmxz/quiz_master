<?php
// Include database connection
require_once '../config/database.php';
include '../src/navbar.php';


// Query to fetch necessary data from the database
$sql = "SELECT COUNT(*) as total_users FROM users";
$result = $conn->query($sql);
$totalUsers = $result->fetch_assoc()['total_users'];

$sql = "SELECT COUNT(*) as total_questions FROM questions";
$result = $conn->query($sql);
$totalQuestions = $result->fetch_assoc()['total_questions'];

$sql = "SELECT user_id, COUNT(*) as total_answers FROM answers GROUP BY user_id";
$result = $conn->query($sql);
$userAnswerCounts = [];
while ($row = $result->fetch_assoc()) {
    $userAnswerCounts[$row['user_id']] = $row['total_answers'];
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analytics</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Analytics Dashboard</h2>
        
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Users</h5>
                        <p class="card-text"><?php echo $totalUsers; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Questions</h5>
                        <p class="card-text"><?php echo $totalQuestions; ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <canvas id="userAnswersChart"></canvas>
        </div>
    </div>

    <script>
        // JavaScript for Chart.js
        var ctx = document.getElementById('userAnswersChart').getContext('2d');
        var userAnswersChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['User 1', 'User 2', 'User 3', 'User 4'], // Replace with dynamic labels
                datasets: [{
                    label: 'Number of Answers',
                    data: [<?php echo implode(',', array_values($userAnswerCounts)); ?>], // Replace with dynamic data
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
