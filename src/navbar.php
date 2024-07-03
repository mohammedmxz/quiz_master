<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Quiz Master</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="/quiz_master/index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/quiz_master/src/quiz_o.php">Quiz</a>
            </li>
            <?php if (isset($_SESSION['username'])): ?>
                <li class="nav-item">
                    <a class="nav-link" href="/quiz_master/src/profile.php">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/quiz_master/src/logout.php">Logout</a>
                </li>
            <?php elseif (isset($_SESSION['admin'])): ?>
                <li class="nav-item">
                    <a class="nav-link" href="/quiz_master/admin/dashboard.php">Admin Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/quiz_master/admin/logout.php">Logout</a>
                </li>
            <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link" href="/quiz_master/src/login.php">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/quiz_master/src/register.php">Register</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
