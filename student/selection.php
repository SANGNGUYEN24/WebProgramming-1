<?php
    session_start();

    if (!isset($_SESSION['username']) && $_SESSION['username'] == NULL) {
        header('Location: ../login/');
    } else {
        if (isset($_SESSION['isTeacher']) && $_SESSION['isTeacher'] == true){
            header('Location: ../login/');
        }
    }
    include '../connect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QUIZ Time - Enter ID Here</title>
    <meta name="description" content="Join a quiz of QUIZ ·
                                    Take any quiz with its ID · Sign up to take the quiz!">
              
    <meta name="keywords" content="quiz, quizz, quizzes, quiz.com, www.quiz.com, quiz.com website, online quiz, join quiz, do quiz
                                 quiz ID , quiz student, quiz ID student, play quiz, take quiz, enter quiz, enter quiz ID, quiz time, quiz quiz time ">

    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <header class="header">
        <a href="index.php" class="active back-selection">Home &#10558;</a>
    </header>
    <div class="wrapper">
        <main class="selection-wrapper">
            <img src="images/quizyo-1.png" class="selection-logo">
            <div class="selection">
                <h1 class="selection-menu-header"></h1>
                <form method="POST" action="selection.php">
                    <label  id="selection-menu" class="selection-menu" >
                        <input id="quizID" type="text" placeholder="QUIZ ID" name="quizID" required>
                    </label>
                <?php
                    if (isset($_POST['findQuiz'])){
                        $quizID = $_POST['quizID'];

                        $post = $db->quiz;

                        $results = $post->findOne(['quizId'=>$quizID]);

                        if (empty($results)){
                            echo '<p>No quiz found!<p>';
                        } else {
                            header('Location: ./game.php?id='.$quizID);
                        }
                    }
                ?>
                <button type="submit" id='submitForm' class="play-game" name="findQuiz">
                   <a style="color:white; text-decoration:none;"> GAME ON!</a>
                </button>
                </form>
            </div>
            
            </form>
                <audio  id="music">
                    <source src="sfx/intro-Oman.mp3" type="audio/mp3">
                </audio>
                <audio  id="click">
                    <source src="sfx/click.ogg" type="audio/ogg">
                </audio>
                <img id="toggle" class="play" onclick="toggle()" src="images/pause.png">    
        </main>
    </div>
    
</body>
<footer class="footer">
        <!-- <audio id="music">
            <source src="sfx/main-Oman.mp3" type="audio/mp3">
                <p><i class="fa fa-play" aria-hidden="true"></i>
                <i class="fa fa-pause" aria-hidden="true"></i></p>
        </audio> -->
        <audio  id="click">
            <source src="sfx/click.ogg" type="audio/mp3">
        </audio>
    </footer>
<script src="js/index.js"></script>    
<script src="js/entry.js"></script>    
</html>