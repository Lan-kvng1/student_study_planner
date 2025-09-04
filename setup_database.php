<?php
// Database connection details
$host = 'localhost';
$username = 'root';
$password = '';

$success = false;
$error = null;

try {
    // Create PDO connection without database name
    $pdo = new PDO("mysql:host=$host", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Create database if it doesn't exist
    $pdo->exec("CREATE DATABASE IF NOT EXISTS study_planner");
    
    // Connect to the newly created database
    $pdo = new PDO("mysql:host=$host;dbname=study_planner", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Create tasks table if it doesn't exist
    $sql = "CREATE TABLE IF NOT EXISTS tasks (
        id INT AUTO_INCREMENT PRIMARY KEY,
        subject VARCHAR(255) NOT NULL,
        task_description TEXT NOT NULL,
        due_date DATE NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    
    $pdo->exec($sql);
    
    $success = true;
    
} catch(PDOException $e) {
    $error = "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DATABASE SETUP</title>
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
            text-transform: uppercase;
        }
        .message {
            padding: 1.5rem;
            border-radius: 8px;
            margin-bottom: 2rem;
            text-align: center;
            font-weight: 500;
        }
        .success {
            background-color: rgba(39, 174, 96, 0.15);
            border: 1px solid #27ae60;
            color: #2ecc71;
        }
        .error {
            background-color: rgba(231, 76, 60, 0.15);
            border: 1px solid #e74c3c;
            color: #e74c3c;
        }
        .btn {
            display: block;
            width: 100%;
            padding: 1rem;
            border: none;
            border-radius: 8px;
            background-color: #4facee;
            color: white;
            font-size: 1.1rem;
            text-transform: uppercase;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            text-align: center;
            margin-top: 1rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .btn:hover {
            background-color: #3d8ecc;
            transform: translateY(-2px);
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
        }
        .steps {
            background-color: #252525;
            padding: 1.8rem;
            border-radius: 8px;
            margin-bottom: 2rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .steps h2 {
            margin-top: 0;
            font-size: 1.2rem;
            color: #4facee;
            font-weight: 600;
        }
        .steps ol {
            margin-left: 1.5rem;
            padding-left: 0;
        }
        .steps li {
            margin-bottom: 0.8rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>DATABASE SETUP</h1>
        
        <?php if($success): ?>
        <div class="message success">
            DATABASE AND TABLES CREATED SUCCESSFULLY!
        </div>
        <?php elseif($error): ?>
        <div class="message error">
            <?php echo $error; ?>
        </div>
        <?php endif; ?>
        
        <div class="steps">
            <h2>SETUP INSTRUCTIONS:</h2>
            <ol>
                <li>MAKE SURE YOUR XAMPP SERVER IS RUNNING WITH MYSQL SERVICE ACTIVE.</li>
                <li>THIS SCRIPT WILL CREATE THE 'STUDY_PLANNER' DATABASE IF IT DOESN'T EXIST.</li>
                <li>IT WILL ALSO CREATE THE NECESSARY 'TASKS' TABLE WITH THE REQUIRED STRUCTURE.</li>
                <li>ONCE SETUP IS COMPLETE, YOU CAN START USING THE STUDENT STUDY PLANNER.</li>
            </ol>
        </div>
        
        <?php if($success): ?>
        <a href="index.php" class="btn">GO TO STUDENT STUDY PLANNER</a>
        <?php else: ?>
        <a href="setup_database.php" class="btn">TRY AGAIN</a>
        <?php endif; ?>
    </div>
</body>
</html>