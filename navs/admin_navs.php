<?php
include 'server.php';
?>
<!DOCTYPE html>
<html>
<title>Admin</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta content="noindex, nofollow" name="robots">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<style>
.btn1, .btn2 {
    width: 100%;
    border-radius: 5px 5px 5px 5px;
    color: white;
    background-color: #4CAF50;
    padding: 5px;
}

.btn1:hover{
  background-color: white;
  color:blue;
}
.btn2:hover{
  background-color: white;
  color:red;
}

#myInput {
  background-position: 10px 12px; /* Position the search icon */
  background-repeat: no-repeat; /* Do not repeat the icon image */
  width: 30%; /* Full-width */
  font-size: 16px; /* Increase font-size */
  padding: 12px 20px 12px 40px; /* Add some padding */
  border: 1px solid #ddd; /* Add a grey border */
  margin-bottom: 12px; /* Add some space below the input */
  border-radius: 5px;
}
#myInput2 {
  background-position: 10px 12px; /* Position the search icon */
  background-repeat: no-repeat; /* Do not repeat the icon image */
  width: 30%; /* Full-width */
  font-size: 16px; /* Increase font-size */
  padding: 12px 20px 12px 40px; /* Add some padding */
  border: 1px solid #ddd; /* Add a grey border */
  margin-bottom: 12px; /* Add some space below the input */
  border-radius: 5px;
}
#customers {
  font-family: "TrebucheMS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 1020px0%;
}

#customers td, th {
  border: 1px solid #ddd;
  padding: 8px;
  text-align: left;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: center;
  background-color: skyblue;
  color: white;
}

.btn-lg:hover{
  color: red;
  transform: scale(1.1);
}

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

.others{
display:none;
background-color: #F7F7F7; /* Black w/opacity/see-through */
color: black;
border-radius: 10px;
margin: 100px auto;
font-family: Raleway;
padding: 50px;
width: 60%;
min-width: 300px;
}
#first{
display:block;
background-color: #F7F7F7; /* Black w/opacity/see-through */
color: black;
border-radius: 10px;
margin: 100px auto;
font-family: Raleway;
padding: 50px;
width: 60%;
min-width: 300px;
}
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

 .form-control, .textarea{
   resize: none;
 }
 .form-popup {
   display: none;
 }

 .bg-text {
   background-color: rgb(0,0,0); /* Fallback color */
   background-color: #e4f1fe;; /* Black w/opacity/see-through */
   color: white;
   font-weight: bold;
   border-radius: 10px 10px 10px 10px;
   border: 1px solid #f1f1f1;
   position: absolute;
   top: 50%;
   left: 50%;
   transform: translate(-50%, -50%);
   z-index: 2;
   width: 80%;
   padding: 50px;
   box-shadow: 0 4px 9px 5px rgba(0, 0, 0, 0.8), 0 6px 20px 0 rgba(2, 0, 0, 0.19);
 }
</style>
<body>



<div class="w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:none" id="mySidebar">
  <button class="w3-bar-item w3-button w3-large"
  onclick="w3_close()">&times;</button>
  <?php
