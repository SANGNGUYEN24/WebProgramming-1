<?php
    session_start();

    if (!isset($_SESSION['username']) && $_SESSION['username'] == NULL) {
        header('Location: ../login/');
    } else {
        if (isset($_SESSION['isTeacher']) && $_SESSION['isTeacher'] == true){
            header('Location: ../login/');
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <title>Student Homepage</title>

  <link rel="stylesheet" href="css/maicons.css">

  <link rel="stylesheet" href="css/bootstrap.css">

  <link rel="stylesheet" href="vendor/animate/animate.css">

  <link rel="stylesheet" href="css/theme.css">

</head>
<body>

  <!-- Back to top button -->
  <div class="back-to-top"></div>

  <header>
    <?php include_once "components/header.php"?>

    <div class="container">
      <div class="page-banner home-banner">
        <div class="row align-items-center flex-wrap-reverse h-100">
          <div class="col-md-6 py-5 wow fadeInLeft">
            <h1 class="mb-4">Let's challenge yourself with quizzes!</h1>
            <p class="text-lg text-grey mb-5">Variety of courses contain multiple choice quizzes that in different levels</p>
            <a href="quiz.php" class="btn btn-primary btn-split">Let's Go <div class="fab"><span class="mai-play"></span></div></a>
          </div>
          <div class="col-md-6 py-5 wow zoomIn">
            <div class="img-fluid text-center">
              <img src="images/Digital-Quiz-Slider.png" alt="">
            </div>
          </div>
        </div>
        <a href="#" class="btn-scroll" data-role="smoothscroll"><span class="mai-arrow-down"></span></a>
      </div>
    </div>
  </header>

  <div class="page-section">
    <div class="container">
      <div class="text-center wow fadeInUp">
        <div class="subhead">Happy Quizzes</div>
        <h2 class="title-section">Most Recent Quizzes</h2>
        <div class="divider mx-auto"></div>
      </div>

      <div class="row mt-5">
        <?php
          include '../connect.php';
          include './getStudentInfo.php';

          $post = $db->mark;

          $id = getStudent($_SESSION['username'])->studentId;
          
          $res = $post->find(
            [
              'studentId' => strval($id)
            ],
            [
              'limit' => 3,
              'sort' => ['dateTaken' =>-1]
            ]
          ); //$id must be converted to string


          if (empty($res)){
            echo 'You have not done any quiz';
          } else {
            foreach ($res as $row){
              $getQuizInfo = getQuiz($row->quizId);
              echo '
              <div class="col-lg-4 py-3 wow fadeInUp">
              <div class="card-blog">
                <div class="header">
                  <div class="post-thumb">
                    <img src="images/quiz-blog.png" alt="">
                  </div>
                </div>
                <div class="body">
                  <h5 class="post-title">'.getQuiz($row->quizId)->name.'</h5>
                  <p class="post-date">Course: <a href="search_processing.php?item='.getCourse($getQuizInfo->courseId)->name.'">'.getCourse($getQuizInfo->courseId)->name.'</a> ('.$getQuizInfo->courseId.')</p>
                  <p class="post-date">Created by: <a href="search_processing.php?item='.getTeacher($getQuizInfo->teacherId)->name.'">'.getTeacher($getQuizInfo->teacherId)->name.'</a></p>
                  <p class="post-date" style="color:green">Score: '.$row->score.'</p>
                  ' ?>
                  <?php
                    date_default_timezone_set('Asia/Ho_Chi_Minh');
                    $now = time();
                    $getDate = $getQuizInfo->dueDate;

                    $dateCreate = DateTime::createFromFormat('Y-m-d',$getDate);

                    $array = (array)$dateCreate;
                    $getDeadline = $array['date'];

                    $startDate = $getQuizInfo->startDate;

                    $convertStartDate = DateTime::createFromFormat('Y-m-d',$startDate);
                    
                    $startDateArray = (array)$convertStartDate;

                    $getStartDate  =$startDateArray['date'];

                    $start = strtotime($getStartDate);
                    $time = strtotime(strval($getDeadline));
                    
                    if ($time<= $now) {
                      echo '<p class="post-date" style="color:red">Deadline: '.$getQuizInfo->dueDate.'(over)</p>
                      <a href="results.php?quizID='.$row->quizId.'" class="btn btn-warning">Review</a>';
                    } else {
                      if ($start < $now){
                        echo '
                        <p class="post-date" style="color:red">Deadline: '.$getQuizInfo->dueDate.'</p>
                        <a href="game.php?id='.$row->quizId.'" class="btn btn-secondary">Do it</a>';
                      } else {
                        echo'
                        <p class="post-date" style="color:red">Start from: '.$getQuizInfo->startDate.'</p>
                        <p class="post-date" style="color:red">This quiz has not started yet.</p>
                        ';
                      }
                    }
                  ?>
                  <?php
                  echo '
                </div>
              </div>
            </div>
              ';
            }
          }
        ?>
        

        <div class="col-12 mt-4 text-center wow fadeInUp">
          <a href="module.php" class="btn btn-primary">View Your Modules</a>
        </div>

      </div>
    </div>
  </div>

  <?php include_once "components/footer.php"?>

<script src="js/jquery-3.5.1.min.js"></script>

<script src="js/bootstrap.bundle.min.js"></script>

<script src="js/google-maps.js"></script>

<script src="vendor/wow/wow.min.js"></script>

<script src="js/theme.js"></script>
  
</body>
</html>
© 2021 GitHub, Inc.