<?php
require_once '../Controller/TestController.php';
$controller = new TestController();

if (isset($_GET['test_id']) && !empty($_GET['test_id'])) {
    $controller->deleteTest($_GET['test_id']);
    header("Location: ../2nd_project-EduTechHub/testD.php ? message=Test+supprimé+avec+succès");
    exit;
} else {
    echo "Identifiant du test non fourni.";
}
?>