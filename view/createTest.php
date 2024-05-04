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
<header>
    <img src="../assets/logo.png" alt="Logo" width="150" height="150">
</header>
<head>
    <meta charset="UTF-8">
    <title>Créer un Test</title>
</head>
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

header {
    background-color: #fffcfc;
    padding: 20px;
    text-align: center;
    width: 100%;
    position: relative;
}
header::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: #000000; /* Black background color */
    opacity: 0.5; /* Adjust opacity as needed */
    z-index: -1;
}
header img {
    background-color: transparent;
    border-radius: 50%;
    z-index: 1;
}

h1 {
    color: #333;
    margin-bottom: 20px;
}

form {
    width: 90%; /* Largeur du formulaire réduite */
    margin: 20px auto;
    padding: 20px;
    background-color: #edf0f5; /* Fond blanc */
    border-radius: 8px; /* Coins arrondis */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Ombre légère */
}

label {
    display: block;
    margin-bottom: 10px;
    color: #333;
    font-size: 16px;
}

input[type="submit"] {
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

input[type="submit"]:hover {
    background-color: #357ebd; /* Bleu légèrement plus foncé au survol */
    transform: scale(1.05); /* Légère animation de zoom au survol */
}
</style>
<body>
    <h1>Créer un Test</h1>
    <form method="POST" action="">
        <label for="quiz_title">Titre du Test:</label>
        <input type="text" id="quiz_title" name="quiz_title"><br>

        <label>Sélectionner les questions:</label>
        <?php foreach ($allQuestions as $question) { ?>
            <div>
                <input type='checkbox' name='questions[]' value='<?= $question['id_question'] ?>'>
                <?= htmlspecialchars($question['quiz_title']) ?>
            </div>
        <?php } ?>
        <label>Sélectionner les cours:</label>
        <?php foreach ($allCours as $cours) { ?>
            <div>
                <input type='checkbox' name='cours[]' value='<?= $cours['id_cours'] ?>'>
                <?= htmlspecialchars($cours['titre']) ?>
            </div>
        <?php } ?>

        <br>
        <input type="submit" value="Créer le Test">
    </form>
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
