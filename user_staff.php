<?php include 'navs/staff_navs.php'; ?>

<div class="container-fluid"><br><br>
  <div class="col-sm-5">
  <?php
  if(isset($_SESSION["Success"])){
    echo $_SESSION['Success'];
    unset ($_SESSION['Success']);
  }
  ?>
  </div>
  <div class='example'>
    <?php

      $s= "SELECT COUNT(*) AS Total FROM pwd_application_detail";
      $res= mysqli_query($conn,$s);
      $ro= mysqli_fetch_assoc($res);


      echo '<center>Total PWD Applicants:<h1> '.$ro['Total'].'</h1></center>';


    ?>

    <h3>Percentage of approved applicants with different types of disability</h3>
    <br><br>
       <?php

       $sql="SELECT * FROM add_type_of_disability";
       $result=mysqli_query($conn,$sql);
       while($row=mysqli_fetch_assoc($result)){
         $type =$row['TypeOfDisabilty'];
         $s= "SELECT round(AVG(TypeOfDisability='$type')*100) AS Total FROM approved_pwd_app_detail";
         $res= mysqli_query($conn,$s);
         $ro= mysqli_fetch_assoc($res);


         echo '<strong>'.$row['TypeOfDisabilty'].'</strong>
         <div class="progress">
           <div class="progress-bar progress-bar-success  progress-bar-striped" role="progressbar" aria-valuenow="0"
           aria-valuemin="0" aria-valuemax="100" style="width:'.$ro['Total'].'%">
           <p style="color:black;"><strong>'.$ro['Total'].'%</strong></p>
          </div>
        </div>';
       }



       ?>

     <br><br><br>
    <h3>Percentage of disapproved applicants with different types of disability</h3>
    <br><br>
    <?php

    $sql="SELECT * FROM add_type_of_disability";
    $result=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_assoc($result)){
      $type =$row['TypeOfDisabilty'];
      $s= "SELECT round(AVG(TypeOfDisability='$type')*100) AS Total FROM disapproved_pwd_app_detail";
      $res= mysqli_query($conn,$s);
      $ro= mysqli_fetch_assoc($res);


      echo '<strong>'.$row['TypeOfDisabilty'].'</strong>
      <div class="progress">
        <div class="progress-bar progress-bar-danger    progress-bar-striped" role="progressbar" aria-valuenow="0"
        aria-valuemin="0" aria-valuemax="100" style="width:'.$ro['Total'].'%">
        <p style="color:black;"><strong>'.$ro['Total'].'%</strong></p>
       </div>
     </div>';
    }
    ?>
  </div>
  <div class='example'>
    <?php

      $s= "SELECT COUNT(*) AS Total FROM senior_application_detail";
      $res= mysqli_query($conn,$s);
      $ro= mysqli_fetch_assoc($res);

      echo '<center>Total Senior Citizen Applicants:<h1> '.$ro['Total'].'</h1></center>';


    ?>
    <br><br>
    <?php
      $s= "SELECT COUNT(*) AS Total FROM approved_senior_app_detail";
      $res= mysqli_query($conn,$s);
      $ro= mysqli_fetch_assoc($res);

      echo '<center>Total Senior Citizen Approved Applicants:<h1> '.$ro['Total'].'</h1></center>';


    ?>
     <br><br>
    <?php

      $s= "SELECT COUNT(*) AS Total FROM disapproved_senior_app_detail";
      $res= mysqli_query($conn,$s);
      $ro= mysqli_fetch_assoc($res);


      echo '<center>Total Senior Citizen Disapproved Applicants:<h1> '.$ro['Total'].'</h1></center>';


    ?>
  </div>
</div>
</body>
</html>
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
