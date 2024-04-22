
<?php 
include_once '../model/config.php';

class UserModelLogin {
    public static function loginUser($email, $password) {
        //  connection
        $pdo = config::getConnexion();
    
        //query 
        $stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email');
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch();
    
        // Check  existance
        if($user) {
            if(password_verify($password, $user['password'])) {
                
                return true;
            } else {
                return 'Incorrect email or password!';
            }
        } else {
             
            return 'Incorrect email or password!';
        }
    }
     
    public static function getUserId($email) {
        //  connection
        $pdo = config::getConnexion();

        // Query  
        $stmt = $pdo->prepare('SELECT id FROM users WHERE email = :email');
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch();

        // Return ID
        return $user['id'];
    }
}
?>
