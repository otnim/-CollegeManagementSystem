<?php require '../includes/dbconfig.php'?>
<?php require '../includes/header.php'?>
<?php require_once 'administrationLeftNav.php'?>

<?php 
$section;
?>
<div class="col-md-9 bg-light">


    
     <h2 class="d-flex justify-content-center">Available Section</h2>
     <table class="table table-hover table-sm">
            <thead>
              <tr>
                <th scope="col">Section Id</th>
                <th scope="col">Section Name</th>
              </tr>
            </thead>
            <tbody>

            <?php

          
          $queryString = "SELECT * FROM college_management1.sections";
          $showQuery = mysqli_query($connection, $queryString);
          $showFetch = mysqli_fetch_all($showQuery, MYSQLI_ASSOC);


            if(isset($showFetch)){
              $total = 0;
              foreach($showFetch as $singleSection){
                $sectionId = $singleSection['section'];
                $section = $sectionId;
                $sectionValue= $singleSection['section_name'];

                $total++;
  
                echo "<tr>
                  <th>$sectionId</th>
                  <td>$sectionValue</td>
                </tr>";
              }
              // echo "<h3>Batch : $batch, Group : $group, Total student : $total</h3>";
              echo "<br>";
            }
            
            ?>

            </tbody>
     </table>

     <?php
     if(isset($_POST['submit'])){
          $showLastBatchQuery = "SELECT * FROM college_management1.sections s 
          ORDER by s.section DESC LIMIT 1";
          $executeQuery = mysqli_query($connection, $showLastBatchQuery);
          $showLastBatchQueryResult = mysqli_fetch_assoc($executeQuery);
        
          $newSectionId = $showLastBatchQueryResult['section'];
          $newSectionId++;
          $newSection = $showLastBatchQueryResult['section_name'];
          $newSection++;
          if(!empty($newSectionId) && !empty($newSection)){
            $updateBatch = mysqli_query($connection, "INSERT INTO `college_management1`.`sections` (`section`, `section_name`) VALUES ('$newSectionId', '$newSection');
            ");
            if(!$updateBatch){
              echo "Batch Full";
            }
          }
        }
     ?>

     <form action="" method="post">
          <div class="form-group">
               <input type="submit" name="submit" value="Add New Section" class="btn btn-success btn-block btn-lg">
          </div>
     </form>

     <!-- -------delete start ----- -->

     <?php
              if(isset($_POST['delete'])){


                if(!empty($_POST['section'])){
                  $sectionId = $_POST['section'];
                }
                
                if(!empty($sectionId)){
                  $updateSubjectQuery = "DELETE FROM `college_management1`.`sections` WHERE (`section` = '$sectionId');";
                  $executeUpdateSubjectQuery = mysqli_query($connection, $updateSubjectQuery);

                  if($executeUpdateSubjectQuery){
                    
                    echo "<h2 class='text-success'>Section Deleted Successfully</h2>" ;
                  }else{
                    echo "<h2 class='text-danger'>Wrong Try</h2>" ;
                  }
                }
                
              
              }
      ?>

     <form action="" method="POST">
            <h3>Delete Section</h3>
                      <div class="form-group">
                        <p>Are You Sure to Delete <?php echo $section?>th Section</p>
                        <input type="radio" name='section' value='<?php echo $section?>'> <label for="">Yes</label>
                        
                    </div>

                    <div class="form-group">
                      <input type="submit" name="delete" value="Delete Last Section" class="btn btn-danger btn-block btn-lg">
                    </div>
                  
              </div>

            


          </form>

<div>

<?php require_once '../includes/footer.php'?>


 