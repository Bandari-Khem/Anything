document.getElementById('registration-form').addEventListener('submit', function (e) {
    e.preventDefault();

    // Reset error messages
    document.getElementById('email-error').textContent = '';
    document.getElementById('password-error').textContent = '';
    document.getElementById('confirm-password-error').textContent = '';

    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm-password').value;

    // Email validation
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/;
    if (!emailRegex.test(email)) {
        document.getElementById('email-error').textContent = 'Please enter a valid email address.';
        return;
    }

    // Password validation
    const passwordRegex = /.{5,}/;
    if (!passwordRegex.test(password)) {
        document.getElementById('password-error').textContent = 'Password must be at least 5 characters long.';
        return;
    }

    // Password confirmation
    if (password !== confirmPassword) {
        document.getElementById('confirm-password-error').textContent = 'Passwords do not match.';
        return;
    }

    // All validations passed
    window.location.href = 'registration-step2.html';
});