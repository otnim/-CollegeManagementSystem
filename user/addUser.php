<?php require_once '../includes/dbconfig.php'?>
<?php require_once '../includes/header.php'?>
<?php require_once 'userLeftNav.php'?>

      <div class="col-md-9 bg-light">

        <h2 class="d-flex justify-content-center">Add new User</h2>

            <div class="bg-info border rounded m-3 p-3">
            <?php
                if(isset($_POST['add'])){

                if(!empty($_POST['add']) && !empty($_POST['userName']) && !empty($_POST['emailAddress']) && !empty($_POST['password'])){

                    $emailAddress = $_POST['emailAddress'];
                    $userName = $_POST['userName'];
                    $password = $_POST['password'];

                    $updateStudentQuery = "INSERT INTO `college_management1`.`admins` (`email`, `user_name`, `password`) VALUES ('$emailAddress', '$userName', '$password')";
                    $executeUpdateSubjectQuery = mysqli_query($connection, $updateStudentQuery);

                    if($executeUpdateSubjectQuery){
                    
                    echo "<h2 class='text-white'>{$emailAddress} added as new user Successfully</h2>" ;
                    }else{
                    echo "<h2 class='text-white'>'{$emailAddress}' this email is already added</h2>" ;
                    }
                }
                else{
                    echo "<script>alert('Please Insert the required filled') </script>";
                }               
                
                }
            ?>

                <form action="" method="POST">
                
                <h3>Add new User Who will works on management and entry section</h3>

                <div class="form-group">
                    <label for="">User Name</label>
                    <input type="text" placeholder="Enter a user Name maximum length 50" name="userName" class="form-control" maxlength="60">
                </div>

                <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" placeholder="Please provide a valid email" name="emailAddress" class="form-control" maxlength="80">
                </div>

                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" placeholder="Enter Password" name="password" class="form-control" maxlength="80">
                </div>

                <div class="form-group">
                    <input type="submit" name="add" value="Submit" class="btn btn-primary btn-lg">
                </div>
                    
                
                </form>

                </div>
          
    </div>

    
    <?php require_once '../includes/footer.php'?>