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
            // Check  uploaded
            $image = isset($_FILES['image']) ? $_FILES['image'] : null;

            // Call   UserModel to handle the registration 
            $registerResult = UserModel::registerUser($name, $email, $password, $image , $role, $code);

            // Return the registration result
            return $registerResult;
        }
    }
}


// Create instance of RegisterController and call the register method
$registerController = new RegisterController();
$registerController->register();

?>
