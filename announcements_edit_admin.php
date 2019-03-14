<?php

include 'navs/admin_navs.php';

?>

<div class="container-fluid">
  <div class="row content">
    <div class="example">
    <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
      <center><h2>Edit Announcements</h2><center>
      <div class="error">
      <?php
      if (isset($_GET['edit'])) {
        $id = $_GET['edit'];

        $sql = "SELECT * FROM announcements WHERE Announce_id=".$id;
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        $id = $row['Announce_id'];
        $iduser = $row['user_staff_id'];
        $name = $row['Name_Publisher'];
        $announce = $row['Announcement'];

        }


      if (isset($_POST['update'])) {
        $iduser = $_POST['iduser'];
        $announce_publish = $_POST['announce_publish'];
        $date = $_POST['date'];
        $announce = $_POST['announce'];

        $sql = "UPDATE Announcements SET user_staff_id='$iduser', Name_Publisher='$announce_publish', Date_Announce='$date', Announcement='$announce'
                WHERE Announce_id='$id'";
        $result = mysqli_query($conn, $sql);
        header("Refresh:0; url=announcements_admin.php");
          if (!$result) {
            echo "No Action";
          }else {
            echo "Announcement Successfuly Update";
          }
      }
      ?>
    </div>
        <input type="hidden" name="adminID" class="form-control" value="<?php echo $id;?>">
        <input type="hidden" name="iduser" class="form-control" value="<?php echo $iduser;?>">
        <input type="hidden" name="announce_publish" class="form-control" value="<?php echo $name;?>">
        <input type="hidden" name="date" class="form-control" value="<?php date_default_timezone_set('Singapore'); echo date('Y-m-d h:i:s');?>">

        <br><textarea class="form-control" rows="15" name="announce"><?php echo $announce;?></textarea><br>
        <input type="submit" name="update" class="btn btn-primary" value="UPDATE">
    </form>
    </div>
  </div>
</div>
</body>
</html>
