<?php
require_once '../Controller/TestController.php';
require_once '../fpdf/fpdf.php'; // Assurez-vous que le chemin est correct

$controller = new TestController();

if (!isset($_GET['test_id']) || empty($_GET['test_id'])) {
    die("Identifiant du test non spécifié.");
}

$test = $controller->getTestDetails($_GET['test_id']);
if (!$test) {
    die("Test introuvable.");
}

ob_start(); // Démarre le tamponnage de sortie

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

// Ajouter un logo
$pdf->Image('../assets/logo.png', 10, 10, 30);
$pdf->Ln(30); // Augmenter l'espace après le logo

// Ajouter le titre du hub éducatif
$pdf->Cell(0, 10, 'EduTechHub', 0, 1, 'C');

// Subtitre pour les détails du test
$pdf->SetFillColor(200, 220, 255); // Bleu clair pour le fond du titre
$pdf->Cell(0, 10, utf8_decode('Détails du Test'), 0, 1, 'C', true);

// Informations de base
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, utf8_decode('Titre du Test : ') . utf8_decode($test->getQuizTitle()), 0, 1);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, utf8_decode('Cours Associés : ') . utf8_decode(implode(', ', $test->getCours2())), 0, 1);

// Affichage des questions
$pdf->SetFont('Arial', 'I', 14);
$pdf->Cell(0, 10, utf8_decode('Questions :'), 0, 1);
foreach ($controller->getQuestionsForTest($test->getIdTest()) as $question) {
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 10, utf8_decode($question['question_text']), 0, 1);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(0, 10, utf8_decode('Options : '), 0, 1);
    foreach (['option_1', 'option_2', 'option_3'] as $option) {
        $pdf->Cell(10);
        $pdf->Cell(0, 10, utf8_decode($question[$option]), 0, 1);
    }
    $pdf->SetTextColor(0, 150, 0); // Vert pour la réponse correcte
    $pdf->Cell(0, 10, utf8_decode('Option correcte : ' . $question['correct_option']), 0, 1);
    $pdf->SetTextColor(0); // Reset la couleur
}

ob_end_clean(); // Nettoie le tampon et arrête le tamponnage de sortie
$pdf->Output(); // Envoie le PDF au navigateur
exit;
?>
