<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
</head>
<body>
    <h1>Liste des Tests</h1>
    <?php
        require_once '../Controller/TestController.php';
        $controller = new TestController();
        $tests = $controller->getAllTests();
        foreach ($tests as $test) {
            echo "<div><h2>Test ID: {$test['id_test']} - Utilisateur: {$test['utilisateur']} - Note: {$test['note_obtenue']} - Quiz: {$test['quiz_title']}</h2></div>";
        }
    ?>
</body>
</html>
