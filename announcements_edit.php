<?php include 'navs/staff_navs.php'; ?>


<div class="container-fluid">
  <div class="row content">
    <div class="example">
    <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
      <center><h2>Edit Announcements</h2><center>
      <div class="error">
      <?php
      $announce='';
      if (isset($_GET['edit'])) {
        $id = $_GET['edit'];

        $sql = "SELECT * FROM announcements WHERE Announce_id=".$id;
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        $id = $row['Announce_id'];
        $staff_id = $row['user_staff_id'];
        $name = $row['Name_Publisher'];
        $announce = $row['Announcement'];

        }


      if (isset($_POST['update'])) {
        $staff_id = $_POST['staff_id'];
        $announce_publish = $_POST['announce_publish'];
        $date = $_POST['date'];
        $announc = $_POST['announc'];

        $sql = "UPDATE Announcements SET user_staff_id='$staff_id', Name_Publisher='$announce_publish', Date_Announce='$date', Announcement='$announc'
                WHERE Announce_id='$id'";
        $result = mysqli_query($conn, $sql);

          if (!$result) {
            echo "No Action";
          }else {
            echo "Announcement Successfuly Update";
          }
      }
      ?>
    </div>
        <input type="hidden" name="staff_id" class="form-control" value="<?php echo $id;?>">
        <input type="hidden" name="staff_id" class="form-control" value="<?php echo $staff_id;?>">
        <input type="hidden" name="announce_publish" class="form-control" value="<?php echo $name;?>">
        <input type="hidden" name="date" class="form-control" value="<?php date_default_timezone_set('Singapore'); echo date('Y-m-d h:i:s');?>">

        <br><textarea class="form-control" rows="15" name="announc"><?php echo $announce;?></textarea><br>
        <input type="submit" name="update" class="btn btn-primary" value="UPDATE">
    </form>
    </div>
  </div>
</div>
</body>
</html>
