<?php include 'navs/staff_navs.php'; ?>

<form method="POST" action="<?php htmlspecialchars($_SERVER['PHP_SELF']);?>">

  <div class="container-fluid">
    <div class="header1">
      <h1>Dispproved Senior Citizen Applicants</h1>
    </div>
    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for Control Number..">
    <input type="text" id="myInput2" onkeyup="myFunction2()" placeholder="Search for Name..">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="customers" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>ID</th>
                <th>ControlNumber</th>
                <th>Requirements</th>
                <th>Name</th>
                <th>Gender</th>
                <th>ContactNumber</th>
                <th>Age</th>
                <th>Address</th>
                <th>Disapproved By</th>
                <th>Delete</th>
                <th>Approve</th>
                <th>Send SMS</th>
                <th>Details</th>
                <th>Undo</th>
              </tr>
  <?php

  $id = 0;
  $sql = "SELECT * FROM disapproved_applications JOIN disapproved_upload_requirements
          ON disapproved_applications.ControlNumber = disapproved_upload_requirements.ControlNumber
          JOIN disapproved_senior_app_detail ON disapproved_senior_app_detail.ControlNumber = disapproved_applications.ControlNumber
          JOIN disapproved_status ON disapproved_status.ControlNumber = disapproved_applications.ControlNumber";

  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
   //output data of each row
  while($row = mysqli_fetch_array($result)) {
    $id=$id+1;


     echo '<tr>
          <td>'.$id.'</td>
          <td>'.$row["ControlNumber"].'</td>
          <td><a href="pdf/'.$row["Requirements"].'" target="_blank">'.$row["Requirements"].' <span class="glyphicon glyphicon-open-file"></span></td>
          <td>'.$row["Firstname"].' '.$row["Lastname"].' '.$row["MiddleName"].'</td>
          <td>'.$row["Gender"].'</td>
          <td>'.$row["ContactNumber"].'</td>
          <td>'.$row["Age"].'</td>
          <td>'.$row["Address"].'</td>
          <td>'.$row["DisapprovedBy"].'</td>
          <td>
            <a href = "senior_applicants_disapproved.php?delete='.$row["ControlNumber"].'" class="btn btn-danger">DELETE</a>
          </td>
          <td>
            <a href = "senior_applicants_disapproved.php?approve='.$row["ControlNumber"].'" class="btn btn-success">APPROVE</a>
          </td>
          <td>
            <a href = "senior_applicants_disapproved_sendsms.php?sendsms='.$row["ControlNumber"].'" class="btn btn-warning">Send SMS</a>
          </td>
          <td>
            <a href = "senior_applicants_disapproved_details.php?details='.$row["ControlNumber"].'" class="btn btn-info">DETAILS</a>
          </td>
          <td>
            <a href = "senior_applicants_disapproved.php?undo='.$row["ControlNumber"].'" class="btn btn-primary">UNDO</a>
          </td>
          </tr>';
    }
  } else {
  echo (mysqli_error($conn))."<h3 style='color:red;'>0 Disapproved</h3><br>";
}

