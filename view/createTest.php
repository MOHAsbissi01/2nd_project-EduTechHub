<?php
require_once '../Controller/TestController.php';
$controller = new TestController();
$message = '';
$allQuestions = $controller->getAllQuestions();
$allCours = $controller->getAllCours(); // Récupérer tous les cours

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $quizTitle = $_POST['quiz_title'];
    $questions = $_POST['questions'] ?? [];
    $cours = $_POST['cours'] ?? []; // Récupérer les cours sélectionnés

    if (!empty($quizTitle) && !empty($questions) && !empty($cours)) {
        $controller->createTestWithCours($quizTitle, $questions, $cours); // Méthode modifiée pour gérer les cours
        $message = "Test créé avec succès avec des cours associés.";
    } else {
        $message = "Veuillez remplir tous les champs requis et sélectionner au moins une question et un cours.";
    }
}

$allQuestions = $controller->getAllQuestions();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Créer un Test</title>
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
            background-color: #dedede;
        }

        header {
            background-color: #fffcfc;
            padding: 20px;
            text-align: center;
            width: 100%;
        }

        header img {
            background-color: transparent;
            border-radius: 50%;
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
        }

        form {
            width: 90%;
            margin: 20px auto;
            padding: 20px;
            background-color: #edf0f5;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #333;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #4a90e2;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 30px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s, transform 0.2s;
        }

        input[type="submit"]:hover {
            background-color: #357ebd;
            transform: scale(1.05);
        }

        .error_message {
            color: red;
            font-size: 12px;
            margin-bottom: 10px;
        }

        .success_message {
            color: green;
            font-size: 16px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <header>
        <img src="../assets/logo.png" alt="Logo" width="150" height="150">
    </header>
    <h1>Créer un Test</h1>
    <?php if (!empty($message)): ?>
        <div class="success_message"><?= $message ?></div>
    <?php endif; ?>
    <form id="testForm" method="POST">
        <label for="quiz_title">Titre du Test:</label>
        <input type="text" id="quiz_title" name="quiz_title">
        <div id="error_quiz_title" class="error_message"></div>

        <label>Sélectionner les questions:</label>
        <?php foreach ($allQuestions as $question) { ?>
            <div>
                <input type='checkbox' name='questions[]' value='<?= $question['id_question'] ?>'>
                <?= htmlspecialchars($question['quiz_title']) ?>
            </div>
        <?php } ?>
        <div id="error_questions" class="error_message"></div>

        <label>Sélectionner les cours:</label>
        <?php foreach ($allCours as $cours) { ?>
            <div>
                <input type='checkbox' name='cours[]' value='<?= $cours['id_cours'] ?>'>
                <?= htmlspecialchars($cours['titre']) ?>
            </div>
        <?php } ?>
        <div id="error_cours" class="error_message"></div>

        <input type="submit" value="Créer le Test">
    </form>
    <script>
        document.getElementById('testForm').onsubmit = function(event) {
            var quizTitle = document.getElementById('quiz_title').value;
            var questions = document.querySelectorAll('input[name="questions[]"]:checked');
            var cours = document.querySelectorAll('input[name="cours[]"]:checked');
            var errorTitle = document.getElementById('error_quiz_title');
            var errorQuestions = document.getElementById('error_questions');
            var errorCours = document.getElementById('error_cours');

            // Clear previous errors
            errorTitle.textContent = '';
            errorQuestions.textContent = '';
            errorCours.textContent = '';

            // Validate fields
            if (quizTitle.length < 3) {
                errorTitle.textContent = 'Le titre du test doit contenir au moins 3 caractères.';
                event.preventDefault();
            }

            if (questions.length === 0) {
                errorQuestions.textContent = 'Au moins une question doit être sélectionnée.';
                event.preventDefault();
            }

            if (cours.length === 0) {
                errorCours.textContent = 'Au moins un cours doit être sélectionné.';
                event.preventDefault();
            }
        };
    </script>
</body>
</html>