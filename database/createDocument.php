<?php

require './conectCollection.php';

// Create a teacher in the db with full random values.
function createTeacherData(){
    global $teacherCollection;
    $characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $numbers = "0123456789";
    $firstName = array("Khi", "Nao", "Muon", "Mua", "Ao", "Giap", "Sat", "Nho", "Sang", "Pho", "Hoi", "Cua", "Hang", "A", "Phi", "Au");
    $lastName = array("Nguyen Thi", "Nguyen Dinh", "Cao Hoang", "Nguyen Minh");
    $genderArray = array("Male", "Female");
    $dates = array("01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26","27", "28");
    $months = array("01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12");
    $years = array("1960", "1962", "1968", "1970", "1972", "1974", "1976");
    // Course ID contains 13 characters, ex: TC-0862397654
    $teacherId = "TC-" . substr(str_shuffle($numbers), 0, 10);
    $username = "tc.". substr(str_shuffle($characters),0, 4). "@gmail.com";
    $password = md5(substr(str_shuffle($characters),0, 10));
    $name = $lastName[array_rand($lastName)] . " " . $firstName[array_rand($firstName)];
    $gender = $genderArray[array_rand($genderArray)];
    $birthday = $dates[array_rand($dates)] . "/" . $months[array_rand($months)] . "/" . $years[array_rand($years)];
    $phone = "0" . substr(str_shuffle($numbers), 0, 9);

    $teacherCollection->insertOne([
        "teacherId" => $teacherId,
        "username" => $username,
        "password" => $password,
        "name" => $name,
        "gender" => $gender,
        "birthday" => $birthday,
        "phone" => $phone,
        "courseIds" => [],
    ]);

    echo "<br>Created a teacher, check the db!";
}

// Create 20 student with random values
function createStudentData(){ 
    global $studentCollection;
    $characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $numbers = "0123456789";
    $firstName = array("Hai", "Nao", "Qua", "De", "Chung", "Ta", "Khong", "Thuoc", "Ve", "Nhau", "Tia", "Nang", "Mong", "Manh");
    $lastName = array("Phan Thi", "Nguyen Dinh Minh", "Nguyen Hoang", "Le Minh");
    $name = $lastName[array_rand($lastName)] . " " . $firstName[array_rand($firstName)];
    $genderArray = array("Male", "Female");
    $months = array("01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12");
    $dates = array("01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26","27", "28");
    $years = array("1960", "1962", "1968", "1970", "1972", "1974", "1976");
    
    for($i = 0; $i < 20; $i++){
        // Course ID contains 13 characters, ex: ST-0862397654
        $studentId = "STU-" . substr(str_shuffle($numbers), 0, 10);
        $username = "stu.". substr(str_shuffle($characters),0, 4). "@gmail.com";
        $password = md5(substr(str_shuffle($characters),0, 10));
        $name = $lastName[array_rand($lastName)] . " " . $firstName[array_rand($firstName)];
        $gender = $genderArray[array_rand($genderArray)];
        $birthday = $dates[array_rand($dates)] . "/" . $months[array_rand($months)] . "/" . $years[array_rand($years)];
        $phone = "0" . substr(str_shuffle($numbers), 0, 9);

        $studentCollection->insertOne([
            "studentId" => $studentId,
            "username" => $username,
            "password" => $password,
            "name" => $name,
            "gender" => $gender,
            "birthday" => $birthday,
            "phone" => $phone,
        ]);
    }

    echo "<br>Created 20 students, check the db!";
}

// Create 20 courses
function createCourseData(){
    global $courseCollection;
    $numbers = "0123456789";
    $years = array("2019","2020", "2021");

    
    for ($cIdx = 1; $cIdx < 21; $cIdx++){
        $courseId = "C-" . substr(str_shuffle($numbers), 0, 10);
        $year = $years[array_rand($years)];

        $courseCollection->insertOne([
            "courseId" => $courseId,
            "name" => "Course " . $cIdx,
            "year" => $year,
        ]);
    }

    echo "<br>Created 20 courses, check the db!";
}

