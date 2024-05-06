<!-- verification.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
</head>
<body>
    <?php
    require_once '../model/config.php';

    // Retrieve email from URL parameter
    $email = $_GET['email'];

    // Validate the email (you can add more validation checks)
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format. Please enter a valid email address.";
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Handle form submission for verifying the entered code
        $enteredCode = $_POST['verification_code'];

        // Retrieve the user's reset token from the database
        $pdo = config::getConnexion();
        $stmt = $pdo->prepare("SELECT reset_token FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();

        if ($user) {
            // Compare the entered code with the stored reset token
            $storedResetToken = $user['reset_token'];

            if ($enteredCode == $storedResetToken) {
                echo "Verification successful! You can now reset your password.";
                header("Location: reset.php?email=$email");
                exit;
                // Display the password reset form here
            } else {
                echo "Incorrect verification code. Please try again.";
                
            }
        } else {
            echo "Email not found. Please enter a registered email address.";
        }
    }
    ?>

    <h1>Verify Code</h1>
    <form method="post">
        <label for="verification_code">Enter verification code:</label>
        <input type="text" id="verification_code" name="verification_code" required>
        <button type="submit">Verify Code</button>
    </form>
</body>
</html>
