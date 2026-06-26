document.getElementById('registration-form').addEventListener('submit', function (e) {
    e.preventDefault();

    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm-password').value;

    // Validate email format
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/;
    if (!emailRegex.test(email)) {
        alert('Please enter a valid email address.');
        return;
    }

    // List of known fake email domains
    const fakeDomains = ['example.com', 'test.com', 'dummy.com', 'fakeemail.com'];

    const domain = email.split('@')[1];//split seperates text from given point.
    if (fakeDomains.includes(domain)) {
        alert('We cannot accept fake email addresses. Please use a real email.');
        return;
    }

    // Validate password strength
    const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*]).{8,}$/;
    if (!passwordRegex.test(password)) {
        alert('Password must be at least 8 characters and include uppercase, lowercase, numbers, and special characters.');
        return;
    }

    // Check if passwords match
    if (password !== confirmPassword) {
        alert('Passwords do not match.');
        return;
    }

    // Redirect to the second registration step
    window.location.href = 'registration-step2.html';
});
