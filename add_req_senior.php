<?php

include 'navs/admin_navs.php';

?>

<div class="container">
   <form action="add_req_senior.php" method="post">
     <div class="modal-content">
       <div class="modal-header">
         <h4 class="modal-title"><center>Add Senior Citizen Requirements</center></h4>
       </div>
     <?php

     if (isset($_POST['addreq'])) {

       $requirements=$_POST['requirements'];
       if (!empty($requirements)) {
         $sql = "INSERT INTO add_senior_requirements (requirements)
                  VALUES ('$requirements') ";
         $result = mysqli_query($conn,$sql);
       }else {
         echo '<center style="color:red;">Whats new..</center>';
       }

     }
      ?>
         <div class="modal-body">
           <textarea class="form-control" rows="5" name="requirements" placeholder="What's new..?"></textarea>
         </div>
         <div class="modal-footer">
           <button type="submit" class="btn btn-primary" name="addreq">Add</button>
         </div>
       </div><br><br>
       <div class="card-body">
         <div class="table-responsive">
           <table class="table table-bordered" id="customers" width="100%" cellspacing="0">
             <thead>
               <tr>
                 <th>Senior Citizen Requirements</th>
                 <th>Edit</th>
                 <th>Delete</th>
               </tr>
       <?php
       $sql = "SELECT * FROM add_senior_requirements ORDER BY id ASC";
       $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result)>0){
       while($row = mysqli_fetch_assoc($result)){
       $id =  $row['id'];
       $req = $row['requirements'];
       echo '<tr>
             <td>'.$req.'</td>
             <td>
                 <a href="edit_requirements_senior.php?edit='.$id.'" class="btn btn-info btn-sm">edit</a>
            </td>
             <td>
                 <a href="add_req_senior.php?delete='.$id.'" class="btn btn-danger btn-sm">delete</a>
             </td>
             </tr>';

     }
   }else {
     echo '<center style="color:red;">O Result</center>';
   }

     if (isset($_GET['delete'])) {
       $id = $_GET['delete'];

       $sql = "DELETE FROM add_senior_requirements WHERE id=".$id;
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
