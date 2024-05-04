<?php
require_once '../Model/TestModel.php';
require_once '../config.php';

class TestController {
    private $db;

    public function __construct() {
        $this->db = config::getConnexion();
    }

    // Create a new test with associated questions
    public function createTest($quizTitle, $questions) {
        $this->db->beginTransaction();
        try {
            $stmt = $this->db->prepare("INSERT INTO test (quiz_title) VALUES (?)");
            $stmt->execute([$quizTitle]);
            $testId = $this->db->lastInsertId();
    
            foreach ($questions as $questionId) {
                $stmt = $this->db->prepare("INSERT INTO test_question (test_id, question_id) VALUES (?, ?)");
                $stmt->execute([$testId, $questionId]);
            }
    
            $this->db->commit();
            return $testId;
        } catch (PDOException $e) {
            $this->db->rollBack();
            throw $e;
        }
    }

    public function deleteTest($testId) {
        $this->db->beginTransaction();
        try {
            // Supprimer d'abord les entrées dans les tables liées
            $stmt = $this->db->prepare("DELETE FROM cours_test WHERE test_id = ?");
            $stmt->execute([$testId]);
    
            $stmt = $this->db->prepare("DELETE FROM test_question WHERE test_id = ?");
            $stmt->execute([$testId]);
    
            // Ensuite, supprimer la ligne dans la table parente `test`
            $stmt = $this->db->prepare("DELETE FROM test WHERE id_test = ?");
            $stmt->execute([$testId]);
        
            $this->db->commit();
        } catch (PDOException $e) {
            $this->db->rollBack();
            throw $e;
        }
    }
    
    

