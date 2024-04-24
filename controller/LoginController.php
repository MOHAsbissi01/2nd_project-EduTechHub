<?php
include_once '../model/UserModelLogin.php';

class LoginController {
    public function login() {
        $message = array();   

        if(isset($_POST['submit'])){
            $email = $_POST['email'];  
            $password = $_POST['password'];

            // loginU ---> UserModelLogin  
            $loginResult = UserModelLogin::loginUser($email, $password);

            if($loginResult === true){
                 
                $userId = UserModelLogin::getUserId($email);
        
                // Redirect 
                switch($userId) {
                    case 1:
                        header('location: ../index-.php?email=' . urlencode($email));
                        exit();
                    case 2:
                        header('location: ../index-2.php?email=' . urlencode($email));
                        exit();
                    case 3:
                        header('location: ../index-3.php?email=' . urlencode($email));
                        exit();
                    default:
                         
                        header('location: ../index.php?email=' . urlencode($email));
                        exit();
                }
            } else {
                
                $message[] = $loginResult;
            }
        }
        return $message;  
    }
}
?>