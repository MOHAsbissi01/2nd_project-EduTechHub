<?php
require_once '../Controller/TestController.php';
echo "<pre>";
print_r($_POST);
echo "</pre>";

$controller = new TestController();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['quiz_title']) && !empty($_POST['questions'])) {
    $quizTitle = $_POST['quiz_title'];
    $questions = $_POST['questions'];
    $testId = $controller->createTest($quizTitle, $questions);
} else {
    echo "Veuillez remplir tous les champs requis et sélectionner au moins une question.";
}

    
    // Redirection vers la liste des tests après création
    header("Location: listTests.php?success=1&test_id=$testId");
    exit;
 else {
    echo "Veuillez remplir tous les champs requis et sélectionner au moins une question.";
}
?>
