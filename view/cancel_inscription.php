<?php
// Include the EventModel file
require_once '../Model/eventModel.php';
require_once '../db.php';

// Check if inscription ID is provided and not empty
if(isset($_POST['inscription_id']) && !empty($_POST['inscription_id'])) {
    $inscriptionId = $_POST['inscription_id'];

    // Create an instance of the EventModel class
    $eventModel = new EventModel();

    // Check if the inscription ID exists
    if($eventModel->inscriptionExists($inscriptionId)) {
        // Call the method to cancel the inscription
        $result = $eventModel->cancelInscription($inscriptionId);

        if($result) {
            echo "<script>alert('Inscription canceled successfully.'); window.location.href = 'index-.php'; </script>";
        } else {
            echo "<script>alert('Failed to cancel inscription.'); window.location.href = 'index-.php'; </script>";
        }
    } else {
        // Display alert message if inscription ID doesn't exist
        echo "<script>alert('Inscription ID does not exist.'); window.location.href = 'index-.php'; </script>";
    }
} else {
    // Display alert message if inscription ID is empty
    echo "<script>alert('Please enter the Inscription ID.'); window.location.href = 'index-.php'; </script>";
}
?>

