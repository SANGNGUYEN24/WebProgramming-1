<?php

require_once '../vendor/autoload.php';

class MyDatabase
{
  // Database
  public $db;
  public $teacherCollection;
  public $courseCollection;
  public $quizCollection;
  public $questionCollection;
  public $markCollection;
  public $studentCollection;

  public function __construct()
  {
    $client = new MongoDB\Client(
      'mongodb+srv://sangnd:A2LCgZecgEmsRd2A@nhattan.7vquo.mongodb.net/myFirstDatabase?retryWrites=true&w=majority'
    );
    $this->db = $client->data;
    $this->teacherCollection = $this->db->teacher;
    $this->courseCollection = $this->db->course;
    $this->quizCollection = $this->db->quiz;
    $this->questionCollection = $this->db->question;
    $this->markCollection = $this->db->mark;
    $this->studentCollection = $this->db->student;
  }
}
