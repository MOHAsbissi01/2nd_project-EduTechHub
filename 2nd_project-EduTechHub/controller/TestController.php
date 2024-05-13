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
            // Supprimer d'abord les entrées dans la table enfant
            $stmt = $this->db->prepare("DELETE FROM test_question WHERE test_id = ?");
            $stmt->execute([$testId]);
            
            // Ensuite, supprimer la ligne dans la table parente
            $stmt = $this->db->prepare("DELETE FROM test WHERE id_test = ?");
            $stmt->execute([$testId]);
    
            $this->db->commit();
        } catch (PDOException $e) {
            $this->db->rollBack();
            throw $e;
        }
    }
    

    public function getAllTests() {
        $stmt = $this->db->prepare("SELECT t.*, GROUP_CONCAT(q.question_text SEPARATOR '|') AS questions, GROUP_CONCAT(CONCAT_WS(':', q.option_1, q.option_2, q.option_3, q.correct_option) SEPARATOR '|') AS options
                                    FROM test t 
                                    LEFT JOIN test_question tq ON t.id_test = tq.test_id 
                                    LEFT JOIN question q ON tq.question_id = q.id_question 
                                    GROUP BY t.id_test");
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $results;
    }
    
    

    public function updateTest($testId, $quizTitle, $questions) {
        $this->db->beginTransaction();
        try {
            $stmt = $this->db->prepare("UPDATE test SET quiz_title = ? WHERE id_test = ?");
            $stmt->execute([$quizTitle, $testId]);

            $stmt = $this->db->prepare("DELETE FROM test_question WHERE test_id = ?");
            $stmt->execute([$testId]);

            $stmt = $this->db->prepare("INSERT INTO test_question (test_id, question_id) VALUES (?, ?)");
            foreach ($questions as $questionId) {
                $stmt->execute([$testId, $questionId]);
            }

            $this->db->commit();
        } catch (PDOException $e) {
            $this->db->rollBack();
            throw $e;
        }
    }

    public function getTestDetails($testId) {
        $stmt = $this->db->prepare("SELECT t.id_test, t.quiz_title, t.utilisateur, t.note_obtenue 
                                    FROM test t 
                                    WHERE t.id_test = ?");
        $stmt->execute([$testId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            $test = new TestModel($result['id_test'], $result['quiz_title'], $result['utilisateur'], $result['note_obtenue'], []);
            // Optionally fetch questions here if needed and set to model
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
        $stmt = $this->db->prepare("SELECT id_test, quiz_title FROM test ORDER BY quiz_title");
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
    
    
    
}
?>
