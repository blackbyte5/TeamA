<?php

include 'navs/admin_navs.php';

?>


<div class="container">
   <form action="add_social_emotional.php" method="post">
     <?php
     $soc_emo='';
     if (isset($_POST['add_soc_emo'])) {
       $soc_emo=$_POST['soc_emo'];
       if (!empty($soc_emo)) {
         $sql = "INSERT INTO add_problem_emotional_social (EmotionalSocial)
                  VALUES ('$soc_emo') ";
         $result = mysqli_query($conn,$sql);
       }else {
         echo "<center style='color:red;'>What's new..</center>";
       }

     }
      ?>

       <!-- Modal content-->
       <div class="modal-content">
         <div class="modal-header">
           <h4 class="modal-title"><center>Add Social/Emotional</center></h4>
         </div>
         <div class="modal-body">
           <textarea class="form-control" rows="5" name="soc_emo" placeholder="What's new..?"></textarea>
         </div>
         <div class="modal-footer">
           <button type="submit" class="btn btn-primary" name="add_soc_emo">Add</button>
         </div>
       </div>

       <br><br>
       <div class="card-body">
         <div class="table-responsive">
           <table class="table table-bordered" id="customers" width="100%" cellspacing="0">
             <thead>
               <tr>
                 <th>Problem Encounter in Social/Emotional</th>
                 <th>Edit</th>
                 <th>Delete</th>
               </tr>
       <?php
       $sql = "SELECT * FROM add_problem_emotional_social ORDER BY id ASC";
       $result = mysqli_query($conn, $sql);
       if(mysqli_num_rows($result)>0){
       while($row = mysqli_fetch_assoc($result)){
       $id =  $row['id'];
       $val = $row['EmotionalSocial'];

         echo '<tr>
               <td>'.$val.'</td>
               <td>
                   <a href="edit_social_emotional.php?edit='.$id.'" class="btn btn-info btn-sm">edit</a>
              </td>
               <td>
                   <a href="add_social_emotional.php?delete='.$id.'" class="btn btn-danger btn-sm">delete</a>
               </td>
               </tr>';
         }
         }else {
         echo '<center style="color:red;">O Result</center>';
         }

         if(isset($_GET['delete'])) {
       $id = $_GET['delete'];

       $sql = "DELETE FROM add_problem_emotional_social WHERE id=".$id;
       $result = mysqli_query($conn, $sql);
       }
        ?>
      </tbody>
      </table>
      </div>
      </div>
      <br><br><br>
    </form>
</div>
</body>
</html>
