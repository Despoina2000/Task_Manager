<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Management System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <?php
    require_once 'task_manager.controler.php';
    require_once './config_session.php';

    $tasks= list_tasks();
    ?>
    <h1>Task Management System</h1>

    <?php if (isset($message)) echo "<p><strong>$message</strong></p>"; ?>
    <h2>Task List</h2>
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Priority</th>
            <th>Deadline</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($tasks as $task): ?>
            <tr>
                <td><?php echo htmlspecialchars($task['id']); ?></td>
                <td><?php echo htmlspecialchars($task['title']); ?></td>
                <td><?php echo htmlspecialchars($task['description']); ?></td>
                <td><?php echo htmlspecialchars($task['priority']); ?></td>
                <td><?php echo htmlspecialchars($task['deadline']); ?></td>
                <td>
                    <button
                        <?php if ($task['status'] === 'Completed') echo 'disabled'; ?>
                            onclick="<?php update_task($task['id'])?>">
                        <?php echo htmlspecialchars($task['status']); ?>
                    </button>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
