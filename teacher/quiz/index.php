<?php

// Create new course object:
$course = new Course($_SESSION['courseId'], $_SESSION['teacherId']);

if (isset($_POST['btnAddQuiz'])) {
  // Insert new quiz:
  $insertQuizResult = $course->addQuiz($_POST['quizName'], $_POST['startDate'], $_POST['dueDate']);

  // Take quizId of new quiz:
  $newQuizId = $insertQuizResult[1];

  // Insert questions to new quiz:
  $newQuiz = new Quiz($_SESSION['courseId'], $newQuizId);
  $numbersOfQuestion = (int) $_POST['countQuestions'];
  for ($i = 0; $i < $numbersOfQuestion; $i++) {
    $newQuiz->addQuestion(
      htmlspecialchars($_POST['description-' . $i + 1]),
      htmlspecialchars($_POST['option1-' . $i + 1]),
      htmlspecialchars($_POST['option2-' . $i + 1]),
      htmlspecialchars($_POST['option3-' . $i + 1]),
      htmlspecialchars($_POST['option4-' . $i + 1]),
      $_POST['lvlOption-' . $i + 1]
    );
  }
}

if (isset($_POST['btnEditQuiz'])) {
  $course->editQuiz($_POST['quizId'], $_POST['editQuizName'], $_POST['editStartDate'], $_POST['editDueDate']);
}

if (isset($_POST['btnDeleteQuiz'])) {
  $course->deleteQuiz($_POST['quizId']);
}

?>

<!-- Icon -->
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

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
  <div class="question-wrapper">
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

<!-- Edit form -->
<div class="form-wrapper">
  <form class="form-edit" method="POST">
    <div class="form-top">
      <div class="form-name">
        <p class="title">Quiz name</p>
        <input type="text" name="editQuizName" placeholder="Quiz name" required>
      </div>
      <div>
        <div class="date-flex">
          <div class="date">
            <p>Start Date </p>
            <input type="date" name="editStartDate" class="select-date" placeholder="Select Date" required>
          </div>
          <div class="date">
            <p>Due Date </p>
            <input type="date" name="editDueDate" class="select-date" placeholder="Select Date" required>
          </div>
        </div>
        <span class="wrong"></span>
      </div>
    </div>
    <input type="hidden" name="quizId">
    <div class="form-button">
      <div class="cancel">Cancel</div>
      <button type="submit" class="submit" name="btnEditQuiz">Submit</button>
    </div>
  </form>
</div>

<div class="form-wrapper">
  <form class="form-delete" method="POST">
    <p style="text-align: center">Do you want to delete this quiz ?</p>
    <div class="form-button">
      <div class="cancel">Cancel</div>
      <button type="submit" class="submit" name="btnDeleteQuiz">Submit</button>
      <input type="hidden" name="quizId">
    </div>
  </form>
</div>

<h1><?php echo $title; ?></h1>

<div class="content-container">
  <?php
  // Create new course object:
  $course = new Course($_SESSION["courseId"], $_SESSION["teacherId"]);

  // Get quizzes based on courseID and teacherID
  $quizzes = $course->getAllQuizzesBelongsTo();

  foreach ($quizzes as $quiz) {
    echo '<div class="card">
            <div class="card-top">
                <p class="quiz-name">' . $quiz->name . '</p>
                <div style="display: flex; column-gap: 5px;">
                  <a href="./?page=question&quizId=' . $quiz->quizId . '&quizName=' . $quiz->name . '"><button>VIEW</button></a>
                  <div class="drop-down">
                    <i class="fas fa-ellipsis-v"></i>
                    <div class="drop-down-list">
                      <p class="edit">Edit quiz</p>
                      <p class="delete">Delete quiz</p>
                    </div>
                  </div>
                </div>
            </div>
            <div class="card-bot">
              <p class="date">' . $quiz->startDate . '</p>
              <div class="horizon-line"></div>
              <p class="date">' . $quiz->dueDate . '</p>
            </div>
            <input type="hidden" name="quizId" value="' . $quiz->quizId . '"></input>
          </div>';
  }
  ?>
</div>
<script src="./quiz/quiz.js"></script>
<script>
  window.onload = function() {
    history.replaceState("", "", "./?page=quiz");
  }
</script>