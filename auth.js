// Handle user authentication and storage
class Auth {
    constructor() {
        this.isLoggedIn = false;
        this.currentUser = null;
        this.checkLoginStatus();
    }

    checkLoginStatus() {
        const user = localStorage.getItem('currentUser');
        if (user) {
            this.currentUser = JSON.parse(user);
            this.isLoggedIn = true;
            this.updateUI();
        } else if (!window.location.href.includes('login.html') && 
                   !window.location.href.includes('signup.html') &&
                   !window.location.href.includes('index.html')) {
            window.location.href = 'login.html';
        }
    }

    updateUI() {
        const navLinks = document.querySelector('.nav-links');
        if (this.isLoggedIn) {
            if (navLinks) {
                const loginLink = navLinks.querySelector('a[href="login.html"]');
                const signupLink = navLinks.querySelector('a[href="signup.html"]');
                if (loginLink) loginLink.style.display = 'none';
                if (signupLink) signupLink.style.display = 'none';
            }
        }
    }

    signup(name, email, password) {
        const users = JSON.parse(localStorage.getItem('users') || '[]');
        if (users.find(u => u.email === email)) {
            throw new Error('Email already exists');
        }

        const newUser = {
            id: Date.now().toString(),
            name,
            email,
            password,
            bookings: []
        };

        users.push(newUser);
        localStorage.setItem('users', JSON.stringify(users));
        this.login(email, password);
    }

    login(email, password) {
        const users = JSON.parse(localStorage.getItem('users') || '[]');
        const user = users.find(u => u.email === email && u.password === password);
        
        if (!user) {
            throw new Error('Invalid credentials');
        }

        this.currentUser = user;
        this.isLoggedIn = true;
        localStorage.setItem('currentUser', JSON.stringify(user));
        window.location.href = 'profile.html';
    }

    logout() {
        localStorage.removeItem('currentUser');
        this.currentUser = null;
        this.isLoggedIn = false;
        window.location.href = 'login.html';
    }

    updateProfile(name, currentPassword, newPassword) {
        const users = JSON.parse(localStorage.getItem('users') || '[]');
        const userIndex = users.findIndex(u => u.id === this.currentUser.id);
        
        if (userIndex === -1) throw new Error('User not found');
        
        if (users[userIndex].password !== currentPassword) {
            throw new Error('Current password is incorrect');
        }

        users[userIndex].name = name;
        if (newPassword) {
            users[userIndex].password = newPassword;
        }

        localStorage.setItem('users', JSON.stringify(users));
        this.currentUser = users[userIndex];
        localStorage.setItem('currentUser', JSON.stringify(this.currentUser));
    }

    addBooking(bookingData) {
        const users = JSON.parse(localStorage.getItem('users') || '[]');
        const userIndex = users.findIndex(u => u.id === this.currentUser.id);
        
        if (userIndex === -1) throw new Error('User not found');
        
        const booking = {
            id: Date.now().toString(),
            ...bookingData,
            status: 'confirmed',
            bookingDate: new Date().toISOString()
        };

        users[userIndex].bookings.push(booking);
        localStorage.setItem('users', JSON.stringify(users));
        this.currentUser = users[userIndex];
        localStorage.setItem('currentUser', JSON.stringify(this.currentUser));
        
        return booking;
    }
}

const auth = new Auth();

// Event Listeners
// if (document.getElementById('loginForm')) {
//     document.getElementById('loginForm').addEventListener('submit', (e) => {
//         e.preventDefault();
//         const email = document.getElementById('email').value;
//         const password = document.getElementById('password').value;
//         try {
//             auth.login(email, password);
//         } catch (error) {
//             alert(error.message);
//         }
//     });
// }

if (document.getElementById('signupForm')) {
    document.getElementById('signupForm').addEventListener('submit', (e) => {
        e.preventDefault();
        const name = document.getElementById('name').value;
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirmPassword').value;

        if (password !== confirmPassword) {
            alert('Passwords do not match');
            return;
        }

        try {
            auth.signup(name, email, password);
        } catch (error) {
            alert(error.message);
        }
    });
}

if (document.getElementById('logoutBtn')) {
    document.getElementById('logoutBtn').addEventListener('click', () => {
        auth.logout();
    });
}
