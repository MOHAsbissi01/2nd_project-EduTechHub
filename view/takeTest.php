<?php
require_once '../Controller/TestController.php';
$controller = new TestController();
$testOptions = $controller->getTestTitlesForDropdown();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="image/x-icon" href="logo.ico" />
    <title>Choisir un Test</title>    <script>
        function validateForm() {
            var username = document.getElementById("username").value;
            var pattern = /^[A-Za-z0-9_-]{3,16}$/;
            if (!pattern.test(username)) {
                alert("Le pseudo doit avoir entre 3 et 16 caractères et peut seulement contenir des lettres, des chiffres, des tirets et des underscores.");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <h1>Choisir un Test</h1>
    <form action="../view/startTest.php" method="POST" onsubmit="return validateForm()">
        <label for="username">Votre nom d'utilisateur:</label>
        <input type="text" id="username" name="username"><br>

        <label for="test_id">Sélectionner un test:</label>
        <select id="test_id" name="test_id" required>
        <?php foreach ($testOptions as $test) { ?>
            <option value="<?= htmlspecialchars($test['id_test']) ?>"><?= htmlspecialchars($test['quiz_title']) ?></option>
        <?php } ?>
        </select><br>

        <button type="submit">Commencer le Test</button>
    </form>
</body>
</html>