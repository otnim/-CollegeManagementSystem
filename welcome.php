
<?php
//here must be session start
session_start();



if(!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College Management System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
        integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
        crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

        <style>
    body {
      background-color: #2f4050;
    }

    .navFont {
      font-size: 25px;
    }
  </style>

</head>

<body>

    
<nav class="navbar navbar-expand-lg navbar-dark bg-primary navFont">
    <a class="navbar-brand navFont" href="welcome.php"><i class="fas fa-university fa-2x" style="color:white;"></i> College
      Management System</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02"
      aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
      <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
        <!-- <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li> -->
      </ul>
      <div class="navbar-nav d-flex justify-content-end fs-4 fw-bold">
        <a class="nav-link active" aria-current="page" href="welcome.php">Home</a>
        <p class="nav-link active"><?php echo $_SESSION['user']; ?></p>
        <a class="nav-link" type="submit" name="logout" href="logout.php">Logout</a>
      </div>
    </div>
  </nav>

  <!-- ------------row parts starts -->

        <div class="row container-fluid d-flex justify-content-center" >
            <div class="col-md-6 col-lg-3 bg-secondary d-flex align-items-center  flex-column p-5 m-5 rounded">
                <!-- <i class="fa fa-car" style="font-size:60px;color:white;"></i> -->
                <i class="fas fa-users-cog fa-5x" style="color:white;"></i>
                <h2 class="text-white">Administration</h2>
                <a class="btn btn-success btn-lg border-white" href="administration/addBatch.php">Go to Admin</a>
                
            </div>

            <div class="col-md-6 col-lg-3 bg-secondary d-flex align-items-center  flex-column p-5 m-5 rounded">
                <!-- <i class="fa fa-car" style="font-size:60px;color:white;"></i> -->
                <i class="fas fa-university fa-5x" style="color:white;"></i>
                <h2 class="text-white">Student Admission</h2>
                <a href="studentAdmission/admissionForm.php"><button class="btn btn-success btn-lg border-white">Admit Student</button></a>
                
            </div>


            <div class="col-md-6 col-lg-3 bg-secondary d-flex align-items-center  flex-column p-5 m-5 rounded">
                <!-- <i class="fa fa-car" style="font-size:60px;color:white;"></i> -->
                <i class="fas fa-poll fa-5x" style="color:white;"></i>
                <h2 class="text-white">Result Section</h2>
                
                <a class="btn btn-success btn-lg border-white" href="resultSection/groupAndBatchWiseResultPublishing.php">Result</a>

            </div>

            <div class="col-md-6 col-lg-3 bg-secondary d-flex align-items-center  flex-column p-5 m-5 rounded">
                <!-- <i class="fa fa-car" style="font-size:60px;color:white;"></i> -->
                <i class="fas fa-tasks fa-5x" style="color:white;"></i>
                <h2 class="text-white">Student Management Section</h2>
                <a class="btn btn-success btn-lg border-white" href="studentManagement/allBtachStudentYearWise.php">Student and Subject</a>
            </div>

            <div class="col-md-6 col-lg-3 bg-secondary d-flex align-items-center  flex-column p-5 m-5 rounded">
                <!-- <i class="fa fa-car" style="font-size:60px;color:white;"></i> -->
                <i class="fas fa-user-shield fa-5x" style="color:white;"></i>
                <h2 class="text-white">User Management Section</h2>
                <a class="btn btn-success btn-lg border-white" href="user/addUser.php">Manage User</a>
            </div>

        </div>

    <!-- ---------------row  part ends -->






<footer class="text-light d-flex align-items-center justify-content-center mt-4">
  <br>
  <p>College Management System | &copy;2021---All rights reserved.</p>

</footer>



  



  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
      integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
      crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
      crossorigin="anonymous"></script>
</body>

</html>