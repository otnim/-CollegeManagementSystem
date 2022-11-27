<?php require_once '../includes/dbconfig.php'?>
<?php require_once '../includes/header.php'?>
<?php require_once 'userLeftNav.php'?>

      <div class="col-md-9 bg-light">

        <h2 class="d-flex justify-content-center">Update user Information</h2>

            <div class="bg-info border rounded m-3 p-3">
            <?php
                if(isset($_POST['add'])){

                    if(!empty($_POST['add']) && !empty($_POST['userName']) && !empty($_POST['emailAddress']) && !empty($_POST['oldPassword']) && !empty($_POST['newPassword'])){

                        $oldPassword = $_POST['oldPassword'];
                        $emailAddress = $_POST['emailAddress'];
                        $userName = $_POST['userName'];
                        $newPassword = $_POST['newPassword'];

                        $login_query = mysqli_query($connection, "SELECT * FROM college_management1.admins where email = '$emailAddress'");
                        $login_fetch = mysqli_fetch_assoc($login_query);
                        if(!empty($login_fetch)){
                            $emailFromDb = $login_fetch['email'];
		                    $passwordFromDb = $login_fetch['password'];

                            if($emailFromDb == $emailAddress && $passwordFromDb == $oldPassword) {
                                $updateStudentQuery = "UPDATE `college_management1`.`admins` SET `user_name` = '$userName', `password` = '$newPassword' WHERE (`email` = '$emailAddress');";
                                $executeUpdateSubjectQuery = mysqli_query($connection, $updateStudentQuery);

                                if($executeUpdateSubjectQuery){
                                    echo "<h2 class='text-white'>{$emailAddress} updated user Successfully</h2>" ;
                                }
                                else{
                                    echo "<h2 class='text-white'>'{$emailAddress}' Wrong Try</h2>" ;
                                }
                            }
                            else{
                                echo "<script>alert('please give the correct email and password');</script>";   
                            }
                        }else{
                            echo "<script>alert('please give valid email that already registered');</script>";
                        }
                        
                    }
                    else{
                        echo "<script>alert('Please Insert the required filled') </script>";
                    }               
                
                }
            ?>

                <form action="" method="POST">
                
                <h3>Update User Section</h3>

                <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" placeholder="Enter the email which information to be updated" name="emailAddress" class="form-control" maxlength="80">
                </div>

                <div class="form-group">
                    <label for="">New User Name</label>
                    <input type="text" placeholder="Enter new user Name maximum length 50" name="userName" class="form-control" maxlength="60">
                </div>


                <div class="form-group">
                    <label for="">Old Password</label>
                    <input type="password" placeholder="Enter old Password" name="oldPassword" class="form-control" maxlength="80">
                </div>
                

                <div class="form-group">
                    <label for="">New Password</label>
                    <input type="password" placeholder="Enter New Password" name="newPassword" class="form-control" maxlength="80">
                </div>

                <div class="form-group">
                    <input type="submit" name="add" value="Update" class="btn btn-primary btn-lg">
                </div>
                    
                
                </form>

                </div>
          
    </div>

    
    <?php require_once '../includes/footer.php'?>