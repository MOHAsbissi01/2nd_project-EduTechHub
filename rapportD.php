<?php
require('model/fpdf.php'); // Include FPDF library
require('model/config.php'); // Include your database configuration

// Create a new FPDF instance
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 50);  

// Add the logo and company name at the top
$pdf->Image('uploaded_img/11.png', 75, 5, 70); // Adjust X, Y, and size as needed
$pdf->Ln(100); // Add 10 units of space after the image

$pdf->Cell(0, 35, 'EduTechHub', 0, 1, 'C'); // Centered company name
//name company bigger 
$pdf->SetFont('Arial', 'B', 16);
$pdf->Ln(20); // Add 10 units of space after the company name
$pdf->Cell(30, 0, 'Users', 0, 1, 'C');
// Add some space (adjust the value as needed)
$pdf->Ln(10); // Add 10 units of space after the title

// Set the colors for the text and background
$pdf->SetTextColor(0, 0, 0); // Black text
$pdf->SetFillColor(255, 255, 255); // White background

// Display data in a table (adjust column widths as needed)
$pdf->Cell(30, 10, 'ID', 1, 0, 'C', true);
$pdf->Cell(50, 10, 'Name', 1, 0, 'C', true);
$pdf->Cell(70, 10, 'Email', 1, 0, 'C', true);
$pdf->Cell(40, 10, 'Image', 1, 1, 'C', true);

try {
    // Get the PDO instance from the config class
    $pdo = config::getConnexion();

    $stmt = $pdo->prepare("SELECT id, name, email, image FROM users");
    $stmt->execute();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $pdf->Ln();
        $pdf->Cell(30, 10, $row['id'], 1, 0, 'C');
        $pdf->Cell(50, 10, $row['name'], 1, 0, 'C');
        $pdf->Cell(70, 10, $row['email'], 1, 0, 'C');
        // Display the actual user image (retrieve URL from database)
        $pdf->Cell(40, 10, 'User Image', 1, 1, 'C');
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
