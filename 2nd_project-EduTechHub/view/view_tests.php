<?php
// Inclure le contrôleur des tests
require_once('../controller/TestController.php');
require_once('../Model/TestModel.php');


// Instancier le contrôleur des tests
$testController = new TestController();

// Récupérer les tests avec leurs questions associées
$tests = $testController->showAllTests();

// Vérifier si des tests ont été trouvés
if ($tests) {
    // Afficher les tests avec leurs questions
    foreach ($tests as $test) {
        // Afficher les détails du test
        echo "Test ID: " . $test['id_test'] . "<br>";
        echo "User: " . $test['reponse_utilisateur'] . "<br>";
        echo "Score: " . $test['note_obtenue'] . "<br>";

        // Afficher les questions du test
        echo "<ul>";
        foreach ($test['questions'] as $question) {
            echo "<li>" . $question['question_text'] . "</li>";
            echo "<ul>";
            echo "<li>Option 1: " . $question['option_1'] . "</li>";
            echo "<li>Option 2: " . $question['option_2'] . "</li>";
            echo "<li>Option 3: " . $question['option_3'] . "</li>";
            echo "<li>Correct Option: " . $question['correct_option'] . "</li>";
            echo "</ul>";
        }
        echo "</ul>";
        echo "<hr>";
    }
} else {
    // Aucun test trouvé
    echo "Aucun test disponible pour le moment.";
}
?>
