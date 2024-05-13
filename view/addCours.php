<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../controller/coursC.php';

// Variable pour stocker le message de succès
$message = '';
$messageType = 'success'; // 'error' pour les erreurs

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ignore the ID_cours field as it's auto-incremented
    $titre = htmlspecialchars($_POST['titre']);
    $proprietaire = htmlspecialchars($_POST['proprietaire']);
    $prix = htmlspecialchars($_POST['prix']);
    $description = htmlspecialchars($_POST['description']);
    $image = htmlspecialchars($_POST['image']);
    $category = htmlspecialchars($_POST['category']);
    $pdf = $_FILES['pdf'];

    $courscontroller = new coursC();

    if (strlen($titre) < 3) {
        $message = "Le titre doit contenir au moins 3 caractères.";
        $messageType = 'error';
    } else {
        $courscontroller = new coursC();

        if ($courscontroller->addCours($titre, $proprietaire, $prix, $description, $image, $category, $pdf)) {
            $message = "Document ajouté avec succès.";
        } else {
            $message = "Erreur lors de l'ajout du document.";
            $messageType = 'error';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout Cours</title>
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

    input, select {
        width: calc(100% - 16px);
        padding: 10px;
        margin-bottom: 20px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 4px;
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
    }

    input[type="submit"]:hover {
        background-color: #357ebd;
        transform: scale(1.05);
    }

    .error_message {
        color: red; /* Assurez-vous que le message d'erreur est en rouge */
        margin-bottom: 20px;
        font-weight: bold;
    }
</style>

</head>
    <header>
        <img src="../assets/logo.png" alt="Logo" width="150" height="150">
    </header>
    <h1>Ajout Document</h1>
    <div id="error_message" style="color: red;"></div>

<!-- Zone pour les messages de succès ou d'erreur du serveur -->
<div id="message">
    <?php if (!empty($message)): ?>
        <p style="color: <?= $messageType === 'error' ? 'red' : 'green'; ?>;">
            <?= $message; ?>
        </p>
    <?php endif; ?>
</div>
<form id="coursForm" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data" onsubmit="return validateForm()">
    <label for="titre">Titre:</label>
    <input type="text" id="titre" name="titre">
    <div id="error_titre" class="error_message"></div>

    <label for="proprietaire">Propriétaire:</label>
    <input type="text" id="proprietaire" name="proprietaire">
    <div id="error_proprietaire" class="error_message"></div>

    <label for="prix">Prix:</label>
    <input type="text" id="prix" name="prix">
    <div id="error_prix" class="error_message"></div>

    <label for="description">Description:</label>
    <input type="text" id="description" name="description">
    <div id="error_description" class="error_message"></div>

    <label for="image">Chemin de l'image:</label>
    <input type="text" id="image" name="image">
    <div id="error_image" class="error_message"></div>

    <label for="category">Catégorie du document:</label>
    <select id="category" name="category">
        <option value="">--Choisissez une option--</option>
        <option value="1">Cours</option>
        <option value="2">Livre</option>
        <option value="3">Exercice</option>
    </select>
    <div id="error_category" class="error_message"></div>

    <label for="pdf">Chemin du fichier PDF :</label>
    <input type="file" id="pdf" name="pdf" accept=".pdf">
    <div id="error_pdf" class="error_message"></div>

    <input type="submit" value="Add Cours">
</form>


<!-- Script JavaScript pour afficher une alerte -->
<script>
function validateForm() {
    var isValid = true; // Assume form is valid unless checks fail

    // Clear previous error messages
    document.querySelectorAll('.error_message').forEach(function(element) {
        element.textContent = '';
    });

    // Get form field values
    var fields = {
        titre: document.getElementById('titre'),
        proprietaire: document.getElementById('proprietaire'),
        prix: document.getElementById('prix'),
        description: document.getElementById('description'),
        image: document.getElementById('image'),
        category: document.getElementById('category'),
        pdf: document.getElementById('pdf')
    };

    // Validate each field and set error messages
    if (fields.titre.value.trim() === '') {
        document.getElementById('error_titre').textContent = 'Le titre est requis.';
        isValid = false;
    }
    if (fields.proprietaire.value.trim() === '') {
        document.getElementById('error_proprietaire').textContent = 'Le propriétaire est requis.';
        isValid = false;
    }
    if (fields.prix.value.trim() === '' || isNaN(parseFloat(fields.prix.value)) || parseFloat(fields.prix.value) < 0) {
        document.getElementById('error_prix').textContent = 'Entrez un prix valide.';
        isValid = false;
    }
    if (fields.description.value.trim() === '') {
        document.getElementById('error_description').textContent = 'La description est requise.';
        isValid = false;
    }
    if (fields.image.value.trim() === '') {
        document.getElementById('error_image').textContent = 'L\'image est requise.';
        isValid = false;
    }
    if (fields.category.value.trim() === '') {
        document.getElementById('error_category').textContent = 'La catégorie est requise.';
        isValid = false;
    }
    if (fields.pdf.files.length === 0) {
        document.getElementById('error_pdf').textContent = 'Un fichier PDF doit être sélectionné.';
        isValid = false;
    }

    return isValid;
}
</script>


</body>
</html>
