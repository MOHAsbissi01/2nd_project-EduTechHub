<?php session_start(); 
require_once '../config.php';
/*include "../controller/ImageC.php";*/
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link rel="shortcut icon" type="image/x-icon" href="logo.ico" />
    <title>Liste Questions</title>    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

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
    <link href="libD/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="libD/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="cssD/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="cssD/style.css" rel="stylesheet">
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
                <a href="index.html" class="navbar-brand mx-4 mb-3">
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
                    <a href="../view/indexD.php" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                     
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->
        <!-- Content Start -->
        <div class="content">
            <!-- Navbar -->
            <!-- Votre code de navbar ici -->
            <div class="dashboard__main">
            <div class="dashboard__content bg-light-4">
              <div class="row pb-50 mb-10">
                <div class="col-auto">

                  <h1 class="text-30 lh-12 fw-700">List of quizzes</h1>
                  

                </div>
              </div>


              <div class="row y-gap-30">
                <div class="col-12">
                  <div class="rounded-16 bg-white -dark-bg-dark-1 shadow-4 h-100">
                    <div class="d-flex items-center py-20 px-30 border-bottom-light">
                      <h2 class="text-17 lh-1 fw-500">Disponible quizzes</h2>
                    </div>

                    <div class="py-30 px-30">
    <?php
    require_once '../config.php';

    // Create a database connection
    $db = config::getConnexion();

    // Fetch the questions from the database
    $sql = "SELECT * FROM question";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Display the questions if there are any
    if (!empty($questions)) {
        foreach ($questions as $question) {
            echo '<div class="question-block">';
            echo '<div class="question-details">';
            echo '<p>Quizz Title: ' . $question['quiz_title'] . '</p>';
            echo '<p>Question Text: ' . $question['question_text'] . '</p>';
            echo '<p>Option 1: ' . $question['option_1'] . '</p>';
            echo '<p>Option 2: ' . $question['option_2'] . '</p>';
            echo '<p>Option 3: ' . $question['option_3'] . '</p>';
            echo '<p>Correct Option: ' . $question['correct_option'] . '</p>';
            echo "<form method='post' action='../View/deleteQuestion.php' onsubmit='return confirmDelete(\"" . htmlspecialchars($question['id_question']) . "\")'>";
            echo "<input type='hidden' name='id' value='" . htmlspecialchars($question['id_question']) . "'>";
            echo "<button type='submit' name='delete'>Supprimer</button>";
            echo '</div>';

            echo '<div class="question-actions">';
            echo '<a href="#" class="icon icon-edit mr-5"></a>';
            echo '<a href="#" class="icon icon-bin" onclick="deleteQuestion(' . $question['id_question'] . ')"></a>';
            echo "</form>";
            echo "<form method='get' action='../View/edit_question.php'>";
            echo "<input type='hidden' name='id' value='" . htmlspecialchars($question['id_question']) . "'>";
            echo "<button type='submit'>Modifier</button>";
            echo "</form>";
            
            echo '</div>';

            echo '</div>';
            echo '<hr>';
        }
    } else {
        echo '<p>No questions found.</p>';
    }
    ?>
</div>
<style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-color: #dedede; /* Couleur de fond légèrement plus claire */
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        table {
            width: 90%; /* Largeur du tableau réduite */
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Ombre légère */
            background-color: #edf0f5; /* Fond blanc */
            border-radius: 8px; /* Coins arrondis */
            overflow: hidden; /* Masquage du contenu qui dépasse */
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #333;
            color: #fff;
            font-weight: bold; /* Texte en gras */
            text-transform: uppercase; /* Majuscules */
        }

        td img {
            max-width: 80px; /* Largeur d'image réduite */
            height: auto;
            border-radius: 4px;
        }

        button {
            background-color: #4a4a4a;
            color: #fff;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-right: 5px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #333;
        }

        .button-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .button-container button {
            margin-bottom: 10px;
        }

        /* Style pour les boutons */
        button {
            background-color: #4a90e2; /* Bleu vif */
            color: #fff;
            padding: 12px 24px;
            border: none;
            border-radius: 30px; /* Coins arrondis */
            cursor: pointer;
            margin: 8px;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s, transform 0.2s;
        }

        button:hover {
            background-color: #357ebd; /* Bleu légèrement plus foncé au survol */
            transform: scale(1.05); /* Légère animation de zoom au survol */
        }

        /* Style pour les filtres */
        .filter-buttons {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .filter-button {
            background-color: #ff7f50; /* Orange vif */
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 20px; /* Coins arrondis */
            cursor: pointer;
            margin: 0 10px;
            font-size: 14px;
            font-weight: bold;
            transition: background-color 0.3s, transform 0.2s;
        }

        .filter-button:hover {
            background-color: #ff6347; /* Orange légèrement plus foncé au survol */
            transform: scale(1.05); /* Légère animation de zoom au survol */
        }
    </style>

<script>
function confirmDelete(id) {
        return confirm("Voulez-vous vraiment supprimer le quizz avec l'ID " + id + " ?");
    }
</script>
                  </div>
                </div>
              </div>
            </div>
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
        <script src="libD/chart/chart.min.js"></script>
        <script src="libD/easing/easing.min.js"></script>
        <script src="libD/waypoints/waypoints.min.js"></script>
        <script src="libD/owlcarousel/owl.carousel.min.js"></script>
        <script src="libD/tempusdominus/js/moment.min.js"></script>
        <script src="libD/tempusdominus/js/moment-timezone.min.js"></script>
        <script src="libD/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

        <!-- Template Javascript -->
        <script src="jsD/main.js"></script>
    </body>

    </html>   