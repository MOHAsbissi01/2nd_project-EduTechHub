<?php
include_once '../model/UserModelLogin.php';

class LoginController {
    public function login() {
        $message = array(); // Initialize message array

        if(isset($_POST['submit'])){
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Call the loginUser method from UserModelLogin to handle the login process
            $loginResult = UserModelLogin::loginUser($email, $password);

            if($loginResult === true){
                // Redirect to home.php if login successful
              
                

               header('location: ../view/edit_user.php?email=' . urlencode($email));

                exit();
            } else {
                // Add error message to message array
                $message[] = $loginResult;
            }
        }

        // Return message array to display any error messages
        return $message;
    }
}
?>
