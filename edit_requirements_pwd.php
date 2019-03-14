<?php

include 'navs/admin_navs.php';

?>

<div class="container">
   <form action="edit_requirements_pwd.php" method="post">
     <div class="modal-content">
       <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal">&times;</button>
         <h4 class="modal-title"><center>Edit PWD Requirements</center></h4>
       </div>
     <?php
     $requirements='';
     if (isset($_GET['edit'])) {
      $id = $_GET['edit'];

      $sql="SELECT * FROM add_pwd_requirements WHERE id=".$id;
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_assoc($result);
      $requirements = $row['requirements'];

     }

     if (isset($_POST['edit'])) {
       $req=$_POST['req'];
       $id = $_POST['id'];
       $sql="UPDATE add_pwd_requirements SET requirements='$req' WHERE id=".$id;
       $result = mysqli_query($conn,$sql);
         if (!$result) {
           echo '<center style="color:red;">No Action</center>';
         }else {
           echo '<center style="color:red;">Successfuly Update</center>';
         }
     }
      ?>

         <div class="modal-body">
           <input type="hidden" name="id" value="<?php echo $id;?>">
           <textarea class="form-control" rows="5" name="req"><?php echo $requirements;?></textarea>
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
