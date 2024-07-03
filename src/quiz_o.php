// src/quiz.php
<?php
include '../config/database.php';
include '../src/navbar.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}

$sql = "SELECT * FROM questions ORDER BY RAND() LIMIT 10";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Quiz</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

</head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
<style>
        body {
            background-color: #f8f9fa;
        }
        .quiz-container {
            max-width: 700px;
            margin: auto;
            margin-top: 50px;
            padding: 50px;
            background-color: #fff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }
        .question {
            margin-bottom: 20px;
        }
        .options label {
            display: block;
            margin-bottom: 10px;
        }
        .options input[type="radio"] {
            margin-right: 10px;
        }
        .btn-next {
            float: right;
        }
    </style>
<body>
 


<div class="container">
        <div class="quiz-container">
            <h2 class="text-center">Welcome to the Quiz</h2>
            
    <form method="post" action="result_o.php">
                <div class="question">
                
                     <?php
        while ($row = $result->fetch_assoc()) {
            echo "<div class='question'>";
            echo "<div>";
            echo "<h4>" . $row['question'] . "</h4>";
            echo "<input type='radio' name='question_" . $row['id'] . "' value='1'>" . $row['option1'] . "<br>";
            echo "<input type='radio' name='question_" . $row['id'] . "' value='2'>" . $row['option2'] . "<br>";
            echo "<input type='radio' name='question_" . $row['id'] . "' value='3'>" . $row['option3'] . "<br>";
            echo "<input type='radio' name='question_" . $row['id'] . "' value='4'>" . $row['option4'] . "<br>";
            echo "</div>";

            echo "</div>";
        }
        ?>


                <button type="submit" class="btn btn-primary btn-next">Submit Quiz</button>
            </form>
        </div>
    </div>





 <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</body>
</html>
