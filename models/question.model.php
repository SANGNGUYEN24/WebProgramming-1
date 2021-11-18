<?php
class QuestionModel{
    public $quizId;
    public $questionId;
    public $content;
    public $option1;
    public $option2;
    public $option3;
    public $option4;

    public function __construct($quizId, $questionId, $content, $option1, $option2, $option3, $option4){
        $this->quizId = $quizId;
        $this->questionId = $questionId;
        $this->content = $content;
        $this->option1 = $option1;
        $this->option2 = $option2;
        $this->option3 = $option3;
        $this->option4 = $option4;
    }
    

}