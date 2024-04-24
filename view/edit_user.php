 


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>

    <!-- Favicon -->
    <link href="imgD/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="../libD/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../libD/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../cssD/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../cssD/style.css" rel="stylesheet">
    
</head>
<body>

<div class="container-fluid position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>

                 

            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <a href="../index-.php" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>EduTechHub
                    </h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="imgD/user.jpg" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">Jhon Doe</h6>
                        <span>Admin</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="../index-.php" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Elements</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="buttonD.html" class="dropdown-item">Buttons</a>
                            <a href="typographyD.html" class="dropdown-item">Typography</a>
                            <a href="elementD.html" class="dropdown-item">Other Elements</a>
                        </div>
                    </div>
                    <a href="widgetD.html" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Widgets</a>
                    <a href="formD.html" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>Forms</a>
                    <a href="tableD.html" class="nav-item nav-link active"><i class="fa fa-table me-2"></i>Tables</a>
                    <a href="chartD.html" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Charts</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="far fa-file-alt me-2"></i>Pages</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="signinD.html" class="dropdown-item">Sign In</a>
                            <a href="signupD.html" class="dropdown-item">Sign Up</a>
                            <a href="404D.html" class="dropdown-item">404 Error</a>
                            <a href="blankD.html" class="dropdown-item">Blank Page</a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->

        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                <a href="../index-.php" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <form class="d-none d-md-flex ms-4">
                    <input class="form-control border-0" type="search" placeholder="Search">
                </form>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-envelope me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Message</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="imgD/user.jpg" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="imgD/user.jpg" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="imgD/user.jpg" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">See all message</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-bell me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Notificatin</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Profile updated</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">New user added</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Password changed</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">See all notifications</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="imgD/user.jpg" alt="" style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex">John Doe</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">My Profile</a>
                            <a href="#" class="dropdown-item">Settings</a>
                            <a href="#" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->


       <!-- hello wprd -->  
        
        <!-- N  ///////////////////////////////////////////////-->
        <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }
        h2 {
            color: #333;
        }
        form {
            margin-top: 20px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"],
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        input[type="file"] {
            margin-top: 5px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        select {
            width: calc(100% - 22px);
            padding: 10px;
        }
    </style>


<div class="container">
<?php
ob_start() ;  
 
require_once '../model/config.php';

// Check    submitted
if (isset($_POST['submit'])) {
     
    $email = $_POST['email']; // Retrieve fr submission
    $name = $_POST['name'];
    $password = $_POST['password'];  
    $id = $_POST['id'];  
    $image = $_FILES['image'];

    // Hash
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    try {
         
        $pdo = config::getConnexion();

        // Check up
        if (!empty($image['name'])) {
             
            $target_dir = "uploaded_img/";

            
            $timestamp = time();
            $image_name = $timestamp . '_' . basename($image['name']);  
            $target_file = $target_dir . $image_name;

            // Move up 
            move_uploaded_file($image['tmp_name'], $target_file);

            // Update use
            $stmt = $pdo->prepare("UPDATE users SET name = :name, password = :password, id = :id, image = :image WHERE email = :email");
            $stmt->execute([':name' => $name, ':password' => $hashed_password, ':id' => $id, ':image' => "uploaded_img/" . $image_name, ':email' => $email]);
        } else {
             
            $stmt = $pdo->prepare("UPDATE users SET name = :name, password = :password, id = :id WHERE email = :email");
            $stmt->execute([':name' => $name, ':password' => $hashed_password, ':id' => $id, ':email' => $email]);
        }
   
        // Redirect 
        header('Location:  ../read_data.php');
        exit(); 

    } catch(PDOException $e) {
        echo "<p>Error: " . $e->getMessage() . "</p>";
    } catch(Exception $e) {
        echo "<p>Error: " . $e->getMessage() . "</p>";
    }
} else {
    // Check email URL
    if (!isset($_GET['email']) || empty($_GET['email'])) {
        echo "<p>User email not provided</p>";
        exit();
    }

    // Get  email   URL
    $email = $_GET['email'];

    try {
         
        $pdo = config::getConnexion();

        // fetch user d 
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

          
        if (!$user) {
            echo "<p>User not found not exit</p>";
            exit();
        }

        // Display  image
        if (!empty($user['image'])) {
            echo "<img src='../" . $user['image'] . "' alt='" . $user['name'] . "' style='max-width: 100%;'><br>";
        }

        // Display 
        echo "<h2>Edit User</h2>";
        echo "<form action='edit_user.php' method='POST' enctype='multipart/form-data'>"; // 
        echo "<input type='hidden' name='email' value='" . $user['email'] . "'>"; //  email hidden  
        echo "Name: <input type='text' name='name' value='" . $user['name'] . "'><br>";
        echo "Password: <input type='password' name='password' value=''><br>";
        echo "Image: <input type='file' name='image'><br>";
        echo "Role: <select name='id'>";
        echo "<option value='1' " . ($user['id'] == 1 ? 'selected' : '') . ">Admin</option>";
        echo "<option value='2' " . ($user['id'] == 2 ? 'selected' : '') . ">Teacher</option>";
        echo "<option value='3' " . ($user['id'] == 3 ? 'selected' : '') . ">Student</option>";
        echo "</select><br>";
        echo "<input type='submit' name='submit' value='Update'>";
        echo "</form>";

    } catch(PDOException $e) 
     {
        echo "<p>Error: " . $e->getMessage() . "</p>";
    }
}
ob_end_flush(); 
?>

</div>



     <!--//////////////////////////////-->
</div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="libD/chart/chart.min.js"></script>
    <script src="libD/easing/easing.min.js"></script>
    <script src="libD/waypoints/waypoints.min.js"></script>
    <script src="libD/owlcarousel/owl.carousel.min.js"></script>
    <script src="libD/tempusdominus/js/moment.min.js"></script>
    <script src="libD/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="libD/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="../jsD/main.js"></script>
</body>
</html>













 
