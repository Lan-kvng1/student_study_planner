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
    
    // Prepare SQL statement to get all tasks ordered by due date
    $stmt = $pdo->prepare("SELECT * FROM tasks ORDER BY due_date ASC");
    
    // Execute statement
    $stmt->execute();
    
    // Fetch all tasks
    $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
} catch(PDOException $e) {
    // Handle errors
    $error = "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VIEW STUDY TASKS</title>
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
            max-width: 800px;
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
            text-transform: uppercase;
        }
        .task-list {
            margin-bottom: 2rem;
        }
        .task-card {
            background-color: #252525;
            border-radius: 8px;
            padding: 1.2rem;
            margin-bottom: 1rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        
        .task-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }
        .task-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
        }
        .subject {
            font-weight: bold;
            color: #4facee;
        }
        .due-date {
            color: #00c6ff;
            font-weight: 500;
        }
        .task-description {
            margin-top: 0.5rem;
            line-height: 1.5;
        }
        .empty-message, .message {
            text-align: center;
            padding: 2rem;
            background-color: #252525;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .success-message {
            background-color: rgba(39, 174, 96, 0.15);
            border: 1px solid #27ae60;
            color: #2ecc71;
            padding: 1.2rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            text-align: center;
            font-weight: 500;
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
            margin-top: 1rem;
        }
        .btn {
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-transform: uppercase;
        }
        .btn-primary {
            background-color: #4facee;
            color: white;
        }
        .btn-primary:hover {
            background-color: #3d8ecc;
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.15);
        }
        .btn-danger {
            background-color: #e74c3c;
            color: white;
        }
        .btn-danger:hover {
            background-color: #c0392b;
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.15);
        }
        .task-actions {
            margin-top: 1rem;
            text-align: right;
        }
        .task-actions .btn {
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
            width: auto;
            margin-left: 0.5rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>YOUR STUDY TASKS</h1>
        
        <?php if(isset($_GET['deleted']) && $_GET['deleted'] == 1): ?>
        <div class="success-message">
            TASK DELETED SUCCESSFULLY!
        </div>
        <?php endif; ?>
        
        <?php if(isset($_GET['updated']) && $_GET['updated'] == 1): ?>
        <div class="success-message">
            TASK UPDATED SUCCESSFULLY!
        </div>
        <?php endif; ?>
        
        <?php if(isset($_GET['error']) && $_GET['error'] == 1): ?>
        <div class="error-message">
            ERROR: TASK ID NOT PROVIDED!
        </div>
        <?php endif; ?>
        
        <div class="task-list">
            <?php if(isset($error)): ?>
                <div class="empty-message">
                    <?php echo $error; ?>
                </div>
            <?php elseif(empty($tasks)): ?>
                <div class="empty-message">
                    NO TASKS FOUND. ADD SOME TASKS TO GET STARTED!
                </div>
            <?php else: ?>
                <?php foreach($tasks as $task): ?>
                    <div class="task-card">
                        <div class="task-header">
                            <div class="subject"><?php echo htmlspecialchars($task['subject']); ?></div>
                            <div class="due-date">DUE: <?php echo date('M d, Y', strtotime($task['due_date'])); ?></div>
                        </div>
                        <div class="task-description">
                            <?php echo nl2br(htmlspecialchars($task['task_description'])); ?>
                        </div>
                        <div class="task-actions">
                            <a href="edit_task.php?id=<?php echo $task['id']; ?>" class="btn btn-primary">EDIT</a>
                            <a href="delete_task.php?id=<?php echo $task['id']; ?>" class="btn btn-danger" onclick="return confirm('ARE YOU SURE YOU WANT TO DELETE THIS TASK?');">DELETE</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        
        <div class="buttons">
            <a href="index.php" class="btn btn-primary">ADD NEW TASK</a>
        </div>
    </div>
</body>
</html>