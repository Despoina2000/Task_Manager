<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Task - Task Management System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">

<?php
require_once 'task_manager.controler.php';
require_once '../config_session.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_task'])) {
    $message = add_task(); // Capture the returned message
}

?>

<?php if (isset($message)) echo "<p><strong>$message</strong></p>"; ?>
    <!-- Add Task Form -->
    <h2>Add New Task</h2>
    <a href="list_of_tasks.view.php" style="text-decoration: none;">
        <button> Home Page </button>
    </a>
    <form method="POST">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description"></textarea>
        </div>
        <div class="form-group">
            <label for="priority">Priority (1-10)</label>
            <input type="number" id="priority" name="priority" min="1" max="10" required>
        </div>
        <div class="form-group">
            <label for="deadline">Deadline </label>
            <input type="date" id="deadline" name="deadline" required>
        </div>
        <button type="submit" name="add_task">Add Task</button>
    </form>
