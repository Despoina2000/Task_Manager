<?php

require_once 'database_handler.php';

class TaskModel {
    private $db;

    public function __construct() {
        // Get the database connection
        $this->db = Database::getInstance();
    }

    /**
     * Fetch all tasks, ordered by priority and deadline
     * @return array List of tasks
     */
    public function getAllTasks() {
        $tasks = [];
        $query = "SELECT * FROM tasks ORDER BY priority ASC, deadline ASC";
        $result = $this->db->query($query);

        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $tasks[] = $row;
        }

        return $tasks;
    }

    public function addTask($title, $description, $priority, $deadline) {
        $stmt = $this->db->prepare("INSERT INTO tasks (title, description, priority, deadline) VALUES (:title, :description, :priority, :deadline)");
        $stmt->bindValue(':title', $title, SQLITE3_TEXT);
        $stmt->bindValue(':description', $description, SQLITE3_TEXT);
        $stmt->bindValue(':priority', $priority, SQLITE3_INTEGER);
        $stmt->bindValue(':deadline', $deadline, SQLITE3_TEXT);
        return $stmt->execute();
    }

    public function checkTaskStatus($id) {
        // First, fetch the current status of the task
        $stmt = $this->db->prepare("SELECT status FROM tasks WHERE id = :id");
        $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
        $result = $stmt->execute();
        $task = $result->fetchArray(SQLITE3_ASSOC);

        // If no task is found, return null (optional: you may handle this case differently)
        if (!$task) {
            return false;
        }

        // Check if the current status is 'Completed'
        if ($task['status'] === 'Completed') {
            // If it's already completed, return null (or you can return a message if needed)
            return false;
        }

        // Otherwise, update the task's status to the new status
        return true;
    }

    public function updateTaskStatus($id) {
        $stmt = $this->db->prepare("UPDATE tasks SET status = 'Completed' WHERE id = :id");
        $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
        return $stmt->execute();
    }
}
