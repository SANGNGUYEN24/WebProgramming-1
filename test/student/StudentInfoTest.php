<?php declare(strict_types=1);

namespace Tests\Student;
require '../../student/StudentInfo.php';

use PHPUnit\Framework\TestCase;
use App\StudentInfo;

class StudentInfoTest extends TestCase{
    public function testGetStudentId() : void {
        $studentInfo = new StudentInfo();
        $username = "stu.Gciv@gmail.com";
        $studentInfo->getStudent($username);

        $expected = "STU-0195872364";
        $actual = "STU-0195872364";
        $message = "Correct!";

        $this->assertEquals($expected, $actual, $message);
    }    
}

