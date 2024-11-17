CREATE TABLE IF NOT EXISTS tasks (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    title TEXT NOT NULL,
    description TEXT,
    priority INTEGER NOT NULL,
    deadline DATE,
    status ENUM('Pending', 'Completed') DEFAULT 'Pending',
    CONSTRAINT chk_priority CHECK (priority >= 1 AND priority <= 10)
    );

