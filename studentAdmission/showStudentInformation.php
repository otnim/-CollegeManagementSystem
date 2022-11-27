<?php require_once '../includes/dbconfig.php'?>
<?php require_once '../includes/header.php'?>
<?php require_once 'admissionLeftNav.php'?>

<?php

    if(isset($_POST['submit'])){
    $studentId = $_POST['id'];
    if(!empty($studentId)){
    $queryString = "SELECT s.student_id, s.name, s.father_name, s.mother_name, s.registration_number, b.batch_value, ssection.section_name, sg.group_name, s.address, s.email, s.dob, bg.blood_group_name, s.contact, s.gender FROM college_management1.students s
    NATURAL JOIN college_management1.blood_groups bg
    NATURAL JOIN college_management1.sections ssection
    NATURAL JOIN college_management1.batches b
    NATURAL JOIN college_management1.groups sg
    WHERE s.student_id = $studentId;
    ";
    $showQuery = mysqli_query($connection, $queryString);
    
    }
    
    $singleFetch;
    if(!empty($showQuery)){
        $singleFetch = mysqli_fetch_assoc($showQuery);
    }

}

?>

      <div class="col-md-9 bg-light">

      <h2 class="d-flex justify-content-center">Student Information and Update Section</h2>

      <form action="" method="post">

            <div class="form-group">
                    <label for="">Student ID</label>
                    <input type="number" min="0" placeholder="Provide a valid ID" name="id" class="form-control">
            </div>

            <div class="form-group">
                    <input type="submit" name="submit" value="Submit" class="btn btn-success btn-lg">
            </div>

        </form>
        <?php
            
        if(isset($singleFetch)){
            $id = $singleFetch['student_id'];
            $name = $singleFetch['name'];
            $fatherName = $singleFetch['father_name'];
            $MotherName = $singleFetch['mother_name'];
            $registrationNumber = $singleFetch['registration_number'];
            $batch = $singleFetch['batch_value'];
            $section = $singleFetch['section_name'];
            $group = $singleFetch['group_name'];
            $address = $singleFetch['address'];
            $email = $singleFetch['email'];
            $dob = $singleFetch['dob'];
            $bloodGroups = $singleFetch['blood_group_name'];
            $contact = $singleFetch['contact'];
            $gender = $singleFetch['gender'];

            echo"<h4 class='d-flex justify-content-center'>Student information for id: {$id}</h4>
            <div class='d-flex justify-content-center'>
            <div class='card m-5 p-5 shadow' style='width: 35rem;'>
                <p>Student id : {$id}</p>
                <p>Name: {$name}</p>
                <p>Father Name: {$fatherName} </p>
                <p>Mother Name: {$MotherName} </p>
                <p>Student Registration Number: {$registrationNumber}</p>
                <p>Batch : {$batch}</p>
                <p>Section : {$section}</p>
                <p>Group : {$group}</p>
                <p>Address : {$address}</p>
                <p>Email : {$email}</p>
                <p>Gender : {$gender}</p>
                <p>Date of Birth : {$dob}</p>
                <p>Blood Group : {$bloodGroups}</p>
                <p>Mobile No : {$contact}</p>
            </div>
        </div>";
        }
        else{
            echo 'Please Insert a valid id';
        }
        ?>


            <div class="bg-info border rounded m-3 p-3">
            <?php
              if(isset($_POST['update'])){

                if(!empty($_POST['upDateId']) && !empty($_POST['address']) && !empty($_POST['contact']) && !empty($_POST['emailAddress']) && !empty($_POST['dob'])){
                    $upDateId = $_POST['upDateId'];

                    $address = $_POST['address'];
                    $contact = $_POST['contact'];
                    $dateOfBirth = $_POST['dob'];
                    $emailAddress = $_POST['emailAddress'];

                    
                    $updateStudentQuery = "UPDATE `college_management1`.`students` SET `address` = '$address', `contact` = '$contact', `email` = '$emailAddress', `dob` = '$dateOfBirth' WHERE (`student_id` = $upDateId);
                    ";
                    $executeUpdateSubjectQuery = mysqli_query($connection, $updateStudentQuery);

                    if($executeUpdateSubjectQuery){
                    
                    echo "<h2 class='text-white'>{$upDateId} id information updated Successfully</h2>" ;
                    }else{
                    echo "<h2 class='text-danger'>Wrong Try</h2>" ;
                    }
                   

                }
                else{
                    echo "<script>alert('Please Insert the required filled') </script>";
                }               
              
              }
            ?>

                <form action="" method="POST">
                
                <h3>Student Information Update Section</h3>

                <div class="form-group">
                    <label for="">Contact Number</label>
                    <input type="tel" placeholder="Enter Contact Number like 013957428XX" name="contact" class="form-control">
                </div>

                <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" placeholder="Please provide a valid email" name="emailAddress" class="form-control">
                </div>

                <div class="form-group">
                    <label for="">Student Date of Birth</label>
                    <input type="date" name="dob" class="">
                </div>

                <div class="form-group">
                    <label for="">Full Address</label>
                    <input type="text" placeholder="Enter full address here" name="address" class="form-control">
                </div>

                <div class="form-group">
                    <p>Are You Sure to Update <?php if(!empty($id)) echo $id?></p>
                    <input type="radio" name='upDateId' value='<?php if(!empty($id)) echo $id?>'> <label for="">Yes</label>
                </div>

                <div class="form-group">
                    <input type="submit" name="update" value="Update student information" class="btn btn-primary btn-lg">
                </div>
                  
              
                </form>
            </div>

        <!-- -------------student deletion section starts -------------------------------- -->
        <div class="rounded m-3 p-3" style="background-color: rgba(245, 180, 94, 0.897);">

            <?php
                if(isset($_POST['delete'])){


                    if(!empty($_POST['studentId'])){
                    $deleteId = $_POST['studentId'];
                    }
                    
                    if(!empty($deleteId)){
                    
                        $deleteSubjectQuery = "DELETE FROM `college_management1`.`student_subjects` WHERE (`student_id` = '$deleteId')";
                        $executeUpdateSubjectQuery = mysqli_query($connection, $deleteSubjectQuery);
                        $deleteStudentQuery = "DELETE FROM `college_management1`.`students` WHERE (`student_id` = '$deleteId')";
                        $executeUpdateSubjectQuery = mysqli_query($connection, $deleteStudentQuery);

                        if($executeUpdateSubjectQuery){
                        
                        echo "<h2 class='text-success'>{$deleteId} id Deleted Successfully</h2>" ;
                        }else{
                        echo "<h2 class='text-danger'>Wrong Try</h2>" ;
                        }
                    }
                    
                
                }
            ?>

            <form action="" method="POST">

                <h3>Delete Section</h3>
                        <div class="form-group">
                            <p>Are You Sure to Delete <?php if(!empty($id)) echo $id?></p>
                            <input type="radio" name='studentId' value='<?php if(!empty($id)) echo $id?>'> <label for="">Yes</label>
                            
                        </div>

                        <div class="form-group">
                        <input type="submit" name="delete" value="Delete  student Id <?php if(!empty($id)) echo $id?>" class="btn btn-danger btn-lg">
                        </div>
                    
                </div>

            </form>
        </div>
          
    </div>

    
    <?php require_once '../includes/footer.php'?>