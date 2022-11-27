<?php require '../includes/dbconfig.php'?>
<?php require '../includes/header.php'?>
<?php require_once 'resultSectionLeftNav.php'?>

<?php

//kamal code
function calculate_point($mark){
    if(empty($mark)) return 0;

    $mark = $mark/2.0;
    if($mark > 79.49) return 5.00;
    else if($mark > 69.49) return 4.00;
    else if($mark > 59.49) return 3.50;
    else if($mark > 49.49) return 3.00;
    else if($mark > 39.49) return 2.00;
    else if($mark > 32.49) return 1.00;
    else return 0.00;
}

function get_marks($single_fetch){  //row theke marks nibe

    $student_id = $single_fetch['student_id'];


    $bangla_first = $single_fetch['bangla_first'];
    $bangla_second = $single_fetch['bangla_second'];
    $bangla_point = calculate_point($bangla_first + $bangla_second);

    $english_first = $single_fetch['english_first'];
    $english_second = $single_fetch['english_second'];
    $english_point = calculate_point($english_first + $english_second);

    $ict = $single_fetch['ict'];
    if(!empty($ict)) $ict = $ict * 2; // point calculate korar somoy 2 diye divide korechi
    $ict_point = calculate_point($ict);


    $group_compulsory_one_first = $single_fetch['group_compulsory_one_first'];
    $group_compulsory_one_second = $single_fetch['group_compulsory_one_second'];
    $group_compulsory_one_point = calculate_point($group_compulsory_one_first + $group_compulsory_one_second);

    $group_compulsory_two_first = $single_fetch['group_compulsory_two_first'];
    $group_compulsory_two_second = $single_fetch['group_compulsory_two_second'];
    $group_compulsory_two_point = calculate_point($group_compulsory_two_first + $group_compulsory_two_second);

    $group_compulsory_three_first = $single_fetch['group_compulsory_three_first'];
    $group_compulsory_three_second = $single_fetch['group_compulsory_three_second'];
    $group_compulsory_three_point = calculate_point($group_compulsory_three_first + $group_compulsory_three_second);


    $optional_first = $single_fetch['optional_first'];
    $optional_second = $single_fetch['optional_second'];
    $optional_point = calculate_point($optional_first + $optional_second);
    if($optional_point > 1.0) $optional_point = $optional_point - 2.0;

    $total_point = $bangla_point + $english_point + $ict_point + $group_compulsory_one_point + $group_compulsory_two_point
                    + $group_compulsory_three_point + $optional_point;
    
    $is_failed_in_any_subject = 0;

    if($bangla_point < 1.0 || $english_point < 1.0 || $ict_point < 1.0 || $group_compulsory_one_point < 1.0 ||
        $group_compulsory_two_point < 1.0 || $group_compulsory_three_point < 1.0) $is_failed_in_any_subject = 1;
    
    if($is_failed_in_any_subject == 1) $total_point = 0;
    
    return min(ROUND($total_point/6.0, 2), 5.00);
}
//kamal codes ends
?>


<div class="col-md-9 bg-light">

<h1 class="d-flex justify-content-center">Result Calculation Part As per exam</h1>

    <form action="" method="POST">

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


          
<?php

//function defination
function updateGpaToDB($singleFetch, $connection){
    $studentId = $singleFetch['student_id'];
    $examId = $singleFetch['exam_id'];

    $gpa = get_marks($singleFetch);

    $queryString = "UPDATE `college_management1`.`full_exam_marks` SET `gpa` = $gpa WHERE (`student_id` = $studentId) and (`exam_id` = $examId);";
        $query = mysqli_query($connection, $queryString);
        if($query) {
            echo "Student id ".$studentId ." calculated gpa : ". $gpa;
            echo '<br>';
            }
        
        else {
            echo "Gpa can't be updated";
        }
}
// AND s.group = $group

// <!-- post method start -->
if(isset($_POST['submit'])){
    // $group = $_POST['group'];
    $batch = $_POST['batch'];
    $examtype = $_POST['examtype'];

  $queryString = "SELECT student_id, name FROM college_management1.students s 
  JOIN college_management1.exams e WHERE e.exam_id = $examtype AND s.batch = $batch;";
//   echo $queryString;
  
  $executeQuery = mysqli_query($connection, $queryString);
  
  if($executeQuery) {
    //   echo 'Your query is successfull';
    //   echo "<script>alert('Calculation Successful')</script>";
      
    //   echo '<br>';
      }
  
  else {
      echo 'Your query is wrong';
  }
  $multiFetch = mysqli_fetch_all($executeQuery, MYSQLI_ASSOC);
  $total = 0;
  foreach($multiFetch as $singlePerson) {
    // echo $singlePerson['student_id'];
    $singleStudent = $singlePerson['student_id'];
    echo '<br>';

    //single student result calculation start
        $singleQuery = "SELECT * FROM college_management1.full_exam_marks
        WHERE student_id = $singleStudent AND exam_id = $examtype;";
        $executeSingleQuery = mysqli_query($connection, $singleQuery);
        if($executeSingleQuery) {

            $singleFetch = mysqli_fetch_assoc($executeSingleQuery);

            if(!empty($singleFetch)){
                $total++;
                echo  $total .'. ';
                updateGpaToDB($singleFetch, $connection);    
            }else{
                echo "<h1> $singleStudent has not given the exam</h2>";
            }

        }else {
            echo 'Your  Single searching Student from full_exam_marks table is wrong';
        }       
  }

  echo "<h3>Total Result Calculation of $total students</h3>";
  echo "<script>alert('Calculation Successful')</script>";
}
?>
       
          
    </div>

<?php require_once '../includes/footer.php'?>