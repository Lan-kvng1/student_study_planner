<?php
// Database connection details
$host = 'localhost';
$dbname = 'study_planner';
$username = 'root';
$password = '';

// Check if task ID is provided
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $task_id = $_GET['id'];
    
    try {
        // Create PDO connection
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Prepare SQL statement to delete the task
        $stmt = $pdo->prepare("DELETE FROM tasks WHERE id = ?");
        
        // Execute statement
        $stmt->execute([$task_id]);
        
        // Redirect back to view tasks page with success message
        header('Location: view_tasks.php?deleted=1');
    } catch(PDOException $e) {
        // Handle errors
        echo "Error: " . $e->getMessage();
    }
} else {
    // Redirect back to view tasks page if no ID provided
    header('Location: view_tasks.php?error=1');
}
?>