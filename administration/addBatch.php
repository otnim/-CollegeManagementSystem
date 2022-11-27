<?php require_once '../includes/dbconfig.php'?>
<?php require_once '../includes/header.php'?>
<?php require_once 'administrationLeftNav.php'?>

<?php


if(isset($_POST['submit'])){
  $showLastBatchQuery = "SELECT * FROM college_management1.batches b 
  ORDER by b.batch DESC LIMIT 1";
  $executeQuery = mysqli_query($connection, $showLastBatchQuery);
  $showLastBatchQueryResult = mysqli_fetch_assoc($executeQuery);

  $newBatchId = $showLastBatchQueryResult['batch'];
  $newBatchId++;
  $newBatch = $showLastBatchQueryResult['batch_value'];
  $newBatch++;
  if(!empty($newBatchId) && !empty($newBatch)){
    $updateBatch = mysqli_query($connection, "INSERT INTO `college_management1`.`batches` (`batch`, `batch_value`) VALUES ($newBatchId, $newBatch);");
    if(!$updateBatch){
      echo "Batch Full";
    }
  }
}


$queryString = "SELECT * FROM college_management1.batches b ORDER by b.batch DESC;";
$showQuery = mysqli_query($connection, $queryString);
$showFetch = mysqli_fetch_all($showQuery, MYSQLI_ASSOC);
?>

<div class="col-md-9 bg-light">




      <h2 class="d-flex justify-content-center">Available All Present Batches</h2>

        <table class="table table-hover table-sm">
            <thead>
              <tr>
                <th scope="col">Batch Id</th>
                <th scope="col">Batch</th>
              </tr>
            </thead>
            <tbody>

            <?php
            if(isset($showFetch)){
              $total = 0;
              foreach($showFetch as $singleBatch){
                $batchId = $singleBatch['batch'];
                $batchValue= $singleBatch['batch_value'];

                $total++;
  
                echo "<tr>
                  <th>$batchId</th>
                  <td>$batchValue</td>
                </tr>";
              }
              // echo "<h3>Batch : $batch, Group : $group, Total student : $total</h3>";
              echo "<br>";
            }
            
            ?>

            </tbody>
          </table>

          <form action="" method="post">
            <div class="form-group">
                <input type="submit" name="submit" value="Add New Batch" class="btn btn-success btn-block btn-lg">
            </div>

          </form>


          </div>

<?php require_once '../includes/footer.php'?>