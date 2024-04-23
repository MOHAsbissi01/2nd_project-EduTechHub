<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>EduTechHub - Bootstrap Admin Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="../imgD/favicon.ico" rel="icon">

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
                <a href="../index.php" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>EduTechHub</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="../imgD/user.jpg" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">Jhon Doe</h6>
                        <span>Admin</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="../indexD.php" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <a href="../widgetD.php" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Widgets</a>
                    <a href="menu.php" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>Event Management</a>
                    <a href="../tableD.php" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Tables</a>
                    <a href="../chartD.php" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Charts</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="far fa-file-alt me-2"></i>Pages</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="../signinD.php" class="dropdown-item">Sign In</a>
                            <a href="../signupD.php" class="dropdown-item">Sign Up</a>
                            <a href="../404D.php" class="dropdown-item">404 Error</a>
                            <a href="../blankD.php" class="dropdown-item">Blank Page</a>
                            <a href="../indexD.php" class="dropdown-item">USER INTERFACE</a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->
        <div class="content">
            <div class="container mt-5">
                <h1 class="text-center">Events Management Menu</h1>
                <div class="row justify-content-center mt-4">
                    <div class="col-md-6 text-center">
                        <div class="container mb-3">
                            <a href="addEvent.php" class="btn btn-primary btn-lg btn-block">Add Event</a>
                        </div>
                        <div class="container mb-3">
                            <a href="eventslist.php" class="btn btn-secondary btn-lg btn-block">Events List</a>
                        </div>
                        <div class="container">
                            <a href="../indexD.php" class="btn btn-danger btn-lg btn-block">Return</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../libD/chart/chart.min.js"></script>
    <script src="../libD/easing/easing.min.js"></script>
    <script src="../libD/waypoints/waypoints.min.js"></script>
    <script src="../libD/owlcarousel/owl.carousel.min.js"></script>
    <script src="../libD/tempusdominus/js/moment.min.js"></script>
    <script src="../libD/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="../libD/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="../jsD/main.js"></script>
</body>

</html>
