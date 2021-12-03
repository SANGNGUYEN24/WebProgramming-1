<?php

require_once './app/Models/Teacher.php';

class TeacherTest extends \PHPUnit\Framework\TestCase
{
  protected $teacher;

  public function setUp(): void
  {
    $this->teacher = new Teacher('TC-7320685914');
  }

  public function testGetCourseIds()
  {
    $this->assertEquals($this->teacher->getCourseIds(), array("C-2490578136", "C-0527368149"));
  }

  public function testGetCourses()
  {
    $courses = $this->teacher->getAllCoursesBelongsTo();
    $coursesIds = array();
    foreach ($courses as $course) {
      array_push($coursesIds, $course->courseId);
    }
    $this->assertEquals($coursesIds, array("C-2490578136", "C-0527368149"));
  }

  public function testAddCourse()
  {
    $insertCourseResult = $this->teacher->addCourse('Web Programming');
    $this->assertEquals($insertCourseResult[0], [1, 1]);

    return $insertCourseResult[1];
  }

  /**
   * @depends testAddCourse
   */
  public function testEditCourse($courseId)
  {
    $editCourseName = $this->teacher->editCourseName($courseId, 'Data Structure');
    $this->assertEquals($editCourseName, 1);

    return $courseId;
  }

  /**
   * @depends testEditCourse
   */
  public function testDeleteCourse($courseId)
  {
    $deleteCourseResult = $this->teacher->deleteCourse($courseId);
    $this->assertEquals($deleteCourseResult, [0, 0, 0, 1, 1]);
  }
}




