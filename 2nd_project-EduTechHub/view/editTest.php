<?php
require_once '../Controller/TestController.php';
$controller = new TestController();
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $testId = $_POST['test_id'];
    $quizTitle = $_POST['quiz_title'];
    $questions = $_POST['questions'] ?? [];

    if (!empty($quizTitle) && !empty($questions)) {
        $controller->updateTest($testId, $quizTitle, $questions);
        $message = "Test modifié avec succès.";
    } else {
        $message = "Veuillez remplir tous les champs requis et sélectionner au moins une question.";
    }
}

if (isset($_GET['test_id'])) {
    $test = $controller->getTestDetails($_GET['test_id']);
    if (!$test) {
        echo "Test not found.";
        exit;
    }
    $allQuestions = $controller->getAllQuestions();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un Test</title>
</head>
<style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: white;
            color: black;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        h1 {
            text-align: center;
            color: teal; /* Blue-green color */
            margin-bottom: 20px;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background-color: silver; /* Silver color */
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: black;
        }

        input[type="submit"] {
            background-color: teal; /* Blue-green color */
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #007BFF; /* Darker blue color */
        }

        button {
            background-color: teal;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #007BFF;
        }
        a.button {
            background-color: teal;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }   

         a.button:hover {
             background-color: #007BFF;
        }
        
    </style>
<body>
    <h1>Modifier un Test</h1>
    <form method="POST" action="">
        <input type="hidden" name="test_id" value="<?= htmlspecialchars($test->getIdTest()) ?>">
        <label for="quiz_title">Titre du Test:</label>
        <input type="text" id="quiz_title" name="quiz_title" value="<?= htmlspecialchars($test->getQuizTitle()) ?>"><br>
        <label>Sélectionner les questions:</label>
        <?php foreach ($allQuestions as $question) { ?>
            <div>
                <input type='checkbox' name='questions[]' value='<?= $question['id_question'] ?>' <?= in_array($question['id_question'], array_column($test->getQuestions(), 'id_question')) ? 'checked' : '' ?>>
                <?= htmlspecialchars($question['quiz_title']) ?> <!-- Assurez-vous que c'est 'question_text' et non 'quiz_title' ici -->
            </div>
        <?php } ?>
        <br>
        <input type="submit" value="Modifier le Test">
        <!-- Bouton pour retourner à testD.php -->
        <a href="../2nd_project-EduTechHub/testD.php" class="button">Retourner aux Tests</a>
    </form>
    <?php if ($message) echo "<p>$message</p>"; ?>
</body>
    <?php if ($message) echo "<p>$message</p>"; ?>
    <script>
        // Validation de saisie en JavaScript pour le champ de titre du test
        document.getElementById('createForm').addEventListener('submit', function(event) {
            var quizTitle = document.getElementById('quiz_title').value.trim();
            if (quizTitle.length === 0) {
                alert('Veuillez saisir un titre pour le test.');
                event.preventDefault();
            }
        });
    </script>
</body>
</html>
