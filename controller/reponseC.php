<?php
class reponseC{
    public function listReponses(){
        $sql = "SELECT * FROM reponses e inner join reclamations r on e.reclamation_id = r.id_recla";
        $db = config::getConnexion();
        try{
            $list = $db->query($sql);
            return $list;
        }
        catch(Exception $e){
            die("Error: " . $e->getMessage());
        }
    }

    public function deleteReponse($id){
        $sql = "DELETE FROM reponses WHERE id_reponse = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(":id", $id);
        try{
            $req->execute();
        }
        catch(Exception $e){
            die("Error: " . $e->getMessage());
        }
    }

    public function addReponse($reponse){
        $sql = "INSERT INTO reponses (reclamation_id, subject, msg) VALUES(:reclamation_id, :subject, :msg)";
        $db = config::getConnexion();
        try{
            $req = $db->prepare($sql);
            $req->execute([
                "reclamation_id" => $reponse->getReclamationId(),
                "subject" => $reponse->getSubject(),
                "msg" => $reponse->getMsg()
            ]);
        }
        catch(Exception $e){
            die('Error adding response: ' . $e->getMessage());
        }
    }

    public function updateReponse($response){
        $sql = "UPDATE reponses SET  subject = :subject, msg = :msg WHERE id_reponse = :id";
        $db = config::getConnexion();
        try{
            $req = $db->prepare($sql);
            $req->execute([
                "id" => $response->getIdReponse(),
                "subject" => $response->getSubject(),
                "msg" => $response->getMsg()
            ]);
        }
        catch(Exception $e){
            die('Error updating response: ' . $e->getMessage());
        }
    }
    

    public function getReponseById($id){
        $sql = "SELECT * FROM reponses WHERE id_reponse = :id";
        $db = config::getConnexion();
        try{
            $query = $db->prepare($sql);
            $query->execute(["id" => $id]);
            $reponse = $query->fetch();
            return $reponse;
        }
        catch(Exception $e){
            die('Error fetching response: ' . $e->getMessage());
        }
    }
}
?>
