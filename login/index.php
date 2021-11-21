<?php
  session_start();
  if (!isset($_SESSION['username']) or $_SESSION['username'] == NULL) {
    //header('Location: ./login/index.php');
  } else {
    if (isset($_SESSION['isStudent']) && $_SESSION['isStudent'] == true){
        header('Location: ../student/');
    }
    if (isset($_SESSION['isTeacher']) && $_SESSION['isTeacher'] == true){
        header('Location: ../teacher/');
    }
  }

  include 'loginProccessing.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="style.css">
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</head>
<body>
  <div class="Wrapper">
    <div class="Container">
      <div class="BehindContainer">
        <div class="TeacherSide">
          <p>Login as <span id="teacher">TEACHER</span></p>
        </div>
        <div class="StudentSide">
          <p>Login as <span id="student">STUDENT</span></p>
        </div>
      </div>
      <div class="ContentWrapper">
        <p class="Logo">YOU ARE A <span id="content">TEACHER</span></p>
        <div class="FormWrapper">

          <!-- Teacher form -->
          <form class="TeacherWrapper" method="POST" action="index.php">
            <div class="TeacherForm">
              <div class="InputWrapper">
                <i class='fas fa-user-alt icon'></i>
                <input name="username" placeholder="Username" type="email" class="input" autocomplete="off"/>
              </div>
              <div class="InputWrapper">
                <i class='fas fa-key icon'></i>
                <input name="password" placeholder="Password" type="password" class="input"/>
              </div>
              <input name="type" value="1" class="Hide"/>
              <?php
                if ($_SESSION["loginFail"] == true && $_SESSION["loginTeacher"] == true) echo "<p class='wrong'>Invalid username or password</p>";
              ?>
              <button type="submit" class="TeacherButton" name="TeacherButton">Login</button>
              <a href="../register/" class="create-teacher">Create a teacher account</a>
            </div>
          </form>
          
          
          <!-- Student form -->
          <form class="StudentWrapper" method="post" action="index.php">
            <div class="StudentForm">
              <div class="InputWrapper">
                <i class='fas fa-user-alt icon'></i>
                <input name="username" placeholder="Username" type="email" class="input" autocomplete="off"/>
              </div>
              <div class="InputWrapper">
                <i class='fas fa-key icon'></i>
                <input name="password" placeholder="Password" type="password" class="input"/>
              </div>
              <input name="type" value="2" class="Hide"/>
              <?php
                if ($_SESSION["loginFail"] == true && $_SESSION["loginStudent"] == true) echo "<p class='wrong'>Invalid username or password</p>";
              ?>
              <button type="submit" class="StudentButton" name="StudentButton">Login</button>
              <a href="../register/" class="create-student">Create a student account</a>
            </div>
          </form>


        </div>
      </div>
    </div>
  </div>
  <script src="./index.js"></script>
</body>
</html>