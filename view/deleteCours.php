<?php
require_once '../controller/coursC.php';

// Vérifie si l'ID du cours est passé en paramètre dans le formulaire POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    // Sanitise l'entrée pour éviter les attaques par injection
    $id_cours = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

    if ($id_cours === false || $id_cours === null) {
        // Gestion de l'erreur si la validation échoue
        echo "Invalid ID format.";
        exit();
    }

    // Création d'une instance du contrôleur de cours
    $courscontroller = new coursC();

    // Tentative de suppression du cours
    $deleteResult = $courscontroller->deleteCours($id_cours);

    if ($deleteResult === true) {
        // Si la suppression réussit, afficher un message de succès
        echo "Cours supprimé avec succès.";
    } else {
        // Si la suppression échoue, afficher un message d'erreur
        echo "Impossible de supprimer le cours. Vérifiez l'ID et réessayez.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Supprimer un cours</title>
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
    <header><img src="..\asset\logo.png" alt="Logo" width="150" height="150"></header>

    <!-- Formulaire pour saisir l'ID du cours à supprimer -->
    <h1>Supprimer un cours</h1>
    <form action="" method="POST">
        <label for="id_cours">ID du cours:</label>
        <input type="text" id="id_cours" name="id" required>
        <input type="submit" value="Supprimer">
    </form>

    <form method="get" action="listecours.php">
        <button type="submit">Retourner vers la liste</button>
    </form>
</body>
</html>