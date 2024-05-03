<?php
// Start the session
if(session_status() == PHP_SESSION_NONE){
    // session has not started
    session_start();
}

// Include the config file
include_once 'model/config.php';

 
$email = $_SESSION["email"];

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $password = $_POST['password'];
    $image = $_FILES['image']['name'];
    $target = "uploaded_img/".basename($image);

    // Create a prepared statement
    $stmt = config::getConnexion()->prepare("UPDATE users SET name = :name WHERE email = :email");

    // Bind parameters
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);

    // Execute the query
    $stmt->execute();

    // If password field is not empty, update the password
    if (!empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = config::getConnexion()->prepare("UPDATE users SET password = :password WHERE email = :email");
        $stmt->bindParam(':password', $hashed_password);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
    }

    // If image is uploaded, move the image and update the image path in the database
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $stmt = config::getConnexion()->prepare("UPDATE users SET image = :image WHERE email = :email");
        $stmt->bindParam(':image', $target);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

  <head>
  <link rel="shortcut icon" type="image/x-icon" href="logo.ico" />
  <title>Update profile</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Template Mo">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900" rel="stylesheet">

    <title>Edit Your Profile</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-edu-meeting.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/lightbox.css">
 
  </head>

<body>

   

  <!-- Sub Header -->
  <div class="sub-header">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-sm-8">
          <div class="left-content">
            <marquee behavior="scroll" direction="left">
              <p   style="font-weight: bold;">  Hello!  And   Welcome   to   our   education   and   formation   Website   --   <span style="color: red;">EduTechHub</span>   --</p>
            </marquee>
          </div>
        </div>
        <div class="col-lg-4 col-sm-4">
          <div class="right-icons">
            <ul>
              <li><a href="#"><i class="fa fa-facebook"></i></a></li>
              <li><a href="#"><i class="fa fa-twitter"></i></a></li>
              
              <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ***** Header Area Start ***** -->
  <header class="header-area header-sticky">
      <div class="container">
          <div class="row">
              <div class="col-12">
                  <nav class="main-nav">
                      <!-- ***** Logo Start ***** -->
                      <a href="index-3.php" class="logo">
                           EduTechHub
                      </a>
                      <!-- ***** Logo End ***** -->
                      <!-- ***** Menu Start ***** -->
                      <ul class="nav">
                          <li><a href="index-3.php">Home</a></li>
                          <li class="has-sub">  
                         
                      </ul>        
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

  <section class="heading-page header-text" id="top">
    <div class="container">
      <div class="row">
        <div class="col-lg-20">
        <h2> Update Your Profiele   </h2>
          <h6>  name or password or image
          </h6>
         
        </div>
      </div>
    </div>
          </section>

          <section class="meetings-page" id="meetings">
            <div class="container">
              <div class="row">
              <div class="col-lg-12 align-self-center">
                <div class="row">
                  <div class="col-lg-15">
                     <style>
                    .container {
                        margin: 0 auto;
                        width: 100%;
                        padding: 20px;
                        color: #fff;
                    }
                    form {
                        width: 50%;
                        margin: 0 auto;
                    }
                    input[type="text"], input[type="password"] {
                        width: 100%;
                        padding: 10px;
                        margin: 10px 0;
                        color: #000;
                    }
                    input[type="submit"] {
                        width: 100%;
                        padding: 10px;
                        margin: 10px 0;
                        background-color: #333;
                        color: #fff;
                        border: none;
                    }   
                    input[type="file"] {
                        width: 100%;
                        padding: 10px;
                        margin: 10px 0;
                        color: #ffff;
                    }





                     </style>

                    <!-- The HTML form -->
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
                        Name: <input type="text" name="name">
                        Password: <input type="password" name="password">
                        Image: <input type="file" name="image">
                        <input type="submit">
                    </form>


                    </div>
                    </div>
                  </div>
        <div class="col-lg-12">
          <div class="pagination">
            
          </div>
        </div>
      </div>
    </div>
  </section>


</body>
