<?php
require_once '../Controller/TestController.php';
$controller = new TestController();
$testOptions = $controller->getTestTitlesForDropdown();
$emailError = '';  // Variable pour stocker le message d'erreur de l'email

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email'], $_POST['test_id'])) {
    $email = $_POST['email'];
    $testId = $_POST['test_id'];

    // Vérifie si l'email existe dans la base de données
    if ($controller->checkEmailExists($email)) {
        // Si l'email existe, envoie les données via POST à startTest.php
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    var form = document.createElement('form');
                    document.body.appendChild(form);
                    form.method = 'post';
                    form.action = '../view/startTest.php';

                    var inputEmail = document.createElement('input');
                    inputEmail.type = 'hidden';
                    inputEmail.name = 'email';
                    inputEmail.value = '$email';
                    form.appendChild(inputEmail);

                    var inputTestId = document.createElement('input');
                    inputTestId.type = 'hidden';
                    inputTestId.name = 'test_id';
                    inputTestId.value = '$testId';
                    form.appendChild(inputTestId);

                    form.submit();
                });
              </script>";
        exit;
    } else {
        $emailError = "L'adresse e-mail '$email' n'existe pas. Veuillez créer un compte.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Choisir un Test</title>
    <style>
        form {
            width: 90%; /* Largeur du formulaire réduite */
            margin: 20px auto;
            padding: 20px;
            background-color: #edf0f5; /* Fond blanc */
            border-radius: 8px; /* Coins arrondis */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Ombre légère */
        }

        label, input, select, button {
            display: block;
            width: 100%;
            margin-top: 10px;
        }

        button {
            background-color: #4a90e2; /* Bleu vif */
            color: #fff;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 20px;
        }

        button:hover {
            background-color: #357ebd; /* Bleu légèrement plus foncé au survol */
        }
    </style>
</head>
<body>
    <h1>Choisir un Test</h1>
    <?php if (!empty($emailError)) echo "<p style='color: red;'>$emailError</p>"; ?>
    <form action="" method="POST">
        <label for="email">Votre email:</label>
        <input type="email" id="email" name="email" >

        <label for="tests">Test à passer:</label>
        <select id="tests" name="test_id" >
            <option value="">Sélectionnez un test</option>
            <?php foreach ($testOptions as $test) { ?>
                <option value="<?= htmlspecialchars($test['id_test']) ?>">
                    <?= htmlspecialchars($test['quiz_title']) . " - " . htmlspecialchars($test['cours']) ?>
                </option>
            <?php } ?>
        </select>
        <button type="submit">Commencer le Test</button>
    </form>
</body>
</html>