<?php require '../includes/dbconfig.php'?>
<?php require '../includes/header.php'?>
<?php require_once 'resultSectionLeftNav.php'?>

<?php

// session_start();

if(isset($_POST['submit'])){

    $examId = $_POST['examtype'];
    $subjectCode = $_POST['subjectCode'];

    $_SESSION['examId'] = $examId;
    $_SESSION['subjectId'] = $subjectCode;

    header('Location: resultInsertPage.php');


}

?>




<div class="col-md-9 bg-light">


        <h2 class="d-flex justify-content-center">Select Subject</h2>

      <form action="" method="post">

       <div class="form-group">
            <label for="">Select Subject</label>
            <select name="subjectCode" id="" class="form-control">    
                <option value="bangla_first">Bangla 1st Paper</option>
                <option value="bangla_second">Bangla 2nd Paper</option>
                <option value="english_first">English 1st Paper</option>
                <option value="english_second">English 2nd Paper</option>
                <option value="ict">Information and Communication Technology</option>
                <option value="group_compulsory_one_first">Group compulsory one 1st Paper</option>
                <option value="group_compulsory_one_second">Group compulsory one 2nd Paper</option>
                <option value="group_compulsory_two_first">Group compulsory two 1st Paper</option>
                <option value="group_compulsory_two_second">Group compulsory two 2nd Paper</option>
                <option value="group_compulsory_three_first">Group compulsory three 1st</option>
                <option value="group_compulsory_three_second">Group compulsory three 2nd Paper</option>
                <option value="optional_first">Optional Subject 1st Paper</option>
                <option value="optional_second">Optional Subject 2nd Paper</option>             

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
                <input type="submit" name="submit" value="Submit" class="btn btn-success btn-block btn-lg">
            </div>

      </form>

        
          
    </div>
    
<?php require_once '../includes/footer.php'?>
