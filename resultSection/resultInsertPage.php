<?php require '../includes/dbconfig.php'?>
<?php require '../includes/header.php'?>
<?php require_once 'resultSectionLeftNav.php'?>


<?php
// session_start();
$examId =  $_SESSION['examId'];
$subjectCode = $_SESSION['subjectId'];


if(isset($_POST['submit'])){

    $studentId = $_POST['studentId'];
    $marks = $_POST['marks'];
    if(!empty($studentId) && !empty($marks)){
        $markInsertQuery = "UPDATE `college_management1`.`full_exam_marks` SET `$subjectCode` = $marks WHERE (`student_id` = $studentId) and (`exam_id` = $examId);
        ";
        $query = mysqli_query($connection, $markInsertQuery);

        if($query) {
            $success = "<h3 class='text-success'>$marks added to student id : '$studentId'</h3>";
        }
        else {
           $error = "<h3 class='text-danger'>Something Wrong</h3>";
        }   
    }
}

if(isset($_POST['reset'])){

    unset ($_SESSION['examId']);
    unset ($_SESSION['subjectId']);  
    header('Location: insertMarkSubjectWise.php');
}
?>


<div class="col-md-9 bg-light">

        <h2 class="d-flex justify-content-center">Insert Student Id and Mark for Respective Subject</h2>
        <br>

        <h4 class='bg-info text-white rounded'>Subject Field: <?php echo $subjectCode. ', Exam Code: '.$examId. '. Put Student Id and Obtained Marks for this Subject' ?></h3>

        <?php
        if(!empty($success)){
            echo $success;
        }
        if(!empty($error)){
            echo $error;
        }
        ?>

        <form action="" method="POST">

            <div class="form-group">
                <label for="">Student ID</label>
                <input type="number" min="0" placeholder="Provide a valid ID" name="studentId" class="form-control">
            </div>

            <div class="form-group">
                <label for="">Gained Marks for Subject</label>
                <input type="number" min="0" placeholder="Insert Marks" name="marks" class="form-control">
            </div>

            <div class="form-group">
                <input type="submit" name="submit" value="Submit" class="btn btn-success btn-block btn-lg">
            </div>

            <div class="form-group">
                <input type="submit" name="reset" value="Reset Subject Code and Exam Id" class="btn btn-danger btn-lg">
            </div>

        </form>

        
          
    </div>

<?php require_once '../includes/footer.php'?>