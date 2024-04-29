<?php
require_once '../Controller/eventController.php';
require_once '../Model/eventModel.php';

$controller = new EventController();
$eventModel = new EventModel();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'deleteEvent' && isset($_POST['eventId'])) {
    $controller->deleteEvent($_POST['eventId']);
    header('Location: eventslist.php');
    exit;
}

$sortCriteria = isset($_GET['sort']) ? $_GET['sort'] : null;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$eventsPerPage = 5; // This can be adjusted as needed

// Fetch events based on sorting criteria
$events = $eventModel->getAllEvents($sortCriteria, $page, $eventsPerPage);

$totalEvents = count($eventModel->getAllEvents()); // Total number of users
$totalPages = ceil($totalEvents / $eventsPerPage); // Total pages
?>
<?php include 'common.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Liste des Evenements</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="../cssD/bootstrap.min.css">
    <style>
        /* Custom CSS for the table */
        .table-container {
            margin-top: 50px;
        }
        .table-container table {
            width: 100%;
            border-collapse: collapse;
        }
        .table-container th, .table-container td {
            border: 1px solid #dee2e6;
            padding: .75rem;
            vertical-align: top;
        }
        .table-container th {
            background-color: #f8f9fa;
            font-weight: 600;
        }
        .table-container tbody tr:nth-of-type(even) {
            background-color: #f3f4f6;
        }
        .table-container tbody tr:hover {
            background-color: #e9ecef;
        }
        .table-container td.actions {
            white-space: nowrap;
        }
        .table-container button {
            padding: 5px 10px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Liste des Evenements</h1>

        <!-- Search Button -->
        <div class="text-center mt-4">
            <a href="recherche.php" class="btn btn-primary">Chercher un Evenement</a>
        </div>

        <!-- Sorting Form -->
        <div class="text-center mt-4">
    <form action="eventslist.php" method="get">
        <button type="submit" name="sort" value="oldest" class="btn btn-secondary">Sort by Oldest</button>
        <button type="submit" name="sort" value="newest" class="btn btn-secondary">Sort by Newest</button>
    </form>
</div>

        <div class="table-container mt-4">
            <?php if (!empty($events)): ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Sujet</th>
                            <th>Date</th>
                            <th>Lieu</th>
                            <th>Organisateur</th>
                            <th>Affiche</th>
                            <th>Type</th>
                            <th>Frais</th>
                            <th>Duree</th>
                            <th>Nombre Max de Participants</th>
                            <th>Participants</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($events as $event): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($event['id']); ?></td>
                                <td><?php echo htmlspecialchars($event['nom']); ?></td>
                                <td><?php echo htmlspecialchars($event['sujet']); ?></td>
                                <td><?php echo htmlspecialchars($event['date']); ?></td>
                                <td><?php echo htmlspecialchars($event['lieu']); ?></td>
                                <td><?php echo htmlspecialchars($event['organizateur']); ?></td>
                                <td>
    <!-- Display the image -->
    <img src="../images/<?php echo $event['affiche']; ?>" alt="Event Image" style="max-width: 150px;">
</td>

                                <td><?php echo htmlspecialchars($event['type']); ?></td>
                                <td><?php echo htmlspecialchars($event['frais']); ?></td>
                                <td><?php echo htmlspecialchars($event['duree']); ?></td>
                                <td><?php echo htmlspecialchars($event['max']); ?></td>
                                <td> 
                                <?php
// Check if 'participants' key is set and not empty
if (isset($event['participants']) && !empty($event['participants'])) {
    // Split the string of participants into an array
    $participantsArray = explode(',', $event['participants']);
    
    // Count the number of participants
    $participantCount = count($participantsArray);
    
    // Display the number of participants
    echo $participantCount;
} else {
    // If no participants, display a message
    echo 'No participants';
}
?>

        </td>
                                <td class="actions">
                                    <a href="editEvent.php?eventId=<?php echo $event['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                                    <form action="eventslist.php" method="post" onsubmit="return confirm('Voulez vous vraiment supprimer cet evenement?');">
                                        <input type="hidden" name="eventId" value="<?php echo $event['id']; ?>">
                                        <input type="hidden" name="action" value="deleteEvent">
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <div class="text-center mt-4">
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <a href="?page=<?php echo $i; ?><?php echo $sortCriteria ? '&sort=' . $sortCriteria : ''; ?>" class="btn btn-secondary"><?php echo $i; ?></a>
                    <?php endfor; ?>
                </div>
            <?php else: ?>
                <p class="text-center mt-4">Aucun événement trouvé.</p>
            <?php endif; ?>
        </div>
        <div class="text-center mt-4">
            <button type="button" onclick="window.location.href='menu.php';" class="btn btn-secondary">Retour au Menu</button>
        </div>
    </div>
</body>
</html>

