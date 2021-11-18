<?php
// Get quiz collection:
$questionCollection = $mydb->question;
$quizCollection =  $mydb->quiz;

// Random Quiz ID:
function random_quiz_id()
{
  $chars = "Q-";
  $numbers = "0123456789";
  $quizId = $chars . substr(str_shuffle($numbers), 0, 10);
  return $quizId;
};

if (isset($_POST['btnAddQuiz'])) {
  // Insert Quiz
  $quizId = random_quiz_id();
  $insertQuiz = $quizCollection->insertOne([
    'quizId' => $quizId,
    'teacherId' => $_SESSION['teacherId'],
    'courseId' => $_SESSION['courseId'],
    'name' => $_POST['quizName'],
    'startDate' => $_POST['startDate'],
    'dueDate' => $_POST['dueDate'],
  ]);

  $countQuestions = (int) $_POST['countQuestions'];
  // Insert Questions:
  for ($i = 0; $i < $countQuestions; $i++) {
    $insertQuestion = $questionCollection->insertOne([
      'questionNumber' => $i + 1,
      'quizId' => $quizId,
      'courseId' => $_SESSION['courseId'],
      'description' => htmlspecialchars($_POST['description-' . $i + 1]),
      'option1' => htmlspecialchars($_POST['option1-' . $i + 1]),
      'option2' => htmlspecialchars($_POST['option2-' . $i + 1]),
      'option3' => htmlspecialchars($_POST['option3-' . $i + 1]),
      'option4' => htmlspecialchars($_POST['option4-' . $i + 1]),
      'level' => $_POST['lvlOption-' . $i + 1],
      'unitScore' => (int) $_POST['lvlOption-' . $i + 1] * 10,
    ]);
  }
}
?>

<form class="form-quiz" id="form-quiz" method="POST">
  <div class="form-top">
    <div class="form-name">
      <p class="title">Quiz name</p>
      <input type="text" name="quizName" placeholder="Quiz name" required>
    </div>
    <div>
      <div class="date-flex">
        <div class="date">
          <p>Start Date </p>
          <input type="date" name="startDate" class="select-date" placeholder="Select Date" required>
        </div>
        <div class="date">
          <p>Due Date </p>
          <input type="date" name="dueDate" class="select-date" placeholder="Select Date" required>
        </div>
      </div>
      <span class="wrong"></span>
    </div>
  </div>
  <div class="form-wrapper">
    <div class='line'></div>
    <div class="form-header">
      <div class="form-title">
        <p class="title">Question 1<span class="wrong"></span></p>
      </div>
      <div class="form-input">
        <textarea name="description-1" rows="2" placeholder="Question Description" required></textarea>
        <div class="form-select">
          <select name="lvlOption-1">
            <option value="1">Easy</option>
            <option value="2">Medium</option>
            <option value="3">Hard</option>
          </select>
        </div>
      </div>
    </div>
    <div class="form-bottom">
      <div class="form-option">
        <p>Option A<span style="color: red">*</span><span class="wrong"></span></p>
        <textarea name="option1-1" rows="2" placeholder="Option A (correct answer)" required></textarea>
      </div>
      <div class="form-option">
        <p>Option B <span class="wrong"></span></p>
        <textarea name="option2-1" rows="2" placeholder="Option B" required></textarea>
      </div>
      <div class="form-option">
        <p>Option C <span class="wrong"></span></p>
        <textarea name="option3-1" rows="2" placeholder="Option C" required></textarea>
      </div>
      <div class="form-option">
        <p>Option D <span class="wrong"></span></p>
        <textarea name="option4-1" rows="2" placeholder="Option D" required></textarea>
      </div>
    </div>
  </div>
  <div class="add-btn" name="btnAddQuestion">
    <input type="hidden" value="1" class="ipCount" name="countQuestions" />
    <p>Add a question</p>
  </div>
  <div class="form-button">
    <div class="cancel">Cancel</div>
    <button type="submit" class="submit" name="btnAddQuiz">Submit</button>
  </div>
</form>

<h1><?php echo $title; ?></h1>

<div class="content-container">
  <?php
  // Get quiz collections
  $quizCollection = $mydb->quiz;

  // Get quizzes based on courseID and teacherID
  $quizzes = $quizCollection->find(['courseId' => $_SESSION["courseId"], 'teacherId' => $_SESSION["teacherId"]]);

  foreach ($quizzes as $quiz) {
    echo '<form class="card" action="./?page=question&quizName=' . $quiz->name . '" method="POST">
            <div class="card-top">
                <p>' . $quiz->name . '</p>
                <button type="submit" name="btnQuizId">VIEW</button>
            </div>
            <div class="card-bot">
              <p class="date">' . $quiz->startDate . '</p>
              <div class="horizon-line"></div>
              <p class="date">' . $quiz->dueDate . '</p>
            </div>
            <input type="hidden" name="quizId" value="' . $quiz->quizId . '"></input>
          </form>';
  }
  ?>
</div>
<script src="./quiz/quiz.js"></script>
<script>
  window.onload = function() {
    history.replaceState("", "", "./?page=quiz");
  }
</script>