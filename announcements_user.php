<!DOCTYPE html>
<html lang="en">
<head>
  <title>Staff</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
  .navbar {
    margin-bottom: 0;
    border-radius: 0;
    width: auto;
  }

    /* Set height of the grid so .sidenav can be 100% (adjust if needed) */
    .row.content {
      height: auto;
    }

    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 50px;
      }
      .row.content {height: auto;}
    }

    .example2 {
      background-color: rgb(0,0,0); /* Fallback color */
      background-color: rgba(0,0,0, 0.7); /* Black w/opacity/see-through */
      color: white;
      padding: 20px;
      margin: 50px auto 0px;
      border-radius: 10px;
      width:  75%;
      box-shadow: 0 4px 9px 5px rgba(0, 0, 0, 0.8), 0 6px 20px 0 rgba(2, 0, 0, 0.19);

    }

    a:hover{
     color: red;
     transform: scale(1.2);
   }
  </style>
</head>
<body>
<?php include 'server.php'; ?>
<nav class="navbar navbar-inverse">
   <div class="container-fluid">
         <div class="navbar-header">
           <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
             <span class="icon-bar"></span>
             <span class="icon-bar"></span>
             <span class="icon-bar"></span>
           </button>
         </div>
       <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav">
            <li><a href="user_client.php" class="glyphicon glyphicon-home"></a></li>
            <li><a href="#">About Us</a></li>
          </ul>
    </div>
  </div>
</nav>

<div class="container-fluid">
  <div class="row content">
        <div class="col-sm-5">
        <?php
        if(isset($_SESSION["Success"])){
          echo $_SESSION['Success'];
          unset ($_SESSION['Success']);
        }
        ?>
        </div>
        <?php
        $sql = "SELECT * FROM Announcements ORDER BY Announce_id DESC";
        $result = mysqli_query($conn, $sql);
        mysqli_num_rows($result);
        while($row = mysqli_fetch_assoc($result)){
        echo "<div class='example2'>";
        $name = $row['Name_Publisher'];
        $date = date('M d,Y',strtotime($row ['Date_Announce']));
        $time = date('h:i a',strtotime($row ['Date_Announce']));
        $announce = $row['Announcement'];

        echo '<h3>'.$name.'</h3>';
        echo '<p style="font-size: 12px;">'.$date.' at '.$time.'</p><br>';
        echo '<textarea class="form-control" rows="15" readonly>'.$announce.'</textarea>';
        echo "</div>";
      }
        ?>
  </div>
</div>
</div>
</body>
</html>
