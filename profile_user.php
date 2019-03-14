<?php include 'navs/user_navs.php'; ?>

<div class="bg-text"><br><br>

  <?php
  //*************************************************** SIGN-UP *****************************************

  if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
    $sql = "SELECT * FROM user_client WHERE (Email = '$username' OR Username = '$username')";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $id = $row['user_id'];
    $lname = $row['Lastname'];
    $fname = $row['Firstname'];
    $mname = $row['MiddleName'];
    $bday = $row['Birthday'];
    $address = $row['Address'];
    $Gender = $row['Gender'];
    $email = $row['Email'];
    $username = $row['Username'];
    }


      ?>
  <center>
  <img src="others/dsws.png" height="75" width="85"><br><br>
  <?php echo '<i><u>'.$fname." ".$mname." ".$lname.'</u></i><br><strong>NAME</strong>';?><br>
  <br><br>
  </center>
  <?php echo '<strong>Birthday:</strong> <i><u>'.$bday.'</u></i>';?><br>
  <?php echo '<strong>Address:</strong> <i><u>'.$address.'</u></i>';?><br>
  <?php echo '<strong>Gender:</strong> <i><u>'.$Gender.'</u></i>';?><br>
  <?php echo '<strong>Email:</strong> <i><u>'.$email.'</u></i>';?><br>
  <?php echo '<strong>Username:</strong> <i><u>'.$username.'</u></i>';?><br><br>
  <?php echo '<a href="profile_user_edit.php?edit='.$id.'" class="btn btn-primary"> Edit Info</a>' ?>
</div>

</div>

</div>
        <script>
        function openForm() {
          document.getElementById("myForm").style.display = "block";
        }

        function closeForm() {
          document.getElementById("myForm").style.display = "none";
        }

        function w3_open() {
          document.getElementById("main").style.marginLeft = "25%";
          document.getElementById("mySidebar").style.width = "25%";
          document.getElementById("mySidebar").style.display = "block";
          document.getElementById("openNav").style.display = 'none';
        }
        function w3_close() {
          document.getElementById("main").style.marginLeft = "0%";
          document.getElementById("mySidebar").style.display = "none";
          document.getElementById("openNav").style.display = "inline-block";
        }
        </script>

</body>
</html>
