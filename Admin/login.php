<?php
session_start();
require __DIR__ . '/db_connect.php'; // Ensure database connection

$error = ""; // Initialize error message

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['email']) || !isset($_POST['password'])) {
        $error = "Both email and password are required!";
    } else {
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        if (empty($email)) {
            $error = "Email field cannot be empty!";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Invalid email format!";
        } elseif (empty($password)) {
            $error = "Password field cannot be empty!";
        } else {
            // Check if email exists
            $stmt = $conn->prepare("SELECT Admin_Id, Password FROM admin WHERE Email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();

                // If the password is hashed using md5, verify with md5 and then rehash it
                if (md5($password) === $row['Password']) {
                    // Rehash and update the password in the database
                    $newHashedPassword = password_hash($password, PASSWORD_DEFAULT);
                    $updateStmt = $conn->prepare("UPDATE admin SET Password = ? WHERE Email = ?");
                    $updateStmt->bind_param("ss", $newHashedPassword, $email);
                    $updateStmt->execute();

                    // Set session and redirect to dashboard
                    $_SESSION['admin_id'] = $row['Admin_Id'];
                    $_SESSION['admin_email'] = $email;
                    header("Location: Admin_services.php");
                    exit();
                } elseif (password_verify($password, $row['Password'])) {
                    // If the password is already hashed with password_hash(), verify it
                    $_SESSION['admin_id'] = $row['Admin_Id'];
                    $_SESSION['admin_email'] = $email;
                    header("Location: Admin_services.php");
                    exit();
                } else {
                    $error = "Incorrect password!";
                }
            } else {
                $error = "Email not found!";
            }
        }
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Admin Sign In</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('image.jpg') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }

        body::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: inherit;
            filter: blur(4px);
            z-index: -1;
        }

        .login-container {
            width: 400px;
            padding: 40px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        }
        h2 {
            text-align: center;
            font-size: 28px;
            font-weight: bold;
        }
        input {
            width: 100%;
            padding: 15px;
            margin: 15px 0;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
        }
        .btn {
            width: 100%;
            padding: 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #45A049;
        }
        .error {
            color: red;
            text-align: center;
            font-weight: bold;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Admin Sign In</h2>
        <?php if (!empty($error)) { echo "<p class='error'>$error</p>"; } ?>
        <form method="POST">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" class="btn">Sign In</button>
        </form>
    </div>
</body>
</html>
