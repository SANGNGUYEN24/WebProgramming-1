<?php declare(strict_types=1);

namespace Tests\Student;
require './student/StudentInfo.php';

use PHPUnit\Framework\TestCase;
use App\StudentInfo;

class StudentInfoTest extends TestCase{
    public function testGetStudentId() : void {
        $studentInfo = new StudentInfo();
        $username = "stu.Gciv@gmail.com";

        $expected = "STU-0195872364";
        $actual = $studentInfo->getStudentId($username);
        $message = "\n[Failure in test getStudentId]";

        $this->assertEquals($expected, $actual, $message);
    }    

    public function testGetTeacherUsername() : void {
        $studentInfo = new StudentInfo();
        $teacherId = "TC-4203517869";

        $expected = "tc.wZAt@gmail.com";
        $actual = $studentInfo->getTeacherUsername($teacherId);
        $message = "\n[Failure in test getTeacherUsername]";
        
        $this->assertEquals($expected, $actual, $message);
    }

    public function testGetCourseName() : void {
        $studentInfo = new StudentInfo();
        $courseId = "C-7960351842";

        $expected = "Data structures and algorithms";
        $actual = $studentInfo->getCourseName($courseId);
        $message = "\n[Failure in test getCourseName]";

        $this->assertEquals($expected, $actual, $message);
    }
    
    public function testGetQuizDueDate() : void {
        $studentInfo = new StudentInfo();
        $quizId = "Q-0329681754";

        $expected = "2021-11-20";
        $actual = $studentInfo->getQuizDueDate($quizId);
        $message = "\n[Failure in test getQuizDueDate]";

        $this->assertEquals($expected, $actual, $message);
    }
}

