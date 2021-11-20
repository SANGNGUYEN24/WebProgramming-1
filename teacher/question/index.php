<?php
// Get question collections
$questionCollection = $mydb->question;

if (isset($_POST['btnAddQuestion'])) {
  $insertQuestion = $questionCollection->insertOne([
    'questionNumber' => '1',  // CLONE
    'quizId' => $_SESSION['quizId'],
    'courseId' => $_SESSION['courseId'],
    'description' => htmlspecialchars($_POST['add-description']),
    'option1' => htmlspecialchars($_POST['add-option1']),
    'option2' => htmlspecialchars($_POST['add-option2']),
    'option3' => htmlspecialchars($_POST['add-option3']),
    'option4' => htmlspecialchars($_POST['add-option4']),
    'level' => $_POST['add-lvlOption'],
    'unitScore' => (int) $_POST['add-lvlOption'] * 10
  ]);
}

if (isset($_POST['BtnDeleteQuestion'])) {
  $deleteQuestion = $questionCollection->deleteOne([
    '_id' => new MongoDB\BSON\ObjectId($_POST['questionId'])
  ]);
}

if (isset($_POST['BtnEditQuestion'])) {
  $updateQuestion = $questionCollection->updateOne(
    [
      '_id' => new MongoDB\BSON\ObjectId($_POST['questionId'])
    ],
    [
      '$set' => [
        'description' => htmlspecialchars($_POST['edit-description']),
        'option1' => htmlspecialchars($_POST['edit-option1']),
        'option2' => htmlspecialchars($_POST['edit-option2']),
        'option3' => htmlspecialchars($_POST['edit-option3']),
        'option4' => htmlspecialchars($_POST['edit-option4']),
        'level' => $_POST['edit-lvlOption'],
        'unitScore' => (int) $_POST['edit-lvlOption'] * 10,
      ]
    ]
  );
}
?>

<!-- Form Add -->
<form class="form-question" action="./?page=question" method="POST" id="form-question">
  <div class="form-header">
    <div class="form-question-desc">
      <p>Question:<span class="wrong"></span></p>
      <textarea name="add-description" rows="2" placeholder="Question Description"></textarea>
    </div>
    <div class="form-level">
      <div class="form-select">
        <select name="add-lvlOption">
          <option value="1">Easy</option>
          <option value="2">Medium</option>
          <option value="3">Hard</option>
        </select>
      </div>
    </div>
  </div>
  <div class="form-body">
    <div class="form-option">
      <p>Option A<span style="color: red">*</span><span class="wrong"></span></p>
      <textarea name="add-option1" rows="2" placeholder="Option A (correct answer)"></textarea>
    </div>
    <div class="form-option">
      <p>Option B <span class="wrong"></span></p>
      <textarea name="add-option2" rows="2" placeholder="Option B"></textarea>
    </div>
    <div class="form-option">
      <p>Option C <span class="wrong"></span></p>
      <textarea name="add-option3" rows="2" placeholder="Option C"></textarea>
    </div>
    <div class="form-option">
      <p>Option D <span class="wrong"></span></p>
      <textarea name="add-option4" rows="2" placeholder="Option D"></textarea>
    </div>
  </div>
  <div class="form-button">
    <div class="cancel">Cancel</div>
    <button class="submit" type="submit" name="btnAddQuestion">Submit</button>
  </div>
</form>

