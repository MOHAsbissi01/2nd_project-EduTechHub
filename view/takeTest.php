<?php
require_once '../Controller/TestController.php';
$controller = new TestController();
$testOptions = $controller->getTestTitlesForDropdown();
?>
<!DOCTYPE html>
<style>
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

</style>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="image/x-icon" href="logo.ico" />
    <title>Choisir un Test</title>    
    <script>
        function validateForm() {
            var username = document.getElementById("username").value;
            var pattern = /^[A-Za-z0-9_-]{3,16}$/;
            if (!pattern.test(username)) {
                alert("Le pseudo doit avoir entre 3 et 16 caractères et peut seulement contenir des lettres, des chiffres, des tirets et des underscores.");
                return false;
            }
            return true;
        }

        function updateTestId() {
            var selectTest = document.getElementById("tests");
            var testIdInput = document.getElementById("test_id");
            var selectedTestId = selectTest.value;
            testIdInput.value = selectedTestId;
        }
    </script>
</head>
<body>
    
    <h1>Choisir un Test</h1>
    <form action="../view/startTest.php" method="POST" onsubmit="return validateForm()">
        <label for="username">Votre nom d'utilisateur:</label>
        <input type="text" id="username" name="username"><br>

        <label for="tests">Test à passer:</label>
        <select id="tests" name="test_id" onchange="updateTestId()" required>
    <option value="">Sélectionnez un test</option>
    <?php foreach ($testOptions as $test) { ?>
        <option value="<?= htmlspecialchars($test['id_test']) ?>">
            <?= htmlspecialchars($test['quiz_title']) ?> - <?= htmlspecialchars($test['cours']) ?>
        </option>
    <?php } ?>
</select><br>
    <form>
        <button type="submit">Commencer le Test</button>
    </form>
</body>
</html>
