<?php
session_start();
require_once 'dbh.inc.php'; // Ensure this returns a PDO connection

// === FUNCTION TO GET USER BY EMAIL ===
function getUserByEmail($conn, $email) {
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) return false;

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

// === REDIRECT WITH ERROR ===
function redirectWithError($error, $email = '') {
    $url = "Login.php?error=" . urlencode($error);
    if (!empty($email)) $url .= "&email=" . urlencode($email);
    header("Location: $url");
    exit();
}

// === LOGIN HANDLER ===
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) redirectWithError("empty_fields", $email);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) redirectWithError("invalid_email", $email);

    $user = getUserByEmail($conn, $email);
    if (!$user || !password_verify($password, $user['password'])) {
        redirectWithError("invalid_credentials", $email);
    }

    // ✅ Successful login
    session_regenerate_id(true);
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_name'] = $user['name'];
    $_SESSION['user_email'] = $user['email'];

    // ✅ Admin redirect
    if ($email === 'admin@gmail.com') {
        header("Location: admin.php");
        exit();
    }

    // ✅ Check if booking was attempted before login
    if (isset($_SESSION['pending_booking'])) {
        header("Location: Booking.php");
        exit();
    }

    // ✅ Default user redirect
    header("Location: index.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>One More Party – Login</title>
  <link rel="stylesheet" href="Login.css">
</head>
<body>
  <div class="login-container">
    <h2 class="login-title">Login</h2>

    <?php if (isset($_GET['error'])): ?>
      <p class="error-message" style="color:red;">
        <?php
          $error = htmlspecialchars($_GET['error']);
          switch ($error) {
              case "empty_fields": echo "Please fill in all fields."; break;
              case "invalid_email": echo "Invalid email format."; break;
              case "invalid_credentials": echo "Incorrect email or password."; break;
              case "unauthorized_access": echo "Unauthorized access."; break;
              default: echo "An unknown error occurred.";
          }
        ?>
      </p>
    <?php endif; ?>

    <form action="Login.php" method="POST" id="loginForm">
      <div class="form-group">
        <label for="email">Email</label>
        <input 
          type="email" 
          id="email" 
          name="email" 
          class="form-control" 
          placeholder="Enter your email" 
          value="<?php echo isset($_GET['email']) ? htmlspecialchars($_GET['email']) : ''; ?>" 
          required
        >
      </div>

      <div class="form-group">
        <label for="password">Password</label>
        <input 
          type="password" 
          id="password" 
          name="password" 
          class="form-control" 
          placeholder="Enter your password" 
          required
        >
      </div>

      <button type="submit" class="login-button">Login</button>
    </form>

    <div class="forgot-password">
      <a href="#">Forgot Password?</a>
    </div>

    <p class="account">
      Don't have an account? <a href="signup.php">Register Now</a>
    </p>
  </div>
</body>
</html>
