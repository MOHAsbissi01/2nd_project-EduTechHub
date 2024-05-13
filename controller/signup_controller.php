<?php
// Include the necessary files and classes
require_once '../model/user_model.php'; // Adjust the path if needed

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    // Validate form data (basic validation)
    if (empty($username) || empty($email) || empty($password)) {
        $errorMessage = "Please fill in all fields.";
    } else {
        // Create an instance of UserModel to interact with the database
        $userModel = new UserModel();

        // Check if the email is already registered
        if ($userModel->isEmailRegistered($email)) {
            $errorMessage = "Email is already registered.";
        } else {
            // Attempt to register the user
            $result = $userModel->registerUser($username, $email, $password);
            if ($result) {
                $successMessage = "Registration successful. You can now sign in.";
            } else {
                $errorMessage = "Registration failed. Please try again later.";
            }
        }
    }
}

// Include the signup view file
include('../view/signup.php'); // Adjust the path if needed
?>

<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>
    <style>
        /* Add your CSS styles here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }
        
        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        
        .form-group .error-message {
            color: red;
            margin-top: 5px;
        }
        
        .form-group .success-message {
            color: green;
            margin-top: 5px;
        }
        
        .form-group .submit-btn {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Signup</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <?php if (isset($errorMessage)): ?>
                <div class="form-group error-message">
                    <?php echo $errorMessage; ?>
                </div>
            <?php endif; ?>
            <?php if (isset($successMessage)): ?>
                <div class="form-group success-message">
                    <?php echo $successMessage; ?>
                </div>
            <?php endif; ?>
            <div class="form-group">
                <input type="submit" value="Signup" class="submit-btn">
            </div>
        </form>
    </div>
</body>
</html>
