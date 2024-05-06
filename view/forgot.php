<!-- forgot.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
</head>
<body>
    <?php
    // Include your config.php file here
    require_once '../model/config.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Handle form submission for sending verification code
        if (isset($_POST['send_code'])) {
            $email = $_POST['email'];

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "Invalid email format. Please enter a valid email address.";
                exit;
            }

            $pdo = config::getConnexion();
            $stmt = $pdo->prepare("SELECT reset_token FROM users WHERE email = :email");
            $stmt->execute(['email' => $email]);
            $user = $stmt->fetch();

            if ($user) {
                // User exists; proceed with sending verification code
                $verificationCode = mt_rand(1000, 9999);
                $updateStmt = $pdo->prepare("UPDATE users SET reset_token = :token WHERE email = :email");
                $updateStmt->execute(['token' => $verificationCode, 'email' => $email]);

                // Send the verification code to the user's email using PHPMailer
                require '../PHPMailer/src/Exception.php';
                require '../PHPMailer/src/PHPMailer.php';
                require '../PHPMailer/src/SMTP.php';

                $mail = new PHPMailer\PHPMailer\PHPMailer();
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com'; // Your SMTP server details
                $mail->SMTPAuth = true;
                $mail->Username = 'sbissimohamed9@gmail.com'; // Your email address
                $mail->Password = 'exzsybbdxhiybvfg'; // Your email password
                $mail->SMTPSecure = 'ssl'; // Use 'tls' or 'ssl' as appropriate
                $mail->Port = 465; // Port number

                $mail->setFrom('sbissimohamed9@example.com', 'EduTech');
                $mail->addAddress($email);
                $mail->Subject = 'Password Reset Code';
                $mail->Body = "Your verification code: $verificationCode";
                
                if ($mail->send()) {
                    echo "Verification code sent to your email. Please check your inbox.";
                    header("Location: verification.php?email=$email");
                      exit;
                } else {
                    echo "Error sending email. Please try again later.";
                }
            } else {
                echo "Email not found. Please enter a registered email address.";
            }
        }
    }
    ?>

    <h1>Forgot Password</h1>
    <form method="post">
        <label for="email">Enter your email:</label>
        <input type="email" id="email" name="email" required>
        <button type="submit" name="send_code">Send Verification Code</button>
    </form>
</body>
</html>
