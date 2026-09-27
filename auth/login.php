<?php
session_start();
require_once '../db_config.php';


if (isset($_SESSION['user_id'])) {
    header("Location: ../index.html");
    exit();
}

$error = '';
$success = '';

if (isset($_GET['registered'])) {
    $success = "Registration successful! Please log in to your account.";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        $error = "Please fill in all fields.";
    } else {
      
        $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            
           
            if (password_verify($password, $user['password'])) {
              
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];

                echo "<script>
                    alert('Login successful! Welcome back, " . htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8') . "');
                    window.location.href = '../index.html';
                </script>";
                exit();
            } else {
                $error = "Invalid email or password.";
            }
        } else {
            $error = "Invalid email or password.";
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
    <title>Login - Infinite Travels</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f6f9; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .card { background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); width: 100%; max-width: 400px; }
        .card h2 { margin-bottom: 20px; text-align: center; color: #333; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; color: #666; }
        .form-group input { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        .btn { width: 100%; padding: 10px; background: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; }
        .btn:hover { background: #218838; }
        .msg-error { color: #dc3545; background: #f8d7da; padding: 10px; border-radius: 4px; margin-bottom: 15px; font-size: 14px; }
        .msg-success { color: #155724; background: #d4edda; padding: 10px; border-radius: 4px; margin-bottom: 15px; font-size: 14px; }
        .text-center { text-align: center; margin-top: 15px; font-size: 14px; }
        .text-center a { color: #007bff; text-decoration: none; }
    </style>
</head>
<body>

<div class="card">
    <h2>Login to Your Account</h2>

    <?php if (!empty($error)): ?>
        <div class="msg-error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <?php if (!empty($success)): ?>
        <div class="msg-success"><?php echo htmlspecialchars($success); ?></div>
    <?php endif; ?>

    <form action="login.php" method="POST">
        <div class="form-group">
            <label>Email Address</label>
            <input type="email" name="email" required placeholder="john@example.com">
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" required placeholder="Enter password">
        </div>

        <button type="submit" class="btn">Login</button>
    </form>

    <div class="text-center">
        Don't have an account? <a href="register.php">Register here</a>
    </div>
    <div class="text-center" style="margin-top: 10px;">
        <a href="../index.html">&larr; Back to Home</a>
    </div>
</div>

</body>
</html>
