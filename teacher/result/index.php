<div class="limiter">
  <div class="container-table100">
    <div class="wrap-table100">
      <div class="table100 ver1 m-b-110">
        <div class="table100-head">
          <table>
            <thead>
              <tr class="row100 head">
                <th class="cell100 column1">No.</th>
                <th class="cell100 column2">Name</th>
                <th class="cell100 column3">Score</th>
              </tr>
            </thead>
          </table>
        </div>

        <div class="table100-body">
          <table id="tableData">
            <tbody>
              <?php
              // Get collections
              $markCollection = $mydb->mark;
              $studentCollection = $mydb->student;

              // Get marks of the quiz:
              $marks = $markCollection->find(['quizId' => $_SESSION["quizId"]]);

              $index = 0;
              foreach ($marks as $mark) {
                $student = $studentCollection->findOne(['studentId' => $mark->studentId]);
                echo "<tr class='row100 body'>
                        <td class='cell100 column1'>" . ++$index . "</td>
                        <td class='cell100 column2'>" . $student->name . "</td>
                        <td class='cell100 column3'>" . $mark->score . "</td>
                      </tr>";
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<script type="text/javascript" src="./result/result.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#tableData').paging({
      limit: 10
    });
  });
</script>