if(isset($_SESSION['username'])){
  $username = $_SESSION['username'];
  $sql = "SELECT * FROM user_admin WHERE Username = '$username'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);

  echo '<center><img src="others/dsws.png" height="75" width="85"><br>'.$row['Firstname'].' '.$row['Middle_Name'].' '.$row['Lastname'].' <br>(Admin)</center>';
}
  ?>
  <br><br><br>
  <a href="user_admin.php" class="w3-bar-item w3-button">
  <img src="https://img.icons8.com/ultraviolet/30/000000/home.png"> HOME</a>
  <?php
  $sql = "SELECT * FROM employee";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  $id = $row['Employee_ID'];

   ?>
  <a href="profile_admin.php?info=<?php echo $id?>" class="w3-bar-item w3-button">
  <img src="https://img.icons8.com/ultraviolet/30/000000/about-us-male.png"> INFO</a>
  <a href="announcements_admin_view.php" class="w3-bar-item w3-button">
    <img src="https://img.icons8.com/dusk/30/000000/google-alerts.png">ANNOUNCEMENTS</a>
  <a href="announcements_admin.php" class="w3-bar-item w3-button">
    +<img src="https://img.icons8.com/dusk/30/000000/google-alerts.png">POST ANNOUNCEMENTS</a>

   <button onclick="myFunction1()" class="w3-button">
   <img src="https://img.icons8.com/ultraviolet/30/000000/administrative-tools.png"> Requirements Maintenance</button>
    <div id="Demo1" class="w3-dropdown-content w3-bar-block w3-border">
    
       <?php

                $sql="SELECT * FROM add_services";
                $result=mysqli_query($conn, $sql);
                while($row=mysqli_fetch_assoc($result)){
                  $serv=$row['Services'];

                    if ($serv=='PWD Services') {
                      echo '<a href="add_req_pwd.php" class="w3-bar-item w3-button">'.$serv.'</a>';
                    }elseif($serv=='Senior Citizen Services') {
                      echo '<a href="add_req_senior" class="w3-bar-item w3-button">'.$serv.'</a>';
                    }else {
                      echo '<a href="#" class="w3-bar-item w3-button" disabled>'.$serv.'</a>';
                    }

                  }
        ?>
    </div><br><br>

   <button onclick="myFunction5()" class="w3-button">
  <img src="https://img.icons8.com/ultraviolet/30/000000/administrative-tools.png"> Form Maintenance</button>
  <div id="Demo5" class="w3-dropdown-content w3-bar-block w3-border">
        <a href="add_type_disability.php" class="w3-bar-item w3-button">Type of Disabilty</a>
        <a href="add_highest_educ_attainment.php" class="w3-bar-item w3-button">Highest Educational Attainment</a>
        <a href="add_living_residing.php" class="w3-bar-item w3-button">Living or Residing</a>
        <a href="add_occupation.php" class="w3-bar-item w3-button">Occupation</a>
        <a href="add_source_isa.php" class="w3-bar-item w3-button">Source Income/Support/Assistance</a>
        <a href="add_monthly_isa.php" class="w3-bar-item w3-button">Monthly Income/Support/Assistance</a>
        <a href="add_areas_specialization_skills.php" class="w3-bar-item w3-button">Areas of Specialization/Skills</a>
        <a href="add_community_serv.php" class="w3-bar-item w3-button">Community Service</a>
  </div><br>
     <button onclick="myFunction3()" class="w3-button">
     <img src="https://img.icons8.com/ultraviolet/30/000000/administrative-tools.png"> PROBLEM/NEEDS COMMONLY ENCOUNTERED Maintenance</button>
      <div id="Demo3" class="w3-dropdown-content w3-bar-block w3-border">
        <a href="add_economics.php" class="w3-bar-item w3-button">Economics</a>
        <a href="add_social_emotional.php" class="w3-bar-item w3-button">Social/Emotional</a>
        <a href="add_health.php" class="w3-bar-item w3-button">Health</a>
        <a href="add_housing.php" class="w3-bar-item w3-button">Housing</a>
      </div>
      <br>
      <button onclick="myFunction4()" class="w3-button">
      <img src="https://img.icons8.com/ultraviolet/30/000000/administrative-tools.png"> For Employee</button>
       <div id="Demo4" class="w3-dropdown-content w3-bar-block w3-border">
         <a href="add_emp.php" class="w3-bar-item w3-button">Add Employee</a>
         <a href="edit_emp.php" class="w3-bar-item w3-button">Inactive Employee</a>
         <a href="add_emp_position.php" class="w3-bar-item w3-button">Add Employee Position</a>
       </div>
       <br>
       <button onclick="myFunctions()" class="w3-button">
       <img src="https://img.icons8.com/dusk/30/000000/add-user-group-man-woman.png"> More</button>
        <div id="Demos" class="w3-dropdown-content w3-bar-block w3-border">
          <a href="add_download_COD.php" class="w3-bar-item w3-button">Add Files</a>
          <a href="add_steps.php" class="w3-bar-item w3-button">Add Steps</a>
          <a href="add_services.php" class="w3-bar-item w3-button">Add Services</a>
        </div><br>
        <a href="Contact.php" class="w3-bar-item w3-button">
        <img src="https://img.icons8.com/ultraviolet/30/000000/contacts.png"> CONTACT</a>
        <a href="About.php" class="w3-bar-item w3-button">
        <img src="https://img.icons8.com/ultraviolet/30/000000/information.png"> ABOUT</a>
        <br><br><br>
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
      $sql = "SELECT * FROM user_admin WHERE Username = '$username'";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);

      echo '<img src="others/dsws.png" height="75" width="85">'.$row['Firstname'].' '.$row['Middle_Name'].' '.$row['Lastname'];
    }
      ?>
  </div>
</div>
<script>
function myFunction() {
  var x = document.getElementById("Demo");
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
function myFunctions() {
  var x = document.getElementById("Demos");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else {
    x.className = x.className.replace(" w3-show", "");
  }
}
function myFunction3() {
  var x = document.getElementById("Demo3");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else {
    x.className = x.className.replace(" w3-show", "");
  }
}
function myFunction4() {
  var x = document.getElementById("Demo4");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else {
    x.className = x.className.replace(" w3-show", "");
  }
}
function myFunction5() {
  var x = document.getElementById("Demo5");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else {
    x.className = x.className.replace(" w3-show", "");
  }
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
