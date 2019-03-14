<?php include 'navs/admin_navs.php'; ?>
    <center>
          <div class="example">
          <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
<div class="error">
<?php

if(isset($_SESSION['username'])){
        $username = $_SESSION['username'];
        $sql = "SELECT * FROM user_admin WHERE Username = '$username'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $admin_id = $row['user_id_admin'];
        $lname= $row['Lastname'];
        $mname= $row['Middle_Name'];
        $fname= $row['Firstname'];
//---------------------------------------------------------------
        if(isset($_POST['share'])){
          date_default_timezone_set('Singapore');

          $name = $_POST['announce_publish'];
          $date = $_POST['date'];
          $announce = $_POST['announce'];
          $admin_id = $_POST['admin_id'];

          if (empty($announce)){
            echo "What's your Announcements";
          }
          else {
            $sql = "INSERT INTO Announcements (user_staff_id, Name_Publisher, Date_Announce, Announcement)
            VALUES ('$admin_id', '$name', '$date', '$announce')";
            $result = mysqli_query($conn, $sql);
            header("Refresh:1; url=announcements_admin.php");

              if (!$result) {
                echo "No Action";
              }else {
                echo "Success..";
              }
          }
        }
}
 ?>
</div>
              <input type="hidden" name="admin_id" class="form-control" value="<?php echo $admin_id;?>">
              <input type="hidden" name="announce_publish" class="form-control" value="<?php echo $fname.' '.$mname.' '.$lname.'(Admin)';?>">
              <input type="hidden" name="date" class="form-control" value="<?php date_default_timezone_set('Singapore'); echo date('Y-m-d h:i:s')?>">
              <br><textarea class="form-control" rows="5" name="announce" placeholder="What's new..? <?php echo $fname.' '.$mname.' '.$lname.'(Admin)';?>"></textarea><br>
              <input type="submit" name="share" class="btn btn-primary" value="SHARE">
            </div>
          </form>
      </center>



  <?php
  if(isset($_SESSION['username'])){
          $username = $_SESSION['username'];
          $sql = "SELECT * FROM user_admin WHERE Username = '$username'";
          $result = mysqli_query($conn, $sql);
          $row = mysqli_fetch_assoc($result);
          $admin_id = $row['user_id_admin'];

              $sql = "SELECT * FROM Announcements WHERE user_staff_id = '$admin_id' ORDER BY Announce_id DESC";
              $result = mysqli_query($conn, $sql);
              mysqli_num_rows($result);
              while($row = mysqli_fetch_assoc($result)){
              echo "<div class='example'>";
              $id = $row['Announce_id'];
              $name = $row['Name_Publisher'];
              $date = date('M d,Y',strtotime($row ['Date_Announce']));
              $time = date('h:i a',strtotime($row ['Date_Announce']));
              $announce = $row['Announcement'];


              echo '<h3>'.$name.'</h3>';
              echo '<p style="font-size: 12px;">'.$date.' at '.$time.'</p>';
              echo "<a href='announcements_admin.php?delete=$id' class='btn btn-danger'>Delete</a> ";
              echo "<a href='announcements_edit_admin.php?edit=$id' class='btn btn-primary'>Edit</a><br><br>";
              echo '<p>'.$announce.'</p>';
              echo "</div>";

            }

    if (isset($_GET['delete'])) {
      $id = $_GET['delete'];

      $sql = "DELETE FROM Announcements WHERE Announce_id=".$id;
      $result = mysqli_query($conn, $sql);

    }
}

  ?>

</body>
</html>
