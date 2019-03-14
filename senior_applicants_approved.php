<?php include 'navs/staff_navs.php'; ?>

  <form method="POST" action="<?php htmlspecialchars($_SERVER['PHP_SELF']);?>">


    <div class="container-fluid">
      <div class="header1">
        <h1>Approved Senior Citizen Applicants</h1>
      </div>

  <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for Control Number..">
  <input type="text" id="myInput2" onkeyup="myFunction2()" placeholder="Search for Name..">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="customers" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Control Number</th>
                  <th>Requirements</th>
                  <th>Name</th>
                  <th>Gender</th>
                  <th>ContactNumber</th>
                  <th>Age</th>
                  <th>Address</th>
                  <th>Approved By</th>
                  <th>Delete</th>
                  <th>Send SMS</th>
                  <th>Details</th>
                  <th>Undo</th>
                </tr>
    <?php

    $id = 0;
    $sql = "SELECT * FROM approved_applications JOIN approved_upload_requirements
            ON approved_applications.ControlNumber = approved_upload_requirements.ControlNumber
            JOIN approved_senior_app_detail ON approved_senior_app_detail.ControlNumber = approved_applications.ControlNumber
            JOIN approved_status ON approved_status.ControlNumber = approved_applications.ControlNumber";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
     //output data of each row
    while($row = mysqli_fetch_array($result)) {
      $id=$id+1;


       echo '<tr>
            <td>'.$id.'</td>
            <td>'.$row["ControlNumber"].'</td>
            <td><a href="pdf/'.$row["Requirements"].'" download>'.$row["Requirements"].' <span class="glyphicon glyphicon-download-alt"></span></a></td>
            <td>'.$row["Firstname"].' '.$row["Lastname"].' '.$row["MiddleName"].'</td>
            <td>'.$row["Gender"].'</td>
            <td>'.$row["ContactNumber"].'</td>
            <td>'.$row["Age"].'</td>
            <td>'.$row["Address"].'</td>
            <td>'.$row["ApprovedBy"].'</td>
            <td>
            <a href = "senior_applicants_approved.php?delete='.$row["ControlNumber"].'" class="btn btn-danger">DELETE</a>
            </td>
            <td>
              <a href = "senior_applicants_approved_sendsms.php?sendsms='.$row["ControlNumber"].'" class="btn btn-warning">Send SMS</a>
            </td>
            <td>
              <a href = "senior_applicants_approved_details.php?details='.$row["ControlNumber"].'" class="btn btn-info">DETAILS</a>
            </td>
            <td>
              <a href = "senior_applicants_approved.php?undo='.$row["ControlNumber"].'" class="btn btn-primary">UNDO</a>
            </td>
            </tr>';
      }
    } else {
    echo (mysqli_error($conn))."<h3 style='color:red;'>0 Approved</h3><br>";
  }

  if(isset($_GET['delete'])){

     $id = $_GET['delete'];

        $s ="DELETE FROM approved_status
            WHERE ControlNumber = ".$id;

        $sql = "DELETE FROM approved_applications
                WHERE ControlNumber = ".$id;

        $sql1 = "DELETE FROM disapproved_senior_app_detail
                WHERE ControlNumber = ".$id;

        $sql2 = "DELETE FROM approved_upload_requirements
                WHERE ControlNumber = ".$id;

        $r = mysqli_query($conn,$s);
        $result = mysqli_query($conn,$sql);
        $result1 = mysqli_query($conn,$sql1);
        $result2 = mysqli_query($conn,$sql2);

        if($r && $result && $result1 && $result2){
            echo "<h3 style='color:red;'>Deleted</h3>";
        }
        else {
          echo (mysqli_error($conn))."<h3 style='color:red;'>Error</h3>";
        }

      }

      if(isset($_GET['undo'])){

         $id = $_GET['undo'];

         $sql = "INSERT INTO senior_application
                 SELECT * FROM approved_applications
                 WHERE ControlNumber=".$id;

         $sql1 = "INSERT INTO senior_application_detail
                 SELECT * FROM approved_senior_app_detail
                 WHERE ControlNumber=".$id;

         $sql2 = "INSERT INTO senior_upload_requirements
                 SELECT * FROM approved_upload_requirements
                 WHERE ControlNumber=".$id;

             $result = mysqli_query($conn,$sql);
             $result1 = mysqli_query($conn,$sql1);
             $result2 = mysqli_query($conn,$sql2);

            $s ="DELETE FROM approved_status
                WHERE ControlNumber = ".$id;

            $sql = "DELETE FROM approved_applications
                    WHERE ControlNumber = ".$id;

            $sql1 = "DELETE FROM approved_senior_app_detail
                    WHERE ControlNumber = ".$id;

            $sql2 = "DELETE FROM approved_upload_requirements
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


      mysqli_close($conn);


      ?>
    </tbody>
  </table>
  </div>
  </div>
  </div>


</form>


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
