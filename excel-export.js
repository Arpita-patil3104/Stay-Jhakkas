// Function to export data to Excel using SheetJS
function exportToExcel(data, filename) {
    // Create a new workbook
    const wb = XLSX.utils.book_new();
    
    // Convert data to worksheet
    const ws = XLSX.utils.json_to_sheet(data);
    
    // Add worksheet to workbook
    XLSX.utils.book_append_sheet(wb, ws, 'Data');
    
    // Save workbook to file
    XLSX.writeFile(wb, filename);
}

// Function to export users data
function exportUsers() {
    const users = JSON.parse(localStorage.getItem('users') || '[]');
    const sanitizedUsers = users.map(user => ({
        id: user.id,
        name: user.name,
        email: user.email,
        registrationDate: new Date().toISOString()
    }));
    exportToExcel(sanitizedUsers, 'hotel_users.xlsx');
}

// Function to export bookings data
function exportBookings() {
    const users = JSON.parse(localStorage.getItem('users') || '[]');
    const allBookings = [];
    
    users.forEach(user => {
        if (user.bookings) {
            user.bookings.forEach(booking => {
                allBookings.push({
                    bookingId: booking.id,
                    userId: user.id,
                    userName: user.name,
                    userEmail: user.email,
                    roomType: booking.roomType,
                    checkIn: booking.checkIn,
                    checkOut: booking.checkOut,
                    guests: booking.guests,
                    total: booking.total,
                    status: booking.status,
                    bookingDate: booking.bookingDate
                });
            });
        }
    });
    
    exportToExcel(allBookings, 'hotel_bookings.xlsx');
}

// Add export buttons to profile page for admins
if (document.querySelector('.profile-container')) {
    const isAdmin = auth.currentUser?.email === 'admin@hotel.com';
    if (isAdmin) {
        const exportSection = document.createElement('div');
        exportSection.className = 'export-section';
        exportSection.innerHTML = `
            <h3>Export Data</h3>
            <button onclick="exportUsers()" class="btn">Export Users</button>
            <button onclick="exportBookings()" class="btn">Export Bookings</button>
        `;
        document.querySelector('.profile-container').appendChild(exportSection);
    }
}
