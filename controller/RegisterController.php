<?php

include_once '../model/UserModel.php';

class RegisterController {
    
    public function register() {
        // Check if the form is submitted
        if(isset($_POST['submit'])) {
            // Get form data
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $cpassword = $_POST['cpassword'];
            $role = $_POST['role'];
            $code = $_POST['code'];
            $image = $_FILES['image'];

            // Call the UserModel to handle the registration process
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
