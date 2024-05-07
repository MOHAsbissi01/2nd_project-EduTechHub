
<?php
require('fpdf.php'); // Include FPDF library
require('../config.php'); // Include your database configuration

 

// Create a new FPDF instance
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 50);  

 
$pdf->Cell(0, 35, 'EduTechHub', 0, 1, 'C'); // Centered company name
//name company bigger 
$pdf->SetFont('Arial', 'B', 16);
$pdf->Ln(20); // Add 10 units of space after the company name
$pdf->Cell(30, 0, 'Id_Recla', 0, 1, 'C');
// Add some space (adjust the value as needed)
$pdf->Ln(10); // Add 10 units of space after the title

// Set the colors for the text and background
$pdf->SetTextColor(0, 0, 0); // Black text
$pdf->SetFillColor(255, 255, 255); // White background

// Display data in a table (adjust column widths as needed)
$pdf->Cell(30, 10, 'ID', 1, 0, 'C', true);
$pdf->Cell(50, 10, 'Name', 1, 0, 'C', true);
$pdf->Cell(70, 10, 'Email', 1, 0, 'C', true);
 

try {
    // Get the PDO instance from the config class
    $pdo = config::getConnexion();

    $stmt = $pdo->prepare("SELECT id_recla , nom , email FROM reclamations ");
    $stmt->execute();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $pdf->Ln();
        $pdf->Cell(30, 10, $row['id_recla'], 1, 0, 'C');
        $pdf->Cell(50, 10, $row['nom'], 1, 0, 'C');
        $pdf->Cell(70, 10, $row['email'], 1, 0, 'C');
        // Display the actual user image (retrieve URL from database)
         
    }
    $pdf->Ln(20);
    // Call the footer function
    Footer();

    // Set the appropriate headers for download
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="edutechhub_report.pdf"'); // Specify the filename

    $pdf->Output();
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

function Footer()
{
    global $pdf;
    $pdf->SetTextColor(0, 0, 0); // Black text
    $pdf->SetFillColor(255, 255, 255); // White background

    // Customize the footer content (contact info)
    $footerText = 'Follow us  on Facebook: www.facebook.com/edutechhub ' ;
    $footerText = 'Email us  at : info@edutechhub.com';

    $pdf->Cell(0, 16, $footerText, 0, 1, 'C');
}
?>
