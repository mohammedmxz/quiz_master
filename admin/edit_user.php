<?php
// Include database connection
require_once '../config/database.php';
include '../src/navbar.php';


// Initialize variables
$id = $_GET['id'] ?? null;
$message = '';

// Fetch user details
$sql_select = "SELECT * FROM users WHERE id = ?";
$stmt_select = $conn->prepare($sql_select);
$stmt_select->bind_param("i", $id);
$stmt_select->execute();
$result = $stmt_select->get_result();
$user = $result->fetch_assoc();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    
    // Update query
    $sql_update = "UPDATE users SET username = ? WHERE id = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("si", $username, $id);
    
    if ($stmt_update->execute()) {
        $message = "User updated successfully.";
        // Redirect to manage_users.php after update
        header("Location: manage_users.php");
        exit();
    } else {
        $message = "Error updating user: " . $stmt_update->error;
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Edit User</h2>

        <?php if (!empty($message)) : ?>
        <div class="alert alert-info" role="alert">
            <?php echo $message; ?>
        </div>
        <?php endif; ?>

        <form method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="manage_users.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
