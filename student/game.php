<?php
session_start();

include 'getStudentInfo.php';
if (!isset($_SESSION['username']) && $_SESSION['username'] == NULL) {
    header('Location: ../login/');
} else {
    if (isset($_SESSION['isTeacher']) && $_SESSION['isTeacher'] == true) {
        header('Location: ../login/');
    }
}
date_default_timezone_set('Asia/Ho_Chi_Minh');
include '../connect.php';
if (isset($_GET['id'])) {
    $quizID = $_GET['id'];

    $post = $db->quiz;

    $results = $post->findOne(['quizId' => $quizID]);

    if (empty($results)) {
        header('Location: ./selection.php');
    } else {
        $quizInfo = getQuiz($quizID);
        $dealine = $quizInfo->dueDate;

        $now = time();
        $dateCreate = DateTime::createFromFormat('d/m/Y',$dealine);
        $array = (array)$dateCreate;
        $getDeadline = $array['date'];
        $time = strtotime(strval($getDeadline));

        if ($time <= $now){
            echo '<script language="javascript">';
            echo 'alert("The deadline for this quiz is over")';
            //echo 'window.location.replace("localhost/webprogramming/student/selection.php/")';
            echo '</script>';
            header('Location: ./selection.php');
        }

        $post = $db->question;
        $result = $post->find(['quizId' => $quizID]);
    }
} else {
    header('Location: ./selection.php');
}

?>


<!-- Created By CodingNepal - www.codingnepalweb.com  -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Time</title>
    <link rel="stylesheet" href="css/style.css">
    <!-- FontAweome CDN Link for Icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>

<body>
    <!-- start Quiz button -->
    <div class="wrapper">
        <div class="hero-image">
            <img src="images/quizyo-1.png" class="entry-logo">
        </div>
    </div>
    <div class="start_btn">
        <button>Start Quiz!</button>
    </div>

    <div class="home_btn">
        <button><a href="viewscore.php">Back to Home</a></button>
    </div>

    <!-- Info Box -->
    <div class="info_box">
        <div class="info-title"><span>IMPORTANT: QUIZ RULES!</span></div>
        <div class="info-list">
            <div class="info">1. You will have only <span>15 seconds</span> per each question.</div>
            <div class="info">2. Once you select your answer, it can't be undone.</div>
            <div class="info">3. You can't select any option once time goes off.</div>
            <div class="info">4. You can't exit from the Quiz while you're playing.</div>
            <div class="info">5. You'll get points on the basis of your correct answers.</div>
        </div>
        <div class="buttons">
            <button class="quit">Exit Quiz</button>
            <button class="restart">Continue</button>
        </div>
    </div>

    <!-- Quiz Box -->
    <div class="head">
            <div class="title">QUIZ NAME</div>
            <div class="timer">
                <div class="time_left_txt">Time Left</div>
                <div class="timer_sec">15</div>
            </div>
            <div class="time_line"></div>
    </div>

    <div class="quiz_box">
        <section>
            <div class="que_text">
                <!-- Here I've inserted question from JavaScript -->
            </div>
            <div class="option_list">
                <!-- Here I've inserted options from JavaScript -->
            </div>
        </section>

        <!-- footer of Quiz Box -->
        <footer>
            <div class="total_que">
                <!-- Here I've inserted Question Count Number from JavaScript -->
            </div>
            <button class="next_btn">
                Next >>
            </button>
        </footer>
    </div>

    <!-- Result Box -->
    <div class="result_box">
        <div class="icon">
            <i class="fas fa-crown"></i>
        </div>
        <div class="complete_text">You've completed the Quiz!</div>
        <div class="buttons">
            <form method="POST" action="game.php?id=<?php echo $quizID?>">
                <input id="resArray" type="hidden" name="answers">
                <button id="result-btn" type="submit" class="more-detail" name="score">
                    Finish Quiz
                </button>
            </form>

        </div>
    </div>

    <!-- Inside this JavaScript file I've inserted Questions and Options only -->
    <!-- <script src="js/questions.js"></script> -->

    <!-- Inside this JavaScript file I've coded all Quiz Codes -->
    <script src="js/script.js"></script>

</body>

</html>
<script>
    let questions = [
        <?php
        $k = 1;
        foreach ($result as $row) {
            echo '
                        {
                        numb: ' . $k . ',
                        question: `' . $row->description . '`,
                        answer: `' . $row->option1 . '`,
                        options: [
                        `' . $row->option1 . '`,
                        `' . $row->option2 . '`,
                        `' . $row->option3 . '`,
                        `' . $row->option4 . '`,
                        ].sort(() => Math.random() - 0.5),
                    },
                    ';
            $k = $k + 1;
        }
        ?>
    ];
</script>
<?php
if (isset($_GET['id'])) {
    $quizID = $_GET['id'];

    $post = $db->quiz;

    $result1 = $post->findOne(['quizId' => $quizID]);

    if (empty($result1)) {
        header('Location: ./selection.php');
    } else {
        $post = $db->question;
        $result2 = $post->find(['quizId' => $quizID]);
    }
}
$studentID = getStudent($_SESSION['username'])->studentId;
if (isset($_POST['score'])) {
    $k  = 0;
    $score  = $_POST['answers'];
    preg_match_all('(true|false)', $score, $matches);
    //var_dump($matches);
    foreach ($matches[0] as $res) {

        if ($res == 'true') {
            $k += 1;
        }
    }
    $finalScore = (float)$k / count($matches[0]) * 10;

    $counter = 0;

    $resultArr = [];
    foreach ($result2 as $row1) {
        $resultArr += [strval($row1->_id) => $matches[0][$counter]];
        $counter += 1;
    }

    $search = $db->mark;
    $res = $search->findOne(['studentId'=>$studentID, 'quizId'=>$quizID]);
    
    if (empty($res)){
        $insertResult = $db->mark;
        $insertResult->insertOne([
        'studentId' => $studentID,
        'score' => $finalScore,
        'quizAnswer' => $resultArr,
        'quizId' => $_GET['id'],
        'dateTaken'=>date('Y-m-d H:i:s')
    ]);
    } else {
        $search->updateOne(
            ['studentId' => $studentID, 'quizId'=>$_GET['id']],
            ['$set'=>[
                'score' => $finalScore,
                'quizAnswer'=>$resultArr,
                'dateTaken'=>date('Y-m-d H:i:s')
            ]]);
    }    
}
?>