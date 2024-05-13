<?php
require_once '../config.php';

class TestModel {
    private $id_test;
    private $quiz_title;
    private $utilisateur;
    private $note_obtenue;
    private $questions;
    private $email;
    private $cours; // Ajoutez cette propriété pour stocker les questions du test

    public function __construct($id_test, $quiz_title, $utilisateur, $note_obtenue, $questions, $cours, $email = []) {
        $this->id_test = $id_test;
        $this->quiz_title = $quiz_title;
        $this->utilisateur = $utilisateur;
        $this->note_obtenue = $note_obtenue;
        $this->questions = $questions; // Initialisez la liste des questions
        $this->email = $email;
        $this->cours = $cours; // Initialisez la liste des cours

    }

    // Définissez une méthode pour ajouter des questions au modèle
    public function setQuestions($questions) {
        $this->questions = $questions;
    }

    // Définissez des getters pour récupérer les propriétés du modèle
    public function getIdTest() {
        return $this->id_test;
    }

    public function getQuizTitle() {
        return $this->quiz_title;
    }

    public function getUtilisateur() {
        return $this->utilisateur;
    }

    public function getNoteObtenue() {
        return $this->note_obtenue;
    }

    // Ajoutez un getter pour récupérer les questions du modèle
    public function getQuestions() {
        return $this->questions;
    }

    public function addQuestion($question) {
        $this->questions[] = $question;
    }

    public function getQuestionIds() {
        return array_map(function($question) {
            return $question['id_question'];
        }, $this->questions);
    }
    
   public function getCours() {
    return is_array($this->cours) ? implode(', ', $this->cours) : $this->cours;
}

public function getCours2() {
    return $this->cours;
}

public function getEmail() {
    return $this->email;
}
 
    
}
?>
