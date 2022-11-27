<?php require '../includes/dbconfig.php'?>
<?php require '../includes/header.php'?>
<?php require_once 'resultSectionLeftNav.php'?>

<?php 
    function get_grade($obtained_marks){
        if($obtained_marks >= 80.00) return "A+";
        else if($obtained_marks >= 70.00) return "A";
        else if($obtained_marks >= 60.00) return "A-";
        else if($obtained_marks >= 50.00) return "B";
        else if($obtained_marks >= 40.00) return "C";
        else if($obtained_marks >= 33.00) return "D";
        else return "F";
    }
?>

<?php

    $SubjectList = [];
    $studentId = $_SESSION['student_id'];

    if(!empty($studentId)){
      $GLOBALS['studentId'] = $studentId;
      $queryString = "SELECT * FROM college_management1.student_subjects stbs
      WHERE stbs.student_id = $studentId;";
      
      $executeQuery = mysqli_query($connection, $queryString);
      
      if($executeQuery) {
        $singleFetch = mysqli_fetch_assoc($executeQuery);

        if(!empty($singleFetch)){
          $subjectSearchQuery = "SELECT * FROM college_management1.subjects;";
          $executeSubjectSearchQuery = mysqli_query($connection, $subjectSearchQuery);

          $SubjectList = mysqli_fetch_all($executeSubjectSearchQuery, MYSQLI_ASSOC);

          //For finding student information
          $studentInformationQuery = "SELECT s.student_id, s.name, s.group, g.group_name
          FROM college_management1.students s
          JOIN college_management1.groups g ON (s.group = g.group)
          WHERE s.student_id = $studentId";
            $executeStudentInformationQuery = mysqli_query($connection, $studentInformationQuery);
            $studentInformation = mysqli_fetch_assoc($executeStudentInformationQuery);
          //  print_r($studentInformation);
          //  print_r($SubjectList);
        }
        else{
            echo "<h2 class='text-danger'>$studentId Student ID does not exist</h2>";
        }
      }
  }
?>


<!-- for marks access -->
<?php
    $studentId = $_SESSION['student_id'];
    $exam_id = $_SESSION['exam_id'];
    if(!empty($studentId)){
      $GLOBALS['studentId'] = $studentId;
      $select_marks_row = "SELECT * FROM college_management1.full_exam_marks where student_id = $studentId and exam_id = $exam_id;";
      
      $execute_marks_row = mysqli_query($connection, $select_marks_row);

      $fetch_marks_row = mysqli_fetch_assoc($execute_marks_row);
      $bangla_first = $fetch_marks_row['bangla_first'];
      $bangla_second = $fetch_marks_row['bangla_second'];
      $bangla_grade = get_grade(($bangla_first + $bangla_second)/2);

      $english_first = $fetch_marks_row['english_first'];
      $english_second = $fetch_marks_row['english_second'];
      $english_grade = get_grade(($english_first + $english_second)/2);

      $ict = $fetch_marks_row['ict'];
      //if(!empty($ict)) $ict = $ict * 2; // grade calculate korar somoy 2 diye divide korechi
      $ict_grade = get_grade($ict);


      $group_compulsory_one_first = $fetch_marks_row['group_compulsory_one_first'];
      $group_compulsory_one_second = $fetch_marks_row['group_compulsory_one_second'];
      $group_compulsory_one_grade = get_grade(($group_compulsory_one_first + $group_compulsory_one_second)/2);

      $group_compulsory_two_first = $fetch_marks_row['group_compulsory_two_first'];
      $group_compulsory_two_second = $fetch_marks_row['group_compulsory_two_second'];
      $group_compulsory_two_grade = get_grade(($group_compulsory_two_first + $group_compulsory_two_second)/2);

      $group_compulsory_three_first = $fetch_marks_row['group_compulsory_three_first'];
      $group_compulsory_three_second = $fetch_marks_row['group_compulsory_three_second'];
      $group_compulsory_three_grade = get_grade(($group_compulsory_three_first + $group_compulsory_three_second)/2);


      $optional_first = $fetch_marks_row['optional_first'];
      $optional_second = $fetch_marks_row['optional_second'];
      $optional_grade = get_grade(($optional_first + $optional_second)/2);
    
      $gpa = $fetch_marks_row['gpa'];
      
    }
