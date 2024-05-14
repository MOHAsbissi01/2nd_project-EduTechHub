<?php
    class reclamation{
        private ?int $id = null;
        private ?string $nom = null; 
        private ?string $num = null;
        private ?string $email = null;
        private ?string $description = null;

        public function __construct($a = null, $b, $c, $d, $e) {
            $this->id = $a;
            $this->nom = $b;
            $this->num = $c;
            $this->email = $d;
            $this->description = $e;
        }

        public function getId(){
            return $this->id;
        }

        public function getnom(){
            return $this->nom;
        }
        public function getnum(){
            return $this->num;
        }
        public function getemail(){
            return $this->email;
        }

        public function getdescription(){
            return $this->description;
        }

        public function setnom($a) {
            $this->nom = $a;
        }
        public function setnum($d) {
            $this->num = $d;

        }
        public function setemail($b) {
            $this->email = $b;
        }
        
        public function setdescription($e) {
            $this->description = $e;
        }
    



        public $db;

       /* public function __construct()
        {
            try {
                $this->db = new PDO('mysql:host=localhost;dbname=reclamations;charset=utf8', 'your_username', 'your_password');
                $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo 'Connection failed: ' . $e->getMessage();
            }
        }*/
    
        public function Listreclamation()
        {
            $sql = "SELECT * FROM reclamations";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        }
    
        public function searchReclamationByName($name)
        {
            $sql = "SELECT * FROM reclamations WHERE nom LIKE :name LIMIT 0, 25";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':name', '%' . $name . '%');
            $stmt->execute();
            return $stmt->fetchAll();
        }
        
    }
    function ListreclamationSortedByName() {
        $sql = "SELECT * FROM reclamations ORDER BY nom"; // Ajoutez 'ORDER BY nom' pour trier par nom
        $db = config::getConnexion();
        try {
            $list = $db->query($sql);
            return $list;
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }
    
?>
