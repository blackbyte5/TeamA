<?php

include 'navs/admin_navs.php';

?>

<div class="container">
   <form action="edit_type_disability.php" method="post">
     <div class="modal-content">
       <div class="modal-header">
         <h4 class="modal-title"><center>Edit Type of Disabilty</center></h4>
       </div>
     <?php
     $ToD='';
     if (isset($_GET['edit'])) {
      $id = $_GET['edit'];

      $sql="SELECT * FROM add_type_of_disability WHERE id=".$id;
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_assoc($result);
      $ToD = $row['TypeOfDisabilty'];

     }

     if (isset($_POST['edit'])) {
       $etd=$_POST['etd'];
       $id = $_POST['id'];
       $sql="UPDATE add_type_of_disability SET TypeOfDisabilty='$etd' WHERE id=".$id;
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
           <textarea class="form-control" rows="5" name="etd"><?php echo $ToD;?></textarea>
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
