<?php

include 'navs/admin_navs.php';

?>

<div class="container">
   <form action="edit_economics.php" method="post">
     <div class="modal-content">
       <div class="modal-header">
         <h4 class="modal-title"><center>Edit Economics</center></h4>
       </div>
     <?php
     $Econ='';
     if (isset($_GET['edit'])) {
      $id = $_GET['edit'];

      $sql="SELECT * FROM add_problem_economics WHERE id=".$id;
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_assoc($result);
      $Econ = $row['Economics'];

     }

     if (isset($_POST['edit'])) {
       $Eecon=$_POST['Eecon'];
       $id = $_POST['id'];
       $sql="UPDATE add_problem_economics SET Economics='$Eecon' WHERE id=".$id;
       $result = mysqli_query($conn,$sql);
         if (!$result) {
           echo "<center style='color:red;'>No Action</center>";
         }else {
           echo "<center style='color:red;'>Successfuly Update</center>";
         }
     }
      ?>

         <div class="modal-body">
           <input type="hidden" name="id" value="<?php echo $id;?>">
           <textarea class="form-control" rows="5" name="Eecon"><?php echo $Econ;?></textarea>
         </div>
         <div class="modal-footer">
           <button type="submit" class="btn btn-primary" name="edit">Edit</button>
         </div>
       </div>

     </div>
   </div>
    </form>
</div>
</body>
</html>
