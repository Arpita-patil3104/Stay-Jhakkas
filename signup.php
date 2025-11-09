<?php
$host = 'localhost'; // usually localhost
$dbname = 'stayjhakkas_db';
$username = 'root';
$password = ''; // replace with your MySQL password

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name       = $_POST['full_name'];
    $email      = $_POST['email'];
    $phone      = $_POST['phone'];
    $userType   = $_POST['userType'];
    $occupation = $_POST['occupation'];
    $password   = $_POST['password'];
    $confirm    = $_POST['confirmPassword'];

    if ($password !== $confirm) {
        die("Passwords do not match.");
    }

    

    $sql = "INSERT INTO users (full_name, email, phone, user_type, occupation, password)
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $name, $email, $phone, $userType, $occupation, $password);

    if ($stmt->execute()) {
        header("Location: login.html"); // Redirect after signup
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
