<?php include 'navs/staff_navs.php'; ?>

  <form method="POST" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>">

        <div class="container-fluid">
          <div class="header1">
            <h1>Senior Citizen Applicants</h1>
          </div>
          <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for Control Number..">
          <input type="text" id="myInput2" onkeyup="myFunction2()" placeholder="Search for Name..">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="customers" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th></th>
                      <th>ControlNumber</th>
                      <th>Requirements</th>
                      <th>Name</th>
                      <th>Gender</th>
                      <th>ContactNumber</th>
                      <th>Age</th>
                      <th>Address</th>
                      <th>Date Fill-up</th>
                      <th>Send SMS</th>
                      <th>Approve</th>
                      <th>Disapprove</th>
                      <th>Details</th>
                      <th>Delete</th>
                    </tr>

    <?php
    $id = 0;
    $sql = "SELECT * FROM senior_application JOIN senior_upload_requirements
            ON senior_application.ControlNumber = senior_upload_requirements.ControlNumber
            JOIN senior_application_detail ON senior_application_detail.ControlNumber = senior_application.ControlNumber ORDER BY DateFillUp ASC";

    $result = mysqli_query($conn, $sql);


    if (mysqli_num_rows($result) > 0) {
     //output data of each row
    while($row = mysqli_fetch_array($result)) {
      $id=$id+1;


       echo '<tr>
            <td>num:'.$id.'</td>
            <td>'.$row["ControlNumber"].'</td>
            <td><a href="pdf/'.$row["Requirements"].'" target="_blank">'.$row["Requirements"].' <span class="glyphicon glyphicon-open-file"></span></a></td>
            <td>'.$row["Firstname"].' '.$row["Lastname"].' '.$row["MiddleName"].'</td>
            <td>'.$row["Gender"].'</td>
            <td>'.$row["ContactNumber"].'</td>
            <td>'.$row["Age"].'</td>
            <td>'.$row["Address"].'</td>
            <td>'.$row["DateFillUp"].'</td>
            <td>
              <a href = "senior_applicants_sendsms.php?sendsms='.$row["ControlNumber"].'" class="btn btn-warning">Send SMS</a>
            </td>
            <td>
              <a href = "senior_applicants.php?approve='.$row["ControlNumber"].'" class="btn btn-success">APPROVE</a>
            </td>
            <td>
              <a href = "senior_applicants.php?disapprove='.$row["ControlNumber"].'" class="btn btn-primary">DISAPPROVE</a>
            </td>
            <td>
              <a href = "senior_applicants_details.php?details='.$row["ControlNumber"].'" class="btn btn-info">DETAILS</a>
            </td>
            <td>
              <a href = "senior_applicants.php?delete='.$row["ControlNumber"].'" class="btn btn-danger">DELETE</a>
            </td>
            </tr>';
      }
    } else {
    echo (mysqli_error($conn))."<h3 style='color:red;'>0 Applicants</h3><br>";
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
                SELECT * FROM senior_application
                WHERE ControlNumber=".$id;

        $sql1 = "INSERT INTO approved_senior_app_detail
                SELECT * FROM senior_application_detail
                WHERE ControlNumber=".$id;

        $sql2 = "INSERT INTO approved_upload_requirements
                SELECT * FROM senior_upload_requirements
                WHERE ControlNumber=".$id;

            $resul = mysqli_query($conn,$sq);
            $result = mysqli_query($conn,$sql);
            $result1 = mysqli_query($conn,$sql1);
            $result2 = mysqli_query($conn,$sql2);


            if($resul && $result && $result1 && $result2){
                echo "<h3 style='color:red;'>Record Approve</h3>";
            }
            else {
              echo (mysqli_error($conn))."<br><h3 style='color:red;'>Cann't Make Action</h3>";
            }

            $del = "DELETE FROM senior_application
                   WHERE ControlNumber = ".$id;

            $del1 = "DELETE FROM senior_application_detail
                   WHERE ControlNumber = ".$id;

            $del2 = "DELETE FROM senior_upload_requirements
                   WHERE ControlNumber = ".$id;

            $delresult = mysqli_query($conn,$del);
            $delresult1 = mysqli_query($conn,$del1);
            $delresult2 = mysqli_query($conn,$del2);
}



