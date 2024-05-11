<!-- verification.php -->
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


   <section class="section main-banner" id="top" data-section="section1">
      <video autoplay muted loop id="bg-video">
          <source src="../assets/images/course-video.mp4" type="video/mp4" />
      </video>

      <div class="video-overlay header-text">
          <div class="container">
            <div class="row">
              <div class="col-lg-12">
                <div class="caption">

    <?php
    require_once '../model/config.php';

    // Retrieve email from URL parameter
    $email = $_GET['email'];

    // Validate the email (you can add more validation checks)
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format. Please enter a valid email address.";
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Handle form submission for verifying the entered code
        $enteredCode = $_POST['verification_code'];

        // Retrieve the user's reset token from the database
        $pdo = config::getConnexion();
        $stmt = $pdo->prepare("SELECT reset_token FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();

        if ($user) {
            // Compare the entered code with the stored reset token
            $storedResetToken = $user['reset_token'];

            if ($enteredCode == $storedResetToken) {
                echo "Verification successful! You can now reset your password.";
                header("Location: reset.php?email=$email");
                exit;
                // Display the password reset form here
            } else {
                echo "Incorrect verification code. Please try again.";
                
            }
        } else {
            echo "Email not found. Please enter a registered email address.";
        }
    }
    ?>

    <h1>Verify Code</h1>
    <form method="post">
        <label for="verification_code">Enter verification code:</label>
        <input type="text" id="verification_code" name="verification_code" required>
        <button type="submit">Verify Code</button>
    </form>
  
                </div>
                </div>
                </div>
                </div>
                </div>
   </section>


</body>
</html>
