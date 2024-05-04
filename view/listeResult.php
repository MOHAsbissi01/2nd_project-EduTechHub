<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Résultats des Tests</title>
    <h1>Statistiques des Tests</h1>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Inclure Chart.js via une CDN -->
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

        canvas {
            margin-top: 5px; /* Ajouter un peu d'espace au-dessus du graphique */
            max-width: 50%; /* Définir une largeur maximale pour le graphique */
            height: auto; /* Permettre à la hauteur de s'ajuster automatiquement */
        }

    </style>
</head>
<header><img src="..\assets\logo.png" alt="Logo" width="150" height="150"></header>
<body>
<canvas id="testResultsChart" width="400" height="400"></canvas>
    <h1>Résultats des Tests</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Quiz Title</th>
                <th>Cours Associé</th>
                <th>Nom d'utilisateur</th>
                <th>Score</th>
                <th>Total Questions</th>
                <th>Date</th>
                <th>Statut de réussite</th>
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

    // Obtenir le titre du cours associé à ce test
    $stmtCoursTitle = $db->prepare("SELECT c.titre FROM cours c JOIN cours_test ct ON c.id_cours = ct.cours_id WHERE ct.test_id = ?");
    $stmtCoursTitle->execute([$testId]);
    $coursTitle = $stmtCoursTitle->fetch(PDO::FETCH_ASSOC)['titre'];

    // Obtenir le nombre total de questions pour ce test
    $stmtTotal = $db->prepare("SELECT COUNT(*) AS total FROM test_question WHERE test_id = ?");
    $stmtTotal->execute([$testId]);
    $totalQuestions = $stmtTotal->fetch(PDO::FETCH_ASSOC)['total'];

    // Calcul du pourcentage de réussite
    $scorePercentage = ($row['score'] / $totalQuestions) * 100;

    // Déterminer si le test est réussi ou non
    $result = ($scorePercentage >= 50) ? 'Réussi' : 'Échoué';
    ?>
    <tr>
        <td><?= htmlspecialchars($row['id']) ?></td>
        <td><?= htmlspecialchars($quizTitle) ?></td>
        <td><?= htmlspecialchars($coursTitle) ?></td>
        <td><?= htmlspecialchars($row['username']) ?></td>
        <td><?= htmlspecialchars($row['score']) ?></td>
        <td><?= htmlspecialchars($totalQuestions) ?></td>
        <td><?= htmlspecialchars($row['created_at']) ?></td>
        <td><?= $result ?></td> <!-- Afficher le résultat de l'examen -->
    </tr>
<?php } ?>


        </tbody>
    </table>
    <script>
        // Récupération du nombre total de tests
        var totalTests = document.querySelectorAll('tbody tr').length;

        // Calcul des pourcentages de réussite et d'échec
        var successCount = 0;
        var failureCount = 0;
        var tableRows = document.querySelectorAll('tbody tr');

        tableRows.forEach(function(row) {
            var resultCell = row.cells[row.cells.length - 1];
            var result = resultCell.textContent.trim();
            if (result === 'Réussi') {
                successCount++;
            } else if (result === 'Échoué') {
                failureCount++;
            }
        });

        var successPercentage = (successCount / totalTests) * 100;
        var failurePercentage = (failureCount / totalTests) * 100;

        // Données pour le graphique
        var data = {
            labels: ["Réussi", "Échoué"],
            datasets: [{
                data: [successPercentage, failurePercentage],
                backgroundColor: ["#36a2eb", "#ff6384"] // Couleurs des sections du graphique
            }]
        };

// Options du graphique
var options = {
    responsive: true,
    tooltips: {
        callbacks: {
            label: function(tooltipItem, data) {
                var dataset = data.datasets[tooltipItem.datasetIndex];
                var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {
                    return previousValue + currentValue;
                });
                var currentValue = dataset.data[tooltipItem.index];
                var percentage = Math.round((currentValue / total) * 100);
                return percentage + "%";
            }
        }
    }
};

        // Obtenez le contexte du canvas
        var ctx = document.getElementById('testResultsChart').getContext('2d');

        // Créez un graphique circulaire
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: data,
            options: options
        });
    </script>
</body>
</html>
