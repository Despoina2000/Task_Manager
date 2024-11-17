<?php
require_once("../database_connection/database_handler.php");
require_once("../database_connection/task.model.php");

function add_task()
{
    if (isset($_POST['add_task'])) {

        $title = trim($_POST['title']);
        $description = trim($_POST['description']);
        $priority = $_POST['priority'];
        $deadline = $_POST['deadline'];

        $errors = [];

        // Validate Title
        if (empty($title)) {
            $errors[] = "Title is required.";
        } elseif (strlen($title) > 255) {
            $errors[] = "Title must not exceed 255 characters.";
        }

        // Validate Priority
        if (!is_numeric($priority) || $priority < 1 || $priority > 10) {
            $errors[] = "Priority must be a number between 1 and 10.";
        }

        // Validate Deadline
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $deadline)) {
            $errors[] = "Deadline must be in the format YYYY-MM-DD.";
        } else {
            $deadlineDate = DateTime::createFromFormat('Y-m-d', $deadline);
            $currentDate = new DateTime();
            if ($deadlineDate < $currentDate) {
                $errors[] = "Deadline cannot be in the past.";
            }
        }

        // If no errors, insert into the database
        if (empty($errors)) {
            $taskModel = new TaskModel();
            $result=$taskModel->addTask($title, $description, $priority, $deadline);


            if ($result) {
                return "Task added successfully!";
            } else {
                return "Failed to add task.";
            }
        } else {
            // Display errors
            return implode("<br>", $errors);
        }
    }
    return 'Failed to add task.';
}

    function list_tasks()
    {
        $taskModel = new TaskModel();
        return $taskModel->getAllTasks();

    }

    function update_task($id){
        $taskModel = new TaskModel();
        if($taskModel->checkTaskStatus($id)){
            return $taskModel->updateTaskStatus($id);
        }
        return 'Failed to update task.';

    }

