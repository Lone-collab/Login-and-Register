<?php

session_start(); // Start the session to handle form states and messages


// this array stores error messages for login and registration forms, as well as which form should be active (visible) when the page loads.
$errors = [
    'login' => $_SESSION['login_error'] ?? '',
    'register' => $_SESSION['register_error'] ?? ''
];

//this variable used to determine which form (login or register) should be displayed as active when the page loads.
$activeForm = $_SESSION['active_form'] ?? 'login';

session_unset(); // Clear session variables to avoid showing old messages/forms on page reload


// it returns an HTML paragraph element containing the error message if there is an error; otherwise, it returns an empty string.
function showError($error) {
    return !empty($error) ? "<p class='error-message'>$error</p>" : '';
}


// it accepts two parameters: the name of a form and the currently active form. It returns the string 'active' if the form name matches the active form, otherwise it returns an empty string.
function isActiveForm($formName, $activeForm) {
    return $formName === $activeForm ? 'active' : '';
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login and Register Form with User and Admin Page</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!-- Container for the login form -->
    <div class="container">
        <div class="form-box <?= isActiveForm('login', $activeForm); ?>" id="login-form">
            <form action="login_register.php" method="post">
                <h2>Login</h2>
                <?= showError($errors['login']); ?> <!-- Display login messages -->
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit" name="login">Login</button>
                <p>Don't have an account? <a href="#" onclick="showForm('register-form')">Register</a> </p>
            </form>
        </div>

        <!-- Container for the register form -->
         <div class="form-box <?= isActiveForm('register', $activeForm); ?> " id="register-form">
            <form action="login_register.php" method="post">
                <h2>Register</h2>
                <?= showError($errors['register']); ?> <!-- Display registration messages -->
                <input type="text" name="name" placeholder="Name" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <!-- Added role selection dropdown -->
                <select name="role" required>
                    <option value="">--Select Role--</option>
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
                <button type="submit" name="register">Register</button>
                <p>Already have an account? <a href="#" onclick="showForm('login-form')">Login</a> </p>
            </form>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>