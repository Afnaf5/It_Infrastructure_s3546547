<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_email'])) {
    header("Location: login.php");
    exit();
}

// Get the user's email from the session
$userEmail = $_SESSION['user_email'];

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

// Retrieve information from the "info" table based on the user's email
$sql = "SELECT * FROM info WHERE email = '$userEmail'";
$result = $conn->query($sql);

// Check if the query returned any rows
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $pdfData = $row['pdf_data'];

    if ($pdfData) {
        // PDF data exists, set the appropriate headers and initiate file download
        header("Content-type: application/pdf");
        header("Content-Disposition: attachment; filename=downloaded_file.pdf");
        echo $pdfData;
        exit();
    } else {
        echo "No PDF file available.";
    }
} else {
    echo "No information found for the user.";
}

$conn->close();
?>
