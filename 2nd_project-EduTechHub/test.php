<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="image/x-icon" href="logo.ico" />
    <title>Choisir un Test</title>  
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-edu-meeting.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/lightbox.css">
</head>

<body>
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <a href="../view/index-.php" class="logo">EduTechHub</a>
                        <ul class="nav">
                            <li><a href="../view/index-.php">Home</a></li>
                            <li><a href="meetings.html">Meetings</a></li>
                            <li><a href="../view/index-.php" class="active">Test</a></li>
                            <li><a href="contact.html">Contact Us</a></li>
                        </ul>
                        <a class='menu-trigger'><span>Menu</span></a>
                    </nav>
                </div>
            </div>
        </div>
    </header>

    <section class="heading-page header-text" id="top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Passer un Test</h2>
                </div>
            </div>
        </div>
    </section>

    <section class="container mt-5 mb-5">
        <div class="row">
            <div class="col-lg-12">
                <?php
                // Determine which part of the test process to display
                $action = $_GET['action'] ?? 'takeTest'; // Default to showing takeTest
                switch ($action) {
                    case 'startTest':
                        include('../view/startTest.php');
                        break;
                    default:
                        include('../view/takeTest.php');
                        break;
                }
                ?>
            </div>
        </div>
    </section>

    <div class="footer">
        <p>&copy; 2022 EduTechHub Co., Ltd. All Rights Reserved.<br>
        Design: <a href="https://templatemo.com" target="_parent" title="website templates">TemplateMo</a></p>
    </div>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/custom.js"></script>
</body>
</html>
