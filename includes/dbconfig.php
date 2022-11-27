<?php
    $connection = mysqli_connect("localhost" , "root", "password", "college_management1");

    if($connection){
        // echo "<script>alert('dataBase is Connected')</script>";
    }
    else {
        echo "<script>alert('dataBase Not Connected')</script>";
    }
?>
<script></script>