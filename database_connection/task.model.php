<?php
class TaskModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function addTask($title, $description, $priority, $deadline) {
        $stmt = $this->db->prepare("
            INSERT INTO tasks (title, description, priority, deadline) 
            VALUES (:title, :description, :priority, :deadline)
        ");
        $stmt->bindValue(':title', $title, PDO::PARAM_STR);
        $stmt->bindValue(':description', $description, PDO::PARAM_STR);
        $stmt->bindValue(':priority', $priority, PDO::PARAM_INT);
        $stmt->bindValue(':deadline', $deadline, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function checkTaskStatus($id) {
        // First, fetch the current status of the task
        $stmt = $this->db->prepare("SELECT status FROM tasks WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $task = $stmt->fetch(PDO::FETCH_ASSOC); // Use PDO's fetch method to get the result as an associative array

        // If no task is found, return false
        if (!$task) {
            return false;
        }

        // Check if the current status is 'Completed'
        if ($task['status'] === 'Completed') {
            // If it's already completed, return false
            return false;
        }

        // Otherwise, return true (status can be updated)
        return true;
    }


    public function updateTaskStatus($id) {
        $stmt = $this->db->prepare("UPDATE tasks SET status = 'Completed' WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function getAllTasks() {
        $stmt = $this->db->query("SELECT * FROM tasks ORDER BY priority ASC, deadline ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

