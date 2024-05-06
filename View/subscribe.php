<?php
require_once '../Controller/eventController.php'; // Include the EventController class

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if event_id, username, email, and places are set and not empty
// Check if event_id, username, and email are set and not empty
if (isset($_POST['event_id']) && isset($_POST['username']) && isset($_POST['email'])) {
    $event_id = $_POST['event_id'];
    $usernames = $_POST['username'];
    $emails = $_POST['email'];

    // Instantiate the EventController
    $eventController = new EventController();

    // Subscribe each participant to the event
    $success = true;
    foreach ($usernames as $index => $username) {
        $email = $emails[$index];
        $result = $eventController->subscribeEvent($event_id, $username, $email);
        if (!$result) {
            $success = false;
            break; // Stop processing if any subscription fails
        }
    }

    if ($success) {
        // Subscription successful
        echo "<script>alert('You have successfully subscribed to the event.'); window.location.href = '../index.php'; </script>";
    } else {
        // Subscription failed
        echo "<script>alert('Failed to subscribe to the event Max Number of Participants reached.'); window.location.href = '../index.php'; </script>";
    }
} else {
    // Required fields are missing or empty
    echo "<script>alert('username and email are required.'); window.location.href = '../index.php'; </script>";
}


}

?>
