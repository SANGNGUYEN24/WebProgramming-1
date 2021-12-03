<?php

require_once 'MyDatabase.php';
date_default_timezone_set('Asia/Ho_Chi_Minh');

class Course
{
  private $teacherId;
  private $courseId;
  private $dtb;

  public function __construct(
    $courseId,
    $teacherId
  ) {
    $this->dtb = new MyDatabase();
    $this->courseId = $courseId;
    $this->teacherId = $teacherId;
  }

  public function getCourseId()
  {
    return $this->courseId;
  }

  public function getTeacherId()
  {
    return $this->teacherId;
  }

  public function random_quiz_id()
  {
    $chars = "Q-";
    $numbers = str_repeat("0123456789", 10);
    $quizId = $chars . substr(str_shuffle($numbers), 0, 10);
    return $quizId;
  }

  public function getAllQuizzesBelongsTo()
  {
    $quizzes = $this->dtb->quizCollection->find(['courseId' => $this->courseId, 'teacherId' => $this->teacherId]);
    return $quizzes;
  }

  public function addQuiz($quizName = "", $startDate = "", $dueDate = "")
  {
    if ($quizName == "" || $startDate == "" || $dueDate == "") {
      return;
    }

    $quizId = $this->random_quiz_id();

    $insertQuizResult = $this->dtb->quizCollection->insertOne([
      'quizId' => $quizId,
      'teacherId' => $this->teacherId,
      'courseId' => $this->courseId,
      'name' => $quizName,
      'createdDate' => date("Y-m-d H:i:s"),
      'startDate' => $startDate,
      'dueDate' => $dueDate,
    ]);

    return array($insertQuizResult->getInsertedCount(), $quizId);
  }

  public function editQuiz($targetQuizId = "", $quizName = "", $startDate = "", $dueDate = "")
  {
    if ($targetQuizId == "" || $quizName == "" || $startDate == "" || $dueDate == "") {
      return;
    }

    $updateQuizResult = $this->dtb->quizCollection->updateOne(
      ['quizId' => $targetQuizId],
      ['$set' => [
        'name' => $quizName,
        'startDate' => $startDate,
        'dueDate' => $dueDate,
        'createdDate' => date("Y-m-d H:i:s"),
      ]]
    );

    return $updateQuizResult->getModifiedCount();
  }

  public function deleteQuiz($targetQuizId = "")
  {
    if ($targetQuizId == "") {
      return;
    }

    // Delete all marks and questions related to quizId:
    $deleteMarksResult = $this->dtb->markCollection->deleteMany([
      'quizId' => $targetQuizId
    ]);

    $deleteQuestionsResult = $this->dtb->questionCollection->deleteMany([
      'quizId' => $targetQuizId
    ]);

    // Delete quiz
    $deleteQuizResult = $this->dtb->quizCollection->deleteOne(['quizId' => $targetQuizId]);

    return [$deleteMarksResult->getDeletedCount(), $deleteQuestionsResult->getDeletedCount(), $deleteQuizResult->getDeletedCount()];
  }
}
