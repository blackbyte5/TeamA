<?php

include 'navs/admin_navs.php';

?>

<div class="container-fluid"><br><br>
<div class='example2'>
  <h2>Contact Us</h2><br><br>
  <?php
  $sql = "SELECT * FROM employee";
  $result = mysqli_query($conn, $sql);
  while ($row=mysqli_fetch_assoc($result)) {
    $name=$row['Firstname'].' '.$row['MiddleName'].' '.$row['Lastname'];
    $position = $row['Position'];
    $contact = $row['Contact'];

    echo "<strong>Name: </strong>".$name.' ('.$position.')'.'<br><br>';
    echo "<strong>Contact: </strong>".$contact.'<br>';
  }
  ?>
</div>
</div>
</body>
</html>
