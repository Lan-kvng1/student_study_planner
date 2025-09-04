<?php
// Database connection details
$host = 'localhost';
$dbname = 'study_planner';
$username = 'root';
$password = '';

// Initialize variables
$task = null;
$error = null;

// Check if task ID is provided
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $task_id = $_GET['id'];
    
    try {
        // Create PDO connection
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // If form is submitted, update the task
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Get form data
            $subject = $_POST['subject'];
            $task_description = $_POST['task'];
            $due_date = $_POST['due_date'];
            
            // Prepare SQL statement to update the task
            $stmt = $pdo->prepare("UPDATE tasks SET subject = ?, task_description = ?, due_date = ? WHERE id = ?");
            
            // Execute statement
            $stmt->execute([$subject, $task_description, $due_date, $task_id]);
            
            // Redirect back to view tasks page with success message
            header('Location: view_tasks.php?updated=1');
            exit;
        }
        
        // Prepare SQL statement to get the task
        $stmt = $pdo->prepare("SELECT * FROM tasks WHERE id = ?");
        
        // Execute statement
        $stmt->execute([$task_id]);
        
        // Fetch the task
        $task = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // If task not found, set error
        if(!$task) {
            $error = "Task not found!";
        }
        
    } catch(PDOException $e) {
        // Handle errors
        $error = "Error: " . $e->getMessage();
    }
} else {
    // No ID provided
    $error = "Task ID not provided!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Study Task</title>
    <style>
        body {
            background-color: #121212;
            color: #f0f0f0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #1e1e1e;
            padding: 2.5rem;
            border-radius: 15px;
            box-shadow: 0 0 25px rgba(79, 174, 238, 0.3);
            width: 100%;
            max-width: 500px;
        }
        h1 {
            text-align: center;
            background: linear-gradient(45deg, #4facee, #00c6ff);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            margin-bottom: 2rem;
            font-weight: 600;
            letter-spacing: 1px;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        label {
            display: block;
            margin-bottom: 0.5rem;
            font-size: 1.1rem;
            text-transform: uppercase;
        }
        input[type="text"],
        textarea,
        input[type="date"] {
            width: 100%;
            padding: 1rem;
            border: 1px solid #333;
            border-radius: 8px;
            background-color: #252525;
            color: #f0f0f0;
            font-size: 1rem;
            box-sizing: border-box;
            transition: border-color 0.3s, box-shadow 0.3s;
        }
        
        input[type="text"]:focus,
        textarea:focus,
        input[type="date"]:focus {
            border-color: #4facee;
            outline: none;
            box-shadow: 0 0 0 2px rgba(79, 172, 238, 0.2);
        }
        textarea {
            resize: vertical;
            min-height: 100px;
        }
        button, .btn {
            width: 100%;
            padding: 1rem;
            border: none;
            border-radius: 8px;
            background-color: #4facee;
            color: white;
            font-size: 1.1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-transform: uppercase;
        }
        button:hover, .btn:hover {
            background-color: #3d8ecc;
            transform: translateY(-2px);
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
        }
        .error-message {
            background-color: rgba(231, 76, 60, 0.15);
            border: 1px solid #e74c3c;
            color: #e74c3c;
            padding: 1.2rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            text-align: center;
            font-weight: 500;
        }
        .buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 1.5rem;
            gap: 1rem;
        }
        .btn-secondary {
            background-color: #555;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .btn-secondary:hover {
            background-color: #444;
            transform: translateY(-2px);
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>EDIT STUDY TASK</h1>
        
        <?php if($error): ?>
        <div class="error-message">
            <?php echo $error; ?>
        </div>
        <div class="buttons">
            <a href="view_tasks.php" class="btn">BACK TO TASKS</a>
        </div>
        <?php else: ?>
        <form action="edit_task.php?id=<?php echo $task['id']; ?>" method="POST">
            <div class="form-group">
                <label for="subject">SUBJECT</label>
                <input type="text" id="subject" name="subject" value="<?php echo htmlspecialchars($task['subject']); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="task">TASK</label>
                <textarea id="task" name="task" required><?php echo htmlspecialchars($task['task_description']); ?></textarea>
            </div>
            
            <div class="form-group">
                <label for="due_date">DUE DATE</label>
                <input type="date" id="due_date" name="due_date" value="<?php echo $task['due_date']; ?>" required>
            </div>
            
            <div class="buttons">
                <a href="view_tasks.php" class="btn btn-secondary">CANCEL</a>
                <button type="submit" class="btn">UPDATE TASK</button>
            </div>
        </form>
        <?php endif; ?>
    </div>
</body>
</html>