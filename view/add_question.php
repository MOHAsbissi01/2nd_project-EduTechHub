<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../Model/QuestionModel.php';
require_once '../controller/QuestionController.php';

// Variable pour stocker le message de succès ou d'erreur
$message = '';
$messageType = 'success'; // 'error' pour les erreurs
$isValid = true; // Variable pour valider le formulaire

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Les champs requis
    $requiredFields = ['quiz_title', 'question_text', 'option1', 'option2', 'option3', 'correct_option'];

    // Vérifier si tous les champs requis sont présents et valides dans $_POST
    foreach($requiredFields as $field) {
        if(!isset($_POST[$field]) || empty($_POST[$field])){
            $isValid = false;
            $message = "Le champ '$field' est requis.";
            $messageType = 'error';
            break;
        }
    }

    // Vérifications supplémentaires pour la longueur des champs
    if($isValid && (strlen($_POST['quiz_title']) < 3 || strlen($_POST['question_text']) < 5)) {
        $isValid = false;
        $message = "Le titre du quiz doit contenir au moins 3 caractères et le texte de la question doit contenir au moins 5 caractères.";
        $messageType = 'error';
    }

    if($isValid) {
        // Récupérer les valeurs des champs
        $quizTitle = htmlspecialchars($_POST['quiz_title']);
        $questionText = htmlspecialchars($_POST['question_text']);
        $option1 = htmlspecialchars($_POST['option1']);
        $option2 = htmlspecialchars($_POST['option2']);
        $option3 = htmlspecialchars($_POST['option3']);
        $correctOption = htmlspecialchars($_POST['correct_option']);

        // Créer un objet QuestionModel
        $question = new QuestionModel(null, $quizTitle, $questionText, $option1, $option2, $option3, $correctOption);

        // Ajouter la question en utilisant le contrôleur
        $questionController = new QuestionController();
        if ($questionController->addQuestion($question)) {
            $message = "Question ajoutée avec succès.";
            $messageType = 'success';
        } else {
            $message = "Erreur lors de l'ajout de la question.";
            $messageType = 'error';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout Question</title>
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
            min-height: 100vh;
        }

        header {
            background-color: #fffcfc;
            padding: 20px;
            text-align: center;
            width: 100%;
            position: relative;
            margin-bottom: 20px;
        }

        header img {
            background-color: transparent;
            border-radius: 50%;
            z-index: 1;
            max-width: 100%;
            max-height: 150px;
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

        input {
            width: calc(100% - 16px);
            padding: 10px;
            margin-bottom: 20px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        input[type="submit"] {
            background-color: #4a90e2;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 30px;
            cursor: pointer;
            margin: 8px;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s, transform 0.2s;
        }

        input[type="submit"]:hover {
            background-color: #357ebd;
            transform: scale(1.05);
        }

        #message {
            color: <?= $messageType === 'error' ? 'red' : 'green' ?>;
            font-weight: bold;
        }
    </style>
</head>
<body>
<header>
    <img src="../assets/logo.png" alt="Logo" width="150" height="150">
</header>
<h1>Ajout Question</h1>

<!-- Ajoutez cette section pour afficher le message de succès ou d'erreur -->
<div id="message">
    <?php echo $message; ?>
</div>

<form id="questionForm" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
    <label for="quiz_title">Titre du Quiz:</label>
    <input type="text" id="quiz_title" name="quiz_title"><br>

    <label for="question_text">Texte de la Question:</label>
    <input type="text" id="question_text" name="question_text"><br>

    <label for="option1">Option 1:</label>
    <input type="text" id="option1" name="option1"><br>

    <label for="option2">Option 2:</label>
    <input type="text" id="option2" name="option2"><br>

    <label for="option3">Option 3:</label>
    <input type="text" id="option3" name="option3"><br>

    <label for="correct_option">Option Correcte:</label>
    <input type="text" id="correct_option" name="correct_option"><br>

    <input type="submit" value="Add Question">
</form>
</body>
</html>
