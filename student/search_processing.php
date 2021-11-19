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
    include './getStudentInfo.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="css/maicons.css">

  <link rel="stylesheet" href="css/bootstrap.css">

  <link rel="stylesheet" href="vendor/animate/animate.css">

  <link rel="stylesheet" href="css/theme.css">

</head>
<body>


  <header>
    <?php include_once "components/header.php"?>
  </header>
  
<div id="search_proc" style="min-height: 76vh;">
    <div class="text-center wow fadeInUp">
        <h1 id="search-title">What You Found Here </h1>
        <div class="divider mx-auto"></div>
      </div>
      <div class="row mt-5">
      <?php
        if(isset($_GET['item'])){
          $item = $_GET['item'];

          //find in Quiz table
          $findInQuiz = $db->quiz;
          $res = $findInQuiz->find(['name'=>['$regex'=>'(?i)'.$item]]);
          //var_dump($res);
          $getStudentInfo = getStudent($_SESSION['username']);
          $studentID = $getStudentInfo->studentId;
          foreach($res as $row){
            $getQuizInfo = getQuiz($row->quizId);
            
            $findScore = $db->mark;

            $resScore = $findScore->findOne(['studentId'=>$studentID, 'quizId'=>$row->quizId]);

            if (empty($resScore)){
              $score = "";
            } else {
              $score = $resScore->score;
            }
            echo '
            <div class="col-lg-3 py-3 wow fadeInUp">
              <div class="card-blog">
                <div class="header">
                  <div class="post-thumb">
                    <img src="images/quiz-blog.png" alt="">
                  </div>
                </div>
                <div class="body">
                  <h5 class="post-title">'.$getQuizInfo->name.'</h5>
                  <p class="post-date">Course: <a href="./search_processing.php?item='.getCourse($getQuizInfo->courseId)->name.'">'.getCourse($getQuizInfo->courseId)->name.'</a> ('.$getQuizInfo->courseId.')</p>
                  <p class="post-date">Created by: <a href="./search_processing.php?item='.getTeacher($getQuizInfo->teacherId)->name.'">'.getTeacher($getQuizInfo->teacherId)->name.'</a></p>
                  <p class="post-date" style="color:green">Score: '.$score.'</p>
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

          //find in teacher table:
          $findInTeacher = $db->teacher;
          $res = $findInTeacher->find(['name'=>['$regex'=>'(?i)'.$item]]);
          foreach ($res as $teacherRow){
            $findQuiz = $db->quiz;
            $resQuiz = $findQuiz->find(['teacherId'=>$teacherRow->teacherId]);

            foreach ($resQuiz as $quizRow){
              $getQuizInfo = getQuiz($quizRow->quizId);
              $findScore = $db->mark;

              $resScore = $findScore->findOne(['studentId'=>$studentID, 'quizId'=>$quizRow->quizId]);

              if (empty($resScore)){
                $score = "";
              } else {
                $score = $resScore->score;
              }
              echo '
              <div class="col-lg-3 py-3 wow fadeInUp">
                <div class="card-blog">
                  <div class="header">
                    <div class="post-thumb">
                      <img src="images/quiz-blog.png" alt="">
                    </div>
                  </div>
                  <div class="body">
                    <h5 class="post-title">'.$getQuizInfo->name.'</h5>
                    <p class="post-date">Course: <a href="./search_processing.php?item='.getCourse($getQuizInfo->courseId)->name.'">'.getCourse($getQuizInfo->courseId)->name.'</a> ('.$getQuizInfo->courseId.')</p>
                    <p class="post-date">Created by: <a href="./search_processing.php?item='.$teacherRow->name.'">'.$teacherRow->name.'</a></p>
                    <p class="post-date" style="color:green">Score: '.$score.'</p>
                    ' ?>
                    <?php
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
                        <a href="results.php?quizID='.$quizRow->quizId.'" class="btn btn-warning">Review</a>';
                      } else {
                        if ($start < $now){
                          echo '
                          <p class="post-date" style="color:red">Deadline: '.$getQuizInfo->dueDate.'</p>
                          <a href="game.php?id='.$quizRow->quizId.'" class="btn btn-secondary">Do it</a>';
                        } else {
                          echo'
                          <p class="post-date" style="color:red">Start from: '.$quizRow->startDate.'</p>
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

          //Find in Course table
          $findInCourse = $db->course;
          $res = $findInCourse->find(['name'=>['$regex'=>'(?i)'.$item]]);

          foreach($res as $courseRow){
            $findQuiz = $db->quiz;
            $resQuiz = $findQuiz->find(['courseId'=>$courseRow->courseId]);

            foreach($resQuiz as $quizRow){
              $getQuizInfo = getQuiz($quizRow->quizId);
              $findScore = $db->mark;

              $resScore = $findScore->findOne(['studentId'=>$studentID, 'quizId'=>$quizRow->quizId]);

              if (empty($resScore)){
                $score = "";
              } else {
                $score = $resScore->score;
              }
              echo '
              <div class="col-lg-3 py-3 wow fadeInUp">
                <div class="card-blog">
                  <div class="header">
                    <div class="post-thumb">
                      <img src="images/quiz-blog.png" alt="">
                    </div>
                  </div>
                  <div class="body">
                    <h5 class="post-title">'.$getQuizInfo->name.'</h5>
                    <p class="post-date">Course: <a href="./search_processing.php?item='.$courseRow->name.'">'.$courseRow->name.'</a> ('.$getQuizInfo->courseId.')</p>
                    <p class="post-date">Created by: <a href="./search_processing.php?item='.getTeacher($getQuizInfo->teacherId)->name.'">'.getTeacher($getQuizInfo->teacherId)->name.'</a></p>
                    <p class="post-date" style="color:green">Score: '.$score.'</p>
                    ' ?>
                    <?php
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
                        <a href="results.php?quizID='.$quizRow->quizId.'" class="btn btn-warning">Review</a>';
                      } else {
                        if ($start < $now){
                          echo '
                          <p class="post-date" style="color:red">Deadline: '.$getQuizInfo->dueDate.'</p>
                          <a href="game.php?id='.$quizRow->quizId.'" class="btn btn-secondary">Do it</a>';
                        } else {
                          echo'
                          <p class="post-date" style="color:red">Start from: '.$quizRow->startDate.'</p>
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
        }

        if (isset($_POST['search-service'])){
          $item = $_POST['item'];
          
          //find in Quiz table
          $findInQuiz = $db->quiz;
          $res = $findInQuiz->find(['name'=>['$regex'=>'(?i)'.$item]]);
          //var_dump($res);
          $getStudentInfo = getStudent($_SESSION['username']);
          $studentID = $getStudentInfo->studentId;
          foreach($res as $row){
            $getQuizInfo = getQuiz($row->quizId);
            
            $findScore = $db->mark;

            $resScore = $findScore->findOne(['studentId'=>$studentID, 'quizId'=>$row->quizId]);

            if (empty($resScore)){
              $score = "";
            } else {
              $score = $resScore->score;
            }
            echo '
            <div class="col-lg-3 py-3 wow fadeInUp">
              <div class="card-blog">
                <div class="header">
                  <div class="post-thumb">
                    <img src="images/quiz-blog.png" alt="">
                  </div>
                </div>
                <div class="body">
                  <h5 class="post-title">'.$getQuizInfo->name.'</h5>
                  <p class="post-date">Course: <a href="./search_processing.php?item='.getCourse($getQuizInfo->courseId)->name.'">'.getCourse($getQuizInfo->courseId)->name.'</a> ('.$getQuizInfo->courseId.')</p>
                  <p class="post-date">Created by: <a href="./search_processing.php?item='.getTeacher($getQuizInfo->teacherId)->name.'">'.getTeacher($getQuizInfo->teacherId)->name.'</a></p>
                  <p class="post-date" style="color:green">Score: '.$score.'</p>
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

          //find in teacher table:
          $findInTeacher = $db->teacher;
          $res = $findInTeacher->find(['name'=>['$regex'=>'(?i)'.$item]]);
          foreach ($res as $teacherRow){
            $findQuiz = $db->quiz;
            $resQuiz = $findQuiz->find(['teacherId'=>$teacherRow->teacherId]);

            foreach ($resQuiz as $quizRow){
              $getQuizInfo = getQuiz($quizRow->quizId);
              $findScore = $db->mark;

              $resScore = $findScore->findOne(['studentId'=>$studentID, 'quizId'=>$quizRow->quizId]);

              if (empty($resScore)){
                $score = "";
              } else {
                $score = $resScore->score;
              }
              echo '
              <div class="col-lg-3 py-3 wow fadeInUp">
                <div class="card-blog">
                  <div class="header">
                    <div class="post-thumb">
                      <img src="images/quiz-blog.png" alt="">
                    </div>
                  </div>
                  <div class="body">
                    <h5 class="post-title">'.$getQuizInfo->name.'</h5>
                    <p class="post-date">Course: <a href="./search_processing.php?item='.getCourse($getQuizInfo->courseId)->name.'">'.getCourse($getQuizInfo->courseId)->name.'</a> ('.$getQuizInfo->courseId.')</p>
                    <p class="post-date">Created by: <a href="./search_processing.php?item='.$teacherRow->name.'">'.$teacherRow->name.'</a></p>
                    <p class="post-date" style="color:green">Score: '.$score.'</p>
                    ' ?>
                    <?php
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
                        <a href="results.php?quizID='.$quizRow->quizId.'" class="btn btn-warning">Review</a>';
                      } else {
                        if ($start < $now){
                          echo '
                          <p class="post-date" style="color:red">Deadline: '.$getQuizInfo->dueDate.'</p>
                          <a href="game.php?id='.$quizRow->quizId.'" class="btn btn-secondary">Do it</a>';
                        } else {
                          echo'
                          <p class="post-date" style="color:red">Start from: '.$quizRow->startDate.'</p>
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

          //Find in Course table
          $findInCourse = $db->course;
          $res = $findInCourse->find(['name'=>['$regex'=>'(?i)'.$item]]);

          foreach($res as $courseRow){
            $findQuiz = $db->quiz;
            $resQuiz = $findQuiz->find(['courseId'=>$courseRow->courseId]);

            foreach($resQuiz as $quizRow){
              $getQuizInfo = getQuiz($quizRow->quizId);
              $findScore = $db->mark;

              $resScore = $findScore->findOne(['studentId'=>$studentID, 'quizId'=>$quizRow->quizId]);

              if (empty($resScore)){
                $score = "";
              } else {
                $score = $resScore->score;
              }
              echo '
              <div class="col-lg-3 py-3 wow fadeInUp">
                <div class="card-blog">
                  <div class="header">
                    <div class="post-thumb">
                      <img src="images/quiz-blog.png" alt="">
                    </div>
                  </div>
                  <div class="body">
                    <h5 class="post-title">'.$getQuizInfo->name.'</h5>
                    <p class="post-date">Course: <a href="./search_processing.php?item='.$courseRow->name.'">'.$courseRow->name.'</a> ('.$getQuizInfo->courseId.')</p>
                    <p class="post-date">Created by: <a href="./search_processing.php?item='.getTeacher($getQuizInfo->teacherId)->name.'">'.getTeacher($getQuizInfo->teacherId)->name.'</a></p>
                    <p class="post-date" style="color:green">Score: '.$score.'</p>
                    ' ?>
                    <?php
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
                        <a href="results.php?quizID='.$quizRow->quizId.'" class="btn btn-warning">Review</a>';
                      } else {
                        if ($start < $now){
                          echo '
                          <p class="post-date" style="color:red">Deadline: '.$getQuizInfo->dueDate.'</p>
                          <a href="game.php?id='.$quizRow->quizId.'" class="btn btn-secondary">Do it</a>';
                        } else {
                          echo'
                          <p class="post-date" style="color:red">Start from: '.$quizRow->startDate.'</p>
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
        }
      ?>
      </div>
      <!--If no result, show class "not-found"-->  
      <!-- <div class="not-found">
        <div class="text-center wow fadeInUp">
          <p class="subhead">Sorry, we don't have that!<p>
        </div>
        <div class="wow fadeInUp">
          <img src="images/no-result.png" id="not-found-img">
        </div>
      </div> -->

      <!--Show results like this class-->  
       <!-- <div class="row mt-5">
        <div class="col-lg-12 py-3 wow fadeInUp">
          <div id="search-card" class="card-blog">
            <div class="header">
              <div class="post-thumb">
                <img src="images/quiz-1.jpg" alt="">
              </div>
            </div>
            <div class="body">
              <h5 class="post-title"><a href="#">NAME</a></h5>
              <h6>Info 1: </h6>
              <h6>Info 2: </h6>
              <h6>Info 3: </h6>
              <a href="#" class="btn btn-secondary">Learn more</a>
            </div>
          </div>
        </div>
      </div> -->

      <div class="col-12 mt-4 text-center wow fadeInUp">
          <a href="search.php" id="find-another" class="btn btn-primary">Find another?</a>
      </div>
      <div class="col-12 mt-4 text-center wow fadeInUp">
          <a href="index.php" id="back-search" class="btn btn-secondary">Back to home</a>
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