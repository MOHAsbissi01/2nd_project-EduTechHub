<?php
include_once '../model/config.php'; // Include the config file if not already included
class UserModel {

    public static function registerUser($name, $email, $password, $image, $role, $code) {
        // Database connection
        $pdo = config::getConnexion();
        // Variable to track registration status
        $registrationStatus = '';
        // Check if the role field is set in the form submission
        if(isset($role)){
            // Check if the role  
            if($role == 'admin'){
                if($code !== 'esprit'){
                    $registrationStatus = 'Incorrect code for admin registration!';
                }
            }
        } else {
            // Default 
            $role = 'student';
        }
        // Check if the emai 
        $stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email');
        $stmt->execute([':email' => $email]);
        $existingUser = $stmt->fetch();
        if($existingUser){
           
            $registrationStatus = 'Email address is already registered!';
        } elseif($role === 'admin' && $code !== 'esprit') {
            
            $registrationStatus = 'Incorrect code for admin registration!';
        } elseif(strlen($password) < 8) {
             
            $registrationStatus = 'Password must be at least 8 characters long!';
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
            // Check  image 
            if(isset($image['name']) && $image['error'] === UPLOAD_ERR_OK) {
                // Image   uploaded --> process 
                $image_name = $image['name'];
                $image_tmp_name = $image['tmp_name'];
                $image_folder = '../uploaded_img/'.$image_name;
                move_uploaded_file($image_tmp_name, $image_folder);
            } else {
                // No image was uploaded, set  empty 
                $image_folder = ''; // $image_folder = NULL;
            }
            // Insert  user  datab
            $stmt = $pdo->prepare('INSERT INTO users(id, name, email, password, image) VALUES(:id, :name, :email, :password, :image)');
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $insert = $stmt->execute([':id' => (int)$id, ':name' => $name, ':email' => $email, ':password' => $passwordHash, ':image' => $image_folder]);
            if($insert){
                $registrationStatus = 'Registered successfully!';
            } else {
                $registrationStatus = 'Registration failed!';
            }
        }
        
        return $registrationStatus;
    }
 
}
?>