//--------------------------------------------------------DISAPPROVE---------------------------
       if(isset($_GET['disapprove'])){

        $id = $_GET['disapprove'];
        if(isset($_SESSION['username'])){
          $username = $_SESSION['username'];
          $sql = "SELECT * FROM user_staff WHERE Username = '$username'";
          $result = mysqli_query($conn, $sql);
          $row = mysqli_fetch_assoc($result);

            $staffname = $row["Firstname"] .' '. $row["Lastname"];
           }
        $sq = "INSERT INTO disapproved_status (ControlNumber, DisapprovedBy) Values ('$id','$staffname')";

        $sql = "INSERT INTO disapproved_applications
                SELECT * FROM senior_application
                WHERE ControlNumber = ".$id;

        $sql1 = "INSERT INTO disapproved_senior_app_detail
                SELECT * FROM senior_application_detail
                WHERE ControlNumber = ".$id;

        $sql2 = "INSERT INTO disapproved_upload_requirements
                SELECT * FROM senior_upload_requirements
                WHERE ControlNumber = ".$id;

        $resul = mysqli_query($conn,$sq);
        $result = mysqli_query($conn,$sql);
        $result1 = mysqli_query($conn,$sql1);
        $result2 = mysqli_query($conn,$sql2);

      if($resul && $result && $result1 && $result2){
              echo "<h3 style='color:red;'>Record Disapprove</h3><br>";
              //header("Refresh:0; url=applicants_pwd_disapproved.php");
        }
        else {
               echo (mysqli_error($conn))."<br><h3 style='color:red;'>Cann't Make Action</h3>";
        }

        $del = "DELETE FROM senior_application
               WHERE ControlNumber = ".$id;

        $del1 = "DELETE FROM senior_application_detail
               WHERE ControlNumber = ".$id;

        $del2 = "DELETE FROM senior_upload_requirements
               WHERE ControlNumber = ".$id;

        $delresult = mysqli_query($conn,$del);
        $delresult1 = mysqli_query($conn,$del1);
        $delresult2 = mysqli_query($conn,$del2);
}


if (isset($_GET['delete'])) {
  //---------------------------------------------Delete---------------------------------
     $sql = "DELETE FROM senior_application
            WHERE ControlNumber = ".$id;

     $sql1 = "DELETE FROM senior_application_detail
            WHERE ControlNumber = ".$id;

     $sql2 = "DELETE FROM senior_upload_requirements
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

     mysqli_close($conn);


      ?>

    </tbody>
  </table>
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
  <script>
  function myFunction() {
    var x = document.getElementById("Demo");
    if (x.className.indexOf("w3-show") == -1) {
      x.className += " w3-show";
    } else {
      x.className = x.className.replace(" w3-show", "");
    }
  }
  function myFunction1() {
    var x = document.getElementById("Demo1");
    if (x.className.indexOf("w3-show") == -1) {
      x.className += " w3-show";
    } else {
      x.className = x.className.replace(" w3-show", "");
    }
  }
  function myFunctions() {
    var x = document.getElementById("Demos");
    if (x.className.indexOf("w3-show") == -1) {
      x.className += " w3-show";
    } else {
      x.className = x.className.replace(" w3-show", "");
    }
  }
  function myFunction3() {
    var x = document.getElementById("Demo3");
    if (x.className.indexOf("w3-show") == -1) {
      x.className += " w3-show";
    } else {
      x.className = x.className.replace(" w3-show", "");
    }
  }
  function myFunction5() {
    var x = document.getElementById("Demo5");
    if (x.className.indexOf("w3-show") == -1) {
      x.className += " w3-show";
    } else {
      x.className = x.className.replace(" w3-show", "");
    }
  }
  </script>
  </div>
</div>

</body>
</html>
