<?php
require_once '../Controller/TestController.php';
$controller = new TestController();
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $testId = $_POST['test_id'];
    $quizTitle = $_POST['quiz_title'];
    $questions = $_POST['questions'] ?? [];
    $coursIds = $_POST['cours'] ?? [];


    // Vérifier si le titre du test a au moins 3 caractères
    if (strlen($quizTitle) < 3) {
        $message = "Le titre du test doit avoir au moins 3 caractères.";
    } else {
        // Vérifier si au moins une question est sélectionnée
        if (empty($questions)) {
            $message = "Veuillez sélectionner au moins une question.";
        } else {
            // Vérifier si au moins un cours est sélectionné
            if (empty($coursIds)) {
                $message = "Veuillez sélectionner au moins un cours.";
            } else {
                // Si toutes les validations sont passées, mettre à jour le test
                $controller->updateTest($testId, $quizTitle, $questions, $coursIds);
                $message = "Test modifié avec succès.";
            }
        }
    }
}

if (isset($_GET['test_id'])) {
    $test = $controller->getTestDetails($_GET['test_id']);
    if (!$test) {
        echo "Test not found.";
        exit;
    }
    $allQuestions = $controller->getAllQuestions();
    $allCours = $controller->getAllCours();
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un Test</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        h1 {
            margin: 20px 0;
        }

        form {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            width: 80%;
            max-width: 500px;
        }

        label {
            margin-top: 10px;
        }

        input[type="text"], select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            box-sizing: border-box;
        }

        input[type="submit"],
        a.button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            margin-top: 20px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }

        input[type="submit"]:hover,
        a.button:hover {
            background-color: #45a049;
        }

        .error-message {
            color: red;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <h1>Modifier un Test</h1>
    <form id="testForm" method="POST" action="">
        <input type="hidden" name="test_id" value="<?= htmlspecialchars($test->getIdTest()) ?>">
        <label for="quiz_title">Titre du Test (minimum 3 caractères):</label>
        <input type="text" id="quiz_title" name="quiz_title" value="<?= htmlspecialchars($test->getQuizTitle()) ?>"><br>
        <span id="titleError" class="error-message"></span>
        <label>Sélectionner les questions (au moins une sélection):</label>
        <?php foreach ($allQuestions as $question) { ?>
            <div>
                <input type='checkbox' name='questions[]' value='<?= $question['id_question'] ?>' <?= in_array($question['id_question'], array_column($test->getQuestions(), 'id_question')) ? 'checked' : '' ?>>
                <?= htmlspecialchars($question['quiz_title']) ?>
            </div>
        <?php } ?>
        <span id="questionsError" class="error-message"></span>
        <label>Sélectionner les cours (au moins une sélection):</label><br>
        <?php if (!empty($allCours)) { ?>
            <?php foreach ($allCours as $cours) { ?>
                <div>
                    <input type='checkbox' name='cours[]' value='<?= $cours['id_cours'] ?>' <?= in_array($cours['id_cours'], $test->getCours()) ? 'checked' : '' ?>>
                    <?= htmlspecialchars($cours['titre']) ?>
                </div>
            <?php } ?>
        <?php } else { ?>
            <p>Aucun cours disponible.</p>
        <?php } ?>
        <span id="coursError" class="error-message"></span>
        <br>
        <input type="submit" value="Modifier le Test" class="button">
        <!-- Bouton pour retourner à testD.php -->
        <a href="../2nd_project-EduTechHub/testD.php" class="button">Retourner aux Tests</a>
    </form>
    <div id="message">
        <?php if ($message) echo "<p>$message</p>"; ?>
    </div>

    <script>
        document.getElementById('testForm').addEventListener('submit', function(event) {
            var quizTitle = document.getElementById('quiz_title').value.trim();
            var titleError = document.getElementById('titleError');
            var questionsChecked = document.querySelectorAll('input[name="questions[]"]:checked').length > 0;
            var questionsError = document.getElementById('questionsError');
            var coursChecked = document.querySelectorAll('input[name="cours[]"]:checked').length > 0;
            var coursError = document.getElementById('coursError');

            if (quizTitle.length < 3) {
                titleError.textContent = "Le titre du test doit avoir au moins 3 caractères.";
                event.preventDefault();
            } else {
                titleError.textContent = "";
            }

            if (!questionsChecked) {
                questionsError.textContent = "Veuillez sélectionner au moins une question.";
                event.preventDefault();
            } else {
                questionsError.textContent = "";
            }

            if (!coursChecked) {
                coursError.textContent = "Veuillez sélectionner au moins un cours.";
                event.preventDefault();
            } else {
                coursError.textContent = "";
            }
        });
    </script>
</body>
</html>
