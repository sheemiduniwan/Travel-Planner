<?php
// Database connection
require_once 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Form 
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $message = trim($_POST['message'] ?? '');

    // Validation
    if (empty($name) || empty($email) || empty($message)) {
        echo "<script>
            alert('Please fill in all required fields.');
            window.location.href = 'index.html#contact';
        </script>";
        exit();
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>
            alert('Please enter a valid email address.');
            window.location.href = 'index.html#contact';
        </script>";
        exit();
    } else {
        // Database  Insert 
        $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, phone, message) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $phone, $message);

        if ($stmt->execute()) {
            
            echo "<script>
                alert('Thank you! Your message has been sent successfully.');
                window.location.href = 'index.html#contact';
            </script>";
        } else {
            echo "<script>
                alert('Failed to send message. Please try again.');
                window.location.href = 'index.html#contact';
            </script>";
        }

        $stmt->close();
    }
} else {
    // Direct access
    header("Location: index.html");
    exit();
}
?>
