<?php
include 'header.php';

$host = "localhost";
$username = "root";
$password = "";
$dbname = "stayjhakkas_db";

// Connect to DB
$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form only if it's submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Sanitize input
    $name = $_POST['full_name'] ?? '';
$email = $_POST['email'] ?? '';
$phone = $_POST['phone'] ?? '';
$occupation = $_POST['occupation'] ?? '';
$roomType = $_POST['roomType'] ?? '';
$duration = $_POST['duration'] ?? 0;
$moveIn = $_POST['moveIn'] ?? '';
$preferences = $_POST['preferences'] ?? '';

$user_id = $_SESSION['user_id']; // Make sure this is set

// Insert statement including all columns (name, email, phone, etc.)
$stmt = $conn->prepare("INSERT INTO bookings (user_id, full_name, email, phone, occupation, room_type, preferences, move_in_date, duration) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

// Bind the parameters: "i" for integer, "s" for string
$stmt->bind_param("issssssss", $user_id, $name, $email, $phone, $occupation, $roomType, $preferences, $moveIn, $duration);

    // Execute the statement
if ($stmt->execute()) {
    echo "<script>alert('Booking successful!'); window.location.href='dashboard.php';</script>";
    exit();
} else {
    echo "Error: " . $stmt->error;
}


    $stmt->close();
    // After successful booking
header("Location: dashboard.php?booking=success");
exit();

}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book a PG - PG Finder</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/booking.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <nav class="navbar">
        <div class="logo"><a href="../index.html">
            <img src="../assets/images/new/StayJhakkasLogo.png" 
             alt="StayJhakkas Logo" 
             style="width: 100px; height: 100px;"/></a>
        </div>
        <div class="nav-links">
            <a href="../index.html">Home</a>
            <a href="rooms.html">PGs</a>
            <!-- <a href="booking.html" class="active">Book Now</a> -->
            <a href="dashboard.php">My Profile</a>
            <!-- <a href="admin.html" class="admin-link">Admin</a> -->
            <!-- <a href="login.html" class="admin-link">Log In</a> -->
            <form method="POST" action="logout.php" style="display: inline;">
                <button type="submit" class="btn-logout">Logout</button>
            </form>
            
        </div>
        <div class="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </nav>

    <main class="booking-container">
        <h1>Book Your PG</h1>
        <form id="bookingForm" class="booking-form" method="POST">
            <div class="form-group">
                <label for="moveIn">Move-in Date:</label>
                <input type="date" id="moveIn" name="moveIn" required>
            </div>
            
            <div class="form-group">
                <label for="duration">Duration of Stay:</label>
                <select id="duration" name="duration"  required>
                    <option value="">Select duration</option>
                    <option value="1">1 Month</option>
                    <option value="3">3 Months</option>
                    <option value="6">6 Months</option>
                    <option value="12">12 Months</option>
                </select>
            </div>

            <div class="form-group">
                <label for="roomType">Room Type:</label>
                <select id="roomType" name="roomType" required>
                    <option value="">Select a room type</option>
                    <option value="Single Room">Single Room</option>
                    <option value="Twin Sharing">Twin Sharing</option>
                    <option value="Triple Sharing">Triple Sharing</option>
                    <option value="Premium Single">Premium Single</option>
                    <option value="Female Only">Female Only PG</option>
                    <option value="Male Only">Male Only PG</option>
                    <option value="Professional">Professional PG</option>
                    <option value="Student">Student PG</option>
                </select>
            </div>

            <div class="form-group">
                <label for="name">Full Name:</label>
                <input type="text" id="name" name="full_name" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="tel" id="phone" name="phone"required>
            </div>

            <div class="form-group">
                <label for="occupation">Occupation:</label>
                <select id="occupation" name="occupation" required>
                    <option value="">Select occupation</option>
                    <option value="student">Student</option>
                    <option value="professional">Working Professional</option>
                    <option value="other">Other</option>
                </select>
            </div>

            <div class="form-group">
                <label for="preferences">Preferences:</label>
                <textarea id="preferences" name="preferences" rows="4" placeholder="Any specific requirements (e.g., food preferences, room location, etc.)"></textarea>
            </div>

            <div class="booking-summary" id="bookingSummary">
                <h3>Booking Summary</h3>
                <p>Duration: <span id="totalMonths">0</span> months</p>
                <p>Monthly Rent: ₹<span id="monthlyRate">0</span></p>
                <p>Security Deposit: ₹<span id="securityDeposit">0</span></p>
                <p>Total Initial Payment: ₹<span id="totalAmount">0</span></p>
            </div>

            <button type="submit" class="submit-btn">Confirm Booking</button>
        </form>
    </main>

    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h3>Contact Us</h3>
                <p>Email: info@pgfinder.com</p>
                <p>Phone: +91 98765 43210</p>
            </div>
            <div class="footer-section">
                <h3>Quick Links</h3>
                <a href="rooms.html">PGs</a>
                <a href="booking.html">Bookings</a>
                <a href="#">About Us</a>
            </div>
            <div class="footer-section">
                <h3>Follow Us</h3>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 PG Finder. All rights reserved.</p>
        </div>
    </footer>

    <!-- <script src="../js/main.js"></script> -->
    <!-- <script src="../js/booking.js"></script> -->
</body>
</html>
