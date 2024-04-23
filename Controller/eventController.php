<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once '../Model/EventModel.php';

class EventController {
    private $eventModel;

    public function __construct() {
        $this->eventModel = new EventModel();
    }

    public function createEvent() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = $_POST['nom'];
            $sujet = $_POST['sujet'];
            $date = $_POST['date'];
            $lieu = $_POST['lieu'];
            $organizateur = $_POST['organizateur'];
            $affiche = $_POST['affiche'];
            $type = 'atelier'; // You can adjust this as needed
            $frais = $_POST['frais'];
            $duree = $_POST['duree'];

            // Check if any field is empty
            if (empty($nom) || empty($sujet) || empty($date) || empty($lieu) || empty($organizateur) || empty($type) || empty($frais) || empty($duree)) {
                return "Please fill in all fields.";
            }

            // Check if the date is in the future or today
            $today = date("Y-m-d");
            if ($date < $today) {
                return "Invalid date input. Event date must be today or in the future.";
            }

            // Attempt to add the event
            $result = $this->eventModel->addEvent($nom, $sujet, $date, $lieu, $organizateur, $affiche, $type, $frais, $duree);

            if ($result) {
                header('Location: ../View/success.php');
                exit;
            } else {
                return 'An error occurred during creation.';
            }
        }
        return false;
    }

    public function subscribeEvent($event_id, $username) {
        // Call the model method to subscribe the user to the event
        return $this->eventModel->subscribeEvent($event_id, $username);
    }
    
    public function deleteEvent($eventId) {
        return $this->eventModel->deleteEvent($eventId);
    }

    public function updateEvent($eventId, $nom, $sujet, $date, $lieu, $organizateur, $affiche, $type, $frais, $duree) {
                    // Check if the date is in the future or today
            $today = date("Y-m-d");
            if ($date < $today) {
                return "Invalid date input. Event date must be today or in the future.";
            }
        // Attempt to update the event
        return $this->eventModel->updateEvent($eventId, $nom, $sujet, $date, $lieu, $organizateur, $affiche, $type, $frais, $duree);
    }
}

// Instantiate and use the EventController based on the action
if (isset($_POST['action'])) {
    $controller = new EventController();
    if ($_POST['action'] === 'createEvent') {
        $result = $controller->createEvent();
        if ($result !== true) {
            // Handle error
            echo $result;
        }
    } elseif ($_POST['action'] === 'deleteEvent') {
        $controller->deleteEvent($_POST['eventId']);
    } elseif ($_POST['action'] === 'updateEvent') {
        // Pass event ID as a parameter to updateEvent method
        $eventId = $_POST['eventId'];
        $result = $controller->updateEvent($eventId, $_POST['nom'], $_POST['sujet'], $_POST['date'], $_POST['lieu'], $_POST['organizateur'], $_POST['affiche'], $_POST['type'], $_POST['frais'], $_POST['duree']);
        if ($result !== true) {
            // Handle error
            echo $result;
        }

        
    }

    
}
?>
