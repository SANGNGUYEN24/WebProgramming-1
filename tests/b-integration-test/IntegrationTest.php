<?php

require_once './app/Models/Teacher.php';
require_once './app/Models/Course.php';
require_once './app/Models/Quiz.php';

class IntegrationTest extends \PHPUnit\Framework\TestCase
{
  protected $teacher;

  public function setUp(): void
  {
    $this->teacher = new Teacher('TC-7320685914');
  }

  public function testAddOpertion()
  {
    // 1. Add new course:
    $insertCourseResult = $this->teacher->addCourse('Web Programming');
    $this->assertEquals($insertCourseResult[0], [1, 1]);

    // Create new course object based on new courseId:
    $newCourseId = $insertCourseResult[1];
    $newCourse = new Course($newCourseId, $this->teacher->getTeacherId());

    // 2. Add new quiz to the new course:
    $addQuizResult = $newCourse->addQuiz(
      "Final Examination",
      "2021-12-23",
      "2021-12-24",
    );
    $this->assertEquals($addQuizResult[0], 1);

    // Create new quiz object based on new quizId:
    $newQuizId = $addQuizResult[1];
    $newQuiz = new Quiz($newCourse->getCourseId(), $newQuizId);

    // 3. Add new question to quiz:
    $insertQuestionResult = $newQuiz->addQuestion(
      "What does PDO stand for?",
      "PHP Database Orientation",
      "PHP Data Orientation",
      "PHP Data Object",
      "PHP Database Object",
      1,
    );
    $this->assertEquals($insertQuestionResult[0], 1);

    // Get id from new question:
    $newQuestionId = $insertQuestionResult[1];

    return [$newCourse, $newQuiz, $newQuestionId];
  }

  /**
   * @depends testAddOpertion
   */
  public function testEditOperation($addResult)
  {
    // Get value from testAddOperation():
    $targetCourse = $addResult[0];
    $targetQuiz = $addResult[1];
    $targetQuestionId = $addResult[2];

    // 1. Edit course:
    $editCourseName = $this->teacher->editCourseName($targetCourse->getCourseId(), 
                                                    'Programming Web');
    $this->assertEquals($editCourseName, 1);

    // 2. Edit quiz:
    $editQuizResult = $targetCourse->editQuiz(
      $targetQuiz->getQuizId(),
      "Midterm Exam",
      "2021-12-24",
      "2021-12-25",
    );
    $this->assertEquals($editQuizResult, 1);

    // 3. Edit question:
    $updatedQuestionResult = $targetQuiz->editQuestion(
      $targetQuestionId,
      "What does PHP stands for?",
      "Hypertext Preprocessor",
      "Pretext Hypertext Preprocessor",
      "Personal Home Processor",
      "None of the above",
      2,
    );
    $this->assertEquals($updatedQuestionResult, 1);

    return [$targetCourse, $targetQuiz, $targetQuestionId];
  }

  /**
   * @depends testEditOperation
   */
  public function testDeleteOperation($editResult)
  {

    // Get value from testEditOperation():
    $targetCourse = $editResult[0];
    $targetQuiz = $editResult[1];
    $targetQuestionId = $editResult[2];

    // 1. Delete Testing:
    // Delete course:
    $deleteCourseResult = $this->teacher->deleteCourse($targetCourse->getCourseId());
    $this->assertEquals($deleteCourseResult, [0, 1, 1, 1, 1]);

    return [$targetCourse, $targetQuiz, $targetQuestionId];
  }

  /**
   * @depends testDeleteOperation
   */
  public function testGetOperation($deleteResult)
  {
    // Get value from testDeleteOperation():
    $targetCourse = $deleteResult[0];
    $targetQuiz = $deleteResult[1];
    $targetQuestionId = $deleteResult[2];

    // Get all ids of courses created by teacher:
    $this->assertEquals($this->teacher->getCourseIds(), array("C-2490578136", "C-0527368149"));

    // Get all courses belongs to the teacher:
    $courses = $this->teacher->getAllCoursesBelongsTo();
    $coursesIds = array();
    foreach ($courses as $course) {
      array_push($coursesIds, $course->courseId);
    }
    $this->assertEquals($coursesIds, array("C-2490578136", "C-0527368149"));

    // Get all courses belongs to new course:
    $quizzes =  $targetCourse->getAllQuizzesBelongsTo();
    $questions = $targetQuiz->getAllQuestionsBelongsTo();
    $this->assertEquals(count($quizzes->toArray()), 0);
    $this->assertEquals(count($questions->toArray()), 0);

    return [$targetCourse, $targetQuiz, $targetQuestionId];
  }

  /**
   * @depends testGetOperation
   */
  public function testFailedOperation($getOperation)
  {
    // Get value from testGetOperation():
    $targetCourse = $getOperation[0];
    $targetQuiz = $getOperation[1];
    $targetQuestionId = $getOperation[2];

    // 1. Edit the course doesn't exist in datbase:
    $editCourseName = $this->teacher->editCourseName($targetCourse->getCourseId(), 'Web Programming');
    $this->assertEquals($editCourseName, 0);

    // 2. Edit the quiz doesn't exist in database:
    $editQuizResult = $targetCourse->editQuiz(
      $targetQuiz->getQuizId(),
      "Midterm Exam",
      "2021-12-24",
      "2021-12-25",
    );
    $this->assertEquals($editQuizResult, 0);

    // 3. Delete the quiz doesn't exist in database:
    $deleteQuizResult = $targetCourse->deleteQuiz($targetQuiz->getQuizId());
    $this->assertEquals($deleteQuizResult, [0, 0, 0]);
  }
}
