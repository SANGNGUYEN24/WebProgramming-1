<?php
session_start();

// $_SESSION['teacherID'] = "TC-345678912";
// $_SESSION['courseID'] = 'CO3001';
// $_SESSION['quizID'] = '617a6de6fc13ae3d9c000006';

$page = "result";
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
    // session_start();

    if (!isset($_SESSION['username']) && $_SESSION['username'] == NULL) {
        header('Location: ../login/');
    } else {
        if (isset($_SESSION['isStudent']) && $_SESSION['isStudent'] == true){
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
  <link rel="stylesheet" href="./teacher.css">
  <link rel="stylesheet" href="./<?php echo "$page/$page"; ?>.css">
  <link rel="stylesheet" href="./responsive.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
  
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
            <p>Your courses</p>
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
        // require "../database/connectDB.php";
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