<!-- Form Edit -->
<div class="form-wrapper">
  <form class="form-edit" action="./?page=question" method="POST" id="form-edit">
    <div class="form-header">
      <div class="form-question-desc">
        <p>Question:<span class="wrong"></span></p>
        <textarea name="edit-description" rows="2" placeholder="Question Description"></textarea>
      </div>
      <div class="form-level">
        <div class="form-select">
          <select name="edit-lvlOption">
            <option value="1">Easy</option>
            <option value="2">Medium</option>
            <option value="3">Hard</option>
          </select>
        </div>
      </div>
    </div>
    <div class="form-body">
      <div class="form-option">
        <p>Option A<span style="color: red">*</span><span class="wrong"></span></p>
        <textarea name="edit-option1" rows="2" placeholder="Option A (correct answer)"></textarea>
      </div>
      <div class="form-option">
        <p>Option B <span class="wrong"></span></p>
        <textarea name="edit-option2" rows="2" placeholder="Option B"></textarea>
      </div>
      <div class="form-option">
        <p>Option C <span class="wrong"></span></p>
        <textarea name="edit-option3" rows="2" placeholder="Option C"></textarea>
      </div>
      <div class="form-option">
        <p>Option D <span class="wrong"></span></p>
        <textarea name="edit-option4" rows="2" placeholder="Option D"></textarea>
      </div>
      <!-- ==================================================== -->
      <input type="hidden" name="questionId">
    </div>
    <div class="form-button">
      <button type="submit" class="delete" name="BtnDeleteQuestion">Delete</button>
      <div class="cancel">Cancel</div>
      <button type="submit" class="submit" name="BtnEditQuestion">Submit</button>
    </div>
  </form>
</div>

<div class="function-button">
  <a href="./?page=result">
    <button class="view">View results</button>
  </a>
<<<<<<< HEAD
  <!-- <button class="download">Download </button> -->
  <!-- <button class="download"><a href ="./question/pdf.php">Download PDF</a></button> -->
  <?php echo "<button class=\"download\" onClick=\"window.print();\">Download PDF</button>";?>
=======
  <a href="./print">
    <button class="download">Download PDF</button>
  </a>
>>>>>>> 489f02f876d4b9e7260e4073fa4166e4decc6754
</div>

<?php
// Get question collections
$questionCollection = $mydb->question;

// Get question based on quizID and courseID
$questions = $questionCollection->find(['quizId' => $_SESSION["quizId"], 'courseId' => $_SESSION["courseId"]]);

$numberOfQuestion = 0;
foreach ($questions as $question) {
  $numberOfQuestion++;
  echo '<div class="card">
        <div class="card-top">
          <p><span>Question ' . $numberOfQuestion . ': </span>' . $question->description . '</p>
          <i class="fa fa-edit">
            <input type="hidden" value="' . $question->description . '" />
            <input type="hidden" value="' . $question->option1 . '">
            <input type="hidden" value="' . $question->option2 . '">
            <input type="hidden" value="' . $question->option3 . '">
            <input type="hidden" value="' . $question->option4 . '">
            <!-- This is the level -->
            <input type="hidden" value="2" >
            
            <!-- This is the QuestionId -->
            <input type="hidden" name="questionId" value="' . $question->_id . '"> 
          </i>
        </div>
        <div class="answer">
          <p class="correct">A: <span>' . $question->option1 . '</span></p>
          <p>B: <span>' . $question->option2 . '</span></p>
          <p>C: <span>' . $question->option3 . '</span></p>
          <p>D: <span>' . $question->option4 . '</span></p>
        </div>
      </div>';
       echo '<div class="card">
        <div class="card-top">
          <p><span>Question ' . $question->questionNumber . ': </span>' . $question->description . '</p>
          <i class="fa fa-edit">
            <input type="hidden" value="' . $question->description . '" />
            <input type="hidden" value="' . $question->firstChoice . '">
            <input type="hidden" value="' . $question->secondChoice . '">
            <input type="hidden" value="' . $question->thirdChoice . '">
            <input type="hidden" value="' . $question->fourthChoice . '">
            <!-- This is the level -->
            <input type="hidden" value="2" >

            <!-- This is the Quis ID -->
            <input type="hidden" value="' . $question->questionNumber . '">
          </i>
        </div>
        <div class="answer">
          <p class="correct">A: <span>' . $question->firstChoice . '</span></p>
          <p>B: <span>' . $question->secondChoice . '</span></p>
          <p>C: <span>' . $question->thirdChoice . '</span></p>
          <p>D: <span>' . $question->fourthChoice . '</span></p>
        </div>
      </div>';
}
?>

<script src="./question/question.js"></script>
<script>
  window.onload = function() {
    history.replaceState("", "", "./?page=question");
  }
</script>