<?php
class Database {
    private static $instance = null;
    private $connection;

    private function __construct() {
        try {
            // Connect to SQLite database
            $this->connection = new SQLite3('tasks.db');

            // Execute SQL commands from the file
            $this->initializeDatabase('./database.sql');
        } catch (Exception $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    // Prevent cloning or instantiation
    private function __clone() {}
    private function __wakeup() {}

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance->connection;
    }

    // Initialize database with SQL file
    private function initializeDatabase($sqlFilePath) {
        if (file_exists($sqlFilePath)) {
            $sql = file_get_contents($sqlFilePath);

            // Split the SQL file into individual commands (in case of multiple statements)
            $commands = array_filter(
                array_map('trim', explode(';', $sql))
            );

            foreach ($commands as $command) {
                if (!empty($command)) {
                    $this->connection->exec($command);
                }
            }
        } else {
            die("SQL file not found: $sqlFilePath");
        }
    }


}