<?php require_once '../includes/dbconfig.php'?>
<?php require_once '../includes/header.php'?>
<?php require_once 'admissionLeftNav.php'?>
<?php

if(isset($_POST['submit'])){
    $fullName = $_POST['fullname'];
    $fullName_length = strlen($fullName);
    $studentId = $_POST['id'];
    if(!empty($studentId)) $studentId_digits = (int)log($studentId, 10) + 1;
    else $studentId_digits = 0;

    $registrationNumber = $_POST['registrationNumber'];
    if(!empty($registrationNumber)) $registrationNumber_digits = (int) log($registrationNumber, 10) + 1;
    else $registrationNumber_digits = 0;

    $fatherName = $_POST['fatherName'];
    $fatherName_length = strlen($fatherName);

    $motherName = $_POST['motherName'];
    $motherName_length = strlen($motherName);

    $address = $_POST['address'];
    $address_length = strlen($address);

    $contact = $_POST['contact'];
    // if(preg_match("/^01[3-9]{1}[0-9]{2}-[0-9]{6}$/", $contact)) {
    //     $isValid_contact = 1;
    // }
    // else $isValid_contact = 0;
    // && $isValid_contact
    
    $emailAddress = $_POST['emailAddress'];
    if(isset($_POST['gender'])){
        $studentGender = $_POST['gender'];
    }

    $dateOfBirth = $_POST['dob'];
    $bloodGroup = $_POST['bloodGroup'];
    $group = $_POST['group'];
    $section = $_POST['section'];
    $batch = $_POST['batch'];

     if($fullName_length <= 200 && $fatherName_length <= 35 && $motherName_length <= 35 && $address_length <= 230 && $studentId_digits == 8 && $registrationNumber_digits == 10 && !empty($contact) && !empty($bloodGroup) && !empty($emailAddress) && !empty($studentGender) && !empty($dateOfBirth) && !empty($group) && !empty($section) && !empty($batch)) {
        $queryString = "INSERT INTO college_management1.students (`student_id`, `group`, `section`, `blood_group`, `batch`, `name`, `father_name`, `mother_name`, `address`, `contact`, `registration_number`, `email`, `gender`, `dob`)
        VALUES ('$studentId', $group, $section, $bloodGroup, $batch, '$fullName', '$fatherName', '$motherName', '$address', '$contact', '$registrationNumber', '$emailAddress', '$studentGender', '$dateOfBirth')";
        $query = mysqli_query($connection, $queryString);

        if($query) {
            $success = "<h3 class='text-success'>Student id '$studentId' has been successfully added</h3>";
            if($group == 1){
                mysqli_query($connection, "INSERT INTO `college_management1`.`student_subjects` (`student_id`, `group_compulsory_one_first`, `group_compulsory_one_second`, `group_compulsory_two_first`, `group_compulsory_two_second`, `group_compulsory_three_first`, `group_compulsory_three_second`, `optional_first`, `optional_second`) VALUES ('$studentId', '174', '175', '176', '177', '265', '266', '178', '179');");
            }
            if($group == 2){
                mysqli_query($connection, "INSERT INTO `college_management1`.`student_subjects` (`student_id`, `group_compulsory_one_first`, `group_compulsory_one_second`, `group_compulsory_two_first`, `group_compulsory_two_second`, `group_compulsory_three_first`, `group_compulsory_three_second`, `optional_first`, `optional_second`) VALUES ('$studentId', '253', '254', '277', '278', '109', '110', '292', '293');");
                
            }
            if($group == 3){
                mysqli_query($connection, "INSERT INTO `college_management1`.`student_subjects` (`student_id`, `group_compulsory_one_first`, `group_compulsory_one_second`, `group_compulsory_two_first`, `group_compulsory_two_second`, `group_compulsory_three_first`, `group_compulsory_three_second`, `optional_first`, `optional_second`) VALUES ('$studentId', '121', '122', '117', '118', '269', '270', '304', '305');");               

            }
            
        }
    
         else {
            $error = "<h3 class='text-danger'>Please fill up the required field or Id '$studentId' is repeated</h3>";
         }     
    }
    else{
        //echo "fill up all fields";
    }
}
?>        

