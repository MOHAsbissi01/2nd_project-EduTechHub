<?php
class Database {
    private $host = 'localhost';
    private $db_name = 'projet';
    private $username = 'root';
    private $password = '';
    private $conn;
    public function connect() {
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Connection error: " . $e->getMessage();
        }
        return $this->conn;
    }

    public function getEventsWithUsers() {
        try {
            $query = "SELECT e.*, i.user_name FROM gestion_evenements e LEFT JOIN inscriptions i ON e.id = i.event_id";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Query error: " . $e->getMessage();
        }
        return array(); // Return an empty array if an error occurs
    }
}
?>

