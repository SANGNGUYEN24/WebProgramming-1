<?php 
  require_once '../../database/conectCollection.php';
  session_start();
  $course = $courseCollection->findOne(['courseId' => $_SESSION["courseId"]]);
  $quiz = $quizCollection->findOne(['quizId' => $_SESSION["quizId"]]);
  $questions = $questionCollection->find(['quizId'=> $_SESSION["quizId"]]);
  print_r($_SESSION["courseId"]);
  print_r($course);
  $courseName = $course->name;
  $quizName = $quiz->name;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./print.css">
  <title>Print PDF</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
  <script type="text/javascript">
    function printPage() {
        //Get the print button and put it into a variable
        var printButton = document.getElementById("printPageButton");
        //Set the print button visibility to 'hidden' 
        printButton.style.visibility = 'hidden';
        //Print the page content
        window.print()
        //Set the print button to 'visible' again 
        //[Delete this line if you want it to stay hidden after printing]
        printButton.style.visibility = 'visible';
    }
</script>
</head>

<?php
$idx = 1;
echo "<h1>$courseName <br> $quizName </h1>";
echo "<button id=\"printPageButton\" onclick=\"printPage()\">Download PDF</button>";
  foreach($questions as $question){
    echo "
    <div >
    <p><span>Question $idx:</span> ".$question->description."?</p>
    <p class=\"correct\">A. ".$question->option1."</p>
    <p>B. ".$question->option2."</p>
    <p>C. ".$question->option3."</p>
    <p id = \"last-option\">D. ".$question->option4."</p>
  </div>";
  
  echo "
    <div>
    <p><span>Question $idx:</span> ".$question->description."?</p>
    <p class=\"correct\">A. ".$question->option1."</p>
    <p>B. ".$question->option2."</p>
    <p>C. ".$question->option3."</p>
    <p \"last-option\">D. ".$question->option4."</p>
  </div>";
  $idx++;
  }
// Test fetching
// Test fetching
// Test fetching
// Test fetching
// Test fetching
// Test fetching
  
?>
<!-- <body> 
  <h1>Course: {Course name} - Quiz: {Quiz name}</h1>
  <button id="printPageButton" onclick="printPage()">Download PDF</button>
  <div>
    <p><span>Question 1:</span> ADSDWASDZXCACWQ ?</p>
    <p class="correct">A. ADWDOZXIC</p>
    <p>B. OZIXCWQL</p>
    <p>C. CZOXICQLWE</p>
    <p>D. Nam Vo</p>
  </div>
  <div>
    <p><span>Question 1:</span> ADSDWASDZXCACWQ ?</p>
    <p class="correct">A. ADWDOZXIC</p>
    <p>B. OZIXCWQL</p>
    <p>C. CZOXICQLWE</p>
    <p>D. Nam Vo</p>
  </div>
  <div>
    <p><span>Question 1:</span> ADSDWASDZXCACWQ ?</p>
    <p class="correct">A. ADWDOZXIC</p>
    <p>B. OZIXCWQL</p>
    <p>C. CZOXICQLWE</p>
    <p>D. Nam Vo</p>
  </div>
  <div>
    <p><span>Question 1:</span> ADSDWASDZXCACWQ ?</p>
    <p class="correct">A. ADWDOZXIC</p>
    <p>B. OZIXCWQL</p>
    <p>C. CZOXICQLWE</p>
    <p>D. Nam Vo</p>
  </div>
  <div>
    <p><span>Question 1:</span> ADSDWASDZXCACWQ ?</p>
    <p class="correct">A. ADWDOZXIC</p>
    <p>B. OZIXCWQL</p>
    <p>C. CZOXICQLWE</p>
    <p>D. Nam Vo</p>
  </div>
</body>
</html> -->


