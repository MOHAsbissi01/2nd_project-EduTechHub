<?php
require_once '../Controller/TestController.php';
$controller = new TestController();

// Vérifier si l'ID du test et le nom d'utilisateur sont passés
if (empty($_POST['test_id']) || empty($_POST['email'])) {
    echo "Informations nécessaires pour démarrer le test manquantes.";
    exit;
}

$testId = $_POST['test_id'];
$email = $_POST['email'];
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
    <link rel="shortcut icon" type="image/x-icon" href="logo.ico" />
    <title>Passer un Test</title>
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
                        <a href="index.html" class="logo">EduTechHub</a>
                        <ul class="nav">
                            <li><a href="index.html">Home</a></li>
                            <li><a href="meetings.html">Meetings</a></li>
                            <li><a href="index.php" class="active">Test</a></li>
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
                    <h2>Répondre au Test</h2>
                </div>
            </div>
        </div>
    </section>

    <section class="container mt-5 mb-5">
    <h1><?= htmlspecialchars($testDetails->getQuizTitle()) ?></h1>
    <p>Cours associés: <?= htmlspecialchars($testDetails->getCours()) ?></p>

        <form id="testForm" action="submitTest.php" method="POST">
    <input type="hidden" name="test_id" value="<?= htmlspecialchars($testId) ?>">
    <input type="hidden" name="email" value="<?= htmlspecialchars($email) ?>">
    <?php foreach ($questions as $question): ?>
    <div class="question">
        <p>Question: <?= isset($question['question_text']) ? htmlspecialchars($question['question_text']) : 'Question manquante' ?></p>
        <div>Options:</div>
        <ul>
            <?php for ($i = 1; $i <= 3; $i++): 
                $option = 'option_' . $i;
                if (isset($question[$option])): ?>
            <li><input type="radio" name="response[<?= htmlspecialchars($question['question_id']) ?>]" value="<?= htmlspecialchars($question[$option]) ?>"> <?= htmlspecialchars($question[$option]) ?></li>
            <?php else: echo "<li>Option $i manquante</li>"; endif;
            endfor; ?>
        </ul>
    </div>
    <?php endforeach; ?>
    <button type="button" onclick="submitForm()" class="btn btn-primary">Soumettre les réponses</button>
</form>

    </section>

    <div class="footer">
        <p>&copy; 2022 EduTechHub Co., Ltd. All Rights Reserved.<br>
        Design: <a href="https://templatemo.com" target="_parent" title="website templates">TemplateMo</a></p>
    </div>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/custom.js"></script>
    <script>
        function submitForm() {
            var questions = document.querySelectorAll('.question');
            for (var i = 0; i < questions.length; i++) {
                var inputs = questions[i].getElementsByTagName('input');
                var checked = false;
                for (var j = 0; j < inputs.length; j++) {
                    if (inputs[j].type === 'radio' && inputs[j].checked) {
                        checked = true;
                        break;
                    }
                }
                if (!checked) {
                    alert('Veuillez répondre à toutes les questions avant de soumettre.');
                    return false;
                }
            }
            document.getElementById('testForm').submit();
        }
    </script>
</body>
</html>