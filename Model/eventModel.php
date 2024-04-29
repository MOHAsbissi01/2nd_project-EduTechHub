<?php
require_once '../db.php';

class EventModel {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function getEvents() {
        try {
            // Prepare the SQL statement to select all events
            $sql = "SELECT id, nom, date, lieu FROM gestion_evenements";
            $stmt = $this->conn->query($sql);
            
            // Return the result of the query execution
            return $stmt;
        } catch(PDOException $e) {
            // Log the error or handle it more gracefully
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    

    public function getEventById($eventId) {
        try {
            // Prepare the SQL statement
            $sql = "SELECT * FROM gestion_evenements WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
    
            // Bind the parameter
            $stmt->bindParam(1, $eventId);
    
            // Execute the statement
            $stmt->execute();
    
            // Fetch the result as an associative array
            $event = $stmt->fetch(PDO::FETCH_ASSOC);
    
            // Return the event details
            return $event;
        } catch(PDOException $e) {
            // Log the error or handle it more gracefully
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function addEvent($nom, $sujet, $date, $lieu, $organizateur, $affiche, $type, $frais, $duree, $max) {
        try {
            $sql = "INSERT INTO gestion_evenements (nom, sujet, date, lieu, organizateur, affiche, type, frais, duree, max) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
    
            // Bind parameters
            $stmt->bindParam(1, $nom);
            $stmt->bindParam(2, $sujet);
            $stmt->bindParam(3, $date);
            $stmt->bindParam(4, $lieu);
            $stmt->bindParam(5, $organizateur);
            $stmt->bindParam(6, $affiche);
            $stmt->bindParam(7, $type);
            $stmt->bindParam(8, $frais);
            $stmt->bindParam(9, $duree);
            $stmt->bindParam(10, $max);
    
            // Execute the statement
            $stmt->execute();
            
            // Return true if successful
            return true;
            
        } catch(PDOException $e) {
            // Log the error or handle it more gracefully
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    
    public function deleteEvent($eventId) {
        try {
            // Prepare the SQL statement
            $sql = "DELETE FROM gestion_evenements WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
    
            // Bind the parameter
            $stmt->bindParam(1, $eventId);
    
            // Execute the statement
            $stmt->execute();
    
            // Check if any rows were affected
            if ($stmt->rowCount() > 0) {
                // Event deleted successfully
                return true;
            } else {
                // No rows affected, event not found or already deleted
                return false;
            }
        } catch(PDOException $e) {
            // Log the error or handle it more gracefully
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    
    public function updateEvent($eventId, $nom, $sujet, $date, $lieu, $organizateur, $affiche, $type, $frais, $duree, $max) {
        try {
            // Prepare the SQL statement
            $sql = "UPDATE gestion_evenements SET nom = ?, sujet = ?, date = ?, lieu = ?, organizateur = ?, affiche = ?, type = ?, frais = ?, duree = ?, max = ? WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
    
            // Bind parameters
            $stmt->bindParam(1, $nom);
            $stmt->bindParam(2, $sujet);
            $stmt->bindParam(3, $date);
            $stmt->bindParam(4, $lieu);
            $stmt->bindParam(5, $organizateur);
            $stmt->bindParam(6, $affiche);
            $stmt->bindParam(7, $type);
            $stmt->bindParam(8, $frais);
            $stmt->bindParam(9, $duree);
            $stmt->bindParam(10, $max);
            $stmt->bindParam(11, $eventId); // Bind event ID as the last parameter
    
            // Execute the statement
            $stmt->execute();
    
            // Check if any rows were affected
            if ($stmt->rowCount() > 0) {
                // Event updated successfully
                return true;
            } else {
                // No rows affected, event not found or already updated
                return false;
            }
        } catch(PDOException $e) {
            // Log the error or handle it more gracefully
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function subscribeEvent($eventId, $username) {
        try {
            // Get the current count of participants for the event
            $currentParticipantsCount = $this->getCurrentParticipantsCount($eventId);
            
            // Get the maximum number of participants allowed for the event
            $maxParticipants = $this->getMaxParticipants($eventId);
            
            // Check if the maximum number of participants has been reached
            if ($currentParticipantsCount < $maxParticipants) {
                // Prepare the SQL statement
                $sql = "INSERT INTO inscriptions (event_id, user_name) VALUES (?, ?)";
                $stmt = $this->conn->prepare($sql);
        
                // Bind parameters
                $stmt->bindParam(1, $eventId);
                $stmt->bindParam(2, $username);
        
                // Execute the statement
                $success = $stmt->execute();
        
                // Return the success status
                return $success;
            } else {
                // Maximum participants reached, return false
                return false;
            }
        } catch(PDOException $e) {
            // Log the error or handle it more gracefully
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    
    // Helper method to get the current count of participants for the event
    private function getCurrentParticipantsCount($eventId) {
        // Prepare the SQL statement
        $sql = "SELECT COUNT(*) AS participant_count FROM inscriptions WHERE event_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $eventId);
        
        // Execute the statement
        $stmt->execute();
        
        // Fetch the result
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Return the participant count
        return $result['participant_count'];
    }
    
    // Helper method to get the maximum number of participants allowed for the event
    private function getMaxParticipants($eventId) {
        // Prepare the SQL statement
        $sql = "SELECT max FROM gestion_evenements WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $eventId);
        
        // Execute the statement
        $stmt->execute();
        
        // Fetch the result
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Return the maximum participants allowed
        return $result['max'];
    }
    
    

    public function getEventParticipants($eventId) {
        try {
            // Prepare the SQL statement
            $sql = "SELECT user_name FROM inscriptions WHERE event_id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(1, $eventId);
            // Execute the statement
            $stmt->execute();
            // Fetch all usernames as an associative array
            $participants = $stmt->fetchAll(PDO::FETCH_ASSOC);
            // Return the usernames
            return $participants;
        } catch(PDOException $e) {
            // Log the error or handle it more gracefully
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    public function searchEventByName($eventName) {
        try {
            // Prepare the SQL statement
            $sql = "SELECT * FROM gestion_evenements WHERE nom LIKE ?";
            $stmt = $this->conn->prepare($sql);
    
            // Bind the parameter with wildcards
            $eventName = "%" . $eventName . "%";
            $stmt->bindParam(1, $eventName);
    
            // Execute the statement
            $stmt->execute();
    
            // Fetch all matching events as an associative array
            $matchingEvents = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            // Return the matching events
            return $matchingEvents;
        } catch(PDOException $e) {
            // Log the error or handle it more gracefully
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function getAllEvents($sortCriteria = null, $page = 1, $perPage = 5) {
        try {
            // Calculate the offset for pagination
            $offset = ($page - 1) * $perPage;
    
            // Prepare the SQL statement with pagination and sorting
            $sql = "SELECT e.*, GROUP_CONCAT(i.user_name) AS participants 
                    FROM gestion_evenements e 
                    LEFT JOIN inscriptions i ON e.id = i.event_id 
                    GROUP BY e.id";
    
            // If sorting criteria is provided, add ORDER BY clause
            if ($sortCriteria !== null) {
                switch ($sortCriteria) {
                    case 'oldest':
                        $sql .= " ORDER BY e.date ASC";
                        break;
                    case 'newest':
                        $sql .= " ORDER BY e.date DESC";
                        break;
                    // Add other sorting criteria if needed
                }
            }
    
            // Add pagination limit and offset
            $sql .= " LIMIT :offset, :perPage";
    
            // Prepare the SQL statement
            $stmt = $this->conn->prepare($sql);
    
            // Bind parameters for pagination
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            $stmt->bindParam(':perPage', $perPage, PDO::PARAM_INT);
    
            // Execute the statement
            $stmt->execute();
    
            // Fetch all events with participants as an associative array
            $events = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            // Return all events
            return $events;
        } catch(PDOException $e) {
            // Log the error or handle it more gracefully
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
?>
