<?php
require_once '../Controller/TestController.php';
$controller = new TestController();

// Vérifier si l'ID du test et le nom d'utilisateur sont passés
if (empty($_POST['test_id']) || empty($_POST['username'])) {
    echo "Informations nécessaires pour démarrer le test manquantes.";
    exit;
}

$testId = $_POST['test_id'];
$username = $_POST['username'];
$testDetails = $controller->getTestDetails($testId);
$questions = $controller->getQuestionsForTest($testId);

if (!$testDetails) {
    echo "Le test demandé n'existe pas.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Démarrer le Test - EduTechHub</title>
    <!-- Assurez-vous que les chemins vers vos fichiers CSS sont corrects -->
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
                        <!-- Logo -->
                        <a href="index.html" class="logo">
                            EduTechHub
                        </a>
                        <!-- Nav -->
                        <ul class="nav">
                            <li><a href="index.html">Home</a></li>
                            <li><a href="meetings.html">Meetings</a></li>
                            <li><a href="index.php" class="active">Test</a></li>
                            <li><a href="contact.html">Contact Us</a></li>
                        </ul>
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                    </nav>
                </div>
            </div>
        </div>
    </header>

    <section class="container mt-5 mb-5">
        <div class="row">
            <div class="col-lg-12">
                <?php
                require_once '../Controller/TestController.php';
                $controller = new TestController();

                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['response'], $_POST['test_id'], $_POST['username'])) {
                    $responses = $_POST['response'];
                    $testId = $_POST['test_id'];
                    $username = $_POST['username'];

                    $score = $controller->evaluateTest($testId, $username, $responses);

                    echo "<h2>Merci, $username. Votre score est : $score</h2>";
                    // Enregistrer le score dans la base de données si nécessaire
                } else {
                    echo "<h2>Aucune réponse soumise.</h2>";
                }
                ?>
                <div>
                    <a href="../2nd_project-EduTechHub/index.php" class="btn btn-primary mt-3">Retour à l'accueil</a>
                </div>
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
