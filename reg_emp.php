<!DOCTYPE html>
<html lang = "en">
<head>
    <title>Register Employee</title>
    <meta charset="utf-8">
    <link rel="stylesheet" style="text/css" href="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>

    .button:hover{
        background-color: red;
    }

    .error{
      border-radius: 10px 10px 10px 10px;
      width: auto;
      text-align: center;
      background-color: red;
      color: white;
      }

    .btn-primary:hover{
      color: red;
      transform: scale(1.1);
    }
    body, html {
      height: 100%;
      margin: 0;
      font-family: Arial, Helvetica, sans-serif;
    }

    * {
      box-sizing: border-box;
    }

    .bg-image {
      /* The image used */
      background-image: url("others/cebu.jpg");

      /* Add the blur effect */
      filter: blur(5px);
      -webkit-filter: blur(1px);

      /* Full height */
      height: 100%;

      /* Center and scale the image nicely */
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
    }

    /* Position text in the middle of the page/image */
    .bg-text {
      background-color: rgb(0,0,0); /* Fallback color */
      background-color: rgba(0,0,0, 0.7); /* Black w/opacity/see-through */
      color: white;
      font-weight: bold;
      border-radius: 10px 10px 10px 10px;
      border: 1px solid #f1f1f1;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      z-index: 2;
      width: 55%;
      padding: 30px;
      box-shadow: 0 4px 9px 5px rgba(0, 0, 0, 0.8), 0 6px 20px 0 rgba(2, 0, 0, 0.19);
    }

    input{
      align:center;
    }

    </style>
</head>
<body>
  <div class="bg-image"></div>
    <form method="POST" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>">
      <div class="bg-text">
        <center>
        <img src="others/dsws.png" height="85" width="85"><br><br>
        </center>
      <div class="error">
      <?php
          require 'server.php';

      //*************************************************** SIGN-UP *****************************************
      if (isset($_GET['id'])) {
        $id=$_GET['id'];
        $sql="SELECT * FROM sample WHERE id='$id'";
        $res=mysqli_query($conn,$sql);
        while ($a=mysqli_fetch_assoc($res)) {
        $lname=$a['Lastname'];
        $fname=$a['Firstname'];
        $cors=explode(',',$a['Course']);



      }
      if (isset($_GET['id'])) {
        $id=$_GET['id'];
        $sql="SELECT * FROM sample WHERE id='$id'";
        $res=mysqli_query($conn,$sql);
        $a=mysqli_fetch_assoc($res);

        $course=$a['Course'];
    }
  }
          ?>
      </div>

        <div class="form-inline">
          <label for="sel1"><br>
          <input type="text" name="fname" class="form-control" placeholder="Enter Firstname" value="<?php echo $fname;?>">
          <input type="text" name="lname" class="form-control" placeholder="Enter Lastname" value="<?php echo $lname;?>">
          </label>
        </div>
        <div class="form-inline">


            <input type="checkbox" name="course[]" value="BSIS/IT"<?php if(in_array('BSIS/IT',$cors)){echo "checked";}else{echo "unchecked";}  ?>>BSIS/IT<br>
            <input type="checkbox" name="course[]" value="BSCRIM"<?php if(in_array('BSCRIM',$cors)){echo "checked";}else{echo "unchecked";}  ?>>BSCRIM<br>
            <input type="checkbox" name="course[]" value="BSN"<?php if(in_array('BSN',$cors)){echo "checked";}else{echo "unchecked";}  ?>>BSN<br>
            <input type="checkbox" name="course[]" value="BSCPE"<?php if(in_array('BSCPE',$cors)){echo "checked";}else{echo "unchecked";}  ?>>BSCPE<br>
            <input type="checkbox" name="course[]" value="BSECE"<?php if(in_array('BSECE',$cors)){echo "checked";}else{echo "unchecked";}  ?>>BSECE<br>



          </div>
<input type="text" name="course1" class="form-control"placeholder="Others Specify..." value="<?php if(in_array($cors,$cors)){echo '';}else{echo $course ;}?>"><br><br>
        <div class="form-inline">

          <button type="submit" name="register" class="btn btn-primary">SUBMIT</button>
        </div>
      </div>
      </form>
</body>
</html>