// Create 4 quiz for each quiz with given quiz Id and teacherId
function createQuizData($teacherId, $courseId){
    global $quizCollection;
    $numbers = "0123456789";
    
    for($i = 1; $i < 5; $i++){
        $quizId = "Q-" . substr(str_shuffle($numbers), 0, 10);
        $dateToBegin = rand(01, 30);
        $today = $dateToBegin . "-11-2021";
        $startDate = date('d/m/Y', strtotime($today)); 
        $dueDate = date('d/m/Y', strtotime($today . " + 60 day"));

        $quizCollection->insertOne([
            "quizId" => $quizId,
            "name" => "Quiz " . $i,
            "startDate" => $startDate,
            "dueDate" => $dueDate,
            "teacherId" => $teacherId,
            "courseId" => $courseId,
        ]);
    }

    echo "<br>Created 4 quiz for the courseId: " . $courseId . " teacherId: " . $teacherId;
}

// Find all existing quiz ids to create questions
function findAllQuizIds(){
    global $quizCollection;
    $result = $quizCollection->find();
    $quizIds = array();
    echo "<br>All quiz ids <br>";
    foreach($result as $doc){
        echo "\"" .$quizIds[] = $doc["quizId"]. "\",";
    }
}

// Find all existing courseId to create questions
function findAllCourseIds(){ 
    global $courseCollection;
    $result = $courseCollection->find();
    $courseIds = array();
    echo "<br>All course ids <br>";
    foreach($result as $doc){
        echo "\"" .$courseIds[] = $doc["courseId"]. "\",";
    }
}

// Find all existing studentId to create questions
function findAllStudentIds(){ 
    global $studentCollection;
    $result = $studentCollection->find();
    $studentIds = array();
    echo "<br>All student ids <br>";
    foreach($result as $doc){
        echo "\"" .$studentIds[] = $doc["studentId"]. "\",";
    }
}

