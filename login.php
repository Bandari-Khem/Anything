
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eLibrary - Login</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="../all.css">
    <link rel="stylesheet" href="forms.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="shortcut icon" href="../../images/logo.jpg" type="image/x-icon">
</head>

<body>
     <!-- NAVIGATION -->

    <header class="navbar">
        <a href="../index.html" class="logo"> <i class="fa-solid fa-book-open"></i>
            eLibrary</a>

        <nav class="nav-links">
            <a href="../index.html">Home</a>
            <a href="../pages/books.html">Books</a>
            <a href="../pages/contact-us.html">Contact Us</a>
            <a href="../pages/about-us.html">About Us</a>
            <a href="#setting" class="settings-icon"></a>
            <div class="dropdown">
                <a class="btn btn-info dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-gear"></i>
                </a>
            </div>
        </nav>
    </header>

    <main>
        <section class="hero">
            <div>
                <h1>
                    Welcome back! Log in to your account to access your personalized reading experience, manage your
                    profile, and enjoy exclusive features.
                </h1>
            </div>
        </section>

        <section>
            <form id="login-form" action="validations/login_validation.php">
                <h2 style="text-align: center;">Login</h2>
                <label for="username">Enter your username:</label>
                <input type="text" id="username" name="username" placeholder="username.." required>

                <label for="password">Enter your password:</label>
                <input type="password" id="password" name="password" placeholder="password.." required>

                <p style="float: right; margin-right: 20px;">
                    <a href="registration.html"
                        style="color: #007BFF; font-family: sans-serif;text-align: right;text-decoration: none;">Sign
                        Up</a>
                </p>
                <p style="float: left;">
                    <a href="reset-password.html"
                        style="color: #007BFF;text-decoration: none; font-family: sans-serif;">Forgot Password</a>
                </p>
                <p>
                    <button type="submit">Login</button>
                </p>
            </form>
        </section>

        <section>

        </section>
    </main>
</body>

</html>