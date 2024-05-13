<!-- view_oeuvre.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vue du cours</title>
    <style>
        /* Add your CSS styles here */
    </style>
</head>
<body>
    <?php
    // Include necessary files and classes
    require_once('../controller/categorieC.php');

    // Instantiate the CategorieC class
    $controller = new CategorieC();

    // Check if the ID parameter is set in the URL
    if (isset($_GET['id'])) {
        $id_cours = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

        // Retrieve information about the specific piece of artwork
        $cours = $controller->getCoursById($id_cours);

        if ($cours) {
            echo "<div>";
            echo "<img src='" . htmlspecialchars($cours['image']) . "' alt='Image de l'œuvre' width='400'><br>";
            echo "<div>";
            echo "<h2>" . htmlspecialchars($cours['titre']) . "</h2>";
            echo "<p>Propriétaire: " . htmlspecialchars($cours['proprietaire']) . "</p>";
            echo "<p>Description: " . htmlspecialchars($cours['description']) . "</p>";
            echo "<p>Prix: " . htmlspecialchars($cours['prix']) . "</p>";
            echo "<button onclick='commander(" . $cours['id_cours'] . ")'>Commander</button>";
            echo "</div>";
            echo "</div>";
        } else {
            echo "<p>Doc non trouvée.</p>";
        }
    } else {
        echo "<p>Identifiant de doc non spécifié.</p>";
    }
    ?>

    <script>
        function commander(id_cours) {
            // You can add logic here to handle the ordering process
            alert("Commande de cours avec l'ID " + id_cours + " effectuée !");
        }
    </script>
</body>
</html>
