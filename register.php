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

    /* Position text in the middle of the page/image */
    .bg-text {
      background-color: white; /* Black w/opacity/see-through */
      color: Black;
      font-weight: bold;
      border-radius: 10px 10px 10px 10px;
      border: 1px solid #f1f1f1;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      z-index: 2;
      width: 55%;
      padding: 25px;
      box-shadow: 0 4px 9px 0 rgba(0, 0, 0, 0.8);
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
        <img src="others/dsws.png" height="95" width="95">
        <h1><i>Sign Up</i></h1>
        </center>
      <div class="error">
      <?php
          require 'server.php';
      //*************************************************** SIGN-UP *****************************************
            $lname = '';$fname = '';$mname = '';$bday = '';$address = '';$Gender = '';$email = '';$username = '';$password1 = '';$password2 ='';

            if(isset($_POST['register'])){


              $lname = $_POST['lname'];
              $fname = $_POST['fname'];
              $mname = $_POST['mname'];
              $bday = $_POST['bday'];
              $address = $_POST['address'];
              $Gender = $_POST['Gender'];
              $email = $_POST['email'];
              $username = $_POST['username'];
              $password1 = $_POST['password1'];
              $password2 = $_POST['password2'];

              $sql = "SELECT * FROM user_client";
              $result = mysqli_query($conn, $sql);
              mysqli_num_rows($result);
              $rows = mysqli_fetch_assoc($result);


            if(empty($fname) || empty($lname) || empty($bday) || empty($address) || empty($Gender) || empty($email) || empty($username) || empty($password1) || empty($password2)){
                echo "Fill-up <strong>all fields!</strong><br>";
            }

            elseif ($rows['Username'] == $username) {
              echo "Invalid Username<br>try another";
            }

            elseif ($rows['Email'] == $email) {
              echo "Email has been taken<br>try another";
            }

            elseif (strlen($password1 >= 7)){
              echo "<strong>Password</strong> must 7 characters..<br>";
            }

            elseif ($password1 != $password2){
              echo "<strong>Two password</strong> not match!";
              }

            else{
                $password = md5 ($password1);//encript password for security
                $sql = "INSERT INTO user_client (Lastname, Firstname, MiddleName, Birthday, Address, Gender, Email, Username, Password)
                        VALUES ('$lname', '$fname', '$mname', '$bday', '$address', '$Gender', '$email', '$username', '$password')";
                $result = mysqli_query($conn, $sql);

                $_SESSION['username'] = $username;
                $_SESSION['Success'] = '<h3>Your logged in........</h3>';
                header('location: user_client.php');

            }
          mysqli_close($conn);
        }

          ?>
      </div>
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
            <select class="form-control" name="Gender">
              <option value="">Gender</option>
              <option value="Male"<?php if($Gender=='Male'){echo "selected";}?>>Male</option>
              <option value="Female"<?php if($Gender=='Female'){echo "selected";}?>>Female</option>
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
          <label for="sel1">
          <input type="password" name="password1" class="form-control" placeholder="Enter Password" value="<?php echo $password1;?>">
          </label>
        </div>
        <div class="form-inline">
          <label for="sel1">
          <input type="password" name="password2" class="form-control" placeholder="Retype Password" value="<?php echo $password2;?>"><br><br>
          </label>
        </div>
        <div class="form-inline">
          <button type="submit" name="register" class="btn btn-primary">Submit</button><br><br>
        </div>
        <div class="form-inline">
          <p>Have Account?<a href="index.php" style="color:red;"> Login Here</a></p>
        </div>
      </div>
      </form>
</body>
</html>
