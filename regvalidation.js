document.getElementById('registration-form').addEventListener('submit', function (e) {
    e.preventDefault();

    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm-password').value;
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/;
    const domain = email.split('@')[1];
    const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*]).{8,}$/;


    // List of Allowed Domains
    const allowedDomains = [
        'gmail.com',
        'yahoo.com',
        'hotmail.com',
        'outlook.com',
        'mail.com',
        'icloud.com'
    ];

    // Validate email format
    if (!emailRegex.test(email)) {
        alert('Please enter a valid email address.');
        return;
    }
    //split seperates text from given point.
    else if (!allowedDomains.includes(domain)) {
        alert("We can't accept this email domain for now!!");
        return;
    }

    else if (!passwordRegex.test(password)) {
        alert('Password must be at least 8 characters and include uppercase, lowercase, numbers, and special characters.');
        return;
    }

    // Check if passwords match
    else if (password !== confirmPassword) {
        alert('Passwords do not match.');
        return;
    }

    else {
        window.location.href = 'registration-step2.html';
    }
});
