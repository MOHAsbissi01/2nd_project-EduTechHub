<?php
// Include the TCPDF library
require_once('../TCPDF-main/tcpdf.php');

// Include the EventModel file
require_once '../Model/eventModel.php';

// Check if the event ID is provided in the URL
if (!isset($_GET['eventId']) || empty($_GET['eventId'])) {
    // Redirect the user to eventslist.php if the ID is not provided
    header("Location: eventslist.php");
    exit;
}

// Create an instance of the EventModel class
$eventModel = new EventModel();

// Get the event details from the database based on the ID
$eventId = $_GET['eventId'];
$event = $eventModel->getEventById($eventId);

// If the event is not found, redirect the user to eventslist.php
if (!$event) {
    header("Location: eventslist.php");
    exit;
}

// Create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Dhia Mouha');
$pdf->SetTitle('Event Details');
$pdf->SetSubject('Event Details');
$pdf->SetKeywords('Event, Details, PDF');

// Set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// Set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// Set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// Set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// Set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// Set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// Set font
$pdf->SetFont('helvetica', 'B', 20);

// Add a page
$pdf->AddPage();

// Content
$html = '<h1>Event Details</h1>';
$html .= '<p><strong>Name:</strong> ' . htmlspecialchars($event['nom']) . '</p>';
$html .= '<p><strong>Subjet:</strong> ' . htmlspecialchars($event['sujet']) . '</p>';
$html .= '<p><strong>Date:</strong> ' . htmlspecialchars($event['date']) . '</p>';
$html .= '<p><strong>Location:</strong> ' . htmlspecialchars($event['lieu']) . '</p>';
$html .= '<p><strong>Organizer:</strong> ' . htmlspecialchars($event['organizateur']) . '</p>';
$html .= '<p><strong>Type:</strong> ' . htmlspecialchars($event['type']) . '</p>';
$html .= '<p><strong>Fee:</strong> ' . htmlspecialchars($event['frais']) . '</p>';
$html .= '<p><strong>Duration:</strong> ' . htmlspecialchars($event['duree']) . '</p>';
$html .= '<p><strong>Max Number of Participants:</strong> ' . htmlspecialchars($event['max']) . '</p>';
$html .= '<p><strong>Event Image:</strong> <img src="../images/' . $event['affiche'] . '" alt="Event Image" style="max-width: 150px;"></p>';

if (!empty($participants)) {
    $html .= '<h2>Participants</h2>';
    $html .= '<ul>';
    foreach ($participants as $participant) {
        $html .= '<li>' . htmlspecialchars($participant['user_name']) . '</li>';
    }
    $html .= '</ul>';
}
// Output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// Close and output PDF document
ob_end_clean();
$pdf->Output('event_details.pdf', 'I');
?>