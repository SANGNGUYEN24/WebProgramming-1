<?php
session_start();

if (!isset($_SESSION['courseId']))  $_SESSION['courseId'] = false;
if (!isset($_SESSION['courseName']))  $_SESSION['courseName'] = false;
if (!isset($_SESSION['quizId']))  $_SESSION['quizId'] = false;
if (!isset($_SESSION['quizName']))  $_SESSION['quizName'] = false;

# Update page:
$page = "course";
if (isset($_GET["page"])) {
  $page = $_GET["page"];
  if (isset($_GET['courseId'])) $_SESSION['courseId'] = $_GET['courseId'];
  if (isset($_GET['quizId'])) $_SESSION['quizId'] = $_GET['quizId'];
  if (isset($_GET['courseName']))  $_SESSION['courseName'] = $_GET['courseName'];
  if (isset($_GET['quizName'])) $_SESSION['quizName'] = $_GET['quizName'];
}

$button = "";
$title = "";

if ($page == "course") {
  $button = "Create a course";
  $title = "All courses";
} else if ($page == "quiz") {
  if (!$_SESSION['courseId']) {
    header('Location: ./?page=course');
  }
  $button = "Add a quiz";
  $title = "All quizzes";
} else if ($page == "question") {
  if (!$_SESSION['quizId'] || !$_SESSION['courseId']) {
    header('Location: ./?page=course');
  }
  $button = "Add a question";
} else if ($page == "result") {
  if (!$_SESSION['quizId'] || !$_SESSION['courseId']) {
    header('Location: ./?page=course');
  }
} else {
  header('Location: ./');
}

?>

<?php
if (!isset($_SESSION['username']) && $_SESSION['username'] == NULL) {
  header('Location: ../login/');
} else {
  if (isset($_SESSION['isStudent']) && $_SESSION['isStudent'] == true) {
    header('Location: ../student/');
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="">
  <meta name="description" content="The effective online-quiz system for schools to create, manage and take online quizzes· Suitable for any devices · Sign up for free!">
  <?php
  if ($page == "course"){
    echo '
    <title>QUIZ - Teacher - Course </title>
    <meta name="keywords" content="quiz, quizz, quizzes, quiz.com, www.quiz.com, quiz.com website, online quiz, join quiz, do quiz
                                 quiz login, quiz teacher, quiz teacher login, quiz teacher course">
    ';
  }
  else if ($page == "quiz"){
    echo '
    <title>QUIZ - Teacher - Quiz </title>
    <meta name="keywords" content="quiz, quizz, quizzes, quiz.com, www.quiz.com, quiz.com website, online quiz, join quiz, do quiz
                                 quiz login, quiz teacher, quiz teacher login, quiz teacher quiz">
    ';
  }
  else if ($page == "question"){
    echo '
    <title>QUIZ - Teacher - Question </title>
    <meta name="keywords" content="quiz, quizz, quizzes, quiz.com, www.quiz.com, quiz.com website, online quiz, join quiz, do quiz
                                 quiz login, quiz teacher, quiz teacher login, quiz teacher question, question">
    ';
  }
  else if ($page == "result") {
    echo "
      <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' integrity='sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm' crossorigin='anonymous'>
      <link href='http://www.jqueryscript.net/css/jquerysctipttop.css' rel='stylesheet' type='text/css'>
    ";
    echo '
    <title>QUIZ - Teacher - Students result </title>
    <meta name="keywords" content="quiz, quizz, quizzes, quiz.com, www.quiz.com, quiz.com website, online quiz, join quiz, do quiz
                                 quiz login, quiz teacher, quiz teacher login, quiz teacher result, quiz teacher student result">
    ';
  }
  else if ($page == "print"){
    echo '
    <title>QUIZ - Teacher - Students result </title>
    <meta name="keywords" content="quiz, quizz, quizzes, quiz.com, www.quiz.com, quiz.com website, online quiz, join quiz, do quiz
                                 quiz login, quiz teacher, quiz teacher login, quiz teacher print, quiz teacher PDF, quiz teacher download">
    ';
  }
  ?>
  <link rel="stylesheet" href="./teacher.css">
  <link rel="stylesheet" href="./<?php echo "$page/$page"; ?>.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
  <!-- Icon -->
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

</head>

<body>
  <div class="wrapper">
    <!-- Header -->
    <div>
      <header>
        <div class="container">
          <p class="name-page">ADMIN PAGE</p>
          <button class="sign-out"><a href="logout.php" id="sign-out-text">Sign out</a></button>
        </div>
      </header>

      <!-- Navigation bar -->
      <nav>
        <div class="container">
          <div class="nav-left">
            <div class="menu">
              <div class="menu-line"></div>
              <div class="menu-line"></div>
              <div class="menu-line"></div>
            </div>
            <!-- Path -->
            <p>Your courses
              <?php
              if ($page != 'course')
                echo ' > ' . $_SESSION['courseName'];
              if ($page == 'question' || $page == 'result')
                echo ' > ' . $_SESSION['quizName'];
              if ($page == 'result')
                echo ' > View result';
              ?>
            </p>
          </div>
          <div class="menu-list">

          </div>
          <div class="nav-right">
            <?php
            if ($page != "result") echo "
              <div class='create-btn'>
                <p>$button</p>
              </div>
              ";
            ?>
          </div>
        </div>
      </nav>
      <div class="content-wrapper">
        <?php
        require "../app/Models/Teacher.php";
        require "../app/Models/Course.php";
        require "../app/Models/Quiz.php";
        include "./$page/index.php";
        ?>
      </div>
    </div>
    <footer>
      Copyright 2021
    </footer>
  </div>
</body>

</html>