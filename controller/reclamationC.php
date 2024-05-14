<?php
    class reclamationC{
        public function Listreclamation(){
            $sql = "SELECT * FROM reclamations";
            $db = config::getConnexion();
            try{
                $List = $db->query($sql);
                return $List;
            }
            catch(Exception $e){
                die("Message error = ". $e->getMessage());
            }
        }

        public function deletereclamation($id){
            $sql = "DELETE FROM reclamations where id_recla = :id ";
            $db = config::getConnexion();
            $req = $db->prepare($sql);
            $req->bindValue(":id", $id);
            try{
                $req->execute();
            }
            catch(Exception $e){
                die("Message error = ". $e->getMessage());
            }
        }

        public function addreclamation($rec){
            $sql = "INSERT INTO reclamations (nom,num, email, description ) VALUES(:nom,:num,:email,:description)";
            $db = config::getConnexion();
            try{
                $req = $db->prepare($sql);
                $req->execute([
                    "nom"=> $rec->getnom(),
                    "num"=> $rec->getnum(),
                    "email"=> $rec->getemail(),
                    
                    "description"=> $rec->getdescription(),
                ]);
            }
            catch(Exception $e){
                die('error d ajout'. $e->getMessage());
            }
        }
        
        
        
        
        
        public function updatereclamation($id, $email, $nom, $num, $description){
            $sql = "UPDATE reclamations SET email = :email, nom = :nom, num = :num, description = :description WHERE id_recla = :id";
            $db = config::getConnexion();
            try{
                $req = $db->prepare($sql);
                $req->execute([
                    "id" => $id,
                    "email" => $email,
                    "nom" => $nom,
                    "num" => $num,
                    "description" => $description
                ]);
            }
            catch(Exception $e){
                die('Erreur de mise à jour'. $e->getMessage());
            }
        }
        
         
function showreclamation($id)
{
    $sql = "SELECT * from reclamations where id_recla = $id";
    $db = config::getConnexion();
    try {
        $query = $db->prepare($sql);
        $query->execute();

        $reclamations = $query->fetch();
        return $reclamations;
    } catch (Exception $e) {
        die('Error: ' . $e->getMessage());
    }
}



function searchReclamationByName($name) {
    try {
        $db = config::getConnexion();

        $query = $db->prepare(
            'SELECT * FROM reclamations WHERE nom = :nom'
        );
        $query->execute([
            'nom' => $name
        ]);
        
        return $query->fetchAll();
    } catch (PDOException $e) {
        $e->getMessage();
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




}
    
?>
