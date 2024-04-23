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

    // Call the updateEvent method from the EventController
    $result = $eventController->updateEvent($eventId, $nom, $sujet, $date, $lieu, $organizateur, $affiche, $type, $frais, $duree);
    if ($result === true) {
        header('Location: eventslist.php'); // Redirect on success
        exit;
    } else {
        echo 'An error occurred while updating.';
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
                            <form action="editevent.php?eventId=<?php echo htmlspecialchars($eventId); ?>" method="post">
                                <!-- Your form fields -->
                                <!-- Example: -->
                                <div class="mb-3">
                                    <label for="nom" class="form-label">Nom de l'evenement:</label>
                                    <input type="text" id="nom" name="nom" class="form-control" value="<?php echo htmlspecialchars($event['nom']); ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="sujet" class="form-label">Sujet:</label>
                                    <input type="text" id="sujet" name="sujet" class="form-control" value="<?php echo htmlspecialchars($event['sujet']); ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="date" class="form-label">Date de l'evenement:</label>
                                    <input type="datetime-local" id="date" name="date" class="form-control" value="<?php echo htmlspecialchars($event['date']); ?>" required>
                                </div>
                                
                                <div class="mb-3">
        <label for="lieu" class="form-label">Lieu:</label>
        <input type="text" id="lieu" name="lieu" class="form-control" value="<?php echo htmlspecialchars($event['lieu']); ?>"required></div>

        <div class="mb-3">
        <label for="organizateur" class="form-label">Nom de l'organizateur:</label>
        <input type="text" id="organizateur" name="organizateur" class="form-control" value="<?php echo htmlspecialchars($event['organizateur']); ?>"required></div>

<!-- In your edit event form -->
<div class="mb-3">
    <label for="affiche" class="form-label">Affiche (Image):</label>
    <!-- Hidden file input field -->
    <input type="file" id="affiche" name="affiche" class="form-control" style="display: none;">
    <!-- Button to trigger file input -->
    <button type="button" id="uploadBtn" class="btn btn-secondary">Upload Image</button>
</div>


        <div class="mb-3">
        <label for="type" class="form-label">Type de l'evenement:</label>
        <select id="type" name="type" class="form-control" required>
            <option value="Atelier" <?php if($event['type'] === 'Atelier') echo 'selected'; ?>>Atelier</option>
            <option value="Conference" <?php if($event['type'] === 'Conference') echo 'selected'; ?>>Conference</option>
            <option value="Seminaire" <?php if($event['type'] === 'Seminaire') echo 'selected'; ?>>Seminaire</option>
            <option value="Formation en ligne" <?php if($event['type'] === 'Formation en ligne') echo 'selected'; ?>>Formation en ligne</option>
            <option value="Table ronde" <?php if($event['type'] === 'Table ronde') echo 'selected'; ?>>Table ronde</option>
            <option value="Forum" <?php if($event['type'] === 'Forum') echo 'selected'; ?>>Forum</option>
            <option value="Hackathon" <?php if($event['type'] === 'Hackathon') echo 'selected'; ?>>Hackathon</option>
        </select></div>

        <div class="mb-3">
        <label for="frais" class="form-label">Frais d'inscription:</label>
        <input type="text" id="frais" name="frais" class="form-control" value="<?php echo htmlspecialchars($event['frais']); ?>"required></div>

        <div class="mb-3">
        <label for="duree" class="form-label">Duree de l'evenement:</label>
        <input type="text" id="duree" name="duree" class="form-control" value="<?php echo htmlspecialchars($event['duree']); ?>"required></div>

                                
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