    public function getAllTests() {
        $stmt = $this->db->prepare("SELECT t.*, GROUP_CONCAT(q.question_text SEPARATOR '|') AS questions, GROUP_CONCAT(CONCAT_WS(':', q.option_1, q.option_2, q.option_3, q.correct_option) SEPARATOR '|') AS options, GROUP_CONCAT(DISTINCT c.titre SEPARATOR ', ') AS cours
                                    FROM test t 
                                    LEFT JOIN test_question tq ON t.id_test = tq.test_id 
                                    LEFT JOIN question q ON tq.question_id = q.id_question 
                                    LEFT JOIN cours_test ct ON t.id_test = ct.test_id
                                    LEFT JOIN cours c ON ct.cours_id = c.id_cours
                                    GROUP BY t.id_test");
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $results;
    }    
    
    
public function updateTest($testId, $quizTitle, $questions, $coursIds) {
    $this->db->beginTransaction();
    try {
        // Mise à jour du titre du test
        $stmt = $this->db->prepare("UPDATE test SET quiz_title = ? WHERE id_test = ?");
        $stmt->execute([$quizTitle, $testId]);

        // Suppression des questions existantes liées à ce test
        $stmt = $this->db->prepare("DELETE FROM test_question WHERE test_id = ?");
        $stmt->execute([$testId]);

        // Insertion des nouvelles associations de questions
        $stmt = $this->db->prepare("INSERT INTO test_question (test_id, question_id) VALUES (?, ?)");
        foreach ($questions as $questionId) {
            $stmt->execute([$testId, $questionId]);
        }

        // Gestion des cours associés
        // Suppression des cours existants liés à ce test
        $stmt = $this->db->prepare("DELETE FROM cours_test WHERE test_id = ?");
        $stmt->execute([$testId]);

        // Insertion des nouveaux cours associés
        $stmt = $this->db->prepare("INSERT INTO cours_test (test_id, cours_id) VALUES (?, ?)");
        foreach ($coursIds as $coursId) {
            $stmt->execute([$testId, $coursId]);
        }

        $this->db->commit();
    } catch (PDOException $e) {
        $this->db->rollBack();
        throw $e;
    }
}

public function getTestDetails($testId) {
    $stmt = $this->db->prepare("SELECT t.id_test, t.quiz_title, t.utilisateur, t.note_obtenue, GROUP_CONCAT(c.titre SEPARATOR ', ') AS cours
                                FROM test t 
                                LEFT JOIN cours_test ct ON t.id_test = ct.test_id
                                LEFT JOIN cours c ON ct.cours_id = c.id_cours
                                WHERE t.id_test = ?");
    $stmt->execute([$testId]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        $cours = explode(', ', $result['cours'] ?? '');  // Convertissez la chaîne en tableau
        $test = new TestModel($result['id_test'], $result['quiz_title'], $result['utilisateur'], $result['note_obtenue'], [], $cours);
        return $test;
    } else {
        return null;
    }
}


    public function getAllQuestions() {
        $stmt = $this->db->prepare("SELECT id_question, quiz_title FROM question");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getQuestionInfo($questionId) {
        $stmt = $this->db->prepare("SELECT * FROM question WHERE id_question = ?");
        $stmt->execute([$questionId]);
        $question = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($question) {
            // Récupérer les options de réponse
            $stmt = $this->db->prepare("SELECT option_1, option_2, option_3, correct_option FROM question WHERE id_question = ?");
            $stmt->execute([$questionId]);
            $options = $stmt->fetch(PDO::FETCH_ASSOC);
    
            // Assurez-vous que $options est un tableau même si les options sont vides
            $question['options'] = $options ? $options : array();
        }
    
        return $question;
    }

    public function getTestTitlesForDropdown() {
        $stmt = $this->db->prepare("SELECT t.id_test, t.quiz_title, GROUP_CONCAT(c.titre) AS cours 
                                    FROM test t 
                                    LEFT JOIN cours_test ct ON t.id_test = ct.test_id 
                                    LEFT JOIN cours c ON ct.cours_id = c.id_cours 
                                    GROUP BY t.id_test");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    public function getQuestionsForTest($testId) {
        $stmt = $this->db->prepare("SELECT q.*, tq.question_id FROM test_question tq JOIN question q ON tq.question_id = q.id_question WHERE tq.test_id = ?");
        $stmt->execute([$testId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function evaluateTest($testId, $username, $responses) {
        $totalQuestions = count($responses);
        $correctAnswers = 0;
    
        // Calcule le nombre de réponses correctes
        foreach ($responses as $questionId => $selectedOption) {
            $question = $this->getQuestionInfo($questionId);
            if ($question && $selectedOption == $question['correct_option']) {
                $correctAnswers++;
            }
        }
    
        // Calcule le score
        $score = ($totalQuestions > 0) ? "$correctAnswers / $totalQuestions" : "0 / 0";
    
        // Insère les résultats dans la table test_results
        $stmt = $this->db->prepare("INSERT INTO test_results (test_id, username, score) VALUES (?, ?, ?)");
        $stmt->execute([$testId, $username, $score]);
    
        return $score;
    }

    public function getAllCours() {
        // requête pour obtenir tous les cours
        $query = "SELECT id_cours, titre FROM cours";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createTestWithCours($quizTitle, $questions, $cours) {
        // Démarrez une transaction pour assurer l'intégrité des données
        $this->db->beginTransaction();
    
        try {
            // Insertion du test
            $stmt = $this->db->prepare("INSERT INTO test (quiz_title) VALUES (?)");
            $stmt->execute([$quizTitle]);
            $testId = $this->db->lastInsertId(); // Récupérez l'ID du test inséré
    
            // Association des questions au test
            $stmt = $this->db->prepare("INSERT INTO test_question (test_id, question_id) VALUES (?, ?)");
            foreach ($questions as $questionId) {
                $stmt->execute([$testId, $questionId]);
            }
    
            // Association des cours au test
            $stmt = $this->db->prepare("INSERT INTO cours_test (test_id, cours_id) VALUES (?, ?)");
            foreach ($cours as $coursId) {
                $stmt->execute([$testId, $coursId]);
            }
    
            // Validez la transaction
            $this->db->commit();
        } catch (Exception $e) {
            // Une erreur s'est produite, annulez la transaction
            $this->db->rollBack();
            throw $e;  // Renvoie l'exception pour une gestion d'erreur ultérieure
        }
    }    
    


public function getTestsParCours() {
    // Initialisation du tableau de tests par cours
    $testsParCours = array();

    // Récupération de tous les cours
    $cours = $this->getAllCours();

    // Pour chaque cours, récupérer les tests associés
    foreach ($cours as $cours) {
        // Récupération des tests associés à ce cours depuis la base de données
        $tests = $this->fetchTestsByCoursId($cours['id_cours']);
        
        // Ajout des tests associés à ce cours dans le tableau $testsParCours
        $testsParCours[$cours['id_cours']] = $tests;
    }

    return $testsParCours;
}

// Méthode pour récupérer les cours associés à chaque test
public function getCoursesForTest($testId) {
    $stmt = $this->db->prepare("SELECT c.id_cours, c.titre FROM cours c JOIN cours_test ct ON c.id_cours = ct.cours_id WHERE ct.test_id = ?");
    $stmt->execute([$testId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


public function fetchTestsByCoursId($coursId) {
    try {
        // Préparez la requête SQL pour récupérer les tests associés au cours spécifié
        $stmt = $this->db->prepare("SELECT id_test, quiz_title FROM test JOIN cours_test ON test.id_test = cours_test.test_id WHERE cours_test.cours_id = ?");
        $stmt->execute([$coursId]);
        
        // Récupérez les résultats de la requête
        $tests = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $tests;
    } catch (PDOException $e) {
        // Gérez l'exception selon vos besoins
        throw $e;
    }
}
}

?>
