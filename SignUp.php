<?php
session_start();
include_once 'dbh.inc.php';

// ---------- Functions ----------
function redirectWithError($location, $errorCode) {
    header("Location: $location?error=$errorCode");
    exit();
}

function userExists($conn, $email) {
    $sql = "SELECT id FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Database error: " . $conn->error);
    }
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $exists = $stmt->num_rows > 0;
    $stmt->close();
    return $exists;
}

function createUser($conn, $name, $email, $hashedPassword) {
    $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        return false;
    }
    $stmt->bind_param("sss", $name, $email, $hashedPassword);
    $success = $stmt->execute();
    $stmt->close();
    return $success;
}

function isPasswordStrong($password) {
    $hasUpper = preg_match('@[A-Z]@', $password);
    $hasLower = preg_match('@[a-z]@', $password);
    $hasNumber = preg_match('@[0-9]@', $password);
    $hasSpecial = preg_match('@[^\w]@', $password);
    $longEnough = strlen($password) >= 8;
    return $hasUpper && $hasLower && $hasNumber && $hasSpecial && $longEnough;
}

// ---------- Form Submission ----------
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm-password'];

    if (empty($name) || empty($email) || empty($password) || empty($confirmPassword)) {
        redirectWithError('signup.php', 'empty_fields');
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        redirectWithError('signup.php', 'invalid_email');
    }

    if ($password !== $confirmPassword) {
        redirectWithError('signup.php', 'passwords_mismatch');
    }

    if (!isPasswordStrong($password)) {
        redirectWithError('signup.php', 'weak_password');
    }

    if (userExists($conn, $email)) {
        redirectWithError('signup.php', 'email_exists');
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    if (createUser($conn, $name, $email, $hashedPassword)) {
        header("Location: Login.php?signup=success");
        exit();
    } else {
        redirectWithError('signup.php', 'signup_failed');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>One More Party - Sign Up</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="Sign Up.css">
</head>
<body>
<?php if (isset($_GET['error'])): ?>
    <div class="error-message">
        <?php
        switch ($_GET['error']) {
            case 'empty_fields': echo "Please fill in all fields."; break;
            case 'invalid_email': echo "Invalid email format."; break;
            case 'passwords_mismatch': echo "Passwords do not match."; break;
            case 'weak_password': echo "Password must include uppercase, lowercase, number, symbol, and be 8+ characters."; break;
            case 'email_exists': echo "Email is already registered."; break;
            case 'signup_failed': echo "Something went wrong. Try again."; break;
            case 'unauthorized_access': echo "Access denied."; break;
            default: echo "Unknown error."; break;
        }
        ?>
    </div>
<?php endif; ?>

<div class="signup-container">
    <!-- Logo Section -->
    <div class="logo">
      <img src="image/Logo 1.png" alt="One More Party Logo" />
    </div>
    <!-- Title -->
    <h2 class="signup-title">Sign Up</h2>
    <form action="SignUp.php" method="post">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="Enter your name">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password">
        </div>
        <div class="form-group">
            <label for="confirm-password">Confirm Password</label>
            <input type="password" id="confirm-password" name="confirm-password" class="form-control" placeholder="Confirm your password">
        </div>
        <button type="submit" class="signup-button">Sign Up</button>
    </form>
    <div class="login-link">
        <p class="account">Already have an account? <a href="Login.php">Log in Now</a></p>
    </div>
</div>
</body>
</html>