<div class="card" style="width: 57rem;">
    
    <div class="col-sm-12 bg-light">
        <h1>Student Admission Form</h1>
        <?php
        if(!empty($success)){
            echo $success;
        }
        else{
            if(!empty($error))
            echo $error;
        }
        ?>

        <form action="" method="POST">
            <div class="form-group" >
                <label for="">Student's Full Name</label>
                <input type="text" placeholder="Enter Student's full name here" name="fullname" class="form-control">
            </div>
            <?php
                if(isset($fullName) && $fullName_length > 200) echo "<script>alert('Full Name length must have to be less or equal 200.')</script>";  
            ?>
            <div class="form-group">
                <label for="">Student ID</label>
                <input type="number" min="0" placeholder="Provide a valid ID" name="id" class="form-control">
            </div>
            <h3 style = "color: red">   
            <?php
                if(isset($studentId) && $studentId_digits != 8) echo "<script>alert('Student ID must have to be an 8 digits integer and cannot start with 0.')</script>";  
            ?>
            </h3>
            <div class="form-group">
                <label for="">Registration Number</label>
                <input type="number" min="0" placeholder="Enter student's SSC Registration number"
                    name="registrationNumber" class="form-control">
            </div>

            <?php
                if(isset($registrationNumber) && $registrationNumber_digits != 10)
                echo "<script>alert('Registration number must have to be a 10 digits integer and cannot start with 0.')</script>";
            ?>

            <div class="form-group">
                <label for="">Father Name</label>
                <input type="text" placeholder="Enter Student's Father Name" name="fatherName" class="form-control">
            </div>
            <?php
                if(isset($fatherName) && $fatherName_length > 30) echo "<script>alert('Father Name length must have to be less or equal 30.')</script>";  
            ?>
            <div class="form-group">
                <label for="">Mother Name</label>
                <input type="text" placeholder="Enter Student's Mother Name" name="motherName" class="form-control">
            </div>
            <?php
                if(isset($motherName) && $motherName_length > 30) echo "<script>alert('Mother Name length must have to be less or equal 30.')</script>";  
            ?>

            <div class="form-group">
                <label for="">Full Address</label>
                <input type="text" placeholder="Enter full address here" name="address" class="form-control">
            </div>
            <?php
                if(isset($address) && $address_length > 230) echo "<script>alert('Address length must have to be less or equal 230.')</script>";  
            ?>
            <div class="form-group">
                <label for="">Contact Number</label>
                <input type="tel" placeholder="Enter Contact Number like 01395-7428XX" name="contact" class="form-control">
            </div>

            <div class="form-group">
                <label for="">Email</label>
                <input type="email" placeholder="Please provide a valid email" name="emailAddress" class="form-control">
            </div>

            <div class="form-group">
                <p>Select Your gender</p>
                <input type="radio" name="gender" value="male"> <label for="">Male</label>
                <input type="radio" name="gender" value="female"> <label for="">Female</label>
                <input type="radio" name="gender" value="other"> <label for="">Other</label>
            </div>

            <div class="form-group">
                <label for="">Student Date of Birth</label>
                <input type="date" name="dob" class="">
            </div>


            <div class="form-group">
                <label for="">Blood Group</label>
                <select name="bloodGroup" id="" class="form-control">
                    <option value="1">A+</option>
                    <option value="2">A-</option>
                    <option value="3">B+</option>
                    <option value="4">B-</option>
                    <option value="5">O+</option>
                    <option value="6">O-</option>
                    <option value="7">AB+</option>
                    <option value="8">AB-</option>
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
                <label for="">Select Section :</label>
                <select name="section" id="" class="form-control">

                <?php
                $sectionQuery = mysqli_query($connection, "SELECT * FROM college_management1.sections");
                $sectionResults = mysqli_fetch_all($sectionQuery, MYSQLI_ASSOC);
                foreach($sectionResults as $sectionResult) {
                    $sectionId = $sectionResult['section'];
                    $sectionName = $sectionResult['section_name'];
                    echo "<option value='$sectionId'>$sectionName</option>";
                }
                ?>
                
                </select>
            </div>

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
                <input type="submit" name="submit" value="SUBMIT" class="btn btn-success btn-block btn-lg">
            </div>



        </form>
    </div>
</div>

<?php require_once '../includes/footer.php'?>