<!DOCTYPE html>
<html>
<head>
    <title>Modifier un cours</title>
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
    <header><img src="..\asset\logo.png" alt="Logo" width="170" height="170"></header>

    <?php
        require_once('../controller/coursC.php');

        // Vérifier si le formulaire a été soumis avec l'ID
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $id_cours = $_POST['id'];

            $courscontroller = new coursC();
            $coursDetails = $courscontroller->showcours($id_cours);

            // Vérifier si le cours existe
            if ($coursDetails) {
                // Si le formulaire a été soumis et que l'ID existe, rediriger vers la page d'update
                header("Location: updatecours.php?id=$id_cours");
                exit();
            } else {
                // Si le cours n'existe pas, afficher un message
                echo "<p>Le cours avec l'ID $id_cours n'existe pas.</p>";
            }
        }
    ?>

    <h1>Modifier un cours</h1>

    <!-- Formulaire pour saisir l'ID du cours -->
    <form action="" method="POST">
        <label for="id_cours">ID du cours:</label>
        <input type="text" id="id_cours" name="id" required>
        <input type="submit" value="Modifier">
    </form>

    <form method="get" action="listecours.php">
        <button type="submit">Retourner vers la liste</button>
    </form>
</body>
</html>

<?php
    require_once('../controller/coursC.php');

    if (isset($_GET['id'])) {
        $id_cours = $_GET['id'];

        $courscontroller = new coursC();
        $coursDetails = $courscontroller->showcours($id_cours);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $updatedTitre = $_POST['titre'];
            $updatedProprietaire = $_POST['proprietaire'];
            $updatedPrix = $_POST['prix'];
            $updatedDescription = $_POST['description'];
            $updatedImage = $_POST['image'];
            $updatedCategory = $_POST['category'];

            // Vérifie si le fichier PDF a été correctement téléchargé
            if ($_FILES['pdf']['error'] === UPLOAD_ERR_OK) {
                // Chemin du dossier de téléchargement des PDF
                $uploadDirectory = "../uploads/";
                // Chemin complet du fichier PDF téléchargé
                $pdfPath = $uploadDirectory . basename($_FILES['pdf']['name']);
                // Déplace le fichier PDF téléchargé vers le dossier de destination
                if (move_uploaded_file($_FILES['pdf']['tmp_name'], $pdfPath)) {
                    $updatedPdf = $pdfPath;
                    $courscontroller = new coursC();
                    $updateResult = $courscontroller->updateCours(
                        $id_cours,
                        $updatedTitre,
                        $updatedProprietaire,
                        $updatedPrix,
                        $updatedDescription,
                        $updatedImage,
                        $updatedCategory,
                        $updatedPdf
                    );
                    echo "<p>$updateResult</p>";
                } else {
                    echo "Erreur lors du téléchargement du fichier PDF.";
                }
            } else {
                echo "Erreur lors du téléchargement du fichier PDF.";
            }
        }
    } else {
        echo "cours ID not specified.";
        exit();
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update cours Information</title>
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
    <h1>Update cours Information</h1>
    <header><img src="..\asset\logo.png" alt="Logo" width="150" height="150"></header>

    <form action="" method="POST" enctype="multipart/form-data">
        <label for="titre">titre:</label>
        <input type="text" id="titre" name="titre" value="<?php echo htmlspecialchars($coursDetails['titre']); ?>" required><br><br>

        <label for="proprietaire">proprietaire:</label>
        <input type="text" id="proprietaire" name="proprietaire" value="<?php echo htmlspecialchars($coursDetails['proprietaire']); ?>"><br><br>

        <label for="prix">prix:</label>
        <input type="text" id="prix" name="prix" value="<?php echo htmlspecialchars($coursDetails['prix']); ?>"><br><br>

        <label for="description">description:</label>
        <input type="text" id="description" name="description" value="<?php echo htmlspecialchars($coursDetails['description']); ?>"><br><br>

        <label for="image">image:</label>
        <input type="text" id="image" name="image" value="<?php echo htmlspecialchars($coursDetails['image']); ?>"><br><br>

        <label for="category">Category:</label>
        <select id="category" name="category" required>
            <option value="1" <?php if ($coursDetails['category'] === '1') echo 'selected'; ?>>Cours</option>
            <option value="2" <?php if ($coursDetails['category'] === '2') echo 'selected'; ?>>Livre</option>
            <option value="3" <?php if ($coursDetails['category'] === '3') echo 'selected'; ?>>Quizz</option>
        </select>

        <label for="pdf">pdf:</label>
        <input type="file" id="pdf" name="pdf"><br><br>

        <input type="submit" name="submit" value="update cours">
    </form>
    <form method="get" action="listecours.php">
        <button type="submit">Retourner vers la liste</button>
    </form>

</body>
</html>
