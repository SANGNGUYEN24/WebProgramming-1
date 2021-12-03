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
  <title>QUIZ MAKER - Login </title>
  <meta name="description" content="This website is used to do quiz for free. This is used by teachers and students. Students do the quiz from the teachers.">
  <meta name="keywords" content="quiz, quizz, quizzes, quiz.com, www.quiz.com, quiz.com website, online quiz, join quiz, do quiz
                                 quiz login">
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
                <svg aria-hidden="true"  focusable="false" data-prefix="fas" data-icon="user-alt" class="svg-inline--fa fa-user-alt fa-w-16 icon" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M256 288c79.5 0 144-64.5 144-144S335.5 0 256 0 112 64.5 112 144s64.5 144 144 144zm128 32h-55.1c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16H128C57.3 320 0 377.3 0 448v16c0 26.5 21.5 48 48 48h416c26.5 0 48-21.5 48-48v-16c0-70.7-57.3-128-128-128z"></path></svg>
                <input name="username" placeholder="Username" type="email" class="input" autocomplete="off"/>
              </div>
              <div class="InputWrapper">
                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="key" class="svg-inline--fa fa-key fa-w-16 icon" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M512 176.001C512 273.203 433.202 352 336 352c-11.22 0-22.19-1.062-32.827-3.069l-24.012 27.014A23.999 23.999 0 0 1 261.223 384H224v40c0 13.255-10.745 24-24 24h-40v40c0 13.255-10.745 24-24 24H24c-13.255 0-24-10.745-24-24v-78.059c0-6.365 2.529-12.47 7.029-16.971l161.802-161.802C163.108 213.814 160 195.271 160 176 160 78.798 238.797.001 335.999 0 433.488-.001 512 78.511 512 176.001zM336 128c0 26.51 21.49 48 48 48s48-21.49 48-48-21.49-48-48-48-48 21.49-48 48z"></path></svg>
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
                <svg aria-hidden="true"  focusable="false" data-prefix="fas" data-icon="user-alt" class="svg-inline--fa fa-user-alt fa-w-16 icon" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M256 288c79.5 0 144-64.5 144-144S335.5 0 256 0 112 64.5 112 144s64.5 144 144 144zm128 32h-55.1c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16H128C57.3 320 0 377.3 0 448v16c0 26.5 21.5 48 48 48h416c26.5 0 48-21.5 48-48v-16c0-70.7-57.3-128-128-128z"></path></svg>
                <input name="username" placeholder="Username" type="email" class="input" autocomplete="off"/>
              </div>
              <div class="InputWrapper">
                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="key" class="svg-inline--fa fa-key fa-w-16 icon" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M512 176.001C512 273.203 433.202 352 336 352c-11.22 0-22.19-1.062-32.827-3.069l-24.012 27.014A23.999 23.999 0 0 1 261.223 384H224v40c0 13.255-10.745 24-24 24h-40v40c0 13.255-10.745 24-24 24H24c-13.255 0-24-10.745-24-24v-78.059c0-6.365 2.529-12.47 7.029-16.971l161.802-161.802C163.108 213.814 160 195.271 160 176 160 78.798 238.797.001 335.999 0 433.488-.001 512 78.511 512 176.001zM336 128c0 26.51 21.49 48 48 48s48-21.49 48-48-21.49-48-48-48-48 21.49-48 48z"></path></svg>
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