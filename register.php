<!DOCTYPE html>
<html>
<head>
    <title>Registration Form</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="script.js"></script>
</head>
<body>
    <div class="container">
        <?php
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
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

            // Get form data
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Insert data into the "user" table
            $sql = "INSERT INTO user (name, email, password) VALUES ('$name', '$email', '$hashedPassword')";

            if ($conn->query($sql) === TRUE) {
                echo "Registration successful";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $conn->close();
        }
        ?>

        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" onsubmit="return validateForm()">
            <h1>Registration Form</h1>
            <label for="name">Name</label>
            <input type="text" id="name" name="name" required>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
            <input type="submit" value="Register">
        </form>
        <p>Allrady have an account? <a href="login.php">Login</a></p>
    </div>

    
</body>
</html>
