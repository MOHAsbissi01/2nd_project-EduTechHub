<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
</head>
<body>
    <?php
    require_once '../model/config.php';

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $email = $_POST['email']; // Retrieve email from query parameter
        $newPassword = $_POST['password'];

        // Hash the new password
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        try {
            $pdo = config::getConnexion();
            $stmt = $pdo->prepare("UPDATE users SET password = :password WHERE email = :email");
            $stmt->execute(['password' => $hashedPassword, 'email' => $email]);

            // Check if the update was successful
            if ($stmt->rowCount() > 0) {
                echo "Password reset successful! You can now log in with your new password.";
            } else {
                echo "Error updating password. Please try again later.";
            }
        } catch (PDOException $e) {
            echo "Error updating password: " . $e->getMessage();
        }
    }
    ?>

    <h1>Reset Password</h1>
    <form method="post">
        <input type="hidden" name="email" value="<?php echo $_GET['email']; ?>">
        <label for="password">Enter your new password:</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">Reset Password</button>
    </form>
</body>
</html>
