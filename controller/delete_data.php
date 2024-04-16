<?php
// Include the config file
require_once '../model/config.php';

// Check if email parameter is provided
if (isset($_GET['email'])) {
    // Get the email from the URL parameter
    $email = $_GET['email'];

    try {
        // Connect to the database
        $pdo = config::getConnexion();

        // Delete user data from the database
        $stmt = $pdo->prepare("DELETE FROM users WHERE email = :email");
        $stmt->execute([':email' => $email]);

        // Redirect back to read_data.php after deletion
        header('Location: ../view/read_data.php');
        exit();
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    // If email parameter is not provided, display an error message
    echo "Email parameter not provided";
}
?>