//----------------------------------------------------APPROVE-------------------
     if(isset($_GET['approve'])){

        $id = $_GET['approve'];
        if(isset($_SESSION['username'])){
          $username = $_SESSION['username'];
          $sql = "SELECT * FROM user_staff WHERE Username = '$username'";
          $result = mysqli_query($conn, $sql);
          $row = mysqli_fetch_assoc($result);

            $staffname = $row["Firstname"] .' '. $row["Lastname"];
           }
        $sq = "INSERT INTO approved_status (ControlNumber, ApprovedBy) Values ('$id','$staffname')";

        $sql = "INSERT INTO approved_applications
                SELECT * FROM disapproved_applications
                WHERE ControlNumber = ".$id;

        $sql1 = "INSERT INTO approved_pwd_app_detail
                SELECT * FROM disapproved_pwd_app_detail
                WHERE ControlNumber = ".$id;

        $sql2 = "INSERT INTO approved_upload_requirements
                SELECT * FROM disapproved_upload_requirements
                WHERE ControlNumber = ".$id;

        $resul = mysqli_query($conn,$sq);
        $result = mysqli_query($conn,$sql);
        $result1 = mysqli_query($conn,$sql1);
        $result2 = mysqli_query($conn,$sql2);

          if($resul && $result && $result1 && $result2){
            echo "<h3 style='color:red;'>Record Successfuly Approve</h3><br>";
        }
        else {
          echo (mysqli_error($conn))."<br>Cann't Make Action";
        }


           $sql = "DELETE FROM disapproved_applications
                   WHERE ControlNumber = ".$id;

           $sql1 = "DELETE FROM disapproved_pwd_app_detail
                   WHERE ControlNumber = ".$id;

           $sql2 = "DELETE FROM disapproved_upload_requirements
                   WHERE ControlNumber = ".$id;


          $result = mysqli_query($conn,$sql);
          $result1 = mysqli_query($conn,$sql1);
          $result2 = mysqli_query($conn,$sql2);

          if($result && $result1 && $result2){
               echo "";
           }
           else {
             echo (mysqli_error($conn));
           }

         }

         if(isset($_GET['undo'])){

            $id = $_GET['undo'];

            $sql = "INSERT INTO senior_application
                    SELECT * FROM disapproved_applications
                    WHERE ControlNumber=".$id;

            $sql1 = "INSERT INTO senior_application_detail
                    SELECT * FROM disapproved_senior_app_detail
                    WHERE ControlNumber=".$id;

            $sql2 = "INSERT INTO senior_upload_requirements
                    SELECT * FROM disapproved_upload_requirements
                    WHERE ControlNumber=".$id;

                $result = mysqli_query($conn,$sql);
                $result1 = mysqli_query($conn,$sql1);
                $result2 = mysqli_query($conn,$sql2);

               $s ="DELETE FROM disapproved_status
                   WHERE ControlNumber = ".$id;

               $sql = "DELETE FROM disapproved_applications
                       WHERE ControlNumber = ".$id;

               $sql1 = "DELETE FROM disapproved_senior_app_detail
                       WHERE ControlNumber = ".$id;

               $sql2 = "DELETE FROM disapproved_upload_requirements
                       WHERE ControlNumber = ".$id;

               $r = mysqli_query($conn,$s);
               $result = mysqli_query($conn,$sql);
               $result1 = mysqli_query($conn,$sql1);
               $result2 = mysqli_query($conn,$sql2);

               if($r && $result && $result1 && $result2){
                   echo "<h3 style='color:red;'>Record Undo</h3>";
               }
               else {
                 echo (mysqli_error($conn))."<h3 style='color:red;'>Error</h3>";
               }

             }
//---------------------------------------------------------------UNDO--------------------------
if(isset($_GET['delete'])){

   $id = $_GET['delete'];


   $sql = "DELETE FROM disapproved_applications
           WHERE ControlNumber = ".$id;

   $sql1 = "DELETE FROM disapproved_pwd_app_detail
           WHERE ControlNumber = ".$id;

   $sql2 = "DELETE FROM disapproved_upload_requirements
           WHERE ControlNumber = ".$id;


      $result = mysqli_query($conn,$sql);
      $result1 = mysqli_query($conn,$sql1);
      $result2 = mysqli_query($conn,$sql2);

      if($result && $result1 && $result2){
          echo "<h3 style='color:red;'>Record Delete</h3><br>";
      }
      else {
        echo (mysqli_error($conn))."<br>Cann't Make Action";
      }

    }

mysqli_close($conn);


    ?>
  </tbody>
</table>
</div>
</div>
</form>
</div>

<script>


function myFunction() {
// Declare variables
var input, filter, table, tr, td, i, txtValue;
input = document.getElementById("myInput");
filter = input.value.toUpperCase();
table = document.getElementById("customers");
tr = table.getElementsByTagName("tr");

// Loop through all table rows, and hide those who don't match the search query
for (i = 0; i < tr.length; i++) {
  td = tr[i].getElementsByTagName("td")[1];
  if (td) {
    txtValue = td.textContent || td.innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      tr[i].style.display = "";
    } else {
      tr[i].style.display = "none";
    }
  }
}
}
function myFunction2() {
// Declare variables
var input, filter, table, tr, td, i, txtValue;
input = document.getElementById("myInput2");
filter = input.value.toUpperCase();
table = document.getElementById("customers");
tr = table.getElementsByTagName("tr");

// Loop through all table rows, and hide those who don't match the search query
for (i = 0; i < tr.length; i++) {
  td = tr[i].getElementsByTagName("td")[4];
  if (td) {
    txtValue = td.textContent || td.innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      tr[i].style.display = "";
    } else {
      tr[i].style.display = "none";
    }
  }
}
}
</script>
</div>
</div>

</body>
</html>
