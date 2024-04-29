<?php
require_once '../Model/QuestionModel.php';
require_once '../config.php';

class QuestionController
{
    private $db = null;

    public function __construct(){
        $this->db = config::getConnexion();
    }

    public function addQuestion(QuestionModel $model){
       $currentDate = date("Y-m-d H:i:s");
       $sql ="INSERT INTO question (updated_at, created_at, quiz_title, question_text, option_1, option_2, option_3, correct_option) VALUES (? , ? , ? , ? , ? , ? , ? , ?)";
       $stmt = $this->db->prepare($sql);
       $stmt->EXECUTE([$currentDate,$currentDate, $model->getQuizTitle(), $model->getQuestionText(), $model->getOption1(), $model->getOption2(), $model->getOption3(), $model->getCorrectOption()]);
       echo 'done';
    }
    
    public function deleteQuestion($id_question){
        $sql = "DELETE FROM question WHERE id_question = :id_question";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id_question', $id_question);
        $stmt->execute();
        echo 'done';
    }

    public function showQuestion($id_question)
    {
        $sql = "SELECT * FROM question WHERE id_question = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindParam(':id', $id_question);
            $query->execute();
            $questionDetails = $query->fetch(PDO::FETCH_ASSOC);
            return $questionDetails;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function updateQuestion($id_question, $quizTitle, $questionText, $option1, $option2, $option3,$correctOption )
    {
        $pdo = config::getConnexion();

        try {
            $query = $pdo->prepare("UPDATE question 
                                    SET quiz_title = :quiz_title, 
                                    question_text = :question_text,  
                                    option_1 = :option1, 
                                    option_2 = :option2, 
                                    option_3 = :option3, 
                                    correct_option = :correct_option
                                    WHERE id_question = :id");

            $query->bindParam(':id', $id_question);
            $query->bindParam(':quiz_title', $quizTitle);
            $query->bindParam(':question_text', $questionText);
            $query->bindParam(':option1', $option1);
            $query->bindParam(':option2', $option2);
            $query->bindParam(':option3', $option3);
            $query->bindParam(':correct_option', $correctOption);

            $query->execute();

            return "Quizz details updated successfully";
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }
        

    public function getQuestionById($questionId)
    {

        $sql="SELECT * FROM question WHERE id_question= :questionId";
        $db = config::getConnexion();
        $req=$db->prepare($sql);
        $req->bindValue(':questionId', $questionId);
        try{


            $req->execute();
            $questioninfo=$req->fetch(PDO::FETCH_ASSOC);
            return $questioninfo;
        }catch (PDOException $e) {
            die("Error executing query: " . $e->getMessage()); 

        }
    }
    
    public function getQuestionDetails($id_question)
    {
        $sql="SELECT * FROM question WHERE id_question= :questionId";
        $db = config::getConnexion();
        $req=$db->prepare($sql);
        $req->bindValue(':questionId', $id_question);
        try{
            $req->execute();
            $questioninfo=$req->fetch(PDO::FETCH_ASSOC);
            return $questioninfo ? $questioninfo : false; // Retourner false si aucune question n'est trouvée
        }catch (PDOException $e) {
            die("Error executing query: " . $e->getMessage()); 
        }
    }

    public function getQuizTitles() {
        $questionModel = new QuestionModel($this->db);
        return $questionModel->getAllQuizTitles();
    }
    
}

?>
