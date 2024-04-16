<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>EduTechHub - Bootstrap Admin Template</title>
    <!-- Include necessary CSS files -->
  
    <link rel="stylesheet" type="text/css" href="../cssD/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../cssD/style.css" >
</head>
<body>
    <!-- Signup Form -->
    <div class="container-fluid">
        <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
            <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <a href="edu/index.php" class="">
                            <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>EduTechHub</h3>
                        </a>
                        <h3>Sign Up</h3>
                    </div>
                    <?php
                    // Check if the form is submitted
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        // Retrieve form data
                        $username = $_POST["username"];
                        $email = $_POST["email"];
                        $password = $_POST["password"];

                        // Validate form data
                        if (empty($username) || empty($email) || empty($password)) {
                            $errorMessage = "Please fill in all fields.";
                        } else {
                            // Show success message
                            $successMessage = "You have successfully registered!";
                        }
                    }
                    ?>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="username" id="floatingText" placeholder="jhondoe">
                            <label for="floatingText">Username</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" name="email" id="floatingInput" placeholder="name@example.com">
                            <label for="floatingInput">Email address</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password">
                            <label for="floatingPassword">Password</label>
                        </div>
                        <?php if (isset($errorMessage)) { ?>
                            <p class="text-center text-danger"><?php echo $errorMessage; ?></p>
                        <?php } elseif (isset($successMessage)) { ?>
                            <p class="text-center text-success"><?php echo $successMessage; ?></p>
                        <?php } ?>
                        <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Sign Up</button>
                    </form>
                    <p class="text-center mb-0"> 
                        <div class="nav">
                            Already have an account? <a href="signin.php">Sign In</a>
                        </div>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Include necessary JavaScript files -->
    ...
</body>
</html>