?>

<!-- end of marks access code -->


    <div class="col-md-9 bg-light">
        <h2 class="d-flex justify-content-center">Report Card</h2>


    <?php /*

    if(!isset($_POST['submit'])){ ?>
        <h2>
        <?php echo 'Student Present Subject'; ?>
        </h2>
    <?php
    }
    */
    ?>


    <?php
    if(!empty($studentId)){
    echo  "<h5 class='text'>Student ID:  $studentId </h5>";
    }

    if(!empty($studentInformation)){
        // print_r($studentInformation);
        $studentName = $studentInformation['name'];
        $groupName = $studentInformation['group_name'];
        echo  "<h5 class=''>Name:  $studentName</h5>";
        echo  "<h5 class=''>Group:  $groupName</5>";
        echo "<br>";
    }

    ?>
    

    <h5>GPA: 
        <?php
            if(isset($gpa)) echo $gpa;
            echo "<br>";
            echo "<br>";
        ?>
    <h5>
    
    </form>
    <table class="table table-hover table-sm">
        <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Subject Name</th>
            <th scope="col">Subject Code</th>
            <th scope="col">Subject Type</th>
            <th scope="col">Marks</th>
            <th scope="col">GPA</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row">1</th>
            <td>Bangla 1st Paper</td>
            <td>101</td>
            <td>Compulsory</td>
            <td> <?php if(isset($bangla_first)) echo $bangla_first; ?> </td>
            <td> <?php if(isset($bangla_grade)) echo $bangla_grade; ?> </td>
        </tr>
        <tr>
            <th scope="row">2</th>
            <td>Bangla 2nd Paper</td>
            <td>102</td>
            <td>Compulsory</td>
            <td> <?php if(isset($bangla_second)) echo $bangla_second; ?> </td>
        </tr>
        <tr>
            <th scope="row">3</th>
            <td>English 1st Paper</td>
            <td>107</td>
            <td>Compulsory</td>
            <td> <?php if(isset($english_first)) echo $english_first; ?> </td>
            <td> <?php if(isset($english_grade)) echo $english_grade; ?> </td>
        </tr>
        <tr>
            <th scope="row">4</th>
            <td>English 2nd Paper</td>
            <td>108</td>
            <td>Compulsory</td>
            <td> <?php if(isset($english_second)) echo $english_second; ?> </td>
        </tr>

        <tr>
            <th scope="row">5</th>
            <td>Information and Communication Technology</td>
            <td>275</td>
            <td>Compulsory</td>
            <td> <?php if(isset($ict)) echo $ict; ?> </td>
            <td> <?php if(isset($ict_grade)) echo $ict_grade; ?> </td>

        </tr>

        <tr>
            <th scope="row">6</th>
            <?php
            foreach($SubjectList as $subject) {
                if($singleFetch['group_compulsory_one_first'] == $subject['subject_id']){
                $subjectId = $subject['subject_id'];
                $subjectName = $subject['subject_name'];
                echo "<td>$subjectName</td>";
                echo "<td>$subjectId</td>";
                break;
                }
            }
            ?>
            
            <td>Group Compulsory</td>
            <td> <?php if(isset($group_compulsory_one_first)) echo $group_compulsory_one_first; ?> </td>
            <td> <?php if(isset($group_compulsory_one_grade)) echo $group_compulsory_one_grade; ?> </td>
        </tr>

        <tr>
            <th scope="row">7</th>
            <?php
            foreach($SubjectList as $subject) {
                if($singleFetch['group_compulsory_one_second'] == $subject['subject_id']){
                $subjectId = $subject['subject_id'];
                $subjectName = $subject['subject_name'];
                echo "<td>$subjectName</td>";
                echo "<td>$subjectId</td>";
                break;
                }
            }
            ?>
            <td>Group Compulsory</td>
            <td> <?php if(isset($group_compulsory_one_second)) echo $group_compulsory_one_second; ?> </td>
        </tr>

        <tr>
            <th scope="row">8</th>
            <?php
            foreach($SubjectList as $subject) {
                if($singleFetch['group_compulsory_two_first'] == $subject['subject_id']){
                $subjectId = $subject['subject_id'];
                $subjectName = $subject['subject_name'];
                echo "<td>$subjectName</td>";
                echo "<td>$subjectId</td>";
                break;
                }
            }
            ?>
            <td>Group Compulsory</td>
            <td> <?php if(isset($group_compulsory_two_first)) echo $group_compulsory_two_first; ?> </td>
            <td> <?php if(isset($group_compulsory_two_grade)) echo $group_compulsory_two_grade; ?> </td>

        </tr>

        <tr>
            <th scope="row">9</th>
            <?php
            foreach($SubjectList as $subject) {
                if($singleFetch['group_compulsory_two_second'] == $subject['subject_id']){
                $subjectId = $subject['subject_id'];
                $subjectName = $subject['subject_name'];
                echo "<td>$subjectName</td>";
                echo "<td>$subjectId</td>";
                break;
                }
            }
            ?>
            <td>Group Compulsory</td>
            <td> <?php if(isset($group_compulsory_two_second)) echo $group_compulsory_two_second; ?> </td>
        </tr>

        <tr>
            <th scope="row">10</th>
            <?php
            foreach($SubjectList as $subject) {
                if($singleFetch['group_compulsory_three_first'] == $subject['subject_id']){
                $subjectId = $subject['subject_id'];
                $subjectName = $subject['subject_name'];
                echo "<td>$subjectName</td>";
                echo "<td>$subjectId</td>";
                break;
                }
            }
            ?>
            <td>Group Compulsory</td>
            <td> <?php if(isset($group_compulsory_three_first)) echo $group_compulsory_three_first; ?> </td>
            <td> <?php if(isset($group_compulsory_three_grade)) echo $group_compulsory_three_grade; ?> </td>

        </tr>

        <tr>
            <th scope="row">11</th>
            <?php
            foreach($SubjectList as $subject) {
                if($singleFetch['group_compulsory_three_second'] == $subject['subject_id']){
                $subjectId = $subject['subject_id'];
                $subjectName = $subject['subject_name'];
                echo "<td>$subjectName</td>";
                echo "<td>$subjectId</td>";
                break;
                }
            }
            ?>
            <td>Group Compulsory</td>
            <td> <?php if(isset($group_compulsory_three_second)) echo $group_compulsory_three_second; ?> </td>
        </tr>

        <tr>
            <th scope="row">12</th>
            <?php
            foreach($SubjectList as $subject) {
                if($singleFetch['optional_first'] == $subject['subject_id']){
                $subjectId = $subject['subject_id'];
                $subjectName = $subject['subject_name'];
                echo "<td>$subjectName</td>";
                echo "<td>$subjectId</td>";
                break;
                }
            }
            ?>
            <td>Group Optional</td>
            <td> <?php if(isset($optional_first)) echo $optional_first; ?> </td>
            <td> <?php if(isset($optional_grade)) echo $optional_grade; ?> </td>

        </tr>

        <tr>
            <th scope="row">13</th>
            <?php
            foreach($SubjectList as $subject) {
                if($singleFetch['optional_second'] == $subject['subject_id']){
                $subjectId = $subject['subject_id'];
                $subjectName = $subject['subject_name'];
                echo "<td>$subjectName</td>";
                echo "<td>$subjectId</td>";
                break;
                }
            }
            ?>
            <td>Group Optional</td>
            <td> <?php if(isset($optional_second)) echo $optional_second; ?> </td>
        </tr>
        </tbody>
    </table>

    <!-- <h2>Student GPA: 
        <?php
            if(isset($gpa)) echo $gpa;
        ?>
    <h2> -->

    </div>
</div>

<?php require_once '../includes/footer.php'?>


