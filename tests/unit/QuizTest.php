<?php

require './app/Models/Quiz.php';

class QuizTest extends \PHPUnit\Framework\TestCase
{
  protected $quiz;

  public function setUp(): void
  {
    $this->quiz = new Quiz('C-7960351842', 'Q-4238061597');
  }

  public function testGetAllQuestionsBelongsTo()
  {
    $questions = $this->quiz->getAllQuestionsBelongsTo();
    $checkQuestions = true;
    $numberOfQuestions = 0;
    foreach ($questions as $question) {
      if ($question->quizId != 'Q-4238061597' | $question->courseId != 'C-7960351842') {
        $checkQuestions = false;
      }
      $numberOfQuestions++;
    }
    $this->assertEquals($checkQuestions, true);
    $this->assertEquals($numberOfQuestions, 5);
  }

  public function testGetAllMarksBelongsTo()
  {
    $marks = $this->quiz->getAllMarksBelongsTo();
    $checkMarks = true;
    $numberOfMarks = 0;
    foreach ($marks as $mark) {
      if ($mark->quizId != 'Q-4238061597') {
        $checkMarks = false;
      }
      $numberOfMarks++;
    }
    $this->assertEquals($checkMarks, true);
    $this->assertEquals($numberOfMarks, 1);
  }

  public function testCRUDofQuestion()
  {
    // Insert question to quiz:
    $insertQuestionResult = $this->quiz->addQuestion(
      "What is the correct format for aligning written content to the center of the page in CSS?",
      "Text-align:center;",
      "Font-align:center;",
      "Text:align-center;",
      "Font:align-center;",
      2,
    );
    $this->assertEquals($insertQuestionResult, 1);

    // Find inserted question
    $insertedQuestion = $this->quiz->getQuestionByDescription("What is the correct format for aligning written content to the center of the page in CSS?");

    // Update question of quiz:
    $updatedQuestionResult = $this->quiz->editQuestion(
      $insertedQuestion->_id,
      "What is the correct format for a div?",
      "Div-id=example",
      "Div id='example'",
      "Div='example'",
      "Div.example",
      1,
    );
    $this->assertEquals($updatedQuestionResult, array(1, 1));

    // Delete question of quiz:
    $deleteQuestionResult = $this->quiz->deleteQuestion($insertedQuestion->_id);
    $this->assertEquals($deleteQuestionResult, 1);
  }
}
