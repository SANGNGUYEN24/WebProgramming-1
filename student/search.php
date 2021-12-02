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

  <title>QUIZ - Find More Here</title>

  <meta name="description" content="Find More Quizzes Here · Get Quizzes From Your Teacher ·
                                    Sign up for more information!">
              
  <meta name="keywords" content="quiz, quizz, quizzes, quiz.com, www.quiz.com, quiz.com website, online quiz, find quiz, quiz from, quizzes from,
                                 quiz of, quizzes of, quiz search, quizzes search, quiz find, quizzes find, search quiz, search quizzes">

  <link rel="stylesheet" href="css/maicons.css">

  <link rel="stylesheet" href="css/bootstrap.css">

  <link rel="stylesheet" href="vendor/animate/animate.css">

  <link rel="stylesheet" href="css/theme.css">

</head>
<body>

  <header>
    <?php include_once "components/header.php"?>
  </header>

  <div class="container search-body">
    <div class="row align-items-center flex-wrap-reverse">
      <div class="col-md-6 py-5 wow fadeInLeft">
      <?php
            if (isset($_POST['search-service'])){
              $item = $_POST['item'];
            }
          ?>
        <form class="search-form" action="search_processing.php" method="POST">
            <div class="row mt-5 ">
                <div class="col-12 py-2 wow fadeInRight">
                  <div class="text-center wow fadeInUp">
                    <h1 id="search-title">Find More Here</h1>
                    <div class="divider mx-auto"></div>
                  </div>
                </div>
                <!-- <div class="col-12 py-2 wow fadeInRight text-md" data-wow-delay="300ms">
                    <select name="category" id="price-range" class="custom-select" required>
                        <option value="ask" selected disabled class="disable">You want to find...</option>
                        <option value="quiz">Quiz</option>
                        <option value="course">Course</option>
                        <option value="teacher">Teacher</option>
                    </select>
                </div> -->
                <div class="col-12 col-sm-12 py-2 wow fadeInRight">
                    <input type="text" name="item" class="form-control" placeholder="Search" required>
                </div>
                <!-- <div class="col-12 col-sm-6 py-2 wow fadeInRight">
                    <input type="text" name="searchID" class="form-control" placeholder="ID" required>
                </div> -->
                
            </div>
            <input type="hidden" name="page" value="search_processing">
            <button name="search-service" id="search-btn" type="submit" class="btn btn-primary wow zoomIn">Search</button>
          </form>
          
      </div>

      <div class="col-md-6 py-5 wow zoomIn">
        <div class="img-fluid text-center">
            <img src="images/search.png" alt="">
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