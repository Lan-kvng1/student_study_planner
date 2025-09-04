# Student Study Planner

A PHP-based web application for students to manage their study tasks and assignments. This application allows students to add, view, edit, and delete study tasks with subject, description, and due date information.

## Features

- Add new study tasks with subject, description, and due date
- View all tasks sorted by due date
- Edit existing tasks
- Delete tasks
- Responsive dark-themed UI
- Success and error notifications

## Screenshots

- Main form for adding tasks
- Task listing page with edit and delete options

## Requirements

- PHP 7.0 or higher
- MySQL 5.6 or higher
- Web server (Apache, Nginx, etc.)
- XAMPP, WAMP, MAMP, or similar local development environment

## Installation

1. Clone or download this repository to your web server's document root
2. Make sure your web server and MySQL service are running
3. Navigate to `http://localhost/Php_Practicals/research_assistant/setup_database.php` in your browser
4. The setup script will create the necessary database and tables
5. Once setup is complete, you can start using the application

## Database Structure

The application uses a MySQL database with the following structure:

```sql
CREATE TABLE tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    subject VARCHAR(255) NOT NULL,
    task_description TEXT NOT NULL,
    due_date DATE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

## File Structure

- `index.php` - Main page with the form to add new tasks
- `save_task.php` - Processes the form submission and saves tasks to the database
- `view_tasks.php` - Displays all tasks with options to edit or delete
- `edit_task.php` - Form to edit existing tasks
- `delete_task.php` - Handles task deletion
- `setup_database.php` - Sets up the database and tables
- `sql.sql` - SQL schema for reference

## Usage

1. Navigate to the main page to add a new task
2. Fill in the subject, task description, and due date
3. Click "Add To Planner" to save the task
4. Click "View All Tasks" to see your saved tasks
5. Use the Edit and Delete buttons to manage your tasks

## License

This project is open-source and available for educational purposes.
