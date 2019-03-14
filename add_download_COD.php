<?php

include 'navs/admin_navs.php';

?>


<div class="container">

   <form id="regForm" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
     <div class="modal-content">
       <div class="modal-header">
         <h4 class="modal-title"><center>Add Downloadable Files</center></h4>
       </div>
     <?php

     if (isset($_POST['add'])) {

       if (!empty($_FILES['pdf_file']['name'])) {
       $targetDir = 'downloadable/';
       $Requirements=basename($_FILES['pdf_file']['name']);
       $targetFilePath = $targetDir . $Requirements;
       $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
       $allowTypes = array('pdf');

       if(in_array($fileType, $allowTypes))
       {
         if(move_uploaded_file($_FILES['pdf_file']['tmp_name'], $targetFilePath))
         {

           $sql = "INSERT INTO add_dowloadables (Files)
                     VALUES ('$Requirements')";

           $result = mysqli_query($conn, $sql);

                     if (!$result) {
                       echo (mysqli_error($conn));
                     }else {
                       echo (mysqli_error($conn)).'<center style="color:red;">Data Submit Successfully</center>';
                     }
                   }
         }else{
               echo (mysqli_error($conn)).'<center style="color:red;">Requirements Submit Error!!</center>';
             }

      }else{
        echo (mysqli_error($conn)).'<center style="color:red;">Add Requirements</center>';
      }

     }
      ?>


         <div class="modal-body">
           <input type="file" name="pdf_file" accept="application/pdf">
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
                 <th>Downloadable Files</th>
                 <th>Action</th>
               </tr>
       <?php
       $sql = "SELECT * FROM add_dowloadables ORDER BY id ASC";
       $result = mysqli_query($conn, $sql);
       if(mysqli_num_rows($result)>0){
       while($row = mysqli_fetch_assoc($result)){
       $id =  $row['id'];
       $val = $row['Files'];

         echo '<tr>
               <td><a href="downloadable/'.$val.'" style="color:red;" download>'.$val.'</td>
               <td>
                   <center><a href="add_download_COD.php?delete='.$id.'" class="btn btn-danger btn-sm">delete</a></center>
               </td>
               </tr>';
         }
        }else {
         echo '<center style="color:red;">O Result</center>';
        }

       if (isset($_GET['delete'])) {
       $id = $_GET['delete'];

       $sql = "DELETE FROM add_dowloadables WHERE id=".$id;
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
