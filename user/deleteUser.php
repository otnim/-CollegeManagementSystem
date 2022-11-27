<?php require_once '../includes/dbconfig.php'?>
<?php require_once '../includes/header.php'?>
<?php require_once 'userLeftNav.php'?>

      <div class="col-md-9 bg-light">

        <h2 class="d-flex justify-content-center">Delete User</h2>

            <div class="bg-info border rounded m-3 p-3">
            <?php
                if(isset($_POST['add'])){

                    if(!empty($_POST['add']) && !empty($_POST['emailAddress']) && !empty($_POST['oldPassword'])){

                        $oldPassword = $_POST['oldPassword'];
                        $emailAddress = $_POST['emailAddress'];

                        $login_query = mysqli_query($connection, "SELECT * FROM college_management1.admins where email = '$emailAddress'");
                        $login_fetch = mysqli_fetch_assoc($login_query);
                        if(!empty($login_fetch)){
                            $emailFromDb = $login_fetch['email'];
		                    $passwordFromDb = $login_fetch['password'];

                            if($emailFromDb == $emailAddress && $passwordFromDb == $oldPassword) {
                                $updateStudentQuery = "DELETE FROM `college_management1`.`admins` WHERE (`email` = '$emailAddress')";
                                $executeUpdateSubjectQuery = mysqli_query($connection, $updateStudentQuery);

                                if($executeUpdateSubjectQuery){
                                    echo "<h2 class='text-white'>{$emailAddress} Deleted user Successfully</h2>" ;
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
                
                <h3>Delete User Section</h3>

                <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" placeholder="Enter the email which information to be updated" name="emailAddress" class="form-control" maxlength="80">
                </div>

                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" placeholder="Enter Password" name="oldPassword" class="form-control" maxlength="80">
                </div>
                
                <div class="form-group">
                    <input type="submit" name="add" value="Delete" class="btn btn-danger btn-lg">
                </div>
                    
                
                </form>

                </div>
          
    </div>

    
    <?php require_once '../includes/footer.php'?>