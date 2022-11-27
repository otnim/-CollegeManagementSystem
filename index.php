<?php require 'includes/dbconfig.php'?>
<?php

session_start();

if(isset($_POST['login'])) {
    $login_email = $_POST['login_email'];
	$login_password = $_POST['login_password'];
    
	
	if(!empty($login_email) && !empty($login_password)) {

		$login_query = "SELECT * FROM college_management1.admins a
        WHERE a.email = '$login_email'";

        $executeLoginQuery = mysqli_query($connection, $login_query);
        

		$login_fetch = mysqli_fetch_assoc($executeLoginQuery);
        if(!empty($login_fetch)){
            $emailFromDb = $login_fetch['email'];
		    $passwordFromDb = $login_fetch['password'];
            $userName = $login_fetch['user_name'];

            if($emailFromDb == $login_email && $passwordFromDb == $login_password) {

                // echo 'Matched';
                // redirect here
                $_SESSION['user'] = $userName;
                header('Location: welcome.php');

            } else{
                echo "<script>alert('please give the correct email and password');</script>";
            }
        }
        else{
            echo "<script>alert('please give the correct email and password');</script>";
        }
	}
}
?>
<!-- php code ends -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>College Management System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
    integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
    crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-show-password/1.0.3/bootstrap-show-password.min.js"></script>


    <style>
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

<header>
    <nav>
       
    </nav>

</header>

<main >
    <section class="" style = "width: 100%" >
       <div class="bg-info container">
        <h1 class="text-white d-flex align-items-center justify-content-center pt-5">College Management System</h1>
       <div class="row bg-info align-items-center justify-content-center" style="height: 100%">
        
        <div class="card bg-light p-5" style = "width: 40rem">
            <!--
            <div class = "card-header">
                <h2 class="text-white row bg-dark align-items-center justify-content-center">Login</h2>
            </div>
            -->
            <form action="" method="POST">
            
                <div class= "form-group">
                    <h4> <label for="">Email Address</label> </h4>
                    <div class = "input-group">
                        <span class = "input-group-addon"> <span class = "glyphicon glyphicon-user"> </span> </span>
                        <input type="email" class="form-control" name="login_email" placeholder = "enter email">
                    </div>
                </div>

                <div class= "form-group">
                    <h4> <label for="">Password</label> </h4>
                    <div class = "input-group">
                        <span class = "input-group-addon"> <span class = "glyphicon glyphicon-lock"> </span> </span>
                        <input type="password" class="form-control" name="login_password" placeholder = "enter password" data-toggle="password">
                    </div>
                </div>

                <?php
                    echo "</br>";
                    echo "</br>";
                ?>

                <div class="form-group">
                    <input type="submit" name="login" value="Log In" style='font-size: 25px; font-weight: bold;' class="btn btn-dark btn-block btn-lg">
                </div>
            </form>
        </div>
        <script type="text/javascript">
            $("#password").password('toggle');
        </script>
    </div>
       
       </div>
    </section>

</main>

<footer>
    <nav>
    
    
    </nav>

</footer>

   
</body>
</html>