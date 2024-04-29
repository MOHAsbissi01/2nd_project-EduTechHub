<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../controller/coursC.php';

// Variable pour stocker le message de succès
$message = '';

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

    if ($courscontroller->addCours($titre, $proprietaire, $prix, $description, $image, $category, $pdf)) {
        // Définir le message de succès
        $message = "Document ajouté avec succès.";
    } else {
        $message = "Erreur lors de l'ajout du document.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Cours</title>
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
</head>
<body>
<header>
    <img src="../assets/logo.png" alt="Logo" width="150" height="150">
</header>
<h1>Ajout Document</h1>

<!-- Ajoutez cette section pour afficher le message de succès ou d'erreur -->
<div id="message">
    <?php echo $message; ?>
</div>

<form id="coursForm" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data" onsubmit="return validateForm()">
    <!-- Removed the ID_cours field -->
    <label for="titre">Titre:</label>
    <input type="text" id="titre" name="titre"><br>

    <label for="proprietaire">Propriétaire:</label>
    <input type="text" id="proprietaire" name="proprietaire"><br>

    <label for="prix">Prix:</label>
    <input type="text" id="prix" name="prix"><br>

    <label for="description">Description:</label>
    <input type="text" id="description" name="description"><br>

    <label for="image">Chemin de l'image:</label>
    <input type="text" id="image" name="image"><br>

    <label for="category">Catégorie du document:</label>
    <select id="category" name="category">
        <option value="1">Cours</option>
        <option value="2">Livre</option>
        <option value="3">Exercice</option>
    </select><br>

    <label for="pdf">Chemin du fichier PDF :</label>
    <input type="file" id="pdf" name="pdf" accept=".pdf"><br>

    <input type="submit" value="Add Cours">
</form>

<!-- Script JavaScript pour afficher une alerte -->
<script>
    // Fonction pour valider le formulaire
    function validateForm() {
        var titre = document.getElementById("titre").value;
        var proprietaire = document.getElementById("proprietaire").value;
        var prix = document.getElementById("prix").value;
        var description = document.getElementById("description").value;
        var image = document.getElementById("image").value;
        var category = document.getElementById("category").value;
        var pdf = document.getElementById("pdf").value;

        if (titre === "" || proprietaire === "" || prix === "" || description === "" || image === "" || category === "" || pdf === "") {
            alert("Veuillez remplir tous les champs");
            return false;
        }

        return true;
    }

    // Vérifier si le message de succès est défini
    if ("<?php echo $message; ?>" !== "") {
        // Afficher une alerte avec le message de succès
        alert("<?php echo $message; ?>");
    }
</script>
</body>
</html>
