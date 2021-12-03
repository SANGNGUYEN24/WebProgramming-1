<?php

require_once 'MyDatabase.php';

class Teacher
{
  private $teacherId;
  private $courseIds;
  private $dtb;

  public function __construct(
    $teacherId
  ) {
    $this->dtb = new MyDatabase();
    $this->teacherId = $teacherId;
    $this->getCourseIdsFromTeacher();
  }

  public function random_course_id()
  {
    $chars = "C-";
    $numbers = str_repeat("0123456789", 10);
    $courseId =  $chars . substr(str_shuffle($numbers), 0, 10);
    return $courseId;
  }

  public function getTeacherId()
  {
    return $this->teacherId;
  }

  public function getCourseIds()
  {
    return $this->courseIds;
  }

  public function getCourseIdsFromTeacher()
  {
    $teacher = $this->dtb->teacherCollection->findOne(['teacherId' => $this->teacherId]);
    $this->courseIds = iterator_to_array($teacher->courseIds);
  }

  public function getAllCoursesBelongsTo()
  {
    $teacherCourses = array();
    foreach ($this->courseIds as $courseId) {
      $course = $this->dtb->courseCollection->findOne(['courseId' => $courseId]);
      array_push($teacherCourses, $course);
    }
    return $teacherCourses;
  }

  public function addCourse($courseName = "")
  {
    if ($courseName == "") return;

    // Create new course id by random function:
    $newCourseId = $this->random_course_id();

    // Add new course to Course collection: 
    $addResult = $this->dtb->courseCollection->insertOne([
      'courseId' => $newCourseId,
      'teacherId' => $this->teacherId,
      'name' => $courseName,
      'year' => date("Y"),
    ]);

    // Get updates courseIds for teacher:
    array_push($this->courseIds, $newCourseId);

    // Update to teacher collection:
    $updateResult = $this->dtb->teacherCollection->updateOne(
      ['teacherId' => $this->teacherId],
      ['$set' => ['courseIds' => $this->courseIds]]
    );

    return [[$addResult->getInsertedCount(), $updateResult->getModifiedCount()], $newCourseId];
  }

  public function editCourseName($targetCourseId = "", $courseName = "")
  {
    if ($targetCourseId == "" || $courseName == "") return;

    // Update courseName:
    $updateResult = $this->dtb->courseCollection->updateOne(
      ['courseId' => $targetCourseId],
      ['$set' => ['name' => $courseName]]
    );

    return $updateResult->getModifiedCount();
  }

  public function deleteCourse($targetCourseId = "")
  {
    if ($targetCourseId == "") return;

    // Initialize return value:
    $deletedMarks = 0;
    $deletedQuestions = 0;
    $deletedQuizzes = 0;
    $deletedCourse = 0;

    // Get all quiz that course has:
    $quizzes = $this->dtb->quizCollection->find(['courseId' => $targetCourseId]);

    // Delete all marks and questions:
    foreach ($quizzes as $quiz) {
      $deletedMarks += $this->dtb->markCollection->deleteMany([
        'quizId' => $quiz->quizId
      ])->getDeletedCount();
      $deletedQuestions += $this->dtb->questionCollection->deleteMany([
        'quizId' => $quiz->quizId
      ])->getDeletedCount();
    }

    // Delete all quizzes and courseId:
    $deletedQuizzes += $this->dtb->quizCollection->deleteMany(['courseId' => $targetCourseId])->getDeletedCount();
    $deletedCourse += $this->dtb->courseCollection->deleteOne(['courseId' => $targetCourseId])->getDeletedCount();

    // Update courseIds for teacher:
    $targetCoursePosition = array_search($targetCourseId, $this->courseIds);
    array_splice($this->courseIds, $targetCoursePosition, 1);
    $updateCourseIdsOfTeacher = $this->dtb->teacherCollection->updateOne(
      ['teacherId' => $this->teacherId],
      ['$set' => ['courseIds' => $this->courseIds]]
    );
    return [$deletedMarks, $deletedQuestions, $deletedQuizzes, $deletedCourse, $updateCourseIdsOfTeacher->getModifiedCount()];
  }
}
