<?php

require './app/Models/Course.php';

class CourseTest extends \PHPUnit\Framework\TestCase
{
  protected $course;

  public function setUp(): void
  {
    $this->course = new Course('C-7960351842', 'TC-4203517869');
  }

  public function testGetAllQuizzesBelongsTo()
  {
    $quizzes =  $this->course->getAllQuizzesBelongsTo();
    $quizzesIds = array();
    foreach ($quizzes as $quiz) {
      array_push($quizzesIds, $quiz->quizId);
    }
    $this->assertEquals($quizzesIds, array('Q-4238061597', 'Q-0329681754'));
  }

  public function testCRUDOfQuiz()
  {
    // Test adding quiz:
    $addQuizResult = $this->course->addQuiz(
      "Midterm Chemistry",
      "2021-11-30",
      "2021-12-1",
    );
    $this->assertEquals($addQuizResult[0], 1);

    // Test edit quiz:
    $editQuizResult = $this->course->editQuiz(
      $addQuizResult[1],
      "Final Web-Programming",
      "2021-11-30",
      "2021-12-1",
    );
    $this->assertEquals($editQuizResult, array(1, 1));

    // Test delete quiz:
    $deleteQuizResult = $this->course->deleteQuiz($addQuizResult[1]);
    $this->assertEquals($deleteQuizResult, array(0, 0, 1));
  }
}
