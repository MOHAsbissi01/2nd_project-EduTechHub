<?php
require_once '../Controller/eventController.php'; // Include the EventController class

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if event_id and username are set and not empty
    if (isset($_POST['event_id']) && isset($_POST['username']) && !empty($_POST['username'])) {
        // Sanitize input
        $event_id = $_POST['event_id'];
        $username = $_POST['username'];

        // Instantiate the EventController
        $eventController = new EventController();

        // Subscribe the user to the event
        $success = $eventController->subscribeEvent($event_id, $username);

        if ($success) {
            // Subscription successful
            echo "<script>alert('You have successfully subscribed to the event.'); setTimeout(function() { window.location.href = '../index.php'; }, 1000);</script>";
        } else {
            // Subscription failed
            echo "<script>alert('Failed to subscribe to the event Max Number of Participants reached.'); setTimeout(function() { window.location.href = '../index.php'; }, 1000);</script>";
        }
    } else {
        // Required fields are missing or empty
        echo "<script>alert('username is required.'); setTimeout(function() { window.location.href = '../index.php'; }, 1000);</script>";
    }
}
?>