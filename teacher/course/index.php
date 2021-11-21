<?php
function random_course_id()
{
  $chars = "C-";
  $numbers = "0123456789";
  $courseId =  $chars . substr(str_shuffle($numbers), 0, 10);
  return $courseId;
}

// Get course collection:
$courseCollection = $mydb->course;

// Handle submit add course:
if (isset($_POST['btnAddCourse'])) {
  $courseName = $_POST['ipCourseName'];
  if (!$courseName)
    echo "Course's name must not be empty";

  // Create new course id by random function:
  $newCourseId = random_course_id();

  // Add new course to Course collection: 
  $addResult = $courseCollection->insertOne([
    'courseId' => $newCourseId,
    'name' => $courseName,
    'year' => date("Y"),
  ]);

  // Get teacher collection:
  $teacherCollection = $mydb->teacher;

  // Get updates courseIds for teacher:
  $teacher = $teacherCollection->findOne(['teacherId' => $_SESSION["teacherId"]]);
  $teacherCourseIds = iterator_to_array($teacher->courseIds);
  array_push($teacherCourseIds, $newCourseId);

  // Update to teacher collection:
  $updateResult = $teacherCollection->updateOne(
    ['teacherId' => $teacher->teacherId],
    ['$set' => ['courseIds' => $teacherCourseIds]]
  );
}

// Handle edit courseName
if (isset($_POST['btnEditCourseName'])) {
  // Update courseName:
  $updateResult = $courseCollection->updateOne(
    ['courseId' => $_POST['courseId']],
    ['$set' => ['name' => $_POST['ipEditCourseName']]]
  );
}

// Handle delete course
if (isset($_POST['btnDeleteCourse'])) {
  $targetCourseId = $_POST['courseId'];

  // Get all needed collection:
  $quizCollection = $mydb->quiz;
  $markCollection = $mydb->mark;
  $questionCollection = $mydb->question;
  $teacherCollection = $mydb->teacher;

  // Get all quiz that course has:
  $quizzes = $quizCollection->find(['courseId' => $targetCourseId]);

  // Delete all marks and questions:
  foreach ($quizzes as $quiz) {
    $markCollection->deleteMany([
      'quizId' => $quiz->quizId
    ]);
    $questionCollection->deleteMany([
      'quizId' => $quiz->quizId
    ]);
  }

  // Delete all quizzes and courseId:
  $quizCollection->deleteMany(['courseId' => $targetCourseId]);
  $courseCollection->deleteOne(['courseId' => $targetCourseId]);

  // Update courseIds for teacher:
  $teacher = $teacherCollection->findOne(['teacherId' => $_SESSION["teacherId"]]);
  $teacherCourseIds = iterator_to_array($teacher->courseIds);
  $targetCoursePosition = array_search($targetCourseId, $teacherCourseIds);
  array_splice($teacherCourseIds, $targetCoursePosition, 1);
  $teacherCollection->updateOne(
    ['teacherId' => $teacher->teacherId],
    ['$set' => ['courseIds' => $teacherCourseIds]]
  );
}
?>

<!-- Icon -->
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

<form class="form-course" method="POST">
  <div class="form-header">
    <div class="form-title">Add a course</div>
    <p class="wrong"></p>
  </div>
  <input type="text" name="ipCourseName" class="input" placeholder="Course Name" />
  <input type="hidden" name="courseId">
  <div class="form-button">
    <div class="cancel">Cancel</div>
    <button type="submit" class="submit" name="btnAddCourse">Submit</button>
  </div>
</form>

<h1><?php echo $title; ?></h1>

<div class="form-wrapper">
  <form class="form-edit" method="POST">
    <div class="form-header">
      <div class="form-title">Edit name</div>
      <p class="wrong"></p>
    </div>
    <input type="text" name="ipEditCourseName" class="input" placeholder="Course Name" />
    <input type="hidden" name="courseId">
    <div class="form-button">
      <div class="cancel">Cancel</div>
      <button type="submit" class="submit" name="btnEditCourseName">Submit</button>
    </div>
  </form>
</div>

<div class="form-wrapper">
  <form class="form-delete" method="POST">
    <p style="text-align: center">Do you want to delete this course ?</p>
    <div class="form-button">
      <div class="cancel">Cancel</div>
      <button type="submit" class="submit" name="btnDeleteCourse">Submit</button>
      <input type="hidden" name="courseId">
    </div>
  </form>
</div>

<div class="content-container">
  <?php
  // Get teacher and course collections
  $teacherCollection = $mydb->teacher;
  $courseCollection = $mydb->course;

  // Get courseIds created by teacher
  $teacher = $teacherCollection->findOne(['teacherId' => $_SESSION["teacherId"]]);
  // echo $_SESSION["teacherId"];

  // if ($teacher->courseIds) {
  $courseIds = $teacher->courseIds;
  // Loop to get courses created by teacher
  $teacherCourses = array();
  foreach ($courseIds as $courseId) {
    $course = $courseCollection->findOne(['courseId' => $courseId]);
    array_push($teacherCourses, $course);
  }

  // Render courses to card
  foreach ($teacherCourses as $teacherCourse) {
    echo "
      <form class='card' method='POST' action='./?page=quiz&courseName=" . $teacherCourse->name . "'>
        <div class='card-image'>
          <img src='../assets/course.png' alt=''>
        </div>
        <div class='card-content'>
          <p class='course-name'>" . $teacherCourse->name . "</p>
          <div class='content-bottom'>
            <button type='submit' name='btnCourseId'>View</button>
            <div class='drop-down'>
              <i class='fas fa-ellipsis-v'></i>
              <div class='drop-down-list'>
                <p class='edit'>Edit name</p>
                <p class='delete'>Delete course</p>
              </div>
              <input type='hidden' name='courseId' value='" . $teacherCourse->courseId . "' >
            </div>
          </div>
        </div>
      </form> 
    ";
  }
  // }
  ?>
</div>
<script src="./course/course.js"></script>
<script>
  window.onload = function() {
    history.replaceState("", "", "./");
  }
</script>