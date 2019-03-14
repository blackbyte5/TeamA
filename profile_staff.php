<?php include 'navs/staff_navs.php'; ?>

<div class="container" style="margin-top:80px">
  <?php
  if (isset($_GET['info'])) {
    $id = $_GET['info'];
    $sql = "SELECT * FROM employee WHERE Employee_ID='$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $empid = $row['Employee_ID'];
    $name = $row['Firstname'].' '.$row['MiddleName'].' '.$row['Lastname'];
    $contact = $row['Contact'];
    $address = $row['Address'];
    $position = $row['Position'];
  }
  ?>
  <center>
    <img src="others/profile1.png" height="100" width="100"><br>
    <?php echo $empid;?>
    <br><strong>ID</strong>
  </center>
  <div>
    <strong>Name: </strong><?php echo $name;?><br>
    <strong>Position: </strong><?php echo $position;?><br>
    <strong>Contact Number: </strong><?php echo $contact;?><br>
    <strong>Address: </strong><?php echo $address;?><br><br><br>
    <?php
    $sql = "SELECT * FROM employee";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $id = $row['Employee_ID'];

     ?>
    <a href="profile_staff_edit.php?edit=<?php echo $id?>" class="btn btn-primary">Edit Info</a>
  </div>
</div>

</body>
</html>
