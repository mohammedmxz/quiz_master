// src/result.php
<?php
include '../config/database.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}

$username = $_SESSION['username'];
$sql = "SELECT id FROM users WHERE username='$username'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$user_id = $row['id'];

$score = 0;

foreach ($_POST as $key => $value) {
    $question_id = str_replace('question_', '', $key);
    $user_answer = $value;

    $sql = "SELECT correct_option FROM questions WHERE id='$question_id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $correct_option = $row['correct_option'];

    $is_correct = ($user_answer == $correct_option) ? 1 : 0;
    $score += $is_correct;

    $sql = "INSERT INTO answers (user_id, question_id, user_answer, is_correct) VALUES ('$user_id', '$question_id', '$user_answer', '$is_correct')";
    $conn->query($sql);
}

echo "Your score is: $score";
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
            max-width: 700px;
            margin: auto;
            margin-top: 50px;
            padding: 50px;
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
                <h4>Questions answered correctly: Your score is: <?php echo $score; ?></h4>
            </div>

            <div class="text-center mb-4">
                <a href="quiz.php" class="btn btn-primary mr-2">Back to Quiz</a>
                <a href="profile.php" class="btn btn-success ml-2">profile</a>


            </div>
         
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
