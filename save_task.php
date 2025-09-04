<?php
// Database connection details
$host = 'localhost';
$dbname = 'study_planner';
$username = 'root';
$password = '';

try {
    // Create PDO connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Get form data
    $subject = $_POST['subject'];
    $task = $_POST['task'];
    $due_date = $_POST['due_date'];
    
    // Prepare SQL statement
    $stmt = $pdo->prepare("INSERT INTO tasks (subject, task_description, due_date) VALUES (?, ?, ?)");
    
    // Execute statement
    $stmt->execute([$subject, $task, $due_date]);
    
    // Redirect back to main page with success message
    header('Location: index.php?success=1');
} catch(PDOException $e) {
    // Handle errors
    echo "Error: " . $e->getMessage();
}
?>