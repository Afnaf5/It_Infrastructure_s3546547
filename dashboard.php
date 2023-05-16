<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_email'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        body {
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        
        h1 {
            text-align: center;
            color: #333;
        }
        
        .button {
            display: inline-block;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.3s;
            border-radius: 3px;
        }
        
        .button:hover {
            background-color: #45a049;
        }
        
        .logout-form {
            text-align: center;
            margin-top: 20px;
        }

        .download-form {
            text-align: center;
            margin-top: 20px;
        }
        
        .logout-form input[type="submit"] {
            background-color: #f44336;
        }

        .download-form input[type="submit"] {
            background-color:green;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to the Dashboard</h1>
        <form action="download.php" method="post" class="download-form">
        <input type="submit" name="Download" value="Download" class="button">
        </form>
        
        <!-- Logout Button -->
        <form action="logout.php" method="post" class="logout-form">
            <input type="submit" value="Logout" class="button">
        </form>

    </div>
</body>
</html>
