<!DOCTYPE html>
<html lang = "en">
<head>
    <title>Login</title>
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
      width: 50%;
      padding: 50px;
      box-shadow: 0 4px 9px 0 rgba(0, 0, 0, 0.8);
    }

    </style>
</head>
<body>
  <div class="bg-image"></div>
    <form method="POST" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>">
      <div class="bg-text">
        <center>
        <img src="others/dsws.png" height="85" width="85">
        <h1><i>Login</i></h1>
        </center>

      <div class="error">
      <?php
              include 'server.php';
       //****************************************lOG IN PAGE*******************************************
               $username = '';
               $password = '';
              if(isset($_POST['login'])){

              $username = $_POST['username'];
              $password = $_POST['password'];

              if(empty($username) && empty($password)){
                echo "Please enter your <strong style='color:Black;'>Username</strong> and <strong style='color:Black;'>Password</strong>!<br>";
              }

              elseif (empty($username)){
                echo "Please enter your <strong style='color:Black;'>Username!</strong><br>";
              }

              elseif (empty($password)){
                echo "Please enter your <strong style='color:Black;'>Password!</strong><br>";
              }

              else{
              $password = md5($password);//*encript password for security

              $sql = "SELECT * FROM user_client WHERE (Email ='$username' OR Username ='$username') AND Password = '$password'";
              $user = mysqli_query($conn, $sql);

              $sql1 = "SELECT * FROM user_staff WHERE Username ='$username' AND Password = '$password'";
              $staff = mysqli_query($conn, $sql1);

              $sql2 = "SELECT * FROM user_admin WHERE Username ='$username' AND Password = '$password'";
              $admin = mysqli_query($conn, $sql2);

              if(mysqli_num_rows($user) == 1){
                $_SESSION['username'] = $username;
                $_SESSION['Success'] = '<h3>Your logged in........</h3>';
                header('location: user_client.php');
              }

              elseif(mysqli_num_rows($staff) == 1) {
                $_SESSION['username'] = $username;
                $_SESSION['Success'] = '<h3>Your logged in........</h3>';
                header('location: user_staff.php');
              }

              elseif(mysqli_num_rows($admin) == 1) {
                $_SESSION['username'] = $username;
                $_SESSION['Success'] = '<h3>Your logged in........</h3>';
                header('location: user_admin.php');
              }

              else{
                echo "<strong>Incorrect Password and Username</strong><br>";
                echo "Please try again!";
              }
            }


 //*********************************** LOGOUT *****************************************
              if(isset($_GET['logout'])){
                session_destroy();
                unset ($_SESSION['username']);
                header('location: login.php');
              }
}
       ?>
        </div>
        <div>
            <b>Username or Email:<br><input type="text" name="username" class="form-control" placeholder="Enter Username" value="<?php echo $username;?>"></b>
          </div>
          <div>
            <b>Password:<br><input type="password" id="myInput" name="password" class="form-control" placeholder="Enter Password"></b>
            <br><input type="checkbox" onclick="myFunction()">Show Password
          </div>
          <div>
            <br><button type="submit" name="login" class="btn btn-primary">Login</button>
          </div>
          <div>
            <br><br><p>Don't have account? <a href="register.php" style="color:red;">Register Here</a></p>
          </div>
        </div>
      </form>
      <script>
function myFunction() {
  var x = document.getElementById("myInput");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
</body>
</html>
