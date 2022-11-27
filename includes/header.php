
<?php
//here must be session start
session_start();



if(!isset($_SESSION['user'])) {
    header('Location: ../index.php');
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
      label{
          font-weight: bold;
          font-family: "Snell Roundhand";
      }
      input:placeholder-shown {
        font-style: italic;
        font-weight: 400;
        font-family: cursive;
      }
    </style>

</head>

<body>

    
<nav class="navbar navbar-expand-lg navbar-dark bg-primary navFont">
    <a class="navbar-brand navFont" href="../welcome.php"><i class="fas fa-university fa-2x" style="color:white;"></i> College
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
        <a class="nav-link active" aria-current="page" href="../welcome.php">Home</a>
        <p class="nav-link active" href="#"><?php echo $_SESSION['user']; ?></p>
        <a class="nav-link" type="submit" name="logout" href="../index.php">Logout</a>
      </div>
    </div>
  </nav>

  <div class="container-fluid">
  <div class="row ">

  <!-- ------------row parts starts -->