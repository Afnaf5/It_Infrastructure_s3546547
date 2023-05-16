<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="script.js"></script>
</head>
<body>
    <div class="container">
        <?php
        session_start();

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "mydb";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Get form data
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Retrieve user from the database
            $sql = "SELECT * FROM user WHERE email = '$email'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();
                $hashedPassword = $user['password'];

                // Verify the password
                if (password_verify($password, $hashedPassword)) {
                    // Password is correct, set session variables and redirect to a dashboard or home page
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_email'] = $user['email'];
                    header("Location: dashboard.php");
                    exit();
                } else {
                    echo "Invalid password";
                }
            } else {
                echo "User not found";
            }
        }
        ?>

        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" onsubmit="return validateForm()">
            <h1>Login</h1>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
            <input type="submit" value="Login">
        </form>

        <p>Don't have an account? <a href="register.php">Register</a></p>
    </div>
</body>
</html>
