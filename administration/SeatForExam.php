<?php require_once '../includes/dbconfig.php'?>
<?php require_once '../includes/header.php'?>
<?php require_once 'administrationLeftNav.php'?>
<?php

// <!-- post method start -->
if(isset($_POST['submit'])){
    $batch = $_POST['batch'];
    $examtype = $_POST['examtype'];

  $queryString = "SELECT student_id, name FROM college_management1.students s
  WHERE s.batch = $batch;";
  
  $executeQuery = mysqli_query($connection, $queryString);

  $multiFetch = mysqli_fetch_all($executeQuery, MYSQLI_ASSOC);
  //if $examtype < 2 then half exam table will be executed
   
  if($examtype > 0){
    foreach($multiFetch as $singlePerson) {
        // echo $singlePerson['student_id'];
        $singleStudent = $singlePerson['student_id'];
        $queryString = "INSERT INTO `college_management1`.`full_exam_marks` (`student_id`, `exam_id`)
            VALUES ($singleStudent, $examtype);";
            $query = mysqli_query($connection, $queryString);
            
            if($query) {
                $successMessage = "<h3 class='text-success'>The batch has registered the respective exam successfully</h3>";
            }

            else {
                $error = "<h3 class='text-danger'>The batch has already registered the respective exam</h3>";
            }
    
      }
  }
  
  
}
?>

    <div class="col-md-9 bg-light">

        <h1 class="d-flex justify-content-center">Set Specific Exam for Specific Batch</h1>
        <?php
        if(!empty($successMessage)){
            echo $successMessage;
        }
        if(!empty($error)){
            echo $error;
        }
        ?>
        <p>By setting this exam to specific batch students will be able to seat in the exam. More clearly their id will be available for storing subject number and calculate for respective Examination. It's is likely to register for seating a specific exam </p>

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
            <label for="">Select Exam Type :</label>
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
                <input type="submit" name="submit" value="Submit" class="btn btn-success btn-block btn-lg">
            </div>

      </form>
    </div>

<?php require_once '../includes/footer.php'?>