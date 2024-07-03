<?php
// Include database connection
require_once '../config/database.php';
include '../src/navbar.php';


// Initialize variables
$message = '';

// Handle delete action
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    // Soft delete query
    $sql_delete = "UPDATE users SET status = 'deleted' WHERE id = ?";
    $stmt_delete = $conn->prepare($sql_delete);
    $stmt_delete->bind_param("i", $delete_id);

    if ($stmt_delete->execute()) {
        $message = "User marked as deleted.";
    } else {
        $message = "Error marking user as deleted: " . $stmt_delete->error;
    }
}

// Query to fetch active users
$sql_select = "SELECT * FROM users WHERE status = 'active'";
$result = $conn->query($sql_select);

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Manage Users</h2>
        
        <?php if (!empty($message)) : ?>
        <div class="alert alert-info" role="alert">
            <?php echo $message; ?>
        </div>
        <?php endif; ?>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) : ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo htmlspecialchars($row['username']); ?></td>
                    <td>
                        <a href="edit_user.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                        <a href="?delete_id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to mark this user as deleted?')">Mark as Deleted</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <div class="text-center">
            <a href="dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
