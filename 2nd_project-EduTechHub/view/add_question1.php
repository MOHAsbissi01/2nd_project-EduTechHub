<?php
// Code PHP pour vérifier les champs requis et ajouter la question
require_once '../Model/QuestionModel.php';
require_once '../controller/QuestionController.php';
$error ="";

// Les champs requis
$requiredFields = ['quiz_title','question_text', 'option1','option2','option3','correct_option'];

// Vérifier si tous les champs requis sont présents dans $_POST
foreach($requiredFields as $field){
    if(!isset($_POST[$field])){
        die("Le champ '$field' est requis.");
    }
}

// Récupérer les valeurs des champs
$quizTitle = $_POST['quiz_title'];
$question_text = $_POST['question_text'];
$option1 = $_POST['option1'];
$option2 = $_POST['option2'];
$option3 = $_POST['option3'];
$correct_option = $_POST['correct_option'];

// Créer un objet QuestionModel
$question= new QuestionModel(null,$quizTitle,$option1,$option2,$option3,$correct_option);

// Ajouter la question en utilisant le contrôleur
$questionController = new QuestionController();
$questionController->addQuestion($question);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add quizz</title>
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

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
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
    </style>
</head>
<body>
    <header><img src="..\assets\logo.png" alt="Logo" width="150" height="150"></header>
    <form method="get" action="../2nd_project-EduTechHub/dshb-bookmarks.php">
        <button type="submit">Retourner vers la liste</button>
    </form>
</body>
</html>