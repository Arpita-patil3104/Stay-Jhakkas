<?php
session_start();
?>

<nav class="navbar">
    <div class="logo">
        <a href="../index.html">
            <img src="../assets/images/new/StayJhakkasLogo.png" 
                 alt="StayJhakkas Logo" style="width: 100px; height: 100px;"/>
        </a>
    </div>
    <div class="nav-links">
        <a href="../index.html">Home</a>
        <a href="rooms.html">PGs</a>
        <a href="booking.html">Book Now</a>
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="dashboard.php">Dashboard</a>
            <form method="POST" action="logout.php" style="display: inline;">
                <button type="submit" class="btn-logout" style="margin-left: 10px;">Logout</button>
            </form>
        <?php else: ?>
            <a href="login.html">Login</a>
            <a href="signup.html">Sign Up</a>
        <?php endif; ?>
    </div>
    <div class="hamburger">
        <span></span>
        <span></span>
        <span></span>
    </div>
</nav>
