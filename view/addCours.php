<?php
echo "Le formulaire a été soumis.";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../controller/coursC.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_cours = isset($_POST['id_cours']) ? htmlspecialchars($_POST['id_cours']) : null;
    $titre = htmlspecialchars($_POST['titre']);
    $proprietaire = htmlspecialchars($_POST['proprietaire']);
    $prix = htmlspecialchars($_POST['prix']);
    $description = htmlspecialchars($_POST['description']);
    $image = htmlspecialchars($_POST['image']);
    $category = htmlspecialchars($_POST['category']);
    $pdf = $_FILES['pdf'];

    $courscontroller = new coursC();

    if ($courscontroller->addCours($id_cours, $titre, $proprietaire, $prix, $description, $image, $category, $pdf)) {
        echo "Cours ajouté avec succès.";
        // Redirige vers la page listeoeuvre.php
        header("Location: listecours.php");
        exit();
    } else {
        echo "Erreur lors de l'ajout du cours.";
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
        /* Votre CSS ici */
    </style>
    <script>
        function validateForm() {
            var idCours = document.getElementById("id_cours").value;
            var titre = document.getElementById("titre").value;
            var proprietaire = document.getElementById("proprietaire").value;
            var prix = document.getElementById("prix").value;
            var description = document.getElementById("description").value;
            var image = document.getElementById("image").value;
            var category = document.getElementById("category").value;
            var pdf = document.getElementById("pdf").value;

            if (idCours === "" || titre === "" || proprietaire === "" || prix === "" || description === "" || image === "" || category === "" || pdf === "") {
                alert("Veuillez remplir tous les champs");
                return false;
            }

            return true;
        }
    </script>
</head>
<body>
<header>
    <img src="../asset/logo.png" alt="Logo" width="150" height="150">
</header>
<h1>Add Cours</h1>

<form id="coursForm" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data" onsubmit="return validateForm()">
    <label for="id_cours">ID du cours:</label>
    <input type="text" id="id_cours" name="id_cours"><br>

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

    <select id="category" name="category">
        <option value="1">Cours</option>
        <option value="2">Livre</option>
        <option value="3">Quizz</option>
    </select><br>

    <label for="pdf">Chemin du fichier PDF :</label>
    <input type="file" id="pdf" name="pdf" accept=".pdf"><br>

    <input type="submit" value="Add Cours">
</form>

<a href="../front/index.php" class="retour-button">Retour</a>
</body>
</html>
