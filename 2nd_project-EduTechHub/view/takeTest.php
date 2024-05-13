<?php
require_once '../Controller/TestController.php';
$controller = new TestController();
$testOptions = $controller->getTestTitlesForDropdown();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Choisir un Test</title>
</head>
<body>
    <h1>Choisir un Test</h1>
    <form action="startTest.php" method="POST">
        <label for="username">Votre nom d'utilisateur:</label>
        <input type="text" id="username" name="username" required><br>

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
