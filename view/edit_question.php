<?php
require_once('../controller/QuestionController.php');

// Assurez-vous que les variables sont initialisées avec des valeurs par défaut
$quizTitle = '';
$questionText = '';
$option1 = '';
$option2 = '';
$option3 = '';
$correctOption = '';

// Vérifier si un ID de question est spécifié dans l'URL
if (isset($_GET['id'])) {
    $id_question = $_GET['id'];

    // Créer une instance du contrôleur de question
    $questioncontroller = new QuestionController();

    // Récupérer les détails de la question à partir de l'ID spécifié
    $questionDetails = $questioncontroller->showQuestion($id_question);

    // Vérifier si les détails de la question ont été récupérés avec succès
    if ($questionDetails) {
        // Assigner les valeurs des détails de la question aux variables correspondantes
        $quizTitle = $questionDetails['quiz_title'];
        $questionText = $questionDetails['question_text'];
        $option1 = $questionDetails['option_1'];
        $option2 = $questionDetails['option_2'];
        $option3 = $questionDetails['option_3'];
        $correctOption = $questionDetails['correct_option'];
    } else {
        // Si la question avec l'ID spécifié n'existe pas, afficher un message
        echo "<p>La question avec l'ID $id_question n'existe pas.</p>";
    }
} else {
    // Si aucun ID de question n'est spécifié dans l'URL, afficher un message
    echo "ID de la question non spécifié.";
    exit();
}

// Définir une variable pour stocker le message de succès
$updateMessage = '';

// Vérifier si le formulaire a été soumis avec succès
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données mises à jour à partir du formulaire
    $updatedquizTitle = $_POST['quiz_title'];
    $updatedquestionText = $_POST['question_text'];
    $updatedoption1 = $_POST['option1'];
    $updatedoption2 = $_POST['option2'];
    $updatedoption3 = $_POST['option3'];
    $updatedcorrectOption = $_POST['correct_option'];

    // Mettre à jour la question dans la base de données
    $questioncontroller = new QuestionController();
    $updateResult = $questioncontroller->updateQuestion(
        $id_question,
        $updatedquizTitle,
        $updatedquestionText,
        $updatedoption1,
        $updatedoption2,
        $updatedoption3,
        $updatedcorrectOption
    );

    // Vérifier si la mise à jour a réussi
    if ($updateResult === "Quizz details updated successfully") {
        // Si oui, définir le message de succès
        $updateMessage = "<p>Mise à jour réussie!</p>";
    } else {
        // Sinon, afficher un message d'erreur
        $updateMessage = "<p>Une erreur s'est produite lors de la mise à jour: $updateResult</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
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
    <h1>Update Quizz Information</h1>
    <header><img src="..\assets\logo.png" alt="Logo" width="150" height="150"></header>

    <?php echo $updateMessage; // Afficher le message de succès ou d'erreur ?>

    <form action="" method="POST">
        <label for="quiz_title">Titre du Quiz:</label>
        <input type="text" id="quiz_title" name="quiz_title" value="<?php echo htmlspecialchars($quizTitle); ?>" required><br>

        <label for="question_text">Texte de la Question:</label>
        <input type="text" id="question_text" name="question_text" value="<?php echo htmlspecialchars($questionText); ?>" required><br>

        <label for="option1">Option 1:</label>
        <input type="text" id="option1" name="option1" value="<?php echo htmlspecialchars($option1); ?>" required><br>

        <label for="option2">Option 2:</label>
        <input type="text" id="option2" name="option2" value="<?php echo htmlspecialchars($option2); ?>" required><br>

        <label for="option3">Option 3:</label>
        <input type="text" id="option3" name="option3" value="<?php echo htmlspecialchars($option3); ?>" required><br>

        <label for="correct_option">Option Correcte:</label>
        <input type="text" id="correct_option" name="correct_option" value="<?php echo htmlspecialchars($correctOption); ?>" required><br>

        <input type="submit" value="Mettre à jour la question">
    </form>
    <form method="get" action="../2nd_project-EduTechHub/dshb-bookmarks.php">
        <button type="submit">Retourner vers la liste</button>
    </form>
</body>
</html>
