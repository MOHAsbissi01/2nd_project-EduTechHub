 
<?php
include_once '../controller/LoginController.php';

// Create instance of LoginController
$loginController = new LoginController();

// Call login method to handle form submission
$message = $loginController->login();


// Check if $message is a URL
if(filter_var($message, FILTER_VALIDATE_URL)) {
    // Redirect the user
    header('Location: ' . $message);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login</title>
   
   
   <!-- template header -->

 <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="TemplateMo">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900" rel="stylesheet">

    <title>Education Meeting HTML5 Template</title>

    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="../assets/css/fontawesome.css">
    <link rel="stylesheet" href="../assets/css/templatemo-edu-meeting.css">
    <link rel="stylesheet" href="../assets/css/owl.css">
    <link rel="stylesheet" href="../assets/css/lightbox.css">


</head>
<body>
   
  <!-- ***** Header Area Start ***** -->
  <header class="header-area header-sticky">
      <div class="container">
          <div class="row">
              <div class="col-12">
                  <nav class="main-nav">
                      <!-- ***** Logo Start ***** -->
                      <a href="../index-.php" class="logo">
                          EduTechHub
                      </a>
                      <!-- ***** Logo End ***** -->
                      <!-- ***** Menu Start ***** -->
                      <ul class="nav">
                          
                          <li><a href="../meetings.html">Meetings</a></li>
                         
                          <li class="has-sub">
                              <a href="javascript:void(0)">Pages</a>
                              <ul class="sub-menu">
                                  <li><a href="../meetings.html">Upcoming Meetings</a></li>
                                  <li><a href="../meeting-details.html">Meeting Details</a></li>
                                     
                      <a class='menu-trigger'>
                          <span>Menu</span>
                      </a>
                      <!-- ***** Menu End ***** -->
                  </nav>
              </div>
          </div>
      </div>
  </header>
  <!-- ***** Header Area End ***** -->

  
  <!-- ***** Main Banner Area Start ***** -->
  <section class="section main-banner" id="top" data-section="section1">
      <video autoplay muted loop id="bg-video">
          <source src="../assets/images/course-video.mp4" type="video/mp4" />
      </video>

      <div class="video-overlay header-text">
          <div class="container">
            <div class="row">
              <div class="col-lg-12">
                <div class="caption">
               


                <!--login-->
                 <h2>Welcome to Education</h2>

                 <style>
                     /* use a style red for a login page   */
                     .form-container{
                        background: #f0f0f0;
                        margin-top: 50px;
                        padding: 20px;
                        border-radius: 10px;
                     }
                     .box{
                        width: 100%;
                        padding: 10px;
                        margin: 10px 0;
                        border-radius: 5px;
                        border: 1px solid #ccc;
                     }
                     .btn{
                        width: 100%;
                        padding: 10px;
                        border: none;
                        background: #333;
                        color: #fff;
                        border-radius: 5px;
                        cursor: pointer;
                     }
                     .message{
                        background: #f2dede;
                        color: #a94442;
                        padding: 10px;
                        margin: 10px 0;
                        border-radius: 5px;
                     }

                 </style>



                <script>
                    function validateForm(event) {
                    var email = document.forms["loginForm"]["email"].value;
                    var password = document.forms["loginForm"]["password"].value;
                    
                    if (email == "" || password == "") {
                        alert("Veuillez remplir tous les champs requis!");
                        event.preventDefault();
                        return false;
                    }
                    if (email.indexOf("@") == -1) {
                        alert("L'email doit contenir un '@'!");
                        event.preventDefault();
                        return false;
                    }
                }
                </script>
                
                <div class="form-container">
                <form name="loginForm" action="" method="post" onsubmit="return validateForm()">
                    <h3>Login Now</h3>
                    <?php 
                    if(isset($message)){
                        foreach($message as $msg){
                            echo '<div class="message">'.htmlspecialchars($msg).'</div>';
                        }
                    }
                    ?> 
                    <input type="text" name="email" placeholder="Enter email" class="box">
                    <input type="password" name="password" placeholder="Enter password" class="box">
                    <input type="submit" name="submit" value="Login Now" class="btn">
                    <p>Don't have an account? <a href="../view/register.php">Register now</a></p>
        </form>
    </div>


                

                 <!--//////////////-->
               </div>
              </div>
            </div>
          </div>
      </div>
  </section>
 
    
 
  

</body>
</html>
