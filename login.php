<?php
header('Content-Type: application/json');
$host = 'localhost'; // usually localhost
$dbname = 'stayjhakkas_db';
$username = 'root';
$password = ''; // replace with your MySQL password

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_POST['email'];
$passwordInput = $_POST['password'];
$userType = $_POST['userType'];

// Protect against SQL Injection
$email = $conn->real_escape_string($email);
$userType = $conn->real_escape_string($userType);

// Fetch user
$sql = "SELECT * FROM users WHERE email = '$email' AND user_type = '$userType'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $user = $result->fetch_assoc();}
    
    // Verify password
    

if ($passwordInput === $user['password']) {
    session_start();
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_type'] = $user['user_type'];

    echo json_encode([
        'success' => true,
        'message' => 'Login successful!'
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid credentials.'
    ]);
}

//     if ($passwordInput === $user['password'])  {
//         session_start();
//         $_SESSION['user_id'] = $user['id'];
//         $_SESSION['user_type'] = $user['user_type'];
//         header("Location: ../index.html"); // Redirect to dashboard or homepage
//         exit();
//     } else {
//         echo "Invalid credentials PHP.";
//     }
// } else {
//     echo "User not found.";
// }

$conn->close();
?>
