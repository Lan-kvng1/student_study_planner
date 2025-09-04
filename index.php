<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STUDENT STUDY PLANNER</title>
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
        .buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 1.5rem;
            gap: 1rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Student Study Planner</h1>
        
        <?php if(isset($_GET['success']) && $_GET['success'] == 1): ?>
        <div class="success-message">
            Task added successfully!
        </div>
        <?php endif; ?>
        
        <form action="save_task.php" method="POST">
            <div class="form-group">
                <label for="subject">Subject</label>
                <input type="text" id="subject" name="subject" placeholder="e.g. Mathematics" required>
            </div>
            
            <div class="form-group">
                <label for="task">Task</label>
                <textarea id="task" name="task" placeholder="Describe the study task..." required></textarea>
            </div>
            
            <div class="form-group">
                <label for="due_date">Due Date</label>
                <input type="date" id="due_date" name="due_date" required>
            </div>
            
            <button type="submit">Add To Planner</button>
        </form>
        
        <div class="buttons">
            <a href="view_tasks.php" class="btn">View All Tasks</a>
        </div>
    </div>
</body>
</html>