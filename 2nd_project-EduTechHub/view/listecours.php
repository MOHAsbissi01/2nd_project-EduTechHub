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
            background-color: lightgrey ; /* Ajout de la couleur de fond grise */
        }

        h1 {
            text-align: center;
            color: #4a4a4a;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #333;
            color: #fff;
        }

        td img {
            max-width: 100px;
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
            margin-bottom: 10px; /* Ajout d'une marge de 10 pixels entre les boutons */
        }
    </style>
</head>
<body>
    <h1>Liste des cours</h1>

    <!-- En-tête -->
    <header><img src="..\asset\logo.png" alt="Logo" width="150" height="150"></header>
    
    <!-- Tableau des cours -->
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Propriétaire</th>
                <th>Prix</th>
                <th>Description</th>
                <th>Image</th>
                <th>Catégorie</th>
                <th>PDF</th>
                <th>Actions</th>
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

            // Parcours des cours et affichage dans le tableau
            foreach ($courss as $cours) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($cours['id_cours']) . "</td>";
                echo "<td>" . htmlspecialchars($cours['titre']) . "</td>";
                echo "<td>" . htmlspecialchars($cours['proprietaire']) . "</td>";
                echo "<td>" . htmlspecialchars($cours['prix']) . "</td>";
                echo "<td>" . htmlspecialchars($cours['description']) . "</td>";
                echo "<td><img src='" . htmlspecialchars($cours['image']) . "' alt='Image du cours' width='100'></td>";
                echo "<td>" . htmlspecialchars($cours['type_doc']) . "</td>"; // Utilisation de la colonne 'type_doc' pour afficher la catégorie
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
            ?>
        </tbody>
    </table>

    <!-- Script pour confirmer la suppression -->
    <script>
        function confirmDelete(id) {
            return confirm("Voulez-vous vraiment supprimer le cours avec l'ID " + id + " ?");
        }
    </script>
    <div class="button-container">
            <!-- Bouton pour ajouter un cours -->
    <a href="../View/addCours.php" style="text-decoration: none;">
        <button>Ajouter un cours</button>
    </a>
        <a href="../IndexD.php" style="text-decoration: none;">
            <button>Retourner</button>
        </a>
    </div>
</body>
</html>