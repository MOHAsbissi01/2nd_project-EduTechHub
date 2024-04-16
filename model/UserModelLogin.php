
<?php 
include_once '../model/config.php';

class UserModelLogin {
    public static function loginUser($email, $password) {
        // Database connection
        $pdo = config::getConnexion();

        // Query the database to find a user with the provided email
        $stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email');
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch();

        // Check user exists
        if($user) {
             
            if(password_verify($password, $user['password'])) {
                 
                $_SESSION['user_id'] = $user['id']; 
                $_SESSION['last_email'] = $email;  
                return true;  
            } else {
                
                return 'Incorrect email or password!';
            }
        } else {
            // User with the provided email doesn't exist, return an error message
            return 'Incorrect email or password!';
        }
    }
}
?>
