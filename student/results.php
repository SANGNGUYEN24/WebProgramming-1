<?php
session_start();

if (!isset($_SESSION['username']) && $_SESSION['username'] == NULL) {
    header('Location: ../login/');
} else {
    if (isset($_SESSION['isTeacher']) && $_SESSION['isTeacher'] == true) {
        header('Location: ../login/');
    }
}
include '../connect.php';
include 'getStudentInfo.php';

$getStudentInfo = getStudent($_SESSION['username']);

if (isset($_GET['quizID'])) {
    $studentID = $getStudentInfo->studentId;
    $quizID = $_GET['quizID'];
    $post = $db->mark;
    $res = $post->findOne(['studentId' => $studentID, 'quizId' => $quizID]);
    if (empty($res)) {
        header('Location: viewscore.php');
    } else {
        $quizInfo = getQuiz($quizID);
        $dealine = $quizInfo->dueDate;

        $now = time();
        $dateCreate = DateTime::createFromFormat('Y-m-d',$dealine);
        $array = (array)$dateCreate;
        $getDeadline = $array['date'];
        $time = strtotime(strval($getDeadline));

        if ($time > $now){
            echo '<script language="javascript">';
            echo '
                if (confirm("The deadline for this quiz is not over yet")){
                    document.location.href="./viewscore.php";
                }
            ';
            echo '</script>';
            //header('Location: ./selection.php');
        }

        $getQuizInfo = getQuiz($_GET['quizID']);
        $resultArr = $res->quizAnswer;
        #var_dump($resultArr);
    }
} else {
    header('Location: viewscore.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Result</title>
    <link rel="stylesheet" href="css/index.css">
</head>

<body class="body-results">

    <main class='result-main'>
        <header class="result-header">
            <div class="quiz-title">
                <h1 id="quiz-name">
                    <?php echo $getQuizInfo->name; ?>
                </h1>
                <h4 id="quiz-course">
                    <?php echo getCourse($getQuizInfo->courseId)->name; ?>
                </h4>
                <h4 id="quiz-creator">
                    <?php echo getTeacher($getQuizInfo->teacherId)->name; ?>
                </h4>
            </div>
            <h2 class="result-header">Your total score is:</h2>

        </header>
        <section id="resultsDisplay" class="results-display">
            <h3 class="result-header" id="score">
                <?php echo $res->score.'/'.$res->totalScore; ?>
            </h3>

            <div class="full-results">
                <table id="fullResults" class='results-table'>
                    <thead>
                        <th>No.</th>
                        <th>Question</th>
                        <th>Correct answer</th>
                        <th>Level</th>
                        <th>Score</th>
                    </thead>
                    <tbody id='tableBody'>
                        <?php
                            $findQuestion = $db->question;
                            $question = $findQuestion->find(['quizId' => $quizID]);
                            $k = 1;
                            foreach ($question as $row) {
                                if ($resultArr[strval($row->_id)] == 'true') {
                                    echo '<tr class="right">';
                                } else {
                                    echo '<tr class="wrong">';
                                }
                                echo '
                                    <td>
                                        '.$k.'
                                    </td>
                                    <td>
                                        '.$row->description.'
                                    </td>
                                    <td>
                                        '.$row->option1.'
                                    </td>';
                                    ?>
                                    <?php
                                        if ($row->level == 1){
                                            echo '
                                            <td>
                                                Easy
                                            </td>
                                            ';
                                        }
                                        if ($row->level == 2){
                                            echo '
                                            <td style="color: yellow">
                                                Medium
                                            </td>
                                            ';
                                        }
                                        if ($row->level == 3){
                                            echo '
                                            <td style="color: red">
                                                Hard
                                            </td>
                                            ';
                                        }
                                    ?>
                                    <?php
                                echo '
                                    <td>
                                        '.$row->unitScore.'
                                    </td>
                                    </tr>
                                    ';
                                    $k += 1;
                                }
                            ?>
                        
                    </tbody>
                </table>
            </div>
            <p>
                <a class="back-to-home" href="viewscore.php">Back to Home</a>
            </p>
        </section>
        <!-- <audio  id="music">
        <source src="sfx/main-Oman.mp3" type="audio/mp3">
    </audio> -->
        <audio id="click">
            <source src="sfx/click.ogg" type="audio/mp3">
        </audio>
</body>
<script src="js/confetti.js"></script>
<script>
    confetti.start()
</script>
<!-- <script src="js/results.js"></script> -->

</html>