// Create 5 questions for each quiz
function createQuestionData($courseId,$quizId){

    global $questionCollection;

    $questionArray = array();
    
    // level = 1 -> easy, 2 -> medium, 3 -> hard
    // question 1
        // $questionArray[]=[
        // "description" => "Name space are offered in?",
        // "level" => (int) 1,
        //     "unitScore" => (int) 10,
        //     "option1" => "PHP 6",
        //     "option2" => "PHP 5",
        //     "option3" => "PHP 4",
        //     "option4" => "PHP 3",
        //     "quizId" => $quizId,
        //     "courseId" => $courseId,
        // ];
        // // question 2
        // $questionArray[] =[
        //     "description" => "Member variables of a class are known as?",
        //     "level" => (int) 1,
        //     "unitScore" => (int) 10,
        //     "option1" => "All of the answers",
        //     "option2" => "Attributes",
        //     "option3" => "Properties",
        //     "option4" => "Instances",
        //     "quizId" => $quizId,
        //     "courseId" => $courseId,
        // ];
        // // question 3
        // $questionArray[] = [
        //     "description" => "When function have same prototype in base class as 
        //     well as in derived class the function is called?",
        //     "level" => (int) 2,
        //     "unitScore" => (int) 20,
        //     "option1" => "Overriding functions",
        //     "option2" => "Overloading functions",
        //     "option3" => "Chained functions",
        //     "option4" => "All of them",
        //     "quizId" => $quizId,
        //     "courseId" => $courseId,
        // ];
        
        // // question 4
        // $questionArray[] = [
        //     "description" => ": Which version of PHP support get_declared_classes ( ) function??",
        //     "level" => (int) 2,
        //     "unitScore" => (int) 20,
        //     "option1" => "PHP 4.0.0",
        //     "option2" => "PHP 5.0.1",
        //     "option3" => "PHP 3.0.0",
        //     "option4" => "PHP 6",
        //     "quizId" => $quizId,
        //     "courseId" => $courseId,
        // ];
        
        // // question 5
        // $questionArray[] = [
        //     "description" => "TextUtils and TextUtils_WordCounter classes are those which belongs to?",
        //     "level" => (int) 3,
        //     "unitScore" => (int) 30,
        //     "option1" => "Pear package",
        //     "option2" => "Inherited package",
        //     "option3" => "Multi-inherited package",
        //     "option4" => "None of them",
        //     "quizId" => $quizId,
        //     "courseId" => $courseId,
        // ];
        
        $questionArray[]=[
        "description" => "Name space are offered in?",
        "level" => (int) 1,
            "unitScore" => (int) 10,
            "option1" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. 🎋🎍🎗🎏(￣3￣)╭\(￣︶￣*\))!(*￣(￣　*)(∪.∪ )...zzzo(*￣▽￣)ブ ΠΖΘΜΧΨ↮↚↘↡↓↑",
            "option2" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. 🎋🎍🎗🎏(￣3￣)╭\(￣︶￣*\))!(*￣(￣　*)(∪.∪ )...zzzo(*￣▽￣)ブ ΠΖΘΜΧΨ↮↚↘↡↓↑",
            "option3" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. 🎋🎍🎗🎏(￣3￣)╭\(￣︶￣*\))!(*￣(￣　*)(∪.∪ )...zzzo(*￣▽￣)ブ ΠΖΘΜΧΨ↮↚↘↡↓↑",
            "option4" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. 🎋🎍🎗🎏(￣3￣)╭\(￣︶￣*\))!(*￣(￣　*)(∪.∪ )...zzzo(*￣▽￣)ブ ΠΖΘΜΧΨ↮↚↘↡↓↑",
            "quizId" => $quizId,
            "courseId" => $courseId,
        ];
        // question 2
        $questionArray[] =[
            "description" => "Member variables of a class are known as?",
            "level" => (int) 1,
            "unitScore" => (int) 10,
            "option1" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. 🎋🎍🎗🎏(￣3￣)╭\(￣︶￣*\))!(*￣(￣　*)(∪.∪ )...zzzo(*￣▽￣)ブ ΠΖΘΜΧΨ↮↚↘↡↓↑",
            "option2" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. 🎋🎍🎗🎏(￣3￣)╭\(￣︶￣*\))!(*￣(￣　*)(∪.∪ )...zzzo(*￣▽￣)ブ ΠΖΘΜΧΨ↮↚↘↡↓↑",
            "option3" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. 🎋🎍🎗🎏(￣3￣)╭\(￣︶￣*\))!(*￣(￣　*)(∪.∪ )...zzzo(*￣▽￣)ブ ΠΖΘΜΧΨ↮↚↘↡↓↑",
            "option4" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. 🎋🎍🎗🎏(￣3￣)╭\(￣︶￣*\))!(*￣(￣　*)(∪.∪ )...zzzo(*￣▽￣)ブ ΠΖΘΜΧΨ↮↚↘↡↓↑",
            "quizId" => $quizId,
            "courseId" => $courseId,
        ];
        // question 3
        $questionArray[] = [
            "description" => "When function have same prototype in base class as 
            well as in derived class the function is called?",
            "level" => (int) 2,
            "unitScore" => (int) 20,
            "option1" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. 🎋🎍🎗🎏(￣3￣)╭\(￣︶￣*\))!(*￣(￣　*)(∪.∪ )...zzzo(*￣▽￣)ブ ΠΖΘΜΧΨ↮↚↘↡↓↑",
            "option2" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. 🎋🎍🎗🎏(￣3￣)╭\(￣︶￣*\))!(*￣(￣　*)(∪.∪ )...zzzo(*￣▽￣)ブ ΠΖΘΜΧΨ↮↚↘↡↓↑",
            "option3" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. 🎋🎍🎗🎏(￣3￣)╭\(￣︶￣*\))!(*￣(￣　*)(∪.∪ )...zzzo(*￣▽￣)ブ ΠΖΘΜΧΨ↮↚↘↡↓↑",
            "option4" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. 🎋🎍🎗🎏(￣3￣)╭\(￣︶￣*\))!(*￣(￣　*)(∪.∪ )...zzzo(*￣▽￣)ブ ΠΖΘΜΧΨ↮↚↘↡↓↑",
            "quizId" => $quizId,
            "courseId" => $courseId,
        ];
        
        // question 4
        $questionArray[] = [
            "description" => ": Which version of PHP support get_declared_classes ( ) function??",
            "level" => (int) 2,
            "unitScore" => (int) 20,
            "option1" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. 🎋🎍🎗🎏(￣3￣)╭\(￣︶￣*\))!(*￣(￣　*)(∪.∪ )...zzzo(*￣▽￣)ブ ΠΖΘΜΧΨ↮↚↘↡↓↑",
            "option2" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. 🎋🎍🎗🎏(￣3￣)╭\(￣︶￣*\))!(*￣(￣　*)(∪.∪ )...zzzo(*￣▽￣)ブ ΠΖΘΜΧΨ↮↚↘↡↓↑",
            "option3" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. 🎋🎍🎗🎏(￣3￣)╭\(￣︶￣*\))!(*￣(￣　*)(∪.∪ )...zzzo(*￣▽￣)ブ ΠΖΘΜΧΨ↮↚↘↡↓↑",
            "option4" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. 🎋🎍🎗🎏(￣3￣)╭\(￣︶￣*\))!(*￣(￣　*)(∪.∪ )...zzzo(*￣▽￣)ブ ΠΖΘΜΧΨ↮↚↘↡↓↑",
            "quizId" => $quizId,
            "courseId" => $courseId,
        ];
        
        // question 5
        $questionArray[] = [
            "description" => "TextUtils and TextUtils_WordCounter classes are those which belongs to?",
            "level" => (int) 3,
            "unitScore" => (int) 30,
            "option1" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. 🎋🎍🎗🎏(￣3￣)╭\(￣︶￣*\))!(*￣(￣　*)(∪.∪ )...zzzo(*￣▽￣)ブ ΠΖΘΜΧΨ↮↚↘↡↓↑",
            "option2" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. 🎋🎍🎗🎏(￣3￣)╭\(￣︶￣*\))!(*￣(￣　*)(∪.∪ )...zzzo(*￣▽￣)ブ ΠΖΘΜΧΨ↮↚↘↡↓↑",
            "option3" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. 🎋🎍🎗🎏(￣3￣)╭\(￣︶￣*\))!(*￣(￣　*)(∪.∪ )...zzzo(*￣▽￣)ブ ΠΖΘΜΧΨ↮↚↘↡↓↑",
            "option4" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. 🎋🎍🎗🎏(￣3￣)╭\(￣︶￣*\))!(*￣(￣　*)(∪.∪ )...zzzo(*￣▽￣)ブ ΠΖΘΜΧΨ↮↚↘↡↓↑",
            "quizId" => $quizId,
            "courseId" => $courseId,
        ];
    $questionCollection->insertMany($questionArray);

    echo "<br>Created 5 questions for quizId: " . $quizId . " courseId: " . $courseId;
}

// Create a doc in mark collection with a given studentId, a given quizId
function createMarkData($studentId, $quizId){
    global $markCollection;

    $bools = array(true, false);
    $score = rand(5, 10);
    $markCollection->insertOne([
            "score" => (int) $score,
            "quizAnswer" => array(
                "1" => (bool) $bools[rand(0,1)],
                "2" => (bool) $bools[rand(0,1)],
                "3" => (bool) $bools[rand(0,1)],
                "4" => (bool) $bools[rand(0,1)],
                "5" => (bool) $bools[rand(0,1)],
                "6" => (bool) $bools[rand(0,1)],
                "7" => (bool) $bools[rand(0,1)],
                "8" => (bool) $bools[rand(0,1)],
                "9" => (bool) $bools[rand(0,1)],
                "10" => (bool) $bools[rand(0,1)],
            ),
            "studentId" => $studentId,
            "quizId" => $quizId,
        ]);

    echo "<br> Created a mark with quizId: " . $quizId . " and studentId: " . $studentId;

}


