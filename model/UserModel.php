<?php
include_once '../model/config.php'; 
class UserModel {

    public static function registerUser($name, $email, $password, $image, $role, $code) {
        $pdo = config::getConnexion();
        $registrationStatus = '';
    
        // Check for empty fields
        if(empty($name) || empty($email) || empty($password)) {
            return 'Please fill in all fields!';
        }
    
        // Check if email contains "@"
        if(strpos($email, '@') === false) {
            return 'Invalid email address!';
        }
    
        $stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email');
        $stmt->execute([':email' => $email]);
        $existingUser = $stmt->fetch();
           
        if($existingUser){
            return 'Email address is registered!';
        }
    
    
        if(isset($role)){
            if($role == 'admin'){
                if($code !== 'esprit'){
                    return 'Incorrect code for admin registration!';
                }
            }
        } else {
            $role = 'student';
        }
    
        if(strlen($password) < 8) {
            return 'Password must be at least 8 characters long!';
        } else {
            switch($role) {
                case 'admin':
                    $id = 1;
                    break;
                case 'teacher':
                    $id = 2;
                    break;
                case 'student':
                    $id = 3;
                    break;
                default:
                    $id = 3;  
            }
    
            if(isset($image['name']) && $image['error'] === UPLOAD_ERR_OK) {
                $image_name = $image['name'];
                $image_tmp_name = $image['tmp_name'];
                $image_folder = '../uploaded_img/'.$image_name;
                $image_name_path = 'uploaded_img/'.$image_name;
                move_uploaded_file($image_tmp_name, $image_folder);
            } else {
                $image_folder = ''; 
                $image_name_path = '';
            }
    
            $stmt = $pdo->prepare('INSERT INTO users(id, name, email, password, image) VALUES(:id, :name, :email, :password, :image)');
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $insert = $stmt->execute([':id' => (int)$id, ':name' => $name, ':email' => $email, ':password' => $passwordHash, ':image' => $image_name_path]);  
    
            if($insert){
                return 'Registered successfully!';
            } else {
                return 'Registration failed!';
            }
            
         
        
        }
    }
    
    
    
 
}
?>
