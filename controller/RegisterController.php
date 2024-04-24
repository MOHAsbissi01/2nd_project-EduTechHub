<?php

include_once '../model/UserModel.php';

class RegisterController {
    
    public function register() {
        
        if(isset($_POST['submit'])) {
            // Get   data 
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $cpassword = $_POST['cpassword'];
            $role = $_POST['role'];
            $code = $_POST['code'];
            $image = $_FILES['image'];
            // Check  up 
            $image = isset($_FILES['image']) ? $_FILES['image'] : null;

             // -->
            $registerResult = UserModel::registerUser($name, $email, $password, $image , $role, $code);

            
            return $registerResult;
        }
    }
}


 
$registerController = new RegisterController();
$registerController->register();

?>
