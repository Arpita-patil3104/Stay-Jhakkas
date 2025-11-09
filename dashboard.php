<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

$host = 'localhost';
$dbname = 'stayjhakkas_db';
$username = 'root';
$password = '';

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$userId = $_SESSION['user_id'];
$sql = "SELECT full_name, email FROM users WHERE id = $userId";
$result = $conn->query($sql);

$user = $result->fetch_assoc();
$fullName = $user['full_name'];
$email = $user['email'];

$bookingSql = "SELECT * FROM bookings WHERE user_id = ?";
echo "Logged in user ID: " . $_SESSION['user_id'];

$stmt = $conn->prepare($bookingSql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$bookingResult = $stmt->get_result();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - StayJhakkas</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <nav class="navbar">
        <div class="logo">StayJhakkas</div>
        <div class="nav-links">
            <a href="../index.html">Home</a>
            <a href="rooms.html">Rooms</a>
            <a href="booking.php">Book Now</a>
            <a href="dashboard.php" class="active">My Profile</a>
            <form method="POST" action="logout.php" style="display: inline;">
                <button type="submit" class="btn-logout">Logout</button>
            </form>
        </div>
        <div class="hamburger">
            <span></span><span></span><span></span>
        </div>
    </nav>

    <main>
        <section class="profile-container">
            <div class="profile-info">
                <h2>My Profile</h2>
                <div class="profile-details">
                    <div class="avatar"><i class="fas fa-user-circle"></i></div>
                    <div class="user-info">
                        <h3 id="userName"><?= htmlspecialchars($fullName) ?></h3>
                        <p id="userEmail"><?= htmlspecialchars($email) ?></p>
                    </div>
                </div>
            </div>

            <!-- <div class="bookings-section">
                <h3>My Bookings</h3>
                <div id="bookingsList" class="bookings-list"> -->
                    <!-- Add booking logic if needed -->
                <!-- </div>
            </div> -->
            <div class="bookings-section">
    <h3>My Bookings</h3>
    <div id="bookingsList" class="bookings-list" style="display: grid; gap: 1rem; margin-top: 1rem;">
        
        <!-- <div class="booking-card" style="background: #f7f7f7; border-radius: 10px; padding: 15px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
            <h4 style="margin: 0;">Lakeview PG</h4>
            <p style="margin: 5px 0;">📍 Koramangala, Bangalore</p>
            <p style="margin: 5px 0;">Check-in: 2024-12-10 | Check-out: 2025-01-10</p>
            <span style="color: green; font-weight: bold;">Status: Confirmed</span>
        </div>

        <div class="booking-card" style="background: #f7f7f7; border-radius: 10px; padding: 15px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
            <h4 style="margin: 0;">Elite Girls Hostel</h4>
            <p style="margin: 5px 0;">📍 Sector 62, Noida</p>
            <p style="margin: 5px 0;">Check-in: 2024-11-01 | Check-out: 2025-03-01</p>
            <span style="color: orange; font-weight: bold;">Status: Pending</span>
        </div>

        <div class="booking-card" style="background: #f7f7f7; border-radius: 10px; padding: 15px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
            <h4 style="margin: 0;">Urban Stays</h4>
            <p style="margin: 5px 0;">📍 HSR Layout, Bangalore</p>
            <p style="margin: 5px 0;">Check-in: 2024-09-15 | Check-out: 2025-02-15</p>
            <span style="color: red; font-weight: bold;">Status: Cancelled</span>
        </div> -->
        <?php if ($bookingResult->num_rows === 0): ?>
    <p style="color: red;">No bookings found for your account.</p>
<?php endif; ?>

        <?php while ($booking = $bookingResult->fetch_assoc()): ?>
    <div class="booking-card" style="background: #f7f7f7; border-radius: 10px; padding: 15px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
        <h4 style="margin: 0;"><?= htmlspecialchars($booking['room_type']) ?> PG</h4>
        <p style="margin: 5px 0;">📍 Location: <?= htmlspecialchars($booking['preferences'] ?: 'Not specified') ?></p>
        <p style="margin: 5px 0;">Check-in: <?= htmlspecialchars($booking['move_in_date']) ?> | Duration: <?= $booking['duration'] ?> month(s)</p>
        <!-- <span style="color: green; font-weight: bold;">Status: <?= htmlspecialchars($booking['status']) ?></span> -->
    </div>
<?php endwhile; ?>

    </div>
</div>


            <div class="profile-settings">
                <h3>Account Settings</h3>
                <form id="updateProfileForm">
                    <div class="form-group">
                        <label for="updateName">Full Name</label>
                        <input type="text" id="updateName" value="<?= htmlspecialchars($fullName) ?>">
                    </div>
                    <div class="form-group">
                        <label for="updateEmail">Email</label>
                        <input type="email" id="updateEmail" value="<?= htmlspecialchars($email) ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="currentPassword">Current Password</label>
                        <input type="password" id="currentPassword">
                    </div>
                    <div class="form-group">
                        <label for="newPassword">New Password</label>
                        <input type="password" id="newPassword">
                    </div>
                    <button type="submit" class="btn">Update Profile</button>
                </form>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 StayJhakkas. All rights reserved.</p>
    </footer>
</body>
</html>
