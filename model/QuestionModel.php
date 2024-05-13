<?php

class QuestionModel
{
    private ?int $id_question = null;
    private ?string $quiz_title = null; // Supprimer cette ligne
    private ?string $updated_at = null;
    private ?string $created_at = null;
    private ?string $question_text = null;
    private ?string $option_1 = null;
    private ?string $option_2 = null;
    private ?string $option_3 = null;
    private ?string $correct_option = null;
    private $questions;

    public function __construct($id_question = null, $quiz_title = null, $question_text = null, $option_1 = null, $option_2 = null, $option_3 = null, $correct_option = null)
    {
        $this->id_question = $id_question;
        $this->quiz_title = $quiz_title;
        $this->question_text = $question_text;
        $this->option_1 = $option_1;
        $this->option_2 = $option_2;
        $this->option_3 = $option_3;
        $this->correct_option = $correct_option;
    }

    // Rest of the class code...


    /**
     * Get the value of id_question
     */
    public function getIdQuestion()
    {
        return $this->id_question;
    }

    /**
     * Get the value of updated_at
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Get the value of created_at
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function getAllQuizTitles() {
        $stmt = $this->db->prepare("SELECT DISTINCT quiz_title FROM question");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
    

        /**
     * Get the value of question_text
     */
    public function getQuizTitle()
    {
        return $this->quiz_title;
    }

    /**
     * Set the value of question_text
     *
     * @return  self
     */
    public function setQuizTitle($quiz_title)
    {
        $this->quiz_title = $quiz_title;

        return $this;
    }

    /**
     * Get the value of question_text
     */
    public function getQuestionText()
    {
        return $this->question_text;
    }

    /**
     * Set the value of question_text
     *
     * @return  self
     */
    public function setQuestionText($question_text)
    {
        $this->question_text = $question_text;

        return $this;
    }

    /**
     * Get the value of option_1
     */
    public function getOption1()
    {
        return $this->option_1;
    }

    /**
     * Set the value of option_1
     *
     * @return  self
     */
    public function setOption1($option_1)
    {
        $this->option_1 = $option_1;

        return $this;
    }

    /**
     * Get the value of option_2
     */
    public function getOption2()
    {
        return $this->option_2;
    }

    /**
     * Set the value of option_2
     *
     * @return  self
     */
    public function setOption2($option_2)
    {
        $this->option_2 = $option_2;

        return $this;
    }

    /**
     * Get the value of option_3
     */
    public function getOption3()
    {
        return $this->option_3;
    }

    /**
     * Set the value of option_3
     *
     * @return  self
     */
    public function setOption3($option_3)
    {
        $this->option_3 = $option_3;

        return $this;
    }

    /**
     * Get the value of correct_option
     */
    public function getCorrectOption()
    {
        return $this->correct_option;
    }

    /**
     * Set the value of correct_option
     *
     * @return  self
     */
    public function setCorrectOption($correct_option)
    {
        $this->correct_option = $correct_option;

        return $this;
    }

    public function setQuestions($questions) {
        $this->questions = $questions;
    }

    // Method to get questions
    public function getQuestions() {
        return $this->questions;
    }
}