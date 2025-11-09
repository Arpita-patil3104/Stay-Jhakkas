// Profile page functionality
document.addEventListener('DOMContentLoaded', () => {
    if (!auth.currentUser) return;

    // Update profile information
    document.getElementById('userName').textContent = auth.currentUser.name;
    document.getElementById('userEmail').textContent = auth.currentUser.email;
    document.getElementById('updateName').value = auth.currentUser.name;
    document.getElementById('updateEmail').value = auth.currentUser.email;

    // Display bookings
    const bookingsList = document.getElementById('bookingsList');
    if (auth.currentUser.bookings && auth.currentUser.bookings.length > 0) {
        auth.currentUser.bookings.forEach(booking => {
            const bookingCard = document.createElement('div');
            bookingCard.className = 'booking-card';
            bookingCard.innerHTML = `
                <h4>Booking #${booking.id}</h4>
                <p><strong>Room:</strong> ${booking.roomType}</p>
                <p><strong>Check-in:</strong> ${new Date(booking.checkIn).toLocaleDateString()}</p>
                <p><strong>Check-out:</strong> ${new Date(booking.checkOut).toLocaleDateString()}</p>
                <p><strong>Guests:</strong> ${booking.guests}</p>
                <p><strong>Total:</strong> $${booking.total}</p>
                <p><strong>Status:</strong> <span class="status-${booking.status.toLowerCase()}">${booking.status}</span></p>
            `;
            bookingsList.appendChild(bookingCard);
        });
    } else {
        bookingsList.innerHTML = '<p>No bookings found</p>';
    }

    // Handle profile updates
    const updateProfileForm = document.getElementById('updateProfileForm');
    updateProfileForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const name = document.getElementById('updateName').value;
        const currentPassword = document.getElementById('currentPassword').value;
        const newPassword = document.getElementById('newPassword').value;

        try {
            auth.updateProfile(name, currentPassword, newPassword);
            alert('Profile updated successfully');
            location.reload();
        } catch (error) {
            alert(error.message);
        }
    });
});
