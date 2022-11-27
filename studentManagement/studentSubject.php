<?php require_once '../includes/dbconfig.php'?>
<?php require_once '../includes/header.php'?>
<?php require_once 'studentManagementLeftNav.php'?>

<?php

$SubjectList = [];
if(isset($_POST['submit'])){
  $studentId = $_POST['id'];
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


        }else{
          echo "<script>alert('{$studentId} Student id does not exits')</script>";
        }

      }
  }

}
?>

    <div class="col-md-9 bg-light">
        <h1 class="d-flex justify-content-center">Student Subject Management</h1>

        <form action="" method="POST">

          <div class="form-group">
              <label for="">Student ID</label>
              <input type="number" min="0" placeholder="Provide a valid ID" name="id" class="form-control">
          </div>

          <div class="form-group">
            <input type="submit" name="submit" value="Submit" class="btn btn-success btn-block btn-lg">
          </div>

          <h2>Student Present Subject</h2>
         <?php
         if(!empty($studentId)){
          echo  "<h4 class='text'>Student id :  $studentId</h4>";

         }
         if(!empty($studentInformation)){
          // print_r($studentInformation);
           $studentName = $studentInformation['name'];
           $groupName = $studentInformation['group_name'];
           echo  "<h5 class=''>Student Name :  $studentName</h5>";
           echo  "<h5 class=''>Group :  $groupName</5>";
           echo "<br>";
         }
         
        ?>

      </form>

        

        <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Subject Name</th>
                <th scope="col">Subject Code</th>
                <th scope="col">Type</th>                
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">1</th>
                <td>Bangla 1st Paper</td>
                <td>101</td>
                <td>Compulsory</td>
              </tr>
              <tr>
                <th scope="row">2</th>
                <td>Bangla 2nd Paper</td>
                <td>102</td>
                <td>Compulsory</td>
              </tr>
              <tr>
                <th scope="row">3</th>
                <td>English 1st Paper</td>
                <td>107</td>
                <td>Compulsory</td>
              </tr>
              <tr>
                <th scope="row">4</th>
                <td>English 2nd Paper</td>
                <td>108</td>
                <td>Compulsory</td>
              </tr>

              <tr>
                <th scope="row">5</th>
                <td>Information and Communication Technology</td>
                <td>275</td>
                <td>Compulsory</td>
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
              </tr>

            </tbody>
        </table>


        <?php
              if(isset($_POST['update'])){

                $subjectField = $_POST['subjectCategory'];
                if(!empty($_POST['subjectId'])){
                  $subjectCode = $_POST['subjectId'];
                }
                if(!empty($_POST['sid'])){
                  $studentId = $_POST['sid'];
                }
                
                if(!empty($subjectField) && !empty($subjectCode) && !empty($_POST['sid']) ){
                  $updateSubjectQuery = "UPDATE `college_management1`.`student_subjects` SET `$subjectField` = $subjectCode WHERE (`student_id` = $studentId);
                  ";
                  $executeUpdateSubjectQuery = mysqli_query($connection, $updateSubjectQuery);

                  if($executeUpdateSubjectQuery){
                    
                    echo "<h2 class='text-success'>Subject updated Successfully</h2>" ;
                  }else{
                    echo "<h2 class='text-danger'>Wrong Try</h2>" ;
                  }
                }
                
              
              }
            ?>

            <form action="" method="POST">
            <br>
            <h3>Update Present Subject</h3>
   
                      <div class="form-group">
                        <label for="">Select Subject Category</label>
                        <select name="subjectCategory" id="" class="form-control">
                          <option value="group_compulsory_three_first">Group Compulsory 1st Paper</option>
                          <option value="group_compulsory_three_second">Group Compulsory 2nd Paper</option>
                          <option value="optional_first">Optional 1st Paper</option>
                          <option value="optional_second">Optional 2nd Paper</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label for="">Select Subject Name</label>
                        <select name="subjectId" id="" class="form-control">

                        <?php

                        
                        foreach($SubjectList as $subject) {
                          if($singleFetch['group_compulsory_three_first'] != $subject['subject_id']
                          && $singleFetch['group_compulsory_three_second'] != $subject['subject_id']
                          && $singleFetch['optional_first'] != $subject['subject_id']
                          && $singleFetch['optional_second'] != $subject['subject_id']
                          && $studentInformation['group'] == $subject['group']
                          ){
                            // print_r($studentInformation);
                            $subjectId = $subject['subject_id'];
                            $subjectName = $subject['subject_name'];
                            echo"<option value='$subjectId'>$subjectName</option>"; 
                          }                        
                        }
                        ?>
                        
                        </select>
                      </div>

                      <div class="form-group">
                        <p>Are You Sure to Update</p>
                        <input type="radio" name='sid' value='<?php echo $studentId?>'> <label for="">Yes</label>
                        
                    </div>

                    <div class="form-group">
                      <input type="submit" name="update" value="Update Subject" class="btn btn-danger btn-block btn-lg">
                    </div>
                  
              </div>

            


          </form>
        
    </div>

    <?php require_once '../includes/footer.php'?>