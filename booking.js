// Room rates in INR (₹)
const ROOM_RATES = {
    'standard': 7999,
    'deluxe': 11999,
    'suite': 19999,
    'family': 23999,
    'ocean': 15999,
    'penthouse': 39999,
    'garden': 31999,
    'honeymoon': 27999
};

// Room capacities
const ROOM_CAPACITIES = {
    'standard': 2,
    'deluxe': 2,
    'suite': 3,
    'family': 6,
    'ocean': 2,
    'penthouse': 4,
    'garden': 6,
    'honeymoon': 2
};

document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('bookingForm');
    const checkInInput = document.getElementById('checkIn');
    const checkOutInput = document.getElementById('checkOut');
    const roomTypeSelect = document.getElementById('roomType');
    const guestsInput = document.getElementById('guests');
    const totalElement = document.getElementById('total');
    
    // Set minimum dates
    const today = new Date();
    const tomorrow = new Date(today);
    tomorrow.setDate(tomorrow.getDate() + 1);
    
    checkInInput.min = today.toISOString().split('T')[0];
    checkOutInput.min = tomorrow.toISOString().split('T')[0];
    
    // Get room type from URL if present
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('type')) {
        roomTypeSelect.value = urlParams.get('type');
        // Update max guests based on room type
        guestsInput.max = ROOM_CAPACITIES[roomTypeSelect.value];
    }

    // Update max guests when room type changes
    roomTypeSelect.addEventListener('change', () => {
        guestsInput.max = ROOM_CAPACITIES[roomTypeSelect.value];
        if (parseInt(guestsInput.value) > ROOM_CAPACITIES[roomTypeSelect.value]) {
            guestsInput.value = ROOM_CAPACITIES[roomTypeSelect.value];
        }
        calculateTotal();
    });

    // Calculate total when inputs change
    function calculateTotal() {
        const checkIn = new Date(checkInInput.value);
        const checkOut = new Date(checkOutInput.value);
        const roomType = roomTypeSelect.value;
        
        if (checkIn && checkOut && checkOut > checkIn) {
            const nights = Math.ceil((checkOut - checkIn) / (1000 * 60 * 60 * 24));
            const rate = ROOM_RATES[roomType];
            const total = nights * rate;
            totalElement.textContent = `₹${total.toLocaleString('en-IN')}`;
            return total;
        }
        totalElement.textContent = '₹0';
        return 0;
    }
    
    [checkInInput, checkOutInput, roomTypeSelect].forEach(input => {
        input.addEventListener('change', calculateTotal);
    });
    
    // Form submission
    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        
        if (!auth.isLoggedIn) {
            alert('Please login to make a booking');
            window.location.href = 'login.html';
            return;
        }

        const guests = parseInt(guestsInput.value);
        const roomType = roomTypeSelect.value;
        if (guests > ROOM_CAPACITIES[roomType]) {
            alert(`This room type can only accommodate ${ROOM_CAPACITIES[roomType]} guests.`);
            return;
        }
        
        const bookingData = {
            checkIn: checkInInput.value,
            checkOut: checkOutInput.value,
            roomType: roomType,
            guests: guests,
            total: calculateTotal()
        };
        
        try {
            const booking = auth.addBooking(bookingData);
            alert('Booking confirmed! You can view your booking in your profile.');
            window.location.href = 'profile.html';
        } catch (error) {
            alert('Error making booking: ' + error.message);
        }
    });
});
