<?php

require_once 'MyDatabase.php';

class Quiz
{
  private $courseId;
  private $quizId;
  private $dtb;

  public function __construct(
    $courseId,
    $quizId
  ) {
    $this->dtb = new MyDatabase();
    $this->courseId = $courseId;
    $this->quizId = $quizId;
  }

  public function getDtb()
  {
    return $this->dtb;
  }

  public function getCourseId()
  {
    return $this->courseId;
  }

  public function getQuizId()
  {
    return $this->quizId;
  }

  public function getAllQuestionsBelongsTo()
  {
    // Get question based on quizID and courseID
    $questions = $this->dtb->questionCollection->find(['quizId' => $this->quizId, 'courseId' => $this->courseId]);
    return $questions;
  }

  public function getAllMarksBelongsTo()
  {
    // Get question based on quizID and courseID
    $marks = $this->dtb->markCollection->find(['quizId' => $this->quizId]);
    return $marks;
  }

  public function getQuestionByDescription($description)
  {
    $question = $this->dtb->questionCollection->findOne(['quizId' => $this->quizId, 'courseId' => $this->courseId, 'description' => $description]);
    return $question;
  }

  public function addQuestion($description = "", $option1 = "", $option2 = "", $option3 = "", $option4 = "", $level = 0)
  {
    if ($description == "" | $option1 == "" | $option2 == "" | $option3 == "" | $option4 == "" | $level == 0) {
      return;
    }

    $insertQuestionResult = $this->dtb->questionCollection->insertOne([
      'quizId' => $this->quizId,
      'courseId' => $this->courseId,
      'description' => $description,
      'option1' => $option1,
      'option2' => $option2,
      'option3' => $option3,
      'option4' => $option4,
      'level' => $level,
      'unitScore' => (int) $level * 10
    ]);

    return $insertQuestionResult->getInsertedCount();
  }

  public function editQuestion($targetQuestionId = "", $description = "", $option1 = "", $option2 = "", $option3 = "", $option4 = "", $level = 0)
  {
    if (
      $targetQuestionId == "" | $description == "" | $option1 == "" | $option2 == "" | $option3 == "" | $option4 == "" |
      $level == 0
    ) {
      return;
    }

    $updateQuestionResult = $this->dtb->questionCollection->updateOne(
      [
        '_id' => new MongoDB\BSON\ObjectId($targetQuestionId)
      ],
      [
        '$set' => [
          'description' => $description,
          'option1' => $option1,
          'option2' => $option2,
          'option3' => $option3,
          'option4' => $option4,
          'level' => $level,
          'unitScore' => (int) $level * 10,
        ]
      ]
    );

    return array($updateQuestionResult->getMatchedCount(), $updateQuestionResult->getModifiedCount());
  }

  public function deleteQuestion($targetQuestionId = "")
  {
    if ($targetQuestionId == "") {
      return;
    }

    $deleteQuestionResult = $this->dtb->questionCollection->deleteOne([
      '_id' => new MongoDB\BSON\ObjectId($targetQuestionId)
    ]);

    return $deleteQuestionResult->getDeletedCount();
  }
}
