<!DOCTYPE html>
<html>
<title>User</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta content="noindex, nofollow" name="robots">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<style>
.formage{
  border-radius:3px;
  width:auto;
  padding: 4px;
}
.error{
  border-radius: 10px 10px 10px 10px;
  width: auto;
  text-align: center;
  background-color: red;
  color: white;
  }

@import url(http://fonts.googleapis.com/css?family=Droid+Serif);
/* Above line is to import google font style */


.navbar {
  margin-bottom: 0;
  border-radius: 0;
  width: auto;
}
  /* Set height of the grid so .sidenav can be 100% (adjust if needed) */
  .row.content {height: 1500px}

  /* Set gray background color and 100% height */
  .sidenav {
    background-color: #f1f1f1;
    height: 100%;
  }

  /* On small screens, set height to 'auto' for sidenav and grid */
  @media screen and (max-width: 767px) {
    .sidenav {
      height: auto;
      padding: 50px;
    }
    .row.content {height: auto;}
  }
  .example {
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: inherit; /* Black w/opacity/see-through */
    color: Black;
    padding: 20px;
    margin: 50px auto 0px;
    border-radius: 10px;
    width:  75%;
    height: auto;
    box-shadow: 0 4px 9px 0 rgba(0, 0, 0, 0.8);
  }
  .example2 {
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: inherit; /* Black w/opacity/see-through */
    color: Black;
    padding: 20px;
    margin: 50px auto 0px;
    border-radius: 10px;
    width:  75%;
    height: auto;
  }
  .bg-text
  {
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: inherit; /* Black w/opacity/see-through */
    color: Black;
    padding: 20px;
    margin: 50px auto 0px;
    border-radius: 10px;
    width:  75%;
    height: auto;
  }

 .form-control, .textarea{
   resize: none;
 }
 .form-popup {
   display: none;
 }
</style>
<body>
<?php include 'server.php'; ?>
<div class="w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:none" id="mySidebar">
  <button class="w3-bar-item w3-button w3-large"
  onclick="w3_close()">&times;</button>
  <?php
if(isset($_SESSION['username'])){
  $username = $_SESSION['username'];
  $sql = "SELECT * FROM user_client WHERE (Email = '$username' OR Username = '$username')";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  $id = $row['user_id'];
  echo '<center><img src="others/dsws.png" height="75" width="85"><br>'.$row['Firstname'].' '.$row['MiddleName'].' '.$row['Lastname'].'</center>';
}
  ?>
  <br><br><br>
  <a href="user_client.php" class="w3-bar-item w3-button">
  <img src="https://img.icons8.com/ultraviolet/30/000000/home.png"> HOME</a>
    <a href="profile_user.php" class="w3-bar-item w3-button">
    <img src="https://img.icons8.com/ultraviolet/30/000000/about-us-male.png"> INFO</a>

  <button onclick="myFunction()" class="w3-button">
  <img src="https://img.icons8.com/ultraviolet/30/000000/send-job-list.png"> SERVICES REGISTRATION</button>
   <div id="Demo" class="w3-dropdown-content w3-bar-block w3-border">

     <?php
     $sql="SELECT * FROM add_services WHERE Services='PWD Services'";
     $sql2="SELECT * FROM add_services WHERE Services='Senior Citizen Services'";

     $result=mysqli_query($conn, $sql);
     $result2=mysqli_query($conn, $sql2);

     $row=mysqli_fetch_assoc($result);
       $serv=$row['Services'];
       echo '<a href="steps_pwd.php" class="w3-bar-item w3-button">'.$serv.'</a>';
     $row=mysqli_fetch_assoc($result2);
       $serv=$row['Services'];
       echo '<a href="seniors.php" class="w3-bar-item w3-button">'.$serv.'</a>';
      ?>

   </div><br>
   <button onclick="myFunctions()" class="w3-button">
   <img src="https://img.icons8.com/ultraviolet/30/000000/send-job-list.png"> SUBMITED SERVICES REGISTRATION</button>
    <div id="Demos" class="w3-dropdown-content w3-bar-block w3-border">

      <?php
      if(isset($_SESSION['username'])){
      $username = $_SESSION['username'];
      $sql = "SELECT * FROM user_client WHERE (Email = '$username' OR Username = '$username')";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);
      $id = $row['user_id'];
      }

      $sql="SELECT * FROM add_services WHERE Services='PWD Services'";
      $sql2="SELECT * FROM add_services WHERE Services='Senior Citizen Services'";

      $result=mysqli_query($conn, $sql);
      $result2=mysqli_query($conn, $sql2);

      $row=mysqli_fetch_assoc($result);
        $serv=$row['Services'];
        echo '<a href="steps_pwd_submitted.php?submitted='.$id.'" class="w3-bar-item w3-button">'.$serv.'</a>';
      $row=mysqli_fetch_assoc($result2);
        $serv=$row['Services'];
        echo '<a href="seniors_submitted.php?submitted='.$id.'"" class="w3-bar-item w3-button">'.$serv.'</a>';
       ?>

    </div><br>
   <button onclick="myFunction1()" class="w3-button">
   <img src="https://img.icons8.com/ultraviolet/30/000000/download.png"> DOWNLOADS</button>
    <div id="Demo1" class="w3-dropdown-content w3-bar-block w3-border">
      <?php
      $sql="SELECT * FROM add_dowloadables";
      $result=mysqli_query($conn, $sql);
      while ($row=mysqli_fetch_array($result)) {
        $download=$row['Files'];
        echo '<a href="downloadable/'.$download.'" class="w3-bar-item w3-button" download>'.$download.'</a>';
      }

       ?>
    </div>
    <a href="contact_us_client.php" class="w3-bar-item w3-button">
    <img src="https://img.icons8.com/ultraviolet/30/000000/contacts.png"> CONTACT</a>
    <a href="about_us_client.php" class="w3-bar-item w3-button">
    <img src="https://img.icons8.com/ultraviolet/30/000000/information.png"> ABOUT</a>
  <br><br><br>
    <a href="index.php?return='1'"class="w3-bar-item w3-button"><span class="glyphicon glyphicon-log-in"></span> LOGOUT</a>
</div>
<div id="main">

<div class="w3-blue">
  <button id="openNav" class="w3-button w3-blue w3-xlarge" onclick="w3_open()">&#9776;</button>
  <div class="w3-container w3-blue">
    <h1>
      <?php
    if(isset($_SESSION['username'])){
      $username = $_SESSION['username'];
      $sql = "SELECT * FROM user_client WHERE (Email = '$username' OR Username = '$username')";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);
      $id = $row['user_id'];
      echo '<img src="others/dsws.png" height="75" width="85">'.$row['Firstname'].' '.$row['MiddleName'].' '.$row['Lastname'];
    }
      ?>
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
<script>
function myFunction() {
  var x = document.getElementById("Demo");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else {
    x.className = x.className.replace(" w3-show", "");
  }
}
function myFunctions() {
  var x = document.getElementById("Demos");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else {
    x.className = x.className.replace(" w3-show", "");
  }
}
function myFunction1() {
  var x = document.getElementById("Demo1");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else {
    x.className = x.className.replace(" w3-show", "");
  }
}
</script>
