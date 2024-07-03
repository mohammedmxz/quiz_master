<?php
session_start();
session_destroy();
header("Location: /quiz_master/src/login.php");
?>

