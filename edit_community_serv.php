<?php

include 'navs/admin_navs.php';

?>

<div class="container">
   <form action="edit_community_serv.php" method="post">
     <div class="modal-content">
       <div class="modal-header">
         <h4 class="modal-title"><center>Edit Community Services</center></h4>
       </div>
     <?php
     $val='';
     if (isset($_GET['edit'])) {
      $id = $_GET['edit'];

      $sql="SELECT * FROM add_community_serv WHERE id=".$id;
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_assoc($result);
      $val = $row['CommunityServices'];

     }

     if (isset($_POST['edit'])) {
       $ecs=$_POST['ecs'];
       $id = $_POST['id'];
       $sql="UPDATE add_community_serv SET CommunityServices='$ecs ' WHERE id=".$id;
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
           <textarea class="form-control" rows="5" name="ecs"><?php echo $val;?></textarea>
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
