<?php require_once '../includes/dbconfig.php'?>
<?php require_once '../includes/header.php'?>
<?php require_once 'studentManagementLeftNav.php'?>

<?php


if(isset($_POST['submit'])){
  $batch = $_POST['batch'];
  $queryString = "SELECT * FROM college_management1.students
WHERE batch = $batch";
// echo $queryString;

$showQuery = mysqli_query($connection, $queryString);


$showFetch = mysqli_fetch_all($showQuery, MYSQLI_ASSOC);
  

}

?>

<div class="col-md-9 bg-light">


  <h2 class="d-flex justify-content-center">Year Wise Student</h2>

  <form action="" method="post">
    <div class="form-group">
      <label for="">Select Batch</label>
      <select name="batch" id="" class="form-control mb-4">
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
    </div>

    <div class="form-group">
      <input type="submit" name="submit" value="Submit" class=" btn btn-success btn-block btn-lg">
    </div>

  </form>

  <table class="table table-hover">
    <thead>
      <tr>
        <th scope="col">ID Number</th>
        <th scope="col">Full Name</th>
        <th scope="col">Father Name</th>
        <th scope="col">Gender</th>
        <th scope="col">Date of Birth</th>
      </tr>
    </thead>
    <tbody>

      <?php
            if(isset($showFetch)){
              $total = 0;
              foreach($showFetch as $singlePerson){
                $id = $singlePerson['student_id'];
                $name = $singlePerson['name'];
                $father = $singlePerson['father_name'];
                $gender = $singlePerson['gender'];
                $dob = $singlePerson['dob'];

                $total++;
  
                echo "<tr>
                  <th>$id</th>
                  <td>$name</td>
                  <td>$father</td>
                  <td>$gender</td>
                  <td>$dob</td>
                </tr>";
              }
              echo "<h3>Total student : $total</h3>";
              echo "<br>";
            }
            
            ?>

    </tbody>
  </table>

</div>

<?php require_once '../includes/footer.php'?>