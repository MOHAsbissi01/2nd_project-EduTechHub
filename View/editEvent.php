<?php
require_once '../Model/EventModel.php';
require_once '../Controller/EventController.php';

$eventModel = new EventModel();
$eventController = new EventController();

$eventId = isset($_GET['eventId']) ? $_GET['eventId'] : null;
$event = null;

// Fetch event data to edit
if ($eventId) {
    $event = $eventModel->getEventById($eventId);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'updateEvent') {
    // Get the event ID from the URL
    $eventId = $_GET['eventId'];
    
    // Get form data
    $nom = $_POST['nom'];
    $sujet = $_POST['sujet'];
    $date = $_POST['date'];
    $lieu = $_POST['lieu'];
    $organizateur = $_POST['organizateur'];
    $affiche = $_POST['affiche'];
    $type = $_POST['type'];
    $frais = $_POST['frais'];
    $duree = $_POST['duree'];
    $max = $_POST['max'];

    
    // Call the updateEvent method from the EventController
    $result = $eventController->updateEvent($eventId, $nom, $sujet, $date, $lieu, $organizateur, $affiche, $type, $frais, $duree, $max);
    if ($result === true) {
        header('Location: eventslist.php'); // Redirect on success
        exit;
    } else {
        echo "<script>alert('An error occurred while updating.')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Event</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="../cssD/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../cssD/style.css">
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Event</div>
                <div class="card-body">
                    <?php if ($event): ?>
                        <form id="eventForm" action="editevent.php?eventId=<?php echo htmlspecialchars($eventId); ?>" method="post">
                            <div class="mb-3">
                                <label for="nom" class="form-label">Event Name:</label>
                                <input type="text" id="nom" name="nom" class="form-control" value="<?php echo htmlspecialchars($event['nom']); ?>" required>
                                <div id="nomError" class="error-message">Event Name is required</div>
                            </div>
                            <div class="mb-3">
                                <label for="sujet" class="form-label">Subject:</label>
                                <input type="text" id="sujet" name="sujet" class="form-control" value="<?php echo htmlspecialchars($event['sujet']); ?>" required>
                                <div id="sujetError" class="error-message">Subject is required</div>
                            </div>
                            <div class="mb-3">
                                <label for="date" class="form-label">Event Date:</label>
                                <input type="datetime-local" id="date" name="date" class="form-control" value="<?php echo htmlspecialchars($event['date']); ?>" required>
                                <div id="dateError" class="error-message">Event Date is required</div>
                            </div>
                            <div class="mb-3">
                                <label for="lieu" class="form-label">Location:</label>
                                <input type="text" id="lieu" name="lieu" class="form-control" value="<?php echo htmlspecialchars($event['lieu']); ?>" required>
                                <div id="lieuError" class="error-message">Location is required</div>
                            </div>
                            <div class="mb-3">
                                <label for="organizateur" class="form-label">Organizer's Name:</label>
                                <input type="text" id="organizateur" name="organizateur" class="form-control" value="<?php echo htmlspecialchars($event['organizateur']); ?>" required>
                                <div id="organizateurError" class="error-message">Organizer's Name is required</div>
                            </div>
                            <div class="mb-3">
                                <label for="affiche" class="form-label">Affiche (Image):</label>
                                <input type="file" id="affiche" name="affiche" class="form-control" style="display: none;">
                                <button type="button" id="uploadBtn" class="btn btn-secondary">Upload Image</button>
                            </div>
                            <div class="mb-3">
                                <label for="type" class="form-label">Event Type:</label>
                                <select id="type" name="type" class="form-control" required>
                                    <option value="Atelier" <?php if($event['type'] === 'Atelier') echo 'selected'; ?>>Atelier</option>
                                    <option value="Conference" <?php if($event['type'] === 'Conference') echo 'selected'; ?>>Conference</option>
                                    <option value="Seminaire" <?php if($event['type'] === 'Seminaire') echo 'selected'; ?>>Seminaire</option>
                                    <option value="Formation en ligne" <?php if($event['type'] === 'Formation en ligne') echo 'selected'; ?>>Formation en ligne</option>
                                    <option value="Table ronde" <?php if($event['type'] === 'Table ronde') echo 'selected'; ?>>Table ronde</option>
                                    <option value="Forum" <?php if($event['type'] === 'Forum') echo 'selected'; ?>>Forum</option>
                                    <option value="Hackathon" <?php if($event['type'] === 'Hackathon') echo 'selected'; ?>>Hackathon</option>
                                </select>
                                <div id="typeError" class="error-message">Event Type is required</div>
                            </div>
                            <div class="mb-3">
                                <label for="frais" class="form-label">Registration Fee:</label>
                                <input type="text" id="frais" name="frais" class="form-control" value="<?php echo htmlspecialchars($event['frais']); ?>" required>
                                <div id="fraisError" class="error-message">Registration Fee is required</div>
                            </div>
                            <div class="mb-3">
                                <label for="duree" class="form-label">Event Duration:</label>
                                <input type="text" id="duree" name="duree" class="form-control" value="<?php echo htmlspecialchars($event['duree']); ?>" required>
                                <div id="dureeError" class="error-message">Event Duration is required</div>
                            </div>
                            <div class="mb-3">
                                <label for="max" class="form-label">Max Number of Participants:</label>
                                <input type="number" id="max" name="max" class="form-control" value="<?php echo htmlspecialchars($event['max']); ?>" required>
                                <div id="maxError" class="error-message">Max Number of Participants is required and must be at least 10</div>
                            </div>
                            <input type="hidden" name="action" value="updateEvent">
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Mettre a jour</button>
                                <a href="eventslist.php" class="btn btn-secondary">Annuler</a>
                            </div>
                        </form>
                    <?php else: ?>
                        <p>Event not found.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>


    <script>
    document.getElementById('eventForm').addEventListener('submit', function(event) {
        // Your custom validation logic goes here
        var nomInput = document.getElementById('nom');
        var sujetInput = document.getElementById('sujet');
        var dateInput = document.getElementById('date');
        var lieuInput = document.getElementById('lieu');
        var organizateurInput = document.getElementById('organizateur');
        var organizateurInput = document.getElementById('affiche');
        var typeInput = document.getElementById('type');
        var fraisInput = document.getElementById('frais');
        var dureeInput = document.getElementById('duree');
        var maxInput = document.getElementById('max');

        var isValid = true;

        // Check if the input fields are empty
        if (!nomInput.value.trim()) {
            document.getElementById('nomError').style.display = 'block'; // Display error message
            isValid = false;
        } else {
            document.getElementById('nomError').style.display = 'none'; // Hide error message
        }

        if (!sujetInput.value.trim()) {
            document.getElementById('sujetError').style.display = 'block'; // Display error message
            isValid = false;
        } else {
            document.getElementById('sujetError').style.display = 'none'; // Hide error message
        }

        if (!dateInput.value.trim()) {
            document.getElementById('dateError').style.display = 'block'; // Display error message
            isValid = false;
        } else {
            document.getElementById('dateError').style.display = 'none'; // Hide error message
        }

        if (!lieuInput.value.trim()) {
            document.getElementById('lieuError').style.display = 'block'; // Display error message
            isValid = false;
        } else {
            document.getElementById('lieuError').style.display = 'none'; // Hide error message
        }

        if (!organizateurInput.value.trim()) {
            document.getElementById('organizateurError').style.display = 'block'; // Display error message
            isValid = false;
        } else {
            document.getElementById('organizateurError').style.display = 'none'; // Hide error message
        }


        if (!typeInput.value.trim()) {
            document.getElementById('typeError').style.display = 'block'; // Display error message
            isValid = false;
        } else {
            document.getElementById('typeError').style.display = 'none'; // Hide error message
        }

        if (!fraisInput.value.trim()) {
            document.getElementById('fraisError').style.display = 'block'; // Display error message
            isValid = false;
        } else {
            document.getElementById('fraisError').style.display = 'none'; // Hide error message
        }

        if (!dureeInput.value.trim()) {
            document.getElementById('dureeError').style.display = 'block'; // Display error message
            isValid = false;
        } else {
            document.getElementById('dureeError').style.display = 'none'; // Hide error message
        }

        if (maxInput.value.trim() === '' || parseInt(maxInput.value) < 10) {
            document.getElementById('maxError').innerText = 'Max Number of Participants must be at least 10';
            document.getElementById('maxError').style.display = 'block'; // Display error message
            isValid = false;
        } else {
            document.getElementById('maxError').style.display = 'none'; // Hide error message
        }

        if (!isValid) {
            event.preventDefault(); // Prevent form submission if validation fails
        }
    });
    // Get the button and file input element
    const uploadBtn = document.getElementById('uploadBtn');
    const afficheInput = document.getElementById('affiche');

    // Add click event listener to the button
    uploadBtn.addEventListener('click', function() {
        // Trigger click event on the file input
        afficheInput.click();
    });
</script>

</body>
</html>
