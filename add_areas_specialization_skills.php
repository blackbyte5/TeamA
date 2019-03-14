<?php

include 'navs/admin_navs.php';

?>


<div class="container">
  <form action="add_areas_specialization_skills.php" method="post">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><center>Add Areas Specialization/Skills</center></h4>
      </div>
    <?php
    $error='';
    if (isset($_POST['add'])) {
      $ASS=$_POST['ASS'];
      if (!empty($ASS)) {
        $sql = "INSERT INTO add_areas_specialization_skills(SpecializationOrSkills)
                 VALUES ('$ASS') ";
        $result = mysqli_query($conn,$sql);
      }else {
        echo "<center style='color:red;'>What's new</center>";
      }

    }
     ?>
         <div class="modal-body">
           <textarea class="form-control" rows="5" name="ASS" placeholder="What's new..?"></textarea>
         </div>
         <div class="modal-footer">
           <button type="submit" class="btn btn-primary" name="add">Add</button>
         </div>
       </div>
     <br><br>
     <div class="card-body">
       <div class="table-responsive">
         <table class="table table-bordered" id="customers" width="100%" cellspacing="0">
           <thead>
             <tr>
               <th>Areas of Specialization/Skills</th>
               <th>Edit</th>
               <th>Delete</th>
             </tr>

     <?php
     $sql = "SELECT * FROM add_areas_specialization_skills ORDER BY id ASC";
     $result = mysqli_query($conn, $sql);
      if(mysqli_num_rows($result)>0){
     while($row = mysqli_fetch_assoc($result)){
     $id =  $row['id'];
     $val = $row['SpecializationOrSkills'];
       echo '<tr>
             <td>'.$val.'</td>
             <td>
                 <a href="edit_areas_specialization_skills.php?edit='.$id.'" class="btn btn-info btn-sm">edit</a>
            </td>
             <td>
                 <a href="add_areas_specialization_skills.php?delete='.$id.'" class="btn btn-danger btn-sm">delete</a>
             </td>
             </tr>';
     }
   }else {
     echo '<center style="color:red;">O Result</center>';
   }
     if (isset($_GET['delete'])) {
     $id = $_GET['delete'];

     $sql = "DELETE FROM add_areas_specialization_skills WHERE id=".$id;
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
