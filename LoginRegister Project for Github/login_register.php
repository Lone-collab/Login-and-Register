<?php

session_start();
require_once 'config.php';

if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $checkEmail = $conn->query("SELECT email From users WHERE email = '$email'");
    if ($checkEmail->num_rows > 0) {
        $_SESSION['register_error'] = 'Email already registered!';
        $_SESSION['active_form'] = 'register';
} else {
    $conn->query("INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$password', '$role')");
}

    header("Location: index.php");
    exit();
}

// Login process
if (isset($_POST['login'])) {

    // it stores the email and password entered by the user in the login form into the variables $email and $password.
    $email = $_POST['email'];
    $password = $_POST['password'];


    // it queries the database to find a user with the provided email. If a user is found, it verifies the entered password against the stored hashed password.
    $result = $conn->query("SELECT * FROM users WHERE email = '$email'");
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['name'] = $user['name'];
            $_SESSION['email'] = $user['email'];
// Redirect based on role
            if ($user['role'] === 'admin') {
                header("Location: admin_page.php");
            } else {
                header("Location: user_page.php");
            }
            exit();
        }
    }

    $_SESSION['login_error'] = 'Invalid email or password!';
    $_SESSION['active_form'] = 'login';
    header("Location: index.php");
    exit();
}
?>