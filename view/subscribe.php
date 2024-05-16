<?php
require_once '../controller/eventController.php'; // Include the EventController class

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if event_id and email are set and not empty
    if (isset($_POST['event_id']) && isset($_POST['email'])) {
        $event_id = $_POST['event_id'];
        $emails = $_POST['email'];

        // Instantiate the EventController
        $eventController = new EventController();

        // Subscribe each participant to the event
        $success = $eventController->subscribeEvent($event_id, $emails);

        if ($success === true) {
            // Subscription successful
            echo "<script>alert('You have successfully subscribed to the event.'); window.location.href = '../index.php'; </script>";

        } else {
            // Subscription failed due to non-existing email
            echo "<script>alert('Failed to subscribe to the event.'); window.location.href = '../index.php'; </script>";
        }
    } else {
        // Required fields are missing or empty
        echo "<script>alert('Email is required.'); window.location.href = '../index.php'; </script>";
    }
}
?>