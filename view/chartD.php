<!DOCTYPE html>
<html lang="en">

<head>
<link rel="shortcut icon" type="image/x-icon" href="../logo.ico" />

    <meta charset="utf-8">
    <title>Chart</title>
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
                <a href="indexD.php" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>EduTechHub</h3>
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
                    <a href="indexD.php" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
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
                    <a href="tableD.html" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Tables</a>
                    <a href="chartD.html" class="nav-item nav-link active"><i class="fa fa-chart-bar me-2"></i>Charts</a>
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
                <a href="indexD.html" class="navbar-brand d-flex d-lg-none me-4">
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

<!--/////////////////////////////////////////////////////////////////--->
<?php
require_once '../model/config.php'; // Include your config.php file

try {
    $pdo = config::getConnexion();
    $stmt = $pdo->prepare("SELECT * FROM users");
    $stmt->execute();

    // Initialize counters for user roles and email domains
    $admins_count = 0;
    $teachers_count = 0;
    $students_count = 0;
    $esprit_count = 0;
    $gmail_count = 0;
    $yahoo_count = 0;

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        switch ($row['id']) { // Assuming the role ID is stored in the 'role_id' column
            case 1:
                $admins_count++;
                break;
            case 2:
                $teachers_count++;
                break;
            case 3:
                $students_count++;
                break;
            // Add more cases for other roles if needed
        }

        // Extract email domain
        $email_parts = explode('@', $row['email']);
        $email_domain = end($email_parts);
        switch ($email_domain) {
            case 'esprit.tn':
                $esprit_count++;
                break;
            case 'gmail.com':
                $gmail_count++;
                break;
            case 'yahoo.com':
                $yahoo_count++;
                break;
            // Add more cases for other email domains if needed
        }
    }

    // Create data arrays for both charts
    $roles_data = [
        ['Role', 'Count'],
        ['Admins', $admins_count],
        ['Teachers', $teachers_count],
        ['Students', $students_count],
    ];

    $email_domain_data = [
        ['Email Domain', 'Count'],
        ['@esprit.tn', $esprit_count],
        ['@gmail.com', $gmail_count],
        ['@yahoo.com', $yahoo_count],
    ];

    // Encode the data as JSON
    $json_roles_data = json_encode($roles_data);
    $json_email_domain_data = json_encode($email_domain_data);

    // Echo the Google Charts API script for both charts
    echo '<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>';
    echo '<script type="text/javascript">';
    echo 'google.charts.load("current", {"packages":["corechart"]});';
    echo 'google.charts.setOnLoadCallback(drawRolesChart);';
    echo 'google.charts.setOnLoadCallback(drawEmailDomainChart);';

    echo 'function drawRolesChart() {';
    echo 'var data = google.visualization.arrayToDataTable('. $json_roles_data. ');';
    echo 'var options = {';
    echo '    title: "User Roles Distribution",';
    echo '    pieHole: 0.4,';
    echo '    pieSliceTextStyle: {color: "white"},';
    echo '    chartArea: {width: "90%", height: "90%"},';
    echo '    legend: {position: "bottom"},';
    echo '    colors: ["#ff9999", "#66b3ff", "#99ff99"],';
    echo '};';
    echo 'var chart = new google.visualization.PieChart(document.getElementById("user_roles_chart"));';
    echo 'chart.draw(data, options);';
    echo '}';

    echo 'function drawEmailDomainChart() {';
    echo 'var data = google.visualization.arrayToDataTable('. $json_email_domain_data. ');';
    echo 'var options = {';
    echo '    title: "Email Domain Distribution",';
    echo '    pieHole: 0.4,';
    echo '    pieSliceTextStyle: {color: "white"},';
    echo '    chartArea: {width: "90%", height: "90%"},';
    echo '    legend: {position: "bottom"},';
    echo '    colors: ["#ffcc99", "#ffcc66", "#ffcc33"],';
    echo '};';
    echo 'var chart = new google.visualization.PieChart(document.getElementById("email_domain_chart"));';
    echo 'chart.draw(data, options);';
    echo '}';
    echo '</script>';
} catch (PDOException $e) {
    echo 'Error: '. $e->getMessage();
}
?>

<!-- Display the pie charts -->
<div id="user_roles_chart" style="width: 600px; height: 400px;"></div>
<div id="email_domain_chart" style="width: 600px; height: 400px;"></div>

<!--/////////////////////////////////////////////////////////////////-->

            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="#">Your Site Name</a>, All Right Reserved. 
                        </div>
                         
                    </div>
                </div>
            </div>
            <!-- Footer End -->
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
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