<?php

require_once 'database_handler.php';

// Test database connection and initialization
$db = Database::getInstance();
echo "Database initialized successfully.";

// Check if the table exists (optional)
$result = $db->query("SELECT name FROM sqlite_master WHERE type='table' AND name='tasks'");
if ($result->fetchArray(SQLITE3_ASSOC)) {
    echo "Table 'tasks' exists!";
} else {
    echo "Table 'tasks' does not exist.";
}

