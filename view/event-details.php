<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the EventModel file
require_once '../model/eventModel.php';
require_once '../db.php';

// Check if the event ID is provided in the URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    // Redirect the user to events.php if the ID is not provided
    header("Location: events.php");
    exit;
}

// Create an instance of the EventModel class
$eventModel = new EventModel();

// Get the event details from the database based on the ID
$eventId = $_GET['id'];
$event = $eventModel->getEventById($eventId);

// If the event is not found, redirect the user to events.php
if (!$event) {
    header("Location: events.php");
    exit;
}
$participants = $eventModel->getParticipantsByEventId($eventId);

// Get participants for the event
$participants = $eventModel->getParticipantsByEventId($eventId);

// Get the maximum number of participants allowed for the event
$maxParticipants = $event['max'];

// Check if the maximum number of participants is reached
$maxParticipantsReached = count($participants) >= $maxParticipants;

?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="shortcut icon" type="image/x-icon" href="../logo.ico" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Education - Event Details</title>
    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="../assets/css/fontawesome.css">
    <link rel="stylesheet" href="../assets/css/templatemo-edu-meeting.css">
    <style>
        /* Custom CSS to center content */
        .center-content {
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
    </style>
</head>
<body>
    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <a href="index-.php" class="logo">EduTechHub</a>
                        <ul class="nav">
                            <!-- Add your navigation links here -->
                        </ul>
                        <a class='menu-trigger'><span>Menu</span></a>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->
    <section class="heading-page header-text" id="top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h6>Event Details</h6>
                    <!-- Display the event name as the page title -->
                    <h2><?= htmlspecialchars($event['nom']) ?></h2>
                </div>
            </div>
        </div>
    </section>
    <!-- Main content -->
    <section class="events">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card h-100">
                        <div class="card-body center-content">
                            <!-- Display event details -->
                            <div class="center-content">
    <div style="font-size: 20px;">
        <p><strong>Name of the event:</strong> <?php echo htmlspecialchars($event['nom']); ?></p>
        <p><strong>Subject:</strong> <?php echo htmlspecialchars($event['sujet']); ?></p>
        <p><strong>Date:</strong> <?php echo htmlspecialchars($event['date']); ?></p>
        <p><strong>Location:</strong> <?php echo htmlspecialchars($event['lieu']); ?></p>
        <p><strong>Organizer:</strong> <?php echo htmlspecialchars($event['organizateur']); ?></p>
        <p><strong>Type:</strong> <?php echo htmlspecialchars($event['type']); ?></p>
        <p><strong>Fee:</strong> <?php echo htmlspecialchars($event['frais']); ?></p>
        <p><strong>Duration:</strong> <?php echo htmlspecialchars($event['duree']); ?></p>
        <p><strong>Max Participants Number:</strong> <?php echo htmlspecialchars($event['max']); ?></p>
    </div>
</div>

                            <!-- Display the image -->
                            <div class="center-content">
                                <img src="../images/<?php echo $event['affiche']; ?>" alt="Event Image" style="max-width: 600px;">
                            </div>
                            
                        </div>
                    </div>
                    
                </div>
                
            </div>
            <br>
            <br>
            <br>
<!-- Display participants -->
<div class="center-content">
    <h3>Participants</h3>
    <?php if (!empty($participants)) : ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Inscription ID</th>
                    <th>User Name</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($participants as $participant) : ?>
                    <tr>
                        <td><?= htmlspecialchars($participant['inscription_id']) ?></td>
                        <td><?= htmlspecialchars($participant['user_name']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>No participants subscribed to this event.</p>
    <?php endif; ?>
</div>


<div class="col-lg-6">
                    <!-- Display error message if max participants reached -->
                    <?php if ($maxParticipantsReached) : ?>
                        <div class="alert alert-danger" role="alert">
                            Maximum number of participants reached. Subscription closed.
                        </div>
                    <?php endif; ?>
                    </div>
           <!-- Subscription form -->
<div class="row justify-content-center mt-5">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Subscribe to Event</h5>
                <form action="subscribe.php" method="post">
    <input type="hidden" name="event_id" value="<?= $eventId ?>">
    <div class="mb-3">
        <label for="email1" class="form-label">Email 1</label>
        <input type="email" class="form-control" id="email1" name="email[]" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" title="Enter a valid email address" required>
    </div>
    <div class="additional-participants"></div>
    <button type="button" class="btn btn-secondary add-participant">Add another Participant</button>
    <button type="submit" class="btn btn-primary">Subscribe</button>
</form>

            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Cancel Inscription</h5>
                <form action="cancel_inscription.php" method="POST">
                    <div class="mb-3">
                        <label for="inscription_id" class="form-label">Enter Inscription ID:</label>
                        <input type="text" class="form-control" id="inscription_id" name="inscription_id" required>
                    </div>
                    <button type="submit" class="btn btn-danger">Cancel Inscription</button>
                </form>
    </div>
</div>
</div>
    </div>

    <script>
document.addEventListener('DOMContentLoaded', function() {
    var addButton = document.querySelector('.add-participant');
    var additionalParticipants = document.querySelector('.additional-participants');

    var count = 1; // Start with 1 to match the initial fields

    addButton.addEventListener('click', function() {
        count++;
        var div = document.createElement('div');
        div.innerHTML = `
            <div class="mb-3">
                <label for="email${count}" class="form-label">Email ${count}</label>
                <input type="email" class="form-control" id="email${count}" name="email[]">
            </div>
        `;
        additionalParticipants.appendChild(div);
    });
});

document.addEventListener('DOMContentLoaded', function() {
    var subscribeForm = document.querySelector('form[action="subscribe.php"]');
    subscribeForm.addEventListener('submit', function(event) {
        var emails = document.querySelectorAll('input[name="email[]"]');
        var isValid = true;

        // Validate emails
        emails.forEach(function(emailInput) {
            if (!emailInput.checkValidity()) {
                isValid = false;
                alert("Please enter a valid email address.");
            }
        });

        if (!isValid) {
            event.preventDefault(); // Prevent form submission if inputs are invalid
        }
    });
});
</script>

</body>
</html>