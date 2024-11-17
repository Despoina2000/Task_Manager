#command sqlite3 tasks.db
CREATE TABLE IF NOT EXISTS tasks (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    title TEXT NOT NULL,
    description TEXT,
    priority INTEGER CHECK(priority >= 1 AND priority <= 10),
    deadline DATE,
    status TEXT CHECK(status IN ('Pending', 'Completed')) DEFAULT 'Pending'
    );

#testing if table has been created succesfully
#commands:
#.tables
#.exit
