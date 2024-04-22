<?php

include_once '../controller/RegisterController.php';

// Create instance of RegisterController
$registerController = new RegisterController();
// Call register method to handle form submission
$message = $registerController->register();

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Register</title>
   
   
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
               


                <!--register-->
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
                         function validateForm() {
                        var email = document.forms["registerForm"]["email"].value;
                        var password = document.forms["registerForm"]["password"].value;
                        var cpassword = document.forms["registerForm"]["cpassword"].value;
                        var name = document.forms["registerForm"]["name"].value;
                        
                        if (email == "" || password == "" || cpassword=="" || name==""  ) {
                            alert("Veuillez remplir tous les champs requis!");
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
                    <form name="registerForm" action="" enctype="multipart/form-data" method="post" onsubmit="return validateForm()">
                       <h3>Register Now</h3>
                       <?php
                       if(isset($message)){
                          echo '<div class="message">'.htmlspecialchars($message).'</div>';
                       }
                       ?>
                       <input type="text" name="name" placeholder="Enter username" class="box" >
                       <input type="text" name="email" placeholder="Enter email" class="box" >
                       <input type="password" name="password" placeholder="Enter password (minimum 8 characters)" class="box" >
                       <input type="password" name="cpassword" placeholder="Confirm password" class="box" >
                       <select name="role" class="box" id="roleSelect" required>
                          <option value="student">select a choice or will be student by default </option>
                          <option value="admin">Admin</option>
                          <option value="teacher">Teacher</option>
                          <option value="student">Student</option>
                       </select>
                       <input type="text" name="code" placeholder="Enter code" class="box" id="codeInput" style="display: none;"> 
                       <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png">
                       <input type="submit" name="submit" value="Register Now" class="btn">
                       <p>Already have an account? <a href="../view/login.php">Login now</a></p>
                    </form>
                 </div>
                 
                 <script>
                 document.getElementById('roleSelect').addEventListener('change', function() {
                     var role = this.value;
                     var codeInput = document.getElementById('codeInput');
                     if (role === 'admin') {
                         codeInput.style.display = 'block';
                     } else {
                         codeInput.style.display = 'none';
                     }
                 });
                 
                 document.getElementById('registrationForm').addEventListener('submit', function(event) {
                     var role = document.getElementById('roleSelect').value;
                     var pass = document.getElementsByName('password')[0].value;
                     if (role === 'admin' && pass.length < 8) {
                         alert('Password must be at least 8 characters long!');
                         event.preventDefault(); // Prevent form submission
                     }
                 });
                 
                 
                 </script>

                 <!--//////////////-->
               </div>
              </div>
            </div>
          </div>
      </div>
  </section>
  <!-- ***** Main Banner Area End ***** -->
    
 
  

</body>
</html>
