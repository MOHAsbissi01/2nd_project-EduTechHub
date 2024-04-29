<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Résultats des Tests</title>
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

        .total-column {
            background-color: #4a90e2; /* Bleu vif */
            color: #fff;
            font-weight: bold;
        }

    </style>
</head>
<header><img src="..\assets\logo.png" alt="Logo" width="150" height="150"></header>
<body>
    <h1>Résultats des Tests</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Quiz Title</th>
                <th>Nom d'utilisateur</th>
                <th>Score</th>
                <th>Total Questions</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require_once '../config.php';
            $db = config::getConnexion();
            $stmt = $db->query("SELECT * FROM test_results");
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $testId = $row['test_id'];
                // Obtenir le titre du quiz associé à ce test
                $stmtQuizTitle = $db->prepare("SELECT quiz_title FROM test WHERE id_test = ?");
                $stmtQuizTitle->execute([$testId]);
                $quizTitle = $stmtQuizTitle->fetch(PDO::FETCH_ASSOC)['quiz_title'];
                // Obtenir le nombre total de questions pour ce test
                $stmtTotal = $db->prepare("SELECT COUNT(*) AS total FROM test_question WHERE test_id = ?");
                $stmtTotal->execute([$testId]);
                $totalQuestions = $stmtTotal->fetch(PDO::FETCH_ASSOC)['total'];
                ?>
                <tr>
                    <td><?= htmlspecialchars($row['id']) ?></td>
                    <td><?= htmlspecialchars($quizTitle) ?></td>
                    <td><?= htmlspecialchars($row['username']) ?></td>
                    <td><?= htmlspecialchars($row['score']) ?></td>
                    <td><?= htmlspecialchars($totalQuestions) ?></td>
                    <td><?= htmlspecialchars($row['created_at']) ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
