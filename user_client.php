<?php include 'navs/user_navs.php'; ?>

<div>
    <?php
    if(isset($_SESSION["Success"])){
      echo $_SESSION['Success'];
      unset ($_SESSION['Success']);
    }
    ?>
</div>
    <div class="container-fluid"><br><br>
            <?php
            $sql = "SELECT * FROM Announcements ORDER BY Announce_id DESC";
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
    </div>

<script>
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
