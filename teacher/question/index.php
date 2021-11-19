<form class="form-question" action="./?page=question" method="POST" id="form-question">
  <div class="form-header">
    <div class="form-question-desc">
      <p>Question:<span class="wrong"></span></p>
      <textarea name="question" rows="2" placeholder="Question Description"  required></textarea>
    </div>
    <div class="form-level">
      <div class="form-select">
        <select>
          <option>Easy</option>
          <option>Medium</option>
          <option>Hard</option>
        </select>
      </div>
    </div>
  </div>
  <div class="form-body">
    <div class="form-option">
      <p>Option A<span style="color: red">*</span><span class="wrong"></span></p>
      <textarea name="A" rows="2" placeholder="Option A (correct answer)" required></textarea>
    </div>
    <div class="form-option">
      <p>Option B <span class="wrong"></span></p>
      <textarea name="B" rows="2" placeholder="Option B" required></textarea>
    </div>
    <div class="form-option">
      <p>Option C <span class="wrong"></span></p>
      <textarea name="C" rows="2" placeholder="Option C" required></textarea>
    </div>
    <div class="form-option">
      <p>Option D <span class="wrong"></span></p>
      <textarea name="D" rows="2" placeholder="Option D" required></textarea>
    </div>
  </div>
  <div class="form-button">
    <div class="cancel">Cancel</div>
    <button class="submit" type="submit">Submit</button>
  </div>
</form>

<div class="form-wrapper">
  <form class="form-edit" action="./?page=question" method="POST" id="form-edit">
    <div class="form-header">
      <div class="form-question-desc">
        <p>Question:<span class="wrong"></span></p>
        <textarea name="question" rows="2" placeholder="Question Description" required></textarea>
      </div>
      <div class="form-level">
        <div class="form-select">
          <select>
            <option value="0">Easy</option>
            <option value="1">Medium</option>
            <option value="2">Hard</option>
          </select>
        </div>
      </div>
    </div>
    <div class="form-body">
      <div class="form-option">
        <p>Option A<span style="color: red">*</span><span class="wrong"></span></p>
        <textarea name="A" rows="2" placeholder="Option A (correct answer)"  required></textarea>
      </div>
      <div class="form-option">
        <p>Option B <span class="wrong"></span></p>
        <textarea name="B" rows="2" placeholder="Option B" required></textarea>
      </div>
      <div class="form-option">
        <p>Option C <span class="wrong"></span></p>
        <textarea name="C" rows="2" placeholder="Option C" required></textarea>
      </div>
      <div class="form-option">
        <p>Option D <span class="wrong"></span></p>
        <textarea name="D" rows="2" placeholder="Option D" required></textarea>
      </div>
      <!-- Input for questionID -->
      <input type="hidden" name="questionID" value="1">
    </div>
    <div class="form-button">
      <button type="submit" class="delete">Delete</button>
      <div class="cancel">Cancel</div>
      <button class="submit" type="submit">Submit</button>
    </div>
  </form>
</div>

<div class="function-button">
  <a href="./?page=result&questionID=questionID">
    <button class="view">View results</button>
  </a>
  <!-- <button class="download">Download </button> -->
  <!-- <button class="download"><a href ="./question/pdf.php">Download PDF</a></button> -->
  <?php echo "<button class=\"download\" onClick=\"window.print();\">Download PDF</button>";?>
</div>

<?php
// Get question collections
$questionCollection = $mydb->question;

// Get question based on quizID and courseID
$questions = $questionCollection->find(['quizID' => $_SESSION["quizID"], 'courseID' => $_SESSION["courseID"]]);

foreach ($questions as $question) {
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