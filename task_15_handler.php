<?php
session_start();
if (!empty($_REQUEST['counter'])) {
    $_SESSION['counter']++;
    header("Location: /tasks/task_15.php");
    exit();
}