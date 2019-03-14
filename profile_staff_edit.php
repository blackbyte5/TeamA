<?php include 'navs/staff_navs.php'; ?>

<div class="container" style="margin-top:80px">
  <form class="" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
  <?php
  if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $sql = "SELECT * FROM employee WHERE Employee_ID='$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $empid = $row['Employee_ID'];
    $fname = $row['Firstname'];
    $mname =$row['MiddleName'];
    $lname = $row['Lastname'];
    $contact = $row['Contact'];
    $address = $row['Address'];
    $position = $row['Position'];
  }

  if(isset($_POST['update'])){
    $empid = $_POST['empid'];
    $fname = $_POST['fname'];
    $mname= $_POST['mname'];
    $lname = $_POST['lname'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $position = $_POST['position'];

      $sql = "UPDATE employee SET Lastname='$lname', Firstname='$fname', MiddleName='$mname', Contact='$contact', Address='$address', Position='$position'
              WHERE Employee_ID=".$empid;
      $result = mysqli_query($conn, $sql);

      if ($result) {
        echo "Successfuly Update";
      }else {
        echo "No Action";

      }
    }
  ?>
  <center>

      <img src="others/profile1.png" height="100" width="100"><br>
      <?php echo $empid;?>
      <br><strong>ID</strong>
    </center><br><br><br>
  <div class="form-inline">
      <input type="hidden " name="empid" class="form-control" value="<?php echo $empid;?>" readonly><br>
      <input type="text" name="fname" class="form-control" value="<?php echo $fname;?>">
      <input type="text" name="mname" class="form-control" value="<?php echo $mname;?>">
      <input type="text" name="lname" class="form-control" value="<?php echo $lname;?>">
  </div><br><br>
  <input type="text" name="position" class="form-control" value="<?php echo $position;?>">
  <input type="text" name="contact" class="form-control" value="<?php echo $contact;?>">
  <input type="text" name="address" class="form-control" value="<?php echo $address;?>">
      <br><br><button type="submit" name="update" class="btn btn-primary">Update</button>
    </form>

</div>
