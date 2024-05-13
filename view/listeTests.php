<?php
require_once '../Controller/TestController.php';
$controller = new TestController();
$tests = $controller->getAllTests();
?>
<!DOCTYPE html>
<html lang="fr">
<header>
    <img src="../assets/logo.png" alt="Logo" width="150" height="150">
</header>
<head>
    <meta charset="UTF-8">
    <title>Liste des Tests</title>
    <link rel="stylesheet" href="styles.css"> <!-- Inclure le fichier CSS -->
</head>
<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    th, td {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    th {
        background-color: #f2f2f2;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }
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
<body>
    <h1>Liste des Tests</h1>
    <table>
        <thead>
            <tr>
                <th>Titre du Test</th>
                <th>Document associé au Test</th>
                <th>Questions</th>
                <th>Options</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($tests && !empty($tests)) : ?>
                <?php foreach ($tests as $test) : ?>
                    <tr>
                        <td><?= htmlspecialchars($test['quiz_title']) ?></td>
                        <td><?= htmlspecialchars($test['cours']) ?></td>
                        <td><?= htmlspecialchars($test['questions']) ?></td>
                        <td><?= htmlspecialchars($test['options']) ?></td>
                        <td>
                            <button><a href="../view/editTest.php?test_id=<?= $test['id_test'] ?>" style="text-decoration: none; color: inherit;">Modifier</a></button> | 
                            <button><a href="../view/deleteTest.php?test_id=<?= $test['id_test'] ?>" style="text-decoration: none; color: inherit;">Supprimer</a></button> |
                            <button onclick="window.open('../view/printTest.php?test_id=<?= $test['id_test'] ?>')">Imprimer</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr><td colspan="5">Aucun test trouvé.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
