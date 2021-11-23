<?php declare(strict_types=1);

namespace App;
use App\Exceptions\InfoNotFoundException;

class StudentInfo{
    public function getStudent($username){
        include '../connect.php';

        $post = $db->student;

        $result = $post->findOne(['username'=>$username]);
        //echo "console.log($result->student)";
        return $result->studentId;
    }

    public function getTeacher($teacherID){
        include '../connect.php';

        $post = $db->teacher;

        $result = $post->findOne(['teacherId'=>$teacherID]);

        return $result;
    }

    public function getCourse($courseID){
        include '../connect.php';

        $post = $db->course;

        $result = $post->findOne(['courseId'=>$courseID]);

        return $result;
    }

    public function getQuiz($quizID){
        include '../connect.php';

        $post = $db->quiz;

        $result = $post->findOne(['quizId'=>$quizID]);

        return $result;
    }
}

?>