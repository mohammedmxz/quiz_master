<!-- src/result.php -->

<?php
// Include database connection
require_once '../config/database.php';

// Initialize variables
$correctAnswers = 0;

// Check if form submitted with answers
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['answers'])) {
    // Fetch correct answers from database
    $stmt = $pdo->query('SELECT id, correct_answer FROM quiz_master');
    $correctAnswersDB = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);

    // Compare user answers with correct answers
    foreach ($_POST['answers'] as $questionId => $selectedAnswer) {
        if ($correctAnswersDB[$questionId] === $selectedAnswer) {
            $correctAnswers++;
        }
    }
}
printf($_POST['answers']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Result</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
        }
        .result-container {
            max-width: 600px;
            margin: auto;
            margin-top: 50px;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }
        .result {
            margin-bottom: 20px;
        }
        .btn-back {
            float: right;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="result-container">
            <h2 class="text-center">Quiz Result</h2>
            
            <div class="result">
                <h4>Questions answered correctly: <?php echo $correctAnswers; ?></h4>
            </div>

            <div class="text-center">
                <a href="quiz.php" class="btn btn-primary btn-back">Back to Quiz</a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
