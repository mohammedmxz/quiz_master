<?php
// Include database connection
include '../config/database.php';

// Start session
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Fetch user information
$username = $_SESSION['username'];
$sql = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Fetch previous results
$sql_results = "SELECT q.question, a.user_answer, a.is_correct
               FROM answers a
               INNER JOIN questions q ON a.question_id = q.id
               WHERE a.user_id = ?";
$stmt_results = $conn->prepare($sql_results);
$stmt_results->bind_param("i", $user['id']);
$stmt_results->execute();
$result_results = $stmt_results->get_result();
$results = $result_results->fetch_all(MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Profile</h2>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Welcome, <?php echo htmlspecialchars($user['username']); ?></h5>
                        <?php if (!empty($results)) : ?>
                            <h6 class="card-subtitle mb-2 text-muted">Your previous results:</h6>
                            <ul class="list-group">
                                <?php foreach ($results as $result) : ?>
                                    <li class="list-group-item">
                                        <strong>Question:</strong> <?php echo htmlspecialchars($result['question']); ?><br>
                                        <strong>Your Answer:</strong> <?php echo htmlspecialchars($result['user_answer']); ?><br>
                                        <strong>Correct:</strong> <?php echo $result['is_correct'] ? 'Yes' : 'No'; ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php else : ?>
                            <p class="card-text">No previous results found.</p>
                        <?php endif; ?>
                        <a href="logout.php" class="btn btn-primary">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
