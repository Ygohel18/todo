-- Create the database
CREATE DATABASE IF NOT EXISTS todo_app;
USE todo_app;

-- Create the categories table
CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create the tasks table
CREATE TABLE IF NOT EXISTS tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    due_date DATE,
    priority ENUM('low', 'medium', 'high') DEFAULT 'medium',
    status ENUM('pending', 'completed') DEFAULT 'pending',
    category_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL
);

-- Sample data for categories
INSERT INTO categories (name, description) VALUES
('Work', 'Tasks related to work projects and assignments.'),
('Personal', 'Personal tasks and goals.'),
('Shopping', 'Shopping lists and related tasks.');

-- Sample data for tasks
INSERT INTO tasks (title, description, due_date, priority, status, category_id) VALUES
('Finish report', 'Complete the quarterly report for work.', '2024-08-15', 'high', 'pending', 1),
('Grocery shopping', 'Buy groceries for the week.', '2024-08-10', 'medium', 'pending', 3),
('Call mom', 'Check in with mom and see how she\'s doing.', '2024-08-12', 'low', 'pending', 2);

-- Query to view tasks with category names
SELECT tasks.id, tasks.title, tasks.description, tasks.due_date, tasks.priority, tasks.status, categories.name AS category
FROM tasks
LEFT JOIN categories ON tasks.category_id = categories.id;
