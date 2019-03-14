<!DOCTYPE html>
<html lang = "en">
<head>
    <title>Sign Up</title>
    <meta charset="utf-8">
    <link rel="stylesheet" style="text/css" href="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }

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
      background-image: url("cebu.jpg");

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
    .bg-text1 {
      background-color: rgb(0,0,0); /* Fallback color */
      background-color: rgba(0,0,0, 0.7); /* Black w/opacity/see-through */
      color: white;
      font-weight: bold;
      border-radius: 10px 10px 10px 10px;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      z-index: 2;
      width: 90%;
      padding: 25px;
      box-shadow: 0 4px 9px 5px rgba(0, 0, 0, 0.8), 0 6px 20px 0 rgba(2, 0, 0, 0.19);
    }

    .bg-text {
      background-color: rgb(0,0,0); /* Fallback color */
      background-color: rgba(0,0,0, 0.9); /* Black w/opacity/see-through */
      color: white;
      font-weight: bold;
      border-radius: 10px 10px 10px 10px;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      z-index: 2;
      width: 50%;
      padding: 25px;
      box-shadow: 0 4px 9px 5px rgba(0, 0, 0, 0.8), 0 6px 20px 0 rgba(2, 0, 0, 0.19);
    }

    input{
      align:center;
    }

    .form-popup {
      display: none;
    }

    </style>
</head>
<body>

  <?php require 'server.php'; ?>
            <?php
            if(isset($_SESSION['username'])){
              $username = $_SESSION['username'];
              $sql = "SELECT * FROM user_client WHERE (Email = '$username' OR Username = '$username')";
              $result = mysqli_query($conn, $sql);
              $row = mysqli_fetch_assoc($result);
            }
              ?>
<div class="bg-image"></div>
<div class="bg-text1">
  <a href="user_client.php" style="color:red;"><< Go Back</a>
<div class="error">
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

      if(isset($_POST['update'])){

        $lname = $_POST['lname'];
        $fname = $_POST['fname'];
        $mname = $_POST['mname'];
        $bday = $_POST['bday'];
        $address = $_POST['address'];
        $Gender = $_POST['Gender'];
        $email = $_POST['email'];
        $username = $_POST['username'];

          $sql = "UPDATE user_client SET Lastname='$lname', Firstname='$fname', MiddleName='$mname', Birthday='$bday', Address='$address', Gender='$Gender', Email='$email', Username='$username'
                  WHERE user_id=".$id;
          $result = mysqli_query($conn, $sql);
          header("Refresh:1; url:client_info.php");

          if (!$result) {
            echo "No Action";
          }else {
            echo "Successfuly Update";
          }
  }
}

    ?>
</div>
<center>
<img src="dsws.png" height="75" width="85"><br>
<?php echo 'Name: <i><u>'.$fname." ". $lname." ".$mname.'</u></i>';?><br>
<br><br>
</center>
<?php echo 'Birthday: <i><u>'.$bday.'</u></i>';?><br>
<?php echo 'Address: <i><u>'.$address.'</u></i>';?><br>
<?php echo 'Gender: <i><u>'.$Gender.'</u></i>';?><br>
<?php echo 'Email: <i><u>'.$email.'</u></i>';?><br>
<?php echo 'Username: <i><u>'.$username.'</u></i>';?><br><br>
<input type='submit' class='btn btn-primary' onclick='openForm()' value='Edit Info'>
</div>
  <div class="form-popup" id="myForm">
    <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
      <div class="bg-text">
        <a href="#" onclick="closeForm()" style="color:red; font size: 15px; float:right;">X</a>
        <center>
        <img src="dsws.png" height="75" width="85"><br>
        <?php echo '<i><u>'.$row["Firstname"]." ". $row["Lastname"]." ".$row["MiddleName"].'</u></i>';?><br>
        NAME
        </center>
        <div class="form-inline">
        <div>
          <br>
          <label for="sel1">
          <input type="text" name="lname" class="form-control" placeholder="Enter Lastname" value="<?php echo $lname;?>">
          </label>
          <label for="sel1">
          <input type="text" name="fname" class="form-control" placeholder="Enter Firstname" value="<?php echo $fname;?>">
          </label>
          <label for="sel1">
          <input type="text" name="mname" class="form-control" placeholder="Enter Middle Name" value="<?php echo $mname;?>">
          </label>
        </div>
      </div>
        <div class="form-inline">
        <label for="sel1">
          <div>
            <label for="sel1">
                <input type="date" name="bday" class="form-control" value="<?php echo $bday;?>">
            </label>
            <label for="sel1">
                <input type="text" name="address" class="form-control" placeholder="Enter Your Address" value="<?php echo $address;?>">
            </label>
            <label for="sel1">
            <select class="form-control" name="Gender" value="<?php echo $Gender;?>">
              <option value="Male" <?php if($row['Gender'] == 'Male'){ echo 'selected';}?>>Male</option>
              <option value="Female" <?php if($row['Gender'] == 'Female'){ echo 'selected';}?>>Female</option>
            </select>
            </label>
        </div>
        <div>
          <label for="sel1">
          <input type="email" name="email" class="form-control" placeholder="Enter Email" value="<?php echo $email;?>">
          </label>
        </div>
        <div>
          <label for="sel1">
          <input type="text" name="username" class="form-control" placeholder="Enter Username" value="<?php echo $username;?>">
          </label>
        </div>
        <div class="form-inline">
          <br><button type="submit" name="update" class="btn btn-primary">Update</button><br><br>
          <a href="changepassword.php" class="btn btn-danger">Change Password</a>
        </div>
      </div>
      </form>
      </div>

      <script>
      function openForm() {
        document.getElementById("myForm").style.display = "block";
      }

      function closeForm() {
        document.getElementById("myForm").style.display = "none";
      }
      </script>
</body>
</html>
