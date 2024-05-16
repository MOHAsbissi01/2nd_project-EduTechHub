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

    public function subscribeEvent($eventId, $emails) {
        try {
            // Get the current count of participants for the event
            $currentParticipantsCount = $this->getCurrentParticipantsCount($eventId);
    
            // Get the maximum number of participants allowed for the event
            $maxParticipants = $this->getMaxParticipants($eventId);
    
            // Check if the maximum number of participants has been reached
            if ($currentParticipantsCount + count($emails) > $maxParticipants) {
                // Maximum participants reached, return false
                return false;
            }
    
            // Prepare the query outside the loop
            $selectQuery = "SELECT name FROM users WHERE email = :email";
            $selectStmt = $this->conn->prepare($selectQuery);
            
            foreach ($emails as $email) {
                // Bind email parameter
                $selectStmt->bindParam(':email', $email);
                $selectStmt->execute();
                $user = $selectStmt->fetch(PDO::FETCH_ASSOC);
    
                if ($user) {
                    // User exists, proceed with subscription
                    // Insert subscription into the inscriptions table
                    $insertQuery = "INSERT INTO inscriptions (user_name, email, event_id) VALUES (:user_name, :email, :event_id)";
                    $insertStmt = $this->conn->prepare($insertQuery);
                    $insertStmt->bindParam(':user_name', $user['name']);
                    $insertStmt->bindParam(':email', $email);
                    // Assuming event_id is some specific event ID you're subscribing to
                    $insertStmt->bindValue(':event_id', $eventId);
                    $insertStmt->execute();
                } else {
                    // User doesn't exist, throw an exception
                    throw new Exception("Error: Email address not found for $email");
                }
            }
    
            // Subscription successful
            return true;
        } catch(PDOException $e) {
            // Handle database error
            echo "Query error: " . $e->getMessage();
            return false;
        } catch(Exception $e) {
            // Handle other errors
            echo $e->getMessage();
            return false;
        }
    }
    
    
        
    
    
    
    public function cancelInscription($inscriptionId) {
        try {
            $sql = "DELETE FROM inscriptions WHERE inscription_id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$inscriptionId]);
            return true;
        } catch(PDOException $e) {
            // Handle the exception
            return false;
        }
    }
      

    public function inscriptionExists($inscriptionId) {
        try {
            // Prepare SQL statement
            $stmt = $this->conn->prepare("SELECT COUNT(*) as count FROM inscriptions WHERE inscription_id = ?");
            $stmt->bindParam(1, $inscriptionId);
            $stmt->execute();

            // Fetch result
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            // Check if count is greater than 0
            if ($result['count'] > 0) {
                return true; // Inscription exists
            } else {
                return false; // Inscription does not exist
            }
        } catch (PDOException $e) {
            // Handle exception
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function getParticipantsByEventId($eventId) {
        try {
            $sql = "SELECT * FROM inscriptions WHERE event_id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$eventId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
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

    public function getEventDetails($eventId) {
        try {
            // Prepare the SQL statement
            $sql = "SELECT * FROM gestion_evenements WHERE id = :eventId";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':eventId', $eventId, PDO::PARAM_INT);

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

    public function generateEventPDF($eventId) {
        require_once('../TCPDF-main/tcpdf.php');

        // Create new PDF document
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // Set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Your Name');
        $pdf->SetTitle('Event Details');
        $pdf->SetSubject('Event Details PDF');
        $pdf->SetKeywords('Event, Details, PDF');

        // Add a page
        $pdf->AddPage();

        // Set font
        $pdf->SetFont('dejavusans', '', 12);

        // Fetch event details from the database
        $eventDetails = $this->getEventDetails($eventId);

        // Output event details in the PDF
        $pdf->Cell(0, 10, 'Event Name: ' . $eventDetails['nom'], 0, 1);
        $pdf->Cell(0, 10, 'Event Date: ' . $eventDetails['date'], 0, 1);
        $pdf->Cell(0, 10, 'Event Location: ' . $eventDetails['lieu'], 0, 1);
        $pdf->Cell(0, 10, 'Event Subject: ' . $eventDetails['sujet'], 0, 1);
        $pdf->Cell(0, 10, 'Event Organizer: ' . $eventDetails['organizateur'], 0, 1);
        $pdf->Cell(0, 10, 'Event Duration: ' . $eventDetails['duree'], 0, 1);
        $pdf->Cell(0, 10, 'Event Type: ' . $eventDetails['type'], 0, 1);
        $imagePath = '../images/' . $eventDetails['affiche'];
        if (file_exists($imagePath)) {
            $pdf->Image($imagePath, 15, 40, 180, 0, 'JPG', '', '', false, 300, '', false, false, 1, false, false, false);
        } else {
            $pdf->Cell(0, 10, 'Event Image: Image not found', 0, 1);
        }

        // Fetch participant names from the database
        $participants = $this->getEventParticipants($eventId);
        
        // Output participant names in the PDF
        $pdf->Cell(0, 10, 'Participants:', 0, 1);
        foreach ($participants as $participant) {
            $pdf->Cell(0, 10, '- ' . $participant['user_name'], 0, 1);
        }

        // Close and output PDF document
        $pdf->Output('event_details.pdf', 'D');
    }
}

?>