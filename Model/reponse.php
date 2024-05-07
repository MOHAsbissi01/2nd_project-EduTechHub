<?php
class reponse{
    private ?int $id_reponse = null;
    private ?int $reclamation_id = null;
    private ?string $subject = null;
    private ?string $msg = null;

    public function __construct($id_reponse = null, $reclamation_id = null, $subject = null, $msg = null) {
        $this->id_reponse = $id_reponse;
        $this->reclamation_id = $reclamation_id;
        $this->subject = $subject;
        $this->msg = $msg;
    }

    public function getIdReponse(){
        return $this->id_reponse;
    }

    public function getReclamationId(){
        return $this->reclamation_id;
    }

    public function getSubject(){
        return $this->subject;
    }

    public function getMsg(){
        return $this->msg;
    }

    public function setIdReponse($id_reponse) {
        $this->id_reponse = $id_reponse;
    }
    public function setReclamationId($reclamation_id) {
        $this->reclamation_id = $reclamation_id;
    }

    public function setSubject($subject) {
        $this->subject = $subject;
    }

    public function setMsg($msg) {
        $this->msg = $msg;
    }

   
}
?>
