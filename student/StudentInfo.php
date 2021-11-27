<?php declare(strict_types=1);

namespace App;

class StudentInfo{
    public function getStudentId($username){
        include './connect_new.php';

        $post = $db->student;

        $result = $post->findOne(['username'=>$username]);
        //echo "console.log($result->student)";
        return $result->studentId;
    }

    public function getTeacherUsername($teacherID){
        include './connect_new.php';
        $post = $db->teacher;

        $result = $post->findOne(['teacherId'=>$teacherID]);

        return $result->username;
    }

    public function getCourseName($courseID){
         include './connect_new.php';

        $post = $db->course;

        $result = $post->findOne(['courseId'=>$courseID]);

        return $result->name;
    }

    public function getQuizDueDate($quizID){
        include './connect_new.php';

        $post = $db->quiz;

        $result = $post->findOne(['quizId'=>$quizID]);

        return $result->dueDate;
    }
}

?>