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
    
        if ($courscontroller->addCours($id_cours, $titre, $proprietaire, $prix, $description, $image, $category,$pdf)) {
            echo "Cours ajouté avec succès.";
            // Redirige vers la page listeoeuvre.php
            header("Location: listecours.php");
            exit();
        } else {
            echo "Erreur lors de l'ajout du cours.";
        }
    } var_dump($_POST);
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Cours</title>²
    <style>
        body {
            background: url('../asset/zzz.jpg') center/cover no-repeat; /* Set the path to your background image */
            color: #333333;
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        header {
            background-color: #000000;
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
            z-index: -1;}
        header img {
            background-color: transparent;
            border-radius: 50%;
            z-index: 1;        }

        h1 {
            color: #FFA500;
            margin-bottom: 10px;
            text-align: center;
        }

        form {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8); /* Add some opacity to the background color */
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
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
            background-color: #FFA500;
            color: #000000;
            cursor: pointer;
            font-size: 18px;
            border: 1px solid #FFA500;
            border-radius: 4px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #333;
            color: #FFA500;
        }

        .retour-button {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            text-decoration: none;
            background-color: #FFA500;
            color: #000000;
            border-radius: 4px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .retour-button:hover {
            background-color: #333;
            color: #FFA500;
        }
    </style>
</head>
<body>
<header>
        <img src="../asset/logo.png" alt="Logo" width="150" height="150">
    </header>
    <h1>Add Cours </h1>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
    
    <label for="id_cours">ID du cours:</label>
        <input type="text" name="id_cours" required><br>
    <label for="titre">Titre:</label>
        <input type="text" name="titre" required><br>

        <label for="proprietaire">Propriétaire:</label>
        <input type="text" name="proprietaire" required><br>

        <label for="prix">Prix:</label>
        <input type="text" name="prix" required><br>

        <label for="description">Description:</label>
        <input type="text" name="description" required><br>

        <label for="image">Chemin de l'image:</label>
<input type="text" name="image" required><br>
<select name="category" required>
    <option value="1">Cours</option>
    <option value="2">Livre</option>
    <option value="3">Quizz</option>

    <label for="pdf">Chemin du fichier PDF :</label>
    <input type="file" name="pdf" accept=".pdf" required><br>


</select><br>

        <input type="submit" value="Add Cours">
    </form>
    <a href="../front/index.php" class="retour-button">Retour</a>

    <style>
         .retour-button {
        display: inline-block;
        padding: 10px 20px;
        margin-top: 20px;
        text-decoration: none;
        background-color: #FFA500; /* Orange background color */
        color: #000000; /* Black text color */
        border-radius: 4px;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .retour-button:hover {
        background-color: #333;
        color: #FFA500;
    }
    </style>
</body>
</html>