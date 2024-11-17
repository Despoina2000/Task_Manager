<?php
class Database {
    private static $instance = null;
    private $connection;

    private function __construct() {
        // MySQL database configuration
        $host = 'localhost'; // Change if phpMyAdmin runs on a different host
        $dbname = 'task_manager'; // Replace with your database name
        $username = 'root'; // Your MySQL username
        $password = ''; // Your MySQL password (often empty for local setups)

        try {
            // Create a PDO connection for MySQL
            $this->connection = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
            // Set PDO error mode to exception for easier debugging
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->connection;
    }
}

