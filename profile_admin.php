<?php

include 'navs/admin_navs.php';

?>

<div class="container">
      <center><br><img src="others/profile1.png" height="90" width="70"></center>
      <?php
      if(isset($_SESSION['username'])){
        $username = $_SESSION['username'];
        $sql = "SELECT * FROM user_admin WHERE Username = '$username'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

           echo '<center>'.$row["Firstname"] .' '.$row["Middle_Name"] .' '.$row["Lastname"] .'</center>';
           echo '<center><strong><i>(Admin)</i></strong><br><br>';
         }
         ?>
</div>
</body>
</html>
