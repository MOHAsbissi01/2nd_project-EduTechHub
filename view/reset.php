

    <!-- forgot.php -->



<!DOCTYPE html>
<html lang="en">
<head>
<link rel="shortcut icon" type="image/x-icon" href="../logo.ico" />
     
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <!-- Google reCAPTCHA -->
   <script src='https://www.google.com/recaptcha/api.js' async defer></script>


   <title>Forget psw</title>
   
   
   <!-- template header -->

 <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="TemplateMo">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900" rel="stylesheet">


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
                      <a href="login.php" class="logo">
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
               
 
     <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
        }
        .form-container {
            background-color: #f0f0f0;
            margin-top: 50px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            color: #fff;
        }
        h1 {
            color: #fff;
        }
        form {
            margin-top: 20px;
        }
        label {
            font-weight: bold;
            color: #fff;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button[type="submit"] {
            background-color: #8b0000; /* Dark red color */
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            height: 40px; /* Lower height for the button */
        }
        button[type="submit"]:hover {
            background-color: #800000; /* Darker shade on hover */
        }
        .main-banner .caption {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            color: #8ddd10;
        }
    
     </style>
     
     <?php
    require_once '../model/config.php';

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $email = $_POST['email']; // Retrieve email from query parameter
        $newPassword = $_POST['password'];

        // Hash the new password
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        try {
            $pdo = config::getConnexion();
            $stmt = $pdo->prepare("UPDATE users SET password = :password WHERE email = :email");
            $stmt->execute(['password' => $hashedPassword, 'email' => $email]);

            // Check if the update was successful
            if ($stmt->rowCount() > 0) {
                echo "Password reset successful! You can now log in with your new password.";
            } else {
                echo "Error updating password. Please try again later.";
            }
        } catch (PDOException $e) {
            echo "Error updating password: " . $e->getMessage();
        }
    }
    ?>

    <h1>Reset Password</h1>
    <form method="post">
        <input type="hidden" name="email" value="<?php echo $_GET['email']; ?>">
        <label for="password">Enter your new password:</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">Reset Password</button>
    </form>



                 <!--//////////////-->
               </div>
              </div>
            </div>
          </div>
          </div>
      </div>
  </section>
 
    
 
  

</body>
</html>
