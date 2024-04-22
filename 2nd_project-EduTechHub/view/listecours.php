<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des cours</title>
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

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        table {
            width: 90%; /* Largeur du tableau réduite */
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Ombre légère */
            background-color: #edf0f5; /* Fond blanc */
            border-radius: 8px; /* Coins arrondis */
            overflow: hidden; /* Masquage du contenu qui dépasse */
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #333;
            color: #fff;
            font-weight: bold; /* Texte en gras */
            text-transform: uppercase; /* Majuscules */
        }

        td img {
            max-width: 80px; /* Largeur d'image réduite */
            height: auto;
            border-radius: 4px;
        }

        button {
            background-color: #4a4a4a;
            color: #fff;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-right: 5px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #333;
        }

        .button-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .button-container button {
            margin-bottom: 10px;
        }

        /* Style pour les boutons */
        button {
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

        button:hover {
            background-color: #357ebd; /* Bleu légèrement plus foncé au survol */
            transform: scale(1.05); /* Légère animation de zoom au survol */
        }

        /* Style pour les filtres */
        .filter-buttons {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .filter-button {
            background-color: #ff7f50; /* Orange vif */
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 20px; /* Coins arrondis */
            cursor: pointer;
            margin: 0 10px;
            font-size: 14px;
            font-weight: bold;
            transition: background-color 0.3s, transform 0.2s;
        }

        .filter-button:hover {
            background-color: #ff6347; /* Orange légèrement plus foncé au survol */
            transform: scale(1.05); /* Légère animation de zoom au survol */
        }
    </style>
</head>
<body>
<!-- En-tête -->
<header><img src="..\assets\logo.png" alt="Logo" width="150" height="150"></header>
<h1>Liste des cours</h1>
<form method="get" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
    <label for="tri">Trier par :</label>
    <select name="tri" id="tri">
        <option value="id_asc">ID (ascendant)</option>
        <option value="id_desc">ID (descendant)</option>
        <option value="price_asc">Prix (ascendant)</option>
        <option value="price_desc">Prix (descendant)</option>
    </select>
    <button type="submit">Trier</button>
</form>
<div class="filter-buttons">
    <button class="filter-button" onclick="filterByType(0)">Tout documents</button>
    <button class="filter-button" onclick="filterByType(1)">Cours</button>
    <button class="filter-button" onclick="filterByType(2)">Livres</button>
    <button class="filter-button" onclick="filterByType(3)">Exercices</button>
</div>



<!-- Tableau des cours -->
<table border="1">
    <thead>
    <tr>
        <th class="table-header">ID</th>
        <th class="table-header">Titre</th>
        <th class="table-header">Propriétaire</th>
        <th class="table-header">Prix</th>
        <th class="table-header">Description</th>
        <th class="table-header">Image</th>
        <th class="table-header">Catégorie</th>
        <th class="table-header">PDF</th>
        <th class="table-header">Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php
    // Inclusion du fichier de contrôleur
    require_once('../controller/coursC.php');
    // Création d'une instance du contrôleur
    $controller = new coursC();
    // Récupération de la liste des cours
    $courss = $controller->listCours();

    require_once('../controller/categorieC.php');

    // Instantiate the CategorieC class
    $controller2 = new CategorieC();

    // Items per page
    $itemsPerPage = 10;

    // Retrieve the total number of courss
    $totalcourss = $controller2->getTotalCours();
    $totalPages = ceil($totalcourss / $itemsPerPage);

    // Get the current page, default to 1
    $current_page = isset($_GET['page']) ? max(1, $_GET['page']) : 1;

    // Calculate the offset for the query
    $offset = ($current_page - 1) * $itemsPerPage;

    // Retrieve cours based on sorting option
    $tri = isset($_GET['tri']) ? $_GET['tri'] : 'id_asc';
    switch ($tri) {
        case 'id_asc':
            $courss = $controller->listCoursAscendingByID();
            break;
        case 'id_desc':
            $courss = $controller->listCoursDescendingByID();
            break;
        case 'price_asc':
            $courss = $controller->listCoursAscendingByPrice();
            break;
        case 'price_desc':
            $courss = $controller->listCoursDescendingByPrice();
            break;
        default:
            // Default to sorting by ID ascending
            $courss = $controller->listCoursAscendingByID();
    }

    if (empty($courss)) {
        echo "Il n'y a pas de documents pour le moment.";
    } else {
        // Display category, title, image, and price of all docs
        foreach ($courss as $cours) {
            echo "<tr class='category-" . htmlspecialchars($cours['category']) . "'>";

            // Map category numbers to corresponding names
            $categoryNames = [
                1 => 'Cours',
                2 => 'Livres',
                3 => 'Exercices',
            ];

            $categoryName = isset($categoryNames[$cours['category']]) ? $categoryNames[$cours['category']] : 'Inconnu';

            echo "<td>" . htmlspecialchars($cours['id_cours']) . "</td>";
            echo "<td>" . htmlspecialchars($cours['titre']) . "</td>";
            echo "<td>" . htmlspecialchars($cours['proprietaire']) . "</td>";
            echo "<td>" . htmlspecialchars($cours['prix']) . "</td>";
            echo "<td>" . htmlspecialchars($cours['description']) . "</td>";
            echo "<td><img src='" . htmlspecialchars($cours['image']) . "' alt='Image du cours' width='100'></td>";
            echo "<td>" . htmlspecialchars($categoryName) . "</td>"; // Utilisation de la colonne 'type_doc' pour afficher la catégorie
            echo "<td><a href='" . htmlspecialchars($cours['pdf']) . "' target='_blank'>PDF</a></td>"; // Lien vers le fichier PDF
            echo "<td>";
            echo "<form method='post' action='../View/deleteCours.php' onsubmit='return confirmDelete(\"" . htmlspecialchars($cours['id_cours']) . "\")'>";
            echo "<input type='hidden' name='id' value='" . htmlspecialchars($cours['id_cours']) . "'>";
            echo "<button type='submit' name='delete'>Supprimer</button>";
            echo "</form>";
            echo "<form method='get' action='../View/updatecours.php'>";
            echo "<input type='hidden' name='id' value='" . htmlspecialchars($cours['id_cours']) . "'>";
            echo "<button type='submit'>Modifier</button>";
            echo "</form>";
            echo "</td>";
            echo "</tr>";
        }
    }
    ?>
    </tbody>
</table>

<!-- Script pour confirmer la suppression -->
<script>
    function filterByType(type) {
        var tableRows = document.getElementsByTagName('tr');
        for (var i = 1; i < tableRows.length; i++) { // Commence à i=1 pour exclure l'en-tête
            var row = tableRows[i];
            if (type === 0 || row.classList.contains('category-' + type)) {
                row.style.display = 'table-row';
            } else {
                row.style.display = 'none';
            }
        }
    }

    function confirmDelete(id) {
        return confirm("Voulez-vous vraiment supprimer le cours avec l'ID " + id + " ?");
    }
</script>

</body>
</html>
