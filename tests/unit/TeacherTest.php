<?php

require './app/Models/Teacher.php';

class TeacherTest extends \PHPUnit\Framework\TestCase
{
  protected $teacher;

  public function setUp(): void
  {
    // Create a new teacher for all tests:
    $this->teacher = new Teacher('TC-4203517869');
  }

  public function testGetCourseIds()
  {
    $this->assertEquals($this->teacher->getCourseIds(), array("C-7960351842", "C-3759642018"));
  }

  public function testAllCoursesBelongsTo()
  {
    $courses = $this->teacher->getAllCoursesBelongsTo();
    $coursesIds = array();
    foreach ($courses as $course) {
      array_push($coursesIds, $course->courseId);
    }
    $this->assertEquals($coursesIds, array("C-7960351842", "C-3759642018"));
  }

  public function TestCRUDofCourse()
  {
    // Insert new course:
    $insertCourseResult = $this->teacher->addCourse('Web Programming');
    $this->assertEquals($insertCourseResult[1], array(1, 1, 1));

    // Get new course's id:
    $newCourseId = $insertCourseResult[0];

    // Edit course name:
    $editCourseName = $this->teacher->editCourseName($newCourseId, 'Data Structure');
    $this->assertEquals($editCourseName, array(1, 1));

    // Delete course:
    $deleteCourseResult = $this->teacher->deleteCourse($newCourseId);
    $this->assertEquals($deleteCourseResult, array(1, 1, 1));
  }
}
