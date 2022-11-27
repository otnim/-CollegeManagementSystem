<?php require '../includes/dbconfig.php'?>
<?php require '../includes/header.php'?>
<?php require_once 'resultSectionLeftNav.php'?>


<?php

if(isset($_POST['submit'])){
  $batch = $_POST['batch'];
  $group = $_POST['group'];
  $examId = $_POST['examtype'];

  $queryString = "SELECT fm.student_id, s.name, fm.gpa  FROM college_management1.full_exam_marks fm
  JOIN college_management1.students s 
  on s.student_id = fm.student_id
  WHERE fm.exam_id = $examId AND s.batch = $batch AND s.group = $group
  ORDER BY fm.gpa DESC";

$showQuery = mysqli_query($connection, $queryString);


$showFetch = mysqli_fetch_all($showQuery, MYSQLI_ASSOC);
  

}

?>


    <div class="col-md-9 bg-light">


        <h2 class="d-flex justify-content-center">Result Publishing Section</h2>

      <form action="" method="post">

       <div class="form-group">
            <label for="">Select Batch</label>
            <select name="batch" id="" class="form-control">                
                <?php
                $batchQuery = mysqli_query($connection, "SELECT * FROM college_management1.batches b
                order by b.batch_value DESC");
                $batchResults = mysqli_fetch_all($batchQuery, MYSQLI_ASSOC);
                foreach($batchResults as $batchResult) {
                    $batchId = $batchResult['batch'];
                    $batchName = $batchResult['batch_value'];
                    echo "<option value='$batchId'>$batchName</option>";
                }
                ?>


            </select>
        </div>

        <div class="form-group">
            <label for="">Select Exam Type</label>
            <select name="examtype" id="" class="form-control">
                <?php
                    $examQuery = mysqli_query($connection, "SELECT * FROM college_management1.exams");
                    $examResults = mysqli_fetch_all($examQuery, MYSQLI_ASSOC);
                    foreach($examResults as $examResult) {
                        $examId = $examResult['exam_id'];
                        $examName = $examResult['exam_type'];
                        echo "<option value='$examId'>$examName</option>";
                    }
                ?>
            </select>
        </div>

        <div class="form-group">
                <label for="">Select Group :</label>
                <select name="group" id="" class="form-control">
                    <option value="1">Science</option>
                    <option value="2">Business Studies</option>
                    <option value="3">Humanities</option>
                </select>
            </div>

        <div class="form-group">
                <input type="submit" name="submit" value="Submit" class="btn btn-success btn-block btn-lg">
            </div>

      </form>

        <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">Position</th>
                <th scope="col">Student Id</th>
                <th scope="col">Name</th>
                <th scope="col">GPA</th>
              </tr>
            </thead>
            <tbody>

            <?php
            if(isset($showFetch)){
              $serial = 0;
              foreach($showFetch as $singlePerson){
                $id = $singlePerson['student_id'];
                $name = $singlePerson['name'];
                $gpa = $singlePerson['gpa'];
                $serial++;
  
                echo "<tr>
                  <th>$serial</th>
                  <td>$id</td>
                  <td>$name</td>
                  <td>$gpa</td>
                </tr>";
              }
              if($serial > 0){
                $batchFindQueryExecute =  mysqli_query($connection, "SELECT * FROM college_management1.batches b
              where b.batch = $batch;");
              $batchFetch = mysqli_fetch_assoc($batchFindQueryExecute);
              $batchValue = $batchFetch['batch_value'];

              $groupName;
              if($group == 1){
                $groupName = "Science";
              }
              if($group == 2){
                $groupName = "Business Studies";
              }
              if($group == 3){
                $groupName = "Humanities";
              }
              echo "<h3>Batch : $batchValue, Group : $groupName, Total student : $serial</h3>";
              echo "<br>";
              }
              else{

                echo "<h3 class='text-danger'>No result Found</h3>";
              }
              
            }
            
            
            ?>

            </tbody>
          </table>
          
    </div>


<?php require_once '../includes/footer.php'?>