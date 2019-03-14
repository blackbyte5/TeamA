<?php include 'navs/staff_navs.php'; ?>

<div class="container-fluid"><br><br>
        <?php
        $sql = "SELECT * FROM announcements ORDER BY Announce_id DESC";
        $result = mysqli_query($conn, $sql);
        mysqli_num_rows($result);
        while($row = mysqli_fetch_assoc($result)){
        echo "<div class='example'>";
        $name = $row['Name_Publisher'];
        $date = date('M d,Y',strtotime($row ['Date_Announce']));
        $time = date('h:i a',strtotime($row ['Date_Announce']));
        $announce = $row['Announcement'];

        echo '<h3>'.$name.'</h3>';
        echo '<p style="font-size: 12px;">'.$date.' at '.$time.'</p><br>';
        echo '<p>'.$announce.'</p>';
        echo "</div>";
      }
        ?>
  </div>

</div>

</body>
</html>
