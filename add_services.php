<?php

include 'navs/admin_navs.php';

?>


<div class="container">
  <form action="add_services.php" method="post">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><center>Add Services</center></h4>
      </div>
    <?php
    if (isset($_POST['add'])) {
      $serv=$_POST['serv'];
      if (!empty($serv)) {
        $sql = "INSERT INTO add_services (Services)
                 VALUES ('$serv')";
        $result = mysqli_query($conn,$sql);
      }else {
        echo "<center style='color:red;'>What's new</center>";
      }

    }
     ?>

         <div class="modal-body">

           <textarea class="form-control" rows="5" name="serv" placeholder="What's new..?"></textarea>
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
               <th>Services</th>
               <th>Edit</th>
               <th>Delete</th>
             </tr>

     <?php
     $sql = "SELECT * FROM add_services ORDER BY id ASC";
     $result = mysqli_query($conn, $sql);
      if(mysqli_num_rows($result)>0){
     while($row = mysqli_fetch_assoc($result)){
     $id =  $row['id'];
     $val = $row['Services'];
       echo '<tr>
             <td>'.$val.'</td>
             <td>
                 <a href="edit_services.php?edit='.$id.'" class="btn btn-info btn-sm">edit</a>
            </td>
             <td>
                 <a href="add_services.php?delete='.$id.'" class="btn btn-danger btn-sm">delete</a>
             </td>
             </tr>';
     }
   }else {
     echo '<center style="color:red;">O Result</center>';
   }
     if (isset($_GET['delete'])) {
     $id = $_GET['delete'];

     $sql = "DELETE FROM add_services WHERE id=".$id;
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
