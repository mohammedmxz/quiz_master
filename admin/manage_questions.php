// admin/manage_questions.php

<?php
include '../config/database.php';
include '../src/navbar.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form submission to add/update/delete questions
    // Example: Adding a new question
    $question = $_POST['question'];
    $option1 = $_POST['option1'];
    $option2 = $_POST['option2'];
    $option3 = $_POST['option3'];
    $option4 = $_POST['option4'];
    $correct_option = $_POST['correct_option'];

    $sql = "INSERT INTO questions (question, option1, option2, option3, option4, correct_option) 
            VALUES ('$question', '$option1', '$option2', '$option3', '$option4', '$correct_option')";
    if ($conn->query($sql) === TRUE) {
        echo "Question added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fetch all questions
$sql = "SELECT * FROM questions";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Questions</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Manage Questions</h2>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form method="post" action="manage_questions.php">
                    <div class="form-group">
                        <label for="question">Question</label>
                        <textarea class="form-control" id="question" name="question" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="option1">Option 1</label>
                        <input type="text" class="form-control" id="option1" name="option1" required>
                    </div>
                    <div class="form-group">
                        <label for="option2">Option 2</label>
                        <input type="text" class="form-control" id="option2" name="option2" required>
                    </div>
                    <div class="form-group">
                        <label for="option3">Option 3</label>
                        <input type="text" class="form-control" id="option3" name="option3" required>
                    </div>
                    <div class="form-group">
                        <label for="option4">Option 4</label>
                        <input type="text" class="form-control" id="option4" name="option4" required>
                    </div>
                    <div class="form-group">
                        <label for="correct_option">Correct Option (1-4)</label>
                        <input type="number" class="form-control" id="correct_option" name="correct_option" min="1" max="4" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Question</button>
                </form>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-8">
                <h3>Existing Questions</h3>
                <ul class="list-group">
                    <?php while ($row = $result->fetch_assoc()) : ?>
                        <li class="list-group-item">
                            <strong>Question:</strong> <?php echo $row['question']; ?><br>
                            <strong>Options:</strong> 
                            <ul>
                                <li><?php echo $row['option1']; ?></li>
                                <li><?php echo $row['option2']; ?></li>
                                <li><?php echo $row['option3']; ?></li>
                                <li><?php echo $row['option4']; ?></li>
                            </ul>
                            <strong>Correct Option:</strong> <?php echo $row['correct_option']; ?>
                        </li>
                    <?php endwhile; ?>
                </ul>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
