<?php
session_start();

if (!isset($_SESSION['courseId']))  $_SESSION['courseId'] = false;
if (!isset($_SESSION['courseName']))  $_SESSION['courseName'] = false;
if (!isset($_SESSION['quizId']))  $_SESSION['quizId'] = false;
if (!isset($_SESSION['quizName']))  $_SESSION['quizName'] = false;

if (isset($_POST['btnCourseId'])) {
  $_SESSION['courseId'] = $_POST['courseId'];
  if ($_GET['courseName']) $_SESSION['courseName'] = $_GET['courseName'];
}

if (isset($_POST['btnQuizId'])) {
  $_SESSION['quizId'] = $_POST['quizId'];
  if ($_GET['quizName']) $_SESSION['quizName'] = $_GET['quizName'];
}

# Update page:
$page = "course";
if (isset($_GET["page"])) {
  $page = $_GET["page"];
}

// # Update courseName/Id and quizName/Id
// if ($page == 'course') {
//   $_SESSION['courseId'] = false;
//   $_SESSION['courseName'] = false;
//   $_SESSION['quizId'] = false;
//   $_SESSION['quizName'] = false;
// }
// if ($page == 'quiz') {
//   $_SESSION['quizId'] = false;
//   $_SESSION['quizName'] = false;
// }

$button = "";
$title = "";
if ($page == "course") {
  $button = "Create a course";
  $title = "All courses";
} else if ($page == "quiz") {
  $button = "Add a quiz";
  $title = "All quizzes";
} else if ($page == "question") {
  $button = "Add a question";
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
  <title>Home</title>
  <?php
  if ($page == "result") echo "
      <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' integrity='sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm' crossorigin='anonymous'>
      <link href='http://www.jqueryscript.net/css/jquerysctipttop.css' rel='stylesheet' type='text/css'>
    ";
  ?>
  <link rel="stylesheet" href="./teacher.css">
  <link rel="stylesheet" href="./<?php echo "$page/$page"; ?>.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
  <div class="wrapper">
    <!-- Header -->
    <div>
      <header>
        <div class="container">
          <p class="name-page">ADMIN PAGE</p>
          <button class="sign-out"><a href="../index.php" id="sign-out-text">Sign out</a></button>
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
              if ($_SESSION['courseId']) {
                echo ' > ' . $_SESSION['courseName'];
              }
              if ($_SESSION['quizId']) {
                echo ' > ' . $_SESSION['quizName'];
              }
              if ($page == "result") echo " > View result";
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