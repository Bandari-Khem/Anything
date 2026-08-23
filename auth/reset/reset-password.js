document.getElementById('reset-password-form').addEventListener('submit', function (e) {
    e.preventDefault();

    const email = document.getElementById('email').value;
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/;

    if (!emailRegex.test(email)) {
        alert('Please enter a valid email address.');
        return;
    }

    // Simulate sending the request to the backend
    alert('Password reset request sent to your email. Please check your inbox.');

    // Redirect to login page after a short delay
    setTimeout(() => {
        window.location.href = 'login.html';
    }, 2000);
});

// "Go Back" button functionality
document.getElementById('go-back-btn').addEventListener('click', function () {
    window.location.href = 'reset-password.html';
});