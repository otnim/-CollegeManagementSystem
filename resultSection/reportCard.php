<?php require '../includes/dbconfig.php'?>
<?php require '../includes/header.php'?>
<?php require_once 'resultSectionLeftNav.php'?>

<?php

  if(isset($_POST['submit']))
  {
    session_start();
    
    $_SESSION['student_id'] = $_POST['id'];
    $_SESSION['exam_id'] = $_POST['examtype'];
    //echo $student_id;
    //$ID = $_SESSION['student_id'];
    //echo $ID;
    header("location:marksheet_page.php");

  }
?>

<div class="col-md-8 bg-light">
    <h2 class="d-flex justify-content-center">Report Card</h2>


    <form action="" method="POST">

    <div class="form-group">
        <label for="">Student ID</label>
        <input type="number" min="0" placeholder="Provide a valid ID" name="id" class="form-control">
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

</div>

<?php require_once '../includes/footer.php'?>