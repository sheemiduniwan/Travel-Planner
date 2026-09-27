<?php
session_start();
require_once '../db_config.php';

// User දැනටමත් Log වී සිටී නම් index.html වෙත Redirect කිරීම
if (isset($_SESSION['user_id'])) {
    header("Location: ../index.html");
    exit();
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    // Validation Check
    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        $error = "Please fill in all required fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Please enter a valid email address.";
    } elseif ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } elseif (strlen($password) < 6) {
        $error = "Password must be at least 6 characters long.";
    } else {
        // Email එක කලින් භාවිත කර ඇත්දැයි පරීක්ෂා කිරීම
        $check_sql = "SELECT id FROM users WHERE email = ?";
        $stmt = $conn->prepare($check_sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $error = "An account with this email already exists.";
        } else {
            // Password එක Hash කිරීම (Security)
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // User එකතු කිරීම
            $insert_sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
            $insert_stmt = $conn->prepare($insert_sql);
            $insert_stmt->bind_param("sss", $username, $email, $hashed_password);

            if ($insert_stmt->execute()) {
                // Successful registration -> alert and redirect to login.php
                echo "<script>
                    alert('Registration successful! Please log in to your account.');
                    window.location.href = 'login.php?registered=1';
                </script>";
                exit();
            } else {
                $error = "Something went wrong. Please try again.";
            }
            $insert_stmt->close();
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Infinite Travels</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f6f9; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .card { background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); width: 100%; max-width: 400px; }
        .card h2 { margin-bottom: 20px; text-align: center; color: #333; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; color: #666; }
        .form-group input { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        .btn { width: 100%; padding: 10px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; }
        .btn:hover { background: #0056b3; }
        .msg-error { color: #dc3545; background: #f8d7da; padding: 10px; border-radius: 4px; margin-bottom: 15px; font-size: 14px; }
        .msg-success { color: #28a745; background: #d4edda; padding: 10px; border-radius: 4px; margin-bottom: 15px; font-size: 14px; }
        .text-center { text-align: center; margin-top: 15px; font-size: 14px; }
        .text-center a { color: #007bff; text-decoration: none; }
    </style>
</head>
<body>

<div class="card">
    <h2>Create Account</h2>

    <?php if (!empty($error)): ?>
        <div class="msg-error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <?php if (!empty($success)): ?>
        <div class="msg-success">
            <?php echo htmlspecialchars($success); ?> <br><a href="login.php">Click here to Login</a>
        </div>
    <?php endif; ?>

    <form action="register.php" method="POST">
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" required placeholder="JohnDoe">
        </div>

        <div class="form-group">
            <label>Email Address</label>
            <input type="email" name="email" required placeholder="john@example.com">
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" required placeholder="At least 6 characters">
        </div>

        <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" name="confirm_password" required placeholder="Repeat password">
        </div>

        <button type="submit" class="btn">Register</button>
    </form>

    <div class="text-center">
        Already have an account? <a href="login.php">Login here</a>
    </div>
    <div class="text-center" style="margin-top: 10px;">
        <a href="../index.html">&larr; Back to Home</a>
    </div>
</div>

</body>
</html>