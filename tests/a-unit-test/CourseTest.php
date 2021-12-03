<?php

require_once './app/Models/Course.php';

class CourseTest extends \PHPUnit\Framework\TestCase
{
  protected $course;

  public function setUp(): void
  {
    $this->course = new Course('C-2490578136', 'TC-7320685914');
  }

  public function testGetQuizzes()
  {
    $quizzes =  $this->course->getAllQuizzesBelongsTo();
    $quizzesIds = array();
    foreach ($quizzes as $quiz) {
      array_push($quizzesIds, $quiz->quizId);
    }
    $this->assertEquals($quizzesIds, array('Q-4670135892', 'Q-2790518436'));
  }

  public function testAddQuiz()
  {
    $addQuizResult = $this->course->addQuiz(
      "Midterm Chemistry",
      "2021-11-30",
      "2021-12-1",
    );
    $this->assertEquals($addQuizResult[0], 1);
    return $addQuizResult[1];
  }

  /**
   * @depends testAddQuiz
   */
  public function testEditQuiz($quizId)
  {
    $editQuizResult = $this->course->editQuiz(
      $quizId,
      "Final Web-Programming",
      "2021-11-30",
      "2021-12-1",
    );
    $this->assertEquals($editQuizResult, 1);
    return $quizId;
  }

  /**
   * @depends testEditQuiz
   */
  public function testDeleteQuiz($quizId)
  {
    $deleteQuizResult = $this->course->deleteQuiz($quizId);
    $this->assertEquals($deleteQuizResult, [0, 0, 1]);
  }
}



