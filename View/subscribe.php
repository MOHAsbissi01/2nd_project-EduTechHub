<?php
require_once '../Controller/eventController.php'; // Include the EventController class

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if event_id and username are set
    if (isset($_POST['event_id']) && isset($_POST['username'])) {
        // Sanitize input
        $event_id = $_POST['event_id'];
        $username = $_POST['username'];

        // Instantiate the EventController
        $eventController = new EventController();

        // Subscribe the user to the event
        $success = $eventController->subscribeEvent($event_id, $username);

        if ($success) {
            // Subscription successful
            echo "You have successfully subscribed to the event.";
        } else {
            // Subscription failed
            echo "Failed to subscribe to the event.";
        }
    } else {
        // Required fields are missing
        echo "Event ID and username are required.";
    }
} else {
    // If the form is not submitted, redirect back to the page
    header("Location: index.php");
    exit;
}
?>
