<?php include 'navs/staff_navs.php'; ?>

<!-- Multistep Form -->
  <form id="regForm" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
  <div id="first">
    <center>
    <img src="others/dsws.png" height="85" width="85">
    <h2 class="title">Monitoring Requirements</h2>
    <div class="error">
      <?php
      $ctrl_num='';
      $name='';
      $age='';
      $Gender='';

      $StaffName='';
      $status='';

      if(isset($_SESSION['username'])){
              $username = $_SESSION['username'];
              $sql = "SELECT * FROM user_staff WHERE Username = '$username'";
              $result = mysqli_query($conn, $sql);
              $row = mysqli_fetch_assoc($result);
                $StaffName= $row["Firstname"] .' '. $row["Middle_Name"].' '. $row["Lastname"];
               }

      if (isset($_GET['checkreq'])) {
        $id =$_GET['checkreq'];

        $sql ="SELECT * FROM pwd_application WHERE ControlNumber='$id'";
        $result=mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($result);

        $ctrl_num = $row['ControlNumber'];
        $name = $row['Firstname'].' '.$row['Lastname'].' '.$row['MiddleName'];
        $age = $row['Age'];
        $Gender = $row['Gender'];
      }

      if (isset($_POST['save'])) {
        $ctrl_num=$_POST['ctrl_num'];
        $name =$_POST['name'];
        $age=$_POST['age'];
        $Gender=$_POST['Gender'];

        $req_monitoring = array();
        if(isset($_POST['req_monitoring']))
        $req_monitoring=implode(', ', $_POST['req_monitoring']);

        $date=$_POST['date'];
        $StaffName=$_POST['StaffName'];
        $status=$_POST['status'];


        $sql="INSERT INTO pwd_requirements_monitoring (ControlNumber, Name, Age, Gender, RequirementsDescription, DateCheckOrUpdate, CheckBy, Status)
              VALUES ('$ctrl_num', '$name', '$age', '$Gender', '$req_monitoring', '$date', '$StaffName','$status')";
        $result = mysqli_query($conn,$sql);

        if ($result) {
          echo "Requirements Check";
        }else {
          echo "Error: ".(mysqli_error($conn));
        }

      }

      if (isset($_POST['searchname'])) {


        $sql="SELECT * FROM pwd_requirements_monitoring WHERE Name='$name'";
        $result=mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($result);

        $ctrl_num=$row['ControlNumber'];
        $name =$row['Name'];
        $age=$row['Age'];
        $Gender=$row['Gender'];

        $req_monitoring=explode(', ', $row['RequirementsDescription']);

        $StaffName=$row['CheckBy'];
        $status=$row['Status'];

        if ($result) {
          echo "";
        }else {
          echo "No display".(mysqli_error($conn));
        }


      }



      ?>
    </div>
  </center><br><br>
  <div class="form-inline">
    <select class="form-control" name="typeserve">
        <option value="">Type of Service</option>
        <?php
        $sql = "SELECT * FROM add_services";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)){
        $serv= $row['Services'];

         echo '<option value="'.$serv.'"> '.$serv.'</option>';
       }
       ?>
    </select><br><br>
    <button type="button" class="btn btn-info">
          <span class="glyphicon glyphicon-search"></span>
    </button>
    <input type="text" class="form-control"  name="name" placeholder="Search for name.." value="<?php echo $name;?>">
    <button type="button" name="searchname"class="btn btn-info">
          <span class="glyphicon glyphicon-search"></span>
    </button>
    <input type="text" class="form-control"  name="ctrl_num" placeholder="Search Control Number.." value="<?php echo $ctrl_num;?>">
    <br><br>
    <input type="text" class="form-control"  name="StaffName" value="<?php echo $StaffName;?>" readonly>
    <input type="text" class="form-control"  name="date" value="<?php echo date('M d, Y');?>" readonly>
  </div><br><br>
  <div class="form-inline">
    <input type="text" class="form-control"  name="age" value="<?php echo $age;?>" readonly>
    <input type="text" class="form-control"  name="Gender" value="<?php echo $Gender;?>" readonly><br><br>
    <select class="form-control" name="status">
        <option value="">Status</option>
        <option value="Complete" <?php if($status=='Complete'){echo "selected";}?>>Complete</option>
        <option value="Incomplete" <?php if($status=='Incomplete'){echo "selected";}?>>Incomplete</option><br>
    </select>
    </div><br><br>


          <label class="checkbox-inline">
              <input type="checkbox" value="CERTIFICATE OF DISABILITY" name="req_monitoring[]">CERTIFICATE OF DISABILITY
          </label><br>
          <label class="checkbox-inline">
              <input type="checkbox" value="UPDATED VOTERS CERTIFICATION" name="req_monitoring[]">UPDATED VOTERS CERTIFICATION
          </label><br>
          <label class="checkbox-inline">
              <input type="checkbox" value="Mother or Fathers voters certification" name="req_monitoring[]">Mother or Fathers voters certification
          </label><br>
          <label class="checkbox-inline">
              <input type="checkbox" value="Barangay Point Person (BMO) endorsement or the Barangay Officials in the Barangay." name="req_monitoring[]">Barangay Point Person (BMO) endorsement or the Barangay Officials in the Barangay.
          </label><br>
          <label class="checkbox-inline">
              <input type="checkbox" value="Xerox birth certificatet of minors" name="req_monitoring[]">Xerox birth certificatet of minors
          </label><br>
          <label class="checkbox-inline">
              <input type="checkbox" value="Attach the 1x1 I.D picture(1 pc.)" name="req_monitoring[]">Attach the 1x1 I.D picture(1 pc.)
          </label><br>
          <label class="checkbox-inline">
              <input type="checkbox" value="2x2 I.D picture (1 pc.)" name="req_monitoring[]">2x2 I.D picture (1 pc.)
          </label><br><br>';

    <input class="btn btn-primary" name="save" type="submit" value="Save">
    <input class="btn btn-danger" name="update" type="submit" value="Update">

  </div>

</form>
</body>
</html>
