<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the EventModel file
require_once '../Model/eventModel.php';
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
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
                        <a href="../index.php" class="logo">EduTechHub</a>
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
                            <td> Name of the event : <?php echo htmlspecialchars($event['nom']); ?></td><br>
                                <td>Subject : <?php echo htmlspecialchars($event['sujet']); ?></td><br>
                                <td>Date : <?php echo htmlspecialchars($event['date']); ?></td><br>
                                <td>Location : <?php echo htmlspecialchars($event['lieu']); ?></td><br>
                                <td>Organizer : <?php echo htmlspecialchars($event['organizateur']); ?></td><br>
                                <td>Type : <?php echo htmlspecialchars($event['type']); ?></td><br>
                                <td>Fee : <?php echo htmlspecialchars($event['frais']); ?></td><br>
                                <td>Duration : <?php echo htmlspecialchars($event['duree']); ?></td><br>
                                <td>Max Participants Number : <?php echo htmlspecialchars($event['max']); ?></td><br>
                            </div>
                            <!-- Display the image -->
                            <div class="center-content">
                                <img src="../images/<?php echo $event['affiche']; ?>" alt="Event Image" style="max-width: 600px;">
                            </div>
                        </div>
                    </div>
                </div>
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
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="username" name="username">
                                </div>
                                
                                <button type="submit" class="btn btn-primary">Subscribe</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Scripts -->
    <!-- Bootstrap core JavaScript -->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
