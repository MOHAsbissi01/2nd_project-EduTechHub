<?php
 
require_once '../model/config.php';

// Check  email  
if (isset($_GET['email'])) {
    // Get   email   URL 
    $email = $_GET['email'];

    try {
        
        $pdo = config::getConnexion();

        // Delete data
        $stmt = $pdo->prepare("DELETE FROM users WHERE email = :email");
        $stmt->execute([':email' => $email]);

        // Redirect  
        header('Location: ../tableD.php');
        exit();
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
     
    echo "Email parameter not provided";
}
?>
