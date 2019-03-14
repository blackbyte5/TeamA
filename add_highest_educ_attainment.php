<?php

include 'navs/admin_navs.php';

?>


<div class="container">

   <form action="add_highest_educ_attainment.php" method="post">
     <div class="modal-content">
       <div class="modal-header">
         <h4 class="modal-title"><center>Add Highest Educational Attainment</center></h4>
       </div>
     <?php
     $requirements='';
     if (isset($_POST['addreq'])) {
       $HEA=$_POST['HEA'];
       if (!empty($HEA)) {
         $sql = "INSERT INTO add_highest_educ_attainment (EducationalAttainment)
                  VALUES ('$HEA') ";
         $result = mysqli_query($conn,$sql);
       }else {
         echo "<center style='color:red;'>What's new..</center>";
       }

     }
      ?>
         <div class="modal-body">
           <textarea class="form-control" rows="5" name="HEA" placeholder="What's new..?"></textarea>
         </div>
         <div class="modal-footer">
           <button type="submit" class="btn btn-primary" name="addreq">Add</button>
         </div>
       </div>

       <br><br>
       <div class="card-body">
         <div class="table-responsive">
           <table class="table table-bordered" id="customers" width="100%" cellspacing="0">
             <thead>
               <tr>
                 <th>Highest Educational Attainment</th>
                 <th>Edit</th>
                 <th>Delete</th>
               </tr>
       <?php
       $sql = "SELECT * FROM add_highest_educ_attainment ORDER BY id ASC";
       $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result)>0){
       while($row = mysqli_fetch_assoc($result)){
       $id =  $row['id'];
       $EA = $row['EducationalAttainment'];
       echo '<tr>
             <td>'.$EA.'</td>
             <td>
                 <a href="edit_highest_educ_attainment.php?edit='.$id.'" class="btn btn-info btn-sm">edit</a>
            </td>
             <td>
                 <a href="add_highest_educ_attainment.php?delete='.$id.'" class="btn btn-danger btn-sm">delete</a>
             </td>
             </tr>';
     }
   }else {
     echo '<center style="color:red;">O Result</center>';
   }

     if (isset($_GET['delete'])) {
       $id = $_GET['delete'];

       $sql = "DELETE FROM add_highest_educ_attainment WHERE id=".$id;
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
