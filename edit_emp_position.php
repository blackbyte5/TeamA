<?php

include 'navs/admin_navs.php';

?>

<div class="container">
   <form action="edit_emp_position.php" method="post">
     <div class="modal-content">
       <div class="modal-header">
         <h4 class="modal-title"><center>Edit Employee Position</center></h4>
       </div>
     <?php
     $pos='';
     if (isset($_GET['edit'])) {
      $id = $_GET['edit'];

      $sql="SELECT * FROM add_employee_position WHERE id=".$id;
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_assoc($result);
      $pos = $row['Position'];

     }

     if (isset($_POST['edit'])) {
       $position=$_POST['position'];
       $id = $_POST['id'];
       $sql="UPDATE add_employee_position SET Position='$position' WHERE id=".$id;
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
           <textarea class="form-control" rows="5" name="position"><?php echo $pos;?></textarea>
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
