<?php
class Categorie {
    private $id_category;
    private $type_doc;

    // Constructeur
    public function __construct($id_category, $type_doc) {
        $this->id_category = $id_category;
        $this->type_oeuvre = $type_doc;
    }

    // Méthode pour obtenir l'ID de la catégorie
    public function getIdCategory() {
        return $this->id_category;
    }

    // Méthode pour obtenir le type de la catégorie
    public function getTypeCours() {
        return $this->type_doc;
    }
}
?>