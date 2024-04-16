 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }
        h2 {
            color: #333;
        }
        form {
            margin-top: 20px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"],
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        input[type="file"] {
            margin-top: 5px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        select {
            width: calc(100% - 22px);
            padding: 10px;
        }
    </style>
</head>
<body>
<div class="container">
<?php
// Include the config file and start the session
require_once '../model/config.php';
session_start();

// Check if the user is logged in
if (!isset($_SESSION['last_email'])) {
    echo "<p>Please <a href='login.php'>login</a> to edit your profile.</p>";
    exit();
}

// Check if form is submitted
if (isset($_POST['submit'])) {
    // Get form data
    $email = $_POST['email']; // Retrieve email from form submission
    $name = $_POST['name'];
    $password = $_POST['password']; // Plain text password
    $id = $_POST['id']; // User ID
    $image = $_FILES['image'];

    try {
        // Connect to the database
        $pdo = config::getConnexion();

        // Check if image is uploaded
        if (!empty($image['name'])) {
            // File upload path
            $target_dir = "../uploaded_img/";

            // Append a timestamp to make the filename unique
            $timestamp = time();
            $image_name = $timestamp . '_' . basename($image['name']);
            $target_file = $target_dir . $image_name;

            // Move uploaded file
            move_uploaded_file($image['tmp_name'], $target_file);

            // Prepare the update query
            $update_query = "UPDATE users SET name = :name, id = :id, image = :image WHERE email = :email";

            // Check if password is provided
            if (!empty($password)) {
                // Hash the provided password
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                // Append password to the update query
                $update_query = "UPDATE users SET name = :name, password = :password, id = :id, image = :image WHERE email = :email";
            }

            // Prepare and execute the update query
            $stmt = $pdo->prepare($update_query);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':image', $target_file);
            $stmt->bindParam(':email', $email);
            
            // Bind hashed password if provided
            if (!empty($password)) {
                $stmt->bindValue(':password', $hashed_password);
            }

            $stmt->execute();
        } else {
            // Prepare the update query
            $update_query = "UPDATE users SET name = :name, id = :id WHERE email = :email";

            // Check if password is provided
            if (!empty($password)) {
                // Hash the provided password
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                // Append password to the update query
                $update_query = "UPDATE users SET name = :name, password = :password, id = :id WHERE email = :email";
            }

            // Prepare and execute the update query
            $stmt = $pdo->prepare($update_query);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':email', $email);
            
            // Bind hashed password if provided
            if (!empty($password)) {
                $stmt->bindValue(':password', $hashed_password);
            }

            $stmt->execute();
        }

        // Redirect to read_data.php after update
        header('Location: read_data.php');
        exit();

    } catch(PDOException $e) {
        echo "<p>Error: " . $e->getMessage() . "</p>";
    } catch(Exception $e) {
        echo "<p>Error: " . $e->getMessage() . "</p>";
    }
} else {
    // Check if user email is provided in the URL
    if (!isset($_GET['email']) || empty($_GET['email'])) {
        echo "<p>User email not provided</p>";
        exit();
    }

    // Get the user email from the URL
    $email = $_GET['email'];

    try {
        // Connect to the database
        $pdo = config::getConnexion();

        // Prepare and execute the query to fetch user details
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if user exists
        if (!$user) {
            echo "<p>User not found</p>";
            exit();
        }

        // Display the user's image
        if (!empty($user['image'])) {
            echo "<img src='" . $user['image'] . "' alt='" . $user['name'] . "' style='max-width: 100%;'><br>";
        }

        // Display the form to edit user details
        echo "<h2>Edit User</h2>";
        echo "<form action='edit_user.php' method='POST' enctype='multipart/form-data'>";
        echo "<input type='hidden' name='email' value='" . $user['email'] . "'>"; // Include email as a hidden input field
        echo "Name: <input type='text' name='name' value='" . $user['name'] . "'><br>";
        echo "Password: <input type='password' name='password' value=''><br>";
        echo "Image: <input type='file' name='image'><br>";
        echo "Role: <select name='id'>";
        echo "<option value='1' " . ($user['id'] == 1 ? 'selected' : '') . ">Admin</option>";
        echo "<option value='2' " . ($user['id'] == 2 ? 'selected' : '') . ">Teacher</option>";
        echo "<option value='3' " . ($user['id'] == 3 ? 'selected' : '') . ">Student</option>";
        echo "</select><br>";
        echo "<input type='submit' name='submit' value='Update'>";
        echo "</form>";

    } catch(PDOException $e) {
        echo "<p>Error: " . $e->getMessage() . "</p>";
    }
}
?>


</div>
</body>
</html>
