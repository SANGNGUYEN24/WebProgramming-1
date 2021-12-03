<?php

require_once './app/Models/Quiz.php';

class QuizTest extends \PHPUnit\Framework\TestCase
{
  protected $quiz;

  public function setUp(): void
  {
    $this->quiz = new Quiz('C-2490578136', 'Q-4670135892');
  }

  public function testGetQuestions()
  {
    $questions = $this->quiz->getAllQuestionsBelongsTo();
    $checkQuestions = true;
    $numberOfQuestions = 0;
    foreach ($questions as $question) {
      if ($question->quizId != $this->quiz->getQuizId() || $question->courseId != $this->quiz->getCourseId()) {
        $checkQuestions = false;
      }
      $numberOfQuestions++;
    }
    $this->assertEquals($checkQuestions, true);
    $this->assertEquals($numberOfQuestions, 5);
  }

  public function testGetMarks()
  {
    $marks = $this->quiz->getAllMarksBelongsTo();
    $checkMarks = true;
    $numberOfMarks = 0;
    foreach ($marks as $mark) {
      if ($mark->quizId != $this->quiz->getQuizId()) {
        $checkMarks = false;
      }
      $numberOfMarks++;
    }
    $this->assertEquals($checkMarks, true);
    $this->assertEquals($numberOfMarks, 10);
  }

  public function testAddQuestion()
  {
    $insertQuestionResult = $this->quiz->addQuestion(
      "What is the correct format for aligning written content to the center of the page in CSS?",
      "Text-align:center;",
      "Font-align:center;",
      "Text:align-center;",
      "Font:align-center;",
      2,
    );
    $this->assertEquals($insertQuestionResult[0], 1);

    return $this->quiz->getQuestionById($insertQuestionResult[1]);
  }

  /**
   * @depends testAddQuestion
   */
  public function testEditQuestion($question)
  {
    $updatedQuestionResult = $this->quiz->editQuestion(
      $question->_id,
      "What is the correct format for a div?",
      "Div-id=example",
      "Div id='example'",
      "Div='example'",
      "Div.example",
      1,
    );
    $this->assertEquals($updatedQuestionResult, 1);
    return $question;
  }

  /**
   * @depends testEditQuestion
   */
  public function testDeleteQuestion($question)
  {
    $deleteQuestionResult = $this->quiz->deleteQuestion($question->_id);
    $this->assertEquals($deleteQuestionResult, 1);
  }
}
