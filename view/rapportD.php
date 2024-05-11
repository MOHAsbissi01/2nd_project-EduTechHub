<?php
require('../model/fpdf.php'); // Include FPDF library
require('../model/config.php'); // Include your database configuration

class PDF extends FPDF
{
    // Page header
    function Header()
    {
        $this->SetFillColor(204, 229, 255);
        //   background 
        $this->Rect(0, 0, $this->w, $this->h, 'F');

         
        $this->SetFont('Arial', 'B', 50);
        $this->Image('../uploaded_img/11.png', 80, 5, 50); // Adjust X, Y, and size as needed
        $this->Ln(60); // Add 10 units of space after the image
        $this->Cell(0, 35, 'EduTechHub', 0, 1, 'C');
        $this->SetFont('Arial', 'B', 16);
        $this->Ln(20);
        $this->Cell(30, 0, 'Users', 0, 1, 'C');
        $this->Ln(10);
    }

    // Page footer
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Follow us on Facebook: www.facebook.com/edutechhub', 0, 0, 'C');
        $this->Ln(5);
        $this->Cell(0, 10, 'Email us at : info@edutechhub.com', 0, 0, 'C');
    }
}

// Create a new PDF instance
$pdf = new PDF();
$pdf->AddPage();

$pdf->SetTextColor(0, 0, 0); 
$pdf->SetFillColor(255, 255, 255); 

$pdf->Cell(30, 10, 'ID', 1, 0, 'C', true);
$pdf->Cell(50, 10, 'Name', 1, 0, 'C', true);
$pdf->Cell(70, 10, 'Email', 1, 0, 'C', true);
$pdf->Cell(40, 10, 'Image', 1, 1, 'C', true);

try {
    $pdo = config::getConnexion();
    $stmt = $pdo->prepare("SELECT id, name, email, image FROM users");
    $stmt->execute();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $pdf->Ln();
        $pdf->Cell(30, 10, $row['id'], 1, 0, 'C');
        $pdf->Cell(50, 10, $row['name'], 1, 0, 'C');
        $pdf->Cell(70, 10, $row['email'], 1, 0, 'C');
        $pdf->Cell(40, 10, 'User Image', 1, 1, 'C');
    }

    $pdf->Ln(20);

    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="edutechhub_report.pdf"');

    $pdf->Output();
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
