<?php
session_start();
include_once '../model/UserModelLogin.php';
class LoginController {
    public function login() {
        $message = array();   

        if(isset($_POST['submit'])){
            $email = $_POST['email'];  
            $password = $_POST['password'];
            $captchaResponse = $_POST['g-recaptcha-response'];

            // Verify CAPTCHA response
            $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LcPHMYpAAAAAK-oGQSVvSqKNUZp62ufhcGqEXYj&response=" . $captchaResponse);
            $responseKeys = json_decode($response, true);

            if ($responseKeys["success"] == false) {
                $message[] = "Le CAPTCHA est incorrect.";
                return $message;
            }

            // loginU ---> UserModelLogin  
            $loginResult = UserModelLogin::loginUser($email, $password);

            if($loginResult === true){
                
                $userId = UserModelLogin::getUserId($email);
                $_SESSION['email'] = $email;
        
                // Redirect 
                switch($userId) {
                    case 1:
                        header('location: ../view/index-.php?email=' . urlencode($email));
                        exit();
                    case 2:
                        header('location: ../view/index-2.php?email=' . urlencode($email));
                        exit();
                    case 3:
                        header('location: ../view/index-3.php?email=' . urlencode($email));
                        exit();
                    default:
                         
                        header('location: ../view/index.php?email=' . urlencode($email));
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