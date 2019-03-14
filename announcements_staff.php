<?php include 'navs/staff_navs.php'; ?>


<div class="container-fluid fixed-top">
  <div class="row content">
<center>
<div class="example">
<form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
<div class="error">
<?php

if(isset($_SESSION['username'])){
        $username = $_SESSION['username'];
        $sql = "SELECT * FROM user_staff WHERE Username = '$username'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $staff_id = $row['user_staff_id'];
        $lname= $row['Lastname'];
        $fname= $row['Firstname'];

        if(isset($_POST['share'])){
          date_default_timezone_set('Singapore');

          $name = $_POST['announce_publish'];
          $date = $_POST['date'];
          $announce = $_POST['announce'];
          $staff_id = $_POST['staff_id'];

          if (empty($announce)){
            echo "What's your Announcements";
          }
          else {
            $sql = "INSERT INTO announcements (user_staff_id, Name_Publisher, Date_Announce, Announcement)
            VALUES ('$staff_id', '$name', '$date', '$announce')";
            $result = mysqli_query($conn, $sql);

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
              <input type="hidden" name="staff_id" class="form-control" value="<?php echo $staff_id;?>">
              <input type="hidden" name="announce_publish" class="form-control" value="<?php echo $fname.' '.$lname;?>">
              <input type="hidden" name="date" class="form-control" value="<?php date_default_timezone_set('Singapore'); echo date('Y-m-d h:i:s')?>">
              <br><textarea class="form-control" rows="5" name="announce" placeholder="What's new..? <?php echo $fname.' '.$lname;?>"></textarea><br>
              <input type="submit" name="share" class="btn btn-primary" value="SHARE">

          </center>



  <?php
  if(isset($_SESSION['username'])){
          $username = $_SESSION['username'];
          $sql = "SELECT * FROM user_staff WHERE Username = '$username'";
          $result = mysqli_query($conn, $sql);
          $row = mysqli_fetch_assoc($result);
          $staff_id = $row['user_staff_id'];

              $sql = "SELECT * FROM announcements WHERE user_staff_id = '$staff_id' ORDER BY Announce_id DESC";
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
              echo "<a href='announcements_staff.php?delete=$id' class='btn btn-danger'>Delete</a> ";
              echo "<a href='announcements_edit.php?edit=$id' class='btn btn-primary'>Edit</a><br><br>";
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
</form>

</div>
</div>
</body>
</html>
