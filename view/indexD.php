<!DOCTYPE html>
<html lang="en">

<head>
<link rel="shortcut icon" type="image/x-icon" href="../logo.ico" />

    <meta charset="utf-8">
    <title> Dashboard</title>
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
                <a href="index-.php" class="navbar-brand mx-4 mb-3">
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
                    <a href="indexD.html" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                     
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-key me-2"></i>Questions Quizz</a>
                        <div class="../2nd_project-EduTechHub/dropdown-menu bg-transparent border-0">
                            <a href="../2nd_project-EduTechHub/dshb-quiz.php" class="dropdown-item">Créer</a>
                            <a href="../2nd_project-EduTechHub/dshb-bookmarks.php" class="dropdown-item">Liste</a>
                        </div>
                    </div>
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="far fa-file-alt me-2"></i>Events Management</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="addEvent.php" class="dropdown-item">Add Event</a>
                            <a href="eventslist.php" class="dropdown-item">Events List</a>
                            <a href="stat.php" class="dropdown-item">Events Stats</a>
                        </div>

                    <a href="rapportD.php" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>rapport PDF</a>
                    <a href="tableD.php" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Tables: edit </a>
                    <a href="chartD.php" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Charts</a>
                    <a href="../2nd_project-EduTechHub/listeD.php" class="nav-item nav-link"><i class="fa fa-book me-2"></i>Documents</a>
                    <a href="../2nd_project-EduTechHub/testD.php" class="nav-item nav-link"><i class="fa fa-clipboard me-2"></i>Test/Quizz</a>
                    <a href="../2nd_project-EduTechHub/listeResD.php" class="nav-item nav-link"><i class="fa fa-dice me-2"></i>Résultats</a>
                    <a href="Back Office\Reclamation.php" class="nav-item nav-link"><i class="fa fa-dice me-2"></i>Reclamtion</a>
                    <a href="Back Office\Reponse.php" class="nav-item nav-link"><i class="fa fa-dice me-2"></i>Reponse</a>
                     

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
                
            </nav>

             
            <!-- Navbar End -->

             <!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->


             <style>
                body {
                    margin: 0;
                    padding: 0;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 100vh;
                    background-color: #f0f0f0;
                }
        
                .container {
                    text-align: center;
                    background-color: #fff;
                    padding: 20px;
                    border-radius: 8px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                }
        
                p {
                    margin-bottom: 20px;
                }
        
                button {
                    background-color: #ff0000;
                    color: #fff;
                    border: none;
                    padding: 10px 20px;
                    border-radius: 5px;
                    cursor: pointer;
                    transition: background-color 0.3s;
                }
        
                button:hover {
                    background-color: #cc0000;
                }


         /*IMAGE LOGO */
                .center {
                    display: block;
                    margin-left: auto;
                    margin-right: auto;
                    width: 20%;
                    border-radius: 50%
                    /*smaller 50%*/ 
                    
            
                }
                .MastHead {
                    background-image: url('logo.png');
                    background-position: top;
                    /* Other styling properties for the header */
                }


            </style>

             
                     
       
 
             <div class="MastHead">
              
             <img src="../uploaded_img/logo.png" alt="Logo" class="center">
               </div>
    
            <!-- Widgets Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-md-6 col-xl-4">
                         
                    </div>
                    <div class="col-sm-12 col-md-6 col-xl-4">
                        <div class="h-100 bg-light rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0">Calender</h6>
                                <a href="">Show All</a>
                            </div>
                            <div id="calender"></div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-xl-4">
                         
                    </div>
                </div>
            </div>
            <!-- Widgets End -->

 
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