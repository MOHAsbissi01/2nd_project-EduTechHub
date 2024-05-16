<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the EventModel file
require_once '../Model/eventModel.php';
require_once '../db.php';

// Create an instance of the EventModel class
$eventModel = new EventModel();

// Get events from the database
$events = $eventModel->getEvents()->fetchAll(PDO::FETCH_ASSOC); //
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="shortcut icon" type="image/x-icon" href="../logo.ico" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Education - List of Events</title>
    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="../assets/css/fontawesome.css">
    <link rel="stylesheet" href="../assets/css/templatemo-edu-meeting.css">
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
                            <li><a href="index-.php">Home</a></li>
                            <li><a href="events.php" class="active">Events</a></li>
                            <li><a href="index-.php">Apply Now</a></li>
                            <li class="has-sub">
                                <a href="javascript:void(0)">Pages</a>
                                <ul class="sub-menu">
                                    <li><a href="events.php">Upcoming Events</a></li>
                                    <li><a href="events-details.php">Events Details</a></li>
                                </ul>
                            </li>
                            <li><a href="index-.php">Courses</a></li>
                            <li><a href="index-.php">Contact Us</a></li>
                            <li><a href="../indexD.php">ADMIN</a></li>
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
                    <h6>Here are our upcoming Events</h6>
                    <h2>Upcoming Events</h2>
                </div>
            </div>
        </div>
    </section>
    <!-- Main content -->
    <section class="events">
        <div class="container">
            <h1 class="text-center mb-5">Upcoming Events</h1>
            <div class="row">
                <!-- Loop through events and display dynamically -->
                <?php if ($events && count($events) > 0) : ?>
    <?php foreach ($events as $event) : ?>
        <div class="col-lg-4 mb-4">
            <div class="card h-100">

                <div class="card-body">
                    
                    <?php if (isset($event['nom'])) : ?>
                        <h5 class="card-title"><?= htmlspecialchars($event['nom']) ?></h5>
                    <?php else : ?>
                        <h5 class="card-title">Name not provided</h5>
                    <?php endif; ?>
                    <p class="card-text"><strong>Date:</strong> <?= htmlspecialchars($event['date'] ?? 'Date not provided') ?></p>
                    <?php if (isset($event['lieu'])) : ?>
                        <p class="card-text"><strong>Location:</strong> <?= htmlspecialchars($event['lieu']) ?></p>
                    <?php else : ?>
                        <p class="card-text"><strong>Location:</strong> Location not provided</p>
                    <?php endif; ?>
                    <a href="event-details.php?id=<?= $event['id'] ?>" class="btn btn-primary">View Details</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php else : ?>
    <div class="col-lg-12">
        <p>No events found.</p>
    </div>
<?php endif; ?>



            </div>
        </div>
    </section>
    <!-- Scripts -->
    <!-- Bootstrap core JavaScript -->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
