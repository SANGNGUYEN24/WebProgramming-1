<?php

require_once "./createDocument.php";
require_once "./queryFunctions.php";

//=====================================================
// ----- Testing functions here ----
// echo "<br>Testing function: testGetQuizQuetions() <br> <a>------------------------------</a>";
// testGetQuizQuetions();
// echo "<br>Testing function: testCreateTeacherData() <br> <a>------------------------------</a>";
// testCreateTeacherData();
// echo "<br>Testing function: testCreateStudentData() <br> <a>------------------------------</a>";
// testCreateStudentData();
// echo "<br>Testing function: testCreateCourseData() <br> <a>------------------------------</a>";
// testCreateCourseData();
// echo "<br>Testing function: testCreateQuizData() <br> <a>------------------------------</a>";
// testCreateQuizData();
// echo "<br>Testing function: testfindAlQuizIds() <br> <a>------------------------------</a>";
// testfindAllQuizIds();
// echo "<br>Testing function: testfindAlCourseIds() <br> <a>------------------------------</a>";
// testfindAllCourseIds();
// echo "<br>Testing function: testfindAlStudentIds() <br> <a>------------------------------</a>";
// testfindAllStudentIds();
// echo "<br>Testing function: testCreateQuestionData() <br> <a>------------------------------</a>";
// testCreateQuestionData();
// echo "<br>Testing function: testCreateMarkData() <br> <a>------------------------------</a>";
// testCreateMarkData();
//=====================================================
function testGetQuizQuetions(){
    $quizId = "CO2013-1";
    print_r(getQuizQuestions($quizId));
}

function testCreateTeacherData(){
    createTeacherData();
}

function testCreateStudentData(){ 
    createStudentData();
}

function testCreateCourseData(){
    $teacherId = "TC-7320685914";
    createCourseData($teacherId);
}

function testCreateQuizData(){
    $teacherId = "TC-3517806249";
    $courseId = "Q-2037149586 ";
    createQuizData($teacherId, $courseId);
}

function testFindAllQuizIds(){
    findAllQuizIds();
}

function testFindAllCourseIds(){
    findAllCourseIds();
}

function testFindAllStudentIds(){
    findAllStudentIds();
}

function testCreateQuestionData(){
    $courseIds = array("C-8346109257","C-0247583916","C-3278459106","C-3561927048","C-8476913520",
    "C-0738291654","C-8579463120","C-2961354708","C-5821397064","C-0624781359","C-3817026459",
    "C-3746092851","C-5371846092","C-4935061728","C-2784190365","C-6452081397","C-3792615048",
    "C-1247683950","C-6379851240","C-8265734019");
    $quizIds = array("Q-2037149586","Q-1768932054","Q-0172356948","Q-1395470286","Q-7931584602",
    "Q-4503817692","Q-2348075691","Q-7345026981","Q-2681350947","Q-0839472156","Q-7482061593",
    "Q-2476309851","Q-6827450391","Q-7820149536","Q-3096412587","Q-2356871094","Q-8513970246",
    "Q-4253897601","Q-8692304715","Q-7249538106","Q-1864530927","Q-2106347589","Q-1587402693",
    "Q-2416083597","Q-1368724905","Q-2753986041","Q-1837546290","Q-3698015247","Q-9507481236",
    "Q-2041679385","Q-6271583940","Q-6128753409","Q-2468790531","Q-2605491837","Q-1879560423",
    "Q-3870129564","Q-9670431825","Q-0861275349","Q-3508697412","Q-0394561728","Q-8796541032",
    "Q-3460251789","Q-2485310697","Q-2468507931","Q-9741052683","Q-0179468523","Q-2860475319",
    "Q-8760195243","Q-2057936418","Q-0327618594","Q-2563807941","Q-8456719320","Q-3158692407",
    "Q-6124753890","Q-5879234016","Q-8453170296","Q-8915604372","Q-9876251340","Q-9457218603",
    "Q-3807214695","Q-6307195482","Q-3624587910","Q-2670983154","Q-3642150897","Q-2310697485",
    "Q-0518392476","Q-9467382105","Q-1284506739","Q-2049376158","Q-2681503749","Q-9630745128",
    "Q-9710854632","Q-2731068945","Q-6841953207","Q-2940651783","Q-7695820431","Q-1983072564",
    "Q-8793164502","Q-0941862375","Q-3215940687");
    // 1 courseId
    $count = 0; // count for chosing quizId in quizIds
    // for($i = 0; $i < 20; $i++){
    for($i = 0; $i < 1; $i++){
        // $courseId = $courseIds[$i];
        $courseId = "C-8346109258";
        // 4 quizIds means 4 turns
            $quizId ="Q-2037149586";
        createQuestionData($courseId, $quizId);
        // $turn = 1;
        // while ($turn <= 4){
        //     // $quizId = $quizIds[$count];
        //     // 5 questions
        //     createQuestionData($courseId, $quizId);
        //     $turn+=1;
        //     $count+=1;
        // }
    }
}

function testCreateMarkData(){
    $studentIds = array("STU-0195872364","STU-6458209713","STU-3197425806",
    "STU-1589403726","STU-8476103529","STU-6423105978","STU-0285743169",
    "STU-8623450971","STU-0936712458","STU-8426051937","STU-7865492310",
    "STU-8461273950","STU-3718645290","STU-0549276183","STU-5104869237",
    "STU-4185729306","STU-0895372416","STU-5239467108","STU-9807654321",
    "STU-0189462537",);
    $quizIds = array("Q-2037149586","Q-1768932054","Q-0172356948","Q-1395470286","Q-7931584602",
    "Q-4503817692","Q-2348075691","Q-7345026981","Q-2681350947","Q-0839472156","Q-7482061593",
    "Q-2476309851","Q-6827450391","Q-7820149536","Q-3096412587","Q-2356871094","Q-8513970246",
    "Q-4253897601","Q-8692304715","Q-7249538106","Q-1864530927","Q-2106347589","Q-1587402693",
    "Q-2416083597","Q-1368724905","Q-2753986041","Q-1837546290","Q-3698015247","Q-9507481236",
    "Q-2041679385","Q-6271583940","Q-6128753409","Q-2468790531","Q-2605491837","Q-1879560423",
    "Q-3870129564","Q-9670431825","Q-0861275349","Q-3508697412","Q-0394561728","Q-8796541032",
    "Q-3460251789","Q-2485310697","Q-2468507931","Q-9741052683","Q-0179468523","Q-2860475319",
    "Q-8760195243","Q-2057936418","Q-0327618594","Q-2563807941","Q-8456719320","Q-3158692407",
    "Q-6124753890","Q-5879234016","Q-8453170296","Q-8915604372","Q-9876251340","Q-9457218603",
    "Q-3807214695","Q-6307195482","Q-3624587910","Q-2670983154","Q-3642150897","Q-2310697485",
    "Q-0518392476","Q-9467382105","Q-1284506739","Q-2049376158","Q-2681503749","Q-9630745128",
    "Q-9710854632","Q-2731068945","Q-6841953207","Q-2940651783","Q-7695820431","Q-1983072564",
    "Q-8793164502","Q-0941862375","Q-3215940687");

    for($i=0;$i < 20; $i++){
    $studentId = $studentIds[rand(0, 19)];
    // $quizId = $quizIds[rand(0, 79)];
    $quizId = "Q-2037149586";
    createMarkData($studentId, $quizId);
    }
}
